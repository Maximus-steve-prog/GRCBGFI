<?php 

    session_start();
    require_once '../../Utility/util.php';
    require_once '../../Entities/ClientEntity.php';
    require_once '../../Entities/TypeReclamationEntity.php';
    require_once '../../Entities/ServiceEntity.php';

    $response = null;
    $message = "";
    $Autorisation ="no_auto";
    $Etat_connexion ="outline";
    $EmptyPassword ="Empty";

    $userdata = '';
    $ListTYpe='';
    $ListNotation ='';
    $ListNotationByClient ='';
    $ClientProfiles = '';
    $util = new Util();
    $ce = new ClientEntity();
    $se = new ServiceEntity();
    $tre = new TypeReclamationEntity();
     //Action to insert a new user App into the Database
    if(isset($_GET['action']) && $_GET['action']=="createClient"){
        // Setting data in the Entity  ..........   

        $ce->setClientfullname($util->ValidateString($_POST['CliFname']));
        $ce->setClientemail($util->ConfigEmail($_POST['CliEmail']));
        $ce->setClientphone($util->ValidateString($_POST['CliPhone']));
        $ce->setClientname($util->ValidateString($_POST['CliUsername']));
        $ce->setClientSexe($util->ValidateString($_POST['Sexe']));
        $ce->setClientCountry($util->ValidateString($_POST['country']));
        $ce->setClientVille($util->ValidateString($_POST['Ville']));
        $ce->setClientDatenaiss($util->ValidateString($_POST['CliDate_naiss']));
        $ce->setEtatConx($Etat_connexion);
        $ce->setClientAutorize($Autorisation);
        $ce->setClientpassword($util->ValidateString($EmptyPassword));
        $ce->setClientphoto($_FILES["imageclient"]["name"]);
         
        $original_name = $ce->getClientphoto();
        $extension = pathinfo($original_name,PATHINFO_EXTENSION);
        $valid_extensions = array("jpg","jpeg","png","gif");
        if(in_array($extension,$valid_extensions)){
            $new_name = rand().".". $extension;
            $ce->setClientphoto($new_name);
            $path = "../../../GRCBGFI/images/UploadImages/" . $new_name;
            if($util->ValidateEmail($ce->getClientemail())){
                if($ce->IsExistClient()<=0){

                    move_uploaded_file($_FILES["imageclient"]["tmp_name"],$path );                    
                    $ce->Inserting();
                    $response = 5;
                    $message = "Inserted SuccessFully
                    ";
                }else{
                    $response = 10;
                    $message = "email already existed";
                }
            }else{
                $response = 20;
                $message = "email invalid";
            } 
        }else{
            $response = 30;
            $message = "extension invalid";
        }

        echo json_encode([
            "answer"=>$response,
            "message"=>$message
            ]);
    }

    if(isset($_POST['Edit_Client_Id'])){
        $ce->setIdClient($_POST['Edit_Client_Id']);
        $data =$ce->GetClientInfoById();
        echo json_encode($data);
    }

    if(isset($_POST['Del_Client_Id'])){
        $ce->setIdClient($util->ValidateInt($_POST['Del_Client_Id']));
        $ce->DeleteClient();
    }

    if(isset($_POST['action']) && $_POST['action']=="noter"){
        if(isset($_SESSION['CliEmail'])){
            $se->setCliEmail($util->ConfigEmail($_SESSION['CliEmail']));
            if($util->ValidateEmail($se->getCliEmail())){
                $se->setnote($util->ValidateInt($_POST['Note']));
                $se->setIdService($util->ValidateInt($_POST['IdNotation']));
                $se->SendNotation();
                $response ="5";
                $message = "Noted successfully";

                echo json_encode(['answer'=>$response,
                                  'message'=>$message]);
            }

        }
    }
    
    if(isset($_POST['action']) && $_POST['action']=="getuserdata"){
        if(isset($_SESSION['CliEmail'])){
            
            $ce->setClientemail($util->ConfigEmail($_SESSION['CliEmail']));
            $data = $ce->GetClientInfoByEmail();
            $type = $tre->GetAllType();
            $NoteList = $se->NoterService();
            
            $userdata .=' <span class="profile-ava">
                        <img alt="" style="width: 40px; height: 40px;" src="../images/UploadImages/'.$data['CliPhoto'].'">
                        </span>
                        <span class="username">'.$data['CliUsername'].'</span>
                        <span class="username">Client</span>
                        <b class="caret"></b>';

            $ListTYpe .='  <option value="type">--Choisissez votre Type Reclamation--</option>';

            foreach($type as $Rows){
                $ListTYpe .='<option value="'.$Rows['TypeId'].'">'.$Rows['TypeReclam'].'</option>';
            }
            $ListNotation ='<thead>
                                <tr>
                                    <th><i class="icon_key_alt" style=" padding-right: 2px;"></i> Id</th>
                                    <th><i class="fa fa-home"></i> Service</th>
                                    <th><i class="icon_document_alt"></i> Note</th>
                                    <th><i class="fa fa-cogs"></i>Action</th>
                                </tr>
                            </thead>';
           
            foreach($NoteList as $ListByClient){
                    $ListNotation .='<tbody>
                                        <tr>
                                            <td>'.$ListByClient['IdService'].'</td>
                                            <td>'.$ListByClient['libservice'].'</td>
                                            <td>'.$ListByClient['note'].'</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-success btnNoteService" data-toggle="modal" href="#ModalNoterService" id="'.$ListByClient['Id_notation'].'"><i class="fa fa-edit"></i></a>
                                                    <a class="btn btn-danger btnResetClient" href="#" id="'.$ListByClient['Id_notation'].'"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>';
            }


            $ClientProfiles ='</div>
                <div class="panel-body bio-graph-info">
                <h1>Bio Graph</h1>
                <div class="row">
                    <div class="bio-row">
                    <p><span>First Name </span>: '.$data['CliUsername'].' </p>
                    </div>
                    <div class="bio-row">
                    <p><span>Last Name </span>: '.$data['CliFname'].'</p>
                    </div>
                    <div class="bio-row">
                    <p><span>Birthday</span>: '.$data['CliDate_naiss'].'</p>
                    </div>
                    <div class="bio-row">
                    <p><span>Country </span>: '.$data['Pays'].'</p>
                    </div>
                    <div class="bio-row">
                    <p><span>Occupation </span>: UI Designer</p>
                    </div>
                    <div class="bio-row">
                    <p><span>Email </span>:'.$data['CliEmail'].'</p>
                    </div>
                    <div class="bio-row">
                    <p><span>Mobile </span>:'.$data['CliPhone'].'</p>
                    </div>
                    <div class="bio-row">
                    <p><span>Phone </span>:'.$data['CliPhone'].'</p>
                    </div>
                </div>
                </div>';



            echo json_encode([
                'userdata'=> $userdata,
                'ClientData'=>$data,
                'ListType'=>$ListTYpe,
                'ListNotation'=>$ListNotation,
                'ClientProfiles'=>$ClientProfiles
            ]);
            
            
        }  
    }
    
    if(isset($_POST['action']) && $_POST['action']=="ListNoteClient"){

            $NoteListByClient = $se->NoteClientByService();
            $ListNotationByClient ='<thead>
                                    <tr>
                                        <th><i class="icon_key_alt" style=" padding-right: 2px;"></i> Id</th>
                                        <th><i class="fa fa-home"></i> Service</th>
                                        <th><i class="fa fa-envelope"></i>Client</th>
                                        <th><i class="icon_document_alt"></i> Note</th>
                                        <th><i class="fa fa-cogs"></i>Action</th>
                                    </tr>
                                </thead>';
            foreach($NoteListByClient as $List){
                $ListNotationByClient .='<tbody>
                                    <tr>
                                        <td>'.$List['IdService'].'</td>
                                        <td>'.$List['libservice'].'</td>
                                        <td>'.$List['CliFname'].'</td>
                                        <td>'.$List['note'].'</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-success btnNoteService" data-toggle="modal" href="#ModalClient" id="'.$List['Id_notation'].'"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger btnResetClient" href="#" id="'.$List['Id_notation'].'"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>';
            }

            echo json_encode([
                'ListNotationByClient'=>$ListNotationByClient
            ]);
    }

   


?>