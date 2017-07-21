<?php

namespace App\Http\Controllers;
use App\Manager;
use App\Company;
use App\Program;
use App\Alert;
use App\M_app_permission;
use Illuminate\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DB;
use Germey\Geetest\GeetestCaptcha;
use Validator;
use Session;
class AdminController extends Controller{
    public $token="";
    public function __construct(Request $request)
    {
        $this->token=$request->session()->get('remember_token');
    }
/*  pre： 修改密码
   url：/resetpwd  method:post
    请求参数：
        password ,newpassword
    返回参数：
        1 成功 ，其他 失败
 */
    public function resetPassword(Request $request){
        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        if($this->admin_permission !=1) return $this->stdResponse('-6');
        $res=$this->filter($request,[
            'password'=>'required',
            'newpassword'=>'required|min:6',
        ]);
        if(!$res)  return $this->stdResponse('-1');
        try{
            $admin= Manager::find($this->admin_id);
            if( $admin->password == md5($request->password."#".$this->admin_email) ){
                $admin->password =md5($request->newpassword."#".$this->admin_email);
                $admin->save();
                return $this->stdResponse('1');
            }
            return $this->stdResponse('-7');

        }catch (\Exception $exception){
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }

    }
    /*--------------------- 以下是一级管理员的接口 ---------------------*/
 	 
 	
    /* 1.（root）获取公司列表（分页）
		Url：/clist   Method:GET
		请求参数：

		Page   int  要求的页数
		Rows  int  要求每页的列表
		返回参数
		Company: id ,name ,describe
 	*/
    public function getCompany(Request $request){
    	if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
		if($this->admin_permission !=1) return $this->stdResponse('-6');
        $res=$this->filter($request,[
            'page'=>'required|integer',
            'rows'=>'required|integer',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        try{
        	$com=DB::table('company')->join('manager','company.m_id','=','manager.id')
                ->select('company.*','manager.name as manager_name')
                ->paginate($request->input('rows'));

        	//if(count($com)==0)
        		//return $this->stdResponse('-5');
			
			
       			return $this->stdResponse('1',json_encode($com));
       		

        }catch (\Exception $exception){
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
        
        
    }

    /*2 新增 （root）获取某公司下项目列表 (分页)
     	Url：/alist/company/{id}   Method:GET
		请求参数：

		Page   int  要求的页数
		Rows  int  要求每页的列表
		返回参数
		APP: id ,name ,describe
    */
    public function getProject(Request $request,$id){
        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        if($this->admin_permission !=1) return $this->stdResponse('-6');
        $res=$this->filter($request,[
            'page'=>'required|integer',
            'rows'=>'required|integer',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        try{
        	$name=Company::find($id)->name;
        	$apps=Program::where('company',$name)->paginate($request->rows);
			if($apps->isEmpty())
				return $this->stdResponse('-5');
        	
			
       			return $this->stdResponse('1',json_encode($apps));
       		
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
        
    }

    /*3.（root）添加公司与二级管理员
		Url：/company Method:Post
		请求参数：

		Company_name,
		Company_describe,
		Admin_name,
		Admin_email,
		Admin_password,
		返回参数：
	    1 成功 ，其他 失败；
    */
    public function createCompany(Request $request){

        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        $res=$this->filter($request,[
            'company_name'=>'required|filled',
            'company_describe'=>'required',
            'admin_name'=>'required|filled',
            'admin_email'=>'required|filled|email',
            'admin_password'=>'required|min:6',
        ]);	
        if(!$res){
            return $this->stdResponse('-1');
        }

        if($this->admin_permission !=1) return $this->stdResponse('-6');
        DB::beginTransaction();
        try{
        	$md5password = md5($request->input('admin_password').'#'.$request->input('admin_email'));
            $admininfo=array('name'=>$request->admin_name,
                             'email'=>$request->admin_email,
                             'password'=>$md5password);
            $newadmin=Manager::create($admininfo);

            $cominfo=array('name'=>$request->input('company_name'),
                            'describe'=>$request->input('company_describe'),
                            'm_id'=>$newadmin->id);
            $newcompany=Company::create($cominfo);

            $newadmin->c_id=$newcompany->id;
            $newadmin->permission=2;
            $newadmin->save();

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
    
    /*  4 . (root)添加项目（app）
		Url:/add  Method :POST
		请求参数 ：
		Name   string     项目名字 ，
		Company  string   项目所属公司 ，  	
		Starttime  date 项目开始时间，
		Endtime  date 项目结束时间，
		Description  string 项目备注，
		返回参数 ：
		1成功 ， 其他 失败
   	 */
    public function createApp(Request $request){
        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
		if($this->admin_permission !=1) return $this->stdResponse('-6');
        $res=$this->filter($request,[
            'name'=>'required',
            'company'=>'required',
            'starttime'=>'required|date_format:Y-m-d',
            'endtime'=>'required|date_format:Y-m-d',
            'description'=>'required',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        if(strtotime($request->starttime)>strtotime($request->endtime)){
        	return $this->stdResponse('-1');
        }
        DB::beginTransaction();
        try{
            $appinfo=array('name'=>$request->name,
                            'company'=>$request->company,
                            'description'=>$request->description,
                            'starttime'=>$request->starttime,
                            'endtime'=>$request->endtime,
                            'app_key'=>md5($request->name.'#'.time()),
                            );
                            
            $newapp=Program::create($appinfo);
            $newapp->save();
            DB::commit();
            return $this->stdResponse('1',$newapp->id);
        }catch (\Exception $exception){
            DB::rollback();
            return $this->stdResponse('-4');
        }catch (\Error $error){
            DB::rollback();
            return $this->stdResponse('-4');
        }
    }
   
    /*  5.（root）获取项目app信息
		Url：/ainfo/id/{id}  method：GET
		请求参数：

		返回参数：
		app_id,
		App_name,
		Company,
		Starttime,
		Endtime,
		Describe.
	*/
    public function getAppInfo(Request $request,$id){
    //check admin and permission
        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
		if($this->admin_permission !=1) return $this->stdResponse('-6');
		try{
			$app = Program::where('id',$id)->get();
			if($app->isEmpty())
				return $this->stdResponse('-5');
        	return $this->stdResponse('1',json_encode($app));
		}catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
        
    }
    
    /*   6.（root）编辑更改app信息
		Url:/edit  Method:POST
		请求参数：

		App_id,
		Name(需判断是否有该字段),
		Endtime (需判断)，
		Description，
		返回参数：
		1 成功 ; 其他 失败
 	*/
    public function updateApp(Request $request){
        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
		if($this->admin_permission !=1) return $this->stdResponse('-6');
		$res=$this->filter($request,[
            'app_id'=>'required|integer',
            'name'=>'required',
            'endtime'=>'required|date_format:Y-m-d',
            'description'=>'required',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        DB::beginTransaction();
        try{
            $app = Program::where('id',$request->app_id)->first();
            $app->name = $request->name;
            $app->endtime = $request->endtime;
            $app->description = $request->description;
            $app->save();
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
    /*
     * 7.(root)获取全部的app列表
        url：/alist/all  method:get
        请求参数：page rows
        返回参数：app all
     * */
    public function getAllApp(Request $request){
        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        if($this->admin_permission !=1) return $this->stdResponse('-6');
        $res=$this->filter($request,[
            'page'=>'required|integer',
            'rows'=>'required|integer',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }

        try{
           $allapp= Program::paginate($request->rows);
           return $this->stdResponse('1',json_encode($allapp));
        }  catch (\Exception $exception){
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }}
    /*8. （root）删除app*/
    public  function delApp(Request $request){
        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        if($this->admin_permission !=1) return $this->stdResponse('-6');
        $res=$this->filter($request,[
            'app_id'=>'required|integer' ,
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        try{
            $bool=Program::find($request->app_id)->delete();

            return $bool?$this->stdResponse('1'): $this->stdResponse('-4');
            
        } catch (\Exception $exception){

            return $this->stdResponse('-4');
        }catch (\Error $error){

            return $this->stdResponse('-4');
        }



    }
 	/*---------------------------一级管理员的接口结束--------------------------*/
    
    
 	/*----------------------- 以下是二级管理员的接口---------------------------*/
    
    /* 1.  二级管理员创建三级管理员
		描述：企业级管理员创建其他管理员（三级管理员permission=3）
		Url：/create  METHOD:POST
		请求参数：
		name  string   要创建的管理员名字, 
		email  email   要创建的管理员邮箱, 
		password string（至少6位） 要创建的管理员密码 , 
		(deleted)company string  要创建管理员的所属公司，
		返回参数：1（成功） 其他（失败）
	*/
    public function createAdmin(Request $request){
        //check admin and permission
        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
		if($this->admin_permission !=2) return $this->stdResponse('-6');
        $res=$this->filter($request,[
            'email'=>'required|filled|email|unique:manager',
            'name'=>'required',
            'password'=>'required|min:6',
  //        'company'=>'required',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        DB::beginTransaction();
        try{
	        $new=new Manager();
	        $new->email=$request->email;
	        $new->name =$request->name;
	        $new->password=md5($request->input('password').'#'.$request->input('email'));
	        $new->c_id=$this->admin_c_id;
	        $new->permission=3;
	        $new->save();
	        DB::commit();
            return $this->stdResponse('1',$new->id);
        }catch(Exception $ex){
        	DB::rollback();
        	return $this->stdResponse('-4');
        }catch(Error $err){
        	DB::rollback();
        	return $this->stdResponse('-4');
        }


    }
    
	/* 2.设置三级管理员与app关联
		描述：root创建的二级管理员默认拥有所属企业下所有软件的所有权限，该接口是二级管理员设置其公司三级管理员权限。
		Url：/permission/id/{id}  method: POST
		请求参数：

		app_id int  分配给管理员的项目id，  
		(deleted)permission  string   默认为0 
		返回参数：
		1 成功，其他 失败
 	*/
	public function setAdmin(Request $request, $id){
		if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        if($this->admin_permission !=2) return $this->stdResponse('-6');
        $res=$this->filter($request,[
			'app_id'=>'required|integer',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        
        DB::beginTransaction();
        try{
            $app_key = Program::where('id',$request->app_id)->first()->app_key;

            $m_a_permission = new M_app_permission();
            $m_a_permission->manager_id=$id;
            $m_a_permission->app_key=$app_key;
            $m_a_permission->permission=0;
            $m_a_permission->save();
            DB::commit();

        }catch(Exception $ex){
        	DB::rollback();
        	return $this->stdResponse('-4');
        }catch(Error $err){
        	DB::rollback();
        	return $this->stdResponse('-4');
        }
        return $this->stdResponse('1');
	}
	/*3.设置三级管理员app权限
		Url：/permission method:POST
		请求参数：

		Permission  string  用 ，隔开
		App_id ,
	    manager_id,
		返回参数：
		1 成功；其他 失败
	*/
	public function updateAdmin(Request $request){
		if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        if($this->admin_permission !=2) return $this->stdResponse('-6');
        $res=$this->filter($request,[
			'app_id'=>'required|integer',
			'permission' => 'required',
			'manager_id' => 'required',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        //str转换到二进制存储
        $permission_array=explode(",",$request->permission);
		$Map = array(); //定义一个数组
		$Map['用户概况'] = 1;
		$Map['新增用户'] = 2;
		$Map['活跃用户'] = 4;
		$Map['用户流失状况'] = 8;
		$Map['用户特征描述'] = 16;
		$permission=0;
        foreach( $permission_array as $per_str){
        	$permission += $Map[$per_str];
        }
        DB::beginTransaction();
        try{
	        $app_key = Program::where('id',$request->app_id)->first()->app_key;
	        $m_a_permission=M_app_permission::where('manager_id',$request->manager_id)->where('app_key',$app_key)->first();
	        $m_a_permission->permission=$permission;
	        $m_a_permission->save();
	        DB::commit();
	        
        }catch(Exception $ex){
        	DB::rollback();
        	return $this->stdResponse('-4');
        }catch(Error $err){
        	DB::rollback();
        	return $this->stdResponse('-4');
        }
        return $this->stdResponse('1');
	}
	/*
		新增： （二级管理员）设置三级管理员与app的关联
		URL:/permission/setall method: POST
		请求参数 :
		remember_token  string
		manager_id    int //三级管理员的id
		array_app_id  数组
		array_app_checked  数组
		array_app_per  数组
		返回参数：
		1 成功；其他 失败
	*/
	public function setAllPermission(Request $request){
		if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        if($this->admin_permission !=2) return $this->stdResponse('-6');
        $res=$this->filter($request,[
			'manager_id'=>'required|integer',
			'array_app_id' => 'required',
			'array_app_checked' => 'required',
			'array_app_per' => 'required',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        $Map = array(); //定义一个数组
		$Map['用户概况'] = 1;
		$Map['新增用户'] = 2;
		$Map['活跃用户'] = 4;
		$Map['用户流失状况'] = 8;
		$Map['用户特征描述'] = 16;
		
		$array_app_id = explode(";",$request->array_app_id);
		$array_app_checked = explode(";",$request->array_app_checked);
		$array_app_per = explode(";",$request->array_app_per);
		DB::beginTransaction();
      	try{
			for($i=0;$i<count($array_app_id);$i++){
				$app_key = Program::where('id',$array_app_id[$i])->first()->app_key;
				$m_a_permission = M_app_permission::where('manager_id',$request->manager_id)->where('app_key',$app_key)->first();
				if(intval($array_app_checked[$i]) == 0){
					if(count($m_a_permission)!=0){
						$m_a_permission->delete();
					}
				}
				else{
					$permission_array=explode(",",$array_app_per[$i]);
					$permission=0;
					foreach( $permission_array as $per_str){
			        	$permission += $Map[$per_str];
			        }
			        if(count($m_a_permission)==0){
			        	$m_a_permission = new M_app_permission();
			            $m_a_permission->manager_id=$request->manager_id;
			            $m_a_permission->app_key=$app_key;
			        }
		            $m_a_permission->permission=$permission;
		            $m_a_permission->save();
				}
			}
			DB::commit();
		}catch(Exception $ex){
      	DB::rollback();
      	return $this->stdResponse('-4');
      }catch(Error $err){
      	DB::rollback();
      	return $this->stdResponse('-4');
      }
        
        
        return $this->stdResponse('1',$m_a_permission);
	}
	
	
	/* 4.（二级管理员）获取三级管理员列表（分页）
		Url :/mlist  method :GET
		请求参数 :
		remember_token  string
		page  int  要求的页数 
		rows  int  要求每页的列数
		返回参数：（同所属公司）
		Id ,name ,email,company
	*/
	public function getAdmin(Request $request){
        //check admin and permission
        if(!$this->check_token($this->token)){
            return $this->stdResponse('-3');
        }
        if($this->admin_permission !=2) return $this->stdResponse('-6');
        $res=$this->filter($request,[
            'page'=>'required',
            'rows'=>'required',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        try{
        	$c_id=$this->admin_c_id;
        	$admin=Manager::where('permission','3')->where('c_id',$c_id)
              			->paginate($request->input('rows'));
        	if($admin->isEmpty())
        		return $this->stdResponse('-5');
        	return $this->stdResponse('1',$admin);
       		
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
        
    }
    
    /*5.（二级管理员）获取三级管理员信息
		Url：/info/id/{id}  method: GET
		请求参数：
		Remember_token
		返回参数： 	
		1. name,
		2. email,
		3. 所有管理的app,
		4. 对应的app_permission
	*/
    public function getAdminInfo(Request $request,$id){
    	if(!$this->check_token($this->token)){
			return $this->stdResponse('-3');
		}
		if($this->admin_permission !=2) return $this->stdResponse('-6');
		try{
			/*
			$mgr = Manager::where('id',$id)->first();
			if(count($mgr)==0)
				return $this->stdResponse('-5');
			*/
			$c_id=$this->admin_c_id;
			$c_name = Company::where('id',$c_id)->first()->name;
			$app = DB::select('select app.id as app_id,name,permission,manager_id from 
								(select * from m_app_permission 
								where manager_id = ? or manager_id is null
                                ) as m_app_permission
                            right join app 
							on m_app_permission.app_key = app.app_key
                            where app.company = ?
                            order by app_id',[$id,$c_name]);
			if(count($app)==0)
				return $this->stdResponse('-5');
			$resdata=array('manager_id'=>$id,'app'=>$app);
       	 	//if($request->page>=1&&$request->page<=$app->lastPage())
       			return $this->stdResponse('1',json_encode($resdata));
       		//else
       		//	return $this->stdResponse('1','{}');
		}catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
		
    }
    
    /* 6.获取所属公司下所有app列表
	url:/getalist  method:get
		请求参数：
		返回参数：
	app:name,id ,description */
	
	public function get_alist(Request $request){
    	if(!$this->check_token($this->token)){
			return $this->stdResponse('-3');
		}
		if($this->admin_permission !=2) return $this->stdResponse('-6');
		$res=$this->filter($request,[
            'page'=>'required|filled|integer',
            'rows'=>'required|integer',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        try{
        	$c_name=Company::where('id',$this->admin_c_id)->first()->name;
			$app=Program::where('company',$c_name)->simplePaginate($request->input('rows'));
			if($app->isEmpty())
				return $this->stdResponse('-5');
			$resdata=array('applist'=>$app);	
        	
       			return $this->stdResponse('1',json_encode($resdata));
       		
        }catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
		
    }
    
    /*
     URL:/delmgr method: DELETE
         请求参数：
         Remember_token
         manager_id
         返回参数：1成功，其他失败
     * */
    public function delmgr(Request $request){
    	if(!$this->check_token($this->token)){
			return $this->stdResponse('-3');
		}
		if($this->admin_permission !=2) return $this->stdResponse('-6');
		$res=$this->filter($request,[
            'manager_id'=>'required',
        ]);
        DB::beginTransaction();
        if(!$res){
            return $this->stdResponse('-1');
        }
        try{
	        $manager = Manager::where('id',$request->manager_id)->first();
	        $manager->delete();
	        DB::commit();
        }catch (\Exception $exception){        
        	DB::rollback();   
            return $this->stdResponse('-4');
        }catch (\Error $error){
        	DB::rollback();
            return $this->stdResponse('-4');
        }
        
    }
    
    /*------------------------二级管理员的接口结束----------------------*/
 	 
 	/*------------------------三级管理员的接口--------------------------*/
 	/*1.获取app列表
    	url：/getlist method:GET
    	请求参数：
    
    	返回参数：
    	    app：id , name
    */
 	public function get_app_list(Request $request){
 	    if(!$this->check_token($this->token)){
			return $this->stdResponse('-3');
		}
		if($this->admin_permission !=3) return $this->stdResponse('-6');
		try{
			$manager_id = $this->admin_id;
			$app = DB::select('select app.id,name from m_app_permission left join app 
							on m_app_permission.app_key = app.app_key
							where manager_id = ? ',[$manager_id]);
			if(count($app)==0)
				return $this->stdResponse('-5');
			return $this->stdResponse('1',$app);
		}catch (\Exception $exception){           
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
 	}
 	
 	 /*2.获得app信息
    	url：/getapp  method:GET
    	请求参数：

    		app_id,
    	返回参数：
    		name , m_a_permission,description
    */
 	 public function get_app_info(Request $request){
 	    if(!$this->check_token($this->token)){
			return $this->stdResponse('-3');
		}
		if($this->admin_permission !=3) return $this->stdResponse('-6');

		$res=$this->filter($request,[
			'app_id'=>'required|integer',
        ]);
        if(!$res){
            return $this->stdResponse('-1');
        }
        try{
        	$manager_id = $this->admin_id;
			$app=Program::where('id',$request->app_id)->first();

			if(count($app)==0)
				return $this->stdResponse('-5');

			$m_a_permission = M_app_permission::where('app_key',$app->app_key)->where('manager_id',$manager_id)->first()->permission;

			if($m_a_permission=="")
				return $this->stdResponse('-5');

			$resdata=array('name'=>$app->name,'description'=>$app->description,'m_a_permission'=>$m_a_permission);

        	return $this->stdResponse('1',json_encode($resdata));
        }catch (\Exception $exception){
            return $this->stdResponse('-4');
        }catch (\Error $error){
            return $this->stdResponse('-4');
        }
        
		
 	 }
 	 
 	 /*
 	  3.设置预警
	url/setalert method: POST
	请求参数：

		app_id,
		days.
		item.
		limit.
		trigger.
	返回参数：
		1（成功） 其他（失败）
 	  * */
 	 public function setAlert(Request $request){
 	 	if(!$this->check_token($this->token)){
			return $this->stdResponse('-3');
		}
		if($this->admin_permission !=3) return $this->stdResponse('-6');
		$res=$this->filter($request,[
			'app_id'=>'required|integer',
			'days'=>'required',
			'item'=>'required',
			'limit'=>'required',
			'trigger'=>'required',
        ]);
        try{
        	DB::beginTransaction();
	       	$alert = new Alert();
	       	$app = Program::where('id',$request->app_id)->first();
	       	$permission = M_app_permission::where('manager_id',$this->admin_id)->where('app_key',$app->app_key)->count();
	       	if($permission==0)return $this->stdResponse('-6');
	       	$alert->app_key = $app->app_key;
	       	$alert->manager_id=$this->admin_id;
	       	$alert->days = $request->days;
	       	$alert->item = $request->item;
	       	$alert->limit = $request->limit;
	       	$alert->trigger = $request->trigger;
	       	$alert->save();
	       	DB::commit();
	       	return $this->stdResponse('1');
        }catch(Exception $exception){
        	DB::rollback();
            return $this->stdResponse('-4');
        }catch(Error $error){
        	DB::rollback();
            return $this->stdResponse('-4');
        }
        
 	 }

}