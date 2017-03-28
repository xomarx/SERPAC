<?php

namespace App\Http\Controllers\Tesoreria;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Caja_chicaController extends Controller
{
    public function autoNumCheque(Request $request,$idcheque){
        if($request->ajax()){
            $nombre = \Illuminate\Support\Facades\Input::get('term');
            $cajas = \App\Models\Tesoreria\Caja_chica::listNumCheque($idcheque,$nombre);
            foreach ($cajas as $caja) 
            {
                $result[] = ['id' => $caja->id, 'value' => $caja->num_cheque];
            }
            return response()->json($result);
        }
    }

        public function cajachica(){
        $cheques = \App\Models\Tesoreria\Cheque::pluck('cheque','id');
        $cont = \App\Models\Tesoreria\Caja_chica::all()->count() + 1;
        return view('Tesoreria.cajaChica',['cheques'=>$cheques,'num'=>$cont]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cajas = \App\Models\Tesoreria\Caja_chica::listaCaja_Chica();
        return view('Tesoreria.listaCajaChica',['cajas'=>$cajas]);
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
        $this->validate($request, [
           'lischeque'=>'required',
            'numero'=>'required|numeric|exists:mov_cheques,num_cheque',
            'importe'=>'required|numeric'
        ]);
        $numero = \App\Models\Tesoreria\Caja_chica::all()->count() + 1;
        $numero = "CAJA CHICA " . $numero;
        $caja = \App\Models\Tesoreria\Caja_chica::create([            
            'num_caja'=>$numero,
            'importe'=>$request->importe,
            'mov_cheques_id'=>$request->lischeque,
            'users_id'=>  auth()->id()
        ]);
        
        if($caja) return response ()->json (['success'=>true,'message'=>'Se registro Correctamente']);
        else return response ()->json (['success'=>false,'message'=>'No se registro ninguna dato']);
        
        
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
        $caja = \App\Models\Tesoreria\Caja_chica::getCaja($id);
        return response()->json($caja);
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
        $this->validate($request, [
           'lischeque'=>'required',
            'numero'=>'required|numeric|exists:mov_cheques,num_cheque',
            'importe'=>'required|numeric'
        ]);
        $caja = \App\Models\Tesoreria\Caja_chica::FindOrFail($id);
        $caja->importe=$request->importe;
        $caja->mov_cheques_id=$request->lischeque;
        $caja->users_id=  auth()->id();
        $caja->save();
        if($caja) return response ()->json (['success'=>true,'message'=>'Se actualizaron correctamente los datos']);
        else return response ()->json (['success'=>false,'message'=>'No se actualizaron ningun dato']);
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
        $caja = \App\Models\Tesoreria\Caja_chica::FindOrFail($id);
        $temp = str_split($caja->num_caja, 11);
        $numero = \App\Models\Tesoreria\Caja_chica::all()->count();          
        if( $temp[1] == $numero)
        { 
            $caja->delete(); 
            return response()->json(['success'=>true]);
        }                        
    }
}
