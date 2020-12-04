<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require 'partials/cdn.php' ?>
    
    <link rel="stylesheet" href="app/assets/css/clients.css">
</head>
<body>
    <?php require 'partials/header.php' ?>
    <div class="content">
        <h1 class="table-title">Clientes</h1>
            <button data-target="insertModal" class="waves-effect waves-light btn modal-trigger">Adicionar cliente</button>
        <?php if($access > 1) { ?>
            <a href="/pages/users.php" class="waves-effect waves-light btn add-btn">Usuários</a>
        <?php } ?>
        <div class="row">

            <form>
                <div class="input-field col s2">
                    <select id="filter" name="filter" required>
                        <option disabled selected>Escolha uma opção</option>
                        <option value="name">Nome</option>
                        <option value="cpf">CPF</option>
                        <option value="rg">RG</option>
                        <option value="email">E-mail</option>
                    </select>
                    <label for="filter">Filtro</label>
                </div>

                <div class="input-field col s3">
                    <input id="search" name="search" type="text" minlength="3" required>
                    <label for="search">Pesquisa</label>
                </div>

                <button style="margin-top: 25px;" type="submit" class="waves-effect waves-light btn">Filtrar</button>
                <button style="margin-top: 25px;" onclick="window.location.href = '/'" class="waves-effect waves-light btn">Limpar filtro</button>
            </form>
        </div>

        <?php if(empty($clients)) { ?>
            <h1 class="non-client">Nenhum cliente inserido!</h1>
        <?php } else { ?>
            <div class="table-content">
                <table class="striped responsive-table centered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>RG</th>
                            <th>E-mail</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($clients as $client){ 
                            $status = $client->isActive ? 'active-icon' : 'inactive-icon'; 
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($client->id) ?></td>
                                <td><?php echo htmlspecialchars($client->name) ?></td>
                                <td class="cpf"><?php echo htmlspecialchars($client->cpf) ?></td>
                                <td class="rg"><?php echo htmlspecialchars($client->rg) ?></td>
                                <td><?php echo htmlspecialchars($client->email) ?></td>
                                <td>
                                    <i data-id="<?php echo $client->id; ?>" class="fas fas fa-eye info-client modal-trigger" href="#info-modal"></i>
                                    <i data-id="<?php echo $client->id; ?>" class="fas fa-pencil-alt pencil-icon edit-client"></i>
                                    <i data-id="<?php echo $client->id; ?>" class="fas fa-circle delete-button delete-client <?php echo $status?>"></i>
                                    <i data-id="<?php echo $client->id; ?>" class="fas fa-map-marker-alt address-icon address-client"></i>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
    

    <div id="insertModal" class="modal modal-fixed-footer">
        <form class=" col s12 offset-s1">
        <div class="modal-content">
        <h4 class="center-align">Insira os dados</h4>
                <div class="row">
                    <div class="input-field col s12">
                        <input 
                            id="name" 
                            name="name" 
                            type="text" 
                            class="validate" 
                            onkeypress="return !(/[0-9!@#$%¨&*)(-+*/><_-]/i.test(event.key))" 
                            required
                        >
                        <label for="name">Nome</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
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
                <div class="row">
                    <div class="input-field col s12 input-number">
                        <input 
                            id="birth" 
                            name="birth" 
                            type="text" 
                            class="datepicker" 
                            required
                        >
                        <label for="birth">Data de nascimento (aaaa-mm-dd)</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 input-documents">
                        <input 
                            id="cpf" 
                            name="cpf" 
                            type="text" 
                            minlength="11" 
                            maxlength="11" 
                            class="validate" 
                            onkeypress="return (/[0-9]/i.test(event.key))" required
                        >
                        <label for="cpf">CPF</label>
                    </div>
                    <div class="input-field col s6 input-documents">
                        <input 
                            id="rg" 
                            name="rg" 
                            type="text" 
                            minlength="9" 
                            maxlength="9"  
                            class="validate" 
                            onkeypress="return (/[0-9]/i.test(event.key))"
                        >
                        <label for="rg">RG</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 input-documents">
                        <input 
                            id="telephone1" 
                            name="telephone1" 
                            minlength="9" 
                            maxlength="9" 
                            type="tel" 
                            class="validate" 
                            onkeypress="return (/[0-9]/i.test(event.key))" 
                            required
                        >
                        <label for="telephone1">Telefone 1</label>
                    </div>
                    <div class="input-field col s6 input-number">
                        <input 
                            id="telephone2" 
                            name="telephone2" 
                            minlength="9" 
                            maxlength="9" 
                            type="tel" 
                            class="validate" 
                            onkeypress="return (/[0-9]/i.test(event.key))" 
                            required
                        >
                        <label for="telephone2">Telefone 2</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Enviar</a>
            </div>
        </div>
    </form>
</body>
</html>