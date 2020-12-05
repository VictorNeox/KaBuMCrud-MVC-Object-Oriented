//SELECT DO MATERIALIZE
$(document).ready(function(){
    $('select').formSelect();
});

$(document).ready(function(){
    $('.modal').modal();
});

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.datepicker');
    var instances = M.Datepicker.init(elems,{
        format: 'yyyy-mm-dd'
    });
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);
});


$(".edit-btn").on('click', (e) => {
    const clientId = $(e.target).attr("data-id");

    let data = {'id': clientId};
    $("#edit-form #id").val(clientId);
    
    $.ajax({
        type: 'GET',
        url: 'client/getInfo',
        async: true,
        dataType: 'json',
        data,
        success: function(response){
            $("#edit-form #name").val(response.data.name);
            $("#edit-form #email").val(response.data.email);
            $("#edit-form #birth").val(response.data.birth);
            $("#edit-form #cpf").val(response.data.cpf);
            $("#edit-form #rg").val(response.data.rg);
            $("#edit-form #telephone1").val(response.data.telephone1);
            $("#edit-form #telephone2").val(response.data.telephone2);
            $(document).ready(function() {
                Materialize.updateTextFields();
            });

        },
        error: function(response) {
            $("#insert-forml #name").val(response.data.name);
            // Swal.fire({

            //     title: 'Erro!',
            //     text: response.responseJSON.message,
            //     icon: response.responseJSON.status,
            //     confirmButtonColor: '#2BBBAB',
            // }).then(() => {
            //     window.location.reload(true);
            // });
        }
    });

})