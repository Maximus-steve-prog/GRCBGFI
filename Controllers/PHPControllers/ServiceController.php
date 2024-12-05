<?php 

    require_once '../../Entities/ServiceEntity.php';
    require_once '../../Utility/util.php';
    $se = new ServiceEntity();
    $util = new Util();

    $response = null;
    $message = "";

    if(isset($_POST['action']) && $_POST['action']=="SaveService"){
        
        if(!empty($_POST['libService'])){
            $se->setlibService($util->ValidateString($_POST['libService']));
            $se->InsertService();
            $response = 5;
            $message = $se->getlibService();
        }else{
            $response = 10;
            $message = "Service est vide";
        }


        echo json_encode(['answer'=>$response,
                          'message'=>$message]);
    }


    if(isset($_POST['action']) && $_POST['action']=="GetServiceList"){
        $ServiceTable = '';

        $ServiceList = $se->GetAllService();
        $ServiceTable .='<thead>
                        <tr>
                          <th>Id</th>
                          <th>Service</th>
                          <th>Action</th>
                        </tr>
                      </thead>';
        foreach($ServiceList as $List){
            $ServiceTable .= '<tbody>
                        <tr>
                          <td>'.$List['IdService'].'</td>
                          <td>'.$List['libservice'].'</td>
                          <td>
                            <div class="btn-group">
                              <a class="btn btn-success btnEditService id="'.$List['IdService'].'""><i class="fa fa-edit"></i></a>
                              <a class="btn btn-danger btnDeleteService" id="'.$List['IdService'].'"><i class="fa fa-trash"></i></a>
                            </div>
                          </td>
                        </tr>
                      </tbody>';
        }
        echo json_encode(['listservice'=>$ServiceTable]);
    }




?>