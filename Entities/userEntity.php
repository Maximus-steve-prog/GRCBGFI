<?php 

    //require_once '../DbConfig/Config.php';
    require_once '../../Modals/userModal.php';

    // User Entity
    class UserEntity extends userModal {

        // User Columns or Properties for Registration
        public $userphoto;
        public $username;
        public $useremail;
        public $userpassword;
        public $userconfpassword;
        public $userstatut;

        // User Columns or Properties for Connexion
        public $useremailconnexion;
        public $userpasswordconnexion;

        // Setter And Getter of User Entity for Connexion
        public function setUseremailconnexion($useremailconnexion){
            $this->useremailconnexion = $useremailconnexion;
        }

        public function getUseremailconnexion(){
            return $this->useremailconnexion;
        }
        
        public function setUserpasswordconnexion($userpasswordconnexion){
            $this->userpasswordconnexion = $userpasswordconnexion;
        }

        public function getUserpasswordconnexion(){
            return $this->userpasswordconnexion;
        }

        // These function concern Connexion or Loging in
        public function GetConnexion(){
            return $this->checkConnexion();
        }

        public function GetSessionConnexion(){
            return $this->OpenSessionConnexion();
        }

        public function  GetOneUserByEmail(){
            return $this->GetUserByEmail();
        }
        // End of Connexion or Login

        // Setter And Getter of User Entity for Registration
        public function setUserphoto($userphoto){
            $this->userphoto = $userphoto;
        }

        public function getUserphoto(){
            return $this->userphoto;
        }
        public function setUserstatut($userstatut){
            $this->userstatut = $userstatut;
        }

        public function getUserstatut(){
            return $this->userstatut;
        }

        public function setUsername($username){
            $this->username = $username;
        }

        public function getUsername(){
            return $this->username;
        }

        public function setUseremail($useremail){
            $this->useremail = $useremail;
        }

        public function getUseremail(){
            return strtolower($this->useremail);
        }

        public function setUserpassword($userpassword){
            $this->userpassword = $userpassword;
        }

        public function getUserpassword(){
            return $this->userpassword;
        }

        public function setUserconfpassword($userconfpassword){
            $this->userconfpassword = $userconfpassword;
        }

        public function getUserconfpassword(){
            return $this->userconfpassword;
        }

        // This functions concern Signing up
        public function Inserting(){
            return $this->Insertuser();
        }
        // Function to count Statut Before Inserting 
        // a new User as Admin or Simple user
        public function IsExistsatut(){
            return $this->IsExistedsatut();
        }
        // Function to check if Email is already existed
        public function IsExistuseremail(){
            return $this->IsExisteduseremail();
        }
        // Function to change Password forgot
        public function modifypassword(){
            return $this->Changepassword();
        }

        // Function to verify if is Admin or not 
        public function VerifyStatut(){
            return $this->VerifyAdmin();
        }
        // End of sign up code
    }
    
?>