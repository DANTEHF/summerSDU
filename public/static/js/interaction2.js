//存APP_id  ，加载APP列表
$.ajax({
        url:"a/getalist",
        type:"GET",
        data:{
			'page' : 1,
			'rows' : 14,
        },

        success:function(data){

            if (data.code == 1) {

                //console.log(data);
                var array=data.data;
                var obj = JSON.parse(array);
                var app = obj.applist.data;
                //console.log(app);
                for(var i=0;i<app.length;i++){
                    //console.log(app[i].id+"---"+app[i].name);
                    $("#apptable").append("<tr><td>"+(i+1)+"</td><td id='name'>"+app[i].name+"</td><td id='id'>"+app[i].id+"</td><td>"+
                        app[i].description+"</td><td><button>管理</button></td></tr>");
                }

                //分页  加了page参数
                interactionTwo_mlist(current_pager_number);//管理员列表

                $(".xmguanli button").on("click",function () {
                    $(".xmguanli").attr("style", "display:none;");
                    $(".down-1").attr("style", "display:none;");
                    $(".fenye").attr("style", "display:none;");
                    $(".down-2").attr("style", "display:block;");

                    $(".xmguanli_nr").attr("style", "display:block;");
                    $(".g_maincontent1_2").attr("style", "display:none;");
                    $(".g_maincontent1_3").attr("style", "display:none;");
                    $(".g_maincontent1_4").attr("style", "display:none;");
                    $(".g_maincontent1_5").attr("style", "display:none;");
                    $(".g_maincontent1_6").attr("style", "display:none;");
                    $(".g_maincontent1_7").attr("style", "display:none;");
                    $(".g_content_right_header").attr("style", "display:block;");
                    $(".g_maincontent1_1").attr("style", "display:block;");
                    $(".down").css("height", 968);

                    var self = $(this);
                    var app_id = self.parents("tr").find("#id").text();
                    console.log(app_id);

                    $(".btn-default").attr("name", app_id);

                    var startTime =  $("#date_start").val();
                    var endTime =   $("#date_end").val();
                    //新增用户和设备
                    interraction1_1(startTime,endTime,app_id);

                    //活跃玩家和设备
                    interaction1_2(startTime,endTime,app_id);

                    //付费金额
                    interaction1_3(startTime,endTime,app_id);

                    //付费用户
                    interaction1_4(startTime,endTime,app_id);

                    //应用下载量
                    interaction1_5(startTime,endTime,app_id);

                    //新增设备数量
                    interaction2_1(startTime,endTime,app_id);

                    //设备首次游戏时长
                    interaction2_2(app_id);

                    //设备地区分布
                    interaction2_3(app_id);

                    //新增用户数量
                    interaction3_1(startTime,endTime,app_id);

                    //用户首次使用时长
                    interaction3_2(app_id);

                    //用户地区分布
                    interaction3_3(app_id);

                    //日活跃设备
                    interaction4_1(startTime,endTime,app_id);

                    //周活跃设备
                    interaction4_2(startTime,endTime,app_id);

                    //月活跃设备
                    interaction4_3(startTime,endTime,app_id);

                    //设备已用天数
                    interaction4_4(app_id);

                    //日活跃用户
                    interaction5_1(startTime,endTime,app_id);

                    //周活跃用户
                    interaction5_2(startTime,endTime,app_id);

                    //月活跃用户
                    interaction5_3(startTime,endTime,app_id);

                    //用户已用天数
                    interaction5_4(app_id);

                    //设备留存
                    interaction6_1(startTime,endTime,app_id);

                    //用户留存
                    interaction6_2(startTime,endTime,app_id);

                    //操作系统
                    interaction7_1(startTime,endTime,app_id);

                    //联网方式
                    interaction7_2(startTime,endTime,app_id);

                    //运营商
                    interaction7_3(startTime,endTime,app_id);

                    //设备型号
                    interaction7_4(startTime,endTime,app_id);

                    huatu1_1_1(strnewuser,strnewdevice,strnewdate);
                    huatu1_1_3(money,strmdate);
                });

            }else{
                console.log(data.status);
            }

        }

    });

