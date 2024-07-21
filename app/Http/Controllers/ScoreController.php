<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Sport;
use App\Models\Category;
use App\Models\Tournament;
use App\Models\University;
use Illuminate\Http\Request;

class ScoreController extends Controller
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

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['nav'] = 'events';
        $data['universities'] = University::getUniversities();
        $data['event'] = Event::getEvent($id);
        $data['sports'] = Sport::getSports();
        $data['tournaments'] = Tournament::getTournaments();
        $data['categories'] = Category::getCategories();
        return view('admin.BeachVolleyBall.index',$data);
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
    public function update(Request $request, string $id)
    {
 }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
