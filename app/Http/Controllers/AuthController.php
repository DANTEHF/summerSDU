<?php

namespace App\Http\Controllers;
use App\Manager;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DB;
use Germey\Geetest\GeetestCaptcha;
use Germey\Geetest\GeetestLib;
use Germey\Geetest\Geetest;
use MongoDB\Driver\ReadConcern;
use Validator;
class AuthController extends Controller{
	use GeetestCaptcha;
    /*---------------------用户登录及注销-----------------------*/
    /*
      1.  登录
	   Url：/login  Method: POST
	      请求参数 ：
		email  email  ,
		password  string
	      返回参数 ：remember_token , name,  grade （grade相当于permission  ）
     */
    public function fail_validate($challenge, $validate, $seccode) {
	    if(md5($challenge) == $validate){
	        return 1;
	    }else{
	        return 0;
	    }
	}
    public function login(Request $request){
        
    	$res=$this->filter($request,[
            'email'=>'required|filled|email',
            'password'=>'required|filled',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        $res=$this->filter($request,[
            'geetest_challenge'=>'required|filled',
            'geetest_validate'=>'required|filled',
            'geetest_seccode'=>'required|filled',
        ]);
        if(!$res){
            return $this->stdResponse('-12');
        }
        //$geetest = new Geetest();
        //$geetest->set_privatekey("c3b9f8620c664199660e8f93592a1644");
        //if(!$geetest->validate($request->geetest_challenge,$request->geetest_validate,$request->geetest_seccode))
        //	return $this->stdResponse('-12',json_encode($request->all()));;
        
        $res=  Validator::make($request->all(),[
            'email'=>'required|filled|email',
            'password'=>'required|filled',
        ]);
		try{
            $admin=Manager::where('password',md5($request->input('password').'#'.$request->input('email')))
                ->where('email',$request->input('email'))->first();

            if(!count($admin)>0)  return $this->stdResponse('-2',json_encode($request->all()));

            if($admin->token_expire < date('Y-m-d H:i:s'))
            {
                $admin->remember_token = Crypt::encrypt($admin->name."&".time());
                $admin->token_expire = date('Y-m-d H:i:s',strtotime("+24 hour"));
                $admin->save();
            }
            $resdata=array('remember_token'=>$admin->remember_token,'name'=>$admin->name,'grade'=>$admin->permission);

            $request->session()->put('remember_token',$admin->remember_token);


            return redirect('manager');


        }catch (\Exception $exception){
            return $this->stdResponse('-4 ' , $exception->getMessage());
        }catch(\Error $error){
            return $this->stdResponse('-10');
        }
    }
    /*
     * 2. 注销登录
		URl：/logout      	METHOD:DELETE
		请求参数 ：
		remember_token
		返回参数 ：null
     */
    public function logout(Request $request){
        if(!$this->check_token($request->input('remember_token'))){
            return $this->stdResponse('-3');
        }
        $manager = Manager::where('id',$this->admin_id)->first();
        DB::beginTransaction();
        try{
            $manager->token_expire = '1970-01-01';
            $manager->save();
            DB::commit();


            return $this->stdResponse('1');
        }catch (\Exception $exception){
            DB::rollback();
            return $this->stdResponse('-4');
        }catch (\Error $error){
            DB::rollback();
            return $this->stdResponse('-4');
        }

    }
    //TODO


    /*---------------------用户登录及注销结束-----------------------*/
}