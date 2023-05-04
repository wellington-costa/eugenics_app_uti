<style>
.obs {
    background:#fffcf5;
    padding-10px;
    margin-bottom:20px;
    opacity:0.80;
}
</style>
    <div class="row">
        <?php if (isset($paciente->id)): ?>
            <input type="hidden" name="id" value="<?php echo $paciente->id; ?>">
        <?php endif; ?>

        <div class="col-md-5">
            <div class="form-group">
                <label for="data_nasc">Data de nascimento: <b><?php echo $paciente->data_nasc  ?></b></label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="idade">Idade: <b> <?php echo $paciente->idade  ?>  anos</b></label>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="raca">Raça: <b> <?php echo $paciente->raca  ?> </b></label>
            </div>
        </div>
    </div><!--end row-->
    <div class="row">

        <div class="col-md-5">
            <div class="form-group">
                <label for="municip_orig">Município de Origem: <b> <?php echo $paciente->municip_orig  ?> </b></label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="sexo">Sexo: <b><?php echo $paciente->sexo  ?> </b></label>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="prontuario">Nº Prontuário: <b> <?php echo $paciente->prontuario  ?></b></label>
            </div>
        </div>
    </div><!--end row-->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="data_inter">Data de Internação: <b><?php echo $paciente->data_inter  ?></b></label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="nome"><?php echo $paciente->nome  ?></label>
            </div>
        </div>

    </div><!--end row-->
    <div class="row">
    <div class="col-md-3">
            <div class="form-group">
                <label for="nome"><?php echo $paciente->nome  ?></label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="nome"><?php echo $paciente->nome  ?></label>
            </div>
        </div>


        <div class="col-md-4">
            <div class="form-group">
                <label for="nome"><?php echo $paciente->nome  ?></label>
            </div>
        </div>

    </div><!--end row-->
    <div class="row">
    <div class="col-md-4">
            <div class="form-group">
                <label for="nome"><?php echo $paciente->nome  ?></label>
            </div>
        </div>
    </div><!--end row-->

    <button type="submit" class="btn btn-success btn-sm button-salvar-clientes" style="float:right">
        <i class="fas fa-save"></i> Imprimir
    </button>

</form>

<script src="<?php echo BASEURL; ?>/js/maskedInput.js"></script>
<script>
    // Anula duplo click em salvar
    anulaDuploClick($('form'));



</script>
