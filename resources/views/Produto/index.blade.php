<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Index de Tipo Produto</title>
</head>
<body>
    <div class="container">
        <a href={{route('produto.create')}} class="btn btn-primary">Criar um Produto</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Produtos as $Produto)
                    <tr>   
                        <th scope="row">{{$Produto->id}}</th>
                        <td>{{$Produto->nome}}</td>
                        <td>{{$Produto->preco}}</td>
                        <td>{{$Produto->descricao}}</td>
                        <td>
                            <a href="{{route('produto.show', $Produto->id)}}" class="btn btn-primary">Show</a>
                            <a href="{{route('produto.edit', $Produto->id)}}" class="btn btn-primary">Edit</a>
                            <a class="btn btn-danger BotaoRemover" data-toggle="modal" data-target="#modalDelete" value="{{route('produto.destroy', $Produto->id)}}">Remover</a>
                        </td>
                    </tr>
                @endforeach   
    
            </tbody>
        </table>
     </div>

     <!-- Modal -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Remover</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Deseja remover este tipo de produto?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
            <form id="id-form-delete" method="POST" action="">
              @csrf
              <input type="hidden" name="_method" value="DELETE">
              <input type="submit" class="btn btn-danger" value="Remover">
            </form>
        </div>
      </div>
    </div>
  </div>
  
    
    <script>
      var buttons = document.querySelectorAll('.BotaoRemover');
      var formDelete = document.querySelector('#id-form-delete');
      buttons.forEach(button => {
          button.addEventListener('click', functionBotaoRemoverClick);
      });
      function functionBotaoRemoverClick(){
          formDelete.setAttribute("action", this.getAttribute("value"))
      }
    </script>
   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>