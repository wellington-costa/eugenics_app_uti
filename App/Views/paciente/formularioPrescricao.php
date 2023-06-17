<?php
    use System\Session\Session;

?>
<style>
    .texta{
        height:310px;
        text-align:left;
    }
</style>

<?php $perfil = Session::get('idPerfil'); ?>
<?php if(($perfil==4) or $perfil==1): ?>

    <div class="row">
                <div class="col-md-6">
                    <label>**Alergias: <b><?php echo $paciente->alergias ?> </b></label>
                </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <label><b> Item </b></label>
                </div>
                <div class="col-md-3">
                    <label><b> Frequência hrs: </b></label>
                </div>
                <div class="col-md-2">
                    <label></label>
                </div>
            </div>

            <div id="item-container">
              <div class="row">
                <div class="col-md-8">

                      <input type="text" class="form-control" name="item[]" placeholder="Medicamento ou orientação">
                </div>
                <div class="col-md-3">
                      <input type="number" class="form-control" name="item_time[]">

                </div>
                <div class="col-md-1">
                      <input type="hidden" class="form-control" name="item_time_check[]" value="false">

                </div>
              </div>

            </div>

            <button type="button" class="btn btn-success btn-sm" onclick="adicionarItem()"><i class="fas fa-plus"></i></button>
            <!--<button type="button" class="btn btn-info btn-sm" onclick="obterDados()">ver</button>-->
        </div>
    </div>

<form method="post"
      action="<?php BASEURL . '/paciente/prescricao/save'; ?>"
      enctype='multipart/form-data'>
      <!-- token de segurança -->
        <input type="hidden" name="_token" value="<?php echo TOKEN; ?>"/>
        <input type="hidden" name="id_paciente" value="<?php echo $paciente->id; ?>">
        <?php $medicoId = Session::get('idUsuario'); ?>
        <input type="hidden" name="id_medico" value="<?php echo $medicoId; ?>">
        <input type="hidden" id="conteudo" name="conteudo">



    <button type="submit" class="btn btn-success btn-sm button-salvar-empresa"
            style="float:right" onclick="obterDados()">
        <i class="fas fa-save"></i> Salvar
    </button>

</form>



<?php else: ?>
    <center>
         <h5>Usuário não tem permissão para acessar!</h5>
    </center>
<?php endif; ?>

<script src="<?php echo BASEURL; ?>/js/maskedInput.js"></script>

<script>
    // Anula duplo click em salvar
    anulaDuploClick($('form'));





</script>
