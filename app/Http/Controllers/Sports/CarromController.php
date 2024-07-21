<?php

namespace App\Http\Controllers\Sports;

use App\Models\Event;
use App\Models\Sport;
use App\Models\Category;
use App\Models\Tournament;
use App\Models\University;
use App\Models\CarromScore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarromController extends Controller
{
    //
    public function show(string $id)
    {
        $data['nav'] = 'events';
        $data['universities'] = University::getUniversities();
        $data['event'] = Event::getEvent($id);
        $data['sports'] = Sport::getSports();
        $data['tournaments'] = Tournament::getTournaments();
        $data['categories'] = Category::getCategories();

        $scores = CarromScore::where('event_id', $id)->get();
        
        if ($scores->isEmpty()) {
            
            $event = Event::find($id);
            // If no scores exist, create two new rows for the event_id
            CarromScore::create(['event_id' => $id, 'university_id' => $event->team1_uni_id, 'score' => 0, 'points' => 0]);
            CarromScore::create(['event_id' => $id, 'university_id' => $event->team2_uni_id, 'score' => 0, 'points' => 0]);

            // Fetch the newly created scores
            $scores = CarromScore::where('event_id', $id)->get();
        }
        else{
            $data['scores'] = CarromScore::where('event_id', $id)->get();
        }
        
        
        foreach ($scores as $score) {
            // Fetch university record using the getSingleRecord method
            $university = University::getSingleRecord($score->university_id);

            $score->university_name = $university->name;
            $score->university_img = $university->img_url;
        }
        
        $data['scores'] = $scores;


        return view('admin.Carrom.index',$data);

    }

    public function update(Request $request, $id)
    {
        // Update the score with the provided score_id
        $score = CarromScore::findOrFail($request->input('score_id'));
        $score->update(['score' => $request->input('score')]);

        return redirect()->route('show.carrom', ['carrom' => $request->input('event_id')]);


    }


}
