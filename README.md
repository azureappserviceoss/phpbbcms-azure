# PHPBB for Azure App service

[![Deploy to Azure](http://azuredeploy.net/deploybutton.png)](https://azuredeploy.net/)

This template support [MySQL in-app feature](https://blogs.msdn.microsoft.com/appserviceteam/2016/08/18/announcing-mysql-in-app-preview-for-web-apps/) on App service. Click on Deploy to Azure button above to start deployment. Since PHPBB does not support use of $_SERVER variables . You can still get the connection string fromm MySQL in-app from the file `D:\home\data\mysql\MYSQLCONNSTR_localdb.txt` in order to use enviornment variables. When using MySQL inapp it is recommended to use environment variables for connection information to prevent breaking your app if the port changes due to any upgrade or scale up or change in app service plan operation. 

```
<?php

$connectionstringfile= "D:\home\data\mysql\MYSQLCONNSTR_localdb.txt";

$connectionstring= file_get_contents($connectionstringfile);
$connectstr_dbfullhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $connectionstring);
$connectstr_dbhost = substr($connectstr_dbfullhost,0,strpos($connectstr_dbhost,":"));
$connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $connectionstring);
$connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $connectionstring);
$connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $connectionstring);
$connectstr_port =   getenv('WEBSITE_MYSQL_PORT');

if (empty($connectstr_port)){
               $connectstr_port= 3306;
 }


$dbms = 'phpbb\\db\\driver\\mysqli';
$dbhost = $connectstr_dbhost ;
$dbport = $connectstr_dbport;
$dbname = $connectstr_dbname;
$dbuser = $connectstr_dbusername;
$dbpasswd = $connectstr_dbpassword;
$table_prefix = 'phpbb_';
$phpbb_adm_relative_path = 'adm/';
$acm_type = 'phpbb\\cache\\driver\\file';

@define('PHPBB_INSTALLED', true);
// @define('PHPBB_DISPLAY_LOAD_TIME', true);
// @define('DEBUG', true);
// @define('DEBUG_CONTAINER', true);

```
