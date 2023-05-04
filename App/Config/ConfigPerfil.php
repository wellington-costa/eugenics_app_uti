<?php

namespace App\Config;

class ConfigPerfil
{
    # Estes valores devem ser os mesmos do banco de dados
    public static function superAdmin()
    {
        return 1;
    }

    public static function adiministrador()
    {
        return 2;
    }

    public static function medico()
    {
        return 4;
    }

    public static function enfermeiro()
    {
        return 5;
    }
    public static function tecnicoEnfermagem()
    {
        return 6;
    }
    public static function administrativo()
    {
        return 9;
    }
}
