<?php

namespace App\Http\Controllers;

use App\Models\TransaksiDetail;
use App\Http\Requests\StoreTransaksiDetailRequest;
use App\Http\Requests\UpdateTransaksiDetailRequest;

class TransaksiDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreTransaksiDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransaksiDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransaksiDetail  $transaksiDetail
     * @return \Illuminate\Http\Response
     */
    public function show(TransaksiDetail $transaksiDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransaksiDetail  $transaksiDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(TransaksiDetail $transaksiDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransaksiDetailRequest  $request
     * @param  \App\Models\TransaksiDetail  $transaksiDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransaksiDetailRequest $request, TransaksiDetail $transaksiDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransaksiDetail  $transaksiDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransaksiDetail $transaksiDetail)
    {
        //
    }
}
