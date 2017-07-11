
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>360DATA</title>
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('static/css/generalAdmin.css')}}" type="text/css">
    <link href="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://momentjs.com/downloads/moment.js"></script>
    <script type="text/javascript" src="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="http://cdn.sobekrepository.org/includes/jquery-rotate/2.2/jquery-rotate.min.js"></script>
    <script src="https://cdn.bootcss.com/echarts/3.6.2/echarts.js"></script>
    <script src="{{URL::asset('static/js/china.js')}}"></script>
    <script src="{{URL::asset('static/js/drawEcharts.js')}}"></script>
    <script src="{{URL::asset('static/js/huatu.js')}}"></script>
    <script src="{{URL::asset('static/js/generalAdmin.js')}}"></script>
    <script src="{{URL::asset('static/js/logic.js')}}"></script>

</head>

<body>
<div class="g_header">
    <div class="g_contentpanel">
        <img src="{{URL::asset('static/image/logo.png')}}" alt="logo">
        <ul>
            <li><a href="#">��ҳ</a></li>
            <li><a href="#">����</a></li>
            <li><a href="#">����</a></li>
            <li><a href="#">�˳�</a></li>
        </ul>
    </div>
</div>
<div class="g_content">
    <div class="g_content_left">
        <div class="g_content_left g_up">
            <img src="">
            <p class="g_p g_p1">{{ $name }}</p>
            <p class="g_p g_p2">��������������</p>
        </div>
        <div class="g_content_left g_down">
            <div class="g_p3">
                <p>��Ŀѡ��</p>
                <img class="g_jt g_l1" id="g_l1" src="{{URL::asset('static/image/jiantou.png')}}">
            </div>
            <div class="g_ul1" >
           		<ol id='applist'>
                   <!--<li>��Ŀ������</li>
                    <li>��ĿRPG��Ϸ</li>
                    <li>��Ŀ����</li>-->
                </ol>
            </div>
            <div class="g_shitu2">
                <div class="g_xiangmu">
                    <p id="xiangmu_name">��Ŀ����</p>
                </div>
                <div class="g_shuju">
                    <div class="g_p4">
                        <p>���ݷ���</p>
                        <img class="g_jt g_l2" src="{{URL::asset('static/image/jiantou.png')}}">
                        <ul class="g_ul2">
                            <li class="g_ul2-1">�ؼ�����</li>
                            <li class="g_ul2-2">�����豸</li>
                            <li class="g_ul2-3">�����û�</li>
                            <li class="g_ul2-4">��Ծ�豸�ſ�</li>
                            <li class="g_ul2-5">��Ծ��Ҹſ�</li>
                            <li class="g_ul2-6">�����û��豸</li>
                            <li class="g_ul2-7">�û�ϵͳ�豸</li>
                        </ul>
                    </div>
                    <div class="g_p5">
                        <b>��������</b>
                        <img class="g_jt g_l3" src="{{URL::asset('static/image/jiantou.png')}}">
                        <ul class="g_ul3">
                            <li class="g_ul3-1">����Ԥ��</li>
                            <li class="g_ul3-2">��Ӫ��־</li>
                        </ul>
                    </div>
                    <img class="g_fanhui" src="{{URL::asset('static/image/fanhui.png')}}">
                </div>
            </div>
        </div>
    </div>

    <div class="g_content_right">
        <div class="g_p_hide">
            <p>��ѡ�������Ŀ</p>
        </div>

        <div class="g_content_right_header">
            <p>��ʼ���ڣ�</p>
            <div class="date">
                <div class="controls input-append date form_date" data-date=""
                     data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input id="date_start" size="16" type="text" value="" readonly>
                    <span class="add-on"><i class="icon-remove"></i></span>
                    <span class="add-on"><i class="icon-th"></i></span>
                </div>
            </div>
            <p>�������ڣ�</p> 
            <div class="date">
                <div class="controls input-append date form_date" data-date=""
                     data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input id="date_end" size="16" type="text" value="" readonly>
                    <span class="add-on"><i class="icon-remove"></i></span>
                    <span class="add-on"><i class="icon-th"></i></span>
                </div>
                <button type="button" class="btn btn-default btn-xs" id="queding">ȷ��</button>
            </div>
            <ul>
                <li><a id="last_day" href="#">����</a></li>
                <li><a id="7_day" href="#">������</a></li>
                <li><a id="30_day" href="#">����ʮ��</a></li>
                <li><a id="all_day" href="#">ȫ��</a></li>
            </ul>
        </div>
        <div class="g_maincontent g_maincontent1_1" id="g_maincontent1_1">
            <div class="g_maincontent_header">
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-default g_ul2-1-1">�����û�������</button>
                    <button type="button" class="btn btn-default g_ul2-1-2">��Ծ��Һ��豸</button>
                </div>
            </div>
            <div class="main1_1 main1_1_1" id="main1_1_1"></div>
        </div>
        <div class="g_maincontent g_maincontent1_1" id="g_maincontent1_1">
            <div class="g_maincontent_header">
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-default g_ul2-1-3">���ѽ��</button>
                    <button type="button" class="btn btn-default g_ul2-1-4">�����û�</button>
                    <button type="button" class="btn btn-default g_ul2-1-5">Ӧ��������</button>
                </div>
            </div>
            <div class="main1_1 main1_1_2" id="main1_1_2"></div>
        </div>

        <div class="g_maincontent g_maincontent1_2" id="g_maincontent1_2">
            <div class="g_maincontent_header">
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-default g_ul2-2-1">�����豸����</button>
                    <button type="button" class="btn btn-default g_ul2-2-2">�״�ʹ��ʱ��</button>
                    <button type="button" class="btn btn-default g_ul2-2-3">�豸Ʒ��</button>
                </div>
            </div>
            <div class="main1_2 main1_2_1" id="main1_2_1"></div>
        </div>
        <div class="g_maincontent g_maincontent1_2" id="g_maincontent1_2">
            <div class="g_maincontent_header">
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-default g_ul2-2-4">ʹ�õ���</button>
                </div>
            </div>
            <div class="main1_2 main1_2_2" id="main1_2_2"></div>
        </div>

        <div class="g_maincontent g_maincontent1_3" id="g_maincontent1_3">
            <div class="g_maincontent_header">
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-default g_ul2-3-1">�����û�����</button>
                    <button type="button" class="btn btn-default g_ul2-3-2">�״�ʹ��ʱ��</button>
                </div>
            </div>
            <div class="main1_3 main1_3_1" id="main1_3_1"></div>
        </div>
        <div class="g_maincontent g_maincontent1_3" id="g_maincontent1_3">
            <div class="g_maincontent_header">
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-default g_ul2-3-3">�����ֲ�</button>
                </div>
            </div>
            <div class="main1_3 main1_3_2" id="main1_3_2"></div>
        </div>

        <div class="g_maincontent g_maincontent1_4" id="g_maincontent1_4">
            <div class="g_maincontent_header">
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-default g_ul2-4-1">�ջ�Ծ�豸</button>
                    <button type="button" class="btn btn-default g_ul2-4-2">�ܻ�Ծ�豸</button>
                    <button type="button" class="btn btn-default g_ul2-4-3">�»�Ծ�豸</button>
                </div>
            </div>
            <div class="main1_4 main1_4_1" id="main1_4_1"></div>
        </div>
        <div class="g_maincontent g_maincontent1_4" id="g_maincontent1_4">
            <div class="g_maincontent_header">
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-default g_ul2-4-4">��������</button>
                </div>
            </div>
            <div class="main1_4 main1_4_2" id="main1_4_2"></div>
        </div>

        <div class="g_maincontent g_maincontent1_5" id="g_maincontent1_5">
            <div class="g_maincontent_header">
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-default g_ul2-5-1">�ջ�Ծ���</button>
                    <button type="button" class="btn btn-default g_ul2-5-2">�ܻ�Ծ���</button>
                    <button type="button" class="btn btn-default g_ul2-5-3">�»�Ծ���</button>
                </div>
            </div>
            <div class="main1_5 main1_5_1" id="main1_5_1"></div>
        </div>
        <div class="g_maincontent g_maincontent1_5" id="g_maincontent1_5">
            <div class="g_maincontent_header">
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-default g_ul2-5-4">��������</button>
                </div>
            </div>
            <div class="main1_5 main1_5_2" id="main1_5_2"></div>
        </div>

        <div class="g_maincontent g_maincontent1_6" id="g_maincontent1_6">
            <div class="g_maincontent_header">
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-default g_ul2-6-1">�豸����</button>
                    <button type="button" class="btn btn-default g_ul2-6-2">�û�����</button>
                </div>
            </div>
            <div class="main1_6" id="main1_6"></div>
        </div>

        <div class="g_maincontent g_maincontent1_7" id="g_maincontent1_7">
            <div class="g_maincontent_header">
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-default g_ul2-7-1">����ϵͳ</button>
                    <button type="button" class="btn btn-default g_ul2-7-2">������ʽ</button>
                    <button type="button" class="btn btn-default g_ul2-7-3">��Ӫ��</button>
                    <button type="button" class="btn btn-default g_ul2-7-4">�豸�ͺ�</button>
                </div>
            </div>
            <div class="main1_7" id="main1_7"></div>
        </div>
    </div>
