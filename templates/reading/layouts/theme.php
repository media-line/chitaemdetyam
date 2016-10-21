<?php
/**
* @package   yoo_master2
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// get theme configuration
include($this['path']->path('layouts:theme.config.php'));

?>
<!DOCTYPE HTML>
<html lang="<?php echo $this['config']->get('language'); ?>" dir="<?php echo $this['config']->get('direction'); ?>"  data-config='<?php echo $this['config']->get('body_config','{}'); ?>'>

<head>
<?php echo $this['template']->render('head'); ?>
<meta name="viewport" content="width=1150" />
</head>

<body class="<?php echo $this['config']->get('body_classes'); ?>">

	<div class="uk-container uk-container-center">

		<?php if ($this['widgets']->count('toolbar-l + toolbar-r')) : ?>
		<div class="tm-toolbar uk-clearfix">

			<?php if ($this['widgets']->count('toolbar-l')) : ?>
			<div class="uk-float-left"><?php echo $this['widgets']->render('toolbar-l'); ?></div>
			<?php endif; ?>

			<?php if ($this['widgets']->count('toolbar-r')) : ?>
			<div class="uk-float-right"><?php echo $this['widgets']->render('toolbar-r'); ?></div>
			<?php endif; ?>

		</div>
		<?php endif; ?>

		<?php if ($this['widgets']->count('logo + headerbar + menu + search')) : ?>
		<div class="tm-headerbar uk-clearfix">

			<?php if ($this['widgets']->count('logo')) : ?>
			<div class="uk-float-left">
				<a class="tm-logo" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo'); ?></a>
			</div>
			<?php endif; ?>

			
			<nav class="tm-navbar uk-navbar uk-float-right uk-margin-remove">

				<?php if ($this['widgets']->count('menu')) : ?>
				<?php echo $this['widgets']->render('menu'); ?>
				<?php endif; ?>

				<?php if ($this['widgets']->count('offcanvas')) : ?>
				<a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
				<?php endif; ?>

				<?php if ($this['widgets']->count('search')) : ?>
				<div class="uk-navbar-flip">
					<div class="uk-navbar-content uk-hidden-small"><?php echo $this['widgets']->render('search'); ?></div>
				</div>
				<?php endif; ?>

				<?php if ($this['widgets']->count('logo-small')) : ?>
				<div class="uk-navbar-content uk-navbar-center uk-visible-small"><a class="tm-logo-small" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo-small'); ?></a></div>
				<?php endif; ?>

			</nav>
			
			<?php echo $this['widgets']->render('headerbar'); ?>
		</div>
		<?php endif; ?>
	</div>
		
	<?php if ($this['widgets']->count('slider')) : ?>
		<div class="uk-slider-wrapper">
			<?php echo $this['widgets']->render('slider'); ?>
		</div>
	<?php endif; ?>

	<?php if ($this['widgets']->count('top-a')) : ?>
		<div class="uk-bookshelf-wrapper">	
			<div class="uk-container uk-container-center">	
				<section id="tm-top-a" class="<?php echo $grid_classes['top-a']; echo $display_classes['top-a']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-a', array('layout'=>$this['config']->get('grid.top-a.layout'))); ?></section>
			</div>
		</div>
	<?php endif; ?>
	
	<div class="uk-container uk-container-center">	
		<?php if ($this['widgets']->count('top-b')) : ?>
		<section id="tm-top-b" class="<?php echo $grid_classes['top-b']; echo $display_classes['top-b']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-b', array('layout'=>$this['config']->get('grid.top-b.layout'))); ?></section>
		<?php endif; ?>
	</div>
	
	<?php if ($this['widgets']->count('main-top + main-bottom + sidebar-a + sidebar-b') || $this['config']->get('system_output', true)) : ?>
	<div class="uk-container uk-container-center">	
		<div id="tm-middle" class="tm-middle uk-grid" data-uk-grid-match data-uk-grid-margin>
	
			<?php if ($this['widgets']->count('main-top + main-bottom') || $this['config']->get('system_output', true)) : ?>
			<div class="<?php echo $columns['main']['class'] ?>">

				<?php if ($this['widgets']->count('main-top')) : ?>
				<section id="tm-main-top" class="<?php echo $grid_classes['main-top']; echo $display_classes['main-top']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('main-top', array('layout'=>$this['config']->get('grid.main-top.layout'))); ?></section>
				<?php endif; ?>

				<?php if ($this['config']->get('system_output', true)) : ?>
				<main id="tm-content" class="tm-content">

					<?php if ($this['widgets']->count('breadcrumbs')) : ?>
					<?php echo $this['widgets']->render('breadcrumbs'); ?>
					<?php endif; ?>

					<?php echo $this['template']->render('content'); ?>

				</main>
				<?php endif; ?>

				<?php if ($this['widgets']->count('main-bottom')) : ?>
				<section id="tm-main-bottom" class="<?php echo $grid_classes['main-bottom']; echo $display_classes['main-bottom']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('main-bottom', array('layout'=>$this['config']->get('grid.main-bottom.layout'))); ?></section>
				<?php endif; ?>

			</div>
			<?php endif; ?>

            <?php foreach($columns as $name => &$column) : ?>
            <?php if ($name != 'main' && $this['widgets']->count($name)) : ?>
            <aside class="<?php echo $column['class'] ?>"><?php echo $this['widgets']->render($name) ?></aside>
            <?php endif ?>
            <?php endforeach ?>

		</div>
	</div>
	<?php endif; ?>
	<?php if ($this['widgets']->count('bottom-a')) : ?>
		<div class="uk-container uk-container-center">
			<section id="tm-bottom-a" class="<?php echo $grid_classes['bottom-a']; echo $display_classes['bottom-a']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-a', array('layout'=>$this['config']->get('grid.bottom-a.layout'))); ?></section>
		</div>
	<?php endif; ?>
	
	
	<?php if ($this['widgets']->count('bottom-b')) : ?>
		<div class="uk-orange-wrapper">
			<div class="uk-container uk-container-center">
				<section id="tm-bottom-b" class="<?php echo $grid_classes['bottom-b']; echo $display_classes['bottom-b']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-b', array('layout'=>$this['config']->get('grid.bottom-b.layout'))); ?></section>
			</div>
		</div>
	<?php endif; ?>
	
	<?php if ($this['widgets']->count('footer + debug') || $this['config']->get('warp_branding', true) || $this['config']->get('totop_scroller', true)) : ?>
	<footer id="tm-footer" class="tm-footer uk-margin-remove">
		<div class="uk-container uk-container-center uk-clearfix">	
			<?php if ($this['config']->get('totop_scroller', true)) : ?>
			<a class="tm-totop-scroller" data-uk-smooth-scroll href="#"></a>
			<?php endif; ?>
			<div class="uk-float-left">
			<?php
				echo $this['widgets']->render('footer');
				$this->output('warp_branding');
				echo $this['widgets']->render('debug');
			?>
			</div>
			<div class="uk-medialine uk-float-right uk-text-right uk-text-black uk-h6">
				<span><?php echo JText::_("TPL_COPYRIGHTS_TEXT"); ?> </span>
				<a class="" title="<?php echo JText::_("TPL_COPYRIGHTS_TEXT")." ".JText::_("TPL_COPYRIGHTS_LINK"); ?>" target="_blank" href="http://www.medialine.by"><?php echo JText::_("TPL_COPYRIGHTS_LINK");?></a>
				<?php echo date();?>
			</div>
		</div>
	</footer>
	<?php endif; ?>
	<hr>
	
	<?php if ($this['widgets']->count('modal-button')) : ?>
		<div class="uk-modal-button">
			<?php echo $this['widgets']->render('modal-button'); ?>
		</div>
	<?php endif; ?>	
	
	<?php if ($this['widgets']->count('modal')) : ?>
		<div id="modal" class="uk-modal">
			<div class="uk-modal-dialog">
				<a class="uk-modal-close uk-close"></a>
				<?php echo $this['widgets']->render('modal'); ?>
			</div>
		</div>
	<?php endif; ?>
	
	<?php echo $this->render('footer'); ?>

	<?php if ($this['widgets']->count('offcanvas')) : ?>
	<div id="offcanvas" class="uk-offcanvas">
		<div class="uk-offcanvas-bar"><?php echo $this['widgets']->render('offcanvas'); ?></div>
	</div>
	<?php endif; ?>
	
	<?php if ($this['widgets']->count('metrics')) : ?>
		<?php echo $this['widgets']->render('metrics'); ?>
	<?php endif; ?>
</body>
</html>