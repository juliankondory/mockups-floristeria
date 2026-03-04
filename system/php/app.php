<?php

class Constants{

    //Configuracion web
    static $HASH_TYPE  = "sha512";
    static $HASH_SALT  = "kondoritecnologia";


    // Configuracion bd
    static $USUARIO_BD = "root";
    static $PASS_BD    = "";
    static $NOMBRE_BD  = "kondoryc_bd";
    static $IP_BD      = "localhost";
    static $SQLITE_DB_PATH = "";


    //Mensajes Pagina
    static $PAGE_MENSAJE_ENVIADO = "Mensaje enviado exitosamente";
    static $PAGE_NOS_PONDREMOS   = "Nos pondremos en contacto con usted lo mas pronto posible.";
    static $PAGE_LOGIN           = "Cedula o contraseña incorrecta";
    static $PAGE_INTENTE_DENUEVO = "Intente de Nuevo";
    static $PAGE_RECUPERAR_PASS  = "Correo enviado exitosamente";
    static $PAGE_RECUPERAR_PASS2 = "Se envio un correo electronico con las instrucciones para recuperar su cuenta!";
    static $PAGE_RECUPERAR_PASS_CEDULA    = "Cedula incorrecta";
    static $PAGE_RECUPERAR_PASS_CEDULA2   = "El numero de cedula ingresado no esta registrado en el sistema, contacte con un administrador";


    //Configuracion PHPMailer
    static $MAIL_SMTP_SERVER = "mail.kondory.com";
    static $MAIL_SMTP_USER   = "sistema@kondory.com";
    static $MAIL_SMTP_PASS   = "JwnQ?O0#E}6A";
    static $MAIL_SMTP_NAME   = "Aplicacion Web Kondory";


    //Mensajes Sistema
    static $ADMIN_NEW           = "Administrador creado exitosamente";
    static $ADMIN_UPDATE        = "Administrador actualizado exitosamente";
    static $REGISTER_DUPLICATE  = "Cedula, ya registrada en el sistema";
    static $ADMIN_REPEAT        = "Correo electronico o cedula ya registrada";
    static $CUSTOMER_NEW        = "Cliente creado exitosamente";
    static $CUSTOMER_UPDATE     = "Cliente actualizado exitosamente";
    static $REGISTER_DELETE     = "Registro eliminado exitosamente";
    static $INFORMATION_NEW     = "Informacion actualizada exitosamente";
    static $IMAGE_UPDATE        = "Imagen actualizada exitosamente";
    static $CONFIRM_PASS        = "Las contraseñas no coinciden";
    static $UPDATE_PASS         = "Contraseña actualizada exitosamente";
    static $CURRENT_PASS        = "La contraseña actual es incorrecta";
    static $USER_NEW            = "Usuario creado exitosamente";
    static $USER_UPDATE         = "Usuario actualizado exitosamente";
    static $REGISTER_NEW        = "Registro creado exitosamente";
    static $REGISTER_UPDATE     = "Registro actualizado correctamente";
    static $MESSAGE_NEW         = "Mensaje enviado exitosamente, pronto nos pondremos en contacto contigo";
    static $EMAIL_NEW           = "Correo enviado exitosamente";
    static $MESSAGE_NEW_BLOG    = "Artículo creado exitosamente";

}

// -------------------------------------------------------
// Sobrescribir constantes con variables de entorno si existen.
// Permite usar la misma base de código en local (XAMPP) y Docker.
// Los valores hardcodeados arriba actúan como fallback.
// -------------------------------------------------------
Constants::$IP_BD      = getenv('DB_HOST')          ?: Constants::$IP_BD;
Constants::$NOMBRE_BD  = getenv('DB_NAME')           ?: Constants::$NOMBRE_BD;
Constants::$USUARIO_BD = getenv('DB_USER')           ?: Constants::$USUARIO_BD;
Constants::$PASS_BD    = getenv('DB_PASSWORD')       ?: Constants::$PASS_BD;
Constants::$SQLITE_DB_PATH = getenv('SQLITE_DB_PATH') ?: Constants::$SQLITE_DB_PATH;

Constants::$MAIL_SMTP_SERVER = getenv('MAIL_SMTP_SERVER') ?: Constants::$MAIL_SMTP_SERVER;
Constants::$MAIL_SMTP_USER   = getenv('MAIL_SMTP_USER')   ?: Constants::$MAIL_SMTP_USER;
Constants::$MAIL_SMTP_PASS   = getenv('MAIL_SMTP_PASS')   ?: Constants::$MAIL_SMTP_PASS;

?>
