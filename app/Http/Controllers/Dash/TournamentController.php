<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Http\Requests\TournamentRequest;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['tournaments'] = DB::table('tournaments')->get();
        $data['nav'] = 'tournaments';
        return view('admin.tournaments',$data);
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
    public function store(TournamentRequest $request)
    {
        Tournament::create($request->validated());
        return redirect()->route('get.tournaments')->with('success', 'Event created successfully.');

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TournamentRequest $request, string $id)
    {
        $model = Tournament::find($id);
        $model->update($request->validated());
        return redirect()->route('get.tournaments');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Tournament::find($id);
        $model->delete();
        return redirect()->route('get.tournaments');    }
}
