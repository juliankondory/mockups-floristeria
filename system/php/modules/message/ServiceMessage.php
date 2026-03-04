<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/System.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/Mensaje.php';

class ServiceMessage extends system
{
    public static function newMessage($nombre, $correo, $celular, $mensaje)
    {
        $nombre  = parent::limpiarString($nombre);
        $correo  = parent::limpiarString($correo);
        $celular = parent::limpiarString($celular);
        $mensaje = parent::limpiarString($mensaje);
        $ip      = parent::getIP();
        $fecha_registro = date('Y-m-d H:i:s');

        try {
            $result = Mensaje::newMensaje($nombre, $correo, $celular, $mensaje, $ip, $fecha_registro);
            if ($result) return '<script>swal("' . Constants::$MESSAGE_NEW . '", "", "success");</script>';
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function deleteMessage($id_mensaje)
    {
        $id_mensaje  = parent::limpiarString($id_mensaje);

        try {
            $result = Mensaje::deleteMensaje($id_mensaje);
            if ($result) header('Location:messages?delete');
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getTableMessages()
    {
        try {
            $tableHtml = '';
            $modelResponse = Mensaje::listMensaje();

            foreach ($modelResponse as $valor) {
                $tableHtml .= '<tr>';
                $tableHtml .= '<td>' . $valor->getNombre() . '</td>';
                $tableHtml .= '<td>' . $valor->getCorreo() . '</td>';
                $tableHtml .= '<td>' . $valor->getTelefono() . '</td>';
                $tableHtml .= '<td>' . $valor->getMensaje() . '</td>';
                $tableHtml .= '<td>' . $valor->getIp() . '</td>';
                $tableHtml .= '<td>' . $valor->getFecha_creacion() . '</td>';

                if ($_SESSION['tipo'] == 0 || $_SESSION['tipo'] == 5) {
                    $tableHtml .= '<td align="center">' . Elements::crearBotonEliminar("messages", "deleteMessage", $valor->getId_mensaje()) . '</td>';
                }

                $tableHtml .= '</tr>';
            }
            return $tableHtml;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getCountMensajesNoVistos()
    {
        try {
            $total = Mensaje::getCountMensajesNoVistos();
            if ($total > 0) return '(' . $total . ')';
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function updateEstadoMessages()
    {
        try {
            $update = Mensaje::updateEstadoMensajes();
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
