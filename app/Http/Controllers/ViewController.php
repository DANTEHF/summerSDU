<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Validator;
use App\Manager;
use GeetestLib;
class ViewController extends Controller
{
	public function login(){
		return view('login');
	}
	public function showData(Request $request){

        $remember_token=$request->session()->get('remember_token');

        if(!$this->check_token($remember_token)){
            return $this->stdResponse('请您登录！');
        }
        if($this->admin_permission==3){
            return view('Data3',['name'=>$this->admin_name]);
        } elseif ($this->admin_permission==2){
            return view('Data2',['name'=>$this->admin_name]);
        }else{
            return view('Data1',['name'=>$this->admin_name]);
        }
      
    }



}

