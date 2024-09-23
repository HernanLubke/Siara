<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use App\Models\FacturaModel;
use App\Models\DetalleFacturaModel;
use App\Models\Usuarios_model;

class CarritoController extends BaseController
{
    public function index()
     {
        // Obtener productos del carrito desde la sesión
        $carrito = session()->get('carrito');

        // Verificar si el carrito está vacío
        if (!is_array($carrito)) {
            $carrito = [];
        }

        // Calcular el total de los productos en el carrito
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['subtotal'];
        }

        // Pasar los datos a la vista
        $data = [
            'productos' => $carrito,
            'total' => $total,
            'cantidadProductos' => count($carrito)
        ];

        return view('Back/carrito', $data);
    }


    public function agregar($id_Producto)
    {
        echo view('front/head');
        echo view('front/navbar');
        // Obtener el producto desde la base de datos
        $productoModel = new ProductoModel();
        $producto = $productoModel->find($id_Producto);

        if ($producto) {
            // Obtener el carrito desde la sesión
            $carrito = session()->get('carrito');

            // Verificar si el producto ya existe en el carrito
            if (isset($carrito[$id_Producto])) {
                // Verificar si la cantidad en el carrito es menor a la cantidad disponible
                if ($carrito[$id_Producto]['cantidad'] < $producto['cantidad']) {
                    // Actualizar la cantidad y subtotal del producto existente
                    $carrito[$id_Producto]['cantidad']++;
                    $carrito[$id_Producto]['subtotal'] = $carrito[$id_Producto]['cantidad'] * $producto['precio'];
                } else {
                    // Si la cantidad en el carrito es igual o mayor a la cantidad disponible, mostrar un mensaje de error o redireccionar a donde desees
                    $stockMaximo = $producto['cantidad'];
                    session()->setFlashdata('mensaje', 'No se puede agregar más de ' . $stockMaximo . ' unidades. El stock máximo disponible es ' . $stockMaximo);
                    return redirect()->to(base_url('carrito'));
                }
            } else {
                // Verificar si la cantidad disponible es mayor a 0
                if ($producto['cantidad'] > 0) {
                    // Agregar el producto al carrito
                    $carrito[$id_Producto] = [
                        'id_producto' => $producto['id_producto'],
                        'nombre' => $producto['nombre'],
                        'precio' => $producto['precio'],
                        'cantidad' => 1,
                        'subtotal' => $producto['precio']
                    ];
                } else {
                    // Si la cantidad disponible es igual o menor a 0, mostrar un mensaje de error o redireccionar a donde desees
                    $stockMaximo = $producto['cantidad'];
                    session()->setFlashdata('mensaje', 'No se puede agregar más de ' . $stockMaximo . ' unidades. El stock máximo disponible es ' . $stockMaximo);
                    return view('Back/carrito');
                }
            }

            // Guardar el carrito en la sesión
            session()->set('carrito', $carrito);

            // Establecer un mensaje flash para indicar que se agregó el producto
            session()->setFlashdata('mensaje', 'El producto se agregó al carrito.');

            // Redireccionar de vuelta a la página del catálogo
            return redirect()->to(base_url('catalogoIngresado'));
        }

        // Si el producto no existe, redireccionar a la página de error o a donde desees
        session()->setFlashdata('mensaje', 'El producto no existe.');
        return redirect()->to(base_url('carrito'));
    }

    public function eliminar($idProducto)
    {
        // Obtener el carrito desde la sesión
        $carrito = session()->get('carrito');

        // Verificar si el producto existe en el carrito
        if (isset($carrito[$idProducto])) {
            // Eliminar el producto del carrito
            unset($carrito[$idProducto]);

            // Guardar el carrito en la sesión
            session()->set('carrito', $carrito);
        }

        // Redireccionar al carrito de compras
        return view('Back/carrito');
    }





    public function obtenerCantidad()
    {
        $carrito = session()->get('carrito');
        $cantidad = count($carrito);

        // Devolver la cantidad de productos en formato JSON
        return $this->response->setJSON(['cantidad' => $cantidad]);
    }

    public function vaciar()
    {
        // Vaciar el carrito eliminando la variable de sesión
        session()->remove('carrito');

        // Establecer un mensaje flash para indicar que se vació el carrito
        session()->setFlashdata('mensaje', 'El carrito se ha vaciado.');

        // Redireccionar al carrito de compras
        return redirect()->to(base_url('carrito'));
    }

    public function aumentar($idProducto)
    {
        // Obtener el carrito desde la sesión
        $carrito = session()->get('carrito');

        // Obtener el producto desde la base de datos
        $productoModel = new ProductoModel();
        $producto = $productoModel->find($idProducto);

        // Verificar si el producto existe en el carrito y en la base de datos
        if (isset($carrito[$idProducto]) && $producto) {
            // Verificar si la cantidad en el carrito es menor a la cantidad disponible
            if ($carrito[$idProducto]['cantidad'] < $producto['cantidad']) {
                // Aumentar la cantidad del producto
                $carrito[$idProducto]['cantidad']++;

                // Calcular el nuevo subtotal
                $carrito[$idProducto]['subtotal'] = $carrito[$idProducto]['cantidad'] * $carrito[$idProducto]['precio'];

                // Guardar el carrito actualizado en la sesión
                session()->set('carrito', $carrito);
            } else {
                // Si la cantidad en el carrito es igual o mayor a la cantidad disponible, mostrar un mensaje de error o redireccionar a donde desees
                $nombreproducto = $producto['nombre'];
                $stockMaximo = $producto['cantidad'];
                session()->setFlashdata('mensaje', 'No se puede agregar más de ' . $stockMaximo . '  unidades del producto [' . $nombreproducto . '] . El stock actual disponible es de ' . $stockMaximo . ' unidades.');
                return redirect()->to(base_url('carrito'));
            }
        }

        // Redireccionar al carrito de compras
        return redirect()->to(base_url('carrito'));
    }

    public function disminuir($idProducto)
    {
        // Obtener el carrito desde la sesión
        $carrito = session()->get('carrito');

        // Verificar si el producto existe en el carrito
        if (isset($carrito[$idProducto])) {
            // Verificar si la cantidad del producto es mayor a 1
            if ($carrito[$idProducto]['cantidad'] > 1) {
                // Disminuir la cantidad del producto
                $carrito[$idProducto]['cantidad']--;

                // Calcular el nuevo subtotal
                $carrito[$idProducto]['subtotal'] = $carrito[$idProducto]['cantidad'] * $carrito[$idProducto]['precio'];

                // Guardar el carrito actualizado en la sesión
                session()->set('carrito', $carrito);
            }
        }

        // Redireccionar al carrito de compras
        return redirect()->to(base_url('carrito'));
    }

    private function restarCantidadProducto($idProducto, $cantidad)
    {
        $productoModel = new ProductoModel();
        $producto = $productoModel->find($idProducto);

        if ($producto) {
            $nuevaCantidad = $producto['cantidad'] - $cantidad;

            // Verificar si la cantidad restante es mayor o igual a 0
            if ($nuevaCantidad >= 0) {
                // Actualizar la cantidad del producto en la base de datos
                $productoModel->update($idProducto, ['cantidad' => $nuevaCantidad]);

                return true;
            }
        }


    }

    public function checkout(){

    // Iniciar la sesión si no está iniciada
    $session = session();
    if (session_status() == PHP_SESSION_NONE) {
        $session->start();
    }

    // Obtener los datos del usuario actual
    $userModel = new Usuarios_model();
    $userId = $session->get('Id_usuario');

    // Verificar que el usuario esté logueado
    if (is_null($userId)) {
        return redirect()->to(base_url('login'))->with('mensaje', 'Por favor, inicie sesión para continuar.');
    }

    $usuario = $userModel->find($userId);

    // Obtener el carrito desde la sesión
    $carrito = $session->get('carrito');

    // Verificar si el carrito está vacío
    if (!is_array($carrito)) {
        return redirect()->to(base_url('carrito'));
    }

    // Verificar si hay suficiente stock disponible para los productos en el carrito
    $productoModel = new ProductoModel();
    $insuficienteStock = false;

    foreach ($carrito as $item) {
        $producto = $productoModel->find($item['id_producto']);

        if ($producto && $producto['cantidad'] < $item['cantidad']) {
            $insuficienteStock = true;
            break;
        }
    }

    if ($insuficienteStock) {
        $session->setFlashdata('mensaje', 'No hay suficiente stock disponible para completar la compra.');
        return redirect()->to(base_url('carrito'));
    }

    // Calcular el importe total de la factura
    $importeTotal = 0;
    foreach ($carrito as $item) {
        $importeTotal += $item['subtotal'];
    }

    // Crear la factura en la base de datos
    $facturaModel = new FacturaModel();
    $facturaData = [
        'id_usuario' => $userId,
        'importe_total' => $importeTotal,
        'activo' => 1,
        'fecha' => date('Y-m-d')
    ];
    
    // Verificar si se guarda correctamente la factura
    if (!$facturaModel->guardarFactura($facturaData)) {
        session()->setFlashdata('mensaje', 'Guardado con exito');
        return redirect()->to(base_url('carrito'));
    }

    $facturaId = $facturaModel->insertID();

    // Guardar los detalles de la factura en la base de datos
    $detalleFacturaModel = new DetalleFacturaModel();
    foreach ($carrito as $item) {
        $detalleData = [
            'id_factura' => $facturaId,
            'id_producto' => $item['id_producto'],
            'cantidad' => $item['cantidad'],
            'subtotal' => $item['subtotal']
        ];
        $detalleFacturaModel->guardarDetalleFactura($detalleData);

        // Restar la cantidad comprada del stock del producto en la base de datos
        $this->restarCantidadProducto($item['id_producto'], $item['cantidad']);
    }

    // Vaciar el carrito eliminando la variable de sesión
         session()->remove('carrito');
    
    // Redireccionar a la página de éxito con el ID de la factura
     return redirect()->to(base_url('CarritoController/exito/' . $facturaId));
}



