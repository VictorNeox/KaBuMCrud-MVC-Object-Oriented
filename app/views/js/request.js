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
    let data = {};

    $.each($('#insert-form').serializeArray(), function() {
        data[this.name] = this.value;
    });

    data['user_id'] = '1';
    data = JSON.stringify(data);
    doRequest('client', 'POST', data);
});

$("#edit-client").on('click', (e) => {
    let data = {};

    $.each($('#edit-form').serializeArray(), function() {
        data[this.name] = this.value;
    });

    data['user_id'] = '1';
    data = JSON.stringify(data);
    doRequest('client', 'PUT', data);
});

$("#insert-address").on('click', (e) => {
    let data = {};

    $.each($('#insert-address-form').serializeArray(), function() {
        data[this.name] = this.value;
    });

    data['id'] = $("#client-id").attr('data-id');
        
    data = JSON.stringify(data);
    doRequest('address', 'PUT', data);
});


// REQUEST GENÉRICA!
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



$("#login-btn").on('click', (e) => {
    let data = {};

    $.each($('#login-form').serializeArray(), function() {
        data[this.name] = this.value;
    });

    data = JSON.stringify(data);

    console.log(data);
    $.ajax({
        type: 'POST',
        url: 'user/auth',
        async: true,
        data,
        dataType: 'json',
        success: function(response){
            Swal.fire({
                title: 'Sucesso!',
                text: response.message,
                icon: response.status,
                confirmButtonColor: '#2BBBAB',
            }).then(() => {
                window.location.href = "clients";
            })
        },
        error: function(response) {
            console.log(response);
            Swal.fire({

                title: 'Erro!',
                text: response.responseJSON.message,
                icon: response.responseJSON.status,
                confirmButtonColor: '#2BBBAB',
            });
        }
    });
});

$("#register-btn").on('click', (e) => {
    let data = {};

    $.each($('#register-form').serializeArray(), function() {
        data[this.name] = this.value;
    });

    data = JSON.stringify(data);

    console.log(data);
    $.ajax({
        type: 'POST',
        url: 'user',
        async: true,
        data,
        dataType: 'json',
        success: function(response){
            Swal.fire({
                title: 'Sucesso!',
                text: response.message,
                icon: response.status,
                confirmButtonColor: '#2BBBAB',
            }).then(() => {
                window.location.href = "login";
            })
        },
        error: function(response) {
            Swal.fire({

                title: 'Erro!',
                text: response.responseJSON.message,
                icon: response.responseJSON.status,
                confirmButtonColor: '#2BBBAB',
            });
        }
    });
});