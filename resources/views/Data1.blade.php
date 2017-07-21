<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('static/css/primaryadmin.css')}}" type="text/css">
    <link href="{{URL::asset('static/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="{{URL::asset('static/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('static/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script type="text/javascript" src="http://cdn.sobekrepository.org/includes/jquery-rotate/2.2/jquery-rotate.min.js"></script>
    <script src="https://cdn.bootcss.com/echarts/3.6.2/echarts.js"></script>
    <script src="{{URL::asset('static/js/china.js')}}"></script>
    <script src="{{URL::asset('static/js/drawEchart.js')}}"></script>
    <script src="{{URL::asset('static/js/primaryadmin.js')}}"></script>
    <script src="{{URL::asset('static/js/logic.js')}}"></script>
    <script src="{{URL::asset('static/js/huatu.js')}}"></script>
    <script src="{{URL::asset('static/js/interaction.js')}}"></script>
    <script src="{{URL::asset('static/js/interaction1.js')}}"></script>
    
</head>

<body>
    <div class="header">
        <div class="contentpanel">
            <img src="{{URL::asset('static/image/logo.png')}}">
            <ul>
                <li><a href="#">主页</a></li>
                <li><a href="#">帮助</a></li>
                <li> <div class="motaik3">
                        <a href="#" data-toggle="modal" data-target="#myModa3">
                           修改密码
                        </a>
                        <div class="modal fade" id="myModa3" tabindex="-1" role="dialog" aria-labelledby="myModalLabe3" aria-hidden="true">
                            <div class="modal-dialog d3">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title t3">修改密码</h4>
                                    </div>
                                    <div class="modal-body b3">
                                      <div class="xgmm1">
                                        <ul>
                                            <li>
                                                <input type="text" placeholder="账号" name="">
                                            </li>
                                            <li>
                                                <input type="text" placeholder="原密码" name="">
                                            </li>
                                            <li>
                                                <input type="text" placeholder="新密码" name="">
                                            </li>
                                            <li>
                                                <input type="text" placeholder="确认密码" name="">
                                            </li>
                                            <li>
                                                <input type="text" placeholder="邮箱" name="">
                                            </li>                                      
                                        </ul>
                                        </div>
                                        <div class="xgmm2">
                                          <a href="">发送验证码至邮箱</a>
                                          <input type="text" placeholder="验证码" name=""> 
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">确定</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div></li>
                <li><a href="#">退出</a></li>
            </ul>
        </div>
    </div>
    <div class="content">
        <div class="content_left">
            <div class="content_left up">
                <img src="{{URL::asset('static/image/touxiang.png')}}">
                <p class="p p1">{{$name}}</p>
                <p class="p p2">个人自我座右铭</p>
            </div>
            <div class="content_left down">
                <div class="down-1 x1">
                    <p>公司管理</p>
                    <img src="{{URL::asset('static/image/xuanze.png')}}">
                </div>
                <div class="down-1 x2">
                    <p>项目管理</p>
                    <img src="{{URL::asset('static/image/xuanze.png')}}">
                </div>
                <div class="down-2">
                    <div class="down-2 y0">
                        <p>所选项目名</p>
                    </div>
                    <div class="down-2 y1">
                        <p>数据分析</p>
                        <img src="{{URL::asset('static/image/jiantou.png')}}">
                        <ul>
                            <li class="y1-1">关键数据</li>
                            <li class="y1-2">新增设备</li>
                            <li class="y1-3">新增用户</li>
                            <li class="y1-4">活跃设备概况</li>
                            <li class="y1-5">活跃玩家概况</li>
                            <li class="y1-6">留存用户设备</li>
                            <li class="y1-7">用户系统设备</li>
                        </ul>
                    </div>
                    <div class="down-2 y2">
                        <p>项目通知</p>
                        <img src="{{URL::asset('static/image/jiantou.png')}}">
                        <ul>
                            <li class="y2-1">波动预警</li>
                            <li class="y2-2">运营日志</li>
                        </ul>
                    </div>
                    <div class="fanhui">
                        <img src="{{URL::asset('static/image/fanhui.png')}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="content_right">
            <div class="yujing">
                <button>添加新预警+</button>
                <div class="yujing1">
                    <p>预警列表</p>
                    <div class="yujing2">
                        <table border="0" cellpadding="10">
                            <tr>
                                <th>预警名称</th>
                                <th>预警指标</th>
                                <th>触发条件</th>
                                <th>提醒方式</th>
                                <th>操作</th>
                            </tr>
                            <tr>
                                <td>每日下载预警</td>
                                <td>日下载量</td>
                                <td>较前两日波动超过15%</td>
                                <td>邮件至：</td>
                                <td>
                                    <a href="">修改</a>
                                    <a href="">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="rizhi">
                <div class="rizhi1">
                    <p>亲爱的开发者：</p>
                    <p>您好，以下是2017年7月21号的运营日报，请您查看。</p>
                </div>
                <div class="rizhi2">
                    <table border="1">
                        <tr>
                            <th>应用名称</th>
                            <th>应用类型</th>
                            <th>下载量</th>
                            <th>新增设备</th>
                            <th>活跃设备</th>
                            <th>应用详情</th>
                        </tr>
                        <tr>
                            <td>测试APP</td>
                            <td>软件</td>
                            <td>0</td>
                            <td>0</td>
                            <td>100</td>
                            <td><a href="">查看详情</a></td>
                        </tr>
                        <tr>
                            <td>测试APP</td>
                            <td>软件</td>
                            <td>0</td>
                            <td>0</td>
                            <td>100</td>
                            <td><a href="">查看详情</a></td>
                        </tr>
                        <tr>
                            <td>测试APP</td>
                            <td>软件</td>
                            <td>0</td>
                            <td>0</td>
                            <td>100</td>
                            <td><a href="">查看详情</a></td>
                        </tr>
                        <tr>
                            <td>测试APP</td>
                            <td>软件</td>
                            <td>0</td>
                            <td>0</td>
                            <td>100</td>
                            <td><a href="">查看详情</a></td>
                        </tr>
                    </table>
                </div>
                <button>更多数据</button>
            </div>
           <div class="denglu">
             <p>欢迎登录！</p>    
           </div>
            <div class="xmguanli">
                <p class="xmguanli1">合作信息表</p>
                <P class="xmguanli2"></P>
                <input type="text" placeholder="请输入搜索词条" name="">
                <img src="{{URL::asset('static/image/sousuo.png')}}">
                <div class="biaoge biao1">
                    {{--项目管理中的一级列表--}}
                    <table class="table table-striped" id="allapplist">
                        <tr>
                            <th>序号</th>
                            <th>公司名称</th>
                            <th>管理员名</th>
                            <th>管理员ID</th>
                            <th></th>
                        </tr>

                    </table>
                </div>
            </div>
            <div class="glyshezhi">
                <div class="biao2tou">
                    <p class="glyshezhi1" id="gs_name">公司名称</p>
                    <button class="return1">返回列表</button>
                    <p class="glyshezhi2"></p>
                    <div class="motaik1">
                        <button class="btn btn-lg g1" data-toggle="modal" data-target="#myModal">
                            <p>+新增项目</p>
                        </button>
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog d1">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title t1">新增项目</h4>
                                    </div>
                                    <div class="modal-body b1">
                                        <ul>
                                            <li>
                                                <input id="add-name" type="text" placeholder="新增项目名" name="">
                                            </li>

                                            <li>
                                                <input id="add-starttime" type="text" placeholder="合作开始时间" name="">
                                            </li>
                                            <li>
                                                <input id="add-endtime" type="text" placeholder="合作结束时间" name="">
                                            </li>
                                            <li class="beizhu">
                                                <label> 备注：</label>
                                                <textarea id="add-description" cols="28" rows="8" name=""></textarea>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button"   onclick="addApp()" id="newappsubmit" data-dismiss="modal">确定</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input class="glyshezhi4" type="text" placeholder="请输入项目名" name="">
                    <img src="{{URL::asset('static/image/sousuo.png')}}">
                </div>
                <div class="biaoge biao2">
                    {{--项目管理中的二级列表，点击管理之后弹出的表格--}}
                    <div class="modal fade" id="myModa2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog d2">
                            {{--项目管理中修改按钮的模态框内容表格--}}
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
                                    <h4 class="modal-title t2">修改项目</h4>
                                </div>
                                <div class="modal-body b2">
                                    <div class="shuxing">
                                        <p>项目ID：</p>
                                        <p>项目名称:</p>
                                        <p>合作开始时间:</p>
                                    </div>
                                    <div class="zhi">
                                        <p id="p_xiangmu_id"></p>
                                        <p id="p_xiangmu_name"></p>
                                        <p id="p_start_time"></p>
                                    </div>
                                    <ul>
                                        <li>
                                            <input id="edit-name" type="text" name="" placeholder="新项目名:">
                                        </li>
                                        <li>
                                            <input id="edit-endtime" type="text" placeholder="合作结束时间:" name="">
                                        </li>
                                        <li class="beizhu">
                                            <label>备注：</label>
                                            <textarea id="edit-description" cols="33" rows="6" name=""></textarea>
                                        </li>
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" id="xiugai_queding">确定</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped" cellpadding="3" id="company_applist">
                        <tr>
                            <th>序号</th>
                            <th>项目名</th>
                            <th>项目ID</th>
                            <th>开始时间</th>
                            <th>结束时间</th>
                            <th>备注</th>
                            <th></th>
                        </tr>

         
                    </table>
                </div>
            </div>
            {{--<div class="xmguanli_nr">--}}
            {{----}}
                {{--<div class="biao3tou">--}}
                    {{--<p class="xmguanli_nr1">项目名称</p>--}}
                    {{--<button class="return2">返回列表</button>--}}
                    {{--<p class="xmguanli_nr2"></p>--}}
                {{--</div>--}}
                {{--<div class="biaoge biao3">--}}
                    {{--项目管理中的三级列表，点击二级列表中的查看弹出此表--}}
                    {{--<table class="table table-striped" cellpadding="3">--}}
                        {{--<tr>--}}
                            {{--<th>序号</th>--}}
                            {{--<th>公司名</th>--}}
                            {{--<th>管理员姓名</th>--}}
                            {{--<th>管理员ID</th>--}}
                            {{--<th></th>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td>1</td>--}}
                            {{--<td>甲</td>--}}
                            {{--<td>张</td>--}}
                            {{--<td>3534</td>--}}
                            {{--<td><button>管理</button></td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                        {{--</tr>--}}
                    {{--</table>--}}
                {{--</div>--}}
            {{--</div>--}}

				<!-- 加xmguanli_nr -->
            <div class="xmguanli_nr_main">
                <div class="g_content_right_header">
                <p>起始日期：</p>
                <div class="date">
                    <div class="controls input-append date form_date" data-date=""          
                        data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                        <input id="date_start" size="16" type="text" value="" readonly>
                        <span class="add-on"><i class="icon-remove"></i></span>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                </div>
                <p>结束日期：</p>
                <div class="date">
                   <div class="controls input-append date form_date" data-date=""          
                        data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                        <input id="date_end" size="16" type="text" value="" readonly>
                        <span class="add-on"><i class="icon-remove"></i></span>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                    <button type="button" class="btn btn-default btn-xs" id="queding">确定</button>
                </div>
                <ul>
                    <li><a id="last_day" href="#">昨天</a></li>
                    <li><a id="7_day" href="#">近七天</a></li>
                    <li><a id="30_day" href="#">近三十天</a></li>
                    <li><a id="all_day" href="#">全部</a></li>
                </ul>
            </div>
            <div class="g_maincontent g_maincontent1_1" id="g_maincontent1_1">
                <div class="g_maincontent_header">
                    <div class="btn-group" role="group" aria-label="..." data-toggle="buttons">
                    <!-- 修改 -->
                        <button type="radio" name="options" class="btn btn-default y1-1-1">新增用户和设配</button>
                        <button type="radio" name="options" class="btn btn-default y1-1-2">活跃玩家和设备</button>
                    <!-- 修改 -->
                    </div>
                </div>
                <div class="main1_1 main1_1_1" id="main1_1_1"></div>
            </div>
            <div class="g_maincontent g_maincontent1_1" id="g_maincontent1_1">
                <div class="g_maincontent_header">
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default y1-1-3">付费金额</button>
                        <button type="button" class="btn btn-default y1-1-4">付费用户</button>
                        <button type="button" class="btn btn-default y1-1-5">应用下载量</button>
                    </div>
                </div>
                <div class="main1_1 main1_1_2" id="main1_1_2"></div>
            </div>
            
            <div class="g_maincontent g_maincontent1_2" id="g_maincontent1_2">
                <div class="g_maincontent_header">
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default y1-2-1">新增设备数量</button>
                        <button type="button" class="btn btn-default y1-2-2">首次使用时长</button>
                        <button type="button" class="btn btn-default y1-2-3">设备品牌</button>
                    </div>
                </div>
                <div class="main1_2 main1_2_1" id="main1_2_1"></div>
            </div>
            <div class="g_maincontent g_maincontent1_2" id="g_maincontent1_2">
                <div class="g_maincontent_header">
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default y1-2-4">使用地区</button>
                    </div>
                </div>
                <div class="main1_2 main1_2_2" id="main1_2_2"></div>
            </div>

            <div class="g_maincontent g_maincontent1_3" id="g_maincontent1_3">
                <div class="g_maincontent_header">
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default y1-3-1">新增用户数量</button>
                        <button type="button" class="btn btn-default y1-3-2">首次使用时长</button>
                    </div>
                </div>
                <div class="main1_3 main1_3_1" id="main1_3_1"></div>
            </div>
            <div class="g_maincontent g_maincontent1_3" id="g_maincontent1_3">
                <div class="g_maincontent_header">
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default y1-3-3">地区分布</button>
                    </div>
                </div>
                <div class="main1_3 main1_3_2" id="main1_3_2"></div>
            </div>

            <div class="g_maincontent g_maincontent1_4" id="g_maincontent1_4">
                <div class="g_maincontent_header">
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default y1-4-1">日活跃设备</button>
                        <button type="button" class="btn btn-default y1-4-2">周活跃设备</button>
                        <button type="button" class="btn btn-default y1-4-3">月活跃设备</button>
                    </div>
                </div>
                <div class="main1_4 main1_4_1" id="main1_4_1"></div>
            </div>
            <div class="g_maincontent g_maincontent1_4" id="g_maincontent1_4">
                <div class="g_maincontent_header">
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default y1-4-4">已用天数</button>
                    </div>
                </div>
                <div class="main1_4 main1_4_2" id="main1_4_2"></div>
            </div>

            <div class="g_maincontent g_maincontent1_5" id="g_maincontent1_5">
                <div class="g_maincontent_header">
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default y1-5-1">日活跃玩家</button>
                        <button type="button" class="btn btn-default y1-5-2">周活跃玩家</button>
                        <button type="button" class="btn btn-default y1-5-3">月活跃玩家</button>
                    </div>
                </div>
                <div class="main1_5 main1_5_1" id="main1_5_1"></div>
            </div>
            <div class="g_maincontent g_maincontent1_5" id="g_maincontent1_5">
                <div class="g_maincontent_header">
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default y1-5-4">已用天数</button>
                    </div>
                </div>
                <div class="main1_5 main1_5_2" id="main1_5_2"></div>
            </div>

            <div class="g_maincontent g_maincontent1_6" id="g_maincontent1_6">
                <div class="g_maincontent_header">
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default y1-6-1">设备留存</button>
                        <button type="button" class="btn btn-default y1-6-2">用户留存</button>
                    </div>
                </div>
                <div class="main1_6" id="main1_6"></div>
            </div>

            <div class="g_maincontent g_maincontent1_7" id="g_maincontent1_7">
                <div class="g_maincontent_header">
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default y1-7-1">操作系统</button>
                        <button type="button" class="btn btn-default y1-7-2">联网方式</button>
                        <button type="button" class="btn btn-default y1-7-3">运营商</button>
                        <button type="button" class="btn btn-default y1-7-4">设备型号</button>
                    </div>
                </div>
                <div class="main1_7" id="main1_7"></div>
            </div>
            </div>
            <!-- 加 -->

            <div class="fenye">
                <ul class="pager">
                    <li><a id="first" href="javascript:void(0);">首页</a></li>
                    <li><a id="pre" href="javascript:void(0);">上一页</a></li>
                    <li><a id="next" href="javascript:void(0);">下一页</a></li>
                    <li><a id="last" href="javascript:void(0);">尾页</a></li>
                    <li><a href="#">跳转至</a></li>
                    <li>第
                        <input type="" name="">页</li>
                </ul>
            </div>

            <div class="gsguanli_nr">
                <div class="biao4tou">
                    <p class="gsguanli_nr1">公司信息列表</p>
                    <p class="gsguanli_nr2"></p>
                    <button>+新增公司</button>
                    <input class="gsguanli_nr4" type="text" placeholder="请输入搜索词条" name="">
                    <img src="{{URL::asset('static/image/sousuo.png')}}">
                </div>
                <div class="biaoge biao4">
                    {{--公司管理的一级列表--}}
                    <table class="table table-striped" cellpadding="3" id="companylist">
                        <tr>
                            <th>序号</th>
                            <th>公司名</th>
                            <th>管理员姓名</th>
                            <th>管理员ID</th>
                        </tr>

                    </table>
                </div>
            </div>
             <div class="xinzenggs">
              <div>
                    <p class="xinzenggs1">项目名称</p>
                    <button class="return3">返回列表</button>
                    <p class="xinzenggs2"></p>
                    </div>
                    <div class="tianjiags">
                      <div class="diyibu">
                        <img src="{{URL::asset('static/image/pageOne.png')}}">
                        <div class="buzhou1">
                        <p>公司名称</p>
                        <input type="text" placeholder="公司名称不能为空" name="" id="newcompanyname">
                            <p>
                                公司描述
                            </p>
                            <input type="text" placeholder="公司描述" name="" id="newcompanydescribe">
                        <button id="xzgs">下一步</button>
                        </div>
                       </div> 
                     <div class="dierbu">
                       <img src="{{URL::asset('static/image/pageTwo.png')}}">  
                        <div class="buzhou2">
                          <ul>
                              <li>管理员名字<input type="text" placeholder="管理员名字" name="" id="newadminname"></li>
                              <li>邮箱<input type="text" placeholder="邮箱不能为空" name="" id="newadminemail"></li>
                              <li>密码<input type="text" placeholder="密码限制" name="" id="newadminpassword"></li>

                          </ul>
                          <button class="shangyibu">上一步</button> 
                          <button class="xiayibu" id="newcompost">提交</button>
                        </div>
                    </div>
                    <div class="disanbu">
                        <img src="{{URL::asset('static/image/pageThree.png')}}">
                        <div class="buzhou3">
                        <p>添加成功！</p>                
                        </div>
                    </div>
            </div>
            </div>
        </div>
    </div>
    <div class="g_footer">
        <div class="g_contentpanel-footer">
            <div class="g_contentpanel1">
                <img src="{{URL::asset('static/image/logo_small.png')}}" alt="logo">
                <ul>
                    <li><a href="#">关于我们</a></li>
                    <li><a href="#">加入我们</a></li>
                    <li><a href="#">友情链接</a></li>
                    <li><a href="#">帮助中心</a></li>
                    <li><a href="#">活动中心</a></li>
                    <li><a href="#">联系我们</a></li>
                    <li><a href="#">官方认证</a></li>
                    <li><a href="#">广告服务</a></li>
                    <li><a href="#">侵权申诉</a></li>
                    <li><a href="#">用户反馈</a></li>
                </ul>
            </div>
            <div class="g_contentpanel2">
                <p>传送门</p>
                <ul>
                    <li><a href="#">QQ邮箱</a></li>
                    <li><a href="#">微信</a></li>
                    <li><a href="#">微博</a></li>
                    <li><a href="#">Facebook</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>
