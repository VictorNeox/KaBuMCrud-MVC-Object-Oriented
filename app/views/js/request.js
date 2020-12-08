// REQUESTS GERAIS

// INATIVAR CADASTRO - Tela /clients
$('.delete-client').on('click', function(e) {
    let clientId = $(e.target).attr('data-id');
    let data = JSON.stringify({'id': clientId});
    doRequest('client', 'DELETE', data, false);

});

// ALTERAR NIVEL DE ACESSO (Usuário/Administrador) Tela: /users
$(".toogle-access").on('change', (e) => {
    let userId = $(e.target).attr('data-id');
    let data = JSON.stringify({ 
        'id': userId
    });
    doRequest('user/toogle-access', 'PUT', data);
});

$("#login-btn").on('click', (e) => {
    let data = formToArray('login-form');
    data = JSON.stringify(data);
    doRequest('user/auth', 'POST', data, false);
});

$("#register-btn").on('click', (e) => {
    let data = formToArray('register-form');
    data = JSON.stringify(data);

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


// REQUESTS COM FORMULÁRIO (Validação FrontEnd)
$("#insert-form").validate({
    rules: clientFormOptions.rules,
    messages: clientFormOptions.messages,
    submitHandler: function(form) {
        let data = formToArray('insert-form');
        data = JSON.stringify(data);
        doRequest('client', 'POST', data, false);
    },
    errorElement : clientFormOptions.errorElement,
    errorPlacement: clientFormOptions.errorPlacement
});

$("#edit-form").validate({
    rules: clientFormOptions.rules,
    messages: clientFormOptions.messages,
    submitHandler: function(form) {
        let data = formToArray('edit-form');
        data = JSON.stringify(data);
        doRequest('client', 'PUT', data, false);
    },
    errorElement : clientFormOptions.errorElement,
    errorPlacement: clientFormOptions.errorPlacement
});

$("#insert-address-form").validate({
    rules: addressFormOptions.rules,
    messages: addressFormOptions.messages,
    submitHandler: function(form) {
        let data = formToArray('insert-address-form');
        data['id'] = $("#client-id").attr('data-id');
        data = JSON.stringify(data);
        doRequest('address', 'PUT', data);
    },
    errorElement : addressFormOptions.errorElement,
    errorPlacement: addressFormOptions.errorPlacement
});


// FUNÇÕES AUXILIARES (códigos que estavam repetidos demais)
function formToArray(formId) {
    let data = {};
    $.each($(`#${formId}`).serializeArray(), function() {
        data[this.name] = this.value;
    });
    return data;
}

// REQUEST GENÉRICA!
function doRequest(endpoint, method, data, reloadPageOnFail = true) {
    $.ajax({
        type: method,
        url: endpoint,
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
                window.location.reload(true);
            })
        },
        error: function(response) {
            console.log(response.responseJSON);
            Swal.fire({

                title: 'Erro!',
                text: response.responseJSON.message,
                icon: response.responseJSON.status,
                confirmButtonColor: '#2BBBAB',
            }).then(() => {
                if(reloadPageOnFail)
                    window.location.reload(true);
            });
        }
    });
}