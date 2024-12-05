<?php 

    //require_once '../DbConfig/Config.php';
    require_once '../../Modals/ReclamationModal.php';

    // Reclamation Entity
    class ReclamationEntity extends ReclamationModal {

        public $reclamId;
        public $Titre;
        public $VilleReclam;
        public $DateReclam;
        public $CliEmail;
        public $Etat;
        public $ResumeReclamation;
        public $TypeId;
       

        // Setter And Getter of Reclamation Entity for Sending Reclamation
        public function setReclamId($reclamId){
            $this->reclamId = $reclamId;
        }
        public function getReclamId(){
            return $this->reclamId;
        }
        public function setTitre($Titre){
            $this->Titre = $Titre;
        }
        public function getTitre(){
            return $this->Titre;
        }
        public function setVilleReclam($VilleReclam){
            $this->VilleReclam = $VilleReclam;
        }
        public function getVilleReclam(){
            return $this->VilleReclam;
        }
        public function setDateReclam($DateReclam){
            $this->DateReclam = $DateReclam;
        }
        public function getDateReclam(){
            return $this->DateReclam;
        }
        public function setCliEmail($CliEmail){
            $this->CliEmail = $CliEmail;
        }
        public function getCliEmail(){
            return $this->CliEmail;
        }
        public function setEtat($Etat){
            $this->Etat = $Etat;
        }
        public function getEtat(){
            return $this->Etat;
        }
        public function setResumeReclamation($ResumeReclamation){
            $this->ResumeReclamation = $ResumeReclamation;
        }
        public function getResumeReclamation(){
            return $this->ResumeReclamation;
        }
        public function setTypeId($TypeId){
            $this->TypeId = $TypeId;
        }
        public function getTypeId(){
            return $this->TypeId;
        }


        public $reponse;
        public $dateRes;
        public $Res;

        public function setReponse($reponse){
            $this->reponse = $reponse;
        }
        public function getReponse(){
            return $this->reponse;
        }
        public function setDateRes($dateRes){
            $this->dateRes = $dateRes;
        }
        public function getDateRes(){
            return $this->dateRes;
        }
        public function setRes($Res){
            $this->Res = $Res;
        }
        public function getRes(){
            return $this->Res;
        }




        // Method 
        // Procedure And Function to Manipulate Reclamation
        public function Send(){
            return $this->SendReclamation();
        }
        
        public function Repondre(){
            return $this->RepondreReclamation();
        }
        public function CountTraitedOrUntraitedReclamation(){
            return $this->CounterTOUReclamation();
        }
        public function CountReclamation(){
            return $this->CountTotalReclamation();
        }
        public function DisplayAllReclamation(){
            return $this->GetAllReclamation();
        }

        public function DisplayAllReclamationByClientEmail(){
            return $this->GetAllReclamationByClientEmail();
        }

    }

?>