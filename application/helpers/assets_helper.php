<?php

$GLOBALS['js'] = array();
$GLOBALS['css'] = array();
$GLOBALS['widget'] = array();

$GLOBALS['assets_lib'] = array(
	'datatables'=>array(
		'css'=>array(
			'lib/datatables/css/jquery.dataTables.css',
			'//cdn.datatables.net/1.10.9/css/dataTables.bootstrap.css',
			'lib/datatables/css/dataTables.CSV.css'
		),
		'js'=>array(
			'lib/datatables/js/jquery.dataTables.js',
			'lib/datatables/js/dataTables.bootstrap.js',
			'lib/datatables/js/dataTables.CSV.js',
			'lib/datatables/js/dataTables.bootstrapPagination.js'
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
		'js'=>'lib/list.js'
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
