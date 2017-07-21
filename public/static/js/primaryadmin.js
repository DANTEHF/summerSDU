//新增玩家用户和设备
var strnewuser,strnewdevice,strnewdate;
//活跃用户和设备
var stractiveuser,stractivedevice,stractivedate;
//付费金额
var money,strmdate;
//付费用户
var pay_user,strpaydate;
//应用下载量
var downloaded_y,downloaded_x;
//新增设备数量
var new_device_y,new_device_x;
//设备首次使用时长
var dev_first_time_y,dev_first_time_x;
//新增用户数量
var new_user_y,new_user_x;
//用户首次使用时长
var user_first_time_y,user_first_time_x;
//日活跃设备
var day_active_dev_y,day_active_dev_x;
//周活跃设备
var week_active_dev_y,week_active_dev_x;
//月活跃设备
var month_active_dev_y,month_active_dev_x;
//设备已用天数
var already_play_dev_y,already_play_dev_x;
//日活跃用户
var day_active_user_y,day_active_user_x;
//周活跃用户
var week_active_user_y,week_active_user_x;
//月活跃用户
var month_active_user_y,month_active_user_x;
//用户已用天数
var already_play_user_y,already_play_user_x;
//设备留存
var survive_device_y,survive_device_x;
//用户留存
var survive_user_y,survive_user_x;
//操作系统
var os_y,os_x;
//联网方式
var ci_y,ci_x;
//运营商
var co_y,co_x;
//设备型号
var pt_y,pt_x;
//设备地区分布
var area_dev;
//设备用户分布
var area_user;

