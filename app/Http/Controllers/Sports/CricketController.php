<?php

namespace App\Http\Controllers\Sports;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Sport;
use App\Models\Category;
use App\Models\Tournament;
use App\Models\University;
use App\Models\CricketScore;
use Illuminate\Http\Request;
use App\Http\Requests\CricketScoreRequest;

class CricketController extends Controller
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

        $scores = $event->getScores(CricketScore::class);

        if ($scores->isEmpty()) {
            $scores->push(CricketScore::create([
                'event_id' => $event->event_id,
                'university_id' => $event->team1University->uni_id,
            ]));
            $scores->push(CricketScore::create([
                'event_id' => $event->event_id,
                'university_id' => $event->team2University->uni_id,
            ]));
        }
        
        $data['nav'] = 'events';
        $data['universities'] = University::getUniversities();
        $data['event'] = $event;
        $data['scores'] = $scores;
        $data['sports'] = Sport::getSports();
        $data['tournaments'] = Tournament::getTournaments();
        $data['categories'] = Category::getCategories();
        return view('admin.Cricket.index',$data);
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
    public function update(CricketScoreRequest $request, string $id)
    {
        $event = Event::getEvent($id);

        $scores = $event->getScores(CricketScore::class);

        if ($scores->isEmpty()) abort(404);

        $validated = $request->validated();

        if (isset($validated['roles'])) {
            $scores->get(0)->current_role = $validated['roles'][0];
            $scores->get(1)->current_role = $validated['roles'][1];
            $scores->get(0)->save();
            $scores->get(1)->save();
        } else {
            $batting = null;
            if ($scores->get(0)->current_role == "bat") $batting = $scores->get(0);
            if ($scores->get(1)->current_role == "bat") $batting = $scores->get(1);
            $batting->update($validated);
        }

        return $this->show($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
