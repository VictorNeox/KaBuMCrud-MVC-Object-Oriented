<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="app/assets/css/clients.css">
    
    <?php require 'partials/cdn.php' ?>
</head>
<body>
    <?php require 'partials/header.php' ?>
    <div class="content">
        <h1 class="table-title">Usuários</h1>
        <a href="/clients" class="waves-effect waves-light btn add-btn">Voltar</a>

        <?php if(empty($users)) { ?>
            <h1 class="non-client">Nenhum usuário cadastrado!</h1>
        <?php } else { ?>
            <div class="table-content">
                <table class="striped responsive-table centered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Nível de Acesso</th>
                            <th>E-mail</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($users as $user){
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user->id) ?></td>
                                <td><?php echo htmlspecialchars($user->name) ?></td>
                                <td>
                                    <select name="access" id="access">
                                        <option value="admin">Administrador</option>
                                        <option value="user">Usuário</option>
                                    </select>    
                                <?php echo htmlspecialchars($user->access) ?></td>
                                <td><?php echo htmlspecialchars($user->email) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</body>
</html>