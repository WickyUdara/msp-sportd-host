<?php

namespace App\Http\Controllers\Sports;

use App\Models\Event;
use App\Models\Sport;
use App\Models\Category;
use App\Models\Tournament;
use App\Models\University;
use App\Models\BeachVolleyballScore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BeachVolleyBallController extends Controller
{
    public function index() {
        // Add logic if necessary for listing all beach volleyball scores or relevant data
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        // Validation and storing logic
        $request->validate([
            'event_id' => 'required|exists:events,event_id',
            'university_id' => 'required|array',
            'university_id.*' => 'required|exists:universities,uni_id',
        ]);

        foreach ($request->university_id as $universityId) {
            BeachVolleyballScore::create([
                'event_id' => $request->event_id,
                'university_id' => $universityId,
                'set_1_score' => 0,
                'set_2_score' => 0,
                'set_3_score' => 0,
            ]);
        }

        return redirect()->route('show.beachVolleyBall', $request->event_id)
                        ->with('success', 'Scores added successfully.');
    }



    public function show(string $id) {
        $event = Event::getEvent($id);
        $scores = BeachVolleyballScore::where('event_id', $id)->get();
    
        if ($scores->isEmpty()) {
            $scores = collect([
                BeachVolleyballScore::create([
                    'event_id' => $event->event_id,
                    'university_id' => $event->team1University->uni_id,
                ]),
                BeachVolleyballScore::create([
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
    
        return view('admin.BeachVolleyBall.index', $data);
    }

    public function edit(string $id) {
        //
    }

    public function update(Request $request, string $id) {
        // Validation and update logic
        $request->validate([
            'set_1_score' => 'required|integer|min:0',
            'set_2_score' => 'required|integer|min:0',
            'set_3_score' => 'required|integer|min:0',
        ]);

        $score = BeachVolleyballScore::find($id);
        $score->update($request->all());

        return redirect()->route('show.beachVolleyBall', $score->event_id)
                         ->with('success', 'Scores updated successfully.');
    }

    public function updateScore(Request $request) {
        $validated = $request->validate([
            'score_id' => 'required|exists:beach_volleyball_scores,score_id',
            'field' => 'required|string|in:set_1_score,set_2_score,set_3_score',
            'increment' => 'required|integer',
        ]);
    
        $score = BeachVolleyballScore::find($validated['score_id']);
        if ($score) {
            $field = $validated['field'];
            $newScore = $score->$field + $validated['increment'];
    
            // Ensure the score doesn't go below zero
            if ($newScore >= 0) {
                $score->$field = $newScore;
                $score->save();
    
                return response()->json(['success' => true, 'newScore' => $newScore]);
            } else {
                return response()->json(['success' => false, 'message' => 'Score cannot be negative.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Score not found.']);
        }
    }
    
    public function updateRound(Request $request) {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,event_id',
            'increment' => 'required|integer',
        ]);
    
        $scores = BeachVolleyballScore::where('event_id', $validated['event_id'])->get();
        if ($scores->isNotEmpty()) {
            $round = $scores->first()->round + $validated['increment'];
    
            // Ensure the round doesn't go below zero
            if ($round >= 0) {
                BeachVolleyballScore::where('event_id', $validated['event_id'])->update(['round' => $round]);
    
                return response()->json(['success' => true, 'newRound' => $round]);
            } else {
                return response()->json(['success' => false, 'message' => 'Round cannot be negative']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Scores not found for the event']);
        }
    }
    
    
    public function destroy($event_id) {
        BeachVolleyballScore::where('event_id', $event_id)->delete();
        return redirect()->route('index.events')->with('success', 'All scores for the event deleted successfully.');
    }
    
}
