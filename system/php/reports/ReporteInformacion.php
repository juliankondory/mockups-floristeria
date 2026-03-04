<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/libs/Dompdf/autoload.inc.php';

class ReporteInformacion
{
    public static function generatePdf($perfilDTO)
    {
        $url_imagen = $_SERVER['DOCUMENT_ROOT'] . Path::$DIR_IMG_PERFIL . $perfilDTO->getImagen();
        $logo       = System::converterImageToBase64($url_imagen);

        $pdfName = 'reporte_informacion_empresa_' . date('Y-m-d') . '.pdf';
        $dompdf = new Dompdf\Dompdf();

        $html = '<style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            font-size:13px;
            align-items:center;
            text-align: center;
        }
        label{
            font-size:13px;
        }
        .negrilla{
            font-weight: bold;
        }
        .fondoTitulo{
            background-color: '.$perfilDTO->getColor1().'
        }
        .deleteBorder{
            border: none;
        }
        </style>
        <div>
            <table class="default" style="width:100%">
                <tr>
                    <th colspan="1" rowspan="3">
                        <img src="' . $logo . '" width="150px" height="50px" style="max-width:200px;max-height:80px;">
                    </th>
                    <th colspan="3" rowspan="3">
                        KONDORI TECNOLOGIA
                        <br>
                        EMPRESA DE DESARROLLO WEB
                    </th>
                    <th colspan="1" rowspan="1">
                        Fecha: '.date('Y-m-d').'
                    </th>
                </tr>
                <tr>
                    <th colspan="1" rowspan="1">
                        Numero reporte: 1
                    </th>
                </tr>
                <tr>
                    <th colspan="1" rowspan="1">
                        Versión: 1.0
                    </th>
                </tr>
            </table>
            <br
            <table class="default" style="width:100%">
                <tr>
                    <th colspan="4" class="fondoTitulo">
                        Datos de la compañia
                    </th>
                </tr>
                <tr>
                    <td colspan="1" style="width:25%">
                        Nombre:
                    </td>
                    <td colspan="1" style="width:25%">
                        '.$perfilDTO->getNombre().'
                    </td>
                    <td colspan="1" style="width:25%">
                        NIT:
                    </td>
                    <td colspan="1" style="width:25%">
                        '.$perfilDTO->getNit().'
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="width:25%">
                        Telefono:
                    </td>
                    <td colspan="1" style="width:25%">
                        '.$perfilDTO->getTelefono().'
                    </td>
                    <td colspan="1" style="width:25%">
                        Whatsapp:
                    </td>
                    <td colspan="1" style="width:25%">
                        '.$perfilDTO->getWp().'
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="width:25%">
                        Correo:
                    </td>
                    <td colspan="1" style="width:25%">
                        '.$perfilDTO->getCorreo().'
                    </td>
                    <td colspan="1" style="width:25%">
                        Dirección:
                    </td>
                    <td colspan="1" style="width:25%">
                        '.$perfilDTO->getDireccion().'
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="width:25%">
                        Ciudad:
                    </td>
                    <td colspan="1" style="width:25%">
                        '.$perfilDTO->getCiudad().'
                    </td>
                    <td colspan="1" style="width:25%">
                        Departamento:
                    </td>
                    <td colspan="1" style="width:25%">
                        '.$perfilDTO->getDepartamento().'
                    </td>
                </tr>
            </table>
            <br><br>
            <hr>
            <small>Generado automáticamente por el sistema <strong>KONDORY TECNOLOGIA</strong> el ' . date('Y-m-d') . ' a las ' . date('H:i:s') . '</small>
        </div>';

        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream($pdfName, array("Attachment" => 0));
    }
}
