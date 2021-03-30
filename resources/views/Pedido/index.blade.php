<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href={{ asset('css/pedido.css') }}>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index de Pedidos</title>
</head>
<body>
    <div class="container">
        <div class="row">
          {{-- Parte da Esquerda --}}
          <div class="col-lg-4">
            <div class="row my-3">
              <div class="col-5">
                <a href="#" class="btn btn-primary w-100"> Voltar </a>
              </div>
              <form id="id-form-novo-pedido" class="col-7" method="POST" action="/pedido/1">
                @csrf
                <input type="submit" class="btn btn-info w-100" value="Novo Pedido">
              </form>
            </div>
            <div id="list-pedidos" class="list-group my-3">
              @foreach ($pedidos as $pedido)
              @if ($loop->first)
              <a href="#" class="list-group-item list-group-item-action active" data-toggle="list" value={{$pedido->id}}>Pedido {{$pedido->id}}</a>
              @else
              <a href="#" class="list-group-item list-group-item-action" data-toggle="list">Pedido {{$pedido->id}}</a>
              @endif
            
              
              @endforeach
              {{-- <a href="#" class="list-group-item list-group-item-action active" data-toggle="list">Pedido 7</a>
              <a href="#" class="list-group-item list-group-item-action" data-toggle="list">Pedido 6</a>
              <a href="#" class="list-group-item list-group-item-action" data-toggle="list">Pedido 5</a>
              <a href="#" class="list-group-item list-group-item-action" data-toggle="list">Pedido 4</a>
              <a href="#" class="list-group-item list-group-item-action" data-toggle="list">Pedido 3</a>
              <a href="#" class="list-group-item list-group-item-action" data-toggle="list">Pedido 2</a>
              <a href="#" class="list-group-item list-group-item-action" data-toggle="list">Pedido 1</a> --}}
            </div>
          </div>
        
          {{-- Parte do Meio --}} 
          <div class="col-lg-4">
            <h2 class="text-center my-3">Adicione Produtos</h2>
            {{-- Formulario de tipo Produto --}}
            <form action="">
              @csrf
              <div class="form-group">
                <select class="form-control" id="exampleFormControlSelect1">
                  @foreach ($tipoProdutos as $tipoProduto)
                  <option value={{$tipoProduto->id}}>{{$tipoProduto->descricao}}</option>    
                  @endforeach
                 {{--}} <option>Pizza</option>
                  <option>Suco</option>
                  <option>Cerveja</option> --}}
                </select>
              </div>
            </form>
             {{-- Formulario de Produto --}}
             <form action="">
              @csrf
              <div class="form-group">
                <select class="form-control" id="exampleFormControlSelect1">
                  @foreach ($produtos as $produto)
                      <option value={{$produto->id}}>{{$produto->nome}}</option>
                  @endforeach
                </select>
              </div>
            </form>
            <input id="spinner" name="value" value="1">
            {{-- Botão adicionar --}}
            <form method="POST" class="my-3" action="#">
              @csrf
                <input type="submit" class="btn btn-success w-100" value="Adicionar Produto">
            </form>
             {{-- Formulario de Endereço --}}
             <form action="">
              @csrf
              <div class="form-group">
                <select class="form-control" id="id-selecao-endereco">
                  @foreach ($enderecos as $endereco)
                      <option value={{$endereco->id}}>
                        {{$endereco->logradouro}}, nº {{$endereco->numero}}. {{$endereco->bairro}}
                      @if ($endereco->complemento)
                       . {{$endereco->complemento}}     
                      @endif
                      </option>
                  @endforeach
                  <option value=null>Retira no local</option>
                 
                  
                  {{-- <option>Rua X</option>
                  <option>Rua Y</option> --}}
                </select>
              </div>
            </form>
            {{-- Botão enviar --}}
            <form method="POST" class="my-3" action="#">
              @csrf
                <input type="submit" class="btn btn-info w-100" value="Enviar Pedido" readonly>
            </form>
          </div>

          {{-- Parte da Direita --}}
          <div class="col-lg-4">
            
            <div class="form-group my-3">
              <input type="text" class="form-control text-center" id="id-text-status" value="Estado: {{$estado}}">
            </div>
            <div id="list-produtos" class="list-group my-3">
              @foreach ($produtosPedido as $produtoPedido)
                <span href="#" class="list-group-item " value1={{$produtoPedido->Pedidos_id}} value2={{$produtoPedido->Produtos_id}}>
                  {{$produtoPedido->descricao}} - {{$produtoPedido->nome}} - {{$produtoPedido->quantidade}}x
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill icons-list-produtos" viewBox="0 0 16 16">
                  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                </svg></span>
              @endforeach
            </div>
            <div class="input-group">
              <input type="text" class="form-control" value="Valor total">
              <div class="input-group-append">
                <span class="input-group-text">R$</span>
                <span class="input-group-text">{{$totalPedido}}</span>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
      <script src={{asset('js/pedido.js')}}></script>
</body>
</html>