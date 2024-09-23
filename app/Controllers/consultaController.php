<?php

namespace App\Controllers;

use App\Models\ConsultaModel;
use CodeIgniter\Controller;

class ConsultaController extends BaseController
{
    public function guardarConsulta()
    {
        $request = \Config\Services::request();
        $asunto = $request->getPost('asunto');
        $mensaje = $request->getPost('mensaje');
        $session = session();
        $usuarioId = $session->get('Id_usuario'); // Asegúrate de que el usuario está autenticado y de que su ID está en la sesión

        // Validación básica
        if (empty($asunto) || empty($mensaje)) {
            return redirect()->back()->with('error', 'Todos los campos son obligatorios.');
        }

        // Preparar los datos para guardar
        $data = [
            'asunto' => $asunto,
            'mensaje' => $mensaje,
            'usuario_id' => $usuarioId,
            'visto' => "no" 
        ];

        // Instancia del modelo
        $consultaModel = new ConsultaModel();

        // Guardar los datos
        $consultaModel->insert($data);

        session()->setFlashdata('success', '¡El mensaje a sido enviado con exito!');

        return redirect()->to(base_url('consulta'));
    }
}