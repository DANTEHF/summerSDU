//存APP_id  ，加载APP列表
$.ajax({
        url:"a/getlist",
        type:"GET",
        data:{

        },

        success:function(data){
            //console.log(data);
            var array=data.data;

            for(var i=0;i<array.length;i++){
                console.log(array[i].id+"---"+array[i].name);
                $("#applist").append("<li name='"+array[i].id+"'>" + array[i].name + " </li>");
            }
            //$(".g_ul1").innerHTML()
        }

    });

//新增用户和设备
function interraction1_1(startTime,endTime,app_id) {
    $.ajax({
        url:"d/newuserdev",
        type:"GET",
        data:{

            "starttime": startTime,
            "endtime": endTime,
            "app_id": app_id,
        },
        success:function(data){


            var array=data.data;
            var obj=JSON.parse(array);
            var arr_newuser = obj.new_user;
            var arr_newdevice = obj.new_device;
            strnewuser = new Array();
            for(var i=0;i<arr_newuser.length;i++){
                strnewuser.push(arr_newuser[i].new_user);
            }

            strnewdevice = new Array();
            for(var i=0;i<arr_newdevice.length;i++){
                strnewdevice.push(arr_newdevice[i].new_device);
            }

            strnewdate = new Array();
            for(var i=0;i<arr_newdevice.length;i++){
                strnewdate.push(arr_newdevice[i].datetime);
            }
            huatu1_1_1(strnewuser,strnewdevice,strnewdate);
        }

    });
}

//活跃玩家和设备
function  interaction1_2(startTime,endTime,app_id) {
    $.ajax({
        url:"d/activeuserdev",
        type:"GET",
        data:{
            "starttime": startTime,
            "endtime": endTime,
            "app_id": app_id,
        },
        success:function(data){


            var array=data.data;
            var obj=JSON.parse(array);
            var arr_user = obj.active_user;
            var arr_device = obj.active_device;
            stractiveuser = new Array();
            for(var i=0;i<arr_user.length;i++){
                stractiveuser.push(arr_user[i].active_user);
            }

            stractivedevice = new Array();
            for(var i=0;i<arr_device.length;i++){
                stractivedevice.push(arr_device[i].active_device);
            }

            stractivedate = new Array();
            for(var i=0;i<arr_device.length;i++){
                stractivedate.push(arr_device[i].datetime);
            }
        }

    });
}

//付费金额
function  interaction1_3(startTime,endTime,app_id) {
    $.ajax({
        url:"d/paymoney",
        type:"GET",
        data:{

            "starttime": startTime,
            "endtime": endTime,
            "app_id": app_id,
        },
        success:function(data){


            var array=data.data;
            var obj=JSON.parse(array);
            var arr = obj.pay_money;

            money = new Array();
            for(var i=0;i<arr.length;i++){
                money.push(arr[i].pay_money);
            }

            strmdate = new Array();
            for(var i=0;i<arr.length;i++){
                strmdate.push(arr[i].datetime);
            }
            huatu1_1_3(money,strmdate);
        }

    });
}

//付费用户
function interaction1_4(startTime,endTime,app_id) {
    $.ajax({
        url:"d/payuser",
        type:"GET",
        data:{

            "starttime": startTime,
            "endtime": endTime,
            "app_id": app_id,
        },
        success:function(data){

            var array=data.data;
            var obj=JSON.parse(array);
            var arr = obj.pay_user_count;

            pay_user = new Array();
            for(var i=0;i<arr.length;i++){
                pay_user.push(arr[i].pay_user_count);
            }

            strpaydate = new Array();
            for(var i=0;i<arr.length;i++){
                strpaydate.push(arr[i].datetime);
            }

        }

    });
}

//应用下载量
function interaction1_5(startTime,endTime,app_id) {
    $.ajax({
        url:"d/download",
        type:"GET",
        data:{

            "starttime": startTime,
            "endtime": endTime,
            "app_id": app_id,
        },
        success:function(data){

            var array=data.data;
            var obj=JSON.parse(array);
            var arr = obj.downloaded_count;

            downloaded_y = new Array();
            for(var i=0;i<arr.length;i++){
                downloaded_y.push(arr[i].count);
            }
            downloaded_x = new Array();
            for(var i=0;i<arr.length;i++){
                downloaded_x.push(arr[i].date);
            }

        }

    });
}

