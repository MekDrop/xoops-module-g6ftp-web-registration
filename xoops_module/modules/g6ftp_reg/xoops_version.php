<?php
// $Id: xoops_version.php,v 1.1.2.14 2005/08/04 22:14:23 phppp Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author: Kazumi Ono (AKA onokazu)                                          //
// URL: http://www.myweb.ne.jp/, http://www.xoops.org/, http://jp.xoops.org/ //
// Project: The XOOPS Project                                                //
// ------------------------------------------------------------------------- //

$modversion['name'] = _G6FR_MI_NAME;
$modversion['version'] = 0.1;
$modversion['description'] = _G6FR_MI_DESC;
$modversion['author'] = "MekDrop";
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = 0;
$modversion['image'] = "images/logo.jpeg";
$modversion['dirname'] = "g6ftp_reg";

// Admin things
$modversion['hasAdmin'] = 1;

// Templates
$modversion['templates'][1]['file'] = 'index.tpl';
$modversion['templates'][1]['description'] = '';

// Menu
$modversion['hasMain'] = 1;

$modversion['config'][]=array(
	'name' => 'g6path',
	'title' => '_G6FR_MI_G6PATH',
	'description' => '_G6FR_MI_G6PATH_DESC',
	'formtype' => 'textbox',
	'valuetype' => 'text',
	'default' => "C:\\Program Files\\Gene6 FTP Server");

$modversion['config'][]=array(
	'name' => 'host',
	'title' => '_G6FR_MI_HOST',
	'description' => '_G6FR_MI_HOST_DESC',
	'formtype' => 'textbox',
	'valuetype' => 'text',
	'default' => 'someone.lt');

$modversion['config'][]=array(
	'name' => 'country',
	'title' => '_G6FR_MI_COUNTRY',
	'description' => '_G6FR_MI_COUNTRY_DESC',
	'formtype' => 'textbox',
	'valuetype' => 'text',
	'default' => 'LT');

$modversion['config'][]=array(
	'name' => 'group',
	'title' => '_G6FR_MI_GROUP',
	'description' => '_G6FR_MI_GROUP_DESC',
	'formtype' => 'textbox',
	'valuetype' => 'text',
	'default' => 'anonymous');

$modversion['config'][]=array(
	'name' => 'template',
	'title' => '_G6FR_MI_TEMPLATE',
	'description' => '_G6FR_MI_TEMPLATE_DESC',
	'formtype' => 'textbox',
	'valuetype' => 'text',
	'default' => '');

?>