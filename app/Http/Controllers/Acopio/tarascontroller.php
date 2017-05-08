<?php

namespace App\Http\Controllers\Acopio;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class tarascontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sunatruc = new \Tecactus\Sunat\RUC('eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjgyZjlmOTczMjM1ZDUzZDZlZDJhZGE4ZDEyZmNhN2Q2ZDRjZGI5YzlmOWQwZjA2ZjU3YjBkY2JjYzcyYmQ0ZjkwMDM3Y2MzMzdjYjFmOGMw'
                . 'In0.eyJhdWQiOiIxIiwianRpIjoiODJmOWY5NzMyMzVkNTNkNmVkMmFkYThkMTJmY2E3ZDZkNGNkYjljOWY5ZD'
                . 'BmMDZmNTdiMGRjYmNjNzJiZDRmOTAwMzdjYzMzN2NiMWY4YzAiLCJpYXQiOjE0OTQxNjI1MzUsIm5iZiI6MTQ5'
                . 'NDE2MjUzNSwiZXhwIjoxODA5Njk1MzM1LCJzdWIiOiIyNDciLCJzY29wZXMiOlsidXNlLXN1bmF0IiwidXNlLX'
                . 'JlbmllYyJdfQ.N2eRSiJWKj8NfuKpvi6AjLBl5cpxaNyeB2W5qF1AQkYg40ve9v9USZpvfUUoEw1TQ9YEWkl0N'
                . 'DK2Mhg5uoZkW6_D0DR5sPO_Vm1Ai3ffhX51VhDMi41VSyfWgGnBm36qAySj7DaIx_AYv0XDmZkz08406L31G_lb'
                . 'zCpVVLU-0a-63N0R44uJEdhile1cGbsrELdeKF4vlL6NLdqAYiWP0_ieZNbw6MBxVTlhgB-HtlRdVJjk7BoSKi4'
                . 'OEWZuca5iDjbP4cZR6F4IGkFRVFZLRmzwAYigmsX7FfH0ikkgw4cdD8QmDlTP8BQLvcr1cl-v2YrFCDlaOIBr-cd'
                . 'xEotYQXjlzjrjSZdzXYsE3OcVzMaBQBWImQZQBLoH0BBl5zwjHxgV7w6QmEoq2Xk0B5wAVxVO1s812zcXs9EXKJX'
                . 'BhcjVUagio05Jx368ZJgw8VhsBlnIYAInwLAJmwySU9see0pc8_9QK25qqvuftEdrIal9XcQ2HwBmTl2PxBUu5-Uj'
                . 'kXmTHk9A9DUSd3ShTmMzDHrBTny3ttRZWbx189RBHYHUC7trgitvGs-wFeIHaXPKgqUowB97DPmQ6t-VVAOM9XVjgG'
                . '1kdDiW0DjY8s8EyKOeVl-yywgjY8e2U4CryKKw92h-u37fJrY3M2vc1WVzMFrZpo_mwydtM1zmiBcqy9Y');
//        $resul = $sunatruc->getByRuc('10456510626');
//        $resul=$sunatruc->getByRuc('10456510626', true);
//        dd($sunatruc);
        return view('Acopio.taras',['sunat'=>$sunatruc]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
