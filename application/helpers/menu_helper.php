<?php

function menu_items() {
	$ci = &get_instance();
	$ci->config->load('menu');
	$menu = $ci->config->item('menu');

	$menu_items = [];

	foreach ($menu as $slug=>$item) {
		if (!empty($item['parent'])) $menu_items[$item['parent']]['submenu'][$slug] = $item;
		else $menu_items[$slug] = $item;
	}

	return $menu_items;
}
