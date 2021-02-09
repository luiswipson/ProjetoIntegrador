<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
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
              <form class="col-7" method="POST" action="#">
                @csrf
                <input type="submit" class="btn btn-primary w-100" value="Novo Pedido">
              </form>
            </div>
            <div class="list-group my-3">
              <a href="#" class="list-group-item list-group-item-action active" data-toggle="list">Pedido 5</a>
              <a href="#" class="list-group-item list-group-item-action" data-toggle="list">Pedido 4</a>
              <a href="#" class="list-group-item list-group-item-action" data-toggle="list">Pedido 3</a>
              <a href="#" class="list-group-item list-group-item-action" data-toggle="list">Pedido 2</a>
              <a href="#" class="list-group-item list-group-item-action" data-toggle="list">Pedido 1</a>
            </div>
          </div>
        
          {{-- Parte do Meio --}} 
          <div class="col-lg-4">
            <label>Adicione Produtos</label>
            {{-- Formulario de tipo Produto --}}
            <form action="">
              @csrf
              <div class="form-group">
                <select class="form-control" id="exampleFormControlSelect1">
                  <option>Pizza</option>
                  <option>Suco</option>
                  <option>Cerveja</option>
                </select>
              </div>
            </form>
             {{-- Formulario de Produto --}}
             <form action="">
              @csrf
              <div class="form-group">
                <select class="form-control" id="exampleFormControlSelect1">
                  <option>Peperoni</option>
                  <option>Quatro queijos</option>
                </select>
              </div>
            </form>
            <input type="text" class="form-control" value="1">
            {{-- Botão adicionar --}}
            <form method="POST" class="my-3" action="#">
              @csrf
                <input type="submit" class="btn btn-primary w-100" value="Adicionar Produto">
            </form>
             {{-- Formulario de Endereço --}}
             <form action="">
              @csrf
              <div class="form-group">
                <select class="form-control" id="exampleFormControlSelect1">
                  <option>Rua X</option>
                  <option>Rua Y</option>
                </select>
              </div>
            </form>
            {{-- Botão enviar --}}
            <form method="POST" class="my-3" action="#">
              @csrf
                <input type="submit" class="btn btn-primary w-100" value="Enviar Pedido">
            </form>
          </div>

          {{-- Parte da Direita --}}
          <div class="col-lg-4">
            <input type="text" id="id-text-status" value="Estado: Aberto">
          </div>
        </div>
      </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>