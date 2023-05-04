<style>
.obs {
    background:#fffcf5;
    padding-10px;
    margin-bottom:20px;
    opacity:0.80;
}
</style>

<form method="post"
      action="<?php echo isset($paciente->id) ? BASEURL . '/paciente/update' : BASEURL . '/paciente/save'; ?>"
      enctype='multipart/form-data'>
    <div class="row">
        <input type="hidden" name="_token" value="<?php echo TOKEN; ?>"/>

        <?php if (isset($paciente->id)): ?>
            <input type="hidden" name="id" value="<?php echo $paciente->id; ?>">
        <?php endif; ?>

        <div class="col-md-4">
            <div class="form-group">
                <label for="nome">Nome *</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite aqui..."
                       value="<?php echo isset($paciente->id) ? $paciente->nome : '' ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="data_nasc">Data Nasc.</label>
                <input type="date" class="form-control" name="data_nasc" id="data_nasc"
                       value="<?php echo isset($paciente->id) ? $paciente->data_nasc : '' ?>" onchange="calculaIdade(this)">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="raca">Raça</label>
                <select class="form-control" name="raca" id="raca">
                  <?php if(isset($paciente->raca)): ?>
                    <option value="<?php echo $paciente->raca ?>" selected="selected"><?php echo($paciente->raca);?></option>
                  <?php else: ?>
                    <option value="selecione">Selecione</option>
                    <option value="Amarelo">Amarelo</option>
                    <option value="Branco">Branco</option>
                    <option value="Pardo">Pardo</option>
                    <option value="Preto">Preto</option>
                  <?php endif; ?>

                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="municip_orig">Municipio de Origem</label>
                <input type="text" class="form-control" name="municip_orig" id="municip_orig" placeholder="Digite aqui..."
                       value="<?php echo isset($paciente->id) ? $paciente->municip_orig : '' ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="sexo">Sexo</label>
                <select class="form-control" name="sexo" id="sexo">
                    <?php if(isset($paciente->sexo)): ?>
                        <option value=<?php echo $paciente->sexo ?> selected="selected">
                          <?php echo $paciente->sexo ?></option>
                    <?php else: ?>
                        <option value="Selecione">Selecione</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                    <?php endif; ?>
                </select>
            </div>
        </div>

    </div><!--end row-->
    <div class="row">
    <div class="col-md-4">
            <div class="form-group">
                <label for="setor_entrada">Setor de Entrada</label>
                <select class="form-control" name="setor_entrada" id="setor_entrada">
                  <?php if(isset($paciente->setor_entrada)):?>
                    <option value=<?php echo $paciente->setor_entrada ?> selected="selected">
                          <?php echo $paciente->setor_entrada ?></option>
                    <option value="Ala Vermelha">Ala Vermelha</option>
                    <option value="Bloco Cirúrgico">Bloco Cirurgico</option>
                    <option value="Centro Cirúrgico">Centro Cirúrgico</option>
                    <option value="Ala Amarela">Ala Amarela</option>
                  <?php else: ?>
                    <option value="selecione">Selecione</option>
                    <option value="Ala Vermelha">Ala Vermelha</option>
                    <option value="Bloco Cirúrgico">Bloco Cirurgico</option>
                    <option value="Centro Cirúrgico">Centro Cirúrgico</option>
                    <option value="Ala Amarela">Ala Amarela</option>
                  <?php endif; ?>

                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="data_inter">Data de Internação</label>
                <input type="datetime-local" class="form-control" name="data_inter" id="data_inter"
                       value="<?php echo isset($paciente->id) ? $paciente->data_inter : '' ?>" required>
            </div>
        </div>
        <div class="col-md-4">

            <div class="form-group">
                <label for="leito">Leito</label>

                <select class="form-control" name="id_leito" id="id_leito" onchange='selecionaLeito(this)'>
                        <option value="selecione">Selecione</option>
                    <?php foreach ($leitos as $leito): ?>

                        <?php if (isset($paciente->id) && $paciente->id_leito==$leito->id) : ?>
                            <option value="<?php echo $paciente->id_leito; ?>" selected="selected">
                                <?php echo $leito->descricao ?> </option>
                        <?php else : ?>
                            <?php if($leito->status_now == 0): ?>

                                <option value="<?php echo $leito->id; ?>"> <?php echo $leito->descricao ?></option>
                            <?php endif; ?>
                     <?php endif; ?>
                    <?php endforeach;?>
                </select>



            </div>
        </div>

    </div><!--end row-->
    <div class="row">
       <div class="col-md-4">
            <div class="form-group">
                <label for="arq_prontuario">Prontuário</label>
                <input type="file" class="form-control" name="arq_prontuario" id="arq_prontuario" > <br>
                <img src="" class="imagem-produto" id="thumb" style="display:none">
                <?php if (isset($paciente->id) && ! is_null($paciente->arq_prontuario)): ?>
                    <img src="<?php echo BASEURL . '/' . $paciente->arq_prontuario; ?>" class="imagem-produto _padrao">
                <?php else: ?>
                    <i class="fas fa-file-alt _padrao" style="font-size:40px"></i>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="prontuario">Nº Prontuário</label>
                <input type="text" class="form-control" name="prontuario" id="prontuario" required
                       value="<?php echo isset($paciente->prontuario) ? $paciente->prontuario : '' ?>">
            </div>
        </div>


        <div class="col-md-4">
            <div class="form-group">
                <label for="status_now">Status</label>
                <select class="form-control" name="status_now" id="status_now">
                    <?php if(isset($paciente->status_now)): ?>
                        <option value="<?php echo $paciente->status_now; ?>" selected='selected'>
                         <?php echo $paciente->status_now; ?></option>
                        <option value="Internado">Internado</option>
                        <option value="Alta">Alta</option>
                        <option value="òbito">Óbito</option>
                        <option value="Transferido">Transferido</option>
                    <?php else: ?>
                    <option value=0>Selecione</option>
                    <option value="Internado">Internado</option>
                    <option value="Alta">Alta</option>
                    <option value="Óbito">Óbito</option>
                    <option value="Transferido">Transferido</option>
                    <?php endif; ?>
                </select>


            </div>
        </div>

    </div><!--end row-->
    <div class="row">
        <div class="col-md-7">
            <div class="form-group">
                <label for="diagnostico">Diagnóstico</label>
                <textarea class="form-control" name="diagnostico" id="diagnostico" rows="5" cols="80">
                       <?php echo isset($paciente->diagnostico) ? $paciente->diagnostico : 'digite aqui...' ?>
                </textarea>
            </div>
        </div>
    </div><!--end row-->

    <button type="submit" class="btn btn-success btn-sm button-salvar-clientes" style="float:right"
            onclick="return salvarPacientes()">
        <i class="fas fa-save"></i> Salvar
    </button>

</form>

<script src="<?php echo BASEURL; ?>/js/maskedInput.js"></script>
<script>
    // Anula duplo click em salvar
    anulaDuploClick($('form'));
    function salvarPacientes() {


        if ($('#nome').val() == '') {
            modalValidacao('Validação', 'Campo (Nome) deve ser preenchido!');
            return false;

        }
        return true;
    }

    function calculaIdade($dataNasc){
        <?php echo $dataNasc; ?>
    }


</script>
