<?php

namespace App\Http\Controllers\Sports;

use App\Models\Event;
use App\Models\Sport;
use App\Models\Category;
use App\Models\Tournament;
use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BadmintonScoreRequest;
use App\Models\BadmintonScore;

class BadmintonController extends Controller
{
    public function index()
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)

    {

        $scores = BadmintonScore::getScoresByEventId($id)->toArray();
        $event = Event::find($id);
        $uni_1 = $event->team1University;
        $uni_2 = $event->team2University;

        if (empty($scores)) {
            array_push($scores, BadmintonScore::create([
                'event_id' => $id,
                'university_id' => $uni_1->uni_id,
            ]));
            array_push($scores, BadmintonScore::create([
                'event_id' => $id,
                'university_id' => $uni_2->uni_id,
            ]));
        }


        $data['nav'] = 'events';
        $data['uni_1'] = $uni_1;
        $data['uni_2'] = $uni_2;
        $data['event'] = $event;
        $data['scores'] = $scores;

        $data['sports'] = Sport::getSports();
        $data['tournaments'] = Tournament::getTournaments();
        $data['categories'] = Category::getCategories();

        return view('admin.Badminton.index',$data);
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
    public function update(BadmintonScoreRequest $request, string $id)

    {

        $model = BadmintonScore::find($request->validated()['id']);
        $model->update($request->validated());

        $scores = BadmintonScore::getScoresByEventId($model->event->event_id);


        foreach ($scores as $score) {
            if($model->score_id == $score->score_id){
                continue;
            }else {
                if ($model->set1_marks > -1 && $score->set1_marks == -1) {
                    $score->set1_marks = 0;
                    $score->update();
                }
                if ($model->set2_marks > -1 && $score->set2_marks == -1) {
                    $score->set2_marks = 0;
                    $score->update();
                }
                if ($model->set3_marks > -1 && $score->set3_marks == -1) {
                    $score->set3_marks = 0;
                    $score->update();
                }
            }
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
