<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/app.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/Path.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/Mail.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/Administrador.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/Usuario.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/Elements.php';


// Requires para el sistema de roles y permisos
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/model/RoleDTO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/model/ModuleDTO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/model/ViewDTO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/model/PermissionDTO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/model/RoleViewPermissionDTO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/Role.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/Module.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/View.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/Permission.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/RoleViewPermission.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/SessionHelper.php';


abstract  class System
{
    public static function Conexion()
    {
        try {
            if (!empty(Constants::$SQLITE_DB_PATH)) {
                $dsn = "sqlite:" . $_SERVER['DOCUMENT_ROOT'] . Constants::$SQLITE_DB_PATH;
                return new PDO($dsn);
            }
            $host   = Constants::$IP_BD;
            $dbname = Constants::$NOMBRE_BD;
            $dsn    = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
            return new PDO($dsn, Constants::$USUARIO_BD, Constants::$PASS_BD);
        } catch (PDOException $e) {
            // Fallback to SQLite if MySQL fails and SQLite database exists
            $sqlitePath = $_SERVER['DOCUMENT_ROOT'] . '/system/bd/database.sqlite';
            if (file_exists($sqlitePath)) {
                return new PDO("sqlite:" . $sqlitePath);
            }
            echo $e->getMessage();
        }
    }

