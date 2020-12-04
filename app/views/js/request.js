// INATIVAR CADASTRO - Tela /clients
$('.delete-client').on('click', function(e) {

    let clientId = $(e.target).attr('data-id');
    let action = $(e.target).hasClass('active-icon') ? 'inativar' : 'ativar';
    let msg = action == 'inativar' ? 'inativado' : 'ativado'

    let data = JSON.stringify({'id': clientId});
    
    Swal.fire({
        title: 'Tem certeza?',
        text: `Você está prestes a ${action} o ID ${clientId}!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2BBBAB',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'DELETE',
                url: 'client',
                async: true,
                data,
                success: function(response){
                    Swal.fire({

                        title: 'Sucesso!',
                        text: `O ID ${clientId} foi ${msg}.`,
                        icon: 'success',
                        confirmButtonColor: '#2BBBAB',
                    }).then(() => {
                        window.location.reload(true);
                    })
                },
                error: function(response) {
                    Swal.fire({

                        title: 'Erro!',
                        text: response.responseJSON,
                        icon: 'error',
                        confirmButtonColor: '#2BBBAB',
                    }).then(() => {
                        window.location.reload(true);
                    });
                }
            });
        }
    });
});


// ALTERAR NIVEL DE ACESSO (Usuário/Administrador) Tela: /users
$(".toogle-access").on('change', (e) => {

    let userId = $(e.target).attr('data-id');

    let data = JSON.stringify({ 
        'id': userId
    });

    $.ajax({
        type: 'PUT',
        url: 'user/toogle-access',
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
})
