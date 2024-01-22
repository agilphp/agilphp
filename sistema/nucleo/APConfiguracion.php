<?php 

/* develop o production*/
define('ENTORNO', 'production');

/* inicio la configuracion*/
define('Ap_CONFIG_INICIO', 'true');

/* Defino zona horaria*/
date_default_timezone_set('America/Bogota');

/* Define una cuenta de correo para uso del app */
define('DESTINO_EMAIL', 'info@AgilPhp.com');

/* Defino el formato de fecha */
define('Ap_FORMATO_FECHA', 'l, d F Y');

/* AgilPhp clave de licencia */
define('Ap_LICENSE', 'AP-O17N-JHK8-TDJL-B5AO-8WKA');

/* mensajes de warnin */
define('Ap_DEBUG', TRUE);

/* Idioma local */
define('Ap_LOCALE', 'es_ES');

/* Create una cuenta con google analytics y agrega el UA en la constante */
define('Ap_ANALYTICS', 'UA-xxxxxx');

/* con la siguiente constante podras crear una ip fija de tu empresa para hacer 
* pruebas en tu entorno de red basado en tu ip que te ofrece tu proveedor de servicio
*/
define('Ap_IPPRUEBAS', 'x.x.x.x');

/* Transladamos a formato local */
define('Ap_FECHA_FORMATO_LOCAL', '%A, %d %B %G');

/* Translatable time format */
define('Ap_LOCALE_TIME_FORMAT', ' %T');

/* Por defecto almacenamos los datos de la aplicacion. */
define('Ap_PATH_DATA', dirname(__FILE__) . '/AP-data');

#Configuracion Basica

/* La siguiente CONSTANTE permite el apuntapiento para archivos js, css, imagenes desde la vista hacia el directorio _public */
define('Ap_BASE_URL', 'http://localhost/agilphp/');
define('SERVERNAME', 'https://agilphp.com');

/* definimos un controlador inicial en nuestro proyecto */
define('CONTROLADOR_INICIAL', 'user');

/* Sedefine una CONSTANTE al directorio adicionales en la vista */
define('ADICIONALES_VISTA', 'adicionales');

/* Se define una CONSTANTE al directorio con el tema del sistema WEB */
define('Ap_TEMA_WEB', 'temas/web/bootstrap');

/* Se define una CONSTANTE  con el NOMBRE del tema del sistema WEB */
define('Ap_NOMBRE_TEMA_WEB', 'Parallax');

/* Sedefine una CONSTANTE al directorio con el tema del sistema DASHBOARD*/
define('Ap_TEMA_DASHBOARD', 'temas/dashboard/inspinia');

/* Definimos una CONSTANTE como nombre de aplicacion */
define('Ap_AP_NOMBRE', 'rentalscore');

/* Definimos un Slogan para la aplicacion web */
define('Ap_AP_SLOGAN', 'Tu Framework php MVC hispano ');

/* Empresa de la aplicacion */
define('Ap_AP_EMPRESA', '@efrasoft');

/* Creditos de la aplicacion */
define('Ap_AP_CREDITOS', 'CopyLeft 2018 Debeloped by www.webcol.net');

#webcol seguridad

/* Definimos un indice de clave para concatenar en encriptacion de datos */
define('Ap_KEY_MD5', 'P0L1');

define('Ap_DOMINIO', 'https://rentalscore.co/');

/*  en el controlador concatena la constante con el llamado a la funcion generarCadenaAleatoria() de AP_PHPSeguridad */
define('Ap_CSRF_SECRET','APbeta');

/*  Si usted va a utilizar SSL debe de cambiar a true */
define('Ap_SESION_PARAMETRO_SEGURO','false');

/*INFO PARA JWT */
define('AP_KEY_VALUE','enanoelperro');
define('HTTPAUTH', 'REDIRECT_HTTP_AUTHORIZATION');


/*  Cree niveles de usuario aqui solo cambie el numero aqui y en la tabla perfiles  */
define('ROOT','1');
define('ADMINS','2');
define('TANANT','3');
define('OWNER','4');
define('COMMERCE','5');



/* #base de datos */

if(ENTORNO == "develop"){

/* Configuracion de tu base de datos desarrollo */
define('AP_BD_HOST', 'localhost');
define('AP_BD_NOMBRE', 'rental');
define('AP_BD_USUARIO', 'root');
define('AP_BD_CLAVE', '');
define('AP_BD_CHAR', 'utf8');
define('AP_BD_CONECTOR', 'mysql');
}else{
	/* Configuracion de tu base de datos produccion */
define('AP_BD_HOST', 'localhost');
define('AP_BD_NOMBRE', 'rental');
define('AP_BD_USUARIO', 'root');
define('AP_BD_CLAVE', '');
define('AP_BD_CHAR', 'utf8');
define('AP_BD_CONECTOR', 'mysql');
}