wifidog_authserver_demo
=======================

basic demo wifidog authentication server, with the official wifidog and v1 protocol! (Based on CodeIgniter 2.1.4 framework to build!)
-------


### Note: This demo is mainly used to illustrate the auth server and wifidog interactive interface and the basic process wifidog certified! <br /> Wifidog certification can be completed basic processes, but does not have any of the advanced management features!
  
### Simple deployment step
1. After the project file into the http server htdoc catalog, through several key pages such as http: //domain/index.php/wifidog/login http: //domain/index.php/wifidog/ping see return to normal determine whether the successful operation, the page returns an error, check http server and file placement is correct
2. The external interface server is wifidog
	/index.php/wifidog/login
	/index.php/wifidog/ping
	/index.php/wifidog/auth
	/index.php/wifidog/portal
3. Modify wifidog profile, several critical path url amended as follows
	AuthServer {
	    Hostname gw.freeap.net
	    SSLAvailable no
	    Path /index.php/wifidog/
	}
4. If you need to configure the default path to wifidog, adjust CI routing, apache rewrite rules, .htaccess rule, nginx configuration documentation rules
5. First, there is a problem or a document reference CI CI deployment documentation under different circumstances
  
Feedback questions please add qq group: 331 230 369, verify: github
