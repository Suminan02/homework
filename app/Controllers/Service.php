<?php
namespace App\Controllers;
use App\Http\Controller\Controllers;
use App\Models\Mydev_model;

class Service extends BaseController{

    public function __construct()
    {
        $this->config=new \Config\App();
        $this->Mydev_model =new Mydev_model();
        $request=\Config\Services::request();
        
    }

    public function index()
    {   

        $username="";
        $cid="";
        $email="";
        

        if(isset($_GET['username'])&&$_GET['username'] !=''){
            $username=$_GET['username'];
          }
        
          if($username==""){
            $response = array('ret_code'=>'001','msg'=>"empty input username");
            echo json_encode($response);
            exit;
          }
        
            $pattern_username = "/^[a-zA-Z0-9_]{6,16}$/";
            if (preg_match($pattern_username, $username)==FALSE) {
                $response = array('ret'=>'201','msg'=>'Invalid pattern username');
                echo json_encode($response);
                exit;
            }
            if(isset($_GET['email'])&&$_GET['email'] !=''){
            $email=$_GET['email'];
             }
          
          if($email==""){
            $response = array('ret_code'=>'006','msg'=>"empty email");
            echo json_encode($response);
            exit;
          }

          $pattern_email = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
            if (preg_match($pattern_email , $email)==FALSE) {
                $response = array('ret'=>'206','msg'=>'Invalid pattern email');
                echo json_encode($response);

                exit;
            }
            
          if(isset($_GET['citizen_id'])&&$_GET['citizen_id'] !=''){
            $cid=$_GET['citizen_id'];
          }
          if($cid==""){
            $response = array('ret_code'=>'007','msg'=>"empty citizen id");
            echo json_encode($response);
            exit;
          }
          if( strlen($cid)!=13){
            $response = array('ret_code'=>'007','msg'=>"Invalid pattern citizen ID");
            echo json_encode($response);
            exit;
          }
          $pattern_cid= "/^[0-9]+.{12,}$/";
            if (preg_match($pattern_cid , $cid)==FALSE) {
                $response = array('ret'=>'207','msg'=>'Invalid pattern citizen ID');
                echo json_encode($response);
                exit;
            }

        $sql_username_chk = "SELECT username,email,citizen_id FROM user_info 
        WHERE username='{$username}'
        OR email='{$email}' 
        OR citizen_id='{$cid}'LIMIT 3;";
        $array_result=$this->Mydev_model->select($sql_username_chk );
        if(count($array_result)>0){

        for($i=0;$i<count($array_result);$i++){
            $responseuser='';
            if(strpos($array_result[$i]->username,$username ) === 0){
                $responseuser = 'user';
            }
            $responsecid='';
            if(strpos($array_result[$i]->citizen_id,$cid ) === 0){
                $responsecid = 'cid';
               
            }
            $responseemail='';
            if(strpos($array_result[$i]->email,$email ) === 0){
                $responseemail = 'email';

            }
            
            $response = array('ret_code'=>'5000',
            'msg'=>"unsuccess information same with other user",
            'duplicate'=>"'$responseuser'"."'$responsecid'"."'$responseemail'");
            echo json_encode($response);

        }
        exit;
    }

        $sql="INSERT INTO user_info (username, citizen_id, email) 	
        VALUES ('{$username}', '{$cid}', '{$email}');";

        $execute=$this->Mydev_model->execute($sql);
        if($execute){
            $response = array('ret_code'=>'101','msg'=>"success","data"=>"");
            echo json_encode($response);
          }
          
}
}
?>