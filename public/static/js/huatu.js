 /*
     关键数据：新增用户和设备
     */
    function huatu1_1_1(newuser,newdevice,newdate){

        DoubleLine("main1_1_1",
            newuser,
            newdevice,
            newdate);
    }

    /*
     关键数据：活跃玩家和设备
     */
    function huatu1_1_2(activeuser,activedecice,activedate){
        DoubleLine("main1_1_1",
            activeuser,
            activedecice,
            activedate);
    }

    /*
     关键数据：付费金额
     */
    function huatu1_1_3(money,date){
        Line("main1_1_2",
            money,
            date);
    }

    /*
     关键数据：付费用户
     */
    function huatu1_1_4(money,date){
        Line("main1_1_2",
            money,
            date);
    }

    /*
     关键数据：应用下载量
     */
    function huatu1_1_5(y,x){
        Line("main1_1_2",
            y,
            x);
    }

    /*
     新增设备：新增设备数量
     */
    function huatu1_2_1(y,x){
        Line("main1_2_1",
            y,
            x);
    }

    /*
     新增设备：首次使用时长
     */
    function huatu1_2_2(y,x){
        Line("main1_2_1",
            y,
            x);
    }
    
    /*
     新增设备：使用地区
     */
    function huatu1_2_3(area_dev){
        Map("main1_2_2",area_dev);
    }

    /*
     新增用户：新增用户数量
     */
    function huatu1_3_1(y,x){
        Line("main1_3_1",
            y,
            x);
    }

    /*
     新增用户：首次使用时长
     */
    function huatu1_3_2(y,x){
        Line("main1_3_1",
            y,
            x);
    }

    /*
     新增用户：地区分布
     */
    function huatu1_3_3(area_user){
        Map("main1_3_2",area_user);
    }

    /*
     活跃设备概况：日活跃设备
     */
    function huatu1_4_1(y,x){
        Line("main1_4_1",
            y,
            x);
    }

    /*
     活跃设备概况：周活跃设备
     */
    function huatu1_4_2(y,x){
        Line("main1_4_1",
           y,
            x);
    }

    /*
     活跃设备概况：月活跃设备
     */
    function huatu1_4_3(y,x){
        Line("main1_4_1",
            y,
            x);
    }

    /*
     活跃设备概况：已用天数
     */
    function huatu1_4_4(y,x){
        Bar("main1_4_2",
            y,
            x);
    }

    /*
     活跃玩家概况：日活跃设备
     */
    function huatu1_5_1(y,x){
        Line("main1_5_1",
            y,
            x);
    }

    /*
     活跃玩家概况：周活跃设备
     */
    function huatu1_5_2(y,x){
        Line("main1_5_1",
            y,
            x);
    }

    /*
     活跃玩家概况：月活跃设备
     */
    function huatu1_5_3(y,x){
        Line("main1_5_1",
            y,
            x);
    }

    /*
     活跃玩家概况：已用天数
     */
    function huatu1_5_4(y,x){
        Bar("main1_5_2",y,x);
    }

    /*
     留存用户设备：设备留存
     */
    function huatu1_6_1(y,x){
        Line("main1_6",
            y,
            x);
    }

    /*
     留存用户设备：用户留存
     */
    function huatu1_6_2(y,x){
        Line("main1_6",
            y,
            x);
    }

    /*
     用户系统设备：操作系统
     */
    function huatu1_7_1(y,x){
        Bar("main1_7",
            y,
            x);
    }

    /*
     用户系统设备：联网方式
     */
    function huatu1_7_2(y,x){
        Bar("main1_7",
            y,
            x);
    }

    /*
     用户系统设备：运营商
     */
    function huatu1_7_3(y,x){
        Bar("main1_7",
            y,
            x);
    }

    /*
     用户系统设备：设备型号
     */
    function huatu1_7_4(y,x){
        Bar("main1_7",
            y,
            x);
    }