<?php

use App\Http\Controllers\Sports\TableTennisController;
use App\Http\Controllers\Sports\VolleyBallController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ScoreController;  // use this as a preset for your sports controller
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dash\EventController;
use App\Http\Controllers\Dash\SportController;
use App\Http\Controllers\Dash\CategoryController;
use App\Http\Controllers\Sports\KarateController;
use App\Http\Controllers\Dash\DashboardController;
use App\Http\Controllers\Sports\CricketController;
use App\Http\Controllers\Sports\SwimmingController;
use App\Http\Controllers\Sports\RugbyController;
use App\Http\Controllers\Sports\FootballController;
use App\Http\Controllers\Sports\BasketballController;
use App\Http\Controllers\Dash\TournamentController;
use App\Http\Controllers\Dash\UniversityController;
use App\Http\Controllers\Sports\BadmintonController;
use App\Http\Controllers\Sports\BeachVolleyBallController;
use App\Http\Controllers\Sports\CarromController;
use App\Http\Controllers\Sports\ChessScoreController;
use App\Http\Controllers\Sports\KabaddiScoreController;
use App\Http\Controllers\Sports\HockeyController;
use App\Http\Controllers\Sports\RoadRaceController;
use App\Http\Controllers\Sports\TaekwondoController;
use App\Http\Controllers\Sports\WrestlingScoreController;




