<?php
    use System\Session\Session;

?>

<style>
       .row input {
            color: black; /* Cor padrão do texto dos inputs */
        }

        .row.highlight input {
            color: red; /* Cor do texto dos inputs quando a div está destacada */
            text-decoration: line-through;
        }
        .highlight{
            color: red; /* Cor do texto dos inputs quando a div está destacada */
            text-decoration: line-through;
        }
</style>

<div class="row">
                <div class="col-md-6">
                    <label><b> Item </b></label>
                </div>
                <div class="col-md-2">
                    <label><b>Frequência hrs: </b></label>
                </div>
                <div class="col-md-1">
                    <label><b>  </b> <?php //echo $camposConteudo[0]['item']; ?></label>
                </div>
</div>

<?php $perfil = Session::get('idPerfil'); ?>
<?php $usuario = Session::get('idUsuario'); ?>
<?php if(($usuario==$prescricao->id_medico)): ?>

        <div class="form-group">
            <div id="item-container">
                <?php for ($i = 0; $i < count($camposConteudo);$i++): ?>
                    <div class="row">
                    <?php $checke = ($camposConteudo[$i]['suspenso'] != 'false') ? "highlight" : "" ?>
                            <div class="col-md-6">
                            <?php echo ('<input type="text" class="form-control '.$checke.'" readonly
                                    name="item[]" value="'.$camposConteudo[$i]['item'].'">'); ?>                          </div>
                            <div class="col-md-2">
                            <?php echo ('<input type="text" class="form-control '.$checke.'" readonly
                                    name="item_time[]" value="'.$camposConteudo[$i]['frequencia'].'"/>'); ?>
                            </div>
                            <input type="hidden" name="item_time_check[]" value="<?php echo $camposConteudo[$i]['suspenso'];?>" />

                            <div class="col-md-1">
                            <?php if($checke == ""): ?>
                            <i class="fas fa-toggle-on" style="color:green; cursor:pointer;" onclick="statusCampo(this)"></i>

                            <?php endif; ?>
                            </div>
                    </div>
                <?php endfor ?>
            </div>
            <button type="button" class="btn btn-success btn-sm" onclick="adicionarItem()"><i class="fas fa-plus"></i></button>
            <!--<button type="button" class="btn btn-info btn-sm" onclick="obterDados()">ver</button>-->
        </div>
        <form method="post" action="<?php echo BASEURL . '/paciente/prescricao/update'; ?>" enctype='multipart/form-data'>

                <!-- token de segurança -->
                <input type="hidden" name="_token" value="<?php echo TOKEN; ?>"/>
                <input type="hidden" name="id" value="<?php echo $prescricao->id; ?>">
                <input type="hidden" name="conteudo" id="conteudo"/>
                <button type="submit" class="btn btn-success btn-sm button-salvar-empresa"
                        style="float:right" onclick="obterDados()">
                          <i class="fas fa-save"></i> Salvar
                </button>
        </form>

<?php else: ?>
    <?php for ($i = 0; $i < count($camposConteudo);$i++): ?>
      <?php if($camposConteudo[$i]['suspenso']!='true'): ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" class="form-control" readonly
                            value="<?php echo $camposConteudo[$i]['item'];?>"/>
                    </div>
                  <?php if($perfil == 5 or $perfil==6): ?>
                    <div class="col-md-2">
                    <input type="text" class="form-control" readonly
                            value="<?php echo $camposConteudo[$i]['frequencia'];?>"/>
                    </div>
                  <?php endif; ?>

                </div>
            </div>


      <?php endif; ?>

    <?php endfor ?>

<?php endif?>


<script>

    function statusCampo(botao){

            let row = botao.parentNode.parentNode; // Obter a div "row" pai do botão clicado
            row.classList.toggle("highlight"); // Alternar a classe "highlight" para destacar a div

            // Alterar a cor do texto dos inputs dentro da div
            let inputs = row.getElementsByTagName("input");


            for (let i = 0; i < inputs.length; i++) {
                inputs[i].style.color = row.classList.contains("highlight") ? "red" : "black";
                botao.style.color = row.classList.contains("highlight") ? "red" : "green";
                if(botao.style.color=="red"){
                    botao.classList.remove("fa-toggle-on");
                    botao.classList.add("fa-toggle-off");
                }else{
                    botao.classList.remove("fa-toggle-off");
                    botao.classList.add("fa-toggle-on");
                }
                if(inputs[i].name == "item_time_check[]"){
                    inputs[i].value = inputs[i].value=="false" ? "true" : "false";
                }

                //console.log(<?php //echo $camposConteudo[1]['suspenso']; ?>);
            }

    }

</script>
