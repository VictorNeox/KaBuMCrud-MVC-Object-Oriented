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
                                    <i data-id="<?php echo $client->id; ?>" class="fas fa-pencil-alt pencil-icon modal-trigger edit-btn" href="#editModal"></i>
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
    
    <?php require ('partials/insertClientModal.php'); ?>
    <?php require ('partials/editClientModal.php'); ?>
</body>
</html>