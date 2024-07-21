<?php

namespace App\Http\Controllers\Dash;

use App\Http\Resources\BadmintonScoreResource;
use App\Http\Resources\TableTennisScoreResource;
use App\Http\Resources\VolleyBallScoreResource;
use App\Models\BadmintonScore;
use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\Sport;
use App\Models\Category;
use App\Models\TableTennisScore;
use App\Models\Tournament;
use App\Models\University;
use App\Models\CricketScore;
use App\Models\VolleyballScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Laravel\Prompts\Concerns\Events;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['universities'] = University::getUniversities();
        $data['events'] = Event::getEvents();
        $data['sports'] = Sport::getSports();
        $data['tournaments'] = Tournament::getTournaments();
        $data['categories'] = Category::getCategories();
        $data['nav'] = 'events';
        return view('admin.Events.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['universities'] = University::getUniversities();
        $data['events'] = Event::getEvents();
        $data['sports'] = Sport::getSports();
        $data['tournaments'] = Tournament::getTournaments();
        $data['categories'] = Category::getCategories();
        $data['nav'] = 'events';
        return view('admin.Events.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status'=>'required|in:live,past,upcoming',
            'livestream_link' =>'nullable',
            'event_date' => 'required|date',
            'winning_status'=>'nullable|in:won,drawn,cancelled,ongoing,notstarted',
            'winner_uni_id' => 'nullable',
            'teams' => 'required|array|min:1',
            'sport_id' => 'required',
            'tournament_id' => 'required',
            'category_id' => 'required',

            // Add other fields validation as required
        ]);

        $event = Event::create($validatedData);

        foreach ($validatedData['teams'] as $i => $uni_id) {
            EventParticipant::create([
                'event_id' => $event->event_id,
                'uni_id' => $uni_id
            ]);
        }

        return redirect()->route('index.events')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::getEvent($id);

        $team_ids = array();

        foreach ($event->participants as $i => $u) {
            array_push($team_ids, $u->uni_id);
        }

        $data['event']=$event;
        $data['team_ids']=$team_ids;
        $data['sports'] = Sport::getSports();
        $data['tournaments'] = Tournament::getTournaments();
        $data['categories'] = Category::getCategories();
        $data['universities'] = University::getUniversities();
        $data['nav'] = 'events';
        return view('admin.Events.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status'=>'required|in:live,past,upcoming',
            'livestream_link' =>'nullable',
            'event_date' => 'required|date',
            'winning_status'=>'nullable|in:won,drawn,cancelled,ongoing,notstarted',
            'winner_uni_id' => 'nullable',
            'teams' => 'required|array|min:2',
            'sport_id' => 'required',
            'tournament_id' => 'required',
            'category_id' => 'required',

        ]);

        $event = Event::find($id);

        $event->update($validatedData);

        // delete participants
        foreach ($event->participants as $i => $p) {
            $p->delete();
        }

        // re-insert participants
        foreach ($validatedData['teams'] as $i => $uni_id) {
            EventParticipant::create([
                'event_id' => $event->event_id,
                'uni_id' => $uni_id
            ]);
        }

        return redirect()->route('index.events')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('index.events')->with('success', 'Event deleted successfully.');

    }
    /* frontend api functions */
    public function all(){

        $events = DB::table('events')
        ->join('sports', 'events.sport_id', '=', 'sports.sport_id')
        ->join('categories', 'events.category_id', '=', 'categories.category_id')
        ->join('tournaments', 'events.tournament_id', '=', 'tournaments.tournament_id')
        ->select(
            'events.event_id',
            'events.name as event_name',
            'events.status',
            'events.livestream_link',
            'events.event_date',
            'events.winner_uni_id',
            'sports.name as sport_name',
            'categories.name as category_name',
            'tournaments.name as tournament_name'
        )
        ->get();

        foreach ($events as $event) {
            $event->participants = DB::table('event_participants')
            ->join('universities', 'event_participants.uni_id', '=', 'universities.uni_id')
                ->where('event_id', $event->event_id)
                ->select('event_participants.uni_id','universities.name','universities.img_url')
                ->get();
        }

        return response()->json($events);
    }
    public function eventFilterByStatus($status){
        $allowedStatuses = ['past', 'upcoming', 'live'];
        if (!in_array($status, $allowedStatuses)) {
            return response()->json(['error' => 'Invalid status'], 400);
        }


        $results = DB::table('events')
        ->join('sports','events.sport_id','=','sports.sport_id')
        ->join('categories','events.category_id','=','categories.category_id')
        ->join('tournaments','events.tournament_id','=','tournaments.tournament_id')
        ->select(
            'events.event_id',
            'events.name as event_name',
            'events.status',
            'events.livestream_link',
            'events.event_date',
            'events.winner_uni_id',
            'events.winning_status',
            'sports.sport_id as sport_id',
            'sports.name as sport_name',
            'categories.name as category_name',
            'tournaments.name as tournament_name',
            'events.tournament_id',

        )
        ->where('events.status',$status)
        ->get();
        foreach ($results as $result) {
            // $result->participants = DB::table('event_participants')
            // ->join('universities', 'event_participants.uni_id', '=', 'universities.uni_id')
            //     ->where('event_id', $result->event_id)
            //     ->select('event_participants.uni_id','universities.name','universities.img_url')
            //     ->get();
            $uni_id = $result->winner_uni_id;
            if($uni_id != NULL){
                $result->winner = University::getRecord($uni_id,['name','img_url']);
            }
            $sport_id = $result->sport_id;
            $event_id = $result->event_id;
            if($sport_id == 1){
                $result->scores = CricketScore::where('event_id', '=', $event_id)->get();
            }else if($sport_id == 2){
                $result->scores = DB::table('swimming_scores')
                ->join('universities as team', 'swimming_scores.university_id', '=', 'team.uni_id')
                ->select(
                    'swimming_scores.*',
                    'team.name',
                    'team.img_url'
                    )
                ->where('event_id','=',$event_id)
                ->get();
            }
            else if($sport_id == 3){
                $result->scores = DB::table('karate_scores')
                ->join('universities as team', 'karate_scores.university_id', '=', 'team.uni_id')
                ->select(
                    'karate_scores.*',
                    'team.name',
                    'team.img_url'
                    )
                ->where('event_id','=',$event_id)
                ->get();
            }else if($sport_id == 4){
                $result->scores = BadmintonScoreResource::collection(BadmintonScore::where('event_id', '=', $event_id)->get());

            }
            else if($sport_id == 5){
                $result->scores = DB::table('beach_volleyball_scores')
                ->join('universities as team', 'beach_volleyball_scores.university_id', '=', 'team.uni_id')
                ->select(
                    'team.name',
                    'team.img_url',
                    'beach_volleyball_scores.set_1_score',
                    'beach_volleyball_scores.set_2_score',
                    'beach_volleyball_scores.set_3_score',
                    'beach_volleyball_scores.round',
                    )
                ->where('event_id','=',$event_id)
                ->get();
            }
            else if($sport_id == 10){
                $result->scores = VolleyBallScoreResource::collection(VolleyballScore::where('event_id', '=', $event_id)->get());

            }
            else if($sport_id == 6){
                $result->scores = DB::table('table_tennis_scores')
                ->join('universities as team', 'table_tennis_scores.university_id', '=', 'team.uni_id')
                ->select(
                    'table_tennis_scores.*',
                    'team.name',
                    'team.img_url'
                    )
                ->where('event_id','=',$event_id)
                ->get();

            }
            else if($sport_id == 7){
                $result->scores= DB::table('kabaddi_scores')
                ->join('universities as team', 'kabaddi_scores.uni_id', '=', 'team.uni_id')
                ->select(
                    'team.name',
                    'team.img_url',
                    'kabaddi_scores.raid_points',
                    'kabaddi_scores.bonus_points',
                    'kabaddi_scores.tackle_points',
                    'kabaddi_scores.all_out_points',
                    'kabaddi_scores.total_score',
                    )
                ->where('event_id','=',$event_id)
                ->get();

            }
            else if($sport_id == 8){
                $result->scores = DB::table('carrom_scores')
                ->join('universities as team', 'carrom_scores.university_id', '=', 'team.uni_id')
                ->select(
                    'carrom_scores.*',
                    'team.name',
                    'team.img_url'
                    )
                ->where('event_id','=',$event_id)
                ->get();

            }else if($sport_id == 9){
                $result->scores = DB::table('rugby_scores')
                ->join('universities as team', 'rugby_scores.university_id', '=', 'team.uni_id')
                ->select(
                    'rugby_scores.*',
                    'team.name',
                    'team.img_url'
                    )
                ->where('event_id','=',$event_id)
                ->get();
            }
            else if($sport_id == 11){
                $result->scores = DB::table('road_race_scores')
                ->join('universities as team', 'road_race_scores.university_id', '=', 'team.uni_id')
                ->select(
                    'road_race_scores.*',
                    'team.name',
                    'team.img_url'
                    )
                ->where('event_id','=',$event_id)
                ->get();
            }
            else if($sport_id == 12){
                $result->scores = DB::table('basketball_scores')
                ->join('universities as team', 'basketball_scores.university_id', '=', 'team.uni_id')
                ->select(
                    'basketball_scores.*',
                    'team.name',
                    'team.img_url'
                    )
                ->where('event_id','=',$event_id)
                ->get();
            }
            else if($sport_id == 13){
                $result->scores = DB::table('hockey_scores')
                ->join('universities as team', 'hockey_scores.university_id', '=', 'team.uni_id')
                ->select(
                    'team.name',
                    'team.img_url',
                    'hockey_scores.goals',
                    'hockey_scores.shots',
                    'hockey_scores.circle_penetrations',
                    'hockey_scores.penalty_corners',
                    'hockey_scores.green_cards',
                    'hockey_scores.yellow_cards',
                    'hockey_scores.red_cards',
                    )
                ->where('event_id','=',$event_id)
                ->get();
            }
            else if($sport_id == 14){
                $result->scores = DB::table('football_scores')
                ->join('universities as team', 'football_scores.university_id', '=', 'team.uni_id')
                ->select(
                    'football_scores.*',
                    'team.name',
                    'team.img_url'
                    )
                ->where('event_id','=',$event_id)
                ->get();
            }
            else if($sport_id == 17){
                $result->scores = DB::table('taekwondo_scores')
                ->join('universities as team', 'taekwondo_scores.university_id', '=', 'team.uni_id')
                ->select(
                    'taekwondo_scores.score',
                    'taekwondo_scores.penalty',
                    'taekwondo_scores.round',
                    'team.name',
                    'team.img_url'
                    )
                ->where('event_id','=',$event_id)
                ->get();
            }
            else if($sport_id == 18){
                $result->scores = DB::table('wrestling_scores')
                ->join('universities as team', 'wrestling_scores.university_id', '=', 'team.uni_id')
                ->select(
                    'wrestling_scores.score',
                    'wrestling_scores.period',

                    'team.name',
                    'team.img_url'
                    )
                ->where('event_id','=',$event_id)
                ->get();
            }
            else if($sport_id == 22){
                $result->scores = DB::table('chess_scores')
                ->join('universities as team', 'chess_scores.university_id', '=', 'team.uni_id')
                ->select(
                    'chess_scores.match_1_score',
                    'chess_scores.match_2_score',
                    'chess_scores.match_3_score',
                    'chess_scores.match_4_score',
                    'chess_scores.match_5_score',
                    'chess_scores.match_6_score',
                    'chess_scores.total_score',
                    'team.name',
                    'team.img_url'
                    )
                ->where('event_id','=',$event_id)
                ->get();
            }

        }

    return response()->json($results);}

    public function scores($id){
        $result = DB::table('events')
        ->select('sport_id','event_id')
        ->where('event_id','=',$id)
        ->first();

        if($result){
            $sportId = $result->sport_id;
            $eventId = $result->event_id;
            if($sportId == 3){
                $data = DB::table('karate_scores')
                ->join('universities as team', 'karate_scores.university_id', '=', 'team.uni_id')
                ->select(
                    'karate_scores.*',
                    'team.name',
                    'team.img_url'
                    )
                ->where('event_id','=',$eventId)
                ->get();
                return response()->json($data);
            }
            else if($sportId == 1){
                $scores = CricketScore::where('event_id', '=', $eventId)->get();
                return response()->json($scores);
            }
            else if($sportId == 5){
                $data = DB::table('beach_volleyball_scores')
                ->join('universities as team', 'beach_volleyball_scores.university_id', '=', 'team.uni_id')
                ->select(
                    'beach_volleyball_scores.*',
                    'team.name',
                    'team.img_url'
                    )
                ->where('event_id','=',$eventId)
                ->get();
                return response()->json($data);
            }
            else if($sportId == 4){
                $data = BadmintonScoreResource::collection(BadmintonScore::where('event_id', '=', $eventId)->get());
                return response()->json($data);
            }

            else if($sportId == 10){
                $data = VolleyBallScoreResource::collection(VolleyballScore::where('event_id', '=', $eventId)->get());
                return response()->json($data);
            }
            else if($sportId == 6){
                $data = TableTennisScoreResource::collection(TableTennisScore::where('event_id', '=', $eventId)->get());
                return response()->json($data);
            }
            else if($sportId == 7){
                $data = DB::table('kabaddi_scores')
                ->join('universities as team', 'kabaddi_scores.uni_id', '=', 'team.uni_id')
                ->select(
                    'kabaddi_scores.*',
                    'team.name',
                    'team.img_url'
                    )
                ->where('event_id','=',$eventId)
                ->get();
                return response()->json($data);
            }
            else if($sportId == 8){
                $data = DB::table('carrom_scores')
                ->join('universities as team', 'carrom_scores.university_id', '=', 'team.uni_id')
                ->select(
                    'carrom_scores.*',
                    'team.name',
                    'team.img_url'
                    )
                ->where('event_id','=',$eventId)
                ->get();
                return response()->json($data);
            }
            else if($sportId == 2){
                $data = DB::table('swimming_scores')
                ->join('universities as team', 'swimming_scores.university_id', '=', 'team.uni_id')
                ->select(
                    'swimming_scores.*',
                    'team.name',
                    'team.img_url'
                    )
                ->where('event_id','=',$eventId)
                ->get();
                return response()->json($data);
            }
        }
    }
    public function eventFilterByCategory($category){
        $allowedCategories = ['men', 'women','mensTeam','womensTeam'];
        if (!in_array($category, $allowedCategories)) {
            return response()->json(['error' => 'Invalid category'], 400);
        }
        $categoryData = DB::table('categories')
        ->select('*')->where('name','=',$category)->first();
        if($categoryData){
            $category_id = $categoryData->category_id;
            $results = DB::table('events')
            ->join('sports','events.sport_id','=','sports.sport_id')
            ->join('categories','events.category_id','=','categories.category_id')
            ->join('tournaments','events.tournament_id','=','tournaments.tournament_id')
            ->select(
                'events.event_id',
                'events.name as event_name',
                'events.status',
                'events.livestream_link',
                'events.event_date',
                'events.winner_uni_id',
                'sports.name as sport_name',
                'categories.name as category_name',
                'tournaments.name as tournament_name',
                'events.tournament_id',

            )
            ->where('events.category_id','=',$category_id)
            ->get();
            foreach ($results as $result) {
                $result->participants = DB::table('event_participants')
                ->join('universities', 'event_participants.uni_id', '=', 'universities.uni_id')
                    ->where('event_id', $result->event_id)
                    ->select('event_participants.uni_id','universities.name','universities.img_url')
                    ->get();
            }
            return response()->json($results);
        }
        //return response()->json($categoryData);
        }
        /* frontend api functions end */
}