//获取本公司三级管理员列表
//分页  加了page参数
function interactionTwo_mlist(page) {
    $.ajax({
        url:"a/mlist",
        type:"GET",
        data:{
			'page' : page,
			'rows' : 14,
        },
        success:function(data){
            //$("#managertable tr:not(:first)").html("");

            if (data.code == 1) {

                var admins=data.data.data;
                console.log(admins+"~~~~~~~~");

                for(var i=0;i<admins.length;i++){
                    console.log(admins[i].id+"---"+admins[i].name);
                    $("#managertable").append("<tr><td>"+(i+(page-1)*14+1)+"</td><td>"+admins[i].name+"</td><td class='id' id='admin_id"+admins[i].id+"'>"+admins[i].id+
                        "</td><td><button class=\"btn g2\" data-toggle=\"modal\" data-target=\"#myModa2\"><p>管理</p></button></td></tr>");

                }
                $(".g2").on("click",function () {
                    //console.log("~~~~~~~");

                    var self = $(this);
                    var manager_id = self.parents("tr").find(".id").text();
                    //console.log(manager_id);
                    // $(".gl").attr("name",manager_id );
                    interactionTwo_m_app_per(manager_id);
                    $("#sc_queren").attr("name",manager_id);

                });

                //新增管理员确认按钮
                $('#xz_queren').unbind();
                $("#xz_queren").click(function () {

                    var i = $("#gly_password").val();
                    var j = $("#gly_password_queren").val();
                    var name = $("#gly_name").val() ;

                    if($("#gly_name").val()=="" || $("#gly_email").val()=="" ||$("#gly_password").val()==""||$("#gly_password_queren").val()==""){
                        alert("以上四项均为必填内容");
                    }
                    else{
                        if(i == j){
                            createAdmin();
                            // var k= $("#managertable tr").length;
                            // $("#managertable").append("<tr><td>"+k +"</td><td>"+name+"</td><td class='id' id='id'>"+data.data+
                            //     "</td><td><button class=\"btn g2\" data-toggle=\"modal\" data-target=\"#myModa2\"><p>管理</p></button></td></tr>");
                            // 分页 初始化表格
                            $("#managertable tr:not(:first)").html("");
                            interactionTwo_mlist(current_pager_number);

                        }
                        else{
                            // $("#gly_password_queren").val("");
                            alert("两次输入密码不一致");
                        }
                    }

                });

                //删除管理员
                $("#sc_queren").unbind();
                $("#sc_queren").click(function () {
                    manager_id = $(this).attr("name");
                    $("#admin_id"+manager_id).parents("tr").remove();

                    deleteAdmin(manager_id);

                });

            }else{
                console.log(data.status);
            }

        }

    });
}

