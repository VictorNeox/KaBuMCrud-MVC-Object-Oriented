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

    let data = JSON.stringify({'id': clientId});

    console.log(data);

    $.ajax({
        type: 'GET',
        url: 'client/getInfo',
        async: true,
        dataType: 'json',
        data,
        success: function(response){
            console.log(response);
        },
        error: function(response) {
            console.log(response);
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
    $("#edit-form #id").val(clientId);
})