<?php

require_once 'Modelo/UsuarioModelo.php';


require_once 'Controlador/UsuarioControlador.php';



require_once 'Controlador/DashboardControlador.php';


$Dashboard = new DashboardController();
$Dashboard->DashboardControlador();
