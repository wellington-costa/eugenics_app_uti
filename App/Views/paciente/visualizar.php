<!--Usando o Html Components-->
<?php use System\HtmlComponents\Modal\Modal; ?>

<style>
.obs {
    background:#fffcf5;
    padding-10px;
    margin-bottom:20px;
    opacity:0.80;
}
</style>
    <div class="row">
        <center>
            <h1><b><?php echo $paciente->nome; ?></b></h1>
        </center>

    </div>
</br>
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
        <div class="col-md-3">
            <div class="form-group">
                <label for="peso">Peso: <b><?php echo $paciente->peso  ?> kg </b></label>
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
        <div class="col-md-6">
            <div class="form-group">
                <label for="nome">Data de Admissão HRE:<b><?php echo $paciente->data_admissao  ?></b></label>
            </div>
        </div>

    </div><!--end row-->
    <div class="row">
    <div class="col-md-3">
            <div class="form-group">
                <label for="nome">Diagnóstico:<b><?php echo $paciente->diagnostico  ?></b></label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="nome">Status:<b><?php echo $paciente->status_now  ?></b></label>
            </div>
        </div>


     <?php $rota3 = BASEURL . '/prescricoes/modalFormularioPrescricaoIndex';?>
    <button type="submit" class="btn btn-success btn-sm button-salvar-clientes"
            style="float:right"
            onclick="modalFormularioPrescricaoIndex('<?php echo $rota3;?>', '<?php echo $paciente->id;?>')">
        <i class="fas fa-file-alt"></i> Prescrições
    </button>

</form>

<script src="<?php echo BASEURL; ?>/js/maskedInput.js"></script>

<?php Modal::start([
    'id' => 'modalPrescricaoIndex',
    'width' => 'modal-lg',
    'title' => 'Prescrições'
]); ?>

<div id="index"></div>

<?php Modal::stop(); ?>

<script>
    function modalFormularioPrescricaoIndex(rota, id) {
        var url = "";

        if (id) {
            url = rota + "/" + id;
        } else {
            url = rota;
        }

        $("#index").html("<center><h3>Carregando...</h3></center>");
        $("#modalPrescricaoIndex").modal({backdrop: 'static'});
        $("#index").load(url);
    }

    // Anula duplo click em salvar
    anulaDuploClick($('form'));



</script>
