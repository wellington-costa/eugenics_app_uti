<?php

namespace App\Controllers;

use App\Models\Cliente;
use App\Models\Leito;
use App\Models\Paciente;
use App\Models\Produto;
use App\Repositories\VendasRepository;
use App\Repositories\PacientesRepository;
use App\Rules\Logged;
use System\Controller\Controller;
use System\Get\Get;
use System\Post\Post;
use System\Session\Session;

class HomeController extends Controller
{
    protected $post;
    protected $get;
    protected $layout;
    protected $vendasRepository;
    protected $pacientesRepository;
    protected $idEmpresa;
    protected $idUsuario;
    protected $idPerfilUsuarioLogado;

    public function __construct()
    {
        parent::__construct();
        $this->layout = 'default';

        $this->post = new Post();
        $this->get = new Get();

        $this->idEmpresa = Session::get('idEmpresa');
        $this->idHospital = Session::get('idHospital');
        $this->idUsuario = Session::get('idUsuario');
        $this->idPerfilUsuarioLogado = Session::get('idPerfil');

        $logged = new Logged();
        $logged->isValid();
    }

    public function index()
    {
        //echo "<pre align='center'>"; print_r($_SESSION); echo "</pre>";
        $vendasRepository = new VendasRepository();
        $pacientesRepository = new PacientesRepository();

        $qtdPacientesInternadosMes = $pacientesRepository->pacientesInternadosMes(
            date('m'), date('Y'), $this->idHospital
        );

        $faturamentoDeVandasNoDia = $vendasRepository->faturamentoDeVendasNoDia(
            date('d'), date('m'), $this->idEmpresa
        );

        $mesAnterior = decrementMonthtFromDate(1);
        $ano = date('Y');
        /** Se o mês anterior for igual a 12, significa que foi ano passado
         * então passa o ano anterior para ser buscado na query os dados de Dezembro do ano passado
         */
        if ($mesAnterior == '12') {
            $ano = date('Y', strtotime('-1 years'));
        }

        $faturamentoDeVandasMesAnterior = $vendasRepository->faturamentoDeVendasNoMes(
            decrementMonthtFromDate(1), $ano, $this->idEmpresa
        );

        $faturamentoDeVandasNoDiaAnterior = $vendasRepository->faturamentoDeVendasNoDia(
            date('d', strtotime(decrementDaysFromDate(1))), date('m'), $this->idEmpresa
        );

        $percentualMeiosDePagamento = $vendasRepository->percentualMeiosDePagamento($this->idEmpresa);

        $quantidadeDeVendasRealizadasPorDia = $vendasRepository->quantidadeDeVendasRealizadasPorDia(
            [], $this->idEmpresa
        );

        $totalVendasPorUsuariosNoMes = $vendasRepository->totalVendasPorUsuariosNoMes($this->idEmpresa, date('m'));

        $cliente = new Cliente();
        $clientesCadastrados = $cliente->quantidadeDeClientesCadastrados($this->idEmpresa);

        $produto = new Produto();
        $produtosCadastrados = $produto->quantidadeDeProdutosCadastrados($this->idEmpresa);

        $produtosMaisVendidosNoMes = $vendasRepository->produtosMaisVendidosNoMes($this->idEmpresa, date('m'), 6);

        $vendasPorMesNoAno = $vendasRepository->vendasPorMesNoAno($this->idEmpresa);

        $leito = new Leito();
        $leitosCadastrados = $leito->quantidadeDeLeitosCadastrados();

        $paciente = new Paciente();
        $pacientesCadastrados = $paciente->quantidadeDePacientesCadastrados($this->idHospital);
        $qtdPacientesInternadosDia = $paciente->pacientesInternadosNoDia(
            date('d'), date('m'), $this->idHospital
        );
        $qtdPacientesTransferidosPorDia = $paciente->pacientesTransferidosNoDia(
            date('d'), date('m'), $this->idHospital
        );
        $qtdPacientesInternadosPorDia = $paciente->pacientesInternadosPorDia($this->idHospital);
        $qtdPacientesAltaPorDia = $paciente->pacientesAltaPorDia($this->idHospital);





        $this->view('home/index', $this->layout,
            compact(
                'qtdPacientesInternadosMes',
                'faturamentoDeVandasNoDia',
                'faturamentoDeVandasMesAnterior',
                'faturamentoDeVandasNoDiaAnterior',
                'percentualMeiosDePagamento',
                'quantidadeDeVendasRealizadasPorDia',
                'qtdPacientesInternadosDia',
                'qtdPacientesInternadosPorDia',
                'qtdPacientesTransferidosPorDia',
                'qtdPacientesAltaPorDia',
                'totalVendasPorUsuariosNoMes',
                'clientesCadastrados',
                'produtosCadastrados',
                'produtosMaisVendidosNoMes',
                'vendasPorMesNoAno',
                'leitosCadastrados',
                'pacientesCadastrados'

            ));
    }
}
