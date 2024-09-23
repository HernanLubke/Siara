<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use App\Models\CategoriaModel;


class ProductosController extends BaseController
{
    public function index()
    {
        echo view('front/head');
        echo view('front/navbar');
        // Crear una instancia del modelo de Producto
        $productoModel = new ProductoModel();
    
        // Obtener todos los productos
        $productos = $productoModel->findAll();
    
        // Pasar los productos a la vista
        $data['productos'] = $productos;
    
        // Cargar la vista y pasar los datos
        echo view('Back/listarProductos', $data);
        echo view('front/footer');
        
    }
    

    public function create()
{
    // Obtener todas las categorías
    $categoriaModel = new CategoriaModel();
    $data['categorias'] = $categoriaModel->findAll();

    $data['titulo'] = 'AgregarProductos';

    echo view('front/head', $data);
    echo view('front/navbar');
    echo view('back/agregarProducto', $data);
  
}





public function store() // Guarda nuevos productos
{
    $productoModel = new ProductoModel();
    $imagen = $this->request->getFile('imagen');

    if ($imagen->isValid() && !$imagen->hasMoved()) {
        $nombreImagen = $imagen->getRandomName();
        $imagen->move(ROOTPATH . 'uploads', $nombreImagen);

        // Obtén el valor de la categoría del formulario
        $categoriaId = $this->request->getPost('categoria');

        // Asegúrate de que la categoría no esté vacía
        if (!$categoriaId) {
            return redirect()->back()->withInput()->with('error', 'La categoría es obligatoria.');
        }

        $data = [
            'id_categoria' => $categoriaId,
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'precio' => $this->request->getPost('precio'),
            'cantidad' => $this->request->getPost('cantidad'),
            'url_imagen' => $nombreImagen,
            'activo' => 'si'
        ];

        $productoModel->insert($data);

        session()->setFlashdata('success', 'El producto se ha cargado correctamente.');

        // Redirigir a la vista de listar productos
        return redirect()->to(base_url('listarProductos'));
    }
    return redirect()->back()->withInput()->with('error', 'Error al subir la imagen.');
}



public function editar($id_producto)
    {
        
        // Carga el modelo de Producto
        $productoModel = new \App\Models\ProductoModel();
        $categoriaModel = new \App\Models\CategoriaModel();

        // Busca el producto por su ID
        $producto = $productoModel->find($id_producto);

        // Si el producto no existe, redirige o muestra un error
        if (!$producto) {
            return redirect()->to(base_url('listarProductos'))->with('error', 'Producto no encontrado');
        }

        // Obtener todas las categorías para el select
        $categorias = $categoriaModel->findAll();

        // Si se envió el formulario de actualización
        if ($this->request->getMethod() === 'post') {
            // Reglas de validación, ajusta según tus necesidades
            $rules = [
                'nombre' => 'required',
                'descripcion' => 'required',
                'precio' => 'required|numeric',
                'cantidad' => 'required|numeric',
                'categoria' => 'required',
                // Agrega reglas de validación para la imagen si es necesario
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            // Manejo de la imagen si se envía
            $imagen = $this->request->getFile('imagen');
            if ($imagen->isValid() && !$imagen->hasMoved()) {
                // Procesar y mover la imagen, guarda la URL en la base de datos
                $newName = $imagen->getRandomName();
                $imagen->move(ROOTPATH . 'public/uploads', $newName);
                $data['url_imagen'] = $newName;
            }

            // Obtén los datos del formulario
            $data = [
                'nombre' => $this->request->getPost('nombre'),
                'descripcion' => $this->request->getPost('descripcion'),
                'precio' => $this->request->getPost('precio'),
                'cantidad' => $this->request->getPost('cantidad'),
                'id_categoria' => $this->request->getPost('categoria'),
                // Agrega la lógica para la imagen si es necesario
            ];

            // Intenta actualizar el producto
            if ($productoModel->update($id_producto, $data)) {
                return redirect()->to(base_url('listarProductos'))->with('success', 'Producto actualizado correctamente');
            } else {
                return redirect()->back()->withInput()->with('error', 'Error al actualizar el producto');
            }
        }
         

        // Si es un método GET, carga la vista de edición con los datos del producto
        return view('Back/editarProducto', ['producto' => $producto, 'categorias' => $categorias]);
    }


    public function actualizar()
    {
        $productoModel = new ProductoModel();

        if ($this->request->getMethod() === 'post') {
            $idProducto = $this->request->getPost('id');
            $nuevosDatos = [
                'nombre' => $this->request->getPost('nombre'),
                'descripcion' => $this->request->getPost('descripcion'),
                'precio' => $this->request->getPost('precio'),
                'cantidad' => $this->request->getPost('cantidad'),
                'id_categoria' => $this->request->getPost('categoria')
            ];

            // Procesar la imagen si se ha cargado un nuevo archivo
            $imagen = $this->request->getFile('imagen');
            if ($imagen->isValid() && !$imagen->hasMoved()) {
                // Mover la imagen a la carpeta de uploads y obtener su nombre
                $nombreImagen = $imagen->getRandomName();
                $imagen->move(ROOTPATH . 'uploads', $nombreImagen);
                $nuevosDatos['url_imagen'] = $nombreImagen;
            }

            // Actualizar el producto en la base de datos
            $productoModel->update($idProducto, $nuevosDatos);

            // Redireccionar o mostrar un mensaje de éxito
            session()->setFlashdata('success', 'el producto se a actualizado correctamente.');
            return redirect()->to(base_url('listarProductos'));
        }
    }

    public function listarbaja()
    {
        echo view('front/head');
        echo view('front/navbar');
        // Crear una instancia del modelo de Producto
        $productoModel = new ProductoModel();
    
        // Obtener todos los productos
        $productos = $productoModel->findAll();
    
        // Pasar los productos a la vista
        $data['productos'] = $productos;
    
        // Cargar la vista y pasar los datos
        echo view('Back/ProductosDadosDeBaja', $data);
        echo view('front/footer');
        
    }



    public function darDeBaja($id)
    {
        $productoModel = new ProductoModel();

        $producto = $productoModel->find($id);
        if ($producto) {
            // Actualizar el campo "activo" a "no"
            $producto['activo'] = 'no';
            $productoModel->save($producto);

            // Establecer mensaje de sesión
            session()->setFlashdata('success', 'El producto ha sido dado de baja Correctamente.');

            // Redirigir a la vista de listar usuarios

            return redirect()->to(base_url('listarProductos'));
        }
    }

    public function darDeAlta($id)
    {

        $productoModel = new ProductoModel();

        $producto = $productoModel->find($id);
        if ($producto) {
            // Actualizar el campo "activo" a "si"
            $producto['activo'] = 'si';
            $productoModel->save($producto);

            // Establecer mensaje de sesión
            session()->setFlashdata('success', 'El producto ha sido dado de alta Correctamente.');

            // Redirigir a la vista de listar productos

            return redirect()->to(base_url('listarProductos'));
        }
    }


    public function catalogo()
    {
        $productoModel = new ProductoModel();
        $productos = $productoModel->findAll(); // Obtener todos los productos

        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->findAll(); // Obtener todas las categorías

        // Obtener la categoría de cada producto
        foreach ($productos as &$producto) {
            $categoria = $categoriaModel->find($producto['id_categoria']);
            if ($categoria && isset($categoria['nombre'])) {
                $producto['categoria'] = $categoria['nombre'];
            }
        }

        $data = [
            'productos' => $productos,
            'categorias' => $categorias
        ];

        return view('catalogo', $data);
    }

    public function catalogoIngresado()
    {
        $session = session();
        

        $productoModel = new ProductoModel();
        $productos = $productoModel->findAll(); // Obtener todos los productos

        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->findAll(); // Obtener todas las categorías

        

        // Obtener la categoría de cada producto
        foreach ($productos as &$producto) {
            $categoria = $categoriaModel->find($producto['id_categoria']);
            if ($categoria && isset($categoria['nombre'])) {
                $producto['categoria'] = $categoria['nombre'];
            }
        }

        $data = [
            'productos' => $productos,
            'categorias' => $categorias
        ];

        return view('Back/catalogoIngresado', $data, ['session' => $session]);
    }


    
    
    public function listarCategorias($id_categoria)
    {
        echo view('front/navbar2');
        echo view('front/head');
        $productoModel = new ProductoModel();
    
        // Filtrar solo los productos activos (activo = 'si')
        $productos = $productoModel->where('id_categoria', $id_categoria)
                              ->where('activo', 'si')
                              ->findAll();

        // También puedes cargar el modelo de categoría si lo necesitas
        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->findAll();

        // Pasa los productos y categorías a la vista
        $data = [
        'productos' => $productos,
        'categorias' => $categorias
        ];

    return view('Back/ListarCategorias', $data);
    
    }
        
    

    public function createCategorias()
    {
        $session = session();
       

        $perfil_id = $session->get('perfil_id');

        if ($perfil_id != 1) {
            return redirect()->to(base_url('indexIngresado'));
        }
        ;

        return view('agregarCategorias');
    }


    public function storeCategorias()
    {
        $categoriaModel = new CategoriaModel();
        $data = [

            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'activo' => 'si'
        ];
        $categoriaModel->insert($data);
        session()->setFlashdata('success', 'la categoria se a cargado correctamente.');
        return redirect()->to(base_url('listarCategorias'));
    }



    public function editarCategorias($id = NULL)
    {
        $session = session();
        

        $perfil_id = $session->get('perfil_id');

        if ($perfil_id != 1) {
            return redirect()->to(base_url('indexIngresado'));
        }


        $categoria = new CategoriaModel();
        $datos['categoria'] = $categoria->where('id_categoria', $id)->first();

        return view('editarCategorias', $datos);
    }

    public function actualizarCategorias()
    {
        $categoriaModel = new CategoriaModel();

        if ($this->request->getMethod() === 'post') {
            $idCategoria = $this->request->getPost('id');
            $nuevosDatos = [
                'nombre' => $this->request->getPost('nombre'),
                'descripcion' => $this->request->getPost('descripcion'),

            ];
            $categoriaModel->update($idCategoria, $nuevosDatos);

            session()->setFlashdata('success', 'la categoria se a actualizado correctamente.');
            return redirect()->to(base_url('listarCategorias'));
        }
    }



    public function darDeBajaCategorias($id)
    {
        $categoriaModel = new CategoriaModel();

        $categoria = $categoriaModel->find($id);
        if ($categoria) {

            $categoria['activo'] = 'no';
            $categoriaModel->save($categoria);
            session()->setFlashdata('success', 'la categoria ha sido dado de baja Correctamente.');
            return redirect()->to(base_url('listarCategorias'));
        }
    }

    public function darDeAltaCategorias($id)
    {
        $categoriaModel = new CategoriaModel();
        $categoria = $categoriaModel->find($id);
        if ($categoria) {
            $categoria['activo'] = 'si';
            $categoriaModel->save($categoria);
            session()->setFlashdata('success', 'la categoria ha sido dado de alta Correctamente.');
            return redirect()->to(base_url('categoriasDadosDeBaja'));
        }
    }

    public function listarbajaCategorias()
    {
        $session = session();
        

        $perfil_id = $session->get('perfil_id');

        if ($perfil_id != 1) {
            return redirect()->to(base_url('indexIngresado'));
        }


        $categoria = new CategoriaModel();
        $datos['categorias'] = $categoria->orderBy('id_categoria', 'ASC')->findAll();
        return view('categoriasDadosDeBaja', $datos);
    }
}