//新增设备数量
function interaction2_1(startTime,endTime,app_id) {
    $.ajax({
        url:"d/newdev",
        type:"GET",
        data:{

            "starttime": startTime,
            "endtime": endTime,
            "app_id": app_id,
        },
        success:function(data){

            var array=data.data;
            var obj=JSON.parse(array);
            var arr = obj.new_device;

            new_device_y = new Array();
            for(var i=0;i<arr.length;i++){
                new_device_y.push(arr[i].new_device);
            }
            new_device_x = new Array();
            for(var i=0;i<arr.length;i++){
                new_device_x.push(arr[i].datetime);
            }

        }

    });
}

//设备首次使用时长
function interaction2_2(app_id) {
    $.ajax({
        url:"d/devfirsttime",
        type:"GET",
        data:{
            "app_id": app_id,
        },
        success:function(data){
            //console.log(data);
            var array=data.data;
            var obj=JSON.parse(array);

            dev_first_time_x = ["1-4s","5-10s","11-30s","31-60s","1-3m","4-10m","11-30m","31-60m","60-m"];
            dev_first_time_y = new Array();
            arr1= obj.dev_first_time[0];
            dev_first_time_y.push(arr1['1_4s']);
            dev_first_time_y.push(arr1['5_10s']);
            dev_first_time_y.push(arr1['11_30s']);
            dev_first_time_y.push(arr1['31_60s']);
            dev_first_time_y.push(arr1['1_3m']);
            dev_first_time_y.push(arr1['4_10m']);
            dev_first_time_y.push(arr1['11_30m']);
            dev_first_time_y.push(arr1['31_60m']);
            dev_first_time_y.push(arr1['60_m']);

        }

    });
}

//新增用户数量
function interaction3_1(startTime,endTime,app_id) {
    $.ajax({
        url:"d/newuser",
        type:"GET",
        data:{

            "starttime": startTime,
            "endtime": endTime,
            "app_id": app_id,
        },
        success:function(data){
            console.log(data);
            var array=data.data;
            var obj=JSON.parse(array);
            var arr = obj.new_user;

            new_user_y = new Array();
            for(var i=0;i<arr.length;i++){
                new_user_y.push(arr[i].new_user);
            }
            new_user_x = new Array();
            for(var i=0;i<arr.length;i++){
                new_user_x.push(arr[i].datetime);
            }

        }

    });
}

//用户首次使用时长
function interaction3_2(app_id) {

    $.ajax({
        url:"d/userfirsttime",
        type:"GET",
        data:{
            "app_id": app_id,
        },
        success:function(data){
            var array=data.data;
            var obj=JSON.parse(array);

            user_first_time_x = ["1-4s","5-10s","11-30s","31-60s","1-3m","4-10m","11-30m","31-60m","60-m"];
            user_first_time_y = new Array();
            arr1= obj.user_first_time[0];
            user_first_time_y.push(arr1['1_4s']);
            user_first_time_y.push(arr1['5_10s']);
            user_first_time_y.push(arr1['11_30s']);
            user_first_time_y.push(arr1['31_60s']);
            user_first_time_y.push(arr1['1_3m']);
            user_first_time_y.push(arr1['4_10m']);
            user_first_time_y.push(arr1['11_30m']);
            user_first_time_y.push(arr1['31_60m']);
            user_first_time_y.push(arr1['60_m']);
        }

    });
}

//日活跃设备
function interaction4_1(startTime,endTime,app_id) {
    $.ajax({
        url:"d/dayactivedev",
        type:"GET",
        data:{

            "starttime": startTime,
            "endtime": endTime,
            "app_id": app_id,
        },
        success:function(data){

            var array=data.data;
            var obj=JSON.parse(array);
            var arr = obj.day_active_dev;

            day_active_dev_y = new Array();
            for(var i=0;i<arr.length;i++){
                day_active_dev_y.push(arr[i].active_device);
            }
            day_active_dev_x = new Array();
            for(var i=0;i<arr.length;i++){
                day_active_dev_x.push(arr[i].datetime);
            }
        }
    });
}

//周活跃设备
function interaction4_2(startTime,endTime,app_id) {
    $.ajax({
        url:"d/weekactivedev",
        type:"GET",
        data:{

            "starttime": startTime,
            "endtime": endTime,
            "app_id": app_id,
        },
        success:function(data){

            var array=data.data;
            var obj=JSON.parse(array);
            var arr = obj.week_active_dev;

            week_active_dev_y = new Array();
            for(var i=0;i<arr.length;i++){
                week_active_dev_y.push(arr[i].active_device);
            }
            week_active_dev_x = new Array();
            for(var i=0;i<arr.length;i++){
                week_active_dev_x.push(arr[i].datetime);
            }

        }

    });
}

