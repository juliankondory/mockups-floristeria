<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/System.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/Informacion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/reports/ReporteInformacion.php';

class ServiceInformation extends System
{
    public static function setInformation($nombre, $nit, $direccion, $ciudad, $departamento, $correo, $telefono, $whatsapp, $facebook, $instagram, $color)
    {
        $nombre     = parent::limpiarString($nombre);
        $nit        = parent::limpiarString($nit);
        $direccion  = parent::limpiarString($direccion);
        $ciudad     = parent::limpiarString($ciudad);
        $departamento = parent::limpiarString($departamento);
        $correo     = parent::limpiarString($correo);
        $telefono   = parent::limpiarString($telefono);
        $whatsapp   = parent::limpiarString($whatsapp);
        $facebook   = parent::limpiarString($facebook);
        $instagram  = parent::limpiarString($instagram);
        $color      = parent::limpiarString($color);

        $result = Informacion::setInformacion($nombre, $nit, $direccion, $ciudad, $departamento, $correo, $telefono, $whatsapp, $facebook, $instagram, $color);
        if ($result) return  '<script>swal("' . Constants::$INFORMATION_NEW . '", "", "success");</script>';
    }

    public static function setImageInformation()
    {
        $imagen = "";

        $source         = $_FILES['logo']['tmp_name'];
        $filename       = $_FILES['logo']['name'];
        $fileSize       = $_FILES['logo']['size'];

        if ($fileSize > 100 & $filename != '') {
            $dirImagen = $_SERVER['DOCUMENT_ROOT'] . Path::$DIR_IMG_PERFIL;

            if (!file_exists($dirImagen)) mkdir($dirImagen, 0777, true);

            $informacion = Informacion::getInformacion();
            unlink($dirImagen . $informacion->getImagen());

            $dir         = opendir($dirImagen); //Abrimos el directorio de destino
            $trozo1      = explode(".", $filename);
            $imagen      = 'perfil_' . ($informacion->getId_perfil()) . '_' . rand() . '.' . end($trozo1);
            $target_path = $dirImagen . '/' . $imagen; //Indicamos la ruta de destino, así como el nombre del archivo
            move_uploaded_file($source, $target_path);
            closedir($dir);
        }

        $result = Informacion::setImagenInformacion($imagen);
        if ($result) return  '<script>swal("' . Constants::$IMAGE_UPDATE . '", "", "success");</script>';
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

    public static function getReportInformation()
    {
        try {
            $perfilDTO = Informacion::getInformacion();
            $result    = ReporteInformacion::generatePdf($perfilDTO);
            return $result;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
