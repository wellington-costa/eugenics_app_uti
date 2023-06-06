<?php use System\HtmlComponents\Charts\Doughnut;
      use App\Config\ConfigPerfil;
      use System\Session\Session;
      use System\HtmlComponents\Modal\Modal; ?>

    <style>
    .imagem-perfil {
        width: 30px;
        height: 30px;
        object-fit: cover;
        object-position: center;
        border-radius: 50%;
    }

    .livre{
        background: linear-gradient(rgba(0, 255, 0, 0.5), rgba(0, 255, 0, 0.2));
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }
    .ocupado{
        background: linear-gradient(rgba(255, 0, 0, 0.5), rgba(255, 0, 0, 0.2));
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);

    }



    @media only screen and (max-width: 600px) {

        .imagem-perfil {
            width: 20px;
            height: 20px;
            object-fit: cover;
            object-position: center;
            border-radius: 50%;
        }
    }
</style>

<div class="row">
     <div class="col-5 col-md-5"></div>

     <div class="col-5 col-md-4">
        <?php $rota = BASEURL . '/leito/modalFormulario'; ?>
          <button onclick="modalFormularioLeitos('<?php echo $rota; ?>', false);"
             class="btn btn-sm btn-success" title="Novo Leito">
              <i class="fas fa-plus"></i>
          </button>
    </div>
</div>
</br>
<div class="row">

  <?php isset($leitos) ?>
    <?php foreach ($leitos as $leito): ?>
       <div class="col-lg-4 col-md-7 col-sm-7">
        <?php if($leito->status_now == '0'): ?>
         <div class="card card-stats livre">
        <?php else: ?>
         <div class="card card-stats ocupado">
        <?php endif; ?>
            <div class="card-body ">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-warning">
                            <i class="fas fa-procedures" style="color:#212120"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p  style="font-size:15px;"><b><?php echo $leito->descricao;?></b> </p>
                            <p class="card-title" style="font-size:12px">
                            Status: <?php if($leito->status_now=='0'): ?>
                              <?php echo('Disponível'); ?>
                            <?php else: ?>
                               <?php echo 'Ocupado'; ?>
                            <?php endif; ?> </p>
                            <p class="card-title" style="font-size:10px">Atualizado em: <?php echo $leito->updated_at; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
               <?php isset($pacientes)?>
               <?php foreach ($pacientes as $paciente): ?>
                <?php if ($paciente->id_leito == $leito->id): ?>
                 <?php if ($paciente->status_now == "Internado"): ?>
                <div onclick="paginaPaciente('<?php echo $paciente->id; ?> ');" style="cursor:pointer;">
                    <i class="fas fa-user-injured" style="color:#048e6d"></i>
                    <small>Paciente: <b><?php echo $paciente->nome; ?></b></small>
                    <hr>
                    <small> <?php
                              $dataEntrada = new DateTime($paciente->data_inter);
                              $dataAtual = new DateTime();
                              $diferenca = $dataAtual->diff($dataEntrada);
                              echo $diferenca->days;
                        ?> dias de internação </small>
                    <hr>
                    <small>Diagnóstico: <?php echo $paciente->diagnostico; ?></small>

                </div>
                <?php endif; ?>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
    <?php endforeach; ?>


</div>

<script src="<?php echo BASEURL; ?>/public/assets/js/core/jquery.min.js"></script>
<script src="<?php echo BASEURL; ?>/public/assets/chartjs/dist/Chart.min.js"></script>

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
        let url = "";

        if (id) {
            url = rota + "/" + id;
        } else {
            url = rota;
        }

        $("#formulario").html("<center><h3>Carregando...</h3></center>");
        $("#modalLeito").modal({backdrop: 'static'});
        $("#formulario").load(url);
    }
    function paginaPaciente(id){
           let rota = "<?php echo BASEURL . '/paciente/visualizarPaciente/';?>";
           let url = rota + id;

           window.location.href = url;
    }
</script>

<script>

    var ctx = document.getElementById("grafi-pacientes-internados-no-dia");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [

                <?php echo "\"{$qtdPacientesInternadosDia}\",";?>


            ],
            datasets: [{
                label: 'Quantidade de Internados',
                data: [

                    <?php echo $qtdPacientesInternadosDia . ',';?>

                ],
                backgroundColor: '#b41c23',
                borderColor: '#255949',
                borderWidth: 1,
            }
            ],
        },
        options: {
            responsive: true,
            scales: {
                xAxes: [{
                    ticks: {
                        maxRotation: 90,
                        minRotation: 80
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: false,
                        min: 0
                    }
                }]
            }
        }
    });

    //////////////////////////////////////////////////////////////
    var ctx = document.getElementById("grafi-pacientes-internados-por-dia");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [

                <?php foreach ($qtdPacientesInternadosPorDia as $internados): ?>
                       <?php echo "\"{$internados->datas}\","; ?>
                    <?php endforeach; ?>

            ],
            datasets: [{
                label: 'Quantidade de Internados',
                data: [

                    <?php foreach ($qtdPacientesInternadosPorDia as $internados): ?>
                       <?php echo $internados->quantidade . ','; ?>
                    <?php endforeach; ?>

                ],
                backgroundColor: '#212120',
                borderColor: '#255949',
                borderWidth: 1,
            }
            ],
        },
        options: {
            responsive: true,
            scales: {
                xAxes: [{
                    ticks: {
                        maxRotation: 90,
                        minRotation: 80
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: false,
                        min: 0
                    }
                }]
            }
        }
    });



    ////////////////////////////////////////////////////////



    var ctx = document.getElementById("grafi-pacientes-alta-por-dia");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [

                <?php foreach ($qtdPacientesAltaPorDia as $liberados): ?>
                       <?php echo "\"{$liberados->datas}\","; ?>
                    <?php endforeach; ?>

            ],
            datasets: [{
                label: 'Quantidade de Altas',
                data: [

                    <?php foreach ($qtdPacientesAltaPorDia as $liberados): ?>
                       <?php echo "\"{$liberados->quantidade}\","; ?>
                    <?php endforeach; ?>

                ],
                backgroundColor: '#165ea4',
                borderColor: '#255949',
                borderWidth: 1,
            }
            ],
        },
        options: {
            responsive: true,
            scales: {
                xAxes: [{
                    ticks: {
                        maxRotation: 90,
                        minRotation: 80
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: false,
                        min: 0
                    }
                }]
            }
        }
    });



</script>
