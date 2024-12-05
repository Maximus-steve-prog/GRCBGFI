<?php 
    // import Database Configuration
    require_once '../../DbConfig/Config.php';

    class ReclamationModal extends Config {

        public function SendReclamation(){
            // This is the query of inserting a Reclamation
            $query ='INSERT INTO Reclamation (Titre,Ville_reclam,Date_reclam,CliEmail,Etat,ResumeReclamation,TypeId) 
                    VALUE (:Titre,:Ville_reclam,:Date_reclam,:CliEmail,:Etat,:ResumeReclamation,:TypeId)';
            $statement = $this->Connexion->prepare($query);
            $statement->execute([
                'Titre'=> $this->Titre,
                'Ville_reclam'=> $this->VilleReclam,
                'Date_reclam'=> $this->DateReclam,
                'CliEmail'=> $this->CliEmail,
                'Etat'=> $this->Etat,
                'ResumeReclamation'=> $this->ResumeReclamation,
                'TypeId'=> $this->TypeId
            ]);
            return true;
        }


        public function CounterTOUReclamation(){
            $query='SELECT * FROM Reclamation WHERE Etat=:Etat';
            $statement =$this->Connexion->prepare($query);
            $statement->execute(['Etat'=>$this->Etat]);
            return $statement->rowCount();
        }


        public function CountTotalReclamation(){
            $query='SELECT * FROM Reclamation';
            $statement =$this->Connexion->prepare($query);
            $statement->execute();
            return $statement->rowCount();
        }

        public function GetAllReclamation(){
            $data = array();
            $query='SELECT Distinct Cli.CliEmail,reclamId,Titre,Date_Reclam,Etat,ResumeReclamation,Cli.CliFname,Cli.CliPhoto
                    FROM Client Cli ,Reclamation Re
                    WHERE Re.CliEmail=Cli.CliEmail ORDER BY reclamId Desc LIMIT 10';
            $statement = $this->Connexion->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            foreach ($result as $row){
                $data[]=$row;
            }
            return $data;
        }

        public function GetOneReclamationByReclamId(){
            $query='SELECT Distinct *
                    FROM Reclamation Re,Client Cli
                    WHERE reclamId=:reclamId 
                    AND Re.CliEmail=Cli.CliEmail';
            $statement = $this->Connexion->prepare($query);
            $statement->execute(['reclamId'=>$this->reclamId]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result ;
        }


        public function ListReclamation(){
           
        }

        public function ReadReclamation() {
              // This is the query of inserting a Reclamation
              $query ='UPDATE  Reclamation SET Etat=:Etat 
              WHERE reclamId=:reclamId';
                $statement = $this->Connexion->prepare($query);
                $statement->execute([
                    'reclamId'=> $this->reclamId,
                    'Etat'=> $this->Etat
                ]);
            return true;
        }
        public function RepondreReclamation() {
              // This is the query of inserting a Reclamation
              $query ='UPDATE  Reclamation SET ReponseReclam=:ReponseReclam, DateReponse=:DateReponse,Res=:Res 
              WHERE reclamId=:reclamId';
                $statement = $this->Connexion->prepare($query);
                $statement->execute([
                    'reclamId'=> $this->reclamId,
                    'DateReponse'=> $this->dateRes,
                    'Res'=> $this->Res,
                    'ReponseReclam'=> $this->reponse
                ]);
            return true;
        }

    }
?>