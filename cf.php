<?php
/**/
/*$servername = "localhost";
$dbname="pimangroup_crm";
$username = "pimangroup_crm";
$password = "pimancrm2017";*/
$servername = "localhost";
$dbname="pimangroup_piman";
$username = "pimangroup";
$password = "aKuR7VMT";
if (stripos($_SERVER['SCRIPT_NAME'], 'apps/phpgrid-custom-crm')) {
    define('PHPGRID_DB_HOSTNAME', 'localhost'); // database host name
    define('PHPGRID_DB_USERNAME', 'pimangroup_crm');     // database user name
    define('PHPGRID_DB_PASSWORD', 'pimancrm2017'); // database password
    define('PHPGRID_DB_NAME', 'pimangroup_crm'); // database name
    define('PHPGRID_DB_TYPE', 'mysql');  // database type
    define('PHPGRID_DB_CHARSET','utf8'); // ex: utf8(for mysql),AL32UTF8 (for oracle), leave blank to use the default charset
} else {
	//* mysql example
	define('PHPGRID_DB_HOSTNAME','localhost'); // database host name
	define('PHPGRID_DB_USERNAME', 'pimangroup_crm');     // database user name
	define('PHPGRID_DB_PASSWORD', 'pimancrm2017'); // database password
	define('PHPGRID_DB_NAME', 'pimangroup_crm'); // database name
	define('PHPGRID_DB_TYPE', 'mysql');  // database type
	define('PHPGRID_DB_CHARSET','utf8'); // ex: utf8(for mysql),AL32UTF8 (for oracle), leave blank to use the default charset
}
