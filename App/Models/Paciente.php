<?php

namespace App\Models;

use System\Model\Model;
use \DateTime;

class Paciente extends Model
{
    protected $table = 'pacientes';
    protected $timestamps = true;

    public function __construct()
    {
        parent::__construct();
    }

    public function pacientes($idHospital)
    {
        return $this->query("SELECT * FROM pacientes WHERE id_hospital={$idHospital}");

    }


    public function seDadoNaoPertenceAoPacienteEditado($nomeDoCampo, $valor, $idPaciente)
    {
        $dadosPaciente = $this->findBy("{$nomeDoCampo}", $valor);
        if ($dadosPaciente && $idPaciente != $dadosPaciente->id) {
            return true;
        }

        return false;
    }

    public function quantidadeDePacientesCadastrados($idHospital)
    {
        $internados = $this->queryGetOne("
            SELECT COUNT(*) quantidade FROM pacientes WHERE id_hospital = {$idHospital} AND status_now = 'Internado'
        ");
        $transferidos = $this->queryGetOne("
            SELECT COUNT(*) quantidade FROM pacientes WHERE id_hospital = {$idHospital} AND status_now = 'Transferido'
        ");
        $alta = $this->queryGetOne("
            SELECT COUNT(*) quantidade FROM pacientes WHERE id_hospital = {$idHospital} AND status_now = 'Alta'
        ");
        $obitos = $this->queryGetOne("
            SELECT COUNT(*) quantidade FROM pacientes WHERE id_hospital = {$idHospital} AND status_now = 'Óbito'
        ");

        $total = $this->queryGetOne("
            SELECT COUNT(*) quantidade FROM pacientes WHERE id_hospital = {$idHospital}
        ");

        return (object)[
            'internados' => $internados->quantidade,
            'transferidos' => $transferidos->quantidade,
            'alta' => $alta->quantidade,
            'obitos' => $obitos->quantidade,
            'total' => $total->quantidade
        ];
    }

    public function calculaIdade($data_nascimento) {

        $agora = new DateTime();
        $nascimento = new DateTime($data_nascimento);
        $idade = $agora->diff($nascimento)->y;
        return $idade;

    }

    public function pacientesInternadosNoDia($dia, $mes, $idHospital)
    {
        $query = $this->query(
            "SELECT COUNT(*) AS pacientesInternadosDia FROM pacientes WHERE id_hospital = {$idHospital}
            AND DAY(created_at) = '{$dia}' AND MONTH(created_at) = '{$mes}'"
        );

        return $query[0]->pacientesInternadosDia;
    }

    public function pacientesInternadosPorDia($idHospital)
    {
        $query = $this->query(
            "SELECT DATE_FORMAT(created_at, '%d/%m') AS datas, COUNT(*) AS quantidade FROM pacientes
            WHERE DATE(created_at) BETWEEN NOW() - INTERVAL 30 DAY AND NOW()
            AND id_hospital = {$idHospital} GROUP BY DAY(created_at) ORDER BY DATE_FORMAT(created_at, '%d/%m') DESC
		");



        return $query;
    }


    public function pacientesAltaPorDia($idHospital)
    {
        $query = $this->query(
            "SELECT DATE_FORMAT(created_at, '%d/%m') AS datas, COUNT(*) AS quantidade FROM pacientes
            WHERE DATE(created_at) BETWEEN NOW() - INTERVAL 30 DAY AND NOW()
            AND id_hospital = {$idHospital} AND status_now = 'Alta' GROUP BY DAY(created_at) ORDER BY DATE_FORMAT(created_at, '%d/%m') DESC
		");



        return $query;
    }

    public function pacientesTransferidosNoDia($dia, $mes, $idHospital)
    {
        $query = $this->query(
            "SELECT COUNT(*) AS pacientesTransferidosDia FROM pacientes WHERE id_hospital = {$idHospital}
            AND DAY(created_at) = '{$dia}' AND MONTH(created_at) = '{$mes}'
            AND status_now='Transferido'"
        );

        return $query[0]->pacientesTransferidosDia;
    }
}
