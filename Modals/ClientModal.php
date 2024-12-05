<?php 
    // import Database Configuration for the Connection to the Server
    require_once '../../DbConfig/Config.php';

    //Create Extension to get Config Class in Client Model
    class ClientModal extends Config {

        // Function to Insert a new Client Client Table For the first Info
        public function InsertInfoClient(){
            
            // This is the query of inserting a user
            $query ='INSERT INTO Client (CliFname,CliEmail,CliUsername,CliPhone,CliPhoto,CliAutorize,EtatConx,CliDate_naiss,Sexe,Pays,ville,CliPassword) 
                    VALUE (:CliFname,:CliEmail,:Cliname,:CliPhone,:CliPhoto,:CliAutorise,:EtatConx,:Datenaiss,:ClientSexe,:ClientCountry,:ClientVille,:CliPassword)';
            $statement= $this->Connexion->prepare($query);
            $statement-> execute([
                'CliFname'=> $this->Clientfullname,
                'CliEmail'=> $this->Clientemail,
                'Cliname'=> $this->Clientname,
                'CliPhone'=> $this->Clientphone,
                'CliPhoto'=> $this->Clientphoto,
                'CliAutorise'=> $this->ClientAutorize,
                'EtatConx'=> $this->EtatConx,
                'Datenaiss'=> $this->ClientDatenaiss,
                'ClientSexe'=> $this->ClientSexe,
                'ClientCountry'=> $this->ClientCountry,
                'ClientVille'=> $this->ClientVille,
                'CliPassword'=> $this->Clientpassword
            ]);

            return true;
        }
        // Function to Update All or Some of Client Information
        public function UpdateClientByEmail(){
             // This is the query of inserting a user
            $query ='UPDATE Client SET CliDate_naiss=:Datenaiss,Sexe=:ClientSexe,
                    Pays=:ClientCountry,ville=:ClientVille,CliFname=:CliFname,
                    CliUsername=:Cliname,CliPhone=:CliPhone,CliPhoto=:CliPhoto
                    WHERE CliEmail=:CliEmail';
            $statement= $this->Connexion->prepare($query);
            $statement-> execute([
                'CliFname'=> $this->Clientfullname,
                'Cliname'=> $this->Clientname,
                'CliPhone'=> $this->Clientphone,
                'CliPhoto'=> $this->Clientphoto,
                'Datenaiss'=> $this->ClientDatenaiss,
                'ClientSexe'=> $this->ClientSexe,
                'ClientCountry'=> $this->ClientCountry,
                'ClientVille'=> $this->ClientVille,
                'CliPassword'=>md5($this->Clientpassword),
                'CliEmail'=> $this->Clientemail
            ]);
            return true;
        }
        // Boolean Function that's used to Delete a Client By Id
        public function DeleteOneClientById(){
            
            $query ='DELETE FROM Client WHERE Id_cli =:Id_cli';
            $statement = $this->Connexion->prepare($query);
            $statement->execute(['Id_cli'=>$this->IdClient]);
            return true;
        }
        // Count Client before inserting a new Client
        public function IsExistedClientEmail() {
            $query='SELECT * FROM Client WHERE CliEmail=:CliEmail';
            $statement =$this->Connexion->prepare($query);
            $statement->execute([
                'CliEmail'=>$this->Clientemail
            ]);
            $statement-> fetch(PDO::FETCH_OBJ);
            $Count = $statement->rowCount();
            return $Count;
        }
        // Get connexion function by Client email and Password
        public function checkClientConnexionWithOutPassword(){
            $query='SELECT * FROM Client 
                    WHERE CliEmail=:CliEmail 
                    AND CliPassword=:CliPassword';
            $statement =$this->Connexion->prepare($query);
            $statement->execute([
                                'CliEmail'=>$this->Clientemail,
                                'CliPassword'=>$this->Clientpassword
                                ]);
            $statement-> fetch(PDO::FETCH_OBJ);
            $Count = $statement->rowCount();
            return $Count;
        }
        // Function used to check Connection when a Client is Connected
        public function checkClientConnexion(){

            $query='SELECT * FROM Client 
                    WHERE CliEmail=:CliEmail 
                    AND CliPassword=:CliPassword';
            $statement =$this->Connexion->prepare($query);
            $statement->execute([
                'CliEmail'=>$this->Clientemail,
                'CliPassword'=>md5($this->Clientpassword)
            ]);
            $statement-> fetch(PDO::FETCH_OBJ);
            $Count = $statement->rowCount();
            return $Count;
        }
        // Get Session through connexion function by Client email and Password
        public function OpenClientSessionConnexion(){
            $query='SELECT * FROM Client 
                    WHERE CliEmail=:CliEmail 
                    AND CliPassword=:CliPassword';
            $statement =$this->Connexion->prepare($query);
            $statement->execute([
                'CliEmail'=>$this->Clientemail,
                'CliPassword'=>md5($this->Clientpassword)
            ]);
            $result = $statement-> fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        // Function to Change forgot password by email
        public function Changepassword(){
            // This is the query of updating a password
            $query ='UPDATE Client SET CliPassword=:CliPassword 
                    WHERE CliEmail=:CliEmail';
            $statement= $this->Connexion->prepare($query);
            $statement-> execute([
                'CliPassword'=> md5($this->Clientpassword),
                'CliEmail'=> $this->Clientemail
            ]);
            return true;
        }
        // Function to Get Client All List Form Client Table
        public function GetAllClientList(){
            $data = array();
            $query='SELECT * FROM Client';
            $statement =$this->Connexion->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            foreach ($result as $row){
                $data[]=$row;
            }
            return $data;
        }
        // Function to Count All Client Form Client Table
        public function TotalRowCount(){
            $query='SELECT * FROM Client';
            $statement =$this->Connexion->prepare($query);
            $statement->execute();
            $Count = $statement->rowCount();
            return $Count;
        }
        // Function Get One User By His Email When Connecting to the App
        public function GetAllClientInfo(){
            //SQL Query
            $query="SELECT * FROM client WHERE Id_cli=:Id_cli";

            $statement = $this->Connexion->prepare($query);
            $statement->execute([
                'Id_cli'=> $this->IdClient
            ]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result ;
        }
        // Get Client Information Through is own Email Adress
        public function GetOneClientInfoByEmail(){
            //SQL Query
            $query="SELECT * FROM client WHERE CliEmail=:CliEmail";

            $statement = $this->Connexion->prepare($query);
            $statement->execute([
                'CliEmail'=> $this->Clientemail
            ]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result ;
        }
    }
?>