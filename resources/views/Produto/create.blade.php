<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Create Produto</title>
</head>
<body>
    <div class="container">
        <form method="POST" action={{route('produto.store')}}>
          @csrf
          <div class="form-group">
            <label for="imput-ID">ID</label>
            <input type="email" class="form-control" id="imput-ID" aria-describedby="ID-help" value="#" disabled>
            <small id="ID-help" class="form-text text-muted">Não é necessario informar um id para cadastrar um novo recurso.</small>
          </div>
          <div class="form-group">
              <label for="input-nome">Nome</label>
              <input name="nome" type="text" class="form-control" id="input-nome" placeholder="Informe o Nome do recurso">
            </div>
            <div class="form-group">
                <label for="input-preco">Preço</label>
                <input name="preco" type="text" class="form-control" id="input-preco" placeholder="Informe o preço do recurso">
            </div>

            <div class="form-group">
              <label for="imput-tipo-produto">Tipo de Produto</label>
              <select class="form-control" id="imput-tipo-produto" name="Tipo_Produtos_id">
                {{--<option value=1 >Default select1</option>
                <option value=2 >Default select2</option>
                <option value=3 >Default select3</option>--}}
                @foreach ($tipoProdutos as $tipoProduto)
                  <option value={{$tipoProduto->id}}>{{$tipoProduto->descricao}}</option>
                @endforeach
              </select>
            </div>
            

          <button type="submit" class="btn btn-primary">Enviar</button>
          <a href={{route('produto.index')}} class="btn btn-primary">Voltar</a>
        </form>
      </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
