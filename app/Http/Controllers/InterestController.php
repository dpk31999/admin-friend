<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Interest::all(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'url_icon' => 'required'
        ]);

        $interest = Interest::create($request->all());

        return response()->json($interest, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Interest  $interest
     * @return \Illuminate\Http\Response
     */
    public function show(Interest $interest)
    {
        return response()->json($interest, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Interest  $interest
     * @return \Illuminate\Http\Response
     */
    public function edit(Interest $interest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Interest  $interest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Interest $interest)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'url_icon' => 'required'
        ]);

        $interest->name = $request->name;
        $interest->url_icon = $request->url_icon;
        $interest->save();

        return response()->json($interest, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modes\Interest  $interest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Interest $interest)
    {
        $interest->delete();

        return response()->json([
            'status' => 'success'
        ], 200);
    }
}
