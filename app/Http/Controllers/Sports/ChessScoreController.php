<?php

namespace App\Http\Controllers\Sports;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\ChessScore;
use App\Models\University;
use Illuminate\Http\Request;

class ChessScoreController extends Controller
{
    public function show($id)
    {
        $event = Event::getEvent($id);
        $scores = ChessScore::where('event_id', $id)->get();

        if ($scores->isEmpty()) {
            foreach ($event->participants as $participant) {
                ChessScore::create([
                    'event_id' => $event->event_id,
                    'university_id' => $participant->uni_id,
                    'total_score' => 0,
                ]);
            }

            $scores = ChessScore::where('event_id', $id)->get();
        }

        $data = [
            'nav' => 'events',
            'universities' => University::getUniversities(),
            'event' => $event,
            'scores' => $scores,
        ];

        return view('admin.Chess.index', $data);
    }

    public function updateScore(Request $request)
    {
        $validated = $request->validate([
            'score_id' => 'required|exists:chess_scores,score_id',
            'field' => 'required|string|in:match_1_score,match_2_score,match_3_score,match_4_score,match_5_score,match_6_score',
            'increment' => 'required|numeric',
        ]);

        $score = ChessScore::find($validated['score_id']);
        if ($score) {
            $field = $validated['field'];
            $newScore = $score->$field + $validated['increment'];

            // Ensure the score doesn't go below zero
            if ($newScore >= 0 && $newScore <= 1) {
                $score->$field = $newScore;

                // Update total score
                $score->total_score = $score->match_1_score + $score->match_2_score + $score->match_3_score + $score->match_4_score + $score->match_5_score + $score->match_6_score;
                $score->save();

                return response()->json([
                    'success' => true,
                    'newScore' => $newScore,
                    'totalScore' => $score->total_score
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'score must be in between 0 and 1 incusive'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Score not found.'
            ]);
        }
    }

    public function destroy($event_id)
    {
        ChessScore::where('event_id', $event_id)->delete();
        return redirect()->route('index.events')->with('success', 'All scores for the event deleted successfully.');
    }
}
