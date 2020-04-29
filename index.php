<?php
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'device.php');
?>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Pi Dashboard</title>
	<link rel="icon" href="favicon.png" type="image/x-icon" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <!--script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->
    <link href="assets/bootstrap.min.css" rel="stylesheet">
    <script src="assets/jquery-3.1.1.min.js"></script>
    <script src="assets/highcharts.js"></script>
    <script src="assets/highcharts-more.js"></script>
    <script src="assets/solid-gauge.js"></script>
    <script src="assets/exporting.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <script language="JavaScript">
        window.dashboard_old = null;
        window.dashboard = null;
        var init_vals = eval('('+"{'mem': {'total':<?php echo($D['mem']['total']) ?>,'swap':{'total':<?php echo($D['mem']['swap']['total']) ?>}}, 'disk': {'total':<?php echo($D['disk']['total']) ?>}, 'net': { 'count': <?php echo($D['net']['count']) ?>} }"+')');
    </script>
    <style type="text/css">
        .label {color: #999999; font-size: 75%; font-weight: bolder;}
    </style>
</head>
<body style="user-select: none; -moz-user-select: none;">
<div id="app">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Pi Dashboard</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a target="_blank" href="http://shumeipai.nxez.com">树莓派实验室</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">关于 <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a target="_blank" href="http://maker.quwj.com/project/10">Pi Dashboard</a></li>
                            <li><a target="_blank" href="https://github.com/spoonysonny/pi-dashboard">GitHub Source</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div style="text-align: center; padding: 20px 0;"><img src="assets/devices/<?php echo($D['model']['id']) ?>.png" /></div>
                <div style="background-color: #E0E0E0; padding: 5px; border-radius: 3px;">
                    <div class="text-center" style="margin:20px; padding: 10px 0 10px 0; background-color:#CEFCA3; border-radius: 3px;"><div class="label">IP 地址</div><div id="hostip" style="font-size: 150%; font-weight: bolder;"><?php echo($D['hostip']); ?></div></div>
                    <div class="text-center" style="margin:20px; padding: 10px 0 10px 0; background-color:#9DCFFB; border-radius: 3px;"><div class="label">系统时间</div><div id="time" style="font-size: 150%; font-weight: bolder;">-</div><div id="date">-</div></div>
                    <div class="text-center" style="margin:20px; padding: 10px 0 10px 0; background-color:#FFFECD; border-radius: 3px;"><div class="label">运行时间</div><br /><div id="uptime_d" style="font-size: 150%; font-weight: bolder; display: inline-block;">-</div><small class="label" style="padding: 2; display: inline-block;">天</small><div id="uptime_h" style="font-size: 150%; font-weight: bolder; display: inline-block;">-</div><small class="label" style="padding: 2; display: inline-block;">小时</small><div id="uptime_m" style="font-size: 150%; font-weight: bolder; display: inline-block;">-</div><small class="label" style="padding: 2; display: inline-block;">分</small><div id="uptime_s" style="font-size: 150%; font-weight: bolder; display: inline-block;">-</div><small class="label" style="padding: 2; display: inline-block;">秒</small></div>
                    <div class="text-center" style="margin:20px; padding: 10px 0 10px 0; background-color:#FAFAFA; border-radius: 3px;"><div class="label">当前用户</div><div id="user" style="font-size: 120%; font-weight: bolder;"><?php echo($D['user']); ?></div></div>
                    <div class="text-center" style="margin:20px; padding: 10px 0 10px 0; background-color:#FAFAFA; border-radius: 3px;"><div class="label">系统</div><div id="os" style="font-size: 120%; font-weight: bolder;"><?php echo($D['os'][0]); ?></div></div>
                    <div class="text-center" style="margin:20px; padding: 10px 0 10px 0; background-color:#FAFAFA; border-radius: 3px;"><div class="label">主机名</div><div id="hostname" style="font-size: 110%; font-weight: bolder;"><?php echo($D['hostname']); ?></div></div>
                    <div class="text-center" style="margin:20px; padding: 10px 0 10px 0; background-color:#FAFAFA; border-radius: 3px;"><div id="uname" style="word-break:break-all; word-wrap:break-word; font-size: 12px; color: #999999; padding: 0 10px;"><?php echo($D['uname']); ?></div></div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div id="container-cpu" style="width: 100%; height: 200px;"></div>
                        <div style="max-height: 200px;">
                            <div class="row" style="margin: 0; background-color:#E0E0E0;">
                                <div class="text-center" style="padding: 2px 0 2px 0; background-color: #CDFD9F;"><strong><small>CPU</small></strong></div>
                                <div class="col-md-3 col-sm-3 col-xs-3" style="padding: 0;">
                                    <div class="text-center" style="padding: 10px 0 10px 0; background-color:#FFFECD;"><span id="cpu-freq" style="font-weight: bolder;">-</span><small class="label" style="padding: 0 0 0 2px;">MHz</small><br /><small class="label">频率</small></div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3" style="padding: 0;">
                                    <div class="text-center" style="padding: 10px 0 10px 0;"><span id="cpu-count" style="font-weight: bolder;"><?php echo($D['cpu']['count']) ?></span><br /><small class="label">核心数</small></div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3" style="padding: 0;">
                                    <div class="text-center" style="padding: 10px 0 10px 0; background-color:#FDCCCB;"><span id="cpu-temp" style="font-weight: bolder;">-</span><small class="label" style="padding: 0 0 0 2px;">℃</small><br /><small class="label">温度</small></div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3" style="padding: 0;">
                                    <div class="text-center" style="padding: 10px 0 10px 0; background-color:#9BCEFD;"><span id="cpu-stat-idl" style="font-weight: bolder;">-</span><small class="label" style="padding: 0 0 0 2px;">%</small><br /><small class="label">空闲</small></div>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2" style="padding: 0;">
                                    <div class="text-center" style="padding: 10px 0 10px 0; background-color:#9BCEFD;"><span id="cpu-stat-use">-</span><small class="label" style="padding: 0 0 0 2px;">%</small><br /><small class="label">用户占用</small></div>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2" style="padding: 0;">
                                    <div class="text-center" style="padding: 10px 0 10px 0; background-color:#9BCEFD;"><span id="cpu-stat-sys">-</span><small class="label" style="padding: 0 0 0 2px;">%</small><br /><small class="label">内核占用</small></div>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2" style="padding: 0;">
                                    <div class="text-center" style="padding: 10px 0 10px 0; background-color:#9BCEFD;"><span id="cpu-stat-nic">-</span><small class="label" style="padding: 0 0 0 2px;">%</small><br /><small class="label">优先占用</small></div>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2" style="padding: 0;">
                                    <div class="text-center" style="padding: 10px 0 10px 0; background-color:#9BCEFD;"><span id="cpu-stat-iow">-</span><small class="label" style="padding: 0 0 0 2px;">%</small><br /><small class="label">IO 等待</small></div>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2" style="padding: 0;">
                                    <div class="text-center" style="padding: 10px 0 10px 0; background-color:#9BCEFD;"><span id="cpu-stat-irq">-</span><small class="label" style="padding: 0 0 0 2px;">%</small><br /><small class="label">硬件中断</small></div>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2" style="padding: 0;">
                                    <div class="text-center" style="padding: 10px 0 10px 0; background-color:#9BCEFD;"><span id="cpu-stat-sirq">-</span><small class="label" style="padding: 0 0 0 2px;">%</small><br /><small class="label">软件中断</small></div>
                                </div>
								<div style="height: 104px;"></div>
                                <div class="col-md-12 col-sm-12" style="padding: 10px 0 10px 0; margin: auto 0;">
                                    <div class="text-center"><span class="label">架构</span><br /><span style="font-size: 15px;"><?php echo($D['cpu']['model']) ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div id="container-mem" style="width: 100%; height: 200px;"></div>
                        <div style="height: 200px;">
                            <div class="row" style="margin: 0; background-color:#E0E0E0;">
                                <div class="text-center" style="padding: 2px 0 2px 0; background-color: #CDFD9F;"><strong><small>总内存</small></strong></div>
                                <div class="col-md-6 col-sm-6 col-xs-6" style="padding: 0;">
                                    <div class="text-center" style="padding: 10px 0 10px 0;"><span id="mem-percent">0</span><small class="label" style="padding: 0 0 0 2px;">%</small><br /><small class="label">已使用</small></div>
                                    <div class="text-center" style="padding: 10px 0 10px 0; background-color: #CDFD9F;"><span id="mem-free">-</span><small class="label" style="padding: 0 0 0 2px;">MB</small><br /><small class="label">空闲</small></div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6" style="padding: 0;">
                                    <div class="text-center" style="padding: 10px 0 10px 0; background-color: #CEFFFF;"><span id="mem-cached">-</span><small class="label" style="padding: 0 0 0 2px;">MB</small><br /><small class="label">缓存</small></div>
                                    <div class="text-center" style="padding: 10px 0 10px 0; background-color: #CCCDFC;"><span id="mem-swap-total">-</span><small class="label" style="padding: 0 0 0 2px;">MB</small><br /><small class="label">交换分区</small></div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3" style="padding: 0;">
                                    <div class="text-center" style="padding: 10px 0 10px 0;"><span id="loadavg-1m">-</span><br /><small class="label">AVG.1M</small></div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3" style="padding: 0;">
                                    <div class="text-center" style="padding: 10px 0 10px 0;"><span id="loadavg-5m">-</span><br /><small class="label">AVG.5M</small></div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3" style="padding: 0;">
                                    <div class="text-center" style="padding: 10px 0 10px 0;"><span id="loadavg-10m">-</span><br /><small class="label">AVG.10M</small></div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3" style="padding: 0;">
                                    <div class="text-center" style="padding: 10px 0 10px 0; background-color: #FFFDCF;"><strong><span id="loadavg-running">-</span>/<span id="loadavg-threads">-</span></strong><br /><small class="label">RUNNING</small></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div id="container-cache" style="width: 100%; height: 100px;"></div>
                        <div style="height: 90px;">
                            <div class="row" style="margin: 0; background-color:#E0E0E0;">
                                <div class="text-center" style="padding: 2px 0 2px 0; background-color: #CEFFFF;"><strong><small>缓存</small></strong></div>
                                <div class="col-md-6 col-sm-6 col-xs-6" style="padding: 0;">
                                    <div class="text-center" style="padding: 10px 0 10px 0;"><span id="mem-cache-percent">-</span><small class="label" style="padding: 0 0 0 2px;">%</small><br /><small class="label">已使用</small></div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6" style="padding: 0; background-color:#CEFFFF;">
                                    <div class="text-center" style="padding: 10px 0 10px 0;"><span id="mem-buffers">-</span><small class="label" style="padding: 0 0 0 2px;">MB</small><br /><small class="label">缓冲区</small></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div id="container-mem-real" style="width: 100%; height: 100px;"></div>
                        <div style="height: 90px;">
                            <div class="row" style="margin: 0; background-color:#E0E0E0;">
                                <div class="text-center" style="padding: 2px 0 2px 0; background-color: #CDFD9F;"><strong><small>物理内存</small></strong></div>
                                <div class="col-md-6 col-sm-6 col-xs-6" style="padding: 0;">
                                    <div class="text-center" style="padding: 10px 0 10px 0;"><span id="mem-real-percent">-</span><small class="label" style="padding: 0 0 0 2px;">%</small><br /><small class="label">已使用</small></div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6" style="padding: 0; background-color:#CDFD9F;">
                                    <div class="text-center" style="padding: 10px 0 10px 0;"><span id="mem-real-free">-</span><small class="label" style="padding: 0 0 0 2px;">MB</small><br /><small class="label">空闲</small></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div id="container-swap" style="width: 100%; height: 100px;"></div>
                        <div style="height: 90px;">
                            <div class="row" style="margin: 0; background-color:#E0E0E0;">
                                <div class="text-center" style="padding: 2px 0 2px 0; background-color: #CCCDFC;"><strong><small>交换分区</small></strong></div>
                                <div class="col-md-6 col-sm-6 col-xs-6" style="padding: 0;">
                                    <div class="text-center" style="padding: 10px 0 10px 0;"><span id="mem-swap-percent">-</span><small class="label" style="padding: 0 0 0 2px;">%</small><br /><small class="label">已使用</small></div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6" style="padding: 0; background-color:#CCCDFC;">
                                    <div class="text-center" style="padding: 10px 0 10px 0;"><span id="mem-swap-free">-</span><small class="label" style="padding: 0 0 0 2px;">MB</small><br /><small class="label">空闲</small></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div id="container-disk" style="width: 100%; height: 100px;"></div>
                        <div style="height: 90px;">
                            <div class="row" style="margin: 0; background-color:#E0E0E0;">
                                <div class="text-center" style="padding: 2px 0 2px 0; background-color: #9BCEFD;"><strong><small>磁盘</small></strong></div>
                                <div class="col-md-6 col-sm-6 col-xs-6" style="padding: 0;">
                                    <div class="text-center" style="padding: 10px 0 10px 0;"><span id="disk-percent">-</span><small class="label" style="padding: 0 0 0 2px;">%</small><br /><small class="label">已使用</small></div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6" style="padding: 0; background-color:#9BCEFD;">
                                    <div class="text-center" style="padding: 10px 0 10px 0;"><span id="disk-free">-</span><small class="label" style="padding: 0 0 0 2px;">GB</small><br /><small class="label">空闲</small></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <!-- <div class="col-md-12" style="margin: 0;"> -->
                        <?php
                        for($i = 0; $i<$D['net']['count'];$i++)
                        {
                            ?>
                            <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                <div class="col-md-9 col-sm-9 col-xs-9" style="padding: 0;">
                                    <div id="container-net-interface-<?php echo($i+1) ?>" style="min-width: 100%; height: 140px; margin: 10 auto"></div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3" style="padding-left: 0;">
                                    <div style="height: 80px; margin-top: 10px;">
                                        <div class="text-center" style="padding: 2px 0 2px 0; background-color: #CCCCCC;"><strong><small id="net-interface-<?php echo($i+1) ?>-name"><?php echo($D['net']['interfaces'][$i]['name']) ?></small></strong></div>
                                        <div class="text-center" style="padding: 10px 0 10px 0; background-color: #9BCEFD;"><span id="net-interface-<?php echo($i+1) ?>-total-in">-</span></span><small id="unit-in-<?php echo($i+1) ?>" class="label" style="padding: 0 0 0 2px;">B</small><br /><small class="label">总下载量</small></div>
                                        <div class="text-center" style="padding: 10px 0 10px 0; background-color: #CDFD9F;"><span id="net-interface-<?php echo($i+1) ?>-total-out">-</span></span><small id="unit-out-<?php echo($i+1) ?>" class="label" style="padding: 0 0 0 2px;">B</small><br /><small class="label">总上传量</small></div>
                                    </div>
                                </div>
                            </div>
                
                        <?php
                        }
                        ?>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="footer">
                    <hr style="margin: 20px 0 10px 0;" />
                    <p class="pull-left" style="font-size: 12px;">Powered by <a target="_blank" href="http://maker.quwj.com/project/10"><strong>Pi Dashboard</strong></a> v<?php echo($D['version']) ?>, <a target="_blank" href="http://www.nxez.com">NXEZ.com</a> all rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/dashboard.min.js"></script>
</body>
</html>
