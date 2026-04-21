<?php
$servername = !empty($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';
$base = 'https://'.$servername.'/';
$adminbase = $base.'dashboard/';

define('PREFIX',$base);
define('PUBLICFOLDER',PREFIX);
define('ASSETSFOLDER',PUBLICFOLDER.'assets/');
define('CALLBACK',PREFIX.'callback');
define('CRON_EMAIL','raj.gorsia@yourworld.com');
define('SCRIPT_VERSION','27082025133030');

define('APP_NAME', 'Admin');

//Roles
DEFINE('ALLOCATE_ADMIN', 'admin');
DEFINE('ALLOCATE_CONSULTANT', 'consultant');

//Logo paths
DEFINE('ALLOCATE_LOGO_LOGIN', PUBLICFOLDER.'images/logo.svg');
DEFINE('ALLOCATE_LOGO', PUBLICFOLDER.'images/logo-white.svg');

define('PASSWORD_SALT', 15102014);

// Core admin URLs
define('ADMIN_LOGOUT', $adminbase.'logout');
define('ADMIN_IMPERSONATE_LOGOUT', $adminbase.'impersonate-logout');
define('ADMIN_LOGIN', $adminbase.'login');
define('ADMIN_DASHBOARD', $adminbase.'welcome');
define('ADMIN_PROFILE', $adminbase.'profile');

// Users
define('ADMIN_USERS_LIST', $adminbase.'users');
define('ADMIN_USERS_ADD', $adminbase.'users/new');
define('ADMIN_USERS_EDIT', $adminbase.'users/edit/');
define('ADMIN_USERS_DELETE', $adminbase.'users/delete/');
define('ADMIN_USERS_IMPERSONATE', $adminbase.'users/impersonate/');
?>
