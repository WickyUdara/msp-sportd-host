<?php

namespace App\Http\Controllers\Sports;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Sport;
use App\Models\Category;
use App\Models\Tournament;
use App\Models\University;
use App\Models\RoadRaceScore;
use Illuminate\Http\Request;
use App\Http\Requests\RoadRaceScoreRequest;

class RoadRaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::getEvent($id);

        $scores = $event->getScores(RoadRaceScore::class);

        if ($scores->isEmpty()) {
            foreach ($event->participants as $p) {
                $scores->push(RoadRaceScore::create([
                    'event_id' => $event->event_id,
                    'university_id' => $p->uni_id,
                ]));
            }
        }

        // Calculate the current stats
        $totalParticipants = $scores->count();
        $completedRaces = $scores->where('place', '>', 0)->count();
        $ongoingRaces = $totalParticipants - $completedRaces;

        $data['nav'] = 'events';
        $data['universities'] = University::getUniversities();
        $data['event'] = $event;
        $data['scores'] = $scores;
        $data['sports'] = Sport::getSports();
        $data['tournaments'] = Tournament::getTournaments();
        $data['categories'] = Category::getCategories();
        $data['totalParticipants'] = $totalParticipants;
        $data['completedRaces'] = $completedRaces;
        $data['ongoingRaces'] = $ongoingRaces;

        return view('admin.RoadRace.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoadRaceScoreRequest $request, string $id)
    {
        $params = $request->validated();
        $score = RoadRaceScore::find($params['score_id']);
        $score->update($params);
        return $this->show($score->event_id); // Correctly passing the event_id to the show method
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($event_id)
    {
        RoadRaceScore::where('event_id', $event_id)->delete();
        return redirect()->route('index.events')->with('success', 'All scores for the event deleted successfully.');
    }
}
