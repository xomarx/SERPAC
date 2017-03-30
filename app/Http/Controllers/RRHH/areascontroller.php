<?php

namespace App\Http\Controllers\RRHH;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\RRHH\Areas;

class areascontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $areas = DB::table('areas')
                ->get();
        return view('RRHH/areas',  compact('areas',$areas));
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
        $this->validate($request, ['area'=>'required|unique:areas,area']);
        if($request->ajax())
        {
            $area = Areas::create($request->all());
            if($area)
            {
                return response()->json(['success'=>true]);
            }
            else
            {
                return response()->json(['success'=>false]);
            }
        }
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
        $area = Areas::FindOrFail($id);
        return response()->json($area);
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
        $this->validate($request, ['area'=>'required']);
        if($request->ajax())
        {
            $area = Areas::FindOrFail($id);
            $area->area = $request->area;
            $area->save();
            if($area)
            {
                return response()->json(['success'=>true]);
            }
            else
            {
                return response()->json(['success'=>false]);
            }
        }
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
        $area = Areas::FindOrFail($id)->delete();
        if($area) return response ()->json (['success'=>true]);
    }
}
