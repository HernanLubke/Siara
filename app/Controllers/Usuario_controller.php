<?php
namespace App\Controllers;
use App\Models\Usuarios_model;
use App\Models\consultaModel;

class Usuario_controller extends BaseController
{
    public function __construct()
    {
        helper(['form', 'url']);
    }

    public function index() //listado de usuarios
{
    $model = new Usuarios_model();
    $data['usuarios'] = $model->findAll();
    echo view('front/head');
    echo view('front/navbar');
    echo view('front/usuarios', $data);
   
}

    public function create() //crea nuevos usuarios
    {
        $dato['titulo'] = 'Crear Usuario';
        echo view('front/head', $dato);
        echo view('front/navbar');
        echo view('Back/registro');
        echo view('front/footer');
    }

    public function store() //guarda nuevos usuarios en la base de datos
    {
        $model = new Usuarios_model();
        $pass = $this->request->getPost('pass');

        if (is_string($pass) && !empty($pass)) {
            $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
        } else {
            return redirect()->back()->withInput()->with('error', 'La contraseña no es válida.');
        }

        $data = [
            'Nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'Usuario' => $this->request->getPost('usuario'),
            'Email' => $this->request->getPost('email'),
            'Pass' => $hashedPass
        ];
        $model->save($data);
        
        return redirect()->to('/usuarios');
    }


    public function update($id)
{
    $model = new Usuarios_model();

    $data = [
        'Nombre' => $this->request->getPost('nombre'),
        'apellido' => $this->request->getPost('apellido'),
        'Usuario' => $this->request->getPost('usuario'),
        'Email' => $this->request->getPost('email'),
    ];

    // Ahora actualiza los datos del usuario en la base de datos sin incluir la contraseña
    $model->update($id, $data);

    return redirect()->to('/usuarios');
}



    public function edit($id) //edita usuarios
    {
        $model = new Usuarios_model();
        $data['usuario'] = $model->find($id);

         
        if ($data['usuario'])
        {
                $dato['titulo'] = 'Editar Usuario';
                echo view('front/head');
                echo view('front/navbar');
                echo view('front/edit', $data);
                
            }
    }
        

     
    public function delete($id) //elimina usuarios de la base de datos
    {
        $model = new Usuarios_model();
        $model->delete($id);

        return redirect()->to('/usuarios');
    }

    public function formValidation() //valida datos antes de guardar 
    {
        //helper(['form', 'url']); 

        $input = $this->validate([
            'nombre'   => 'required|min_length[3]',
            'apellido' => 'required|min_length[3]|max_length[50]',
            'usuario'  => 'required|min_length[3]',
            'email'    => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuarios.email]',
            'pass' => 'required|min_length[3]|max_length[200]',
        ]);
        $formModel = new Usuarios_model();

        if (!$input) {
            $dato['titulo'] = 'Registrarse ';
            echo view('front/head', $dato);
            echo view('front/navbar');
            echo view('back/registro', ['validation' => $this->validator]);
            echo view('front/footer');
        } else {
            $formModel->save([
                'Nombre' => $this->request->getVar('nombre'),
                'Apellido' => $this->request->getVar('apellido'),
                'Usuario' => $this->request->getVar('usuario'),
                'Email'  => $this->request->getVar('email'),
                'Pass'  => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT)
            ]);
            return $this->response->redirect(site_url(''));
        }
    }

    public function consulta()
    {
        $session = session();
        

        return view('Back/consulta', ['session' => $session]);
    }


    public function listarConsulta()
    {
        if (!class_exists(ConsultaModel::class)) {
            return 'No existe consulta.';
        }

        if (!class_exists(Usuarios_model::class)) {
            return 'Usuarios_model no existe.';
        }

        $consultaModel = new ConsultaModel();
        $consultaData = $consultaModel->orderBy('id', 'ASC')->findAll();

        if (!$consultaData) {
            return 'No se encontraron consultas.';
        }

        // Obtener los datos de usuarios relacionados para cada consulta
        $userModel = new Usuarios_model();
        foreach ($consultaData as &$consulta) {
            $usuario = $userModel->find($consulta['usuario_id']);
            if (!$usuario) {
                return 'No se encontró el usuario para la consulta ID: ' . $consulta['id'];
            }
            $consulta['usuario'] = $usuario;
        }

        $datos['usuarios'] = $consultaData;
        return view('Back/listarConsulta', $datos);
    }


    

    public function leidoConsulta($id)
    {
        // Obtener el modelo de usuarios
        $usuariosModel = new consultaModel();

        // Obtener los datos del usuario por su ID
        $usuario = $usuariosModel->find($id);

        if ($usuario) {
            // Actualizar el campo "visto" a "si"
            $usuario['visto'] = 'si';
            $usuariosModel->save($usuario);

            // Establecer mensaje de sesión
            session()->setFlashdata('success', 'Mensaje marcado como visto correctamente');

            // Redirigir a la vista de listar usuarios

            return redirect()->to(base_url('listarConsulta'));
        }
    }
}


