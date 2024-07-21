<?php

namespace App\Http\Controllers\Sports;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Sport;
use App\Models\Category;
use App\Models\Tournament;
use App\Models\University;
use App\Models\HockeyScore;
use Illuminate\Http\Request;

class HockeyController extends Controller
{
    public function index() {
        // Add logic if necessary for listing all hockey scores or relevant data
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
            HockeyScore::create([
                'event_id' => $request->event_id,
                'university_id' => $universityId,
                'goals' => 0,
                'shots' => 0,
                'circle_penetrations' => 0,
                'penalty_corners' => 0,
                'green_cards' => 0,
                'yellow_cards' => 0,
                'red_cards' => 0,
            ]);
        }

        return redirect()->route('show.hockey', $request->event_id)
                        ->with('success', 'Scores added successfully.');
    }

    public function show(string $id) {
        $event = Event::getEvent($id);
        $scores = HockeyScore::where('event_id', $id)->get();
    
        if ($scores->isEmpty()) {
            $scores = collect([
                HockeyScore::create([
                    'event_id' => $event->event_id,
                    'university_id' => $event->team1University->uni_id,
                ]),
                HockeyScore::create([
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
    
        return view('admin.Hockey.index', $data);
    }

    public function edit(string $id) {
        //
    }

    public function update(Request $request, string $id) {
        $request->validate([
            'field' => 'required|string|in:goals,shots,circle_penetrations,penalty_corners,green_cards,yellow_cards,red_cards',
            'increment' => 'required|integer',
        ]);

        $score = HockeyScore::find($id);
        $field = $request->field;
        $increment = $request->increment;

        $newScore = $score->$field + $increment;
        if ($newScore >= 0) {
            $score->$field = $newScore;
            $score->save();

            return response()->json([
                'success' => true,
                'newScore' => $newScore
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Score cannot be negative'
            ]);
        }
    }

    public function destroy($event_id) {
        HockeyScore::where('event_id', $event_id)->delete();
        return redirect()->route('index.events')->with('success', 'All scores for the event deleted successfully.');
    }
}
