<div id="insert-address-modal" class="modal modal-fixed-footer">
    <form id="insert-address-form" class=" col s12 offset-s1">
        <div class="modal-content">
        <h4 class="center-align">Registrar endereço</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input
                        name="zipcode" 
                        type="text" 
                        id="cep" 
                        value="" 
                        size="10" 
                        maxlength="9"
                    >
                    <label>CEP</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s9">
                    <input 
                        name="street" 
                        type="text" 
                        id="street" 
                        size="60"
                    >
                    <label>Rua</label>
                </div>
                <div class="input-field col s3">
                    <input 
                        name="number" 
                        type="text" 
                        id="number" 
                        size="60"
                    >
                    <label>Número</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input 
                        name="neighbourhood" 
                        type="text" 
                        id="neighbourhood" 
                        size="40" 
                    >
                    <label>Bairro</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s9">
                    <input 
                        name="city" 
                        type="text" 
                        id="city" 
                    >
                    <label>Cidade</label>
                </div>
                <div class="input-field col s3">
                    <input 
                        name="uf" 
                        type="text" 
                        id="uf" 
                        size="2"
                    >
                    <label>Estado</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="complement" name="complement" class="materialize-textarea"></textarea>
                    <label for="complement">Complemento</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
            <button href="#!" class="waves-effect waves-green btn-flat" id="insert-address">Enviar</button>
        </div>
    </form>
</div>