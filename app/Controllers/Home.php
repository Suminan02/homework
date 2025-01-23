<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function index2()
    {
       echo "hello ci";
    }

    public function my_view()
    {  $arr=array("x0"=>"y","x2"=>"nemo","x3"=>"dolly");
       $data ['send_data_to_view']='My data from controller home';
       $data ['send_data_to_view_arr']=$arr;
       return view('my_view',$data);
    }
}