</div>

<div class="g_footer">
    <div class="g_contentpanel-footer">
        <div class="g_contentpanel1">
            <img src="{{URL::asset('static/image/logo_small.png')}}" alt="logo">
            <ul>
                <li><a href="#">��������</a></li>
                <li><a href="#">��������</a></li>
                <li><a href="#">��������</a></li>
                <li><a href="#">��������</a></li>
                <li><a href="#">�����</a></li>
                <li><a href="#">��ϵ����</a></li>
                <li><a href="#">�ٷ���֤</a></li>
                <li><a href="#">������</a></li>
                <li><a href="#">��Ȩ����</a></li>
                <li><a href="#">�û�����</a></li>
            </ul>
        </div>
        <div class="g_contentpanel2">
            <p>������</p>
            <ul>
                <li><a href="#">QQ����</a></li>
                <li><a href="#">΢��</a></li>
                <li><a href="#">΢��</a></li>
                <li><a href="#">Facebook</a></li>
            </ul>
        </div>
    </div>
</div>
</body>
<script>
    //var remember_token=
    $.ajax({
        url:"a/getlist",
        type:"GET",
        data:{
            "remember_token":   "{{$token}}",
        },
        success:function(data){
            console.log(data);
            var array=data.data;
           
            for(var i=0;i<array.length;i++){
                console.log(array[i].id+"---"+array[i].name);
				$("#applist").append("<li> " + array[i].name + " </li>"); 
            }
            //$(".g_ul1").innerHTML()
        }


    });
</script>
</html>
