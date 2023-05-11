<!--Usando o Html Components-->
<?php use System\HtmlComponents\Modal\Modal; ?>

<div class="row">

    <div class="card col-lg-12 content-div">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-store"></i> Prescrições</h5>
        </div>
      <?php if(count($prescricoes) > 0): ?>
        <table id="example" class="table tabela-ajustada table-striped" style="width:100%">
            <thead>
            <tr>
                <th>Data</th>
                <th>Médico</th>

                <th style="text-align:right;padding-right:0">
                    <?php $rota = BASEURL . '/prescricao/modalFormulario'; ?>
                    <button onclick="modalFormularioPrescricao('<?php echo $rota; ?>', null);"
                            class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i>

                    </button>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($prescricoes as $prescricao): ?>
               <?php if($prescricao->id_paciente == $idPaciente): ?>
                <tr>
                    <td><?php echo date('d/m/Y', strtotime($prescricao->created_at)); ?></td>
                    <td><?php echo $prescricao->id_medico; ?></td>


                    <td style="text-align:right">
                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary dropdown-toggle"
                                onclick="modalFormularioPrescricao('<?php echo $rota; ?>', '<?php echo $hospital->id; ?>');">
                            <i class="fas fa-cogs"></i>
                        </button>
                    </td>
                </tr>
               <?php endif; ?>
            <?php endforeach; ?>
            <tfoot></tfoot>
        </table>

        <br>

     <?php else: ?>
        <center>
                <i class="far fa-grin-beam" style="font-size:50px;opacity:0.60"></i> <br> <br>
                Nenhum registro encontrado. <br>
                <?php $rota = BASEURL . '/prescricao/modalFormulario'; ?>
                    <button onclick="modalFormularioPrescricao('<?php echo $rota; ?>', '<?php echo $idPaciente; ?>');"
                            class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i>

                    </button>
        </center>
    <?php endif; ?>

    </div>
</div>



<?php Modal::start([
    'id' => 'modalPrescricao',
    'width' => 'modal-lg',
    'title' => 'Cadastrar Prescricao'
]); ?>

<div id="formulario"></div>

<?php Modal::stop(); ?>

<script>
    function modalFormularioPrescricao(rota, id) {
        var url = "";

        if (id) {
            url = rota + "/" + id;
        } else {
            url = rota;
        }

        $("#formulario").html("<center><h3>Carregando...</h3></center>");
        $("#modalPrescricao").modal({backdrop: 'static'});
        $("#formulario").load(url);
    }
</script>
