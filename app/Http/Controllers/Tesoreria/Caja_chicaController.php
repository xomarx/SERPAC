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
            $cajas = \App\Models\Tesoreria\Mov_cheque::AutoNumCheque($idcheque,$nombre);
            foreach ($cajas as $caja) 
            {
                $result[] = ['id' => $caja->id, 'value' => $caja->num_cheque,'monto'=>$caja->importe];
            }
            return response()->json($result);
        }
    }

    public function cajachica() {        
        $cheques = \App\Models\Tesoreria\Cheque::pluck('cheque', 'id');
        $cont = \App\Models\Tesoreria\Caja_chica::all()->count() + 1;
        return response ()->view('Tesoreria.CajaChicaModal', ['cheques' => $cheques, 'num' => $cont]);
    }
    
    public function headcajachica() {
//        $result[]='AÑOS';
//        for ($i = 2016; $i <= \Carbon\Carbon::now()->format('Y');$i++){
//            $result [$i]=$i;
//        }
//        return view('Tesoreria.headerCaja_chica', ['anios'=>$result]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        if(!auth()->user()->can('ver movimientos'))
            return response ()->view ('errors.403-content');  
        $result[]='AÑOS';
        for ($i = 2016; $i <= \Carbon\Carbon::now()->format('Y');$i++){
            $result [$i]=$i;
        }
        $cajas = \App\Models\Tesoreria\Caja_chica::listaCaja_Chica(0,0,'');
        return view('Tesoreria.movCajaChica',['anios'=>$result,'cajas'=>$cajas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cheques = \App\Models\Tesoreria\Cheque::pluck('cheque', 'id');
        $cont = \App\Models\Tesoreria\Caja_chica::all()->count() + 1;
        return response ()->view('Tesoreria.CajaChica', ['cheques' => $cheques, 'num' => $cont]);
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
            'caja'=>'required|unique:caja_chicas,num_caja',
           'lischeque'=>'required',
            'numero'=>'required|numeric|exists:mov_cheques,num_cheque',
            'importe'=>'required|numeric'
        ]);
        if(!auth()->user()->can('crear movimientos'))
            return response ()->view ('errors.403-content',[],403);
        $movcheque = \App\Models\Tesoreria\Mov_cheque::where('num_cheque','=',$request->numero)
                ->where('cheques_id','=',$request->lischeque)->select('id')->first();
        $caja = \App\Models\Tesoreria\Caja_chica::create([            
            'num_caja'=>$request->caja,
            'importe'=>$request->importe,
            'mov_cheques_id'=>$movcheque->id,
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
        if(!auth()->user()->can('editar movimientos'))
            return response ()->view ('errors.403-content',[],403);
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
        if(!auth()->user()->can('eliminar movimientos'))
            return response ()->view ('errors.403-content',[],403);
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
