<?php
include_once "dataBase/db.php";
include_once "class/respuestas.php";

class PacientesModel extends DB{
    public function list($pagina = 1){
        $inicio = 0;
        $catidad = 100;
        if($pagina > 1){
            $inicio = $catidad*($pagina-1)+1;
            $catidad = $catidad*$pagina;
        }
        $query = $this->connect()->query("SELECT PacienteId,Nombre,DNI,Telefono,Correo FROM pacientes LIMIT $inicio,$catidad");
        $arrayPaciente = $query->fetchAll(PDO::FETCH_ASSOC);
        return $arrayPaciente;
    }
    public function view($idPaciente){
        $_respuestas=new Respuestas;
        try{        
            $query = $this->connect()->prepare("SELECT PacienteId,DNI,Nombre,Direccion,CodigoPostal,Telefono,Genero,FechaNacimiento,Correo FROM pacientes WHERE PacienteId=:PacienteId");
            $query->bindparam('PacienteId',$idPaciente);
            $query->execute();
            if($query->rowCount()>0){
                $arrayPaciente = $query->fetchAll(PDO::FETCH_ASSOC);
                return $arrayPaciente;
            }else{
                return $_respuestas->error_500("paciente no existe");
            }
            
        }catch(PDOException $e){
            return $_respuestas->error_500();
        }
    }
    private function getId($dni,$nombre){
        try{        
            $query = $this->connect()->prepare("SELECT PacienteId FROM pacientes WHERE DNI=:dni AND Nombre=:nombre");
            $query->bindparam('dni',$dni);
            $query->bindparam('nombre',$nombre);
            $query->execute();
            $idpaciente = $query->fetch(PDO::FETCH_OBJ)->PacienteId;
            return $idpaciente;
        }catch(PDOException $e){
            return false;
        }
    }
    protected function insert($datos){
        $_respuestas=new Respuestas;
        try{        
            $query = $this->connect()->prepare("INSERT INTO pacientes(DNI,Nombre,Direccion, CodigoPostal,Telefono,Genero,FechaNacimiento,Correo) 
            VALUES 
            (:dni,:nombre,:direccion,:codigoPostal,:telefono,:genero,:fechaNacimiento,:correo)");
            $query->bindparam('dni',$datos["dni"]);
            $query->bindparam('nombre',$datos["nombre"]);
            $query->bindparam('direccion',$datos["direccion"]);
            $query->bindparam('codigoPostal',$datos["codigoPostal"]);
            $query->bindparam('genero',$datos["genero"]);
            $query->bindparam('telefono',$datos["telefono"]);
            $query->bindparam('fechaNacimiento',$datos["fechaNacimiento"]);
            $query->bindparam('correo',$datos["correo"]);
            $query->execute();
                      
            if($query->rowCount()>0){
                $idpaciente = $this->getId($datos["dni"],$datos["nombre"]);
                $respuesta = $_respuestas->response;
                $respuesta["result"] =array("pacienteId" => $idpaciente);
                return $respuesta;
            }else{
                return $_respuestas->error_500("no se pudo inserterar paciente");
            }   

        }catch(PDOException $e){
            return $_respuestas->error_500();
        }
    }
    protected function edit($datos){
        $_respuestas=new Respuestas;
        try{
   
            $query = $this->connect()->prepare("UPDATE pacientes SET
            DNI=:dni,Nombre=:nombre,Direccion=:direccion,CodigoPostal=:codigoPostal,Telefono=:telefono,Genero=:genero,FechaNacimiento=:fechaNacimiento,Correo=:correo
            WHERE PacienteId=:pacienteId");
            $query->bindparam('dni',$datos["dni"]);
            $query->bindparam('nombre',$datos["nombre"]);
            $query->bindparam('direccion',$datos["direccion"]);
            $query->bindparam('codigoPostal',$datos["codigoPostal"]);
            $query->bindparam('telefono',$datos["telefono"]);
            $query->bindparam('genero',$datos["genero"]);
            $query->bindparam('fechaNacimiento',$datos["fechaNacimiento"]);
            $query->bindparam('correo',$datos["correo"]);
            $query->bindparam('pacienteId',$datos["pacienteId"]);
            $query->execute();
            if($query->rowCount()>0){
                $idpaciente = $datos["pacienteId"];
                $respuesta = $_respuestas->response;
                $respuesta["result"] =array("pacienteId" => $idpaciente);
                return $respuesta;
            }else{
                return $_respuestas->error_500("no se pudo editar datos");
            }    
        }catch(PDOException $e){
            return $_respuestas->error_500();
        }
    }
    protected function delete($idPaciente){
        $_respuestas=new Respuestas;
        try{        
            $query = $this->connect()->prepare("DELETE FROM pacientes WHERE PacienteId=:pacienteId");
            $query->bindparam('pacienteId',$idPaciente);
            $query->execute();
            if($query->rowCount()>0){
                $respuesta = $_respuestas->response;
                $respuesta["result"] =array("pacienteId" => $idPaciente);
                return $respuesta;
            }else{
                return $_respuestas->error_500("no se pudo eliminar paciente");
            }    
        }catch(PDOException $e){
            return $_respuestas->error_500();
        }
    }
}
?>
