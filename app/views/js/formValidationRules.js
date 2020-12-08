const clientFormOptions = {
    rules: {
        name: {
            required: true,
        },
        email: {
            required: true,
        },
        birth: {
            required: true,
        },
        cpf: {
            required: true,
            minlength: 11,
            maxlength: 11
        },
        rg: {
            required: true,
            minlength: 9,
            maxlength: 9
        },
        telephone1: {
            required: true,
            minlength: 9,
            maxlength: 9,
        },
        telephone2: {
            required: true,
            minlength: 9,
            maxlength: 9,
        },
    },
    messages: {
        name: {
            required: "Nome é obrigatório.",
        },
        email: {
            required: "E-mail é obrigatório.",
        },
        birth: {
            required: "Data de nascimento é obrigatório.",
        },
        cpf: {
            required: "CPF é obrigatório (11 digitos).",
        },
        rg: {
            required: "RG é obrigatório (9 digitos).",
        },
        telephone1: {
            required: "Telefone é obrigatório (9 digitos).",
        },
        telephone2: {
            required: "Telefone é obrigatório (9 digitos).",
        },
    },
    errorElement : 'div',
    errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    }
}


const addressFormOptions = {
    rules: {
        zipcode: {
            required: true,
            minlength: 8,
            maxlength: 8,
        },
        street: {
            required: true,
        },
        number: {
            required: true,
        },
        neighbourhood: {
            required: true,
        },
        city: {
            required: true,
        },
        uf: {
            required: true,
            minlength: 2,
            maxlength: 2,
        },
    },
    messages: {
        zipcode: {
            required: "CEP é obrigatório",
        },
        street: {
            required: "Rua é obrigatória",
        },
        number: {
            required: "Número é obrigatório",
        },
        neighbourhood: {
            required: "Bairro é obrigatório",
        },
        city: {
            required: "Cidade é obrigatória",
        },
        uf: {
            required: "Estado é obrigatório",
        },
    },
    errorElement : 'div',
    errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    }
}
