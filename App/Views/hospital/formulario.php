<form method="post"
      action="<?php echo isset($hospital->id) ? BASEURL . '/empresa/update' : BASEURL . '/empresa/save'; ?>"
      enctype='multipart/form-data'>
    <!-- token de segurança -->
    <input type="hidden" name="_token" value="<?php echo TOKEN; ?>"/>

    <div class="row">

        <?php if (isset($hospital->id)) : ?>
            <input type="hidden" name="id" value="<?php echo $hospital->id; ?>">
        <?php endif; ?>

        <div class="col-md-4">
            <div class="form-group">
                <label for="nome">Nome do Hospital *</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite aqui..."
                       value="<?php echo isset($hospital->id) ? $hospital->nome : '' ?>">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="email">E-mail * <span class="label-email"></span></label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Digite o e-mail!"
                       value="<?php echo isset($hospital->id) ? $hospital->email : '' ?>"
                       onchange="verificaSeEmailExiste(this, <?php echo isset($hospital->id) ? $hospital->id : false; ?>)">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" name="telefone" id="telefone"
                       placeholder="Digite o número de Telefone"
                       value="<?php echo isset($hospital->id) ? $hospital->telefone : '' ?>">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="text" class="form-control" name="celular" id="celular"
                       placeholder="Digite o número de Celular"
                       value="<?php echo isset($hospital->id) ? $hospital->celular : '' ?>">
            </div>
        </div>



    </div>
    <!--end row-->

    <button type="submit" class="btn btn-success btn-sm button-salvar-empresa"
            style="float:right" onclick="return salvarHospitais()">
        <i class="fas fa-save"></i> Salvar
    </button>

</form>

<script src="<?php echo BASEURL; ?>/js/maskedInput.js"></script>

<script>
    // Anula duplo click em salvar
    anulaDuploClick($('form'));

    // Aplica as mascas nos elementos
    jQuery(function ($) {
        jQuery("#cnpj").mask("99.999.999/9999-99");
        jQuery("#cpf").mask("999.999.999-99");
        jQuery("#telefone").mask("(99) 9999-9999");
        jQuery("#celular").mask("(99) 99999-9999");
    });

    function salvarHospitais() {
        if ($('#nome').val() == '') {
            modalValidacao('Validação', 'Campo (Nome) deve ser preenchido!');
            return false;

        } else if ($('#email').val() == '') {
            modalValidacao('Validação', 'Campo (Email) deve ser preenchido!');
            return false;

        } else if (!emailValido($('#email').val())) {
            modalValidacao('Validação', 'Digite um Email valido!');
            return false;

        }

        return true;
    }

    function verificaSeEmailExiste(email, id) {
        var rota = getDomain() + "/hospital/verificaSeEmailExiste";
        if (id) {
            rota += '/' + in64(email.value) + '/' + id;
        } else {
            rota += '/' + in64(email.value);
        }

        $.get(rota, function (data, status) {
            var retorno = JSON.parse(data);

            if (retorno.status == true) {
                modalValidacao('Validação', 'Este Email já existe! Por favor, informe outro!');
                $('.button-salvar-empresa').attr('disabled', 'disabled');
                $('.label-email').html('<small style="color:#cc0000!important">Este Email já existe!</small>');
            } else {
                $('.button-salvar-empresa').attr('disabled', false);
                $('.label-email').html('');
            }
        });
    }


</script>