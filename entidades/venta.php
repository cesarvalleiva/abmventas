<?php

class Venta{
    private $idVenta;
    private $idCliente;
    private $idProducto;
    private $fecha;
    private $precio;

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
        return $this;
    }

    public function cargarDesdeRequest($form){
        $this->idCliente = $form["cliente"];
        $this->idProducto = $form["producto"];
        $this->precio = $form["txtPrecio"];
        $this->fecha = date("Y/m/d");
    }


    public function insertar(){
        $mysql = new mysqli(Constante::BBDD_HOST, Constante::BBDD_USUARIO, Constante::BBDD_CLAVE, Constante::BBDD_NOMBRE);
        $sql = "INSERT INTO ventas (idcliente, idproducto, precio, fecha) VALUE ($this->idCliente, $this->idProducto, $this->precio, '$this->fecha')";
        $mysql->query($sql);
    }

    public function obtenerTodos(){
        $aVentas = null;
        $mysqli = new mysqli(Constante::BBDD_HOST, Constante::BBDD_USUARIO, Constante::BBDD_CLAVE, Constante::BBDD_NOMBRE);
        $resultado = $mysqli->query("SELECT C.nombre AS Cliente, P.nombre AS Producto, V.precio AS Precio, V.fecha AS Fecha
            FROM ventas V JOIN clientes C
            ON V.idcliente=C.idcliente
            JOIN productos P 
            ON P.idproducto = V.idproducto");

            if($resultado){
            while ($fila = $resultado->fetch_assoc()) {
                $obj = new Venta();
                $obj->cliente = $fila["Cliente"];
                $obj->producto = $fila["Producto"];
                $obj->precio = $fila["Precio"];
                $obj->fecha = $fila["Fecha"];
                $aVenta[] = $obj;

            }
            return $aVenta;
        }
    }

}

?>