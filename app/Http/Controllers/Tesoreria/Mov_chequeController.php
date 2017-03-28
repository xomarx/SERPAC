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
        if($path) return response()->json(['success'=>true,'ruta'=>"/storage/app/cheques/".$nombre]);
        else return response()->json(['success'=>false,'ruta'=>"No se cargo ninguna imagen"]);
    }

        public function movcheque(){
        $cheques = \App\Models\Tesoreria\Cheque::pluck('cheque','id');
        return view('Tesoreria.movcheque',['cheques'=>$cheques]);
    }
    
    public function listMovcheques(){        
        $movcheques = \App\Models\Tesoreria\Mov_cheque::listaMovCheques();
        return view('Tesoreria.listaMovCheques')->with('cheques',$movcheques);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $movcheques = \App\Models\Tesoreria\Mov_cheque::listaMovCheques();
        return view('Tesoreria.cheques_girados')->with('cheques',$movcheques);
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
    public function update(Request $request, $id)
    {
        if($request->ajax()){
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
            $movcheque = \App\Models\Tesoreria\Mov_cheque::FindOrFail($id);
            $movcheque->concepto = strtoupper($request->motivo);
            $movcheque->users_id=  auth()->id();
            $movcheque->estado = 'ANULADO';
            $movcheque->save();
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
