<?php 
    session_start();
    require_once ('../../Utility/util.php');
    require_once ('../../Entities/userEntity.php');
    require_once ('../../Entities/ClientEntity.php');
    require_once ('../../Entities/ReclamationEntity.php');
    $util = new Util();
    $ue = new UserEntity();
    $ce = new ClientEntity(); 
    $re = new ReclamationEntity();

    if(isset($_POST['action']) && $_POST['action']=="getuserdata"){
        if(isset($_SESSION['useremail'])){
            $userdata = '';
           
            $ue->setUseremailconnexion($util->ConfigEmail($_SESSION['useremail']));
            $data = $ue->GetOneUserByEmail();
            
            $userdata .=' <span class="profile-ava">
                        <img alt="" style="width: 40px; height: 40px;" src="../images/UploadImages/'.$data['userphoto'].'">
                        </span>
                        <span class="username">'.$data['username'].'</span>
                        <span class="username">'.$data['userstatut'].'</span>
                        <b class="caret"></b>';


              $UserProfiles ='</div>
                <div class="panel-body bio-graph-info">
                <h1>Bio Graph</h1>
                <div class="row">
                    <div class="bio-row">
                    <p><span>First Name </span>: '.$data['username'].' </p>
                    </div>
                    <div class="bio-row">
                    <p><span>Statut </span>: '.$data['userstatut'].' </p>
                    </div>
                    <div class="bio-row">
                    <p><span>Email </span>: '.$data['useremail'].' </p>
                    </div>
                    <div class="bio-row">
                    <p><span>Mot de passe Crypte </span>: '.$data['userpass'].' </p>
                    </div>
                   
                </div>
                </div>';

                        echo json_encode([
                          'userdata'=> $userdata,
                          'UserProfiles'=>$UserProfiles,
                          'data'=>$data
                        ]);
            
        }
    }


    if(isset($_POST['action']) && $_POST['action']=="GetAllCards"){
        $Cards = '';
        $ClientTable='';
        $Etat ="unread";
        $re->setEtat($Etat);
        $TotalUntraitedReclamation=$re->CountTraitedOrUntraitedReclamation();
        $Etat ="read";
        $re->setEtat($Etat);
        $TotalTraitedReclamation=$re->CountTraitedOrUntraitedReclamation();

        $TotalReclamation = $re->CountReclamation();

        $TotalClient = $ce->ClientTotalCount();
        $rows = $ce->ClientList();
        $Cards ='<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="info-box">
          <i class="fa fa-users card1"></i>
          <div class="count">'.$TotalClient.'</div>
          <div class="title">Nombre Total Client</div>
        </div>
        <!--/.info-box-->
      </div>
      <!--/.col-->

      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="info-box">
          <i class="fa fa-envelope card2"></i>
          <div class="count">'.$TotalUntraitedReclamation.'</div>
          <div class="title">Réclamations Non Lues </div>
        </div>
        <!--/.info-box-->
      </div>
      <!--/.col-->

      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="info-box">
          <i class="fa fa-envelope-open card3"></i>
          <div class="count">'.$TotalTraitedReclamation.'</div>
          <div class="title">Réclamations Lues</div>
        </div>
        <!--/.info-box-->
      </div>
      <!--/.col-->

      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="info-box">
          <i class="fa fa-cloud-download card4"></i>
          <div class="count">'.$TotalReclamation.'</div>
          <div class="title">Total Reclamation</div>
        </div>
        <!--/.info-box-->
      </div>
      <!--/.col-->';

      $ClientTable .='<thead>
      <tr>
        <th><i class="icon_profile" style=" padding-right: 2px;"></i> photo</th>
        <th><i class="icon_user"></i> full name</th>
        <th><i class="icon_mail_alt"></i> Email</th>
        <th><i class="icon_pin_alt"></i> City</th>
        <th><i class="icon_mobile"></i> Mobile</th>
        <th><i class="icon_gender"></i> sexe</th>
        <th><i class="icon_cogs"></i> Action</th>
      </tr>
        </thead>';
            if($TotalClient>0){
                foreach($rows as $datas){
                    $ClientTable .='<tbody>
                    <tr>
                    <td style="padding-top: 10px; padding-left: 40px;">
                      <img src="../images/UploadImages/'.$datas['CliPhoto'].'"
                      style="width: 40px; border-radius: 50%; height: 40px;">
                    </td>
                    <td>'.$datas['CliFname'].'</td>
                    <td>'.$datas['CliEmail'].'</td>
                    <td>'.$datas['Ville'].'</td>
                    <td>'.$datas['CliPhone'].'</td>
                    <td>'.$datas['Sexe'].'</td>
                    <td>
                        <div class="btn-group">
                          <a class="btn btn-primary btnInfoClient" data-toggle="modal" href="" id="'.$datas['Id_cli'].'"><i class="fa fa-info-circle"></i></a>
                          <a class="btn btn-success btnEditClient" data-toggle="modal" href="#ModalClient" id="'.$datas['Id_cli'].'"><i class="fa fa-edit"></i></a>
                          <a class="btn btn-danger btnDelClient" href="#" id="'.$datas['Id_cli'].'"><i class="fa fa-trash"></i></a>
                        </div>
                    </td>
                    </tr>
                </tbody>';
                }
            }


        echo json_encode(['Cards'=>$Cards,
                          'ClientTable'=>$ClientTable,
                          'TotalUntraitedReclamation'=>$TotalUntraitedReclamation,
                          'TotalReclamation'=>$TotalReclamation,
                          'TotalTraitedReclamation'=>$TotalTraitedReclamation]);
    }
?>