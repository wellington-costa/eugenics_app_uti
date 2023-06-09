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

        <div class="col-md-6">
            <div class="form-group">
                <label for="data_nasc">Data de nascimento: <b><?php echo date('d/m/Y', strtotime($paciente->data_nasc));  ?></b></label>
            </div>
        </div>
        <div class="col-md-3">
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

        <div class="col-md-6">
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
    </div><!--end row-->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nome">Diagnóstico:<b><?php echo $paciente->diagnostico  ?></b></label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="altura">Altura: <b><?php echo $paciente->altura  ?> m </b></label>
            </div>
        </div>


        <div class="col-md-3">
            <div class="form-group">
                <label for="prontuario">Nº Prontuário: <b> <?php echo $paciente->prontuario  ?></b></label>
            </div>
        </div>
    </div><!--end row-->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="data_inter">Data de Admissão na UTI: <b><?php echo date('d/m/Y H:i:s', strtotime($paciente->data_inter));  ?></b></label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="nome">Data de Admissão HRE:<b><?php echo date('d/m/Y H:i:s', strtotime($paciente->data_admissao));  ?></b></label>
            </div>
        </div>


    </div><!--end row-->
    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <label for="nome">**Alergias:<b><?php echo $paciente->alergias  ?></b></label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="nome">Status:<b><?php echo $paciente->status_now  ?></b></label>
            </div>
        </div>

    </div>


        </br>
        </br>
<?php if($paciente->status_now == "Internado"):?>
<div class="row">
       <div class="col-lg-4 col-md-7 col-sm-7">
        <center><h4><b>Prescrição</b></h4></center>
        </div>
        <div class="col-lg-4 col-md-7 col-sm-7">
        <center><h4><b>Evolução</b></h4></center>
        </div>
