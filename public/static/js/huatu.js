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
     新增设备：设备品牌
     */
    function huatu1_2_3(y,x){
        Line("main1_2_1",
            y,
            x);
    }

    /*
     新增设备：使用地区
     */
    function huatu1_2_4(){
        Map("main1_2_2",
            [
                {name:'北京',value:10000},
                {name:'上海',value:23330},
                {name:'天津',value:45630},
                {name:'重庆',value:88880},
                {name:'哈尔滨',value:35640},
                {name:'长春',value:34507},
                {name:'沈阳',value:84930},
                {name:'呼和浩特',value:89630},
                {name:'石家庄',value:14540},
                {name:'乌鲁木齐',value:65630},
                {name:'兰州',value:78970},
                {name:'西宁',value:89890},
                {name:'西安',value:71230},
                {name:'银川',value:9950},
                {name:'郑州',value:921000},
                {name:'济南',value:66660},
                {name:'太原',value:42870},
                {name:'合肥',value:79870},
                {name:'武汉',value:96540},
                {name:'长沙',value:87000},
                {name:'南京',value:39660},
                {name:'贵阳',value:97000},
                {name:'成都',value:7700},
                {name:'昆明',value:43820},
                {name:'南宁',value:54000},
                {name:'拉萨',value:9700},
                {name:'杭州',value:78650},
                {name:'南昌',value:24870},
                {name:'广州',value:65000},
                {name:'福州',value:47000},
                {name:'台北',value:37830},
                {name:'海口',value:20000},
                {name:'香港',value:32000},
                {name:'澳门',value:43000}

            ]);
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
    function huatu1_3_3(){
        Map("main1_3_2",
            [
                {name:'北京',value:10000},
                {name:'上海',value:23330},
                {name:'天津',value:45630},
                {name:'重庆',value:88880},
                {name:'哈尔滨',value:35640},
                {name:'长春',value:34507},
                {name:'沈阳',value:84930},
                {name:'呼和浩特',value:89630},
                {name:'石家庄',value:14540},
                {name:'乌鲁木齐',value:65630},
                {name:'兰州',value:78970},
                {name:'西宁',value:89890},
                {name:'西安',value:71230},
                {name:'银川',value:9950},
                {name:'郑州',value:921000},
                {name:'济南',value:66660},
                {name:'太原',value:42870},
                {name:'合肥',value:79870},
                {name:'武汉',value:96540},
                {name:'长沙',value:87000},
                {name:'南京',value:39660},
                {name:'贵阳',value:97000},
                {name:'成都',value:7700},
                {name:'昆明',value:43820},
                {name:'南宁',value:54000},
                {name:'拉萨',value:9700},
                {name:'杭州',value:78650},
                {name:'南昌',value:24870},
                {name:'广州',value:65000},
                {name:'福州',value:47000},
                {name:'台北',value:37830},
                {name:'海口',value:20000},
                {name:'香港',value:32000},
                {name:'澳门',value:43000}

            ]);
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