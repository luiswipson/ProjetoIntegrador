<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Endereco;

class EnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->indexMessage(null);
    }

    /**
     * Display a listing of the resource. With message message
     *
     * @return \Illuminate\Http\Response
     */
    private function indexMessage($message)
    {
        $user_id = 1;
        $enderecos = Endereco::where('Users_id', $user_id)->get();
        return view('Endereco.index')->with('enderecos', $enderecos)->with('message', $message);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $enderecos = DB::select('select * from Enderecos');
      return view('Endereco.create')->with('enderecos', $enderecos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $endereco = new Endereco();
        $endereco->Users_id = 1;
        $endereco->bairro = $request->bairro;
        $endereco->logradouro = $request->logradouro;
        $endereco->numero = $request->numero;
        $endereco->complemento = $request->complemento;
        try{
            $endereco->save();
        } catch (\Throwable $th) {
            $message['type'] = 'danger';
            $message['message'] = "Problema ao salvar um recurso: " . $th->getMessage();
            return $this->indexMessage($message);
        }
        $message['type'] = 'success';
        $message['message'] = 'Recurso cadastrado com sucesso';
        return $this->indexMessage($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $endereco = Endereco::find($id);
        if(isset($endereco))
        { 
            if($endereco->Users_id == 1){
    
            return view('Endereco.show')->with('endereco', $endereco);
            }
            
        }
        $message['type'] = 'danger';
        $message['message'] = 'Endereço não encontrado';
        return $this->indexMessage($message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $endereco = Endereco::find($id);
        if(isset($endereco))
        { 
            if($endereco->Users_id == 1){
    
            return view('Endereco.edit')->with('endereco', $endereco);
            }
            
        }
         // Constrói a mensagem
         $message['type'] = 'danger';
         $message['message'] = 'Endereço não encontrado';
         // Retorna a execução do método indexMessage
         return $this->indexMessage($message);
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
       
        $endereco = Endereco::find($id);
        if(isset($endereco))
        {
            if($endereco->Users_id == 1){
                $endereco->bairro = $request->bairro;
                $endereco->logradouro = $request->logradouro;
                $endereco->numero = $request->numero;
                $endereco->complemento = $request->complemento;
            try {
                $endereco->update();
            } catch (\Throwable $th) {
                $message['type'] = 'danger';
                $message['message'] = "Problema ao atualizar um endereço: " . $th->getMessage();
                return $this->indexMessage($message);
            }
            $message['type'] = 'success';
            $message['message'] = 'Endereço atualizado com sucesso';
            return $this->indexMessage($message);
        }
        }
        $message['type'] = 'danger';
        $message['message'] = 'Endereço não encontrado';
        return $this->indexMessage($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $endereco = Endereco::find($id);
        if(isset($endereco))
        {
            try {
                $endereco->delete();
            } catch (\Throwable $th) {
                $message['type'] = 'danger';
                $message['message'] = "Problema ao remover um endereço: " . $th->getMessage();
                return $this->indexMessage($message);
            }
            $message['type'] = 'success';
            $message['message'] = 'Endereço removido com sucesso';
            return $this->indexMessage($message);
        }
        $message['type'] = 'danger';
        $message['message'] = 'Endereço não encontrado';
        return $this->indexMessage($message);
    }
}