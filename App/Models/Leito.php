<?php

namespace App\Models;

use System\Model\Model;

class Leito extends Model
{
    protected $table = 'leitos';
    protected $timestamps = true;

    public function __construct()
    {
        parent::__construct();
    }

    public function leitos()
    {
        return $this->query("SELECT * FROM leitos");

    }

    public function quantidadeDeLeitosCadastrados()
    {
        $disponiveis = $this->queryGetOne("
            SELECT COUNT(*) quantidade FROM leitos WHERE status_now = 0
        ");

        $ocupados = $this->queryGetOne("
        SELECT COUNT(*) quantidade FROM leitos WHERE status_now = 1
        ");

        return (object)[
            'disponiveis' => $disponiveis->quantidade,
            'ocupados' => $ocupados->quantidade
        ];
    }
}