$(document).ready(function() {
	$(".xmguanli").attr("style","display:none;");//项目管理表格
	$(".glyshezhi").attr("style","display:none;");
	$(".xinzenggs").attr("style","display:none;");
	$(".xmguanli_nr").attr("style","display:none;");
	$(".xmguanli_nr_main").attr("style","display:none;");
	$(".gsguanli_nr").attr("style","display:none;");
	$(".fenye").attr("style","display:none;");
	$(".down-1 img").attr("style","display:none;");//鼠标移动时的列表竖杆
    $(".down-2").attr("style","display:none;");//项目的管理左列表
    
    $(".disanbu").attr("style","display:none;");
    $(".dierbu").attr("style","display:none;");
    $(".yujing").attr("style", "display:none;");
    $(".rizhi").attr("style", "display:none;");


	$(".x1 p").mouseover(function(){
		$(".x1 img").attr("style","display:block;");
		$(this).css("color","#e3ea6e");
	});
	$(".x1 p").mouseout(function(){
	   $(".x1 img").attr("style","display:none;");
	   $(this).css("color","white");
	});
	$(".x2 p").mouseover(function(){
		$(".x2 img").attr("style","display:block;");
		$(this).css("color","#e3ea6e");
	});
	$(".x2 p").mouseout(function(){
	   $(".x2 img").attr("style","display:none;");
	   $(this).css("color","white");
	});
	/*以上为选择左侧列表鼠标移动效果*/


	$(".x1 p").click(function(){
        $(".glyshezhi").attr("style","display:none;");
		$(".xmguanli").attr("style","display:none;");
		$(".xmguanli_nr").attr("style","display:none;");
		$(".denglu").attr("style","display:none;");
		$(".fenye").attr("style","display:block;");
		$(".gsguanli_nr").attr("style","display:block;");
		$(".xinzenggs").attr("style","display:none;");
        $(".yujing").attr("style", "display:none;");
        $(".rizhi").attr("style", "display:none;");
		$(".x1 p").css("background-color","#c52727")
		$(".x2 p").css("background-color","#d71414")
	});
	$(".x2 p").click(function(){
            if($(".glyshezhi").is(":hidden")){
                $(".xmguanli").attr("style","display:block;");
                $(".gsguanli_nr").attr("style","display:none;");
                $(".xinzenggs").attr("style","display:none;");
                $(".denglu").attr("style","display:none;");
                $(".glyshezhi").attr("style","display:none;");
                $(".xmguanli_nr").attr("style","display:none;");
                $(".yujing").attr("style", "display:none;");
                $(".rizhi").attr("style", "display:none;");
                $(".fenye").attr("style","display:block;");
                $(".x2 p").css("background-color","#c52727")
                $(".x1 p").css("background-color","#d71414");

            }else{
                $(".xmguanli").attr("style","display:none;");
                $(".glyshezhi").attr("style","display:block;");
                $(".xinzenggs").attr("style","display:none;");
                $(".denglu").attr("style","display:none;");
                $(".gsguanli_nr").attr("style","display:none;");
                $(".yujing").attr("style", "display:none;");
                $(".rizhi").attr("style", "display:none;");
                $(".fenye").attr("style","display:block;");
                $(".x2 p").css("background-color","#c52727")
                $(".x1 p").css("background-color","#d71414")
            };
	});
	//以上为公司管理和项目管理的一级显示
	$(".biao4tou button").on('click',function(){
		$(".xinzenggs").attr("style","display:block;");
	    $(".gsguanli_nr").attr("style","display:none;");
	    $(".fenye").attr("style","display:none;");
	    $(".diyibu").attr("style","display:block;");
        $(".dierbu").attr("style","display:none;");
        $(".disanbu").attr("style","display:none;");
	});
	$(".return3").click(function(){
	    $(".xinzenggs").attr("style","display:none;");
	    $(".gsguanli_nr").attr("style","display:block;");
	    $(".fenye").attr("style","display:block;");
	});
	$(".diyibu button").click(function(){
	    if($("#newcompanyname").val() == "" || $("#newcompanydescribe").val() == ""){
            alert("这两项为必填项内容");
        }
        else{
            $(".diyibu").attr("style","display:none;");
            $(".dierbu").attr("style","display:block;");
            $(".disanbu").attr("style","display:none;");
        }
    });

    $(".shangyibu").click(function(){
    $(".diyibu").attr("style","display:block;");
    $(".dierbu").attr("style","display:none;");
    $(".disanbu").attr("style","display:none;");	
    });

    $(".xiayibu").click(function(){
        if($("#newadminname").val() == "" || $("#newadminemail").val() == "" || $("#newadminpassword").val() == ""){
            alert("这三项为必填项内容");
        }
        else{
            $(".diyibu").attr("style","display:none;");
            $(".dierbu").attr("style","display:none;");
            $(".disanbu").attr("style","display:block;");
            addCompanyAndManager();
            $("#newcompanyname").val("");
            $("#newcompanydescribe").val("");
            $("#newadminname").val("");
            $("#newadminemail").val("");
            $("#newadminpassword").val("");
        }
    });

	//以上为公司管理的二级显示以及返回

	// $(".biao1 button").on('click',function(){
	// 	$(".xmguanli").attr("style","display:none;");
	// 	$(".glyshezhi").attr("style","display:block;");
	// 	$(".fenye").attr("style","display:block;");
	// });
	$(".return1").click(function(){
	    $(".xmguanli").attr("style","display:block;");
		$(".glyshezhi").attr("style","display:none;");
		$(".fenye").attr("style","display:block;");
	});
    //项目管理的二级显示以及返回一级显示

    $(".biao2 button,.biao1 button,.biao3 button").mouseover(function(){
		$(this).css("color","black");
	});
	$(".biao2 button,.biao1 button,.biao3 button").mouseout(function(){
	   $(this).css("color","#fff");
	});

    // $(".chakan").on('click',function(){
	 //   $(".xmguanli").attr("style","display:none;");
	 //   $(".glyshezhi").attr("style","display:none;");
	 //   $(".fenye").attr("style","display:none;");
	 //   $(".xinzenggs").attr("style","display:none;");
    //     $(".down-2").attr("style","display:block;");
    //     $(".down-1").attr("style","display:none;");
	 //   // $(".xmguanli_nr").attr("style","display:block;");
	 //   $(".xmguanli_nr_main").attr("style","display:none;");
    // });
    // $(".biao3 button").on('click',function(){
    //    $(".down-2").attr("style","display:block;");
	 //   $(".down-1").attr("style","display:none;");
	 //   $(".xmguanli_nr").attr("style","display:none;");
	 //   $(".fenye").attr("style","display:none;");
    // });
    // $(".return2").on('click',function(){
    //    $(".down-2").attr("style","display:none;");
	 //   $(".down-1").attr("style","display:block;");
	 //   $(".xmguanli").attr("style","display:none;");
	 //   $(".glyshezhi").attr("style","display:block;");
	 //   $(".fenye").attr("style","display:block;");
	 //   $(".xinzenggs").attr("style","display:none;");
	 //   $(".gsguanli_nr").attr("style","display:none;");
	 //   $(".xmguanli_nr").attr("style","display:none;");
    // });
    //项目查看以及返回


	$(".down-2 ul").attr("style","display:none;");
	$(".y1 p,.y1 img").click(function(){
		if($(".y1 ul").is(":hidden")){
    	   var val=1;
    	   $(".y1 ul").slideDown("");	
    	   $(".y1 img").rotate(90*val);	
        }else{
    	   $(".y1 ul").slideUp("");
    	   $(".y1 img").rotate(0);
        };
	});
	$(".y2 p,.y2 img").click(function(){
		if($(".y2 ul").is(":hidden")){
    	   var val=1;
    	   $(".y2 ul").slideDown("");	
    	   $(".y2 img").rotate(90*val);	
        }else{
    	   $(".y2 ul").slideUp("");
    	   $(".y2 img").rotate(0);
        };
	});
	//以上为选择项目后出现下拉菜单//
	$(".guanlian").attr("style","display:block;")
    $(".quanxian").attr("style","display:none;")
    $(".shanchu").attr("style","display:none;")
    $(".gl").on('click',function(){
  	$(".guanlian").attr("style","display:block;")
  	$(".quanxian").attr("style","display:none;")
    $(".shanchu").attr("style","display:none;")
    $(this).css("color","#ef8282");
    $(".qx").css("color","#160a71");
    $(".sc").css("color","#160a71");
  });
    $(".qx").on('click',function(){
  	$(".guanlian").attr("style","display:none;")
  	$(".quanxian").attr("style","display:block;")
    $(".shanchu").attr("style","display:none;")
    $(this).css("color","#ef8282");
    $(".gl").css("color","#160a71");
    $(".sc").css("color","#160a71");
  });
    $(".sc").on('click',function(){
  	$(".guanlian").attr("style","display:none;")
  	$(".quanxian").attr("style","display:none;")
    $(".shanchu").attr("style","display:block;")
    $(this).css("color","#ef8282");
    $(".gl").css("color","#160a71");
    $(".qx").css("color","#160a71");
  });
    //以上为第二个模态框
	$(".fanhui").click(function(){
	   $(".xmguanli").attr("style","display:none;");//项目管理表格
	   $(".glyshezhi").attr("style","display:block;");
	   $(".xinzenggs").attr("style","display:none;");
	   $(".xmguanli_nr_main").attr("style","display:none;");
	   // $(".xmguanli_nr").attr("style","display:block;");
	   $(".gsguanli_nr").attr("style","display:none;");
        $(".yujing").attr("style", "display:none;");
        $(".rizhi").attr("style", "display:none;");
	   $(".fenye").attr("style","display:block;");
	   $(".down-1").attr("style","display:block;");//鼠标移动时的列表竖杆
       $(".down-2").attr("style","display:none;");
       $(".x1 p").css("background-color","#d71414")
		$(".x2 p").css("background-color","#c52727")
		$(".down").css("height",743);
	});
	//返回按钮
	 $(".down-2 li").mouseover(function(){
         $(this).css("color","#ef8282");
    });

    $(".down-2 li").mouseout(function(){
        $(this).css("color","white");
     });
    $(".down-2 li").on('click',function(){
    	$(".down-2 li").css("background-color","#d10f0f");
    	$(this).css("background-color","#c20b0b");
    })


    //加
    /*
    关键数据
    */
    $(".y1-1").click(function() {
        $(".xmguanli_nr_main").attr("style", "display:block;");
        $(".g_maincontent1_2").attr("style", "display:none;");
        $(".g_maincontent1_3").attr("style", "display:none;");
        $(".g_maincontent1_4").attr("style", "display:none;");
        $(".g_maincontent1_5").attr("style", "display:none;");
        $(".g_maincontent1_6").attr("style", "display:none;");
        $(".g_maincontent1_7").attr("style", "display:none;");
        $(".yujing").attr("style", "display:none;");
        $(".rizhi").attr("style", "display:none;");
        $(".g_content_right_header").attr("style", "display:block;");
        $(".g_maincontent1_1").attr("style", "display:block;");

        huatu1_1_1();
        huatu1_1_3();
    });

    /*
     关键数据
     */
    $(".y1-1").click(function() {
        $(".xmguanli_nr").attr("style", "display:block;");
        $(".g_maincontent1_2").attr("style", "display:none;");
        $(".g_maincontent1_3").attr("style", "display:none;");
        $(".g_maincontent1_4").attr("style", "display:none;");
        $(".g_maincontent1_5").attr("style", "display:none;");
        $(".g_maincontent1_6").attr("style", "display:none;");
        $(".g_maincontent1_7").attr("style", "display:none;");
        $(".yujing").attr("style", "display:none;");
        $(".rizhi").attr("style", "display:none;");
        $(".g_content_right_header").attr("style", "display:block;");
        $(".g_maincontent1_1").attr("style", "display:block;");

        huatu1_1_1(strnewuser,strnewdevice,strnewdate);
        huatu1_1_3(money,strmdate);
    });

    /*
     新增设备
     */
    $(".y1-2").click(function() {
        $(".xmguanli_nr").attr("style", "display:block;");
        $(".g_maincontent1_1").attr("style", "display:none;");
        $(".g_maincontent1_3").attr("style", "display:none;");
        $(".g_maincontent1_4").attr("style", "display:none;");
        $(".g_maincontent1_5").attr("style", "display:none;");
        $(".g_maincontent1_6").attr("style", "display:none;");
        $(".g_maincontent1_7").attr("style", "display:none;");
        $(".yujing").attr("style", "display:none;");
        $(".rizhi").attr("style", "display:none;");
        $(".g_content_right_header").attr("style", "display:block;");
        $(".g_maincontent1_2").attr("style", "display:block;");

        huatu1_2_1(new_device_y,new_device_x);
        huatu1_2_3(area_dev);
    });

    /*
     新增用户
     */
    $(".y1-3").click(function() {
        $(".xmguanli_nr").attr("style", "display:block;");
        $(".g_maincontent1_1").attr("style", "display:none;");
        $(".g_maincontent1_2").attr("style", "display:none;");
        $(".g_maincontent1_4").attr("style", "display:none;");
        $(".g_maincontent1_5").attr("style", "display:none;");
        $(".g_maincontent1_6").attr("style", "display:none;");
        $(".g_maincontent1_7").attr("style", "display:none;");
        $(".yujing").attr("style", "display:none;");
        $(".rizhi").attr("style", "display:none;");
        $(".g_content_right_header").attr("style", "display:block;");
        $(".g_maincontent1_3").attr("style", "display:block;");

        huatu1_3_1(new_user_y,new_user_x);
        huatu1_3_3(area_user);
    });

    /*
     活跃设备概况
     */
    $(".y1-4").click(function() {
        $(".xmguanli_nr").attr("style", "display:block;");
        $(".g_maincontent1_1").attr("style", "display:none;");
        $(".g_maincontent1_2").attr("style", "display:none;");
        $(".g_maincontent1_3").attr("style", "display:none;");
        $(".g_maincontent1_5").attr("style", "display:none;");
        $(".g_maincontent1_6").attr("style", "display:none;");
        $(".g_maincontent1_7").attr("style", "display:none;");
        $(".yujing").attr("style", "display:none;");
        $(".rizhi").attr("style", "display:none;");
        $(".g_content_right_header").attr("style", "display:block;");
        $(".g_maincontent1_4").attr("style", "display:block;");
        huatu1_4_1(day_active_dev_y,day_active_dev_x);
        huatu1_4_4(already_play_dev_y,already_play_dev_x);
    });

    /*
     活跃玩家概况
     */
    $(".y1-5").click(function() {
        $(".xmguanli_nr").attr("style", "display:block;");
        $(".g_maincontent1_1").attr("style", "display:none;");
        $(".g_maincontent1_2").attr("style", "display:none;");
        $(".g_maincontent1_3").attr("style", "display:none;");
        $(".g_maincontent1_4").attr("style", "display:none;");
        $(".g_maincontent1_6").attr("style", "display:none;");
        $(".g_maincontent1_7").attr("style", "display:none;");
        $(".yujing").attr("style", "display:none;");
        $(".rizhi").attr("style", "display:none;");
        $(".g_content_right_header").attr("style", "display:block;");
        $(".g_maincontent1_5").attr("style", "display:block;");

        huatu1_5_1(day_active_user_y,day_active_user_x);
        huatu1_5_4(already_play_user_y,already_play_user_x);
    });

    /*
     留存用户设备
     */
    $(".y1-6").click(function() {
        $(".xmguanli_nr").attr("style", "display:block;");
        $(".g_maincontent1_1").attr("style", "display:none;");
        $(".g_maincontent1_2").attr("style", "display:none;");
        $(".g_maincontent1_3").attr("style", "display:none;");
        $(".g_maincontent1_4").attr("style", "display:none;");
        $(".g_maincontent1_5").attr("style", "display:none;");
        $(".g_maincontent1_7").attr("style", "display:none;");
        $(".yujing").attr("style", "display:none;");
        $(".rizhi").attr("style", "display:none;");
        $(".g_content_right_header").attr("style", "display:block;");
        $(".g_maincontent1_6").attr("style", "display:block;");

        huatu1_6_1(survive_device_y,survive_device_x);
    });

    /*
     用户系统设备
     */
    $(".y1-7").click(function() {
        $(".xmguanli_nr").attr("style", "display:block;");
        $(".g_maincontent1_1").attr("style", "display:none;");
        $(".g_maincontent1_2").attr("style", "display:none;");
        $(".g_maincontent1_3").attr("style", "display:none;");
        $(".g_maincontent1_4").attr("style", "display:none;");
        $(".g_maincontent1_5").attr("style", "display:none;");
        $(".g_maincontent1_6").attr("style", "display:none;");
        $(".yujing").attr("style", "display:none;");
        $(".rizhi").attr("style", "display:none;");
        $(".g_content_right_header").attr("style", "display:block;");
        $(".g_maincontent1_7").attr("style", "display:block;");
        $(".ul_y1 li").css("color", "white");

        huatu1_7_1(os_x,os_y);
    });

    /*
     波动预警
     */
    $(".y2-1").click(function() {
        $(".xmguanli_nr").attr("style", "display:none;");
        $(".g_maincontent1_1").attr("style", "display:none;");
        $(".g_maincontent1_2").attr("style", "display:none;");
        $(".g_maincontent1_3").attr("style", "display:none;");
        $(".g_maincontent1_4").attr("style", "display:none;");
        $(".g_maincontent1_5").attr("style", "display:none;");
        $(".g_maincontent1_7").attr("style", "display:none;");
        $(".yujing").attr("style", "display:block;");
        $(".rizhi").attr("style", "display:none;");
        $(".g_content_right_header").attr("style", "display:none;");
        $(".g_maincontent1_6").attr("style", "display:none;");

    });

    /*
     运营日志
     */
    $(".y2-2").click(function() {
        $(".xmguanli_nr").attr("style", "display:none;");
        $(".g_maincontent1_1").attr("style", "display:none;");
        $(".g_maincontent1_2").attr("style", "display:none;");
        $(".g_maincontent1_3").attr("style", "display:none;");
        $(".g_maincontent1_4").attr("style", "display:none;");
        $(".g_maincontent1_5").attr("style", "display:none;");
        $(".g_maincontent1_7").attr("style", "display:none;");
        $(".yujing").attr("style", "display:none;");
        $(".rizhi").attr("style", "display:block;");
        $(".g_content_right_header").attr("style", "display:none;");
        $(".g_maincontent1_6").attr("style", "display:none;");

    });

    $('.form_date').datetimepicker({
        pickerPosition: "bottom-left",
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });

    /*
     关键数据：新增用户和设备
     */
    $(".y1-1-1").click(function(){
        huatu1_1_1(strnewuser,strnewdevice,strnewdate);
    });

    /*
     关键数据：活跃玩家和设备
     */
    $(".y1-1-2").click(function(){
        huatu1_1_2(stractiveuser,stractivedevice,stractivedate);
    });

    /*
     关键数据：付费金额
     */
    $(".y1-1-3").click(function(){
        huatu1_1_3(money,strmdate);
    });

    /*
     关键数据：付费用户
     */
    $(".y1-1-4").click(function(){
        huatu1_1_4(pay_user,strpaydate);
    });

    /*
     关键数据：应用下载量
     */
    $(".y1-1-5").click(function(){
        huatu1_1_5(downloaded_y,downloaded_x);
    });

    /*
     新增设备：新增设备数量
     */
    $(".y1-2-1").click(function(){
        huatu1_2_1(new_device_y,new_device_x);
    });

    /*
     新增设备：首次使用时长
     */
    $(".y1-2-2").click(function(){
        huatu1_2_2(dev_first_time_y,dev_first_time_x);
    });


    /*
     新增设备：使用地区
     */
    $(".y1-2-3").click(function(){
        huatu1_2_3();
    });

    /*
     新增用户：新增用户数量
     */
    $(".y1-3-1").click(function(){
        huatu1_3_1(new_user_y,new_user_x);
    });

    /*
     新增用户：首次使用时长
     */
    $(".y1-3-2").click(function(){
        huatu1_3_2(user_first_time_y,user_first_time_x);
    });

    /*
     新增用户：地区分布
     */
    $(".y1-3-3").click(function(){
        huatu1_3_3();
    });

    /*
     活跃设备概况：日活跃设备
     */
    $(".y1-4-1").click(function(){
        huatu1_4_1(day_active_dev_y,day_active_dev_x);
    });

    /*
     活跃设备概况：周活跃设备
     */
    $(".y1-4-2").click(function(){
        huatu1_4_2(week_active_dev_y,week_active_dev_x);
    });

    /*
     活跃设备概况：月活跃设备
     */
    $(".y1-4-3").click(function(){
        huatu1_4_3(month_active_dev_y,month_active_dev_x);
    });

    /*
     活跃设备概况：已用天数
     */
    $(".y1-4-4").click(function(){
        huatu1_4_4(already_play_dev_y,already_play_dev_x);
    });

    /*
     活跃玩家概况：日活跃玩家
     */
    $(".y1-5-1").click(function(){
        huatu1_5_1(day_active_user_y,day_active_user_x);
    });

    /*
     活跃玩家概况：周活跃玩家
     */
    $(".y1-5-2").click(function(){
        huatu1_5_2(week_active_user_y,week_active_user_x);
    });

    /*
     活跃玩家概况：月活跃玩家
     */
    $(".y1-5-3").click(function(){
        huatu1_5_3(month_active_user_y,month_active_user_x);
    });

    /*
     活跃玩家概况：已用天数
     */
    $(".y1-5-4").click(function(){
        huatu1_5_4(already_play_user_y,already_play_user_x);
    });


    /*
     留存用户设备：设备留存
     */
    $(".y1-6-1").click(function(){
        huatu1_6_1(survive_device_y,survive_device_x);
    });

    /*
     留存用户设备：用户留存
     */
    $(".y1-6-2").click(function(){
        huatu1_6_2(survive_user_y,survive_user_x);
    });

    /*
     用户系统设备：操作系统
     */
    $(".y1-7-1").click(function(){
        huatu1_7_1(os_x,os_y);
    });

    /*
     用户系统设备：联网方式
     */
    $(".y1-7-2").click(function(){
        huatu1_7_2(ci_x,ci_y);
    });

    /*
     用户系统设备：运营商
     */
    $(".y1-7-3").click(function(){
        huatu1_7_3(co_x,co_y);
    });

    /*
     用户系统设备：设备型号
     */
    $(".y1-7-4").click(function(){
        huatu1_7_4(pt_x,pt_y);
    });

        $(".down-2 ul li,.chakan").click(function() {
        if ($(".down").height() < $(".content_right").height() - 137) {
            $(".down").css("height", $(".content_right").height() - 137);
            console.log($(".content_right").height() - 137);
        } else {
            $(".down").css("height", 743);
        }
    });

    $("#date_start").val(getAgoDay(7));
    $("#date_end").val(getAgoDay(1));

    $("#queding").click(function() {

        var self = $(this);
        var app_id = self.attr("name");

        var startTime =  $("#date_start").val();
        var endTime =   $("#date_end").val();

        if (startTime == "" || endTime == "") {

        }

        else {

            var startNum = parseInt(startTime.replace(/-/g, ''), 10);

            var endNum = parseInt(endTime.replace(/-/g, ''), 10);

            var currentTime = parseInt(getCurrentTime().replace(/-/g, ''), 10);

            if(startNum >= currentTime || endNum  >= currentTime){
                alert("起始，截至日期均不得等于或大于当前日期！"+getCurrentTime());
            }
            else{
                if (startNum > endNum) {

                    alert("结束时间不能在开始时间之前！");

                }

                else {
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

                }
            }

        }

    });

    $("#last_day").click(function() {
        var self = $(".btn-default");
        var app_id = self.attr("name");

        $("#date_start").val(getAgoDay(1));
        $("#date_end").val(getAgoDay(1));
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
    });

    $("#7_day").click(function() {
        var self = $(".btn-default");
        var app_id = self.attr("name");

        $("#date_start").val(getAgoDay(7));
        $("#date_end").val(getAgoDay(1));
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
    });

    $("#30_day").click(function() {
        var self = $(".btn-default");
        var app_id = self.attr("name");

        $("#date_start").val(getAgoDay(30));
        $("#date_end").val(getAgoDay(1));
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
    });

    $("#all_day").click(function() {
        var self = $(".btn-default");
        var app_id = self.attr("name");

        $("#date_start").val(getAgoDay(30));
        $("#date_end").val(getAgoDay(1));
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
    });
    //加

    //分页
    pager({
    	totalpages:5,
    	firstpage:$("#first"),
    	nextpage:$("#next"),
    	prepage:$("#pre"),
    	lastpage:$("#last"),
    	callback:function(current){
    		alert(current);
    	}
    });
});

