<?php

namespace App\Http\Controllers\Sports;

use App\Http\Controllers\Controller;
use App\Http\Requests\TableTennisScoreRequest;
use App\Models\BadmintonScore;
use App\Models\Event;
use App\Models\TableTennisScore;
use Illuminate\Http\Request;

class TableTennisController extends Controller
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
        $scores = TableTennisScore::getScoresByEventId($id)->toArray();
        $event = Event::find($id);
        $uni_1 = $event->team1University;
        $uni_2 = $event->team2University;

        if (empty($scores)) {
            array_push($scores, TableTennisScore::create([
                'event_id' => $id,
                'university_id' => $uni_1->uni_id,
            ]));
            array_push($scores, TableTennisScore::create([
                'event_id' => $id,
                'university_id' => $uni_2->uni_id,
            ]));
        }

        $data['nav'] = 'events';
        $data['uni_1'] = $uni_1;
        $data['uni_2'] = $uni_2;
        $data['event'] = $event;
        $data['scores'] = $scores;
        return view('admin.TableTennis.index',$data);
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
    public function update(TableTennisScoreRequest $request, string $id)
    {
        $model = TableTennisScore::find($request->validated()['id']);
        $model->update($request->validated());

        $scores = TableTennisScore::getScoresByEventId($model->event_id);

        foreach ($scores as $score) {
            if ($model->score_id == $score->score_id) {
                continue;
            } else {
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
                if ($model->set4_marks > -1 && $score->set4_marks == -1) {
                    $score->set4_marks = 0;
                    $score->update();
                }
                if ($model->set5_marks > -1 && $score->set5_marks == -1) {
                    $score->set5_marks = 0;
                    $score->update();
                }
                if ($model->set6_marks > -1 && $score->set6_marks == -1) {
                    $score->set6_marks = 0;
                    $score->update();
                }
                if ($model->set7_marks > -1 && $score->set7_marks == -1) {
                    $score->set7_marks = 0;
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
        //
    }
}
