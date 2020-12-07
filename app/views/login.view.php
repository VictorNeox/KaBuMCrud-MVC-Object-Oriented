<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/assets/styles/global.css">
    <link rel="stylesheet" href="/assets/styles/loginStyles.css">
    
    <?php require 'partials/cdn.php' ?>
    
    <link rel="stylesheet" href="app/assets/css/login.css">

    <title>C.R.U.D - Login</title>
</head>
<body>
    
    <?php require 'partials/header.php' ?>
    <div class="valign-wrapper">
        <div class="row container s12 m6 offset-m3">
            <div class="login-header">
                <div class="logo-div">
                    <img class='responsive-img circle logo-circle' src="app/assets/imgs/kabumCircle.jpeg" alt="Logo KaBuM! Circle">
                </div>
                <p>Faça seu login</p>
            </div>
            <form id="login-form"  method="post" class=" col s11 offset-s1">
                <div class="row s12">
                    <div class="col s12">
                        <i class="fas fa-user-circle login-icons"></i>
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
                        <i class="fas fa-lock login-icons"></i>
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
                <div class="row login-btn">
                    <a class="btn waves-effect waves-light" id="login-btn">Entrar</a>
                    <a class="btn waves-effect waves-light" href="register">Registrar</a>
                </div>
            </form>
        </div>
    </div>


</body>
</html>