function pager(option){
	var totalpages = option.totalpages;
	var firstpage = option.firstpage;
	var lastpage = option.lastpage;
	var prepage = option.prepage;
	var nextpage = option.nextpage;
	var callback = option.callback;

	var current = 1;
	firstpage.attr("disabled","true");
	prepage.attr("disabled","true");

	var change = function(){
		if(current <= 1){
			firstpage.attr("disabled","true");
			prepage.attr("disabled","true");
			nextpage.attr("disabled","false");
			lastpage.attr("disabled","false");
		}else if(current > 1 && current < totalpages){
			firstpage.attr("disabled","false");
			prepage.attr("disabled","false");
			nextpage.attr("disabled","false");
			lastpage.attr("disabled","false");
		}else{
			firstpage.attr("disabled","false");
			prepage.attr("disabled","false");
			nextpage.attr("disabled","true");
			lastpage.attr("disabled","true");
		}
		callback(current);
	}

	prepage.click(function(){
		if(current == 1){
			return;
		}
		current--;
		change();
	});
	nextpage.click(function(){
		if(current == totalpages){
			return;
		}
		current++;
		change();
	});
	firstpage.click(function(){
		if(current == 1){
			return;
		}
		current = 1;
		change();
	});
	lastpage.click(function(){
		if(current == totalpages){
			return;
		}
		current = totalpages;
		change();
	});
}