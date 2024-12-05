<?php 
    // import Database Configuration
    require_once '../../DbConfig/Config.php';

    class ServiceModal extends Config {

        public function InsertService(){
            $query = 'INSERT INTO Services (libservice)
                      VALUES (:libservice)';
            $statement = $this->Connexion->prepare($query);
            $statement->execute(['libservice'=>$this->libservice]);
            return true;
        }
        public function UpdateServiceById(){
            $query ='UPDATE Services 
                     SET libservice=:libservice
                     WHERE IdService=:IdService';
            $statement = $this->Connexion->prepare($query);
            $statement->execute(['libservie'=>$this->libservice,
                                 'IdService'=>$this->IdService]);
            return true;
        }

        public function IfIsExistedService(){
            $query='SELECT * FROM Services 
            WHERE libservice=:libservice';
            $statement =$this->Connexion->prepare($query);
            $statement->execute([
                'libservice'=>$this->libService
            ]);
            $statement-> fetch(PDO::FETCH_OBJ);
            return $statement->rowCount();
        }
        
        public function FethAllService(){
            $data = array();
            $query='SELECT * FROM Services';
            $statement =$this->Connexion->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            foreach ($result as $row){
                $data[]=$row;
            }
            return $data;
        }

        public function NoterService(){
            $data = array();
            $query='SELECT Id_notation,Ser.IdService,Ser.libservice,nota.note FROM Services Ser,notation nota 
                    WHERE Ser.libservice=nota.libservice';
            $statement =$this->Connexion->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            foreach ($result as $row){
                $data[]=$row;
            }
            return $data;
        }

        public function NoteClientByService(){
            $data = array();
            $query='SELECT Id_notation,Ser.IdService,Ser.libservice,note,Cl.CliFname 
                    FROM Services Ser,notation nota,Client Cl 
                    WHERE Ser.libservice=nota.libservice 
                    And Cl.CliEmail=nota.CliEmail';
            $statement =$this->Connexion->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            foreach ($result as $row){
                $data[]=$row;
            }
            return $data;
        }

        public function SendNotation(){
            $query ="UPDATE notation 
                     SET CliEmail=:CliEmail, note=:note 
                     WHERE Id_notation=:Id_notation";
            $statement = $this->Connexion->prepare($query);
            $statement->execute(['CliEmail'=>$this->CliEmail,
                                 'note'=>$this->note,
                                 'Id_notation'=>$this->IdService]);
            return true;

        }

    }
    
?>