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
    .tbody-totalVendasPorUsuariosNoMes tr td {
        font-size:10px!important;
    }
    .produtos-mais-vendidos {
        overflow-y: scroll;
        height:258px;
    }
    .produtos-mais-vendidos::-webkit-scrollbar-track {
        background-color: white;
    }
    .produtos-mais-vendidos::-webkit-scrollbar {
        width: 10px;
        background: #8d8d96;
    }
    .produtos-mais-vendidos::-webkit-scrollbar-thumb {
        background: #8d8d96;
        border-radius:5px;
    }
    .produtos-mais-vendidos::-webkit-input-placeholder {
        color: #8198ac;
    }
    @media only screen and (max-width: 600px) {
        .totalVendasPorUsuariosNoMes {
            overflow-x: scroll;
        }
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

    <!--<div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-warning">
                            <i class="fas fa-coins" style="color:#212120"></i>
                        </div>
                    </div>

                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category" style="font-size:12px">Vendas deste mês</p>
                            <p class="card-title" style="font-size:15px">
                            <?php //if (Session::get('idPerfil') != ConfigPerfil::vendedor()): ?>
                                R$ <?php //echo real($faturamentoDeVandasNoMes); ?> <br>
                                <small style="font-size:11px;opacity:0.40">
                                    Mês de <?php //echo mesesPorExtensoEnumeroDoMes(date('m')); ?>
                                </small>
                            <?php //endif; ?>
                            <p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">

                    <i class="fas fa-coins" style="color:#048e6d"></i>
                    <small>Mês anterior <b>R$ <?php //if (Session::get('idPerfil') != ConfigPerfil::vendedor()): ?><?php //echo real($faturamentoDeVandasMesAnterior); ?><?php //endif; ?></b></small>

                </div>
            </div>
        </div>
    </div>-->

    <!--<div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-warning">
                            <i class="fas fa-coins" style="color:#212120"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category" style="font-size:12px">Vendas do dia</p>
                            <p class="card-title" style="font-size:15px">
                                R$ <?php //echo real($faturamentoDeVandasNoDia); ?> <br>
                                <small style="font-size:11px;opacity:0.40">
                                    Hoje, <?php //echo diaSemana(date('d/m/Y')); ?>
                                </small>
                            <p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fas fa-coins" style="color:#048e6d"></i>
                    <small>Dia anterior <b>R$ <?php //echo real($faturamentoDeVandasNoDiaAnterior); ?></b></small>
                </div>
            </div>
        </div>
    </div>-->

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-warning">
                            <i class="fas fa-user-injured" style="color:#212120"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category" style="font-size:12px;">Pacientes</p>
                            <p class="card-title" style="font-size:15px">
                            Internados: <?php echo $pacientesCadastrados->internados; ?><p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fas fa-user-injured" style="color:#048e6d"></i>
                    <!--<small>Total: <b><?php //echo $pacientesCadastrados->total; ?></b></small>-->
                    </b></small>
                </div>
            </div>
        </div>
    </div>

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
                            <p class="card-category" style="font-size:12px">Leitos</p>
                            <p class="card-title" style="font-size:15px">
                                Disponíveis: <?php echo $leitosCadastrados->disponiveis; ?><p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fas fa-procedures" style="color:#048e6d"></i>
                    <small>Leitos ocupados <b><?php echo $leitosCadastrados->ocupados; ?></b></small>
                </div>
            </div>
        </div>
    </div>
</div>

  <div class="row">
     <div class="col-lg-6 col-md-6 col-sm-6">
         <div class="card card-stats">
             <div class="card-body">
                <center>
                    Pacientes Internados Hoje.
                    <small style="opacity:0.70">Data atual: <?php echo(date('Y/m/d'));?></small>
                </center>
                <canvas class="grafico" id="grafi-pacientes-internados-no-dia" width="400" height="185"></canvas>
            </div>
         </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
         <div class="card card-stats">
            <div class="card-body">
                <center>
                    Quantidade de pacientes que deram entrada.
                    <small style="opacity:0.70">Últimos 30 dias</small>
                </center>
                <canvas class="grafico" id="grafi-pacientes-internados-por-dia" width="400" height="185"></canvas>
            </div>
          </div>
     </div>
  </div>
  <div class="row">
     <div class="col-lg-6 col-md-6 col-sm-6">
         <div class="card card-stats">
            <div class="card-body">
                <center>
                    Quantidade de pacientes que obtiveram alta.
                    <small style="opacity:0.70">Últimos 30 dias</small>
                </center>
                <canvas class="grafico" id="grafi-pacientes-alta-por-dia" width="400" height="185"></canvas>
            </div>
          </div>
     </div>
  </div>

</div>

<script src="<?php echo BASEURL; ?>/public/assets/js/core/jquery.min.js"></script>
<script src="<?php echo BASEURL; ?>/public/assets/chartjs/dist/Chart.min.js"></script>


<script>
    /*$(".vendas_por_vendedores tbody td").each(function() {
      console.log($(this).text());
    });*/
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





    ////////////////////////////////////////////////////////
   /* var ctx = document.getElementById("grafi-status-pacientes-por-dia");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                <?php //foreach ($valorDeVendasRealizadasPorDia as $valor):?>
                <?php //echo "\"{$valor->data}\",";?>
                <?php //endforeach?>
            ],
            datasets: [{
                label: 'Valor Vendido',
                data: [
                    <?php //foreach ($valorDeVendasRealizadasPorDia as $valor):?>
                    <?php //echo $valor->valor . ',';?>
                    <?php //endforeach?>
                ],
                backgroundColor: '#a0d2ae',
                borderColor: '#087e5e',
                borderWidth: 1
            }
            ]
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
    }); */
</script>
