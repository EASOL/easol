<?php

function menu_items() {
	$ci = &get_instance();
	$ci->config->load('menu');
	$menu = $ci->config->item('menu');

	$menu_group = $ci->config->item('menu_group');

	$menu_items = [];

	foreach ($menu as $slug=>$item) {
		if (!empty($item['parent'])) $menu_items[$item['parent']]['submenu'][$slug] = $item;
		elseif ($item['group']) {
			if (!isset($menu_items[$item['group']])) {
				if (isset($menu_group[$item['group']])) $menu_items[$item['group']] = $menu_group[$item['group']];
				else $menu_items[$item['group']] = [];
			}
			$menu_items[$item['group']]['type'] = 'group';
			$menu_items[$item['group']]['items'][$slug] = $item;

		}
		else $menu_items[$slug] = $item;
	}

	return $menu_items;
}
