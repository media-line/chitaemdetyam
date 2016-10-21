<?php

defined('_JEXEC') or die;
?>


<div class="uk-mod-link uk-mod-title<?php echo $moduleclass_sfx ?>" >
	<?php if($params->get('link')):?>
	<a href="<?php echo $params->get('link');?>">
		<?php if($params->get('text')) echo $params->get('text');?>
	</a>
	<?php else:?>
		<?php if($params->get('text')) echo $params->get('text');?>
	<?php endif;?>
</div>
