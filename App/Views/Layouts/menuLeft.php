<?php

use App\Config\ConfigPerfil;
use System\Session\Session;

?>

<div class="sidebar-wrapper">
    <ul class="nav">

        <li class="">
            <a href="<?php echo BASEURL; ?>/home"
               class="<?php currentRouteFromMenu('home', 'inicioBorder'); ?>">
                <i class="fas fa-tachometer-alt"></i>
                <p>Inicio</p>
            </a>
        </li>


        <li class="">
            <a href="<?php echo BASEURL; ?>/paciente"
               class="<?php currentRouteFromMenu('paciente', 'pacienteBorder'); ?>">
                <i class="fas fa-user-injured"></i>
                <p>Pacientes</p>
            </a>
        </li>
        <li class="">
            <a href="<?php echo BASEURL; ?>/leitos/dashboard"
               class="<?php currentRouteFromMenu('leitos', 'leitosBorder'); ?>">
                <i class="fas fa-procedures"></i>
                <p>Leitos</p>
            </a>
        </li>




        <?php //if (Session::get('idPerfil') != ConfigPerfil::vendedor()): ?>
            <!--<li class="">
                <a href="<?php //echo BASEURL; ?>/relatorio/vendasPorPeriodor"
                   class="<?php //currentRouteFromMenu('relatorio', 'relatorioBorder'); ?>
                    <?php //currentRouteFromMenu('relatorio/vendasPorPeriodo', 'relatorioBorder'); ?>">
                    <i class="fas fa-file-contract"></i>
                    <p>Log de Vendas</p>
                </a>
            </li>
        <?php //endif; ?>



        <!--<div class="dropdown">
            <li class="active-pro dropdown-toggle dropdown-toggle dropdown-toggle-split" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <a>
                    <i class="fas fa-cogs" style="color:#6e6e6d"></i>
                    <p><p>Configurações</p></p>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="margin-left:50px">
                    <a class="dropdown-item" href="#"><i class="fas fa-users" style="color:#212120"></i> Usuários</a>
                    <a class="dropdown-item" href="#"><i class="fas fa-store" style="color:#212120"></i> Empresas</a>
                    <a class="dropdown-item" href="#"><i class="fas fa-file-signature" style="color:#212120"></i> Logs de acessos</a>
                </div>
            </li>
        </div>-->

    </ul>
</div>

<script>
    //const urlNav = `${location.origin}${location.pathname}`;
    //const elmNav = document.querySelector(`.sidebar-wrapper li a[href='${urlNav}']`);

    //console.log(urlNav, elmNav);
    /*if (elmNav) {
      elmNav.parentNode.classList.add('active');
    }*/
</script>
