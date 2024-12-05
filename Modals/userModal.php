<?php 

    
    require_once '../../DbConfig/Config.php';

    class userModal extends Config {
        
        // Function to insert User in userTable 
        public function Insertuser(){
            // This is the query of inserting a user
            $query ='INSERT INTO user (username,useremail,userphoto,userpass,userstatut) 
                    VALUE (:username,:useremail,:userphoto,:userpass,:userstatut)';
            $statement= $this->Connexion->prepare($query);
            $statement-> execute([
                'username'=> $this->username,
                'useremail'=> $this->useremail,
                'userphoto'=> $this->userphoto,
                'userpass'=> md5($this->userpassword),
                'userstatut'=> $this->userstatut
            ]);
            return true;
        }
        // Count Admin before inserting a new user
        public function IsExistedsatut() {
            $query='SELECT * FROM user WHERE userstatut=:userstatut';
            $statement =$this->Connexion->prepare($query);
            $statement->execute([
                'userstatut'=>$this->userstatut
            ]);
            $statement-> fetch(PDO::FETCH_OBJ);
            $Count = $statement->rowCount();
            return $Count;
        }
        // Check User email if already existed
        public function IsExisteduseremail() {
            $query='SELECT * FROM user WHERE useremail=:useremail';
            $statement =$this->Connexion->prepare($query);
            $statement->execute([
                'useremail'=>$this->useremail
            ]);
            $statement-> fetch(PDO::FETCH_OBJ);
            $Count = $statement->rowCount();
            return $Count;
        }
        // Get connexion function by user email and Password
        public function checkConnexion(){
            $query='SELECT * FROM user 
                    WHERE useremail=:useremail 
                    AND userpass=:userpass';
            $statement =$this->Connexion->prepare($query);
            $statement->execute([
                'useremail'=>$this->useremailconnexion,
                'userpass'=>md5($this->userpasswordconnexion)
            ]);
            $statement-> fetch(PDO::FETCH_OBJ);
            $Count = $statement->rowCount();
            return $Count;
        }
        // Get connexion function by user email and Password
        public function VerifyAdmin(){
            $admin ='Admin';
            $query='SELECT * FROM user 
                    WHERE useremail=:useremail 
                    AND userpass=:userpass AND userstatut=:userstatut';
            $statement =$this->Connexion->prepare($query);
            $statement->execute([
                'useremail'=>$this->useremailconnexion,
                'userpass'=>md5($this->userpasswordconnexion),
                'userstatut'=>$admin
            ]);
            $statement-> fetch(PDO::FETCH_OBJ);
            $Count = $statement->rowCount();
            return $Count;
        }



        // Get Session through connexion function by user email and Password
        public function OpenSessionConnexion(){
            $query='SELECT * FROM user 
                    WHERE useremail=:useremail 
                    AND userpass=:userpass';
            $statement =$this->Connexion->prepare($query);
            $statement->execute([
                'useremail'=>$this->useremailconnexion,
                'userpass'=>md5($this->userpasswordconnexion)
            ]);
            $result = $statement-> fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        public function UpdateProfile(){
            $query ='UPDATE user 
                     SET username=:username,userphoto=:userphoto,userpass=:userpass 
                     WHERE useremail=:useremail';
            $statement= $this->Connexion->prepare($query);
            $statement-> execute([
                'username'=> $this->username,
                'useremail'=> $this->useremail,
                'userphoto'=> $this->userphoto,
                'userpass'=> md5($this->userpassword)
            ]);
            return true;
        }


        // Function to Change forgot password by email
        public function Changepassword(){
            // This is the query of updating a password
            $query ='UPDATE user SET userpass=:userpass 
                    WHERE useremail=:useremail';
            $statement= $this->Connexion->prepare($query);
            $statement-> execute([
                'userpass'=> md5($this->userpassword),
                'useremail'=> $this->useremail
            ]);
            return true;
        }

        // Function Get One User By His Email When Connecting to the App
        public function GetUserByEmail(){
            //SQL Query
            $query="SELECT * FROM user WHERE useremail=:useremail";

            $statement = $this->Connexion->prepare($query);
            $statement->execute([
                'useremail'=> $this->useremailconnexion
            ]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result ;
        }
    }
?>