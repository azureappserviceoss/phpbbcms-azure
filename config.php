<?php
/**
 * phpBB 3.0.x webPI configuration file for auto populating the database fields values 
 * in the phpBB installation wizard. 
 * 
 * NOTICE OF LICENSE
 * 
 * Copyright (C) Microsoft Corporation All rights reserved.
 * 
 * This program is free software; you can redistribute it and/or modify it 
 * under the terms of the GNU General Public License version 2 as published 
 * by the Free Software Foundation.
 * This program is distributed in the hope that it will be useful, 
 * but WITHOUT ANY WARRANTY; without even the implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
 * See the GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License 
 * along with this program; if not, write to the 
 * Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 * 
 */
// Enable super globals to prevent issues with the new \phpbb\request\request object
$request->enable_super_globals();
$connectstr_dbhost = '';
$connectstr_dbname = '';
$connectstr_dbusername = '';
$connectstr_dbpassword = '';
foreach ($_SERVER as $key => $value) {
    if (strpos($key, "MYSQLCONNSTR_") !== 0) {
        continue;
    }
    
    $connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
    $connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
    $connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
    $connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
}
$connectstr_dbport= getenv('WEBSITE_MYSQL_PORT');
if (empty($connectstr_dbport))
  $connectstr_dbport=3306;

$dbms = 'phpbb\\db\\driver\\mysqli';
$dbhost = $connectstr_dbhost;
$dbport = $connectstr_dbport;
$dbname = $connectstr_dbname;
$dbuser = $connectstr_dbusername;
$dbpasswd = $connectstr_dbpassword;
$table_prefix = 'phpbb_';
?>