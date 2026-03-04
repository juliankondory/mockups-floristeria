<?php
class Elements
{
    public static function crearBotonVer($link, $valor)
    {
        return '<a href="' . $link . '?' . $link . '=' . $valor . '" class="btn btn-info rounded-circle btn-sm"><i class="bi bi-info-circle"></i></a>';
    }

    public static function crearBotonEliminar($link, $link2, $valor)
    {
        return '<a href="' . $link . '?' . $link2 . '=' . $valor . '" class="btn btn-danger rounded-circle btn-sm"><i class="bi bi-trash-fill"></i></a>';
    }

    public static function getCardBlog($id_blog, $nombre, $imagen, $titulo, $fecha, $contenido)
    {
        return '
        <div class="col-md-6">
            <a href="blog_single?blog=' . $id_blog . '">
            <div class="member d-flex align-items-start" data-aos="zoom-in">
              <div class="pic2" style="width: 190px;"><img src="/system/img/blog/' . $imagen . '" class="" alt="" style="width: 190px; height: 190px;"></div>
              <div class="member-info">
                <h4>' . $titulo . '</h4>
                <span>By ' . $nombre . '</span>
                <b><i class="bi bi-calendar-week"></i> ' . self::getFechaLetras($fecha) . '
                </b>
              </div>
            </div>
            </a>
        </div>
        ';
    }

    public static function getBlogsRecientes($id_blog, $imagen, $titulo, $fecha)
    {
        return '
        <div class="col-md-12">
            <a class="buy-btn" href="blog_single?blog=' . $id_blog . '">
            <div class="card mb-3 member">
                <div class="row">
                    <div class="col-lg-5 d-flex justify-content-center py-2" data-aos="zoom-in">
                        <div class="pic3 d-flex align-items-center w-auto">
                            <img src="/system/img/blog/' . $imagen . '" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-lg-7  d-flex flex-column align-items-center justify-content-center">
                        <h5>' . $titulo . '</h5><br>
                        <b><i class="bi bi-calendar-week"></i> ' . self::getFechaLetras($fecha) . '
                        </b>
                    </div>
                </div>
            </div>
            </a>
        </div>
        ';
    }

    public static function getTestimonio($icono, $nombre, $estrellas, $opinion, $fecha)
    {
        return '
        <div class="carousel-item active">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <div class="card mb-5" style="width: 60%; height: 300px;">
                    <div class="row g-2">
                        <div class="col-md-1">
                            <img src="/system/assets/img/icono_' . $icono . '.webp" alt="..." style="margin: 5%; width: 60px; height: 60px; border-radius: 50%;">
                        </div>
                        <div class="col-md-11">
                            <div class="card-body">
                                <h3 class="card-title">' . $nombre . '</h3>
                                <p class="card-text">' . $estrellas . ' ' . self::getFechaLetras($fecha) . '</p>
                                <p class="card-text"><small class="text-body-secondary" style="font-size: 18px;">' . $opinion . '</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';
    }
    public static function getFechaLetras($fecha)
    {
        $fechaLetras = explode('-', $fecha);
        return $fechaLetras[2] . ' de ' . self::mes($fechaLetras[1]) . ' de ' . $fechaLetras[0];
    }

    private static function mes($numero)
    {
        switch ($numero) {
            case 12: {
                    $numu = "Diciembre";
                    break;
                }
            case 11: {
                    $numu = "Noviembre";
                    break;
                }
            case 10: {
                    $numu = "Octubre";
                    break;
                }
            case 9: {
                    $numu = "Septiembre";
                    break;
                }
            case 8: {
                    $numu = "Agosto";
                    break;
                }
            case 7: {
                    $numu = "Julio";
                    break;
                }
            case 6: {
                    $numu = "Junio";
                    break;
                }
            case 5: {
                    $numu = "Mayo";
                    break;
                }
            case 4: {
                    $numu = "Abril";
                    break;
                }
            case 3: {
                    $numu = "Marzo";
                    break;
                }
            case 2: {
                    $numu = "Febrero";
                    break;
                }
            case 1: {
                    $numu = "Enero";
                    break;
                }
            case 0: {
                    $numu = "";
                    break;
                }
        }
        return $numu;
    }
}
