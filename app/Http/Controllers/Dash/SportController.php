<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Http\Requests\SportRequest;
use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['sports'] = DB::table('sports')->get();
        $data['nav'] = 'sports';
        return view('admin.sports',$data);

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
    public function store(SportRequest $request)
    {
        Sport::create($request->validated());
        return redirect()->route('get.sports')->with('success', 'Event created successfully.');

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
    public function update(SportRequest $request, string $id)
    {
        $model = Sport::find($id);
        $model->update($request->validated());
        return redirect()->route('get.sports');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Sport::find($id);
        $model->delete();
        return redirect()->route('get.sports');
    }
}
