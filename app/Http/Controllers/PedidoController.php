<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\TipoProduto;
use App\Produto;
use App\Endereco;
use App\Pedido;
use App\PedidoProduto;
use Carbon\Carbon;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = 1;
        //$pedidos = DB::select("select * from Pedidos where Users_id= ? order by Pedidos.id DESC", [$user_id]);  
        $pedidos = Pedido::where('Users_id', $user_id)->orderby('Pedidos.id', 'DESC')->get();
        $tipoProdutos = TipoProduto::all();
        $produtos = [];
        if(!$tipoProdutos->isEmpty()){
            $firstTipoProduto = $tipoProdutos->first();
            $produtos = Produto::where('Tipo_Produtos_id',$firstTipoProduto->id)->get();
        }
        $enderecos = DB::select("select * from Enderecos where Users_id= ?", [$user_id]);
        $produtosPedido = [];
        $totalPedido = 0;
        $estado = "";

        if(!$pedidos->isEmpty()){
            $ultimoPedidoRealizado = $pedidos->first();
            $produtosPedido = DB::select("select Pedido_Produtos.Pedidos_id, Pedido_Produtos.Produtos_id, Pedido_Produtos.quantidade, Produtos.nome, Tipo_Produtos.descricao
            from Pedido_Produtos
            join Produtos on Pedido_Produtos.Produtos_id = Produtos.id
            join Tipo_Produtos on Produtos.Tipo_Produtos_id = Tipo_Produtos.id
            where Pedido_Produtos.Pedidos_Id = ?" , [$ultimoPedidoRealizado->id]);
            
            if(!empty($produtosPedido)){
                $totalPedido = DB::select("select sum(Pedido_Produtos.quantidade * Produtos.preco) as total_pedido from Pedido_Produtos
                join Produtos on Pedido_Produtos.Produtos_id = Produtos.id
                where Pedido_Produtos.Pedidos_Id = ?" , [$ultimoPedidoRealizado->id])[0];
                $totalPedido = $totalPedido->total_pedido;
            }
            
            switch($ultimoPedidoRealizado->status){
                case 'R':
                    $estado = "Recebido";
                    break;
                case 'C':
                    $estado = "Cancelado";
                    break;
                case 'P':
                    $estado = "Produção";
                    break;
                case 'E':
                    $estado = "Enviado";
                    break;
                case 'A':
                    $estado = "Aberto";
                    break;
                }
        }
        return view('Pedido.index')->with('pedidos', $pedidos)->with('tipoProdutos',$tipoProdutos)->with('produtos',$produtos)->with('enderecos',$enderecos)->with('produtosPedido',$produtosPedido)->with('totalPedido',$totalPedido)->with('estado',$estado);
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
    public function store(Request $request, $endereco_id)
    {
        $user_id = 1;
        if(isset($endereco_id) && $endereco_id != 'null'){
            $endereco = Endereco::find($endereco_id);
            if($endereco && $endereco->Users_id == $user_id){
                $pedido = new Pedido();
                $pedido->dataEHora = Carbon::now()->toDateTimeString();
                $pedido->status = "A";
                $pedido->Users_id = $user_id;
                $pedido->Enderecos_id = $endereco_id;
                try {
                    $pedido->save();
                } catch (\Throwable $th) {
                    $response['success'] = false;
                    $response['message'] = "Erro ao salvar pedido";
                    $response['return'] = [];
                    //var_dump($response);
                    return response()->json($response, 507);
                }

                $pedido = Pedido::where('Users_id', $user_id)->orderBy('id', 'DESC')->get();

                $response['success'] = true;
                $response['message'] = "Pedido criado com seucesos";
                $response['return'] = $pedido;
                //var_dump($response);
                return response()->json($response, 201);
            }
            $response['success'] = false;
                $response['message'] = "Endereço não pertence ao usuario";
                $response['return'] = [];
                //var_dump($response);
                return response()->json($response, 403);
        }
        $pedido = new Pedido();
        $pedido->dataEHora = Carbon::now()->toDateTimeString();
        $pedido->status = "A";
        $pedido->Users_id = $user_id;
        $pedido->Enderecos_id = null;
        try {
            $pedido->save();
        } catch (\Throwable $th) {
            $response['success'] = false;
            $response['message'] = "Erro ao salvar pedido";
            $response['return'] = [];
            //var_dump($response);
            return response()->json($response, 507);
        }

        $pedido = Pedido::where('Users_id', $user_id)->orderBy('id', 'DESC')->get();

        $response['success'] = true;
        $response['message'] = "Pedido criado com seucesos";
        $response['return'] = $pedido;
        //var_dump($response);
        return response()->json($response, 201);
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
