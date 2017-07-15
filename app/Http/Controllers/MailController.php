<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use App\Alert;
use App\Manager;
use App\Program;
class MailController extends Controller
{
    public function send(Request $request)
  {
  		$res=$this->filter($request,[
            'alert_ids'=>'required',
        ]);
        
        $Map = array();
        $Map[0]= '每日下载量';
        $Map[1]= '每日活跃设备数';
        $Map[2]= '每日新增设备数';
        $Map[3]= '每日活跃用户数';
        $Map[4]= '每日新增用户数';
        
        $ids = explode (',',$request->alert_ids);
        foreach($ids as $alert_id){
	        $alert = Alert::where('id',$ids)->first();
	        $app = Program::where('app_key',$alert->app_key)->first();
	        $manager = Manager::where('id',$alert->manager_id)->first();
	        $email = $manager->email;
	        $flag = Mail::send('emails.test',['name'=>$manager->name, 'appname'=>$app->name,'alert'=>$alert,'item'=>$Map[$alert->item]],
	        function($message) use($email){
	            $message ->to($email)->subject('SDUSUMMER ALERT!!');
	        });
        }
        /*
        if($flag){
            echo '发送邮件成功，请查收！';
        }else{
            echo '发送邮件可能失败，请重试！';
        }
        */
        return $this->stdResponse('1');
  }

}
