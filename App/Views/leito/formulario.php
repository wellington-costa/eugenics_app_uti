<style>
.obs {
    background:#fffcf5;
    padding-10px;
    margin-bottom:20px;
    opacity:0.80;
}
</style>

<form method="post"
      action="<?php echo isset($leito->id) ? BASEURL . '/leito/update' : BASEURL . '/leito/save'; ?>"
      enctype='multipart/form-data'>
    <div class="row">
        <input type="hidden" name="_token" value="<?php echo TOKEN; ?>"/>

        <?php if (isset($leito->id)): ?>
            <input type="hidden" name="id" value="<?php echo $leito->id; ?>">
        <?php endif; ?>

        <div class="col-md-4">
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Digite aqui..."
                       value="<?php echo isset($leito->id) ? $leito->descricao : '' ?>">
            </div>
        </div>


    </div><!--end row-->

    <button type="submit" class="btn btn-success btn-sm button-salvar-leitos" style="float:right"
            onclick="return salvarleitos()">
        <i class="fas fa-save"></i> Salvar
    </button>

</form>

<script src="<?php echo BASEURL; ?>/js/maskedInput.js"></script>
<script>
    // Anula duplo click em salvar
    anulaDuploClick($('form'));
    function salvarleitos() {


        if ($('#descricao').val() == '') {
            modalValidacao('Validação', 'Campo (Descrição) deve ser preenchido!');
            return false;

        }
        return true;
    }


</script>
