<div id="insertModal" class="modal modal-fixed-footer">
    <form id="insert-form" class=" col s12 offset-s1">
        <div class="modal-content">
        <h4 class="center-align">Registrar cliente</h4>
            <div class="row">
                <div class="input-field col s12">
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
                        required
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
            <button href="#!" class="waves-effect waves-green btn-flat" id="insert-client">Enviar</button>
        </div>
    </form>
</div>