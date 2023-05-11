<?php

namespace App\Controllers;

use App\Models\Prescricao;
use App\Models\Paciente;
use App\Rules\Logged;
use System\Controller\Controller;
use System\Get\Get;
use System\Post\Post;
use System\Session\Session;

class PrescricaoController extends Controller
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
        $this->idPerfilUsuarioLogado = Session::get('idPerfil');
        $this->idHospital = Session::get('idHospital');

        $logged = new Logged();
        $logged->isValid();
    }



    public function save()
    {
        if ($this->post->hasPost()) {
            $prescricao = new Prescricao();
            $dados = (array)$this->post->data();


            try {
                 $prescricao->save($dados);
                return $this->get->redirectTo("prescricoes/index");

            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
    }




}
