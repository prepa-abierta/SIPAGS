<?php

namespace App\Http\Controllers\Paises;

use App\Http\Controllers\Controller;
use App\Model\Pais\Pais;
use Illuminate\Http\Request;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return response()->json(Pais::orderBy('Pais_Dsc', 'ASC')->get());

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
     * @param  \App\pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function show(pais $pais)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function edit(pais $pais)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pais $pais)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function destroy(pais $pais)
    {
        //
    }
}
