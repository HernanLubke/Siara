<?php
namespace App\Controllers;
use App\Models\Usuarios_model;

class Login_controller extends BaseController
{
    public function __construct()
    {
        helper(['form', 'url']);
    }

    public function create()
    {
        $dato['titulo'] = 'Iniciar sesión';
        echo view('front/head', $dato);
        echo view('front/navbar2');
        echo view('back/login');
       
    }
    
    public function auth()
    {
        $session = session();
        $model = new Usuarios_model();

        // Validación de datos
        $validation = \Config\Services::validation();
        $validation->setRules([
            'usuario' => 'required',
            'password' => 'required'
        ]);

        if (!$this->validate([
            'usuario' => 'required',
            'password' => 'required'
        ])) {
            return redirect()->to('/login')->withInput()->with('validation', $validation);
        }

        $usuario = $this->request->getVar('usuario');
        $pass = $this->request->getVar('password');

        // Depuración: Verificar los valores recibidos
        log_message('debug', 'Usuario: ' . $usuario);
        log_message('debug', 'Password: ' . $pass);

        $data = $model->where('usuario', $usuario)->first();

        if ($data) {
            $password = $data['Pass'];
            $verify_pass = password_verify($pass, $password);

            // Depuración: Verificar la comparación de contraseñas
            log_message('debug', 'Password almacenada: ' . $password);
            log_message('debug', 'Verificación de password: ' . ($verify_pass ? 'true' : 'false'));
            
            if ($verify_pass) {
                $ses_data = [ 
                    'Id_usuario' => $data['Id_usuario'],
                    'Nombre'      => $data['Nombre'],
                    'Apellido'    => $data['Apellido'],
                    'Usuario'     => $data['Usuario'],
                    'Email'       => $data['Email'],
                    'Perfil_id'   => $data['Perfil_id'],
                    'logged_in'   => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/inicio');
            } else {
                $session->setFlashdata('msg', 'Contraseña incorrecta'); 
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'No se encontró usuario');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('login');
    }
}
?>
