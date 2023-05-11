<?php
    use System\Session\Session;

?>
<?php $perfil = Session::get('idPerfil'); ?>
<?php if(($perfil==4) or $perfil==1): ?>
<form method="post"
      action="<?php echo isset($prescricao->id) ? BASEURL . '/prescricao/update' : BASEURL . '/prescricao/save'; ?>"
      enctype='multipart/form-data'>
    <!-- token de segurança -->
    <input type="hidden" name="_token" value="<?php echo TOKEN; ?>"/>

    <div class="row">

        <?php if (isset($prescricao->id)) : ?>
            <input type="hidden" name="id" value="<?php echo $prescricao->id; ?>">
        <?php endif; ?>
        <input type="hidden" name="id_paciente" value="<?php echo $idPaciente; ?>">
        <?php $medicoId = Session::get('idUsuario'); ?>
        <input type="hidden" name="id_medico" value="<?php echo $medicoId; ?>">

        <div class="col-md-4">
            <div class="form-group">
                <label for="nome">Prescricao:</label>
                <textarea class="form-control" name="conteudo" id="conteudo" rows="15" cols="80">
                       <?php echo isset($prescricao->conteudo) ? $prescricao->conteudo : 'digite aqui...' ?>
                </textarea>
            </div>
        </div>





    </div>
    <!--end row-->

    <button type="submit" class="btn btn-success btn-sm button-salvar-empresa"
            style="float:right">
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
