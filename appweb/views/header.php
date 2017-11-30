<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->helper('html');
$this->load->helper('html');
	echo doctype('xhtml1-trans'), PHP_EOL,'<html xmlns="http://www.w3.org/1999/xhtml">', PHP_EOL;
	echo '<head>', PHP_EOL;
	include FCPATH.APPPATH.config_item('defsview').'/headersets.php';
		echo meta($meta);
		echo link_tag($linkappcss);		// link css estilo apariencia sin especificar clases en cada tag
		echo link_tag($linkpickathingcss);		// link css estilo apariencia para poder llenar los combos select con input search
		echo link_tag($vanilladatatablescss);		// link css estilo apariencia para poder llenar los combos select con input search
		echo script_tag($linkappcssjs);
		echo script_tag($linkbrownavdecsjs);
		echo script_tag($linkdatepickerurl);	// comportamiento de selector de fechas sin usar jquery, 1005 compatible con cualqueir navegador
	echo '</head>', PHP_EOL;
	?>
	<body onload = 'checkAvailable()' >
		<div class="menu ">
			<center>
				<!--<img src="<?php //echo $giflogo ?>" alt="Logo VNX Codeigniter" width="880" height="24" />-->
				<!--<?php //echo $menu.PHP_EOL?>-->
			</center>
		</div>
	<center>
