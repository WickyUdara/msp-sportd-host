<?php

// app/Http/Controllers/Sports/TaekwondoController.php

namespace App\Http\Controllers\Sports;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\TaekwondoScore;
use App\Models\University;
use Illuminate\Http\Request;

class TaekwondoController extends Controller
{
    public function index() {
        // Add logic if necessary for listing all taekwondo scores or relevant data
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
            TaekwondoScore::create([
                'event_id' => $request->event_id,
                'university_id' => $universityId,
                'score' => 0,
                'penalty' => 0,
            ]);
        }

        return redirect()->route('taekwondo.show', $request->event_id)
            ->with('success', 'Scores updated successfully...');
    }

    public function show(string $id) {
        $event = Event::getEvent($id);

        $scores = TaekwondoScore::where('event_id', $id)->get();

        if ($scores->isEmpty()) {
            $scores = collect([
                TaekwondoScore::create([
                    'event_id' => $event->event_id,
                    'university_id' => $event->team1University->uni_id,
                ]),
                TaekwondoScore::create([
                    'event_id' => $event->event_id,
                    'university_id' => $event->team2University->uni_id,
                ])
            ]);
        }

        $data = [
            'nav' => 'events',
            'universities' => University::getUniversities(),
            'event' => $event,
            'scores' => $scores,
        ];

        return view('admin.Taekwondo.index', $data);
    }

    public function edit(string $id) {
        //
    }

    // Validates and updates a specific Taekwondo score
    public function update(Request $request, string $id) {
        $request->validate([
            'score' => 'required|integer|min:0',
            'penalty' => 'required|integer|min:0',
            'round' => 'required|integer|min:0'
        ]);

        $score = TaekwondoScore::find($id);
        $score->update($request->all());

        return redirect()->route('taekwondo.show', $score->event_id)
            ->with('success', 'Scores updated Successfully...');
    }

    public function updateRound(Request $request) {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,event_id',
            'increment' => 'required|integer',
        ]);
    
        $scores = TaekwondoScore::where('event_id', $validated['event_id'])->get();
        if ($scores->isNotEmpty()) {
            $round = $scores->first()->round + $validated['increment'];
    
            // Ensure the round doesn't go below zero
            if ($round >= 0) {
                TaekwondoScore::where('event_id', $validated['event_id'])->update(['round' => $round]);
    
                return response()->json(['success' => true, 'newRound' => $round]);
            } else {
                return response()->json(['success' => false, 'error' => 'Round cannot be negative']);
            }
        } else {
            return response()->json(['success' => false, 'error' => 'Scores not found for the event']);
        }
    }

    public function updateScore(Request $request) {
        $validated = $request->validate([
            'score_id' => 'required|exists:taekwondo_scores,score_id',
            'field' => 'required|string|in:score,penalty,round',
            'increment' => 'required|integer',
        ]);
    
        $score = TaekwondoScore::find($validated['score_id']);
        if ($score) {
            $field = $validated['field'];
            $newScore = $score->$field + $validated['increment'];
    
            // Ensure the score doesn't go below zero
            if ($newScore >= 0) {
                $score->$field = $newScore;
                $score->save();
    
                return response()->json(['success' => true, 'newScore' => $newScore]);
            } else {
                return response()->json(['success' => false, 'error' => 'Score cannot be negative']);
            }
        } else {
            return response()->json(['success' => false, 'error' => 'Score not found']);
        }
    }

    public function destroy($event_id) {
        TaekwondoScore::where('event_id', $event_id)->delete();
        return redirect()->route('index.events')->with('success', 'All scores for the event deleted successfully.');
    }
}
