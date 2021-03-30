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

