<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;

class PedidoProdutoController extends Controller
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
    public function getTodosProdutosDeTipo($tipo_produto_id){
        if(isset($tipo_produto_id)){
        $produtos = Produto::where('Tipo_Produtos_id', $tipo_produto_id)->get();
        $response['success'] = true;
        $response['message'] = "Operação concluida";
        $response['return'] = $produtos;
        return response()->json($response, 200);
        }
        $response['success'] = false;
        $response['message'] = "Operação não concluida";
        $response['return'] = [];
        return response()->json($response, 404);
    }
}
