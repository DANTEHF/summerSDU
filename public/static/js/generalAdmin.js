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
        $(".g_ul1").attr("style", "display:none;");
        $(".rizhi").attr("style", "display:none;");
        $(".yujing").attr("style", "display:none;");

        $(".g_p3").click(function() {
            if($(".g_ul1").is(":hidden")){
                var val=1;
                $(".g_ul1").slideDown("");
                $(".g_l1").rotate(90*val);
            }else{
                $(".g_ul1").slideUp("");
                $(".g_l1").rotate(0);
            };
        });

        $(".g_shitu2").attr("style", "display:none;");



        $(".g_ul1").on('click','ol li',function() {
            $(".g_shitu2").attr("style","display:block;");
            $(".g_p3,.g_ul1").attr("style","display:none;");
            $(".g_p_hide").attr("style","display:none;");
            $("#xiangmu_name").text($(this).text());
            $(".g_maincontent1_2").attr("style","display:none;");
            $(".g_maincontent1_3").attr("style","display:none;");
            $(".g_maincontent1_4").attr("style","display:none;");
            $(".g_maincontent1_5").attr("style","display:none;");
            $(".g_maincontent1_6").attr("style","display:none;");
            $(".g_maincontent1_7").attr("style","display:none;");
            $(".rizhi").attr("style", "display:none;");
            $(".yujing").attr("style", "display:none;");
            $(".g_content_right_header").attr("style","display:block;");
            $(".g_maincontent1_1").attr("style","display:block;");
            $(".g_down").css("height",$(".g_content_right").height()-131);

            //修改
            var self = $(this);
            var app_id = self.attr("name");
            $(".btn-default").attr("name", self.attr("name"));

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

            //获取用户权限
            //getPermission(app_id);
        });

        $(".g_ul2").attr("style", "display:none;");

        $(".g_ul3").attr("style", "display:none;");

        $(".g_p4 p,.g_l2").click(function() {
            if($(".g_ul2").is(":hidden")){
                var val=1;
                $(".g_ul2").slideDown("");
                $(".g_l2").rotate(90*val);
            }else{
                $(".g_ul2").slideUp("");
                $(".g_l2").rotate(0);
            };
        });

        $(".g_p5 b,.g_l3").click(function() {
            if($(".g_ul3").is(":hidden")){
                var val=1;
                $(".g_ul3").slideDown("");
                $(".g_l3").rotate(90*val);
            }else{
                $(".g_ul3").slideUp("");
                $(".g_l3").rotate(0);
            };
        });

        $(".g_fanhui").click(function(){
            $(".g_shitu2").attr("style","display:none;");
            $(".g_p3,.g_ul1").attr("style","display:block;");
            $(".g_p_hide").attr("style","display:block;");
            $(".g_content_right_header").attr("style","display:none;");
            $(".g_maincontent1_1").attr("style","display:none;");
            $(".g_maincontent1_2").attr("style","display:none;");
            $(".g_maincontent1_3").attr("style","display:none;");
            $(".g_maincontent1_4").attr("style","display:none;");
            $(".g_maincontent1_5").attr("style","display:none;");
            $(".g_maincontent1_6").attr("style","display:none;");
            $(".g_maincontent1_7").attr("style","display:none;");
            $(".rizhi").attr("style", "display:none;");
            $(".yujing").attr("style", "display:none;");
            $(".g_down").css("height",$(".g_content_right").height()-131);
        });

        $(".g_ul1 ").on('mouseover','ol li',function() {
            $(this).css("color","#ef8282");
        });
        $(".g_ul1 ").on('mouseout','ol li',function() {
            $(this).css("color","white");
        });

        $("li").on({
            mouseover:function(){$(this).css("color","#ef8282");},
            mouseout:function(){$(this).css("color","white");}
        });

        $(".g_content_right_header").attr("style","display:none;");
        $(".g_maincontent1_1").attr("style","display:none;");
        $(".g_maincontent1_2").attr("style","display:none;");
        $(".g_maincontent1_3").attr("style","display:none;");
        $(".g_maincontent1_4").attr("style","display:none;");
        $(".g_maincontent1_5").attr("style","display:none;");
        $(".g_maincontent1_6").attr("style","display:none;");
        $(".g_maincontent1_7").attr("style","display:none;");
        $(".rizhi").attr("style", "display:none;");
        $(".yujing").attr("style", "display:none;");
        /*
         关键数据
         */
        $(".g_ul2-1").click(function(){
            $(".g_maincontent1_2").attr("style","display:none;");
            $(".g_maincontent1_3").attr("style","display:none;");
            $(".g_maincontent1_4").attr("style","display:none;");
            $(".g_maincontent1_5").attr("style","display:none;");
            $(".g_maincontent1_6").attr("style","display:none;");
            $(".g_maincontent1_7").attr("style","display:none;");
            $(".rizhi").attr("style", "display:none;");
            $(".yujing").attr("style", "display:none;");
            $(".g_content_right_header").attr("style","display:block;");
            $(".g_maincontent1_1").attr("style","display:block;");
            $(".g_ul2 li").css("background-color","#d71414");
            $(".g_ul2-1").css("background-color","#e42e2e");
            huatu1_1_1(strnewuser,strnewdevice,strnewdate);
            huatu1_1_3(money,strmdate);
        });

        /*
         新增设备
         */
        $(".g_ul2-2").click(function(){
            $(".g_maincontent1_1").attr("style","display:none;");
            $(".g_maincontent1_3").attr("style","display:none;");
            $(".g_maincontent1_4").attr("style","display:none;");
            $(".g_maincontent1_5").attr("style","display:none;");
            $(".g_maincontent1_6").attr("style","display:none;");
            $(".g_maincontent1_7").attr("style","display:none;");
            $(".rizhi").attr("style", "display:none;");
            $(".yujing").attr("style", "display:none;");
            $(".g_content_right_header").attr("style","display:block;");
            $(".g_maincontent1_2").attr("style","display:block;");
            $(".g_ul2 li").css("background-color","#d71414");
            $(".g_ul2-2").css("background-color","#e42e2e");
            huatu1_2_1(new_device_y,new_device_x);
            huatu1_2_3(area_dev);
        });

        /*
         新增用户
         */
        $(".g_ul2-3").click(function(){
            $(".g_maincontent1_1").attr("style","display:none;");
            $(".g_maincontent1_2").attr("style","display:none;");
            $(".g_maincontent1_4").attr("style","display:none;");
            $(".g_maincontent1_5").attr("style","display:none;");
            $(".g_maincontent1_6").attr("style","display:none;");
            $(".g_maincontent1_7").attr("style","display:none;");
            $(".rizhi").attr("style", "display:none;");
            $(".yujing").attr("style", "display:none;");
            $(".g_content_right_header").attr("style","display:block;");
            $(".g_maincontent1_3").attr("style","display:block;");
            $(".g_ul2 li").css("background-color","#d71414");
            $(".g_ul2-3").css("background-color","#e42e2e");
            huatu1_3_1(new_user_y,new_user_x);
            huatu1_3_3(area_user);
        });

        /*
         活跃设备概况
         */
        $(".g_ul2-4").click(function(){
            $(".g_maincontent1_1").attr("style","display:none;");
            $(".g_maincontent1_2").attr("style","display:none;");
            $(".g_maincontent1_3").attr("style","display:none;");
            $(".g_maincontent1_5").attr("style","display:none;");
            $(".g_maincontent1_6").attr("style","display:none;");
            $(".g_maincontent1_7").attr("style","display:none;");
            $(".rizhi").attr("style", "display:none;");
            $(".yujing").attr("style", "display:none;");
            $(".g_content_right_header").attr("style","display:block;");
            $(".g_maincontent1_4").attr("style","display:block;");
            $(".g_ul2 li").css("background-color","#d71414");
            $(".g_ul2-4").css("background-color","#e42e2e");
            huatu1_4_1(day_active_dev_y,day_active_dev_x);
            huatu1_4_4(already_play_dev_y,already_play_dev_x);
        });

        /*
         活跃玩家概况
         */
        $(".g_ul2-5").click(function(){
            $(".g_maincontent1_1").attr("style","display:none;");
            $(".g_maincontent1_2").attr("style","display:none;");
            $(".g_maincontent1_3").attr("style","display:none;");
            $(".g_maincontent1_4").attr("style","display:none;");
            $(".g_maincontent1_6").attr("style","display:none;");
            $(".g_maincontent1_7").attr("style","display:none;");
            $(".rizhi").attr("style", "display:none;");
            $(".yujing").attr("style", "display:none;");
            $(".g_content_right_header").attr("style","display:block;");
            $(".g_maincontent1_5").attr("style","display:block;");
            $(".g_ul2 li").css("background-color","#d71414");
            $(".g_ul2-5").css("background-color","#e42e2e");
            huatu1_5_1(day_active_user_y,day_active_user_x);
            huatu1_5_4(already_play_user_y,already_play_user_x);
        });

        /*
         留存用户设备
         */
        $(".g_ul2-6").click(function(){
            $(".g_maincontent1_1").attr("style","display:none;");
            $(".g_maincontent1_2").attr("style","display:none;");
            $(".g_maincontent1_3").attr("style","display:none;");
            $(".g_maincontent1_4").attr("style","display:none;");
            $(".g_maincontent1_5").attr("style","display:none;");
            $(".g_maincontent1_7").attr("style","display:none;");
            $(".rizhi").attr("style", "display:none;");
            $(".yujing").attr("style", "display:none;");
            $(".g_content_right_header").attr("style","display:block;");
            $(".g_maincontent1_6").attr("style","display:block;");
            $(".g_ul2 li").css("background-color","#d71414");
            $(".g_ul2-6").css("background-color","#e42e2e");
            huatu1_6_1(survive_device_y,survive_device_x);
        });

        /*
         用户系统设备
         */
        $(".g_ul2-7").click(function(){
            $(".g_maincontent1_1").attr("style","display:none;");
            $(".g_maincontent1_2").attr("style","display:none;");
            $(".g_maincontent1_3").attr("style","display:none;");
            $(".g_maincontent1_4").attr("style","display:none;");
            $(".g_maincontent1_5").attr("style","display:none;");
            $(".g_maincontent1_6").attr("style","display:none;");
            $(".rizhi").attr("style", "display:none;");
            $(".yujing").attr("style", "display:none;");
            $(".g_content_right_header").attr("style","display:block;");
            $(".g_maincontent1_7").attr("style","display:block;");
            $(".g_ul2 li").css("color","white");
            $(".g_ul2 li").css("background-color","#d71414");
            $(".g_ul2-7").css("background-color","#e42e2e");
            huatu1_7_1(os_x,os_y);
        });

        $('.form_date').datetimepicker({
            pickerPosition: "bottom-left",
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0
        });


        /*
         波动预警
         */
        $(".g_ul3-1").click(function(){
            $(".g_maincontent1_1").attr("style","display:none;");
            $(".g_maincontent1_2").attr("style","display:none;");
            $(".g_maincontent1_3").attr("style","display:none;");
            $(".g_maincontent1_4").attr("style","display:none;");
            $(".g_maincontent1_5").attr("style","display:none;");
            $(".g_maincontent1_6").attr("style","display:none;");
            $(".rizhi").attr("style", "display:none;");
            $(".yujing").attr("style", "display:block;");
            $(".g_content_right_header").attr("style","display:none;");
            $(".g_maincontent1_7").attr("style","display:none;");
        });

        /*
         运营日志
         */
        $(".g_ul3-2").click(function(){
            $(".g_maincontent1_1").attr("style","display:none;");
            $(".g_maincontent1_2").attr("style","display:none;");
            $(".g_maincontent1_3").attr("style","display:none;");
            $(".g_maincontent1_4").attr("style","display:none;");
            $(".g_maincontent1_5").attr("style","display:none;");
            $(".g_maincontent1_6").attr("style","display:none;");
            $(".rizhi").attr("style", "display:block;");
            $(".yujing").attr("style", "display:none;");
            $(".g_content_right_header").attr("style","display:none;");
            $(".g_maincontent1_7").attr("style","display:none;");
        });

        /*
         关键数据：新增用户和设备
         */
        $(".g_ul2-1-1").click(function(){
            huatu1_1_1(strnewuser,strnewdevice,strnewdate);
        });

        /*
         关键数据：活跃玩家和设备
         */
        $(".g_ul2-1-2").click(function(){
            huatu1_1_2(stractiveuser,stractivedevice,stractivedate);
        });

        /*
         关键数据：付费金额
         */
        $(".g_ul2-1-3").click(function(){
            huatu1_1_3(money,strmdate);
        });

        /*
         关键数据：付费用户
         */
        $(".g_ul2-1-4").click(function(){
            huatu1_1_4(pay_user,strpaydate);
        });

        /*
         关键数据：应用下载量
         */
        $(".g_ul2-1-5").click(function(){
            huatu1_1_5(downloaded_y,downloaded_x);
        });

        /*
         新增设备：新增设备数量
         */
        $(".g_ul2-2-1").click(function(){
            huatu1_2_1(new_device_y,new_device_x);
        });

        /*
         新增设备：首次使用时长
         */
        $(".g_ul2-2-2").click(function(){
            huatu1_2_2(dev_first_time_y,dev_first_time_x);
        });


        /*
         新增设备：使用地区
         */
        $(".g_ul2-2-3").click(function(){
            huatu1_2_3();
        });

        /*
         新增用户：新增用户数量
         */
        $(".g_ul2-3-1").click(function(){
            huatu1_3_1(new_user_y,new_user_x);
        });

        /*
         新增用户：首次使用时长
         */
        $(".g_ul2-3-2").click(function(){
            huatu1_3_2(user_first_time_y,user_first_time_x);
        });

        /*
         新增用户：地区分布
         */
        $(".g_ul2-3-3").click(function(){
            huatu1_3_3();
        });

        /*
         活跃设备概况：日活跃设备
         */
        $(".g_ul2-4-1").click(function(){
            huatu1_4_1(day_active_dev_y,day_active_dev_x);
        });

        /*
         活跃设备概况：周活跃设备
         */
        $(".g_ul2-4-2").click(function(){
            huatu1_4_2(week_active_dev_y,week_active_dev_x);
        });

        /*
         活跃设备概况：月活跃设备
         */
        $(".g_ul2-4-3").click(function(){
            huatu1_4_3(month_active_dev_y,month_active_dev_x);
        });

        /*
         活跃设备概况：已用天数
         */
        $(".g_ul2-4-4").click(function(){
            huatu1_4_4(already_play_dev_y,already_play_dev_x);
        });

        /*
         活跃玩家概况：日活跃玩家
         */
        $(".g_ul2-5-1").click(function(){
            huatu1_5_1(day_active_user_y,day_active_user_x);
        });

        /*
         活跃玩家概况：周活跃玩家
         */
        $(".g_ul2-5-2").click(function(){
            huatu1_5_2(week_active_user_y,week_active_user_x);
        });

        /*
         活跃玩家概况：月活跃玩家
         */
        $(".g_ul2-5-3").click(function(){
            huatu1_5_3(month_active_user_y,month_active_user_x);
        });

        /*
         活跃玩家概况：已用天数
         */
        $(".g_ul2-5-4").click(function(){
            huatu1_5_4(already_play_user_y,already_play_user_x);
        });


        /*
         留存用户设备：设备留存
         */
        $(".g_ul2-6-1").click(function(){
            huatu1_6_1(survive_device_y,survive_device_x);
        });

        /*
         留存用户设备：用户留存
         */
        $(".g_ul2-6-2").click(function(){
            huatu1_6_2(survive_user_y,survive_user_x);
        });

        /*
         用户系统设备：操作系统
         */
        $(".g_ul2-7-1").click(function(){
            huatu1_7_1(os_x,os_y);
        });

        /*
         用户系统设备：联网方式
         */
        $(".g_ul2-7-2").click(function(){
            huatu1_7_2(ci_x,ci_y);
        });

        /*
         用户系统设备：运营商
         */
        $(".g_ul2-7-3").click(function(){
            huatu1_7_3(co_x,co_y);
        });

        /*
         用户系统设备：设备型号
         */
        $(".g_ul2-7-4").click(function(){
            huatu1_7_4(pt_x,pt_y);
        });

        //左边自适应高度
        $(".g_shuju ul li").click(function(){
            if($(".g_content_left").height() < $(".g_content_right").height()){
                $(".g_down").css("height",$(".g_content_right").height()-131);
            }else{
                $(".g_down").css("height",$(".g_content_right").height()-131);
            }
        });


        $("#date_start").val(getAgoDay(7));
        $("#date_end").val(getAgoDay(1));

        $("#queding").click(function(){

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

            //var day = DateDiff(startTime,endTime) + 1;
            // day = getCurrentTime();
            // console.log(day);
        });

        $("#last_day").click(function(){
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

        $("#7_day").click(function(){
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

        $("#30_day").click(function(){
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

        $("#all_day").click(function(){
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

    });