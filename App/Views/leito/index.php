<!--Usando o Html Components-->
<?php use System\HtmlComponents\Modal\Modal; ?>

<style type="text/css">
    .desativado {
        color: #cc0033;
    }
</style>

<div class="row">

    <div class="card col-lg-12 content-div">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-procedures"></i> Leitos</h5>
        </div>

        <?php if (count($leitos) > 0): ?>
            <table id="example" class="table tabela-ajustada table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Atualizado em:</th>
                    <th style="text-align:right;padding-right:0">
                        <?php $rota = BASEURL . '/leito/modalFormulario'; ?>
                        <button onclick="modalFormularioLeitos('<?php echo $rota; ?>', false);"
                                class="btn btn-sm btn-success" title="Novo Leito">
                            <i class="fas fa-plus"></i>
                        </button>
                    </th>
                </tr>
                </thead>
                <!--<?php //echo(print_r($leitos)); ?>-->
                <tbody>
                <?php foreach ($leitos as $leito): ?>
                    <tr>
                        <td><?php echo $leito->descricao; ?></td>
                        <td>
                            <?php if($leito->status_now=='0'): ?>
                              <?php echo('Disponível'); ?>
                            <?php else: ?>
                               <?php echo 'Ocupado'; ?>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $leito->updated_at; ?></td>

                        <td style="text-align:right">
                            <div class="btn-group" role="group">

                                <button id="btnGroupDrop1" type="button"
                                        class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cogs"></i>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                    <button class="dropdown-item" href="#"
                                            onclick="modalFormularioLeitos('<?php echo $rota; ?>', '<?php echo $leito->id; ?>')">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>
                                </div>
                            </div>

                        </td>
                    </tr>
                <?php endforeach; ?>
                <tfoot></tfoot>
            </table>

        <?php else: ?>
            <center>
                <i class="far fa-grin-beam" style="font-size:50px;opacity:0.60"></i> <br> <br>
                Poxa, ainda não há nenhum Leito cadastrado! <br>
                <?php $rota = BASEURL . '/leito/modalFormulario'; ?>
                <button
                    onclick="modalFormularioLeitos('<?php echo $rota; ?>', null );"
                    class="btn btn-sm btn-success">
                    <i class="fas fa-plus"></i>
                    Cadastrar Leito
                </button>
            </center>
        <?php endif; ?>

        <br>

    </div>
</div>

<!--Modal Leitos-->
<?php Modal::start([
    'id' => 'modalLeito',
    'width' => 'modal-lg',
    'title' => 'Cadastrar Leito'
]); ?>
<div id="formulario"></div>
<?php Modal::stop(); ?>

<script>
    function modalFormularioLeitos(rota, id) {
        var url = "";

        if (id) {
            url = rota + "/" + id;
        } else {
            url = rota;
        }

        $("#formulario").html("<center><h3>Carregando...</h3></center>");
        $("#modalLeito").modal({backdrop: 'static'});
        $("#formulario").load(url);
    }

</script>
