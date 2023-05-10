<?php

namespace App\Controllers;

use App\Config\ConfigPerfil;

use App\Models\Hospital;
use App\Models\Usuario;
use App\Rules\Logged;
use App\Rules\UsuarioPermissaoRule;
use Exception;
use System\Controller\Controller;
use System\Get\Get;
use System\Post\Post;
use System\Session\Session;

class HospitalController extends Controller
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
        $hospital = new Hospital();
        $hospitais = $hospital->all();

        $this->view('hospital/index', $this->layout, compact("hospitais"));
    }

    public function save()
    {
        if ($this->post->hasPost()) {
            $hospital = new Hospital();
            $dados = (array)$this->post->data();

            try {
                $hospital->save($dados);

                # Cadastra um tipo de PDV para a hospital
                $configPdv = new ConfigPdv();
                $configPdv->save([
                    'id_hospital' => $hospital->lastId(),
                    'id_tipo_pdv' => 1
                ]);

                # Cadastra um Usuário para hospital
                $usuario = new Usuario();
                $usuario->save([
                    'id_hospital' => $hospital->lastId(),
                    'nome' => $dados['nome'],
                    'email' => $dados['email'],
                    'password' => createHash('33473347'),
                    'id_sexo' => 1,
                    'id_perfil' => ConfigPerfil::adiministrador()
                ]);

                return $this->get->redirectTo("hospital");

            } catch (Exception $e) {
                dd($e->getMessage());
            }
        }
    }

    public function update()
    {
        if ($this->post->hasPost()) {

            $hospital = new Hospital();
            $dados = (array)$this->post->only([
                'nome', 'email', 'telefone', 'celular',
                'id_segmento'
            ]);

            try {
                $hospital->update($dados, $this->post->data()->id);
                return $this->get->redirectTo("hospital");

            } catch (Exception $e) {
                dd($e->getMessage());
            }
        }
    }

    public function verificaSeEmailExiste($email, $idHospital = false)
    {
        $email = out64($email);
        $hospital = new Hospital();

        /*
        * Se for uma edição,
        * verifica se o EMAIL não pertence a hospital que está sendo editado no momento
        */
        if ($email && $idHospital) {
            if ($hospital->seDadoNaoPertenceAHospitalEditado('email', $email, $idHospital)) {
                echo json_encode(['status' => true]);
                return false;
            }
        }

        if ($hospital->verificaSeEmailExiste($email)) {
            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false]);
        }
    }

    public function modalFormulario($idHospital)
    {
        $hospital = false;

        if ($idHospital) {
            $hospital = new Hospital();
            $hospital = $hospital->find($idHospital);
        }


        $this->view('hospital/formulario', null,
            compact(
                'hospital'
            ));
    }
}
