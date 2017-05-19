<?php

namespace App\Http\Controllers\Tesoreria;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Dompdf\Renderer\Image;
use Illuminate\Support\Facades\Storage;

class Mov_chequeController extends Controller
{
    
    public function uploadImage(Request $request){        
        $this->validate($request, ['filecheque'=>'required|image']);        
        $file = $request->file('filecheque');
        $nombre = \Carbon\Carbon::now()->format('d-m-Y');
        $nombre = ''.$nombre.'-'.$file->getClientOriginalName();
        $path = Storage::disk('cheques')->put($nombre,  \File($file));                     
        $ruta = "/storage/app/cheques/".$nombre;
        
        if($path) return response()->json(['success'=>true,'ruta'=>$ruta]);
        else return response()->json(['success'=>false,'ruta'=>"No se cargo ninguna imagen"]);
    }
    
    public function numCheque($idcheque){
        $numero = \App\Models\Tesoreria\Mov_cheque::select(\Illuminate\Support\Facades\DB::raw('max(num_cheque) as numero'))
                ->where('cheques_id','=',$idcheque)->first();
        return response()->json(['numero'=>$numero]);
    }

    public function movcheque() {
        $cheques = \App\Models\Tesoreria\Cheque::pluck('cheque', 'id');        
        return view('Tesoreria.movcheque', ['cheques' => $cheques]);
    }
    
    public function headmovcheque() {
        $result[]='AÑOS';
        for ($i = 2016; $i <= \Carbon\Carbon::now()->format('Y');$i++){
            $result [$i]=$i;
        }        
        return view('Tesoreria.headMov_cheques', ['anios'=>$result]);
    }
    
    public function listMovcheques($anio,$mes,$dato=''){
        if(!auth()->user()->can('ver movimientos'))
            return response ()->view ('errors.403-content');
        $movcheques = \App\Models\Tesoreria\Mov_cheque::listaMovCheques($anio,$mes,$dato);
                
        return response()->view('Tesoreria.listaMovCheques',['cheques'=>$movcheques]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        if(!auth()->user()->can('ver movimientos'))
            return response ()->view ('errors.403');
        $caja = \App\Models\Tesoreria\Caja::wheredate('fecha','=', \Carbon\Carbon::now()->format('Y-m-d'))->count();
        $movcheques = \App\Models\Tesoreria\Mov_cheque::listaMovCheques(0,0,'');
        $result[]='AÑOS';
        for ($i = 2016; $i <= \Carbon\Carbon::now()->format('Y');$i++){
            $result [$i]=$i;
        }
        return response()->view('Tesoreria.cheques_girados',['cheques'=>$movcheques,'anios'=>$result,'estado'=>$caja]);
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
    public function store(Requests\Tesoreria\MovChequeRequest $request)
    {
        if($request->ajax()){
            if(!auth()->user()->can('crear movimientos'))
                return response ()->view ('errors.403-content',[],403);
            $movcheque = \App\Models\Tesoreria\Mov_cheque::create([
                'num_cheque'=>$request->numero,
                'concepto'=>  strtoupper($request->concepto),
                'estado'=>'COPIA DE CHEQUE',
                'url_cheque'=>$request->idurl,
                'cheques_id'=>$request->cheque,
                'users_id'=>  auth()->id(),
                'personas_dni'=>$request->dni,
                'importe'=>$request->importe
            ]);
            if($movcheque) return response ()->json (['success'=>true,'message'=>'Se Registro Correctamente']);
            else return response ()->json (['success'=>false,'message'=>'No se Registro ningun dato']);
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
        $movcheque = \App\Models\Tesoreria\Mov_cheque::getMovCheque($id);
        $tipo = \App\Models\Socios\Socio::where('dni','=',$movcheque->dni)->count();
        return response()->json(['movcheque'=>$movcheque,'tipo'=>$tipo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\Tesoreria\MovChequeRequest $request, $id)
    {
        if($request->ajax()){
            if(!auth()->user()->can('editar movimientos'))
                return response ()->view ('errors.403-content',[],403);
            $movcheque = \App\Models\Tesoreria\Mov_cheque::FindOrFail($id);
            $movcheque->num_cheque=$request->numero;
            $movcheque->concepto= strtoupper($request->concepto);
            $movcheque->estado='COPIA DE CHEQUE';
            $movcheque->url_cheque=$request->idurl;
            $movcheque->cheques_id=$request->cheque;
            $movcheque->users_id=auth()->id();
            $movcheque->personas_dni=$request->dni;
            $movcheque->importe=$request->importe;
            $movcheque->save();
            if($movcheque) return response ()->json (['success'=>true,'message'=>'Se Actualizo Correctamente']);
            else return response ()->json (['success'=>false,'message'=>'No se Actualizo ningun dato']);
        }
    }

    public  function updateAnular(Request $request, $id){
        if($request->ajax()){
            if(!auth()->user()->can('eliminar movimientos'))
                return response ()->view ('errors.403-content',[],403);
            $movcheque = \App\Models\Tesoreria\Mov_cheque::FindOrFail($id);
            $movcheque->concepto = strtoupper($request->motivo);
            $movcheque->users_id=  auth()->id();
            $movcheque->estado = 'ANULADO';
            $movcheque->importe = 0;
            $movcheque->save();
            $caja = \App\Models\Tesoreria\Caja_chica::where('mov_cheques_id','=',$id)->delete();
            return response()->json(['success'=>true]);
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
    }
}
