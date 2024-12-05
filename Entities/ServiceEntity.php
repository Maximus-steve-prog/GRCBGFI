<?php 

    require_once '../../Modals/ServiceModal.php';

    // Type Reclamation Entity
    class ServiceEntity extends ServiceModal {

        public $IdService;
        public $libService;
        public $note;
        public $CliEmail;


        public function setIdService($IdService){
            $this->IdService=$IdService;
        }

        public function getIdService(){
            return $this->IdService;
        }
        public function setlibService($libService){
            $this->libService=$libService;
        }

        public function getlibService(){
            return $this->libService;
        }
        public function setnote($note){
            $this->note=$note;
        }

        public function getnote(){
            return $this->note;
        }
        
        public function setCliEmail($CliEmail){
            $this->CliEmail=$CliEmail;
        }

        public function getCliEmail(){
            return $this->CliEmail;
        }


         // Methods
        // Procedure And Function to Manipulate Service Datas
        public function Insert(){
            return $this->InsertService();
        }
        public function Update(){
            return $this->UpdateServiceById();
        }
        public function Delete(){
            return $this->DeleteServiceId();
        }
        public function IsExistedType(){
            return $this->IfIsExistedService();
        }

        public function GetAllService(){
            return $this->FethAllService();
        }

        

    }
?>