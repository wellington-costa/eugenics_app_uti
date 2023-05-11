<?php

namespace App\Models;

use System\Model\Model;

class Prescricao extends Model
{
    protected $table = 'prescricoes';
    protected $timestamps = true;

    public function __construct()
    {
        parent::__construct();
    }

    public function prescricoes($idPaciente)
    {
        $result = null;
       try {
        $result =  $this->query("SELECT * FROM prescricoes WHERE id_paciente = {$idPaciente}");
       } catch (\Throwable $th) {
         $result = [];
       }

       return $result;
    }
}
