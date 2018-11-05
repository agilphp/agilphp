<?php

class contactosControlador extends \sistema\nucleo\APControlador
{
    
    private $_ayuda;
    
    public function __construct() {
        parent::__construct();
        
        // cargamos la clase ayudantes para usar sus metodos de ayuda
       
        $this->_ayuda= new sistema\ayudantes\APPHPAyuda();
    }
    
    public function index()
    {
        $this->_vista->titulo = 'AgilPhp';
        $this->_vista->imprimirVista('index', 'inicio');
        
        if (isset($_POST['email'])) {
            $this->_vista->validar=1;
        $para="webmaster@webcol.net";
        $this->_ayuda->enviarCorreo(
                $_POST['email'],
                $this->_ayuda->filtrarTexto($_POST['asunto']),
                $this->_ayuda->filtrarTexto($_POST['mensaje'])
        );
        }
    }
    
    public function contacto()
    {
        $this->_vista->titulo = 'AgilPhp Contactos';
        $this->_vista->imprimirVista('contactos', 'index');
             
        
                   
       
       if (isset($_POST['email'])) {
        $para="webmaster@webcol.net";
        $this->_ayuda->enviarCorreo(
                $_POST['email'],
                $this->_ayuda->filtrarTexto($_POST['asunto']),
                $this->_ayuda->filtrarTexto($_POST['mensaje'])
        );
        }
    }
    
    
}