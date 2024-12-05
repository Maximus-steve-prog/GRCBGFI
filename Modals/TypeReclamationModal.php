<?php 

    // import Database Configuration
    require_once '../../DbConfig/Config.php';

    class TypeReclamationModal extends Config {

        public function InsertType(){
            
        }
        public function UpdateTypeById(){

        }
        public function DeleteTypeId(){

        }
        public function IfIsExistedType(){
            $query='SELECT * FROM TypeReclamation 
            WHERE TypeReclam=:TypeReclam';
            $statement =$this->Connexion->prepare($query);
            $statement->execute([
                'TypeReclam'=>$this->TypeReclam
            ]);
            $statement-> fetch(PDO::FETCH_OBJ);
            return $statement->rowCount();
        }

        public function FethAllTypeReclamation(){
            $data = array();
            $query='SELECT * FROM TypeReclamation';
            $statement =$this->Connexion->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            foreach ($result as $row){
                $data[]=$row;
            }
            return $data;
        }


    }
    
?>