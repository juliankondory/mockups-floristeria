<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/System.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/Informacion.php';

class ServicePage extends System
{
    static function Login($cedula, $pass)
    {
        $cedula = parent::limpiarString($cedula);
        $pass = parent::limpiarString($pass);
        $pass_hash = parent::hash($pass);
        if (!parent::login($cedula, $pass_hash)) {
            return '
            <script>
                Swal.fire({
                    icon: "warning",
                    showConfirmButton: true,
                    showCancelButton: false,
                    confirmButtonText: "Aceptar",
                    html: `<h1>' . Constants::$PAGE_LOGIN . '</h1>`,
                });
                </script>';
        }
    }

    static function Recovery($cedula)
    {
        $cedula = parent::limpiarString($cedula);
        if (parent::recovery($cedula)) return  '<script>swal("' . Constants::$PAGE_RECUPERAR_PASS2 . '", "", "success");</script>';
        return  '<script>swal("' . Constants::$PAGE_RECUPERAR_PASS_CEDULA . '", "", "warning");</script>';
    }

    public static function getInformation()
    {
        try {
            $result = Informacion::getInformacion();
            return $result;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function sendEmail($destino, $asunto, $mensaje){
        try {
            $destino = parent::limpiarString($destino);
            $asunto = parent::limpiarString($asunto);
            $mensaje = parent::limpiarString($mensaje);

            if (parent::enviarCorreos($destino, $asunto, $mensaje)) {
                return  '<script>swal("' . Constants::$EMAIL_NEW . '", "", "success");</script>';
            }

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    //ALERTAS ----------------------------------------------------------------------------------

    static function getAlertaNuevo()
    {
        return '<script>swal("' . Constants::$REGISTER_NEW . '", "", "success");</script>';
    }

    static function getAlertaEliminar()
    {
        return '<script>swal("' . Constants::$REGISTER_DELETE . '", "", "success");</script>';
    }
}
