<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

// PostgreSQL
// $db['default'] = array(
// 	'dsn'	   => '',
// 	'hostname' => 'localhost',
// 	'username' => 'postgres',
// 	'password' => '123',
// 	'database' => 'dbgatepass',
// 	'dbdriver' => 'postgre',
// 	'dbprefix' => '',
// 	'pconnect' => FALSE,
// 	'db_debug' => (ENVIRONMENT !== 'production'),
// 	'cache_on' => FALSE,
// 	'cachedir' => '',
// 	'char_set' => 'utf8',
// 	'dbcollat' => 'utf8_general_ci',
// 	'swap_pre' => '',
// 	'encrypt'  => FALSE,
// 	'compress' => FALSE,
// 	'stricton' => FALSE,
// 	'failover' => array(),
// 	'save_queries' => TRUE
// );


// MySQL
$db['default'] = array(
	'dsn'	   => '',
	'hostname' => 'localhost',
	'username' => 'root',  
	'password' => '',  
	'database' => 'dbgatepass',
	'dbdriver' => 'mysqli',  
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt'  => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);