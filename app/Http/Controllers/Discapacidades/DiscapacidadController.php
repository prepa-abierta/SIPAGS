<?php

namespace App\Http\Controllers\Discapacidades;

use App\Http\Controllers\Controller;
use App\Model\Discapacidad\Discapacidad;
use Illuminate\Http\Request;

class DiscapacidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Discapacidad::orderBy('Discapacidad_Dsc', 'ASC')->get());
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Discapacidad  $discapacidad
     * @return \Illuminate\Http\Response
     */
    public function show(Discapacidad $discapacidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discapacidad  $discapacidad
     * @return \Illuminate\Http\Response
     */
    public function edit(Discapacidad $discapacidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discapacidad  $discapacidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discapacidad $discapacidad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discapacidad  $discapacidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discapacidad $discapacidad)
    {
        //
    }
}
