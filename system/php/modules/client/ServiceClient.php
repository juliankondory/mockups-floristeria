<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/System.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/Clientes.php';

class ServiceClient extends System
{

    public static function newClientes($nombre, $identificacion, $correo, $telefono, $departamento, $ciudad)
    {
        try {
            $nombre         = parent::limpiarString($nombre);
            $identificacion = parent::limpiarString($identificacion);
            $correo         = parent::limpiarString($correo);
            $telefono       = parent::limpiarString($telefono);
            $departamento   = parent::limpiarString($departamento);
            $ciudad         = parent::limpiarString($ciudad);

            $fecha_registro = date('Y-m-d H:i:s');

            $id_usuario = $_SESSION['id'];
            $tipo_usuario = $_SESSION['tipo'];

            $result = Clientes::newClientes($nombre, $identificacion, $correo, $telefono, $departamento, $ciudad, $fecha_registro, $id_usuario, $tipo_usuario);
            if ($result) return '<script>swal("' . Constants::$REGISTER_NEW . '", "", "success");</script>';
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    public static function setClientes($id_cliente, $nombre, $identificacion, $correo, $telefono, $departamento, $ciudad, $estado)
    {
        try {

            $id_cliente  = parent::limpiarString($id_cliente);
            $nombre  = parent::limpiarString($nombre);
            $identificacion  = parent::limpiarString($identificacion);
            $correo  = parent::limpiarString($correo);
            $telefono  = parent::limpiarString($telefono);
            $departamento  = parent::limpiarString($departamento);
            $ciudad  = parent::limpiarString($ciudad);
            $estado  = parent::limpiarString($estado);

            $result = Clientes::setClientes($id_cliente, $nombre, $identificacion, $correo, $telefono, $departamento, $ciudad, $estado);
            if ($result) {
                return '<script>swal("' . Constants::$REGISTER_UPDATE . '", "", "success");</script>';
            }
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    public static function getInfoClientes($id_cliente)
    {
        try {
            $id_cliente  = parent::limpiarString($id_cliente);

            $clienteDTO =  Clientes::getClientesJs($id_cliente);

            return json_encode($clienteDTO);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    public static function getTableClientes()
    {
        try {
            $tableHtml = "";
            $modelResponse = Clientes::listClientes();

            foreach ($modelResponse as $valor) {
                $tableHtml .= '<tr>';
                $tableHtml .= '<td>' . $valor->getIdCliente() . '</td>';
                $tableHtml .= '<td>' . $valor->getNombre() . '</td>';
                $tableHtml .= '<td>' . $valor->getIdentificacion() . '</td>';
                $tableHtml .= '<td>' . $valor->getCorreo() . '</td>';
                $tableHtml .= '<td>' . $valor->getTelefono() . '</td>';
                $tableHtml .= '<td>' . $valor->getDepartamento() . '</td>';
                $tableHtml .= '<td>' . $valor->getCiudad() . '</td>';
                $tableHtml .= '<td>' . $valor->getEstado() . '</td>';
                $tableHtml .= '<td>' . $valor->getFechaRegistro() . '</td>';
                $tableHtml .= '<td>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <button type="button" class="btn btn-info rounded-circle btn-sm btn-editar" value="' . $valor->getIdCliente() . '">
                                            <i class="bi bi-info-circle"></i></button>
                                        </div>
                                        <div class="col-md-5">
                                            <button type="button" class="btn btn-danger rounded-circle btn-sm btn-eliminar" value="' . $valor->getIdCliente() . '">
                                            <i class="bi bi-trash-fill"></i></button>
                                        </div>
                                    </div>
                                </td>';
                $tableHtml .= '</tr>';
            }
            return $tableHtml;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function getTableClientesUsuario()
    {
        try {
            $tableHtml = "";
            $id_usuario = $_SESSION['id'];
            $modelResponse = Clientes::listClientesUsuario($id_usuario);

            foreach ($modelResponse as $valor) {
                $tableHtml .= '<tr>';
                $tableHtml .= '<td>' . $valor->getIdCliente() . '</td>';
                $tableHtml .= '<td>' . $valor->getNombre() . '</td>';
                $tableHtml .= '<td>' . $valor->getIdentificacion() . '</td>';
                $tableHtml .= '<td>' . $valor->getCorreo() . '</td>';
                $tableHtml .= '<td>' . $valor->getTelefono() . '</td>';
                $tableHtml .= '<td>' . $valor->getDepartamento() . '</td>';
                $tableHtml .= '<td>' . $valor->getCiudad() . '</td>';
                $tableHtml .= '<td>' . $valor->getEstado() . '</td>';
                $tableHtml .= '<td>' . $valor->getFechaRegistro() . '</td>';
                $tableHtml .= '<td>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <button type="button" class="btn btn-info rounded-circle btn-sm btn-editar" value="' . $valor->getIdCliente() . '">
                                            <i class="bi bi-info-circle"></i></button>
                                        </div>
                                        <div class="col-md-5">
                                            <button type="button" class="btn btn-danger rounded-circle btn-sm btn-eliminar" value="' . $valor->getIdCliente() . '">
                                            <i class="bi bi-trash-fill"></i></button>
                                        </div>
                                    </div>
                                </td>';
                $tableHtml .= '</tr>';
            }
            return $tableHtml;
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public static function deleteClientes($id_categoria)
    {
        try {
            $id_categoria = parent::limpiarString($id_categoria);

            $result = Clientes::deleteClientes($id_categoria);

            if ($result) {
                header('Location:clients?delete');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
