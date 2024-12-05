<?php
        session_start();
        require_once '../../Utility/util.php';
        require_once '../../Entities/ReclamationEntity.php';

        $response = null;
        $message = "";
        $Autorisation ="no_auto";
        $Etat_connexion ="outline";
        $EmptyPassword ="Empty";
        $util = new Util();
        $re = new ReclamationEntity();

    if(isset($_POST['action']) && $_POST['action']=="send"){

        $date = Date('d/m/y h:i:s');
        $Etat ="unread";
        $re->setTitre($util->ValidateString($_POST['Titre']));
        $re->setVilleReclam($util->ValidateString($_POST['VilleReclam']));
        $re->setDateReclam($util->ValidateString($date));
        $re->setCliEmail($util->ValidateString($_POST['CliEmail']));
        $re->setEtat($util->ValidateString($Etat));
        $re->setResumeReclamation($util->ValidateString($_POST['message']));
        $re->setTypeId($util->ValidateString($_POST['TypeReclam']));
        $re->Send();

            $response = 5;
            $message = "your reclamation has been sent successfully";
        
            echo json_encode(['answer'=>$response,
                          'message'=>$message]);
    }
    if(isset($_POST['action']) && $_POST['action']=="Response"){

        $dateRes = Date('d/m/y h:i:s');
        $Res = 1;
        $re->setReclamId($util->ValidateString($_POST['ReclamId']));
        $re->setReponse($util->ValidateString($_POST['Reponses']));
        $re->setDateRes($util->ValidateString($dateRes));
        $re->setRes($util->ValidateString($Res));
        $re->Repondre();

            $response = 5;
            $message = "Response has been succesfully sent";
        
            echo json_encode(['answer'=>$response,
                          'message'=>$message]);
    }


    if(isset($_POST['action']) && $_POST['action']=="Display"){
       
        $ListReclamationDisplay ='';

        $ListReclamation = $re->DisplayAllReclamation();


        foreach($ListReclamation as $list){
            $ListReclamationDisplay .='<tbody>
        <tr class="'. $list['Etat'].' btn-getReclamation"  id="'.$list['reclamId'].'">
            <td class="mark-mail">
            <img class="preview_img" src="../Images/UploadImages/'. $list['CliPhoto'].'" alt=""
                style="border-radius: 50%; margin-left: 0%; width:50px;height:50px;">
            </td>
            <td class="star">
            <i class="mdi mdi-star-outline"></i>
            </td>
            <td class="sender-name text-dark">
            '. $list['CliEmail'].'
            </td>
            <td class="">
            <a href="../Views/DetailsReclamation.html" class="text-default d-inline-block text-smoke" >
                <span class="badge badge-primary" >'. $list['Etat'].'</span>
                <span class="subject text-dark">
                '. $list['Titre'].'
               </span>
               '. $list['ResumeReclamation'].'
            </a>
            </td>
            <td class="attachment">
            <i class="mdi mdi-paperclip"></i>
            </td>
            <td class="date">
            '. $list['Date_Reclam'].'
            </td>
        </tr>
        </tbody>';
        }

     echo json_encode(['display'=>$ListReclamationDisplay]);
    }

    if(isset($_POST['action']) && $_POST['action']=="DisplayListClient"){
       
        $ListReclamationDisplay ='';

        $ListReclamation = $re->DisplayAllReclamation();


        foreach($ListReclamation as $list){
            $ListReclamationDisplay .='<tbody>
        <tr class="'. $list['Etat'].' btn-getReclamationClient"  id="'.$list['reclamId'].'">
            <td class="mark-mail">
            <img class="preview_img" src="../Images/UploadImages/'. $list['CliPhoto'].'" alt=""
                style="border-radius: 50%; margin-left: 0%; width:50px;height:50px;">
            </td>
            <td class="star">
            <i class="mdi mdi-star-outline"></i>
            </td>
            <td class="sender-name text-dark">
            '. $list['CliEmail'].'
            </td>
            <td class="">
            <a href="../Views/DetailsReclamation.html" class="text-default d-inline-block text-smoke" >
                <span class="badge badge-primary" >'. $list['Etat'].'</span>
                <span class="subject text-dark">
                '. $list['Titre'].'
               </span>
               '. $list['ResumeReclamation'].'
            </a>
            </td>
            <td class="attachment">
            <i class="mdi mdi-paperclip"></i>
            </td>
            <td class="date">
            '. $list['Date_Reclam'].'
            </td>
        </tr>
        </tbody>';
        }

     echo json_encode(['displayClient'=>$ListReclamationDisplay]);
    }



    if(isset($_POST['Reclam_Id'])){
        $Etat ="read";
        $re->setreclamId($_POST['Reclam_Id']);
        $re->setEtat($util->ValidateString($Etat));
        $_SESSION['GetReclamId']= $re->getreclamId();
        $re->ReadReclamation();
        echo json_encode($re->getreclamId());
    }

    if(isset($_POST['Reclam_IdClient'])){
        $Etat ="read";
        $re->setreclamId($_POST['Reclam_IdClient']);
        $re->setEtat($util->ValidateString($Etat));
        $_SESSION['GetReclamId']= $re->getreclamId();
        $re->ReadReclamation();
        echo json_encode($re->getreclamId());
    }

    if(isset($_POST['action']) && $_POST['action']=="getReclam"){
        if(isset($_SESSION['GetReclamId'])){
            $re->setreclamId($_SESSION['GetReclamId']);
            $DetailsReclamation = $re->GetOneReclamationByReclamId();
            echo json_encode(['details'=>$DetailsReclamation]);
        }
    }

?>

 