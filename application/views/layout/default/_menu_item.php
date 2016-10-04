<?php if (Easol_AuthorizationRoles::hasAccess($item['auth'])): ?>
<li class="<?php echo ($this->router->fetch_class() == $slug) ? 'active-menu' : '' ?>" <?php echo (isset($item['attr'])) ? $item['attr'] : '' ?>>
	<a id="<?php echo $slug; ?>" href="<?php echo (isset($item['url'])) ? site_url($item['url']) : site_url($slug) ?>">
		<i class="fa fa-<?php echo $item['icon'] ?>"></i>
		<?php echo $item['label'] ?>
	</a>
	<?php if (!empty($item['submenu'])): ?>

		<ul class="sub-menu">

			<?php foreach ($item['submenu'] as $submenu_slug => $submenu_item) : ?>
				<?php if (empty($submenu_item['auth']))
					$submenu_item['auth'] = $item['auth']; ?>
				<?php if (!empty($submenu_item['auth']) && !Easol_AuthorizationRoles::hasAccess($submenu_item['auth'], $submenu_slug))
					continue; ?>
				<li class="<?php echo ($this->router->fetch_class() == $submenu_slug) ? 'active-menu sublive' : '' ?>">
					<a id="<?php echo $submenu_slug; ?>" href="<?php echo (isset($submenu_item['url'])) ? site_url($submenu_item['url']) : site_url($submenu_slug) ?>">
						<?php echo $submenu_item['label'] ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

</li>
<?php endif; 