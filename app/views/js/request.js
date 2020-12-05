// INATIVAR CADASTRO - Tela /clients
$('.delete-client').on('click', function(e) {

    let clientId = $(e.target).attr('data-id');
    // let action = $(e.target).hasClass('active-icon') ? 'inativar' : 'ativar';
    // let msg = action == 'inativar' ? 'inativado' : 'ativado'
    let data = JSON.stringify({'id': clientId});
    
    doRequest('client', 'DELETE', data);

});

// ALTERAR NIVEL DE ACESSO (Usuário/Administrador) Tela: /users
$(".toogle-access").on('change', (e) => {
    let userId = $(e.target).attr('data-id');
    let data = JSON.stringify({ 
        'id': userId
    });

    doRequest('user/toogle-access', 'PUT', data);
});

$("#insert-client").on('click', (e) => {
    //let data = $('#insert-form').serializeArray();

    let data = {};

    $.each($('#insert-form').serializeArray(), function() {
        data[this.name] = this.value;
    });

    data['user_id'] = '1';
    data = JSON.stringify(data);
    doRequest('client', 'POST', data);
});



function doRequest(endpoint, method, data) {
    $.ajax({
        type: method,
        url: endpoint,
        async: true,
        data,
        dataType: 'json',
        success: function(response){
            console.log(response);
            Swal.fire({
                title: 'Sucesso!',
                text: response.message,
                icon: response.status,
                confirmButtonColor: '#2BBBAB',
            }).then(() => {
                window.location.reload(true);
            })
        },
        error: function(response) {
            console.log(response);
            Swal.fire({

                title: 'Erro!',
                text: response.responseJSON.message,
                icon: response.responseJSON.status,
                confirmButtonColor: '#2BBBAB',
            }).then(() => {
                window.location.reload(true);
            });
        }
    });
}