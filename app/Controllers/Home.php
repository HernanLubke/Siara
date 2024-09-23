<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
       
         echo view('front/head');
         echo view ('front/navbar');
         echo view('front/principal');
         echo view('front/footer');

    }
    
    public function categoriaPerros()
    {
       
         echo view('front/head');
         echo view ('front/navbar');
         echo view('front/categorias/perros');
         echo view('front/footer');

    }

    public function categoriaGatos()
    {
       
         echo view('front/head');
         echo view ('front/navbar');
         echo view('front/categorias/gatos');
         echo view('front/footer');

    }

    public function categoriaAccesorios()
    {
       
         echo view('front/head');
         echo view ('front/navbar');
         echo view('front/categorias/accesorios');
         echo view('front/footer');

    }

    public function quienesSomos()
    {
       
         echo view('front/head');
         echo view ('front/navbar');
         echo view('front/QuienesSomos');
         echo view('front/footer');
    }

    public function TerminosYcondiciones()
    {
       
         echo view('front/head');
         echo view ('front/navbar');
         echo view('front/terminosYcondiciones');
         echo view('front/footer');

    }

    public function Comercializacion()
    {
       
         echo view('front/head');
         echo view ('front/navbar');
         echo view('front/comercializacion');
         echo view('front/footer');

    }

    public function Contacto()
    {
       
         echo view('front/head');
         echo view ('front/navbar');
         echo view('front/contacto');
         echo view('front/footer');

    }

    public function login()
    {
        $dato['titulo']='Login';
        echo view('front/head',$dato);
        echo view('front/navbar');
        echo view('back/login');
        echo view('front/footer');
    }

    public function admin()
    {
     echo view('front/head');
     echo view ('front/navbar');
     echo view('front/contacto');
     echo view('front/footer');
    }
   
//     public function productos()
//     {
//         echo view('construccion');
//     }

}
