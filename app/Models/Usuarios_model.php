<?php 
namespace App\Models;
use CodeIgniter\Model;

class Usuarios_model extends Model 
{
    protected $table = 'usuarios'; 
    protected $primaryKey = 'Id_usuario';
    protected $allowedFields = ['Nombre', 'Apellido','Usuario', 'Email', 'Pass', 'Perfil_id', 'Baja'];
}
