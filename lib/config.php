<?
	$DB_HOST = "localhost";
	$DB_USER = "dentsu01";
	$DB_PWD = "dentsu001!";
	$DB_NAME = "dentsu01";
	$ROOT_DIR = $_SERVER['DOCUMENT_ROOT'];

	$SKIN_DIR = $_SERVER['DOCUMENT_ROOT'].'/body/';
	$ADMIN_SKIN_DIR = $_SERVER['DOCUMENT_ROOT'].'/admin/body/';
	$ADMIN_VIEW_DIR = '/admin';
	$ADMIN_JS_DIR = '/admin/js';
	$ADMIN_CSS_DIR = '/admin/css';
	$IMG_DIR = '/img';
	$IMG_ADMIN_DIR = '/admin/img';
	$LIBRARY_DIR = $ROOT_DIR."/lib";
	$CLASS_DIR = $ROOT_DIR."/lib/class";
	$UPLOAD_DIR = $_SERVER['DOCUMENT_ROOT']."/file";
	$UPLOAD_DIR_VIEW = "/file";
	$HTTP_REFERER = $_SERVER['HTTP_REFERER'];
	$REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
	$PHP_SELF = $_SERVER['PHP_SELF'];

	define(REMOTE_ADDR, $_SERVER['REMOTE_ADDR']);
	define(HTTP_REFERER, $_SERVER['HTTP_REFERER']);
	define(PHP_SELF, $_SERVER['PHP_SELF']);
	define(DOCUMENT_ROOT, $_SERVER['DOCUMENT_ROOT']);
	define(CLASS_DIR, $CLASS_DIR);
	define(LIBRARY_DIR, $LIBRARY_DIR);
	define(SKIN_DIR, $SKIN_DIR);
?>
