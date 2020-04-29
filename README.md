# 注意事项
这是一个PHP语言实现的香橙派性能监控软件，支持各项参数动态监控，

主要原理是依靠file函数读取/sys等目录中的系统信息，绝对准确

如果数据为0要注意防跨站攻击保护的配置

已经过测试的香橙派：

全志H6 + Armbian + OrangePiDashBoard= 完美兼容

核心文件：device.php，如果数据不对请到这里面看一看，按需修改

## 注意我阉割了以下功能
因香橙派与树莓派的略微出入，device.php中的cpu_count变量无法正常处理，我直接赋值为了4，你也可以直接赋值

因香橙派与树莓派的略微出入，device.php中的cpu_model变量无法正常处理，我直接赋值为了ARMv8 Processor



# 原项目信息
# Pi Dashboard
A WebUI dashboard for IoT devices likes raspberry pi.

Project details: (http://maker.quwj.com/project/10)

Copyright 2017 NXEZ.com.

Licensed under the GPL v3.0 license.