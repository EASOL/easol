<?php

$GLOBALS['js'] = array();
$GLOBALS['css'] = array();
$GLOBALS['widget'] = array();

$GLOBALS['assets_lib'] = array(
	'datatables'=>array(
		'css'=>array(
			'lib/DataTables-1.10.11/media/css/jquery.dataTables.css',
			'lib/DataTables-1.10.11/media/css/dataTables.bootstrap.css',
			//'lib/DataTables-1.10.11/extensions/Responsive/css/responsive.dataTables.css',
			//'lib/DataTables-1.10.11/extensions/Responsive/css/responsive.bootstrap.css',
			'lib/DataTables-1.10.11/extensions/Buttons/css/buttons.dataTables.css',	
			'lib/DataTables-1.10.11/extensions/Buttons/css/buttons.bootstrap.css',		
			'lib/DataTables-1.10.11/extensions/ColVis/css/dataTables.colVis.css',

			'lib/DataTables-1.10.11/extensions/CSV/dataTables.CSV.css',
		),
		'js'=>array(
			'lib/DataTables-1.10.11/media/js/jquery.dataTables.js',
			'lib/DataTables-1.10.11/media/js/dataTables.bootstrap.js',
			//'lib/DataTables-1.10.11/extensions/Responsive/js/dataTables.responsive.js',
			//'lib/DataTables-1.10.11/extensions/Responsive/js/responsive.bootstrap.js',
			'lib/DataTables-1.10.11/extensions/Buttons/js/dataTables.buttons.js',
			'lib/DataTables-1.10.11/extensions/Buttons/js/buttons.bootstrap.js',
			'lib/DataTables-1.10.11/extensions/Buttons/js/buttons.colVis.js',

			'lib/DataTables-1.10.11/extensions/CSV/dataTables.CSV.js',
			
		)
	),
	'chardinjs'=>array(
		'css'=>array('lib/chardinjs/chardinjs.css'),
		'js'=>array('lib/chardinjs/chardingjs.js')
	),
	'bootstrap-toggle'=>array(
		'css'=>array('//gitcdn.github.io/bootstrap-toggle/2.2.0/css/bootstrap-toggle.css'),
		'js'=>array('//gitcdn.github.io/bootstrap-toggle/2.2.0/js/bootstrap-toggle.js')
	),
	'nvd3'=>array(
		'js'=>array(
			'lib/nvd3/d3.js',
			'lib/nvd3/nv.d3.js'			
		),
		'css'=>array(
			'lib/nvd3/nv.d3.css'
		)
	),
	'list'=>array(
		'js'=>array('lib/list.js')
	),
	'colorpicker'=>array(
		'js'=>array(
			'lib/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js',
			'lib/bootstrap-colorpicker-plus/dist/js/bootstrap-colorpicker-plus.js',
			'widgets/colorpicker/colorpicker.js'
		),
		'css'=>array(
			'lib/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css',
			'lib/bootstrap-colorpicker-plus/dist/css/bootstrap-colorpicker-plus.css'
		)
	)
);

function assets_js($file) {
	$GLOBALS['js'][] = $file;
}
function assets_css($file) {
	$GLOBALS['css'][] = $file;
}

function assets_widget($widget) {
	$GLOBALS['widget'][] = $widget;
}

function assets_lib($lib) {

	$files = $GLOBALS['assets_lib'][$lib];
	if (!empty($files['css'])) {
		foreach ($files['css'] as $css) {
			assets_css($css);
		}
	}
	if (!empty($files['js'])) {
		foreach ($files['js'] as $js) {
			assets_js($js);
		}
	}
}
