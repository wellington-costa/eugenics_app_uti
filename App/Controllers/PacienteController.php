<?php

namespace App\Controllers;

use App\Models\Paciente;
use App\Models\Leito;

use App\Rules\Logged;
use Exception;
use System\Controller\Controller;
use System\Get\Get;
use System\Post\Post;
use System\Session\Session;

class PacienteController extends Controller
{
    protected $post;
    protected $get;
    protected $layout;
    protected $idHospital;
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

        $paciente = new Paciente();
        $pacientes = $paciente->pacientes($this->idHospital);

        $leito = new Leito();
        $leitos = $leito->leitos();



        $this->view('paciente/index', $this->layout, compact("pacientes","leitos"));
    }


    public function save()
    {
        if ($this->post->hasPost()) {
            $paciente = new Paciente();
            $leito = new Leito();
            $dados = (array)$this->post->data();
            $dados['id_hospital'] = $this->idHospital;

            $dados['idade'] = $paciente->calculaIdade($dados['data_nasc']);



            try {
                $paciente->save($dados);
                if(isset($dados['id_leito'])){
                    if($dados['status_now']=='Internado'){
                      (array)$updateLeito['status_now'] = 1;
                       $leito->update($updateLeito, $dados['id_leito']);



                    }else{
                       (array)$updateLeito['status_now'] = 0;
                       $leito->update($updateLeito, $dados['id_leito']);

                    }
               }

                return $this->get->redirectTo("paciente");

            } catch (Exception $e) {
                echo($e->getMessage());
            }
        }
    }

    public function update()
    {
        $paciente = new Paciente();
        $leito = new Leito();
        $dadospaciente = $paciente->find($this->post->data()->id);
        $dados = (array)$this->post->only([
            'id_leito','status_now','diagnostico','data_nasc'
        ]);
        $dadosLeito = $leito->find($dadospaciente->id_leito);

        $dados['id_hospital'] = $this->idHospital;

        $dados['idade'] = $paciente->calculaIdade($dados['data_nasc']);


        if($dadospaciente->status != $dados['status_now']){
            $dados['status_at'] = date('Y-m-d H:i:s');
        }


        try {
            if(isset($dados['id_leito'])){
                if($dados['status_now']=='Internado'){
                   if($dados['id_leito']==$dadospaciente->id_leito){
                    (array)$updateLeito['status_now'] = 1;
                    $leito->update($updateLeito, $dadosLeito->id);
                   }else{
                    (array)$updateLeitoAntigo['status_now'] = 0;
                    (array)$updateLeitoNovo['status_now'] = 1;
                    $leito->update($updateLeitoAntigo, $dadospaciente->id_leito);
                    $leito->update($updateLeitoNovo, $dados['id_leito']);

                   }
                }else{
                   (array)$updateLeito['status_now'] = 0;
                   $leito->update($updateLeito, $dadosLeito->id);

                }
                $paciente->update($dados, $dadospaciente->id);
           }


            return $this->get->redirectTo("paciente");

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function modalFormulario($idPaciente = false)
    {
        $paciente = false;

        if ($idPaciente) {
            $paciente = new Paciente();
            $paciente = $paciente->find($idPaciente);
        }

        $leito = new Leito();
        $leitos = $leito->leitos();


        $this->view('paciente/formulario', null,
            compact(
                'paciente',
                'leitos'

            ));
    }




    public function modalVisualizarPaciente($idPaciente)
    {
        $paciente = new Paciente();
        $paciente = $paciente->find($idPaciente);


        $this->view('paciente/visualizar', null, compact('paciente'));


    }


}
