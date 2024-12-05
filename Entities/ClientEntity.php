<?php 

    //Import ClientModal In Client Entity
    require_once '../../Modals/ClientModal.php';

    // Client Entity with the Extension to get Client Model
    class ClientEntity extends ClientModal {
        // Client Columns or Properties for Creating or Registration
        public $IdClient;
        public $Clientphoto;
        public $Clientfullname;
        public $Clientname;
        public $Clientemail;
        public $Clientphone;
        public $ClientDatenaiss;
        public $ClientSexe;
        public $ClientVille;
        public $ClientCountry;
        public $Clientpassword;
        public $Clientconfpassword;
        public $ClientsAutorize;
        public $Etat_Conx;

        // Setter And Getter of Client Entity for Connexion
        public function setIdClient($IdClient){
            $this->IdClient = $IdClient;
        }

        public function getIdClient(){
            return $this->IdClient;
        }
        public function setClientfullname($Clientfullname){
            $this->Clientfullname = $Clientfullname;
        }

        public function getClientfullname(){
            return $this->Clientfullname;
        }
        public function setClientname($Clientname){
            $this->Clientname = $Clientname;
        }

        public function getClientname(){
            return $this->Clientname;
        }

        public function setClientemail($Clientemail){
            $this->Clientemail = $Clientemail;
        }

        public function getClientemail(){
            return $this->Clientemail;
        }
        public function setClientphone($Clientphone){
            $this->Clientphone = $Clientphone;
        }

        public function getClientphone(){
            return $this->Clientphone;
        }

        public function setClientDatenaiss($ClientDatenaiss){
            $this->ClientDatenaiss = $ClientDatenaiss;
        }

        public function getClientDatenaiss(){
            return $this->ClientDatenaiss;
        }
        public function setClientSexe($ClientSexe){
            $this->ClientSexe = $ClientSexe;
        }

        public function getClientSexe(){
            return $this->ClientSexe;
        }
        public function setClientVille($ClientVille){
            $this->ClientVille = $ClientVille;
        }

        public function getClientVille(){
            return $this->ClientVille;
        }
        public function setClientCountry($ClientCountry){
            $this->ClientCountry = $ClientCountry;
        }

        public function getClientCountry(){
            return $this->ClientCountry;
        }
        public function setClientAutorize($ClientAutorize){
            $this->ClientAutorize = $ClientAutorize;
        }

        public function getClientAutorize(){
            return $this->ClientAutorize;
        }
        public function setClientpassword($Clientpassword){
            $this->Clientpassword = $Clientpassword;
        }

        public function getClientpassword(){
            return $this->Clientpassword;
        }
        public function setClientconfpassword($Clientconfpassword){
            $this->Clientconfpassword = $Clientconfpassword;
        }

        public function getClientconfpassword(){
            return $this->Clientconfpassword;
        }
        public function setClientphoto($Clientphoto){
            $this->Clientphoto = $Clientphoto;
        }

        public function getClientphoto(){
            return $this->Clientphoto;
        }

        public function setEtatConx($EtatConx){
            $this->EtatConx = $EtatConx;
        }
        public function getEtatConx(){
            return $this->EtatConx;
        }
        // Methods
        // Functions And Procedures Of Manipulating Client Datas

        public function Inserting(){
            return $this->InsertInfoClient();
        }

        public function UpdateClient(){
            return $this->UpdateClientByEmail();
        }

        public function DeleteClient(){
            return $this->DeleteOneClientById();
        }

        public function IsExistClient(){
            return $this->IsExistedClientEmail();
        }

        public function GetClientConnexion(){
            return $this->checkClientConnexion();
        }

        public function GetClientWithOutPassword(){
            return $this->checkClientConnexionWithOutPassword();
        }

        public function ChangeForgotPass(){
            return $this->Changepassword();
        }

        public function GetClientSession(){
            return $this->OpenClientSessionConnexion();
        }

        public function ClientList(){
            return $this->GetAllClientList();
        }

        public function GetClientInfoById(){
            return $this->GetAllClientInfo();
        }
        public function GetClientInfoByEmail(){
            return $this->GetOneClientInfoByEmail();
        }

        public function ClientTotalCount(){
            return $this->TotalRowCount();
        }

    }

?>