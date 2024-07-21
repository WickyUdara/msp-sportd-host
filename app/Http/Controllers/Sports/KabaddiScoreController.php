<?php

namespace App\Http\Controllers\Sports;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\KabaddiScore;
use App\Models\Sport;
use App\Models\Tournament;
use App\Models\University;
use Illuminate\Http\Request;

class KabaddiScoreController extends Controller
{
    public function index() {
        // Add logic if necessary for listing all beach volleyball scores or relevant data
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        $request->validate([
            'event_id' => 'required|exists:events,event_id',
            'uni_id' => 'required|array',
            'uni_id.*' => 'required|exists:universities,uni_id'
        ]);

        foreach ($request->uni_id as $universityId) {
            KabaddiScore::create([
                'event_id' => $request->event_id,
                'uni_id' => $universityId,
                'raid_points' => 0,
                'bonus_points' => 0,
                'tackle_points' => 0,
                'all_out_points' => 0,
                'total_score' => 0, // This field will be updated by the trigger
            ]);
        }

        return redirect()->route('kabaddi.show', $request->event_id)
            ->with('success', 'Scores updated successfully...');
    }

    public function show(string $id) {
        $event = Event::getEvent($id);

        $scores = KabaddiScore::where('event_id', $id)->get();

        if ($scores->isEmpty()) {
            $scores = collect([
                KabaddiScore::create([
                    'event_id' => $event->event_id,
                    'uni_id' => $event->team1University->uni_id,
                ]),
                KabaddiScore::create([
                    'event_id' => $event->event_id,
                    'uni_id' => $event->team2University->uni_id,
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

        return view('admin.Kabaddi.index', $data);
    }

    public function edit(string $id) {
        //
    }

    // Validates and updates a specific Kabaddi score
    public function update(Request $request, string $id) {
        $request->validate([
            'raid_points' => 'required|integer|min:0',
            'bonus_points' => 'required|integer|min:0',
            'tackle_points' => 'required|integer|min:0',
            'all_out_points' => 'required|integer|min:0',
        ]);

        $score = KabaddiScore::find($id);
        $score->update($request->all());

        return redirect()->route('kabaddi.show', $score->event_id)
            ->with('success', 'Scores updated Successfully...');
    }

    public function updateScore(Request $request) {
        $validated = $request->validate([
            'score_id' => 'required|exists:kabaddi_scores,score_id',
            'field' => 'required|string|in:raid_points,bonus_points,tackle_points,all_out_points',
            'increment' => 'required|integer',
        ]);
    
        $score = KabaddiScore::find($validated['score_id']);
        if ($score) {
            $field = $validated['field'];
            $newScore = $score->$field + $validated['increment'];
    
            // Ensure the score doesn't go below zero
            if ($newScore >= 0) {
                $score->$field = $newScore;
    
                // Update total score
                $score->total_score = $score->raid_points + $score->bonus_points + $score->tackle_points + $score->all_out_points;
                $score->save();
    
                return response()->json([
                    'success' => true,
                    'newScore' => $newScore,
                    'totalScore' => $score->total_score,
                ]);
            } else {
                return response()->json(['success' => false, 'error' => 'Score cannot be negative']);
            }
        } else {
            return response()->json(['success' => false, 'error' => 'Score not found']);
        }
    }

    public function destroy($event_id) {
        KabaddiScore::where('event_id', $event_id)->delete();
        return redirect()->route('index.events')->with('success', 'All scores for the event deleted successfully.');
    }
}
