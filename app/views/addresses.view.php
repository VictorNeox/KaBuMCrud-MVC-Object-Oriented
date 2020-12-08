<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        
        <?php require 'partials/cdn.php' ?>
    
        <link rel="stylesheet" href="app/assets/css/address.css">
        <title>C.R.U.D - Addresses</title>
    </head>
<body>
    
    <?php require 'partials/header.php' ?>

    <div class="content"> 

        <h1 class="table-title">Endereços do cliente <?php echo $data['client']->name ?></h1>
        <a class="waves-effect waves-light btn modal-trigger" href="#insert-address-modal">Adicionar</a>
        <a class="waves-effect waves-light btn" href="/">Voltar</a>
        
        <input type="hidden" id="client-id" data-id="<?php echo $data['client']->id ?>">

         <div class="input-field row ">
            <?php foreach($data['addresses'] as $address){?>
                <div class="col s3">
                    <div class="card horizontal">
                        <label style="position: absolute; z-index: 2;">
                            <input data-id="<?php echo $address->id?>" name="group1" type="radio" class="main-address" <?php echo $address->main_address ? 'checked="true" disabled="true"' : '' ?> />
                            <span>Principal</span>
                        </label>
                        <div class="icons">
                            <i data-id="<?php echo $address->id?>"  class="fas fa-pencil-alt pencil-icon address-edit modal-trigger" href="#modal1"></i>
                            <i data-id="<?php echo $address->id?>" class="fas fa-trash-alt trash-icon"></i>
                        </div>
                        <div class="card-stacked">
                            <div class="card-content">
                                <p><?php echo $address->street?>, <?php echo $address->number?></p>
                                <p><?php echo $address->neighbourhood?> - <?php echo $address->zipcode?></p>
                                <p><?php echo $address->complement?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php require ('partials/insertAddressModal.php'); ?>

</body>
</html>