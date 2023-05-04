<!--Usando o Html Components-->
<?php use System\HtmlComponents\Modal\Modal; ?>

<style type="text/css">
    .liberados {
        color: #9ea1a6;
    }
</style>

<div class="row">

    <div class="card col-lg-12 content-div">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-user-injured"></i> Pacientes Internados</h5>
        </div>

        <?php if (count($pacientes)>0): ?>
            <table id="example" class="table tabela-ajustada table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th >Idade</th>
                    <th>Leito</th>
                    <th>Data de Intern.</th>
                    <th>Municipio Orig.</th>
                    <th>Prontuário</th>
                    <th>Status</th>
                    <th style="text-align:right;padding-right:0">
                        <?php $rota = BASEURL . '/paciente/modalFormulario'; ?>
                        <button onclick="modalFormularioPacientes('<?php echo $rota; ?>', false);"
                                class="btn btn-sm btn-success" title="Novo Paciente">
                            <i class="fas fa-plus"></i>
                        </button>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($pacientes as $paciente): ?>
                     <?php if ($paciente->status_now == 'Internado'): ?>
                    <tr>
                        <?php $rota2 = BASEURL . '/paciente/modalVisualizarPaciente'; ?>
                        <td style="cursor: pointer" onclick="modalVisualizarPaciente('<?php echo $rota2; ?>', '<?php echo $paciente->id; ?>', '<?php echo $paciente->nome; ?>')">

                            <?php echo $paciente->nome; ?>
                        </td>
                        <td><?php echo $paciente->idade; ?></td>
                        <?php foreach ($leitos as $leito): ?>
                            <?php if ($leito->id==$paciente->id_leito): ?>
                                <td><?php echo $leito->descricao; ?></td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <td><?php echo $paciente->data_inter; ?></td>
                        <td><?php echo $paciente->municip_orig; ?></td>
                        <td><?php echo $paciente->prontuario; ?></td>
                        <td><?php echo $paciente->status_now; ?></td>

                        <td style="text-align:right">
                            <div class="btn-group" role="group">

                                <button id="btnGroupDrop1" type="button"
                                        class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cogs"></i>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                    <button class="dropdown-item" href="#"
                                            onclick="modalFormularioPacientes('<?php echo $rota; ?>', '<?php echo $paciente->id; ?>')">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>


                                        <button class="dropdown-item" href="#"
                                                onclick="modalVisualizarPaciente('<?php echo $rota2; ?>', '<?php echo $paciente->id; ?>', '<?php echo $paciente->nome; ?>')">
                                            <i class="fas fa-eye"></i> Ver
                                        </button>


                                </div>
                            </div>

                        </td>
                    </tr>
                   <?php endif; ?>
                <?php endforeach; ?>
                <tfoot></tfoot>
            </table>
    </div>
</div> <!--Final da primeira tabela-->

            <!-- Tabela dos outros pacientes -->

<div class="row">

        <div class="card col-lg-12 content-div">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-user"></i> Pacientes Liberados</h5>
            </div>


            <table id="example" class="table tabela-ajustada table-striped" style="width:100%">
                <thead>
                <tr class="liberados">
                    <th>Nome</th>
                    <th>Idade</th>
                    <th>Leito</th>
                    <th>Data de Intern.</th>
                    <th>Municipio Orig.</th>
                    <th>Prontuário</th>
                    <th>Status</th>

                </tr>
                </thead>
                <tbody>
                <?php foreach ($pacientes as $paciente): ?>
                     <?php if ($paciente->status_now != 'Internado'): ?>
                    <tr class="liberados">
                        <?php $rota2 = BASEURL . '/paciente/modalVisualizarPaciente'; ?>
                        <td style="cursor: pointer" onclick="modalVisualizarPaciente('<?php echo $rota2; ?>', '<?php echo $paciente->id; ?>', '<?php echo $paciente->nome; ?>')">

                            <?php echo $paciente->nome; ?>
                        </td>
                        <td><?php echo $paciente->idade; ?></td>
                        <?php foreach ($leitos as $leito): ?>
                            <?php if ($leito->id==$paciente->id_leito): ?>
                                <td><?php echo $leito->descricao; ?></td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <td><?php echo $paciente->data_inter; ?></td>
                        <td><?php echo $paciente->municip_orig; ?></td>
                        <td><?php echo $paciente->prontuario; ?></td>
                        <td><?php echo $paciente->status_now; ?></td>

                        <td style="text-align:right">
                            <div class="btn-group" role="group">

                                <button id="btnGroupDrop1" type="button"
                                        class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cogs"></i>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                    <button class="dropdown-item" href="#"
                                            onclick="modalFormularioPacientes('<?php echo $rota; ?>', '<?php echo $paciente->id; ?>')">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>


                                        <button class="dropdown-item" href="#"
                                                onclick="modalVisualizarPaciente('<?php echo $rota2; ?>', '<?php echo $paciente->id; ?>', '<?php echo $paciente->nome; ?>')">
                                            <i class="fas fa-eye"></i> Ver
                                        </button>


                                </div>
                            </div>

                        </td>
                    </tr>
                   <?php endif; ?>
                <?php endforeach; ?>
                <tfoot></tfoot>
            </table>


        <?php else: ?>
            <center>
                <i class="far fa-grin-beam" style="font-size:50px;opacity:0.60"></i> <br> <br>
                Nenhum registro encontrado. <br>
                <?php $rota = BASEURL . '/paciente/modalFormulario'; ?>
                <button
                    onclick="modalFormularioPacientes('<?php echo $rota; ?>', null);"
                    class="btn btn-sm btn-success">
                    <i class="fas fa-plus"></i>
                    Cadastrar Paciente
                </button>
            </center>
        <?php endif; ?>

        <br>

    </div>
