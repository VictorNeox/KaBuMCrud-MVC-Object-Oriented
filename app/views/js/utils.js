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