<?php
namespace App\Controllers;
use CodeIgniter\Controller;

class Panel_controller extends BaseController
{
    public function index()
    {
        $session = session();
        $nombre = $session->get('usuario');
        
        $dato['titulo'] = 'Panel del usuario | SIARA';
        echo view('front/head', $dato);
        echo view('front/nav');
        echo "Bienvenido: ".$nombre;
        echo view('front/footer');
    }
}