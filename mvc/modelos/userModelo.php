<?php
class userModelo extends sistema\nucleo\APModelo
{


    public function seleccionUsuario($email, $clave)
    {

        $gsent = $this->_bd->consulta('select id_usuario, nombre, email, nivel from usuarios where email = :email and clave = :clave');
        $gsent = $this->_bd->enlace(':email', $email);
        $gsent = $this->_bd->enlace(':clave', $clave);

        $row = $gsent = $this->_bd->single();
        return  $row;
    }
}
