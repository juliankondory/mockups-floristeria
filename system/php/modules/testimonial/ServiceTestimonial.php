<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/System.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/Testimonio.php';

class ServiceTestimonial extends System
{

    public static function newTestimonio($estrellas, $nombre, $genero, $opinion)
    {
        try {

            $estrellas  = parent::limpiarString($estrellas);
            $nombre  = parent::limpiarString($nombre);
            $genero  = parent::limpiarString($genero);
            $opinion  = parent::limpiarString($opinion);

            // return '<script>swal("' . $estrellas . '", "", "success");</script>';

            $fecha_registro = date('Y-m-d H:i:s');

            $result = Testimonio::newTestimonio($nombre, $genero, $opinion, $estrellas, $fecha_registro);
            if ($result) return '<script>swal("' . Constants::$REGISTER_NEW . '", "", "success");</script>';
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    public static function setTestimonio($id_menu, $estrellas, $nombre, $genero, $opinion)
    {
        try {

            $id_menu  = parent::limpiarString($id_menu);
            $estrellas  = parent::limpiarString($estrellas);
            $nombre  = parent::limpiarString($nombre);
            $genero  = parent::limpiarString($genero);
            $opinion  = parent::limpiarString($opinion);
            $result = Testimonio::setTestimonio($id_menu, $nombre, $genero, $opinion, $estrellas);
            if ($result) {
                return '<script>swal("' . Constants::$REGISTER_UPDATE . '", "", "success");</script>';
            }
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    public static function getInfoTestimonio($id_testimonio)
    {
        try {
            $id_testimonio  = parent::limpiarString($id_testimonio);

            $testimonioDTO =  Testimonio::getTestimonioJs($id_testimonio);

            return json_encode($testimonioDTO);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    public static function getTableTestimonios()
    {
        try {
            if (basename($_SERVER['PHP_SELF']) == 'testimonial.php') {
                $tableHtml = "";
                $modelResponse = Testimonio::listTestimonio();

                foreach ($modelResponse as $valor) {
                    $tableHtml .= '<tr>';
                    $tableHtml .= '<td>' . $valor->getIdTestimonio() . '</td>';
                    $tableHtml .= '<td>' . $valor->getNombre() . '</td>';
                    $tableHtml .= '<td>' . $valor->getOpinion() . '</td>';
                    $tableHtml .= '<td>' . self::getEstrellasCalificacion($valor->getCalificacion()) . '</td>';
                    $tableHtml .= '<td>' . $valor->getFechaRegistro() . '</td>';
                    $tableHtml .= '<td>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <button type="button" class="btn btn-info rounded-circle btn-sm btn-editar" value="' . $valor->getIdTestimonio() . '">
                                            <i class="bi bi-info-circle"></i></button>
                                        </div>
                                        <div class="col-md-5">
                                            <button type="button" class="btn btn-danger rounded-circle btn-sm btn-eliminar" value="' . $valor->getIdTestimonio() . '">
                                            <i class="bi bi-trash-fill"></i></button>
                                        </div>
                                    </div>
                                </td>';
                    $tableHtml .= '</tr>';
                }
                return $tableHtml;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function getEstrellasCalificacion($calificacion)
    {
        try {
            $calificacion = parent::limpiarString($calificacion);
            $icono = '';
            for ($i = 0; $i < 5; $i++) {
                $estrella = ($i < $calificacion) ? '-fill' : '';
                $icono .= '<i class="bi bi-star' . $estrella . '" style="color: #37517e;"></i>';
            }
            return $icono;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function getTestimoniosPagina()
    {
        $tableHtml = "";
        $modelResponse = Testimonio::listTestimonio();

        foreach ($modelResponse as $valor) {
            $tableHtml .= Elements::getTestimonio(
                $valor->getGenero(),
                $valor->getNombre(),
                self::getEstrellasCalificacion($valor->getCalificacion()),
                $valor->getOpinion(),
                date_format(date_create($valor->getFechaRegistro()), 'Y-m-d')
            );
        }
        return $tableHtml;
    }

    public static function deleteTestimonio($id_categoria)
    {
        try {
            $id_categoria = parent::limpiarString($id_categoria);

            $result = Testimonio::deleteTestimonio($id_categoria);

            if ($result) {
                header('Location:testimonial?delete');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
