<?php

class UsuarioControlador {

    static public function LoginUsuario() {

        if (isset($_POST["IngresoUsuario"])) {
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["IngresoUsuario"]) &&
                    preg_match('/^[a-zA-Z0-9]+$/', $_POST["IngresoPassword"])) {

                //	$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "usuario";
                $item = "Usuario";
                $valor = $_POST["IngresoUsuario"];

                $respuesta = UsuarioModelo::mdlMostrarUsuarios($tabla, $item, $valor);

                if ($respuesta["Usuario"] == $_POST["IngresoUsuario"] && $respuesta["Password"] == $_POST["IngresoPassword"]) {

                    if ($respuesta["Estado"] == 1) {

                        $_SESSION["IniciarSesion"] = "Ok";
                        /* =============================================
                          TRAEMOS AL MEDICO
                          ============================================= */
                        $item1 = "idMedico";
                        $valor1 = $respuesta["idMedico"];
                        $Medico = MedicoControlador::ctrMostrarMedico($item1, $valor1);

                        /* =============================================
                          TRAEMOS LA ESPECIALIDAD
                          ============================================= */
                        $item2 = "idEspecialidad";
                        $valor2 = $Medico["idEspecialidad"];
                        $Especialidad = EspecialidadControlador::ctrMostrarEspecialidades($item2, $valor2);

                        $_SESSION["idMedico"] = $respuesta["idMedico"];
                        $_SESSION["Nombres"] = $Medico["Nombres"];
                        $_SESSION["Apellidos"] = $Medico["Apellidos"];
                        $_SESSION["Fotografia"] = $Medico["Fotografia"];
                        $_SESSION["Especialidad"] = $Especialidad["Descripcion"];
                        $_SESSION["Perfil"] = $respuesta["IdPerfil"];

                        echo '<script>window.location = "Inicio";</script>';
                    } else {
                        echo '<br><div class="alert alert-danger">El usuario aún no está activado</div>';
                    }
                } else {

                    echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
                }
            }
        }
    }

    /* =============================================
      MOSTRAR USUARIO
      ============================================= */

    static public function ctrMostrarUsuario($item, $valor) {
        $tabla = "AirUser";
        $respuesta = UsuarioModelo::mdlMostrarUsuarios($tabla, $item, $valor);
        return $respuesta;
    }

    /* =============================================
      CREAR USUARIO
      ============================================= */

    static public function ctrCrearUsuario() {

        if (isset($_POST["IngresoIdMedico"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["IngresoUsuario"])) {

                $tabla = "usuario";
                $datos = array("Usuario" => $_POST["IngresoUsuario"],
                    "Password" => $_POST["IngresoContraseña"],
                    "IdPerfil" => $_POST["IngresoPerfil"],
                    "Estado" => $_POST["IngresoEstado"],
                    "idMedico" => $_POST["IngresoIdMedico"]);

                $respuesta = UsuarioModelo::mdlIngresarUsuario($tabla, $datos);
                if ($respuesta == "ok") {

                    echo'<script>

					Swal.fire({
						  icon: "success",
						  title: "El usuario ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "Usuario";

									}
								})

					</script>';
                }
            } else {

                echo'<script>

					Swal.fire({
						  icon: "error",
						  title: "¡El usuario no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "Usuario";

							}
						})

			  	</script>';
            }
        }
    }

    /* =============================================
      EDITAR USUARIO
      ============================================= */

    static public function ctrEditarUsuario() {

        if (isset($_POST["EditarIdUsuario"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["EditarUsuario"])) {

                $tabla = "usuario";
                $datos = array("idUsuario" => $_POST["EditarIdUsuario"],
                    "Password" => $_POST["EditarContraseña"],
                    "IdPerfil" => $_POST["EditarPerfil"],
                    "Estado" => $_POST["EditarEstado"]);

                $respuesta = UsuarioModelo::mdlEditarUsuario($tabla, $datos);

                if ($respuesta == "ok") {

                    echo'<script>

					Swal.fire({
						icon: "success",
						  title: "El usuario ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "Usuario";

									}
								})

					</script>';
                }
            } else {

                echo'<script>

					Swal.fire({
						  icon: "error",
						  title: "¡El usuario no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "Usuario";

							}
						})

			  	</script>';
            }
        }
    }

    /* =============================================
      BORRAR USUARIO
      ============================================= */

    static public function ctrBorrarUsuario() {

        if (isset($_GET["idUsuario"])) {
            $tabla = "usuario";
            $datos = $_GET["idUsuario"];
            $respuesta = UsuarioModelo::mdlBorrarUsuario($tabla, $datos);

            if ($respuesta == "ok") {

                echo'<script>

					Swal.fire({
						  icon: "success",
						  title: "El usuario ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "Usuario";

									}
								})

					</script>';
            }
        }
    }

}
