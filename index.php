<?php
require_once "load.php";

$ObjLayouts = new layouts();
$ObjMenus = new menus();
$ObjContents = new contents();


$ObjLayouts->heading();
$ObjMenus->main_menu();
$ObjContents->about_content();
$ObjContents->sidebar();
$ObjLayouts->footer();