</div>

<!--Modal Pacientes-->
<?php Modal::start([
    'id' => 'modalPacientes',
    'width' => 'modal-lg',
    'title' => 'Cadastrar Pacientes'
]); ?>
<div id="formulario"></div>
<?php Modal::stop(); ?>


<!--Modal Visualizar dados dos Pacientes-->
<?php Modal::start([
    'id' => 'modalVisualizarPaciente',
    'width' => 'modal-lg',
    'title' => '<i class="fas fa-user-injured" style="color:#ad54da"></i>'
]); ?>
<div id="ModalVisualizarPaciente"></div>
<?php Modal::stop(); ?>


<script>
    function modalFormularioPacientes(rota, id) {
        var url = "";

        if (id) {
            url = rota + "/" + id;
        } else {
            url = rota;
        }

        $("#formulario").html("<center><h3>Carregando...</h3></center>");
        $("#modalPacientes").modal({backdrop: 'static'});
        $("#formulario").load(url);
    }

    function modalVisualizarPaciente(rota, idPaciente, nomePaciente) {
        var url = rota + "/" + idPaciente;


        $("#ModalVisualizarPaciente").html("<center><h3>Carregando...</h3></center>");
        $("#modalVisualizarPaciente").modal({backdrop: 'static'});
        $("#modalVisualizarPaciente .modal-title").html("<b>" + nomePaciente + "</b>");
        $("#ModalVisualizarPaciente").load(url);
    }

    function modalFormularioEndereco(rota, idPaciente, id) {
        var url = "";

        if (id) {
            url = rota + "/" + idPaciente + "/" + id;
        } else {
            url = rota + "/" + idPaciente;
        }

        $("#modalEnderecoFormulario").html("<center><h3>Carregando...</h3></center>");
        $("#modalFormulario").modal({backdrop: 'static'});

        $("#modalEnderecoFormulario").load(url);
    }

    function modalAtivarEdesativarPaciente(id, nome, operacao) {
        if (operacao == 'desativar') {
            $("#nomePaciente").html('Tem certeza que deseja desativar o Paciente ' + nome + '?');
            $("set-modal-button").html('<button class="btn btn-sm btn-success" id="buttonDesativarPaciente" data-id-Paciente="" onclick="desativarPaciente(this)"><i class="far fa-check-circle"></i> Sim</button>');

        } else if (operacao == 'ativar') {
            $("set-modal-button").html('<button class="btn btn-sm btn-success" id="buttonDesativarPaciente" data-id-Paciente="" onclick="ativarPaciente(this)"><i class="far fa-check-circle"></i> Sim</button>');
            $("#nomePaciente").html('Você deseja ativar o Paciente ' + nome + '?');
        }

        $("#modalDesativarPaciente").modal({backdrop: 'static'});
        document.querySelector("#buttonDesativarPaciente").dataset.idPaciente = id;
    }

    function desativarPaciente(elemento) {
        modalValidacao('Validação', 'Desativando Paciente...');
        id = elemento.dataset.idPaciente;

        var rota = getDomain() + "/paciente/desativarPaciente/" + id;
        $.get(rota, function (data, status) {
            var dados = JSON.parse(data);
            if (dados.status == true) {
                location.reload();
                //$("#modalDesativarPaciente .close").click();
            }
        });
    }

    function ativarPaciente(elemento) {
        modalValidacao('Validação', 'Ativando Paciente...');
        id = elemento.dataset.idPaciente;

        var rota = getDomain() + "/paciente/ativarPaciente/" + id;
        $.get(rota, function (data, status) {
            var dados = JSON.parse(data);
            if (dados.status == true) {
                location.reload();
                //$("#modalDesativarPaciente .close").click();
            }
        });
    }
</script>
