<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;
use DB;
use App\TipoProduto;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Produtos = DB::select("select Produtos.id, Produtos.nome, Produtos.preco, 
        Tipo_Produtos.descricao from Produtos join Tipo_Produtos on Produtos.Tipo_Produtos_id = Tipo_Produtos.id");
        return view('Produto.index')->with('Produtos' , $Produtos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoProdutos = DB::select("select * from Tipo_Produtos");
        return view('Produto.create')->with("tipoProdutos", $tipoProdutos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produto = new Produto();
        $produto->nome = $request->nome;
        $produto->preco = $request->preco;
        $produto->Tipo_Produtos_id = $request->Tipo_Produtos_id;
        $produto->save();
        
     return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Produto::find($id);
        

        if(isset($produto)){
           // $tipoProdutos = DB::select('select * from Tipo_Produtos where Tipo_Produtos.id = :id_tipo', ['id_tipo' => $produto->Tipo_Produtos_id]);
            //return view("produto.show")->with("produto", $produto,)->with("tipoProdutos", $tipoProdutos);
            $tipoProduto = TipoProduto::find($produto->Tipo_Produtos_id);
            return view("produto.show")->with("produto", $produto,)->with("tipoProduto", $tipoProduto);

        }
        
        

        return "Não encontrado";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = Produto::find($id);
        if(isset($produto)){
            $tipoProdutos = TipoProduto::all();
           // var_dump($tipoProdutos);
            return view("produto.edit")->with("produto", $produto,)->with("tipoProdutos", $tipoProdutos);
        }
        return "Não encontrado";
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
        $produto = Produto::find($id);
        if(isset($produto)){

                $produto->nome = $request->nome;
                $produto->preco = $request->preco;
                $produto->Tipo_Produtos_id = $request->Tipo_Produtos_id;
                $produto->update();
                return $this->index();
        }
        return "Não encontrado";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Produto::find($id)->delete();
        return redirect()->route('produto.index')->with('success','User Deleted');
    }
}
