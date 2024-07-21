<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Http\Requests\UniversityRequest;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['universities'] = DB::table('universities')->get();
        $data['nav'] = 'universities';
        return view('admin.universities',$data);

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
    public function store(UniversityRequest $request)
    {
        University::create($request->validated());
        return redirect()->route('get.universities')->with('success', 'University created successfully.');

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
    public function update(UniversityRequest $request, string $id)
    {
        $model = University::find($id);
        $model->update($request->validated());
        return redirect()->route('get.universities');    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = University::find($id);
        $model->delete();
        return redirect()->route('get.universities');
    }
}
