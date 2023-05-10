<?php use System\HtmlComponents\Charts\Doughnut;
      use App\Config\ConfigPerfil;
      use System\Session\Session; ?>
<style>
    .imagem-perfil {
        width: 30px;
        height: 30px;
        object-fit: cover;
        object-position: center;
        border-radius: 50%;
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

  <?php isset($leitos) ?>
    <?php foreach ($leitos as $leito): ?>
       <div class="col-lg-3 col-md-6 col-sm-6">
         <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-warning">
                            <i class="fas fa-procedures" style="color:#212120"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category" style="font-size:12px;"><?php echo $leito->descricao;?> </p>
                            <p class="card-title" style="font-size:15px">
                            Status: <?php if($leito->status_now=='0'): ?>
                              <?php echo('Disponível'); ?>
                            <?php else: ?>
                               <?php echo 'Ocupado'; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php endforeach; ?>


</div>

<script src="<?php echo BASEURL; ?>/public/assets/js/core/jquery.min.js"></script>
<script src="<?php echo BASEURL; ?>/public/assets/chartjs/dist/Chart.min.js"></script>


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
