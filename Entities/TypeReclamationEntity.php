<?php 

    //require_once '../DbConfig/Config.php';
    require_once '../../Modals/TypeReclamationModal.php';

    // Type Reclamation Entity
    class TypeReclamationEntity extends TypeReclamationModal {

        public $TypeId;
        public $TypeReclam;
        public $Categorie;

        // Gette And Setter Of Type Reclamation
        public function setTypeId($TypeId){
            $this->TypeId=$TypeId;
        }
        public function getTypeId(){
           return $this->TypeId;
        }
        public function setTypeReclam($TypeReclam){
            $this->TypeReclam=$TypeReclam;
        }
        public function getTypeReclam(){
           return $this->TypeReclam;
        }
        public function setCategorie($Categorie){
            $this->Categorie=$Categorie;
        }
        public function getCategorie(){
           return $this->Categorie;
        }

        // Methods
        // Procedure And Function to Manipulate Tye Reclamation Datas
        public function Insert(){
            return $this->InsertType();
        }
        public function Update(){
            return $this->UpdateTypeById();
        }
        public function Delete(){
            return $this->DeleteTypeId();
        }
        public function IsExistedType(){
            return $this->IfIsExistedType();
        }

        public function GetAllType(){
            return $this->FethAllTypeReclamation();
        }


    }
?>