Route::get('/admin', [AuthController::class,'login'])->name('login');
Route::post('/admin', [AuthController::class,'loginPost'])->name('login.post');
Route::get('/register', [AuthController::class,'register'])->name('register');
Route::post('/register', [AuthController::class,'registerPost'])->name('register.post');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');
Route::group(['middleware'=>'auth'],function(){
    Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');


    Route::resource('/events', EventController::class) ->names([
        'index' => 'index.events',
        'create'=> 'create.events',
        'store'=>'store.events',
        'show'=>'show.events',
        'edit'=>'edit.events',
        'update'=>'update.events',
        'destroy' => 'delete.events'
    ]);

    Route::resource('/beachVolleyBall', BeachVolleyBallController::class)->names([
        'index' => 'index.beachVolleyBall',
        'create' => 'create.beachVolleyBall',
        'store' => 'store.beachVolleyBall',
        'show' => 'show.beachVolleyBall',
        'edit' => 'edit.beachVolleyBall',
        'update' => 'update.beachVolleyBall',
    ]);

    Route::post('/beachVolleyBall/updateScore', [BeachVolleyBallController::class, 'updateScore'])->name('updateScore.beachVolleyBall');
    Route::post('/beachVolleyBall/updateRound', [BeachVolleyBallController::class, 'updateRound'])->name('updateRound.beachVolleyBall');
    Route::delete('/beachVolleyBall/{event_id}/delete', [BeachVolleyBallController::class, 'destroy'])->name('destroy.beachVolleyBall');

    Route::resource('/kabaddi', KabaddiScoreController::class)->names([
        'index' => 'index.kabaddi',
        'create' => 'create.kabaddi',
        'store' => 'store.kabaddi',
        'show' => 'show.kabaddi',
        'edit' => 'edit.kabaddi',
        'update'=> 'update.kabaddi',
    ]);

    Route::post('/kabaddi/updateScore', [KabaddiScoreController::class, 'updateScore']);

    Route::delete('/kabaddi/{event_id}/delete', [KabaddiScoreController::class, 'destroy'])->name('destroy.kabaddi');
  
      Route::resource('/volleyBall', VolleyBallController::class)->names([
        'index' => 'index.volleyBall',
        'show' => 'show.volleyBall',
        'edit' => 'edit.volleyBall',
        'update' => 'update.volleyBall',
    ]);

    Route::patch('/volleyball/{id}/update-round', [VolleyBallController::class, 'updateRound'])->name('volleyball.updateRound');

    Route::post('/beachVolleyBall/updateScore', [BeachVolleyBallController::class, 'updateScore']);

    Route::post('/kabaddi/updateScore', [KabaddiScoreController::class, 'updateScore'])->name('updateScore.kabaddi');
    Route::delete('/kabaddi/{event_id}/delete', [KabaddiScoreController::class, 'destroy'])->name('destroy.kabaddi');

    Route::resource('/roadRace', RoadRaceController::class)->names([
        'index' => 'index.roadRace',
        'create' => 'create.roadRace',
        'store' => 'store.roadRace',
        'show' => 'show.roadRace',
        'edit' => 'edit.roadRace',
        'update' => 'update.roadRace',
    ]);

    Route::patch('/roadRace/updateScore', [RoadRaceController::class, 'update'])->name('updateScore.roadRace');
    Route::delete('/roadRace/{event_id}/delete', [RoadRaceController::class, 'destroy'])->name('destroy.roadRace');

    Route::resource('/hockey', HockeyController::class)->names([
        'index' => 'index.hockey',
        'create' => 'create.hockey',
        'store' => 'store.hockey',
        'show' => 'show.hockey',
        'edit' => 'edit.hockey',
        'update' => 'update.hockey',
        'destroy' => 'destroy.hockey',
    ]);
    
    Route::post('/hockey/updateScore', [HockeyController::class, 'update'])->name('updateScore.hockey');
    Route::delete('/hockey/{event_id}/delete', [HockeyController::class, 'destroy'])->name('destroy.hockey');


    Route::resource('/chess', ChessScoreController::class)->names([
        'index' => 'index.chess',
        'create' => 'create.chess',
        'store' => 'store.chess',
        'show' => 'show.chess',
        'edit' => 'edit.chess',
        'update' => 'update.chess',
        'destroy' => 'destroy.chess',
    ]);
    
    Route::post('/chess/updateScore', [ChessScoreController::class, 'updateScore'])->name('updateScore.chess'); 


    Route::resource('/wrestling', WrestlingScoreController::class)->names([
        'index' => 'index.wrestling',
        'create' => 'create.wrestling',
        'store' => 'store.wrestling',
        'show' => 'show.wrestling',
        'edit' => 'edit.wrestling',
        'update' => 'update.wrestling',
        'destroy' => 'destroy.wrestling',
    ]);
    
    Route::post('/wrestling/updateScore', [WrestlingScoreController::class, 'updateScore'])->name('updateScore.wrestling');
    Route::post('/wrestling/updatePeriod', [WrestlingScoreController::class, 'updatePeriod'])->name('updatePeriod.wrestling');    

    Route::resource('/taekwondo', TaekwondoController::class)->names([
        'index' => 'index.taekwondo',
        'create' => 'create.taekwondo',
        'store' => 'store.taekwondo',
        'show' => 'show.taekwondo',
        'edit' => 'edit.taekwondo',
        'update' => 'update.taekwondo',
    ]);

    Route::post('/taekwondo/updateScore', [TaekwondoController::class, 'updateScore'])->name('updateScore.taekwondo');
    Route::delete('/taekwondo/{event_id}/delete', [TaekwondoController::class, 'destroy'])->name('destroy.taekwondo');
    Route::post('/taekwondo/updateRound', [TaekwondoController::class, 'updateRound'])->name('updateRound.taekwondo');



    Route::patch('/beachVolleyBall/{eventId}/scores', [BeachVolleyBallController::class, 'getScores']);

    Route::resource('/badminton', BadmintonController::class) ->names([
        'show' => 'show.badminton',
    ]);

    Route::resource('/karate', KarateController::class) ->names([
        'show' => 'show.karate',
        'update' => 'update.karate'
    ]);

    Route::resource('/carrom', CarromController::class) ->names([
        'show' => 'show.carrom',
        'update' => 'update.carrom'
    ]);

    Route::resource('/cricket', CricketController::class) ->names([
        'show' => 'show.cricket',
    ]);
    Route::resource('/swimming', SwimmingController::class) ->names([
        'show' => 'show.swimming',
    ]);
    Route::resource('/rugby', RugbyController::class) ->names([
        'show' => 'show.rugby',
    ]);
    Route::resource('/football', FootballController::class) ->names([
        'show' => 'show.football',
    ]);
    Route::resource('/basketball', BasketballController::class) ->names([
        'show' => 'show.basketball',
    ]);


    Route::resource('/tournaments', TournamentController::class) ->names([
        'index' => 'get.tournaments',
        'destroy' => 'delete.tournaments'
    ]);
    Route::resource('/sports', SportController::class) ->names([
        'index' => 'get.sports'
    ]);
    Route::resource('/universities', UniversityController::class) ->names([
        'index' => 'get.universities',
        'destroy' => 'delete.universities'
    ]);
    Route::resource('/tournaments', TournamentController::class) ->names([
        'index' => 'get.tournaments'
    ]);
    Route::resource('/categories', CategoryController::class) ->names([
        'index' => 'get.categories',
        'destroy' => 'delete.categories'
    ]);

    Route::resource('/tableTennis', TableTennisController::class) ->names([
        'show' => 'show.tableTennis',
    ]);
});