public function exito($idFactura)
{
    // echo view('front/navbar2');
    // Instanciar los modelos
    $facturaModel = new FacturaModel();
    $detalleFacturaModel = new DetalleFacturaModel();

    try {
        // Obtener la factura desde la base de datos
        $factura = $facturaModel->find($idFactura);

        // Verificar si la factura existe
        if (!$factura) {
            throw new \Exception('Factura no encontrada');
        }

        // Obtener el usuario asociado a la factura
        $usuario = $facturaModel->getUsuario($factura['id_usuario']);
        if (!$usuario) {
            throw new \Exception('Usuario no encontrado');
        }

        // Obtener los detalles de la factura
        $detalles = $detalleFacturaModel->where('id_factura', $idFactura)->findAll();
        if (empty($detalles)) {
            throw new \Exception('Detalles de la factura no encontrados');
        }

        // Obtener los productos correspondientes a los detalles
        $productos = [];
        foreach ($detalles as $detalle) {
            $producto = $detalleFacturaModel->getProducto($detalle['id_producto']);
            if (!$producto) {
                throw new \Exception('Producto no encontrado');
            }
            $detalle['producto'] = $producto;
            $productos[] = $detalle;
        }

        // Calcular el importe total de la factura
        $importeTotal = $factura['importe_total'];

        // Pasar los datos a la vista
        $data = [
            'factura' => $factura,
            'usuario' => $usuario,
            'detalles' => $productos,
            'importeTotal' => $importeTotal
        ];

        return view('front/exito', $data);
    } catch (\Exception $e) {
        // Manejar excepciones y redirigir con un mensaje de error
        session()->setFlashdata('mensaje', $e->getMessage());
        return redirect()->to(base_url('carrito'));
    }
}

    
public function compraUsuario()
{
   
    echo view('front/navbar2');

    $facturaModel = new FacturaModel();
    $userModel = new Usuarios_model();
    $detalleFacturaModel = new DetalleFacturaModel();

    // Obtener el ID del usuario actual desde la sesión
    $session = session();
    $userId = $session->get('Id_usuario');
    $usernombre = $session->get('Nombre');
    $userProfileId = $session->get('Id_perfiles');
    

    // Verificar si el usuario es administrador (perfil con id_perfiles = 1)
    $isAdmin = $userProfileId == 1;

    // Obtener las compras del usuario actual o todas las compras si es administrador
    if ($isAdmin) {
        // Usuario administrador, obtiene todas las facturas
        $compras = $facturaModel->findAll();
    } else {
        // Obtener las compras del usuario desde la base de datos
        $compras = $facturaModel->where('Id_usuario', $userId)->findAll();
    
        // Mostrar un mensaje de depuración
        if (empty($compras)) {
            echo "No se encontraron compras para: $usernombre";
        }
    }

    // Verificar si hay compras
    if (empty($compras)) {
        // No se encontraron compras, cargar la vista con un mensaje
        $data['mensaje'] = 'No se encontraron compras.';
    } else {
        // Obtener los nombres de usuario asociados a las compras y los detalles de cada compra
        $usuarios = [];
        $detalles = [];
        foreach ($compras as $compra) {
            $usuario = $userModel->find($compra['id_usuario']);
            $usuarios[$compra['id']] = $usuario['Nombre'] . ' ' . $usuario['Apellido'];

            // Obtener los detalles de la compra
            $detalles[$compra['id']] = $detalleFacturaModel->where('id_factura', $compra['id'])->findAll();

            // Obtener los productos correspondientes a los detalles
            foreach ($detalles[$compra['id']] as &$detalle) {
                $detalle['producto'] = $detalleFacturaModel->getProducto($detalle['id_producto']);
            }
        }

        // Pasar los datos a la vista
        $data = [
            'compras' => $compras,
            'usuarios' => $usuarios,
            'detalles' => $detalles
        ];}
        
    return view('Back/comprasUsuario', $data);
    
}


