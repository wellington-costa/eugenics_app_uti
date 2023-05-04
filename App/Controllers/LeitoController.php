<?php

namespace App\Controllers;

use App\Models\Leito;
use App\Models\Paciente;
use App\Rules\Logged;
use System\Controller\Controller;
use System\Get\Get;
use System\Post\Post;
use System\Session\Session;

class LeitoController extends Controller
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

        $logged = new Logged();
        $logged->isValid();
    }

    public function index()
    {
        $leito = new Leito();
        $leitos = $leito->leitos();



        $this->view('leito/index', $this->layout, compact("leitos"));
    }

    public function save()
    {
        if ($this->post->hasPost()) {
            $leito = new Leito();
            $dados = (array)$this->post->data();


            try {
                 $leito->save($dados);
                return $this->get->redirectTo("leitos");

            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
    }

    public function update()
    {
        $leito = new Leito();
        $dadosLeito = $leito->find($this->post->data()->id);
        $dados = (array)$this->post->only([
            'descricao','status_now'
        ]);

        try {
            $leito->update($dados, $dadosLeito->id);
            return $this->get->redirectTo("leitos");

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function modalFormulario($idLeito = false)
    {
        $leito = false;

        if ($idLeito) {
            $leito = new Leito();
            $leito = $leito->find($idLeito);
        }





        $this->view('leito/formulario', null,
            compact(
                'leito'

            ));
    }

}
