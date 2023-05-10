<?php

namespace App\Controllers;

use App\Models\Leito;
use App\Models\Paciente;
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
    protected $idUsuario;
    protected $idPerfilUsuarioLogado;

    public function __construct()
    {
        parent::__construct();
        $this->layout = 'default';

        $this->post = new Post();
        $this->get = new Get();


        $this->idHospital = Session::get('idHospital');
        $this->idUsuario = Session::get('idUsuario');
        $this->idPerfilUsuarioLogado = Session::get('idPerfil');

        $logged = new Logged();
        $logged->isValid();
    }

    public function index()
    {
        //echo "<pre align='center'>"; print_r($_SESSION); echo "</pre>";

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
                'qtdPacientesInternadosDia',
                'qtdPacientesInternadosPorDia',
                'qtdPacientesTransferidosPorDia',
                'qtdPacientesAltaPorDia',
                'leitosCadastrados',
                'pacientesCadastrados'

            ));
    }
}
