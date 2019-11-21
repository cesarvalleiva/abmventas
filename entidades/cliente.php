<?php

class Cliente{
    private $idCliente;
    private $dni;
    private $nombre;
    private $telefono;
    private $correo;

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
        return $this;
    }

    public function cargarDesdeRequest($form){
        $this->idCliente = $form["cliente"];
        $this->dni = $form["txtDNI"];
        $this->nombre = $form["txtNombre"];
        $this->telefono = $form["txtTelefono"];
        $this->correo = $form["txtCorreo"];
    }


    public function insertar(){
        $mysql = new mysqli(Constante::BBDD_HOST, Constante::BBDD_USUARIO, Constante::BBDD_CLAVE, Constante::BBDD_NOMBRE);
        $mysql->query("INSERT INTO clientes (dni, nombre, telefono, correo) VALUE ($this->dni, '$this->nombre', $this->telefono, '$this->correo')");
    }

    public function borrar(){
        $mysqli = new mysqli(Constante::BBDD_HOST, Constante::BBDD_USUARIO, Constante::BBDD_CLAVE, Constante::BBDD_NOMBRE);
        $resulado = $mysqli->query("DELETE FROM clientes WHERE idcliente = $this->idCliente");
    }
    
    public function actualizar(){
        $mysqli = new mysqli(Constante::BBDD_HOST, Constante::BBDD_USUARIO, Constante::BBDD_CLAVE, Constante::BBDD_NOMBRE);
        $resulado = $mysqli->query("UPDATE clientes
                SET
                dni = $this->dni,
                nombre = '$this->nombre',
                telefono = $this->telefono,
                correo = '$this->correo'
                WHERE idcliente = $this->idCliente
                ");
    }

    public function obtenerTodos(){
        $aCliente = null;
        $mysqli = new mysqli(Constante::BBDD_HOST, Constante::BBDD_USUARIO, Constante::BBDD_CLAVE, Constante::BBDD_NOMBRE);
        $resultado = $mysqli->query("SELECT idcliente,
            dni,
            nombre,
            telefono,
            correo
            FROM clientes ORDER BY idcliente ASC");

        if($resultado){
            while ($fila = $resultado->fetch_assoc()) {
                $obj = new Cliente();
                $obj->idCliente = $fila["idcliente"];
                $obj->dni = $fila["dni"];
                $obj->nombre = $fila["nombre"];
                $obj->telefono = $fila["telefono"];
                $obj->correo = $fila["correo"];
                $aCliente[] = $obj;

            }
            return $aCliente;
        }
    }

    public function obtenerPorId($idCliente){
        $mysqli = new mysqli(Constante::BBDD_HOST, Constante::BBDD_USUARIO, Constante::BBDD_CLAVE, Constante::BBDD_NOMBRE);
        $resultado = $mysqli->query("SELECT idcliente,
            dni,
            nombre,
            telefono,
            correo
            FROM clientes
            WHERE idcliente = $idCliente");

            if($resultado){
                $fila = $resultado->fetch_assoc();
                $this->idCliente = $fila["idcliente"];
                $this->dni = $fila["dni"];
                $this->nombre = $fila["nombre"];
                $this->telefono = $fila["telefono"];
                $this->correo = $fila["correo"];

                return true;
            }
    }
}


?>