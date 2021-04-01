<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Produto;
use App\Pedido;
use App\Endereco;
use App\PedidoProduto;

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
    public function store(Request $request, $id_pedido, $id_produto, $id_endereco, $quantidade)
    {
        $user_id = 1;
        if(Pedido::find($id_pedido) && Produto::find($id_produto) && $quantidade && $quantidade > 0){
            if($id_endereco != "null") {
                     $endereco = Endereco::find($id_endereco);
                        if( !isset($endereco) || $endereco->Users_id != $user_id){
                            $response['success'] = false;
                            $response['message'] = "O endereço informado não pertence ao usuário logado.";
                            $response['return'] = [];
                            return response()->json($response, 401);
                             }
            }
            $pedidoProduto = PedidoProduto::where("Pedidos_id", $id_pedido)->where("Produtos_id", $id_produto)->first();
            if($pedidoProduto) {
                    $pedidoProduto->quantidade += $quantidade;
                        try {
                            $pedidoProduto->update();
                        } catch (\Throwable $th) {
                            $response['success'] = false;
                            $response['message'] = "Erro ao atualizar produto dentro de pedido.";
                            $response['return'] = [];
                            return response()->json($response, 507);
                        }
                    }
            else{
                $pedidoProduto = new PedidoProduto();
                $pedidoProduto->Pedidos_id = $id_pedido;
                $pedidoProduto->Produtos_id = $id_produto;
                $pedidoProduto->quantidade = $quantidade;
                try {
                    $pedidoProduto->save();
                } catch (\Throwable $th) {
                    $response['success'] = false;
                    $response['message'] = "Erro ao salvar produto dentro de pedido.";
                    $response['return'] = [];
                    return response()->json($response, 507);
                }
            }
            $response['success'] = true;
            $response['message'] = "Produto salvo dentro do pedido.";
            $response['return'] = $pedidoProduto;
            return response()->json($response, 201);
        }
        $response['success'] = false;
        $response['message'] = "Os dados informados são inválidos.";
        $response['return'] = [];
        return response()->json($response, 406);
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

    public function getPedidoProdutosList($pedido_id){
        if(isset($pedido_id)){
        $user_id = 1;
            $pedidosProdutos = null;
            $pedidosProdutos = DB::select("select Pedidos.id as pedido_id, Pedidos.status as pedido_status, Pedido_Produtos.Produtos_id as produto_id, Produtos.nome as produto_nome, Tipo_Produtos.descricao as tipo_descricao,
                                        Produtos.preco as produto_preco, Pedido_Produtos.quantidade as quantidade, Enderecos.id as endereco_id from Pedidos
                                        join Pedido_Produtos on Pedidos.id = Pedido_Produtos.Pedidos_id
                                        join Produtos on Pedido_Produtos.Produtos_id = Produtos.id
                                        join Tipo_Produtos on Produtos.Tipo_Produtos_id = Tipo_Produtos.id
                                        left join Enderecos on Pedidos.Enderecos_id = Enderecos.id
                                        where Pedidos.id = ? and Pedidos.Users_id = ?", [$pedido_id, $user_id]);
            $response['success'] = true;
            $response['message'] = "Operação concluida";
            $response['return'] = $pedidosProdutos;
            return response()->json($response, 201);
        }
        $response['success'] = false;
        $response['message'] = "Consulta de produtos necessita de um id valido";
        $response['return'] = [];
        return response()->json($response, 404);
    }
}