    function hyphenize($string)
    {
        try {
            $dict = array(
                "I'm"      => "I am",
                "thier"    => "their",
            );

            return strtolower(
                preg_replace(
                    array('#[\\s-]+#', '#[^A-Za-z0-9. -]+#'),
                    array('-', ''),
                    $this->limpiarString(
                        str_replace(
                            array_keys($dict),
                            array_values($dict),
                            urldecode($string)
                        )
                    )
                )
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function limpiarString($text)
    {
        try {
            $utf8 = array(
                '/[áàâãªä]/u'   =>   'á',
                '/[ÁÀÂÃÄ]/u'    =>   'Á',
                '/[ÍÌÎÏ]/u'     =>   'Í',
                '/[íìîï]/u'     =>   'í',
                '/[éèêë]/u'     =>   'é',
                '/[ÉÈÊË]/u'     =>   'É',
                '/[óòôõºö]/u'   =>   'ó',
                '/[ÓÒÔÕÖ]/u'    =>   'Ó',
                '/[úùûü]/u'     =>   'ú',
                '/[ÚÙÛÜ]/u'     =>   'Ú',
                '/ç/'           =>   'c',
                '/Ç/'           =>   'C',
                '/ñ/'           =>   'n',
                '/Ñ/'           =>   'N',
                '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
                '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
                '/[“”«»„]/u'    =>   ' ', // Double quote
                '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
            );
            return preg_replace(array_keys($utf8), array_values($utf8), $text);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public static function hash($password)
    {
        try {
            return hash(Constants::$HASH_TYPE, Constants::$HASH_SALT . $password);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function verify($password, $hash)
    {
        try {
            return ($hash == self::hash($password));
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public static function logout()
    {
        try {
            //session_start();
            //$_SESSION = array();
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(
                    session_name(),
                    '',
                    time() - 42000,
                    $params["path"],
                    $params["domain"],
                    $params["secure"],
                    $params["httponly"]
                );
            }
            session_destroy();
            if (isset($mysqli)) {
                mysqli_close($mysqli);
            }
            header("Location: ../page/login");
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public static function validarSession()
    {
        try {
            if (!isset($_SESSION['id']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
                self::logout();
                exit();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function validarAdmin()
    {
        try {
            if (!($_SESSION['tipo'] == 0 || $_SESSION['tipo'] == 5)) {
                self::logout();
                exit();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function validarUser()
    {
        try {
            if ($_SESSION['tipo'] != 1) {
                self::logout();
                exit();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function login($user, $pass_hash)
    {
        try {
            $administrador  = Administrador::getAdministrador($user, $pass_hash);
            $usuario        = Usuario::getUser($user, $pass_hash);


            if ($administrador != null) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                // Usar SessionHelper para inicializar sesión completa con permisos dinámicos
                SessionHelper::initializeUserSession($administrador, "Administrador", $administrador->getTipo());
                header("Location:/system/views/admin/index");
                exit();
            }
            if ($usuario != null) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                // Usar SessionHelper para inicializar sesión completa con permisos dinámicos
                SessionHelper::initializeUserSession($usuario, "Usuario", $usuario->getTipo());
                header("Location:/system/views/admin/index");
                exit();
            }
            return false;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function recovery($cedula)
    {
        try {
            $administrador  = Administrador::getAdministradorByCedula($cedula);
            $asunto = "Recuperar cuenta Aplicacion Web Kondory";

            if ($administrador != null) {
                $new_pass = self::randomPassword();
                if (Administrador::setAdministradorPass($administrador->getId_administrador(), self::hash($new_pass))) {
                    $mensaje = "Hola " . $administrador->getNombre();
                    $mensaje .= " <br> " . "Su nueva contraseña para ingresar al sistema  es: " . $new_pass;
                    Mail::sendEmail($asunto, $mensaje, $administrador->getCorreo());
                    return true;
                }
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public static function getIP()
    {
        try {
            //whether ip is from the share internet  
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
            //whether ip is from the proxy  
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            //whether ip is from the remote address  
            else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            return $ip;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function randomPassword()
    {
        try {
            $alphabet = 'abcdefghijklmnopqrstuvwxyz1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass); //turn the array into a string
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function converterImageToBase64($url_image)
    {
        try {
            // Extensión de la imagen
            $type = pathinfo($url_image, PATHINFO_EXTENSION);
            // Cargando la imagen
            $data = file_get_contents($url_image);
            // Codificando la imagen en base64
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

            return $base64;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function enviarCorreos($destino, $asunto, $mensaje)
    {
        try {
            if (Mail::sendEmail($asunto, $mensaje, $destino)) {
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // ============================================
    // MÉTODOS DEL SISTEMA DE ROLES Y PERMISOS
    // ============================================

    /**
     * Verificar acceso al módulo usando permisos dinámicos desde la BD
     *
     * @param array $pathParts Partes de la URL
     * @param int $id_rol ID del rol del usuario
     * @return bool True si tiene acceso, False si no
     */
    public static function checkModuleAccess($pathParts, $id_rol)
    {
        $module = null;

        // Extraer el nombre del módulo de la URL
        foreach ($pathParts as $part) {
            // Ignorar parámetros GET (eliminar todo después del signo ?)
            $cleanPart = explode('?', $part)[0];

            // Ignorar partes vacías y 'admin' o 'user'
            if (empty($cleanPart) || $cleanPart === 'admin' || $cleanPart === 'user' || $cleanPart === 'system' || $cleanPart === 'views') {
                continue;
            }

            // El primer segmento válido es probablemente el módulo
            $module = $cleanPart;
            break;
        }

        // Si no se detectó módulo, permitir acceso (index u otras páginas sin módulo)
        if (!$module) {
            return true;
        }

        // Limpiar sufijos comunes de vistas (-edit, -create, etc.)
        // Ejemplos: clients-edit -> clients, users-new -> users
        $moduleName = preg_replace('/-(edit|create|new|view|delete|update)$/', '', $module);

        // Usar SessionHelper para verificar acceso dinámico
        return SessionHelper::hasModuleAccess($moduleName, $id_rol);
    }

    /**
     * Manejar acceso denegado
     *
     * @param string $baseUrl URL base para redirección
     */
    public static function handleAccessDenied($baseUrl)
    {
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $baseUrl . 'index.php';
        $_SESSION['access_denied_message'] = "¡Acceso denegado! No tienes permisos para acceder a este módulo";
        header("Location: $referer");
        exit;
    }

    /**
     * Procesar mensaje de acceso denegado
     *
     * @return string|null HTML del mensaje de alerta o null si no hay mensaje
     */
    public static function processAccessDeniedMessage()
    {
        if (isset($_SESSION['access_denied_message'])) {
            $mensaje = $_SESSION['access_denied_message'];
            unset($_SESSION['access_denied_message']);
            return Elements::crearMensajeAlerta($mensaje, 'error');
        }
        return null;
    }

    /**
     * Verificar si un usuario tiene permiso para acceder a una vista o módulo específico
     * Delega a las clases Role y RoleViewPermission
     *
     * @param int $tipo Tipo legacy del usuario (0, 1, 5)
     * @param string $moduleName Nombre del módulo
     * @param string|null $viewName Nombre de la vista (opcional)
     * @param string $permissionName Nombre del permiso (por defecto 'access')
     * @return bool True si tiene permiso, False si no
     */
    public static function checkPermission($tipo, $moduleName, $viewName = null, $permissionName = 'access')
    {
        try {
            // Obtener rol ID desde tipo_legacy
            $id_rol = Role::getRoleIdByLegacyType($tipo);

            if (!$id_rol) {
                return false; // Rol no encontrado
            }

            // Verificar permiso según si se especificó vista o no
            if ($viewName === null) {
                return RoleViewPermission::checkModulePermission($id_rol, $moduleName, $permissionName);
            } else {
                return RoleViewPermission::checkViewPermission($id_rol, $moduleName, $viewName, $permissionName);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