//月活跃设备
function interaction4_3(startTime,endTime,app_id) {
    $.ajax({
        url:"d/monthactivedev",
        type:"GET",
        data:{

            "starttime": startTime,
            "endtime": endTime,
            "app_id": app_id,
        },
        success:function(data){

            var array=data.data;
            var obj=JSON.parse(array);
            var arr = obj.month_active_dev;

            month_active_dev_y = new Array();
            for(var i=0;i<arr.length;i++){
                month_active_dev_y.push(arr[i].active_device);
            }
            month_active_dev_x = new Array();
            for(var i=0;i<arr.length;i++){
                month_active_dev_x.push(arr[i].datetime);
            }

        }

    });
}

//设备已用天数
function interaction4_4(app_id) {
    $.ajax({
        url:"d/alreadyplaydev",
        type:"GET",
        data:{
            "app_id": app_id,
        },
        success:function(data){

            var arr=data.data;
            //console.log(arr);
            //var arr=JSON.parse(array);

            already_play_dev_x = ["1d","2-3d","4-7d","8-14d","15-30d","31-90d","91-180d","181-365dm","365+d"];
            already_play_dev_y = new Array();
            already_play_dev_y.push(arr['1d']);
            already_play_dev_y.push(arr['2_3d']);
            already_play_dev_y.push(arr['4_7d']);
            already_play_dev_y.push(arr['8_14d']);
            already_play_dev_y.push(arr['15_30d']);
            already_play_dev_y.push(arr['31_90d']);
            already_play_dev_y.push(arr['91_180d']);
            already_play_dev_y.push(arr['181_365d']);
            already_play_dev_y.push(arr['365_d']);

        }

    });
}

//日活跃用户
function interaction5_1(startTime,endTime,app_id) {
    $.ajax({
        url:"d/dayactiveuser",
        type:"GET",
        data:{
            "starttime": startTime,
            "endtime": endTime,
            "app_id": app_id ,
        },
        success:function(data){
            //console.log(data);

            var array=data.data;
            var obj=JSON.parse(array);
            var arr = obj.day_active_user;

            day_active_user_y = new Array();
            for(var i=0;i<arr.length;i++){
                day_active_user_y.push(arr[i].active_user);
            }
            day_active_user_x = new Array();
            for(var i=0;i<arr.length;i++){
                day_active_user_x.push(arr[i].datetime);
            }

        }

    });
}

//周活跃用户
function interaction5_2(startTime,endTime,app_id) {
    $.ajax({
        url:"d/weekactiveuser",
        type:"GET",
        data:{
            "starttime": startTime,
            "endtime": endTime,
            "app_id": app_id,
        },
        success:function(data){

            var array=data.data;
            var obj=JSON.parse(array);
            var arr = obj.week_active_user;

            week_active_user_y = new Array();
            for(var i=0;i<arr.length;i++){
                week_active_user_y.push(arr[i].active_user);
            }
            week_active_user_x = new Array();
            for(var i=0;i<arr.length;i++){
                week_active_user_x.push(arr[i].datetime);
            }

        }

    });
}

//月活跃用户
function interaction5_3(startTime,endTime,app_id) {
    $.ajax({
        url:"d/monthactiveuser",
        type:"GET",
        data:{
            "starttime": startTime,
            "endtime": endTime,
            "app_id": app_id,
        },
        success:function(data){

            var array=data.data;
            var obj=JSON.parse(array);
            var arr = obj.month_active_user;

            month_active_user_y = new Array();
            for(var i=0;i<arr.length;i++){
                month_active_user_y.push(arr[i].active_user);
            }
            month_active_user_x = new Array();
            for(var i=0;i<arr.length;i++){
                month_active_user_x.push(arr[i].datetime);
            }

        }

    });
}

//用户已用天数
function interaction5_4(app_id) {
    $.ajax({
        url:"d/alreadyplayuser",
        type:"GET",
        data:{
            "app_id": app_id,
        },
        success:function(data){
            var arr=data.data;
            //var array=data.data;
            //var arr=JSON.parse(array);

            already_play_user_x = ["1d","2-3d","4-7d","8-14d","15-30d","31-90d","91-180d","181-365dm","365+d"];
            already_play_user_y = new Array();
            already_play_user_y.push(arr['1d']);
            already_play_user_y.push(arr['2_3d']);
            already_play_user_y.push(arr['4_7d']);
            already_play_user_y.push(arr['8_14d']);
            already_play_user_y.push(arr['15_30d']);
            already_play_user_y.push(arr['31_90d']);
            already_play_user_y.push(arr['91_180d']);
            already_play_user_y.push(arr['181_365d']);
            already_play_user_y.push(arr['365_d']);


        }

    });
}

