<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

		$giflogo = base_url() . APPPATH . 'media/01.gif';

		$pathcss = base_url() . APPPATH . 'styles/'; $typcs='text/css';
		$pathjsc = base_url() . APPPATH . 'scripts/'; $typjs='text/javascript';

		$metaline1 = array('name' => 'description', 'content' => 'Sistema Repositorio de Catalago');
		$metaline2 = array('name' => 'keywords', 'content' => 'productos, administracion, catalogo, sistemas');
		$metaline3 = array('name' => 'Content-type', 'content' => 'text/html; charset='.config_item('charset'), 'type' => 'equiv');
		$metaline4 = array('name' => 'Cache-Control', 'content' => 'no-cache, no-store, must-revalidate, max-age=0, post-check=0, pre-check=0', 'type' => 'equiv');
		$metaline5 = array('name' => 'Last-Modified', 'content' => gmdate("D, d M Y H:i:s") . ' GMT', 'type' => 'equiv');
		$metaline6 = array('name' => 'pragma', 'content' => 'no-cache', 'type' => 'equiv');
		$metalines = array('name' => 'Content-Security-Policy', 'content' => '');

		$linkappcss = array('type'=>$typcs,'rel'=>'stylesheet','href' => $pathcss.'cibootstrap.css?'.time()); // script de css sin tener que especificar clases en cada tag
		$linkappcssjs = array('type'=>$typjs,'src' => $pathjsc.'cibootstrap.js?'.time()); // script de css sin tener que especificar clases en cada tag
		$linkdatepickerurl = array('type'=>$typjs,'src' => $pathjsc.'datetimepicker.js?'.time());
		$linkpickathingcss = array('type'=>$typcs,'rel'=>'stylesheet','href' => $pathcss.'pickathing.css?'.time()); // script de css para selects combos pero con inputs search
		$vanilladatatablescss = array('type'=>$typcs,'rel'=>'stylesheet','href' => $pathcss.'vanilla-dataTables.css?'.time()); // script de css para vanilla data tables

		$meta = array( $metaline1, $metaline2, $metaline3, $metaline4, $metaline5, $metaline6 );
?>
