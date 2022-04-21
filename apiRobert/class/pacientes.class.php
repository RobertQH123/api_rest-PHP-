<?php
include_once "model/pacientesModel.php";

class Pacientes extends PacientesModel{
    priVate $dni = ""; 
    priVate $pacienteId = ""; 
    priVate $nombre = ""; 
    priVate $direccion = ""; 
    priVate $codigoPostal = ""; 
    priVate $telefono = ""; 
    priVate $genero = ""; 
    priVate $fechaNacimiento = "0000-00-00"; 
    priVate $correo = "";
    private $token = "";
    

    public function postPaciente($datos){
        $_respuestas = new Respuestas;
        if(isset($datos["token"])){
            if(isset($datos["nombre"]) && isset($datos["dni"]) && isset($datos["correo"])){
                if(!isset($datos["direccion"])){  $datos +=   ["direccion"=>$this->direccion ]; }
                if(!isset($datos["codigoPostal"])){ $datos += ["codigoPostal"=>$this->codigoPostal]; }
                if(!isset($datos["telefono"])){ $datos += ["telefono"=>$this->telefono]; }
                if(!isset($datos["genero"])){$datos  += ["genero"=>$this->genero]; }
                if(!isset($datos["fechaNacimiento"])){$datos  += ["fechaNacimiento"=>$this->fechaNacimiento]; }
                $resul = $this->insert($datos);
                return $resul;
            }else{
                return $_respuestas->error_400();
            }
        }else{
            return $_respuestas->error_401();   
        }
    }
    public function putPaciente($datos){
        $_respuestas = new Respuestas;
        if(isset($datos["token"])){
            if(isset($datos["pacienteId"])){
                if(!isset($datos["nombre"])){ $datos += ["nombre"=>$this->nombre]; }
                if(!isset($datos["dni"])){$datos  += ["dni"=>$this->dni]; }
                if(!isset($datos["correo"])){ $datos += ["correo"=>$this->correo]; }
                if(!isset($datos["direccion"])){$datos  += ["direccion"=>$this->direccion]; }
                if(!isset($datos["codigoPostal"])){ $datos += ["codigoPostal"=>$this->codigoPostal]; }
                if(!isset($datos["telefono"])){ $datos += ["telefono"=>$this->telefono]; }
                if(!isset($datos["genero"])){$datos  += ["genero"=>$this->genero]; }
                if(!isset($datos["fechaNacimiento"])){$datos  += ["fechaNacimiento"=>$this->fechaNacimiento]; }
                $resul = $this->edit($datos);
                return $resul;
            }else{
                return $_respuestas->error_400();;
            }
        }else{
            return $_respuestas->error_401();   
        }
    }
    public function deletePaciente($datos){
        $_respuestas = new Respuestas;
        if(isset($datos["token"])){
            if(isset($datos["pacienteId"])){
                $id = $datos["pacienteId"];
                $resul = $this->delete($id);
                return $resul;
            }else{
                return $_respuestas->error_400();;
            }
        }else{
            return $_respuestas->error_401();   
        }
    }
}
?>