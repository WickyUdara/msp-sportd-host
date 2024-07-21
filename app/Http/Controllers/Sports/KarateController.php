<?php

namespace App\Http\Controllers\Sports;

use App\Models\Event;
use App\Models\Sport;
use App\Models\Category;
use App\Models\Tournament;
use App\Models\University;
use App\Models\KarateScore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KarateController extends Controller
{
    public function index(string $id)
    {
        
        
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::getEvent($id);
        $scores = $event->getScores(KarateScore::class);

        if ($scores->isEmpty()) {
            foreach ($event->participants as $p) {
                $scores->push(KarateScore::create([
                    'event_id' => $event->event_id,
                    'university_id' => $p->uni_id,
                    'type' => 'none',
                ]));
            }
        }

        $data['nav'] = 'events';
        $data['universities'] = University::getUniversities();
        $data['event'] = $event;
        $data['sports'] = Sport::getSports();
        $data['tournaments'] = Tournament::getTournaments();
        $data['categories'] = Category::getCategories();
        $data['scores'] = $scores;
        
        
        foreach ($scores as $score) {
            // Fetch university record using the getSingleRecord method
            $university = University::getSingleRecord($score->university_id);

            $score->university_name = $university->name;
            $score->university_img = $university->img_url;
        }

        $data['scores'] = $scores;


        return view('admin.Karate.index',$data);

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
    public function update(Request $request, $id)
    {
        if ($request->exists('start_match')) {
            // Set the type of karate when start click.
            $scores = KarateScore::where('event_id', '=', $id)->get();
            foreach ($scores as $s) {
                $s->type = $request->input('type');
                $s->update();
            }
        } else if ($request->exists('update_weight_class')) {
            // Update weight class (for kumite).
            $scores = KarateScore::where('event_id', '=', $id)->get();
            foreach ($scores as $s) {
                $s->weight_class = $request->input('weight_class');
                $s->update();
            }
        } else {
            // Update the score/place with the provided score_id
            $score = KarateScore::findOrFail($request->input('score_id'));
            $score->update($request->all());
        }

        return $this->show($id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
