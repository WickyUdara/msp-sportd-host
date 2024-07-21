<?php

namespace App\Http\Controllers\Sports;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\WrestlingScore;
use App\Models\Sport;
use App\Models\Tournament;
use App\Models\University;
use Illuminate\Http\Request;

class WrestlingScoreController extends Controller
{
    public function show($id)
    {
        $event = Event::getEvent($id);

        $scores = WrestlingScore::where('event_id', $id)->get();

        if ($scores->isEmpty()) {
            $scores = collect([
                WrestlingScore::create([
                    'event_id' => $event->event_id,
                    'university_id' => $event->team1University->uni_id,
                ]),
                WrestlingScore::create([
                    'event_id' => $event->event_id,
                    'university_id' => $event->team2University->uni_id,
                ])
            ]);
        }

        $data = [
            'nav' => 'events',
            'universities' => University::getUniversities(),
            'event' => $event,
            'sports' => Sport::getSports(),
            'tournaments' => Tournament::getTournaments(),
            'categories' => Category::getCategories(),
            'scores' => $scores,
        ];

        return view('admin.Wrestling.index', $data);
    }

    public function updateScore(Request $request)
    {
        $validated = $request->validate([
            'score_id' => 'required|exists:wrestling_scores,score_id',
            'field' => 'required|string|in:score',
            'increment' => 'required|integer',
        ]);

        $score = WrestlingScore::find($validated['score_id']);
        if ($score) {
            $field = $validated['field'];
            $newScore = $score->$field + $validated['increment'];

            if ($newScore >= 0) {
                $score->$field = $newScore;
                $score->save();

                return response()->json(['success' => true, 'newScore' => $newScore]);
            } else {
                return response()->json(['success' => false, 'message' => 'Score cannot be negative']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Score not found']);
        }
    }

    public function updatePeriod(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,event_id',
            'increment' => 'required|integer',
        ]);

        $scores = WrestlingScore::where('event_id', $validated['event_id'])->get();
        if ($scores->isNotEmpty()) {
            $period = $scores->first()->period + $validated['increment'];

            if ($period >= 0) {
                WrestlingScore::where('event_id', $validated['event_id'])->update(['period' => $period]);

                return response()->json(['success' => true, 'newPeriod' => $period]);
            } else {
                return response()->json(['success' => false, 'message' => 'Period cannot be negative']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Scores not found for the event']);
        }
    }

    public function destroy($event_id)
    {
        WrestlingScore::where('event_id', $event_id)->delete();
        return redirect()->route('index.events')->with('success', 'All scores for the event deleted successfully.');
    }
}
