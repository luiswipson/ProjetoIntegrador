$("#spinner").spinner({
    min:1, max:10
});

$('#id-form-novo-pedido').on('submit', function(event){
    event.preventDefault();
    const endereco_id = $('#id-selecao-endereco').val();
    $.ajax({
        type: "POST",
        url: `/pedido/${endereco_id}`,
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response){
            $('#list-pedidos').html("");
            response.return.forEach(element => {
                $("#list-pedidos").append(`<a href="#" class="list-group-item list-group-item-action" data-toggle="list" value=${element.id}>Pedido ${element.id}</a>`);
            });
            $('#list-pedidos a:first-child').click();
            
        },
        error: function(error){
            //console.log(error.responseJSON.message);
        }
    });
});

$('#id-selecao-tipo-produto').on('change', function(event){
    const tipoProdutoId = $('#id-selecao-tipo-produto').val();
    $.ajax({
        type: "GET",
        url: `/pedidoproduto/getTodosProdutosDeTipo/${tipoProdutoId}`,
        data: null ,//$(this).serialize(),
        dataType: 'json',
        success: function(response){
            $('#id-selecao-produto').html("");
            console.log(response.message);
            console.log(response.return);
            response.return.forEach(element =>{
                $('#id-selecao-produto').append(`<option value=${element.id}>${element.nome}</option>`);
            });
        },
        error: function(error){
            
        }
    });
});