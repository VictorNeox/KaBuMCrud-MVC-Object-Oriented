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
            M.updateTextFields();

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


$(".address-edit").on('click', (e) => {
    const addressId = $(e.target).attr("data-id");

    let data = {'id': addressId};
    $("#edit-address-form #id").val(addressId);
    
    $.ajax({
        type: 'GET',
        url: 'address/getInfo',
        async: true,
        dataType: 'json',
        data,
        success: function(response){
            console.log(response.data);
            $("#edit-address-form #zipcode").val(response.data.zipcode);
            $("#edit-address-form #street").val(response.data.street);
            $("#edit-address-form #number").val(response.data.number);
            $("#edit-address-form #neighbourhood").val(response.data.neighbourhood);
            $("#edit-address-form #city").val(response.data.city);
            $("#edit-address-form #uf").val(response.data.uf);
            $("#edit-address-form #complement").val(response.data.complement);
            M.updateTextFields();

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

$(".address-client").on('click', (e) => {
    const clientId = $(e.target).attr("data-id");
    window.location.href = `addresses?id=${clientId}`;
})


$(".info-client").on('click', (e) => {
    const clientId = $(e.target).attr("data-id");
    let data = {'id': clientId};
    $.ajax({
        type: 'GET',
        url: 'client/getFullInfo',
        async: true,
        dataType: 'json',
        data,
        success: function(response){
            $("#info-modal .name").text(response.data.name);
            $("#info-modal .cpf").text(response.data.street);
            $("#info-modal .rg").text(response.data.rg);
            $("#info-modal .birth").text(response.data.birth);
            $("#info-modal .email").text(response.data.email);
            $("#info-modal .telephone1").text(response.data.telephone1);
            $("#info-modal .telephone2").text(response.data.telephone2);

            if(response.data.zipcode) {
                $("#info-modal .street").text(`${response.data.street}, `);
                $("#info-modal .number").text(response.data.number);
                $("#info-modal .neighbourhood").text(`${response.data.neighbourhood} - `);
                $("#info-modal .zipcode").text(response.data.zipcode);
                $("#info-modal .complement").text(response.data.complement);
            }

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


$("#logout-btn").click(function(e) {
    document.cookie = "token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.location.href = "login";
});