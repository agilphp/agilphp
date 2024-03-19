<?php

/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * @category   
 * @package    sistema/nucleo
 * @copyright  Copyright (c) 2006 - 2014 webcol.net (http://www.webcol.net/calima)
 * @license	https://github.com/webcol/Calima/blob/master/LICENSE	MIT
 * @version	##BETA 1.0##, ##2014 - 2015##
 * <http://www.AgilPhp.com>.
 */


//verificamos la version de php en tu servidor web o local
if (version_compare(PHP_VERSION, '8.0', '<')) {
    die('Su Hosting tiene una version < a PHP 8.1 debes actualizar para esta version de Calima. su version actual de PHP es: ' . PHP_VERSION);
}

header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed


use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class userControlador extends \sistema\nucleo\APControlador
{
    private $_ayuda;
    private $_seg;
    private $_sesion;
    private $_key = AP_KEY_VALUE; 
    private $_logger;
    public function __construct()

    {
        parent::__construct();

        // cargamos la clase ayudantes para usar sus metodos de ayuda
        $this->_ayuda  = new sistema\ayudantes\APPHPAyuda;
        $this->_seg    = new sistema\ayudantes\APPHPSeguridad;
        $this->_sesion = new sistema\nucleo\APSesion();
        $this->_logger = new PHPTools\PHPErrorLog\PHPErrorLog();
        //$session = new \DevCoder\SessionManager();

    }

    public function index()
    {
        // Se verifica que en el archivo de configuracion.php la constante AP_CONFIG_INICIO==true
        //Si esta en True se lanza el instalador de AP

        $this->_logger->write('Se inicia la Aplicacion Index...', PEL_INFO, realpath('log/dev.log'));
        if (Ap_CONFIG_INICIO == true) {
            echo "<H1>NO CREAS TODO LO QUE VES, OJO QUE TE PUEDEN ESTAR VIENDO...</H1>";
        }
    }

    public function login()
    {
        try {
            $user = $_GET['user'];
            $password = $_GET['password'];

            $userModelo   = $this->cargaModelo('user');
            $usuario = $userModelo->seleccionUsuario($user, $password);
            // print_r($usuario );
            // exit();
            if ($usuario == null) {
                http_response_code(404);
                echo "No se encontro el usuario";
            } else {
                //exit();

                $payload = [
                    'iss' => 'https://agilphp.com',
                    'aud' => 'https://agilphp.com',
                    'iat' => time(),
                    "exp" => time() + 3600,
                    'nbf' => 1357000000,
                    'usuario_id' => $usuario['idtbl_user'],
                    'usuario_role' => $usuario['tbl_idtbl_role']
                ];

                /**
                 * IMPORTANT:
                 * You must specify supported algorithms for your application. See
                 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
                 * for a list of spec-compliant algorithms.
                 */
                $jwt = JWT::encode($payload, $this->_key, 'HS256');
                //$decoded = JWT::decode($jwt, new Key($key, 'HS256'));

                //print_r($decoded);
                header('Content-Type: application/json');
                if ($jwt === false) {
                    // Avoid echo of empty string (which is invalid JSON), and
                    // JSONify the error message instead:
                    $jwt = json_encode(["jsonError" => json_last_error_msg()]);
                    if ($jwt === false) {
                        // This should not happen, but we go all the way now:
                        $jwt = '{"jsonError":"unknown"}';
                    }
                    // Set HTTP response status code to: 500 - Internal Server Error
                    http_response_code(500);
                }

                http_response_code(200);
                $this->_logger->write('Retorna Token...', PEL_INFO, realpath('log/dev.log'));
                echo json_encode($jwt);
            }
        } catch (Exception $e) {
            echo 'error : ' . $e->getMessage();
        }
    }
}
