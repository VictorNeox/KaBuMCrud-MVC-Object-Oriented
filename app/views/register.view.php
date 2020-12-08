<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require 'partials/cdn.php' ?>

    <link rel="stylesheet" href="app/assets/css/register.css">

    <title>C.R.U.D - Registrar</title>
</head>
<body>
    
    <?php require 'partials/header.php' ?>

    <div class="valign-wrapper">
        <div class="row container s12 m6 offset-m3">
            <div class="register-header">
                <div class="logo-div">
                    <img class='responsive-img circle logo-circle' src="app/assets/imgs/kabumCircle.jpeg" alt="Logo KaBuM! Circle">
                </div>
                <p>Crie sua conta</p>
            </div>
            <form id="register-form" class=" col s11 offset-s1">
                <div class="row s12">
                    <div class="col s12">
                        <i class="fas fa-user register-icons"></i>
                        <div class="input-field inline s12">
                            <input 
                                id="name" 
                                name="name" 
                                type="text" 
                                class="validate" 
                                required
                            >
                            <label for="name">Nome</label>
                        </div>
                    </div>
                </div>
                <div class="row s12">
                    <div class="col s12">
                        <i class="fas fa-envelope register-icons"></i>
                        <div class="input-field inline s12">
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                class="validate" 
                                required
                            >
                            <label for="email">E-mail</label>
                        </div>
                    </div>
                </div>
                <div class="row s12">
                    <div class="col s12">
                        <i class="fas fa-user-circle register-icons"></i>
                        <div class="input-field inline s12">
                            <input 
                                id="login" 
                                name="login" 
                                type="text" 
                                class="validate" 
                                required
                            >
                            <label for="login">Login</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <i class="fas fa-lock register-icons"></i>
                        <div class="input-field inline s12">
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                class="validate" 
                                required
                            >
                            <label for="password">Senha</label>
                        </div>
                    </div>
                </div>
                <div class="row register-btn">
                    <a class="btn waves-effect waves-light" id="register-btn">Registrar</a>
                    <a class="btn waves-effect waves-light" href="login">Voltar</a>
                </div>
            </form>
        </div>
    </div>


</body>
</html>