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
                <div class="col-md-8">
                    <label><b> Item </b></label>
                </div>
                <div class="col-md-3">
                    <label><b> Hora de início </b></label>
                </div>
                <div class="col-md-1">
                    <label><b>  </b> <?php //echo $camposConteudo[0]['item']; ?></label>
                </div>
</div>


<?php $usuario = Session::get('idUsuario'); ?>
<?php if(($usuario==$prescricao->id_medico)): ?>

        <div class="form-group">
            <div id="item-container">
                <?php for ($i = 0; $i < count($camposConteudo);$i++): ?>
                    <div class="row">
                    <?php $checke = ($camposConteudo[$i]['suspenso'] != 'false') ? "highlight" : "" ?>
                            <div class="col-md-8">
                            <?php echo ('<input type="text" class="form-control '.$checke.'" readonly
                                    name="item[]" value="'.$camposConteudo[$i]['item'].'">'); ?>                          </div>
                            <div class="col-md-3">
                            <?php echo ('<input type="text" class="form-control '.$checke.'" readonly
                                    name="item_time[]" value="'.$camposConteudo[$i]['inicio'].'"/>'); ?>
                            </div>
                            <input type="hidden" name="item_time_check[]" value="<?php echo $camposConteudo[$i]['suspenso'];?>" />

                            <div class="col-md-1">
                            <?php if($checke == ""): ?>
                            <i class="material-icons" style="color:red; cursor:pointer;" onclick="statusCampo(this)">cancel</i>

                            <?php endif; ?>
                            </div>
                    </div>
                <?php endfor ?>
            </div>
            <button type="button" class="btn btn-success btn-sm" onclick="acrescentaItem()">adicionar item</button>
            <button type="button" class="btn btn-info btn-sm" onclick="obterDados()">ver</button>
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
                    <div class="col-md-10">
                        <input type="text" class="form-control" readonly
                            value="<?php echo $camposConteudo[$i]['item'];?>"/>
                    </div>
                    <div class="col-md-2">
                    <input type="text" class="form-control" readonly
                            value="<?php echo $camposConteudo[$i]['inicio'];?>"/>
                    </div>

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
                botao.style.color = row.classList.contains("highlight") ? "green" : "red";
                if(inputs[i].name == "item_time_check[]"){
                    inputs[i].value = inputs[i].value=="false" ? "true" : "false";
                }

                //console.log(<?php //echo $camposConteudo[1]['suspenso']; ?>);
            }

    }

    function acrescentaItem() {
      let container = document.getElementById("item-container");
      let novoCampo = document.createElement("input");
      let novoCampoTime = document.createElement("input");
      let checkBox = document.createElement("input");
      let deleteItem = document.createElement("i");
      let linha = document.createElement("div");
      let coluna1 = document.createElement("div");
      let coluna2 = document.createElement("div");
      let coluna3 = document.createElement("div");

      //console.log(deleteItem);

      linha.classList.add("row");
      coluna1.classList.add("col-md-8");
      coluna2.classList.add("col-md-3");
      coluna3.classList.add("col-md-1");

      checkBox.name = "item_time_check[]";
      checkBox.type = "hidden";
      checkBox.value = "false";
      checkBox.classList.add("form-control");


      novoCampo.type = "text";
      novoCampoTime.type = "time";
      novoCampo.name = "item[]";
      novoCampoTime.name = "item_time[]";
      novoCampo.classList.add("form-control");
      novoCampoTime.classList.add("form-control");
      novoCampo.placeholder = "Digite aqui!";


      deleteItem.classList.add("fas");
      deleteItem.classList.add("fa-trash-alt");
      deleteItem.style.color = "red";
      deleteItem.style.cursor = "pointer";
      deleteItem.onclick = function() {
                                       deletaLinha(this);
                                      };


      coluna1.appendChild(novoCampo);
      coluna2.appendChild(novoCampoTime);
      coluna3.appendChild(checkBox);
      coluna3.appendChild(deleteItem);
      linha.appendChild(coluna1);
      linha.appendChild(coluna2);
      linha.appendChild(coluna3);
      container.appendChild(linha);
    }

    function deletaLinha(botao){
        let row = botao.parentNode.parentNode;
        row.parentNode.removeChild(row);

    }
</script>
