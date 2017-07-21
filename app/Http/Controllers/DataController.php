<?php

namespace App\Http\Controllers;
use App\Manager;
use App\Company;
use App\Program;
use App\Active_user;
use App\Active_device;
use App\M_app_permission;
use App\AppCriticalData;
use App\Area;
use Illuminate\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DB;
use Storage;
use function Sodium\add;

class DataController extends Controller{
	 /*
 	 * 数据展示部分
 	 */
    public $token="";

    public function __construct(Request $request)
    {
        $this->token=$request->session()->get('remember_token');
    }
 	 
 	 /* --------------------关键数据(用户概况)--------------------- */
 	 
 	 
 	 /* 
        1.新增玩家和设备 
        Url:/newuserdev Method:GET
        请求参数：
        Remember_token 	
        Starttime		查询起始日期
        Endtime 		查询结束日期
        App_id 		查询的app_id	
        (注意check三级管理员是否有查询该模块信息的权限)
        返回参数：（类似于）
        ‘new_user’ :{‘2017-06-28’: 24 , ’2017-06-29’:34, ‘2017-06-30’: 45, ‘2017-07-01’ : 23},
        ‘new_device’: {‘2017-06-28’: 26 , ’2017-06-29’:21, ‘2017-06-30’: 34, ‘2017-07-01’ : 56}
 	 */
 	 public function get_new_user_dev(Request $request){
        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        $res=$this->filter($request,[
            'starttime'=>'required|date_format:Y-m-d',
            'endtime'=>'required|date_format:Y-m-d',
            'app_id'=>'required|integer',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        if(strtotime($request->starttime)>strtotime($request->endtime)){
            return $this->stdResponse('-1');
        }
        try{
        	$app_key = Program::where('id',$request->app_id)->first()->app_key;
        	if($this->admin_permission == 3){
        		$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app_key)->first()->permission;
				if( !(($permission>>0) & 1)) return $this->stdResponse('-6');
        	}
        	
		
       	 	$new_user = DB::select('select datetime,new_user from app_critical_data where app_key= ? and datetime <= ? and datetime >= ? order by datetime'
                ,[$app_key,$request->endtime,$request->starttime]);
            if(count($new_user)==0)
				return $this->stdResponse('-5');
        	$new_device = DB::select('select datetime,new_device from app_critical_data where app_key= ? and datetime <= ? and datetime >= ? order by datetime'
        		,[$app_key,$request->endtime,$request->starttime]);
            if(count($new_device)==0)
				return $this->stdResponse('-5');                                     
        	$resdata = array('new_user'=>$new_user,'new_device'=>$new_device);
        	return $this->stdResponse('1',json_encode($resdata));
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
        
        
 	 }
 	 
 	 /*
 	    2.活跃玩家和设备
 	    Url:/activeuserdev  Method:GET
        请求参数：
        Remember_token 
        Starttime  	查询起始日期
        Endtime		查询结束日期
        App_id   	查询的app_id	
        (注意check三级管理员是否有查询该模块信息的权限)
        返回参数：
        {
        ‘active_user’ :{‘2017-06-28’: 24 , ’2017-06-29’:34, ‘2017-06-30’: 45, ‘2017-07-01’ : 23},
          ‘active_device’: {‘2017-06-28’: 26 , ’2017-06-29’:21, ‘2017-06-30’: 34, ‘2017-07-01’ : 56}
        }
 	    */
 	 public function get_Active_User_Device(Request $request){
 	    if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        $res=$this->filter($request,[
            'starttime'=>'required|date_format:Y-m-d',
            'endtime'=>'required|date_format:Y-m-d',
            'app_id'=>'required|integer',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
         if(strtotime($request->starttime)>strtotime($request->endtime)){
             return $this->stdResponse('-1');
        }
        try{
        	$app_key = Program::where('id',$request->app_id)->first()->app_key;
        	if($this->admin_permission == 3){
	        	$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app_key)->first()->permission;
				if( !(($permission>>0) & 1)) return $this->stdResponse('-6');
        	}
		
        	$active_user = DB::select('select datetime,active_user from app_critical_data where app_key= ? and datetime <= ? and datetime >= ? order by datetime' 
                                                    ,[$app_key,$request->endtime,$request->starttime]);
            if(count($active_user)==0)
				return $this->stdResponse('-5');
        	$active_device = DB::select('select datetime,active_device from app_critical_data where app_key= ? and datetime <= ? and datetime >= ? order by datetime'
                                                    ,[$app_key,$request->endtime,$request->starttime]);
            if(count($active_device)==0)
				return $this->stdResponse('-5');
        	$resdata = array('active_user'=>$active_user,'active_device'=>$active_device);
        	return $this->stdResponse('1',json_encode($resdata));
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
        
        
        
 	 }
 	 
 	 /* 
 	    3.付费金额 
     	Url:/paymoney  method:GET
        请求参数：
        Remember_token 
        Starttime  	查询起始日期
        Endtime		查询结束日期
        App_id   	查询的app_id	
        (注意check三级管理员是否有查询该模块信息的权限)
        返回参数：
          {
        ‘Money’: {‘2017-06-28’: 26 , ’2017-06-29’:21, ‘2017-06-30’: 34, ‘2017-07-01’ : 56}
        }
 	 */
 	 public function get_pay_count(Request $request){
 	    if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        $res=$this->filter($request,[
            'starttime'=>'required|date_format:Y-m-d',
            'endtime'=>'required|date_format:Y-m-d',
            'app_id'=>'required|integer',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
         if(strtotime($request->starttime)>strtotime($request->endtime)){
             return $this->stdResponse('-1');
         }
        try{
        	$app_key = Program::where('id',$request->app_id)->first()->app_key;
        	if($this->admin_permission == 3){
        		$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app_key)->first()->permission;
				if( !(($permission>>0) & 1)) return $this->stdResponse('-6');
        	}
        	
			$pay_money = DB::select('select datetime,pay_money from app_critical_data where app_key= ? and datetime <= ? and datetime >= ? order by datetime'
                                                    ,[$app_key,$request->endtime,$request->starttime]);
            if(count($pay_money)==0)
				return $this->stdResponse('-5');
        	$resdata = array('pay_money'=>$pay_money);
        	return $this->stdResponse('1',json_encode($resdata));		
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
      
		
 	 }
 	 
 	 /*
 	    4.付费用户
 	    Url:/payuser   Method:GET
        请求参数:
        Remember_token 
        Starttime  	查询起始日期
        Endtime		查询结束日期
        App_id   	查询的app_id	
        (注意check三级管理员是否有查询该模块信息的权限)
        返回参数：
          {
        ‘user’: {‘2017-06-28’: 26 , ’2017-06-29’:21, ‘2017-06-30’: 34, ‘2017-07-01’ : 56}
        }
 	 */
 	 public function get_pay_user(Request $request){
 	    if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        $res=$this->filter($request,[
            'starttime'=>'required|date_format:Y-m-d',
            'endtime'=>'required|date_format:Y-m-d',
            'app_id'=>'required|integer',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
         if(strtotime($request->starttime)>strtotime($request->endtime)){
             return $this->stdResponse('-1');
        }
        try{
        	$app_key = Program::where('id',$request->app_id)->first()->app_key;
        	if($this->admin_permission == 3){
        		$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app_key)->first()->permission;
				if(!(($permission>>0) & 1)) return $this->stdResponse('-6');
        	}
			$pay_user_count = DB::select('select datetime,pay_user_count from app_critical_data where app_key= ? and datetime <= ? and datetime >= ? order by datetime'
                                                    ,[$app_key,$request->endtime,$request->starttime]);
            if(count($pay_user_count)==0)
				return $this->stdResponse('-5');
  	   		$resdata = array('pay_user_count'=>$pay_user_count);
        	return $this->stdResponse('1',json_encode($resdata));
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
        
 }
        
    
 	 /* ------------------关键数据(用户概况)结束------------------- */
 	 
 	 
 	/*----------------------------新增用户( 设备 )--------------------------*/
    
    /*1.新增设备
	    Url:/newdev Method:GET
        请求参数：
            Remember_token 	
            Starttime		查询起始日期
            Endtime 		查询结束日期
            App_id 		查询的app_id	
        (注意check三级管理员是否有查询该模块信息的权限)
        返回参数：（类似于）
            ‘new_device’: { ‘2017-06-28’:26 , ’2017-06-29’:21, ‘2017-06-30’: 34, ‘2017-07-01’ : 56 }*/
    public function get_new_dev(Request $request){
        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        $res=$this->filter($request,[
            'starttime'=>'required|date_format:Y-m-d',
            'endtime'=>'required|date_format:Y-m-d',
            'app_id'=>'required|integer',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        if(strtotime($request->starttime)>strtotime($request->endtime)){
            return $this->stdResponse('-1');
        }
        try{
        	$app_key = Program::where('id',$request->app_id)->first()->app_key;
        	if($this->admin_permission == 3){
        		$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app_key)->first()->permission;
				if( !(($permission>>1) & 1)) return $this->stdResponse('-6');		
        	}
        	
        	$new_device = DB::select('select datetime,new_device from app_critical_data where app_key= ? and datetime <= ? and datetime >= ? order by datetime',[$app_key,$request->endtime,$request->starttime]);
        	if(count($new_device)==0)
				return $this->stdResponse('-5');
        	$resdata = array('new_device'=>$new_device);
        	return $this->stdResponse('1',json_encode($resdata));
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
        
 	 }    
 	 
 	 /*2.首次游戏时长
        Url:/devfirsttime  Method:GET
        请求参数 ：
        Remember_token
        App_id
        返回参数：
        {
        ‘1_4s’:x , ‘5_10s’:x ,’11_30s’ :x,
        ‘31_60s’:x,  ’1_3m’:x,  ’3_10m’:x,  ’10_30m’:x,  ’30_60m’:x,   	‘60_m’:x
        }
    */
    public function get_dev_first_time(Request $request){
        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        $res=$this->filter($request,[
            'app_id'=>'required|integer',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        if(strtotime($request->starttime)>strtotime($request->endtime)){
            return $this->stdResponse('-1');
        }
        try{
        	$app_key = Program::where('id',$request->app_id)->first()->app_key;
        	if($this->admin_permission == 3){
        		$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app_key)->first()->permission;
				if( !(($permission>>1) & 1)) return $this->stdResponse('-6');		
        	}
        	$today = date("Y-m-d",strtotime("-1 day"));
        	$dev_first_time = DB::select('select 1_4s,5_10s,11_30s,31_60s,1_3m,4_10m,11_30m,31_60m,60_m from new_device where app_key= ? and datetime = ? ',[$app_key,$today]);
        	if(count($dev_first_time)==0)
				return $this->stdResponse('-5');
        	$resdata = array('dev_first_time'=>$dev_first_time);
        	return $this->stdResponse('1',json_encode($resdata));
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
        
        
 	 }
 	 
    /*
     	3.设备地区分布
     	url:devarea  Method:GET
     	请求参数：
     	Remember_token
     	app_id
     * */
    public function getDevArea(Request $request){
    	if(!$this->check_token($this->token)){
             return $this->stdResponse('-3');
        }
        $res=$this->filter($request,[
            'app_id'=>'required|integer',
        ]);
        try{
        	$app_key = Program::where('id',$request->app_id)->first()->app_key;
        	if($this->admin_permission == 3){
        		$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app_key)->first()->permission;
				if( !(($permission>>1) & 1)) return $this->stdResponse('-6');		
        	}
        	$today = date("Y-m-d",strtotime("-1 day"));//其实是昨天
        	$areas = Area::where('app_key',$app_key)->where('date',$today)->select('area as name','new_dev_count as value')->get();
    		if($areas->isEmpty())
				return $this->stdResponse('-5');
    		$area_map=["北京","上海","天津","重庆","哈尔滨","长春","沈阳","呼和浩特","石家庄","乌鲁木齐","兰州","西宁",
                      "西安","银川","郑州","济南","太原","合肥","武汉","长沙","南京","成都","贵阳","昆明","南宁","拉萨",
                      "杭州","南昌","广州","福州","台北","海口","香港","澳门"];
        	//$area_map = array_iconv('gb2312','utf-8',$area_map);
        	foreach($areas as $area){
        		$area->name = $area_map[intval($area->name)-1];
        		$area->value = $area->value*1000;
        	}
        	//$resdata = array('areas'=>$areas);
        	return $this->stdResponse('1',$areas);
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
        
    }
 	 
 	/*----------------------------新增用户( 用户 )--------------------------*/
 	/*1.新增玩家
	Url:/newuser  Method:GET
    请求参数：
        Remember_token 	
        Starttime		查询起始日期
        Endtime 		查询结束日期
        App_id 	    	查询的app_id	
    (注意check三级管理员是否有查询该模块信息的权限)
    返回参数：（类似于）
    ‘new_user’: { ‘2017-06-28’:26 , ’2017-06-29’:21, ‘2017-06-30’: 34, ‘2017-07-01’ : 	56 }*/
    public function get_new_user(Request $request){
        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        $res=$this->filter($request,[
            'starttime'=>'required|date_format:Y-m-d',
            'endtime'=>'required|date_format:Y-m-d',
            'app_id'=>'required|integer',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        if(strtotime($request->starttime)>strtotime($request->endtime)){
            return $this->stdResponse('-1');
        }
        try{
        	$app_key = Program::where('id',$request->app_id)->first()->app_key;
        	if($this->admin_permission == 3){
        		$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app_key)->first()->permission;
				if( !(($permission>>1) & 1)) return $this->stdResponse('-6');		
        	}
		
        	$new_user = DB::select('select datetime,new_user from app_critical_data where app_key= ? and datetime <= ? and datetime >= ? order by datetime',[$app_key,$request->endtime,$request->starttime]);
        	if(count($new_user)==0)
				return $this->stdResponse('-5');
        	$resdata = array('new_user'=>$new_user);
        	return $this->stdResponse('1',json_encode($resdata));
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
        
        
 	 } 
 	 
 	 /*2首次游戏时长
 	  	Url:/userfirsttime  Method:GET
        请求参数 ：
            Remember_token 
            App_id
        返回参数：
            {‘1_4s’:x , ‘5_10s’:x ,’11_30s’ :x, 
            ‘31_60s’:x,  ’1_3m’:x,  ’3_10m’:x,  ’10_30m’:x,  ’30_60m’:x,	‘60_m’:x}   */
    public function get_user_first_time(Request $request){
        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        $res=$this->filter($request,[
            
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        if(strtotime($request->starttime)>strtotime($request->endtime)){
            return $this->stdResponse('-1');
        }
        try{
        	$app_key = Program::where('id',$request->app_id)->first()->app_key;
        	if($this->admin_permission == 3){
        		$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app_key)->first()->permission;
				if( !(($permission>>1) & 1)) return $this->stdResponse('-6');		
        	}
        	$today = date("Y-m-d",strtotime("-1 day"));
		
        	$user_first_time = DB::select('select 1_4s,5_10s,11_30s,31_60s,1_3m,4_10m,11_30m,31_60m,60_m from new_user where app_key= ? and datetime = ?',[$app_key,$today]);
        	if(count($user_first_time)==0)
				return $this->stdResponse('-5');
        	$resdata = array('user_first_time'=>$user_first_time);
        	return $this->stdResponse('1',json_encode($resdata));
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
        
 	 }
 	 /*
     	3.用户地区分布
     	url:userarea  Method:GET
     	请求参数：
     	Remember_token
     	app_id
     * */
    public function getUserArea(Request $request){
    	if(!$this->check_token($this->token)){
             return $this->stdResponse('-3');
        }
        $res=$this->filter($request,[
            'app_id'=>'required|integer',
        ]);
        try{
        	$app_key = Program::where('id',$request->app_id)->first()->app_key;
        	if($this->admin_permission == 3){
        		$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app_key)->first()->permission;
				if( !(($permission>>1) & 1)) return $this->stdResponse('-6');		
        	}
        	$today = date("Y-m-d",strtotime("-1 day"));//其实是昨天
        	$areas = Area::where('app_key',$app_key)->where('date',$today)->select('area as name','new_user_count as value')->get();
    		if($areas->isEmpty())
				return $this->stdResponse('-5');
    		$area_map=["北京","上海","天津","重庆","哈尔滨","长春","沈阳","呼和浩特","石家庄","乌鲁木齐","兰州","西宁",
                      	"西安","银川","郑州","济南","太原","合肥","武汉","长沙","南京","成都","贵阳","昆明","南宁","拉萨",
                      	"杭州","南昌","广州","福州","台北","海口","香港","澳门"];
        	//$area_map = array_iconv('gb2312','utf-8',$area_map);
        	foreach($areas as $area){
        		$area->name = $area_map[intval($area->name)-1];
        		$area->value = $area->value*1000;
        	}
        	//$resdata = array('areas'=>$areas);
        	return $this->stdResponse('1',$areas);
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
        
    }
 	 /*-----------------------------应用下载数据-------------------------------*/
 	 
 	 /*1.下载量
	Url:/download  method：GET
	请求数据：
		Remember_token
		App_id
	返回参数：
 		 ‘download’: { ‘2017-06-28’:26 , ’2017-06-29’:21, ‘2017-06-30’: 34, ‘2017-07-01’ : 56 }
    */
 	 public function get_downloaded_count(Request $request){
        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        $res=$this->filter($request,[
            'app_id'=>'required|integer',
            'starttime'=>'required|date_format:Y-m-d',
            'endtime'=>'required|date_format:Y-m-d',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
         if(strtotime($request->starttime)>strtotime($request->endtime)){
             return $this->stdResponse('-1');
        }
        try{
        	$app_key = Program::where('id',$request->app_id)->first()->app_key;
        	if($this->admin_permission == 3){
        		$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app_key)->first()->permission;
				if( !(($permission>>1) & 1)) return $this->stdResponse('-6');		
        	}
		
        	$downloaded_count = DB::select('select date,count from download where app_key= ? and date <= ? and date >=? order by date',[$app_key,$request->endtime,$request->starttime]);
        	if(count($downloaded_count)==0)
				return $this->stdResponse('-5');
        	$resdata = array('downloaded_count'=>$downloaded_count);
        	return $this->stdResponse('1',json_encode($resdata));
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
              
 	 }
    
    /*--------------------------------活跃设备概况--------------------------------*/
 	/*1.日活
 	   	Url:/dayactivedev  Method:GET
        请求参数 ：
            Remember_token
            starttime
            endtime
            App_id
        返回参数：
            {
            ‘active_device’: {‘2017-06-28’: 26 , ’2017-06-29’:21, ‘2017-06-30’: 34, ‘2017-07-01’ : 56}}
    */
 	public function get_day_active_dev(Request $request){
        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        $res=$this->filter($request,[
            'app_id'=>'required|integer',
            'starttime'=>'required|date_format:Y-m-d',
            'endtime'=>'required|date_format:Y-m-d',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        if(strtotime($request->starttime)>strtotime($request->endtime)){
            return $this->stdResponse('-1');
        }
		try{
			$app_key = Program::where('id',$request->app_id)->first()->app_key;
       		if($this->admin_permission == 3){
        		$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app_key)->first()->permission;
				if( !(($permission>>2) & 1)) return $this->stdResponse('-6');		
        	}
		
        	$day_active_dev = DB::select('select datetime,active_device from app_critical_data where app_key= ? and datetime <= ? and datetime >=? order by datetime',[$app_key,$request->endtime,$request->starttime]);
        	if(count($day_active_dev)==0)
				return $this->stdResponse('-5');
			if(count($day_active_dev)==0)return $this->stdResponse('-5');
        	$resdata = array('day_active_dev'=>$day_active_dev);
        	return $this->stdResponse('1',json_encode($resdata));
		}catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
        
 	 }
 	
 	/*2.周活（日活加起来近似周活）
        Url:/weekactivedev  Method:GET
        请求参数 ：
        Remember_token
        starttime
        endtime
        App_id
        返回参数：
        {
          ‘week_active_device’: {‘2017-06-28’: 26 , ’2017-06-29’:21, ‘2017-06-30’: 34, ‘2017-07-01’ : 56}
        }
 	 */
 	public function get_week_active_dev(Request $request){
        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        $res=$this->filter($request,[
            'app_id'=>'required|integer',
            'starttime'=>'required|date_format:Y-m-d',
            'endtime'=>'required|date_format:Y-m-d',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        if(strtotime($request->starttime)>strtotime($request->endtime)){
            return $this->stdResponse('-1');
        }
        try{
        	$app_key = Program::where('id',$request->app_id)->first()->app_key;
        	if($this->admin_permission == 3){
        		$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app_key)->first()->permission;
	        	//$today = date('Y-m-d');
	        	if( !(($permission>>2) & 1)) return $this->stdResponse('-6');
        	}
        

        	/*遍历两个日期之间所有日期*/
        	$start=strtotime($request->starttime);
        	$end=strtotime($request->endtime);
        	$a_date=array();
        	while($start<=$end){
            	$aaa=date('Y-m-d',$start);
            	array_push($a_date,$aaa);
            	$start=strtotime('+1 day',$start);
       		}

        	$last_start=strtotime("-6 days",strtotime($request->starttime));
        	$a_end=$request->endtime;

        	$week_active_dev = DB::select('select datetime,active_device from app_critical_data where app_key= ? and datetime <= ? and datetime >=? order by datetime',[$app_key,$a_end,date('Y-m-d',$last_start)]);

        	$newarr=collect();
        	$b_end=strtotime("-6 days",strtotime($a_end));

         	$diffcount=($start-$b_end)/86400;
         	$diff=$diffcount+6;

        	if(!(count($week_active_dev)==$diff)){
            	return $this->stdResponse("-11");
        	}
        	for($i=0;$i<$diffcount;$i++){
             	$count=0;
             	for($j=$i;$j<$i+7;$j++){
                	$count+=$week_active_dev[$j]->active_device;
             	}
             	$newarr->put($a_date[$i],$count);
         	}
         	$resp=array("week_active_dev"=>$newarr->toArray());

        	return $this->stdResponse("1",json_encode($resp));
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }

 	 }
 	 /*3 月活*/
 	 public function get_month_active_dev(Request $request){
         if(!$this->check_token($this->token)){
             return $this->stdResponse('-3');
         }
         $res=$this->filter($request,[
             'app_id'=>'required|integer',
             'starttime'=>'required|date_format:Y-m-d',
             'endtime'=>'required|date_format:Y-m-d',
         ]);
         if(!$res){
             return $this->stdResponse('-1');
         }
         if(strtotime($request->starttime)>strtotime($request->endtime)){
             return $this->stdResponse('-1');
         }

         try{
         	$app_key = Program::where('id',$request->app_id)->first()->app_key;
         	if($this->admin_permission == 3){
         		$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app_key)->first()->permission;
	         	//$today = date('Y-m-d');
	         	if( !(($permission>>2) & 1)) return $this->stdResponse('-6');
         	}
         	/*遍历两个日期之间所有日期*/
         	$start=strtotime($request->starttime);
         	$end=strtotime($request->endtime);
         	$a_date=array();
         	while($start<=$end){
             	$aaa=date('Y-m-d',$start);
             	array_push($a_date,$aaa);
             	$start=strtotime('+1 day',$start);
         	}

         	$last_start=strtotime("-30 days",strtotime($request->starttime));
         	$a_end=$request->endtime;

         	$week_active_dev = DB::select('select datetime,active_device from app_critical_data where app_key= ? and datetime <= ? and datetime >=? order by datetime',[$app_key,$a_end,date('Y-m-d',$last_start)]);

         	$newarr=collect();
         	$b_end=strtotime("-30 days",strtotime($a_end));

         	$diffcount=($start-$b_end)/86400;
         	$diff=$diffcount+29;

         	if(!(count($week_active_dev)==$diff)){
             	return $this->stdResponse("-11");
         	}
         	for($i=0;$i<$diffcount;$i++){
             	$count=0;
             	for($j=$i;$j<$i+30;$j++){
                 	$count+=$week_active_dev[$j]->active_device;
             	}
             	$newarr->put($a_date[$i],$count);
         	}
         	$resp=array("month_active_dev"=>$newarr->toArray());

         	return $this->stdResponse("1",json_encode($resp));
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
     }

 	/* 4.已玩天数
    	  Url:/alreadyplaydev  Method:GET
            请求参数 ：
                Remember_token
                App_id
            返回参数：
                {‘1d’:x , ‘2_3d’:x ,’4_7d’ :x,‘8_14d’:x,  ’15_30d’:x,  ’31_90d’:x,  ’91_180d’:x,  ’181_365d’:x,   	‘365_d’:x}
    */
 	public function already_play_dev(Request $request){
 	    if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        $res=$this->filter($request,[
            'app_id'=>'required|integer',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }

        try{
        	$app_key = Program::where('id',$request->app_id)->first()->app_key;
        	if($this->admin_permission == 3){
	        	$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app_key)->first()->permission;
	        if( !(($permission>>2) & 1)) return $this->stdResponse('-6');
	        }
        	$already_play_dev= Active_device::orderBy('id','DESC')->first();
            if(count($already_play_dev)==0)
				return $this->stdResponse('-5');
        	$resp=array("already_play_dev"=>$already_play_dev);
         	return $this->stdResponse("1",json_encode($resp));
         	/*
        $id = DB::select('select max(id) from active_device where app_key = ?',[$app_key])[0]->id;
        $already_play_dev = DB::select('select 1d,2_3d,4_7d,8_14d,15_30d,31_90d,91_180d,181_365d,365_d 
                                        from active_device 
                                        where id= ?',[$id]);
                                      */
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
        
        
        
 	 }
 	 
 	 
 	 /*--------------------------------活跃玩家概况 --------------------------------*/ 
 	 
 	/*1.日活
 	   	Url:/dayactiveuser  Method:GET
        请求参数 ：
            Remember_token
            starttime
            endtime
            App_id
        返回参数：
            {‘active_user’: {‘2017-06-28’: 26 , ’2017-06-29’:21, ‘2017-06-30’: 34, ‘2017-07-01’ : 56}}
    */
 	public function get_day_active_user(Request $request){
        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        $res=$this->filter($request,[
            'app_id'=>'required|integer',
            'starttime'=>'required|date_format:Y-m-d',
            'endtime'=>'required|date_format:Y-m-d',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        if(strtotime($request->starttime)>strtotime($request->endtime)){
            return $this->stdResponse('-1');
        }
        try{
        	$app_key = Program::where('id',$request->app_id)->first()->app_key;
        	if($this->admin_permission == 3){
        		$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app_key)->first()->permission;
	        	//$today = date('Y-m-d');
				if( !(($permission>>2) & 1)) return $this->stdResponse('-6');
        	}
        
        	$day_active_user = DB::select('select datetime,active_user from app_critical_data where app_key= ? and datetime <= ? and datetime >=? order by datetime',[$app_key,$request->endtime,$request->starttime]);
        	if(count($day_active_user)==0)
				return $this->stdResponse('-5');
        	$resdata = array('day_active_user'=>$day_active_user);
        	return $this->stdResponse('1',json_encode($resdata));
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
        
 	 }

    /*2.周活（日活加起来近似周活）
  Url:/weekactiveuser  Method:GET
  请求参数 ：
  Remember_token
  starttime
  endtime
  App_id
  返回参数：
  {
    ‘week_active_user’: {‘2017-06-28’: 26 , ’2017-06-29’:21, ‘2017-06-30’: 34, ‘2017-07-01’ : 56}
  }
*/
    public function get_week_active_user(Request $request){
        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        $res=$this->filter($request,[
            'app_id'=>'required|integer',
            'starttime'=>'required|date_format:Y-m-d',
            'endtime'=>'required|date_format:Y-m-d',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        if(strtotime($request->starttime)>strtotime($request->endtime)){
            return $this->stdResponse('-1');
        }
        try{
        	$app_key = Program::where('id',$request->app_id)->first()->app_key;
        	if($this->admin_permission == 3){
	        	$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app_key)->first()->permission;
	        	//$today = date('Y-m-d');
	        	if( !(($permission>>2) & 1)) return $this->stdResponse('-6');
        	}

        	/*遍历两个日期之间所有日期*/
        	$start=strtotime($request->starttime);
        	$end=strtotime($request->endtime);
        	$a_date=array();
        	while($start<=$end){
            	$aaa=date('Y-m-d',$start);
            	array_push($a_date,$aaa);
            	$start=strtotime('+1 day',$start);
        	}

        	$last_start=strtotime("-6 days",strtotime($request->starttime));
        	$a_end=$request->endtime;

        	$week_active_user = DB::select('select datetime,active_user from app_critical_data where app_key= ? and datetime <= ? and datetime >=? order by datetime',[$app_key,$a_end,date('Y-m-d',$last_start)]);

        	$newarr=collect();
        	$b_end=strtotime("-6 days",strtotime($a_end));

        	$diffcount=($start-$b_end)/86400;
        	$diff=$diffcount+6;

        	if(!(count($week_active_user)==$diff)){
            	return $this->stdResponse("-11");
        	}
        	for($i=0;$i<$diffcount;$i++){
            	$count=0;
            	for($j=$i;$j<$i+7;$j++){
                	$count+=$week_active_user[$j]->active_user;
            	}
            	$newarr->put($a_date[$i],$count);
        	}
        	$resp=array("week_active_user"=>$newarr->toArray());

        	return $this->stdResponse("1",json_encode($resp));
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }

    }
    /*3 月活*/
    public function get_month_active_user(Request $request){
        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        $res=$this->filter($request,[
            'app_id'=>'required|integer',
            'starttime'=>'required|date_format:Y-m-d',
            'endtime'=>'required|date_format:Y-m-d',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }

        if(strtotime($request->starttime)>strtotime($request->endtime)){
            return $this->stdResponse('-1');
        }

        try{
        	$app_key = Program::where('id',$request->app_id)->first()->app_key;
        	if($this->admin_permission == 3){
        		$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app_key)->first()->permission;
	        	//$today = date('Y-m-d');
	        	if( !(($permission>>2) & 1)) return $this->stdResponse('-6');
        	}

        	/*遍历两个日期之间所有日期*/
       	 	$start=strtotime($request->starttime);
        	$end=strtotime($request->endtime);
        	$a_date=array();
        	while($start<=$end){
            	$aaa=date('Y-m-d',$start);
            	array_push($a_date,$aaa);
            	$start=strtotime('+1 day',$start);
        	}

        	$last_start=strtotime("-30 days",strtotime($request->starttime));
        	$a_end=$request->endtime;

        	$month_active_user = DB::select('select datetime,active_user from app_critical_data where app_key= ? and datetime <= ? and datetime >=? order by datetime',[$app_key,$a_end,date('Y-m-d',$last_start)]);

        	$newarr=collect();
        	$b_end=strtotime("-30 days",strtotime($a_end));

        	$diffcount=($start-$b_end)/86400;
        	$diff=$diffcount+29;

        	if(!(count($month_active_user)==$diff)){
            	return $this->stdResponse("-11");
        	}
        	for($i=0;$i<$diffcount;$i++){
            	$count=0;
            	for($j=$i;$j<$i+30;$j++){
                	$count+=$month_active_user[$j]->active_user;
            	}
            	$newarr->put($a_date[$i],$count);
        	}
        	$resp=array("month_active_user"=>$newarr->toArray());
			
        	return $this->stdResponse("1",json_encode($resp));
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
    }
 	/* 4.已玩天数
    	Url:/alreadyplayuser  Method:GET
        请求参数 ：
        Remember_token
        App_id
        返回参数：
        {
        ‘1d’:x , ‘2_3d’:x ,’4_7d’ :x,
        ‘8_14d’:x,  ’15_30d’:x,  ’31_90d’:x,  ’91_180d’:x,  ’181_365d’:x,   	‘365_d’:x
        }
        */
    public function already_play_user(Request $request){
 	    if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        $res=$this->filter($request,[
            'app_id'=>'required|integer',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }

        try{
        	$app_key = Program::where('id',$request->app_id)->first()->app_key;
        	if($this->admin_permission == 3){
        		$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app_key)->first()->permission;
        		if( !(($permission>>2) & 1)) return $this->stdResponse('-6');
        	}

                                     
        	$already_play_user= Active_user::orderBy('id','DESC')->first();
        	if(count($already_play_user)==0)
				return $this->stdResponse('-5');
        	$resp=array("$already_play_user"=>$already_play_user);
        	return $this->stdResponse('1',$already_play_user);
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
        
 	 } 	 
 	 /*--------------------------------用户流失状况 --------------------------------*/
 	 
 	/*1 .设备留存
		Url:/devicesurvive  Method:GET
        请求参数 ：
            Remember_token
            starttime
            endtime
            App_id
        返回参数：
            {‘date’:xx , ’new_device’:xx, ’1d’:xx, ‘2d’:xx ,’3d’:xx,  ‘4d’:xx,’5d’:xx,’6d’:xx,’7d’:xx,’14d’:xx,’30d’:xx}
    */
 	public function get_survive_device(Request $request){
        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        $res=$this->filter($request,[
            'app_id'=>'required|integer',
            'starttime'=>'required|date_format:Y-m-d',
            'endtime'=>'required|date_format:Y-m-d',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        if(strtotime($request->starttime)>strtotime($request->endtime)){
            return $this->stdResponse('-1');
        }
        try{
        	$app_key = Program::where('id',$request->app_id)->first()->app_key;
        	if($this->admin_permission == 3){
	       	 	$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app_key)->first()->permission;
	        	//$today = date('Y-m-d');
				if( !(($permission>>3) & 1)) return $this->stdResponse('-6');
        	}
        	$survive_device = DB::select('select date,today,1day,2day,3day,4day,5day,6day,7day,14day,30day from survive_device where app_key= ? and date <= ? and date >=? order by date',[$app_key,$request->endtime,$request->starttime]);
        	if(count($survive_device)==0)
				return $this->stdResponse('-5');
        	$resdata = array('survive_device'=>$survive_device);
        	return $this->stdResponse('1',json_encode($resdata));
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
        
 	 }
 	 
 	 
 	 /*1.玩家留存 
      Url:/usersurvive  Method:GET
      请求参数 ：
            Remember_token
            starttime
            endtime
            App_id
    返回参数：
            {‘date’:xx , ’new_user:xx, ’1d’:xx, ‘2d’:xx ,’3d’:xx,  ‘4d’:xx,’5d’:xx,’6d’:xx,’7d’:xx,’14d’:xx,’30d’:xx}
    */
 	public function get_survive_user(Request $request){
        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        $res=$this->filter($request,[
            'app_id'=>'required|integer',
            'starttime'=>'required|date_format:Y-m-d',
            'endtime'=>'required|date_format:Y-m-d',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        if(strtotime($request->starttime)>strtotime($request->endtime)){
            return $this->stdResponse('-1');
        }
        try{
        	$app_key = Program::where('id',$request->app_id)->first()->app_key;
        	if($this->admin_permission == 3){
	        	$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app_key)->first()->permission;
	        	//$today = date('Y-m-d');
				if( !(($permission>>3) & 1)) return $this->stdResponse('-6');
        	}
		
        	$survive_user = DB::select('select date,today,1day,2day,3day,4day,5day,6day,7day,14day,30day from survive_user where app_key= ? and date <= ? and date >=? order by date',[$app_key,$request->endtime,$request->starttime]);
        	if(count($survive_user)==0)
				return $this->stdResponse('-5');
        	$resdata = array('survive_user'=>$survive_user);
        	return $this->stdResponse('1',json_encode($resdata));
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
        
 	 }
 	 
 	 
 	 /*type是设备和玩家：nd是新增设备、nu是新增玩家、ad是活跃设备、au活跃玩家、pd付费设备、pu付费玩家;
 	    param是参数，ci是联网方式，co是运营商、os是操作系统、pt是设备型号
 	   url:app/{id}/{type}/{param}  Method:GET
 	   请求参数：
 	        remember_token,
 	        starttime,
 	        endtime,
 	  //    count 显示数量，
 	    返回参数 ：
 	 */
    public function getFeaturesData(Request $request,$id,$type,$param){
         if(!$this->check_token($this->token)){
             return $this->stdResponse('-3');
         }
         $res=$this->filter($request,[
             'starttime'=>'required|date_format:Y-m-d',
             'endtime'=>'required|date_format:Y-m-d',
         ]);
         if(!$res){
             return $this->stdResponse('-1');
         }
        if(strtotime($request->starttime)>strtotime($request->endtime)){
            return $this->stdResponse('-1');
        }
        try{
        	$app_key = Program::where('id',$id)->first()->app_key;
			if($this->admin_permission == 3){
	        	$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app_key)->first()->permission;
	        	//$today = date('Y-m-d');
				if( !(($permission>>4) & 1)) return $this->stdResponse('-6');
        	}
        	/*遍历两个日期之间所有日期*/
        	$start=strtotime($request->starttime);
        	$end=strtotime($request->endtime);
        	$date=array();
        	while($start<=$end){
            	$aaa=date('Y-m-d',$start);
            	array_push($date,$aaa);
            	$start=strtotime('+1 day',$start);
        	}

        	$collection=collect();
        	for($i=0;$i<count($date);$i++){
            	$filename=$date[$i]."_".$type."_".$param.".txt";
            	$contents=json_decode(Storage::disk($type)->get($filename));
            	$array=$contents->{"data"};
            	for($j=0;$j< count($array);$j++) {
                	if($array[$j]->{"app_key"}==$app_key){
            	//       $collection->put($date[$i],$array[$j]->{"data"});
                    	$collection->push($array[$j]->{"data"});
                	}
            	}

        	}
        	/*再次遍历加值*/
			$Map = array();

			foreach($collection as $arr){
				foreach($arr as $obj){
					if(!array_key_exists($obj->value,$Map))$Map[$obj->value]=0;
					$Map[$obj->value]+=intval($obj->count);

				}
			}
			$resdata = array('map'=>$Map);

        	return $this->stdResponse('1',json_encode($resdata));
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }

    }
    

}