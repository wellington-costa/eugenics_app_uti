
<?php
    use System\Session\Session;

?>

<?php $perfil = Session::get('idPerfil'); ?>
<?php if(($perfil==4) or $perfil==1): ?>

    <div class="row">
                <div class="col-md-6">
                    <label>**Alergias: <b><?php echo $paciente->alergias ?> </b></label>
                </div>
        </div>
        <div>
            <div class="row">
                <div class="col-md-6">
                    <label><b> Item </b></label>
                </div>
                <div class="col-md-2">
                    <label><b> Frequência hrs: </b></label>
                </div>
                <div class="col-md-1">
                    <label></label>
                </div>
            </div>
            <form method="POST"
                action="<?php BASEURL . '/prescricoes/save'; ?>"
                enctype='multipart/form-data'>
            <div id="item-container" class="form-group">
              <div class="row">
                <div class="col-md-6">

                      <input type="text" class="form-control" name="item[]" placeholder="Medicamento ou orientação">
                </div>
                <div class="col-md-2">
                      <input type="number" class="form-control" name="item_time[]" min="0" max="24" oninput="validateInput(this)">

                </div>
                <div class="col-md-1">
                      <input type="hidden" class="form-control" name="item_time_check[]" value="false">

                </div>
              </div>

            </div>

            <button type="button" class="btn btn-success btn-sm" onclick="adicionarItem()"><i class="fas fa-plus"></i></button>
            <!--<button type="button" class="btn btn-info btn-sm" onclick="obterDados()">ver</button>-->


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
        </div>
    </div>
    <?php else: ?>
    <center>
         <h5>Usuário não tem permissão para acessar!</h5>
    </center>
<?php endif; ?>

<script src="<?php echo BASEURL; ?>/js/maskedInput.js"></script>

<script>
    // Anula duplo click em salvar
    anulaDuploClick($('form'));

    function validateInput(input) {

        if (input.value < 0) {
            input.value = 0; // Define o valor como zero se for negativo
        }
        if(input.value > 24){
            input.value = 24;
        }
  }

  function adicionarItem() {
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
      coluna1.classList.add("col-md-6");
      coluna2.classList.add("col-md-2");
      coluna3.classList.add("col-sm-1");

      checkBox.name = "item_time_check[]";
      checkBox.type = "hidden";
      checkBox.value = "false";
      checkBox.classList.add("form-control");


      novoCampo.type = "text";
      novoCampoTime.type = "number";
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




    function obterDados() {
      let itens = document.getElementsByName("item[]");
      let time = document.getElementsByName("item_time[]");
      let checkBox = document.getElementsByName("item_time_check[]");

      let dados = {};

      for (let i = 0; i < itens.length; i++) {

           dados[i.toString()] = {

                "item" : itens[i].value,
                "frequencia" : time[i].value,
                "suspenso" : checkBox[i].value

         };

      }


      let dadosJSON = JSON.stringify(dados);

      //let dadosJSON1 = JSON.parse(dadosJSON);

      document.getElementById("conteudo").value = dadosJSON;
    }

</script>