//设备留存
function interaction6_1(startTime,endTime,app_id) {
    $.ajax({
        url:"d/devicesurvive",
        type:"GET",
        data:{
            "starttime": startTime,
            "endtime": endTime,
            "app_id": app_id,
        },
        success:function(data){

            var array=data.data;
            var obj=JSON.parse(array);
            arr = obj.survive_device;

            survive_device_x = new Array();
            for(var i=0;i<arr.length;i++){
                survive_device_x.push(arr[i].date);
            }
            survive_device_y = new Array();
            for(var i=0;i<arr.length;i++){
                survive_device_y.push(arr[i].today);
            }

        }

    });
}
//用户留存
function interaction6_2(startTime,endTime,app_id) {
    $.ajax({
        url:"d/usersurvive",
        type:"GET",
        data:{
            "starttime": startTime,
            "endtime": endTime,
            "app_id": app_id,
        },
        success:function(data){

            var array=data.data;
            var obj=JSON.parse(array);
            arr = obj.survive_user;

            survive_user_x = new Array();
            for(var i=0;i<arr.length;i++){
                survive_user_x.push(arr[i].date);
            }
            survive_user_y = new Array();
            for(var i=0;i<arr.length;i++){
                survive_user_y.push(arr[i].today);
            }
        }
    });
}

//操作系统
function interaction7_1(startTime,endTime,app_id) {
    $.ajax({
        url:"d/app/"+app_id+"/au/os",
        type:"GET",
        data:{
            "starttime": startTime,
            "endtime": endTime,
        },
        success:function(data){

            var array=data.data;
            var obj=JSON.parse(array);
            var arr = obj.map;



            os_x = new Array();
            os_y = new Array();
            for (var key in arr){
                if(arr.hasOwnProperty(key)){
                    os_y.push(key);
                    os_x.push(arr[key]);

                }
            }
            console.log("--- os ---");
            console.log(os_y);
            console.log(os_x);



        }
    });
}
//联网方式
function interaction7_2(startTime,endTime,app_id) {
    $.ajax({
        url:"d/app/"+app_id+"/au/ci",
        type:"GET",
        data:{
            "starttime": startTime,
            "endtime": endTime,
        },
        success:function(data){

            var array=data.data;
            var obj=JSON.parse(array);
            var arr = obj.map;



            ci_x = new Array();
            ci_y = new Array();
            for (var key in arr){
                if(arr.hasOwnProperty(key)){
                    ci_y.push(key);
                    ci_x.push(arr[key]);
                }
            }
            console.log("--- ci ---");
            console.log(ci_y);
            console.log(ci_x);
        }
    });
}
//运营商
function interaction7_3(startTime,endTime,app_id) {
    $.ajax({
        url:"d/app/"+app_id+"/au/co",
        type:"GET",
        data:{
            "starttime": startTime,
            "endtime": endTime,
        },
        success:function(data){

            var array=data.data;
            var obj=JSON.parse(array);
            var  arr = obj.map;

            co_x = new Array();
            co_y = new Array();

            for (var key in arr){
                if(arr.hasOwnProperty(key)){
                    co_y.push(key);
                    co_x.push(arr[key]);
                }
            }
            console.log("--- co ---");
            console.log(co_y);
            console.log(co_x);
        }
    });
}
//设备型号
function interaction7_4(startTime,endTime,app_id) {
    $.ajax({
        url:"d/app/"+app_id+"/au/pt",
        type:"GET",
        data:{
            "starttime": startTime,
            "endtime": endTime,
        },
        success:function(data){
     //       console.log(data);
            var array=data.data;
            var obj=JSON.parse(array);
            var arr = obj.map;

     //       console.log(obj);

            pt_x = new Array();
            pt_y = new Array();

            for (var key in arr){
                if(arr.hasOwnProperty(key)){
                    pt_y.push(key);
                    pt_x.push(arr[key]);
                }
            }
            console.log("--- pt ---");
            console.log(pt_y);
            console.log(pt_x);

        }
    });
}