//Facturas de compra para admin
public function compra()
{
    echo view('front/head');
    echo view('front/navbar2');
   
    $facturaModel = new FacturaModel();
    $userModel = new Usuarios_model();
    $detalleFacturaModel = new DetalleFacturaModel();

    // Obtener el ID del usuario actual desde la sesión
    $session = session();
    $userId = $session->get('Id_usuario');
    $userProfileId = $session->get('Id_perfiles');
    

    // Verificar si el usuario es administrador (perfil con id_perfiles = 1)
    $isAdmin = $userProfileId == 1;

    // Obtener las compras del usuario actual o todas las compras si es administrador
    if ($isAdmin !=1) {
        // Usuario administrador, obtiene todas las facturas
        $compras = $facturaModel->findAll();
    } else {
        // Obtener las compras del usuario desde la base de datos
        $compras = $facturaModel->where('Id_usuario', $userId)->findAll();
    
        // Mostrar un mensaje de depuración
        if (empty($compras)) {
            echo "No se encontraron compras para el usuario con ID: $userId";
        }
    }

    // Verificar si hay compras
    if (empty($compras)) {
        // No se encontraron compras, cargar la vista con un mensaje
        $data['mensaje'] = 'No se encontraron compras.';
    } else {
        // Obtener los nombres de usuario asociados a las compras y los detalles de cada compra
        $usuarios = [];
        $detalles = [];
        foreach ($compras as $compra) {
            $usuario = $userModel->find($compra['id_usuario']);
            $usuarios[$compra['id']] = $usuario['Nombre'] . ' ' . $usuario['Apellido'];

            // Obtener los detalles de la compra
            $detalles[$compra['id']] = $detalleFacturaModel->where('id_factura', $compra['id'])->findAll();

            // Obtener los productos correspondientes a los detalles
            foreach ($detalles[$compra['id']] as &$detalle) {
                $detalle['producto'] = $detalleFacturaModel->getProducto($detalle['id_producto']);
            }
        }

        // Pasar los datos a la vista
        $data = [
            'compras' => $compras,
            'usuarios' => $usuarios,
            'detalles' => $detalles
        ];}


    return view('Back/comprasUsuario', $data);
}


}