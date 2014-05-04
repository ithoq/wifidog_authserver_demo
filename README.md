wifidog_authserver_demo
=======================

wifidog 认证服务器的基本demo，配合官方的wifidog 及v1 协议使用！  （基于 CodeIgniter 2.1.4 框架构建！）
-------




### 注： 本demo 主要用来说明 auth server 和wifidog的交互接口以及wifidog认证的基本流程！ <br /> 能够完成wifidog认证的基本流程，但是不具备任何高级管理功能！
  
### 简单部署步骤
		1.将项目文件放到http服务器 htdoc目录之后，通过几个关键页面比如http://domain/index.php/wifidog/login http://domain/index.php/wifidog/ping 看返回是否正常来判断是否成功运行,页面返回错误，就要检查http服务器以及文件放置位置是否正确
		2.此时服务器的对外wifidog接口为<br />
				/index.php/wifidog/login
				/index.php/wifidog/ping
				/index.php/wifidog/auth
				/index.php/wifidog/portal
		3.修改wifidog配置文件，将几个关键路径url修改如下
		
				AuthServer {
					Hostname gw.freeap.net
					SSLAvailable no
					Path /index.php/wifidog/
				}
		4.如果需要配置成wifidog默认的路径，请调整CI路由、apache rewrite规则、.htaccess 规则、nginx规则等配置文档
		5.有问题首先参考CI文档或CI不同环境下的部署文档
  
  
  
  反馈问题请加qq群：331230369 ，验证：github
  
  
  
