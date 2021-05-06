<?php

require_once 'ConnectionBD.php';

class UsuarioModelo {
    /* =============================================
      MOSTRAR USUARIOS
      ============================================= */

    static public function mdlMostrarUsuarios($tabla, $item, $valor) {

        if ($item != null) {

            $stmt = Connection::ConnectionBD()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {

            $stmt = Connection::ConnectionBD()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        $stmt->close();
        $stmt = null;
    }

    /* =============================================
      CREAR USUARIO
      ============================================= */

    static public function mdlIngresarUsuario($tabla, $datos) {

        $stmt = Connection::ConnectionBD()->prepare("INSERT INTO $tabla(Usuario,Password,IdPerfil,Estado,idMedico)VALUES(:Usuario,:Password,:IdPerfil,:Estado,:idMedico)");

        $stmt->bindParam(":Usuario", $datos['Usuario'], PDO::PARAM_STR);
        $stmt->bindParam(":Password", $datos['Password'], PDO::PARAM_STR);
        $stmt->bindParam(":IdPerfil", $datos['IdPerfil'], PDO::PARAM_STR);
        $stmt->bindParam(":Estado", $datos['Estado'], PDO::PARAM_INT);
        //$stmt->bindParam(":UltimoLogin", $datos['UltimoLogin'], PDO::PARAM_STR);
        $stmt->bindParam(":idMedico", $datos['idMedico'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    /* =============================================
      EDITAR USUARIO
      ============================================= */

    static public function mdlEditarUsuario($tabla, $datos) {

        $stmt = Connection::ConnectionBD()->prepare("UPDATE $tabla SET Password=:Password,IdPerfil=:IdPerfil,Estado=:Estado WHERE idUsuario=:idUsuario");

        $stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_INT);
        $stmt->bindParam(":Password", $datos["Password"], PDO::PARAM_STR);
        $stmt->bindParam(":IdPerfil", $datos["IdPerfil"], PDO::PARAM_STR);
        $stmt->bindParam(":Estado", $datos["Estado"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    /* =============================================
      BORRAR USUARIO
      ============================================= */

    static public function mdlBorrarUsuario($tabla, $datos) {

        $stmt = Connection::ConnectionBD()->prepare("DELETE FROM $tabla WHERE idUsuario = :idUsuario");
        $stmt->bindParam(":idUsuario", $datos, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

}
