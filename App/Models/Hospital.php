<?php

namespace App\Models;

use System\Model\Model;

class Empresa extends Model
{
    protected $table = 'hospitais';
    protected $timestamps = true;

    public function __construct()
    {
        parent::__construct();
    }

    public function seDadoNaoPertenceAHospitalEditado($nomeDoCampo, $valor, $idHospital)
    {
        $dadoHospital = $this->findBy("{$nomeDoCampo}", $valor);
        if ($dadoHospital && $idHospital != $dadoHospital->id) {
            return true;
        }

        return false;
    }
  /*
    public function verificaSeEmailExiste($email)
    {
        if (!$email) {
            return false;
        }

        $query = $this->query("SELECT * FROM empresas WHERE email = '{$email}'");
        if (count($query) > 0) {
            return true;
        }

        return false;
    }
 */
}