//获取权限列表
function interactionTwo_m_app_per(id) {
    $("#m_app_per_table").empty();
    $("#m_app_per_table").append("<tr><th>序号</th><th>项目名</th><th>项目ID</th><th></th><th>权限</th></tr>");
    $.ajax({
        url:"a/info/id/"+id,
        type:"GET",
        success:function(data){

            if (data.code == 1) {

                //console.log(data);
                var array=data.data;
                var obj = JSON.parse(array);
                var m_app_per = obj.app;
                //console.log(m_app_per);
                //下面两行需要上移
                $("#m_app_per_table").empty();
                $("#m_app_per_table").append("<tr><th>序号</th><th>项目名</th><th>项目ID</th><th></th><th>权限</th></tr>");
                for(var i=0;i<m_app_per.length;i++){
                    //console.log(m_app_per[i].app_id+"---"+m_app_per[i].name);
                    $("#m_app_per_table").append("<tr><td>"+(i+1)+"</td><td>"+m_app_per[i].name+"</td><td class='m_app_id'>"+m_app_per[i].app_id+
                        "</td><td class='m_check'><input type='checkbox' name='' "+
                        ((m_app_per[i].manager_id == id)?" checked='checked'":"")+
                        " ></td>"+
                        "<td>  <select class='selectpicker show-menu-arrow show-tick m_qx_select'  multiple title='选择权限'>"+
                        "<option "+(((m_app_per[i].permission>>0)&1)?"selected = 'selected'":"")+">用户概况</option>"+
                        "<option "+(((m_app_per[i].permission>>1)&1)?"selected = 'selected'":"")+">新增用户</option>"+
                        "<option "+(((m_app_per[i].permission>>2)&1)?"selected = 'selected'":"")+">活跃用户</option>"+
                        "<option "+(((m_app_per[i].permission>>3)&1)?"selected = 'selected'":"")+">用户流失状况</option>"+
                        "<option "+(((m_app_per[i].permission>>4)&1)?"selected = 'selected'":"")+">用户特征描述</option>"+
                        "</select></td></tr>").find(".selectpicker").selectpicker('refresh');
                }
                //解除绑定
                $('#szgl_queren').unbind();
                $("#szgl_queren").click(function () {
                    //console.log("!!!!!!!!!!!!!!!!!!!!!");
                    //取值   p1:数组[项目id,是否选中,权限字符串]   p2:管理员id
                    //项目id
                    //console.log(id);
                    var array_app_id = new Array();
                    $(".m_app_id").each(function () {
                        array_app_id.push($(this).text());
                    });
                    console.log(array_app_id);
                    //是否选中
                    var array_app_checked = new Array();
                    $("input[type='checkbox']").each(function () {
                        if($(this).is(':checked')){
                            array_app_checked.push("1");
                        }
                        else{
                            array_app_checked.push("0");
                        }
                    });
                    console.log(array_app_checked);
                    //权限字符串
                    var array_app_per = new Array();
                    var count =0;
                    $(".m_qx_select").each (function () {
                        // console.log($(this));
                        var i = $(this).val();
                        if(count%2==1){
                            array_app_per.push(i);
                        }
                        count++;
                    });
                    console.log(array_app_per);
                    quzhi(id,array_app_id,array_app_checked,array_app_per);
                });

            }else{
                console.log(data.status);
            }

        }
    });
}


//设置权限
function quzhi(manager_id,array_app_id,array_app_checked,array_app_per) {

    $.ajax({
        url:"a/permission/setall",
        type:"POST",
        data:{
            'manager_id' : manager_id,
            'array_app_id' : array_app_id.join(";"),
            'array_app_checked': array_app_checked.join(";"),
            'array_app_per':array_app_per.join(";"),
		},
	    success:function(data){

            if (data.code == 1) {

                //console.log("-----------------------------------------------------------");
//	    	console.log(manager_id);
//	        console.log(array_app_id);
//	        console.log(array_app_checked);
//	        console.log(array_app_per);

            }else{
                console.log(data.status);
            }

	    }
	});
}

//二级管理员创建三级管理员
function createAdmin() {
    $.ajax({
        url:"a/create",
        type:"POST",
        data:{
            'name' :$("#gly_name").val() ,
            'email' : $("#gly_email").val(),
            'password': $("#gly_password").val(),
        },
        success:function(data){

            if (data.code == 1) {

                console.log(data.data+"!!!!!!!!");
                alert("新建成功");

            }else{
                console.log(data.status);
            }

        }
    });
}

function  deleteAdmin(manager_id) {
    $.ajax({
        url:"a/delmgr",
        type:"DELETE",
        data:{
            'manager_id' : manager_id ,
        },
        success:function(data){

            if (data.code == 1) {

                alert("删除成功");

            }else{
                console.log(data.status);
            }

        }
    });
}