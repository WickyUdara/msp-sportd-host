<?php

namespace App\Http\Controllers\Sports;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Sport;
use App\Models\Category;
use App\Models\Tournament;
use App\Models\University;
use App\Models\SwimmingScore;
use Illuminate\Http\Request;
use App\Http\Requests\SwimmingScoreRequest;

class SwimmingController extends Controller
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

        $scores = $event->getScores(SwimmingScore::class);

        if ($scores->isEmpty()) {
            foreach ($event->participants as $p) {
                $scores->push(SwimmingScore::create([
                    'event_id' => $event->event_id,
                    'university_id' => $p->uni_id,
                ]));
            }
        }
        
        $data['nav'] = 'events';
        $data['universities'] = University::getUniversities();
        $data['event'] = $event;
        $data['scores'] = $scores;
        $data['sports'] = Sport::getSports();
        $data['tournaments'] = Tournament::getTournaments();
        $data['categories'] = Category::getCategories();
        return view('admin.Swimming.index',$data);
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
    public function update(SwimmingScoreRequest $request, string $id)
    {
        $params = $request->validated();
        $score = SwimmingScore::find($params['score_id']);
        $score->update($params);
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
