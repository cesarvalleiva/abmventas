<?php

class Producto{
    private $idProducto;
    private $nombre;
    private $cantidad;
    private $precio;
    private $descripcion;

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
        return $this;
    }

    public function cargarDesdeRequest($form){
        $this->idProducto = $form["prod"];
        $this->nombre = $form["txtNombre"];
        $this->cantidad = $form["txtCantidad"];
        $this->precio = $form["txtPrecio"];
        $this->descripcion = $form["txtDescripcion"];
    }


    public function insertar(){
        $mysql = new mysqli(Constante::BBDD_HOST, Constante::BBDD_USUARIO, Constante::BBDD_CLAVE, Constante::BBDD_NOMBRE);
        $mysql->query("INSERT INTO productos (nombre, cantidad, precio, descripcion) VALUE ('$this->nombre', $this->cantidad, $this->precio, '$this->descripcion')");
    }

    public function borrar(){
        $mysqli = new mysqli(Constante::BBDD_HOST, Constante::BBDD_USUARIO, Constante::BBDD_CLAVE, Constante::BBDD_NOMBRE);
        $resulado = $mysqli->query("DELETE FROM productos WHERE idproducto = $this->idProducto");
    }
    
    public function actualizar(){
        $mysqli = new mysqli(Constante::BBDD_HOST, Constante::BBDD_USUARIO, Constante::BBDD_CLAVE, Constante::BBDD_NOMBRE);
        $resulado = $mysqli->query("UPDATE productos
                SET
                nombre = '$this->nombre',
                cantidad = $this->cantidad,
                precio = $this->precio,
                descripcion = '$this->descripcion'
                WHERE idproducto = $this->idProducto
                ");
    }

    public function obtenerTodos(){
        $aProducto = null;
        $mysqli = new mysqli(Constante::BBDD_HOST, Constante::BBDD_USUARIO, Constante::BBDD_CLAVE, Constante::BBDD_NOMBRE);
        $resultado = $mysqli->query("SELECT idproducto,
            nombre,
            cantidad,
            precio,
            descripcion
            FROM productos ORDER BY idproducto ASC");

        if($resultado){
            while ($fila = $resultado->fetch_assoc()) {
                $obj = new Producto();
                $obj->idProducto = $fila["idproducto"];
                $obj->nombre = $fila["nombre"];
                $obj->cantidad = $fila["cantidad"];
                $obj->precio = $fila["precio"];
                $obj->descripcion = $fila["descripcion"];
                $aProducto[] = $obj;

            }
            return $aProducto;
        }
    }

    public function obtenerPorId($idProducto){
        $mysqli = new mysqli(Constante::BBDD_HOST, Constante::BBDD_USUARIO, Constante::BBDD_CLAVE, Constante::BBDD_NOMBRE);
        $resultado = $mysqli->query("SELECT idproducto,
            nombre,
            cantidad,
            precio,
            descripcion
            FROM productos
            WHERE idproducto = $idProducto");

            if($resultado){
                $fila = $resultado->fetch_assoc();
                $this->idProducto = $fila["idproducto"];
                $this->nombre = $fila["nombre"];
                $this->cantidad = $fila["cantidad"];
                $this->precio = $fila["precio"];
                $this->descripcion = $fila["descripcion"];

                return true;
            }
    }
}


?>