</div>
<?php endif; ?>
<div class="row">

    <div class="card col-lg-4 col-md-7 col-sm-7 content-div">

      <?php if(isset($prescricao->id)): ?>
        <table id="example" class="table tabela-ajustada table-striped" style="width:100%">
            <thead>
            <tr>
                <th>Criada em:</th>
                <th>Atualizada em:</th>
                <th>Médico</th>

                <th style="text-align:right;padding-right:0">
                    <?php $rota2 = BASEURL . '/paciente'; ?>
                    <button onclick="modalFormularioPrescricao('<?php echo $rota2; ?>', '<?php echo $idPaciente; ?>');"
                            class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i>

                    </button>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php //foreach ($prescricoes as $prescricao): ?>
               <?php //if($prescricao->id_paciente == $idPaciente): ?>
                <tr>
                    <?php $rota3 = BASEURL . '/paciente/modalVisualizaPrescricao'; ?>
                    <td style="cursor: pointer" onclick="modalVisualizarPrescricao('<?php echo $rota3; ?>', '<?php echo $prescricao->id; ?>');"><?php echo date('d/m/Y H:i:s', strtotime($prescricao->created_at)); ?></td>
                    <td style="cursor: pointer" onclick="modalVisualizarPrescricao('<?php echo $rota3; ?>', '<?php echo $prescricao->id; ?>');"><?php echo date('d/m/Y H:i:s', strtotime($prescricao->updated_at)); ?></td>
                    <td style="cursor: pointer" onclick="modalVisualizarPrescricao('<?php echo $rota3; ?>', '<?php echo $prescricao->id; ?>');"><?php echo $usuario->nome; ?></td>


                    <td style="text-align:right">
                     <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary"
                        onclick="modalVisualizarPrescricao('<?php echo $rota3; ?>', '<?php echo $prescricao->id; ?>');">
                            <i class="fas fa-file-alt"></i>
                        </button>

                     </div>
                   </td>
                </tr>
               <?php //endif; ?>
            <?php //endforeach; ?>
            <tfoot></tfoot>
        </table>

        <br>

     <?php else: ?>
        <?php if($paciente->status_now == "Internado"): ?>
        <center>
                <i class="far fa-grin-beam" style="font-size:50px;opacity:0.60"></i> <br> <br>
                Nenhum registro encontrado. <br>
                <?php $rota2 = BASEURL . '/paciente'; ?>
                    <button onclick="modalFormularioPrescricao('<?php echo $rota2; ?>', '<?php echo $idPaciente; ?>');"
                            class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i>

                    </button>
        </center>
       <?php endif ?>
    <?php endif; ?>

    </div>
    <div class="col-lg-1 col-md-1 col-sm-1"></div>
    <div class="card col-lg-4 col-md-7 col-sm-7 content-div">

      <?php if(isset($prescricao->id)): ?>
        <table id="example" class="table tabela-ajustada table-striped" style="width:100%">
            <thead>
            <tr>
                <th>Criada em:</th>
                <th>Atualizada em:</th>
                <th>Médico</th>

                <th style="text-align:right;padding-right:0">
                    <?php $rota2 = BASEURL . '/paciente'; ?>
                    <button onclick="modalFormularioPrescricao('<?php echo $rota2; ?>', '<?php echo $idPaciente; ?>');"
                            class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i>

                    </button>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php //foreach ($prescricoes as $prescricao): ?>
               <?php //if($prescricao->id_paciente == $idPaciente): ?>
                <tr>
                    <?php $rota3 = BASEURL . '/paciente/modalVisualizaPrescricao'; ?>
                    <td style="cursor: pointer" onclick="modalVisualizarPrescricao('<?php echo $rota3; ?>', '<?php echo $prescricao->id; ?>');"><?php echo date('d/m/Y H:i:s', strtotime($prescricao->created_at)); ?></td>
                    <td style="cursor: pointer" onclick="modalVisualizarPrescricao('<?php echo $rota3; ?>', '<?php echo $prescricao->id; ?>');"><?php echo date('d/m/Y H:i:s', strtotime($prescricao->updated_at)); ?></td>
                    <td style="cursor: pointer" onclick="modalVisualizarPrescricao('<?php echo $rota3; ?>', '<?php echo $prescricao->id; ?>');"><?php echo $usuario->nome; ?></td>


                    <td style="text-align:right">
                     <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary"
                        onclick="modalVisualizarPrescricao('<?php echo $rota3; ?>', '<?php echo $prescricao->id; ?>');">
                            <i class="fas fa-file-alt"></i>
                        </button>

                     </div>
                   </td>
                </tr>
               <?php //endif; ?>
            <?php //endforeach; ?>
            <tfoot></tfoot>
        </table>

        <br>

     <?php else: ?>
        <?php if($paciente->status_now == "Internado"): ?>
        <center>
                <i class="far fa-grin-beam" style="font-size:50px;opacity:0.60"></i> <br> <br>
                Nenhum registro encontrado. <br>
                <?php $rota2 = BASEURL . '/paciente'; ?>
                    <button onclick="modalFormularioPrescricao('<?php echo $rota2; ?>', '<?php echo $idPaciente; ?>');"
                            class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i>

                    </button>
                    <?php $rota3 = BASEURL . '/prescricoes/cadastrar/' . $idPaciente; ?>
                    <a href="<?php echo $rota3; ?>"
                    class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i>
                    </a>
        </center>
       <?php endif ?>
    <?php endif; ?>

    </div>

</div><!-- Fim de Linha -->



<script src="<?php echo BASEURL; ?>/js/maskedInput.js"></script>

<script>
    function recarregar(){
        if (window.location.href.indexOf("paciente") > -1 && !sessionStorage.getItem("reloadFlag")) {
                sessionStorage.setItem("reloadFlag", "paciente");
                window.location.reload();
        }
}
</script>

<?php Modal::start([
    'id' => 'visualizarPrescricao',
    'width' => 'modal-lg',
    'title' => 'Prescrição'
]); ?>

<div id="modalVisualizarPrescricao"></div>

<?php Modal::stop(); ?>

<?php Modal::start([
    'id' => 'modalPrescricao',
    'width' => 'modal-lg',
    'title' => 'Cadastrar Prescrição'
]); ?>

<div id="formularioPrescricao"></div>

<?php Modal::stop(); ?>

<script>
    function modalVisualizarPrescricao(rota, id) {
        var url = "";

        if (id) {
            url = rota + "/" + id;
        } else {
            url = rota;
        }

        $("#modalVisualizarPrescricao").html("<center><h3>Carregando...</h3></center>");
        $("#visualizarPrescricao").modal({backdrop: 'static'});
        $("#modalVisualizarPrescricao").load(url);
    }

    function modalFormularioPrescricao(rota, id) {
        var url = "";

        if (id) {
            url = rota + "/" + id + "/formularioPrescricao";
        } else {
            url = rota;
        }

        $("#formularioPrescricao").html("<center><h3>Carregando...</h3></center>");
        $("#modalPrescricao").modal({backdrop: 'static'});
        $("#formularioPrescricao").load(url);
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
