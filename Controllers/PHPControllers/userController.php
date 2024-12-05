<?php 

    session_start();
    require_once '../../../GRCBGFI/Utility/util.php';
    require_once '../../../GRCBGFI/Entities/userEntity.php';
    require_once '../../Entities/ClientEntity.php';

    $response = null;
    $message = "";
    $statut ="Admin";
    $EmptyPassword ="Empty";
    $util = new Util();
    $ue = new UserEntity();
    $ce = new ClientEntity();
    
    //Action to insert a new user App into the Database
    if(isset($_GET['action']) && $_GET['action']=="createuser"){
        // Setting data in the Entity  ..........   
        $ue->setUsername($util->ValidateString($_POST['username']));
        $ue->setUseremail($util->ConfigEmail($_POST['useremail']));
        $ue->setUserpassword($util->ValidateString($_POST['userpassword']));
        $ue->setUserconfpassword($util->ValidateString($_POST['userconfpassword']));
        $ue->setUserstatut($util->ValidateString($statut));
            // Check Valid email .........
        $ue->SetUserphoto($_FILES["imageuser"]["name"]);
        $original_name = $ue->getUserphoto();
        $extension = pathinfo($original_name,PATHINFO_EXTENSION);
        $valid_extensions = array("jpg","jpeg","png","gif");
        
        if(in_array($extension,$valid_extensions)){
            $new_name = rand().".". $extension;
            $ue->setUserphoto($new_name);
            $path = "../../../GRCBGFI/images/UploadImages/" . $new_name;
            if(filter_var($ue->getUseremail(),FILTER_VALIDATE_EMAIL))
            {
                if($ue->IsExistuseremail()<=0){
                    // Check valid lengh of password.......
                    switch(strlen($ue->getUserpassword())){
                        case strlen($ue->getUserpassword())>=6:
                            // Check password and confpassword match .......
                            if($ue->getUserpassword()===$ue->getUserconfpassword())
                            {
                                if($ue->IsExistsatut()<=0){
                                    $response = 25;
                                    $message = "Can be added and photo is uploaded";
                                    move_uploaded_file($_FILES["imageuser"]["tmp_name"],$path );
                                    $ue->Inserting();
                                }else if($ue->IsExistsatut()>0){
                                    // Encrypt password....
                                    move_uploaded_file($_FILES["imageuser"]["tmp_name"],$path );
                                    $response = 50;
                                    $message = "insert as user";
                                    $statut ="user";
                                    $ue->setUserstatut($util->InputText($statut));
                                    $ue->Inserting();
                                }
                            }
                            else
                            {   
                                $response = 100;
                                $message = "pass does not mutch and photo is not uploaded ";
                            }
                        break;
                        case strlen($ue->getUserpassword())<6:
                            $response = 150;
                            $message = "Pass lengh invalid";
                        break;
                        default:
                        break;
                    }
                }
                else
                {
                    $response = 200;
                    $message = "email already existed";
                }
            }else{
                $response = 300;
                $message = "email invalid";
            } 
        }else{
            $response = 250;
            $message = "extension invalid";
        }
        echo json_encode([
            "answer"=>$response,
            "message"=>$message
            ]);
    } 

    // Action to get connexion to the App  
    if(isset($_POST['action']) && $_POST['action']=="connexion"){

        $ue->setUseremailconnexion($util->ConfigEmail($_POST['emailconnexion']));
        $ce->setClientemail($util->ConfigEmail($_POST['emailconnexion']));
        $ce->setClientpassword($util->ValidateString($EmptyPassword));
        $ue->setUserpasswordconnexion($util->ValidateString($_POST['passwordconnexion']));
        $ue->setUseremail($util->ConfigEmail($_POST['emailconnexion']));
        if($util->ValidateEmail($ue->getUseremailconnexion())){
            if($ue->IsExistuseremail()>0){
                if(strlen($ue->getUserpasswordconnexion())>=6){
                    if($ue->GetConnexion()>0){
                        $row = $ue->GetSessionConnexion();
                        $_SESSION['useremail'] = $row['useremail'];
                        $response = 30;
                        $message='../../GRCBGFI/Views/dashboard.html';
                    }else{
                        $response = 25;
                        $message="please type a good password";
                    }
                }else{
                    $response = 20;
                    $message="lengh password no acceptable";
                }
            }else if($ce->IsExistClient()>0){
                if($ce->GetClientWithOutPassword()>0){
                    $response = 40;
                    $message='Veuillez configurer un password';
                }else{
                    $ce->setClientpassword($util->ValidateString($_POST['passwordconnexion']));
                    if($ce->GetClientConnexion()>0){
                        $rows = $ce->GetClientSession();
                        $_SESSION['CliEmail'] = $rows['CliEmail'];
                        $response = 30;
                        $message='../../GRCBGFI/Views/ClientDashboard.html';
                    }else{
                        $response = 25;
                        $message="Veuillew taper un bon mot de passe";
                    }
                }
            }else{
                $response = 15;
                $message="email does not exist";
            }
        }else{
            $response = 10;
            $message="invalid email";
        }
        echo json_encode([
            "answer"=>$response,
            "message"=>$message
            ]);
    }

    // Action to change a forgot password  by correct email
    if(isset($_GET['action']) && $_GET['action']=="ChangeProfile"){
        // Setting data in the Entity  ..........   
        $ue->setUsername($util->ValidateString($_POST['username']));
        $ue->setUseremail($util->ConfigEmail($_POST['useremail']));
        $ue->setUserpassword($util->ValidateString($_POST['userpassword']));
        $ue->setUserconfpassword($util->ValidateString($_POST['userconfpassword']));
            // Check Valid email .........
        $ue->SetUserphoto($_FILES["imageuser"]["name"]);
        $original_name = $ue->getUserphoto();
        $extension = pathinfo($original_name,PATHINFO_EXTENSION);
        $valid_extensions = array("jpg","jpeg","png","gif");
        
        if(in_array($extension,$valid_extensions)){
            $new_name = rand().".". $extension;
            $ue->setUserphoto($new_name);
            $path = "../../../GRCBGFI/images/UploadImages/" . $new_name;
            if($util->ValidateEmail($ue->getUseremail()))
            {
                if($ue->IsExistuseremail()>0){
                    // Check valid lengh of password.......
                    switch(strlen($ue->getUserpassword())){
                        case strlen($ue->getUserpassword())>=6:
                            // Check password and confpassword match .......
                            if($ue->getUserpassword()===$ue->getUserconfpassword())
                            {
                                $response = 25;
                                $message = "Can be added and photo is uploaded";
                                move_uploaded_file($_FILES["imageuser"]["tmp_name"],$path );
                                $ue->UpdateProfile();
                            }
                            else
                            {   
                                $response = 100;
                                $message = "pass does not mutch and photo is not uploaded ";
                            }
                        break;
                        case strlen($ue->getUserpassword())<6:
                            $response = 150;
                            $message = "Pass lengh invalid";
                        break;
                        default:
                        break;
                    }
                }
                else
                {
                    $response = 200;
                    $message = "email does not exist";
                }
            }else{
                $response = 300;
                $message = "email invalid";
            } 
        }else{
            $response = 250;
            $message = "extension invalid";
        }
        echo json_encode([
            "answer"=>$response,
            "message"=>$message
            ]);

    }
    // Action to change a forgot password  by correct email
    if(isset($_POST['action']) && $_POST['action']=="modify"){
        $ue->setUseremail($util->ConfigEmail($_POST['emailchangepass']));
        $ce->setClientemail($util->ConfigEmail($_POST['emailchangepass']));

        $ue->setUserpassword($util->ValidateString($_POST['newpass']));
        $ce->setClientpassword($util->ValidateString($_POST['newpass']));
        $ue->setUserconfpassword($util->ValidateString($_POST['newconfpass']));
        $ce->setClientconfpassword($util->ValidateString($_POST['newconfpass']));
        if($util->ValidateEmail($ue->getUseremail())){
            if($ue->IsExistuseremail()>0){
                    // Check valid lengh of password.......
                    switch(strlen($ue->getUserpassword())){
                        case strlen($ue->getUserpassword())>=6:
                            // Check password and confpassword match .......
                            if($ue->getUserpassword()===$ue->getUserconfpassword()){
                                $ue->modifypassword();
                                $response = 10;
                                $message = "password has been changed successfully";
                            }else{   
                                $response = 20;
                                $message = "pass does not mutch";
                            }
                        break;
                        case strlen($ue->getUserpassword())<6:
                            $response = 30;
                            $message = "Pass lengh invalid";
                        break;
                        default:
                        break;
                    }
            }else if($ce->IsExistClient()>0){
                $LenghPass =strlen($ce->getClientpassword());
                switch($LenghPass){
                    case $LenghPass>=6:
                        // Check password and confpassword match .......
                        if($ce->getClientpassword()===$ce->getClientconfpassword()){
                            $ce->ChangeForgotPass();
                            $response = 10;
                            $message = "password has been changed successfully";
                        }else{   
                            $response = 20;
                            $message = "pass does not mutch";
                        }
                    break;
                    case $LenghPass<6:
                        $response = 30;
                        $message = "Pass lengh invalid";
                    break;
                    default:
                    break;
                }
            }else{
                $response = 40;
                $message = "email does not exist";
            }
        }else{
            $response = 50;
            $message = "email invalid";
        } 
        echo json_encode ([
            'answer'=>$response,
            'message'=>$message]);
    }

    // Action to verify user informations if is Admin or not
    if(isset($_POST['action']) && $_POST['action']=="verify"){
        
        $ue->setUseremailconnexion($util->ConfigEmail($_POST['emailcheck']));
        $ue->setUserpasswordconnexion($util->ValidateString($_POST['passwordcheck']));
        $ue->setUseremail($util->ConfigEmail($_POST['emailcheck']));
        if($util->ValidateEmail($ue->getUseremailconnexion())){
            if($ue->IsExistuseremail()>0){
                if(strlen($ue->getUserpasswordconnexion())>=6){
                    if($ue->VerifyStatut()>0){
                        $row = $ue->GetSessionConnexion();
                        $_SESSION['useremail'] = $row['useremail'];
                        $response = 30;
                        $message='you have access';
                    }else{
                        $response = 25;
                        $message="you do not have access to";
                    }
                }else{
                    $response = 20;
                    $message="lengh password no acceptable";
                }
            }else{
                $response = 15;
                $message="email does not exist";
            }
        }else{
            $response = 10;
            $message="invalid email";
        }
        echo json_encode([
            "answer"=>$response,
            "message"=>$message
            ]);
    }
        
        
?>