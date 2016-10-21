<?php
/**
* @version      4.0.0 10.09.2013
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

    defined('_JEXEC') or die('Restricted access');
    
    require_once (JPATH_SITE.'/components/com_jshopping/lib/factory.php'); 
    require_once (JPATH_SITE.'/components/com_jshopping/lib/functions.php');
    $jshopConfig = JSFactory::getConfig();
    $mainframe = JFactory::getApplication(); 	
	
	$db=JFactory::getDBO();
	$sql = 'SELECT `name_ru-RU`, `category_id` FROM `#__jshopping_categories` ORDER BY category_id ASC';
	$db->setQuery($sql);
	$categories = $db->loadObjectList();
	
	// get displayed extrafields
	$db=JFactory::getDBO();
	$sql = 'SELECT `filter_display_extra_fields` FROM `#__jshopping_config`';
	$db->setQuery($sql);
	$displayed = $db->loadObjectList();
	$displayed = implode(',', unserialize($displayed[0]->filter_display_extra_fields));

	$sql = 'SELECT `id`, `name_ru-RU` FROM `#__jshopping_products_extra_fields` WHERE type=0 AND id IN ('.$displayed.')';
	$db->setQuery($sql);
	$extraFields = $db->loadObjectList();	
		
	$sql = 'SELECT `field_id`, `id`, `name_ru-RU` FROM `#__jshopping_products_extra_field_values` ORDER BY `name_ru-RU`';
	$db->setQuery($sql);
	$extraValues = $db->loadObjectList();	
?>

<div class="mod_jshop_filter_gr">
	<form method="get" action="/component/jshopping/category/view/13" class="uk-form">
		<?php/*Категория:
		<form method="get" action="/component/jshopping/category/view/<?php echo JRequest::getInt('category_id');?>?Itemid=0" class="uk-form">
		
		<select name="category_id" class="filter_category filter_hide">
		<?php for ($i = 0; $i < count($categories); $i++) {
			echo '<option value="'.$categories[$i]->category_id.'">'.$categories[$i]->{'name_ru-RU'}.'</option>';
		} ?>
		</select>*/?>
		
		<?php
			require_once (dirname(__FILE__).'/helper.php');

			require_once (JPATH_SITE.'/components/com_jshopping/lib/factory.php'); 
		//	require_once (JPATH_SITE.'/components/com_jshopping/lib/jtableauto.php');
		//	require_once (JPATH_SITE.'/components/com_jshopping/tables/config.php'); 
		//	require_once (JPATH_SITE.'/components/com_jshopping/lib/functions.php');
			
			$field_sort = $params->get('sort', 'id');
			$ordering = $params->get('ordering', 'asc');
			$show_image = $params->get('show_image',0);
	
			$category_id = JRequest::getInt('category_id');
			$category = JTable::getInstance('category', 'jshop');        
			$category->load($category_id);
			$categories_id = $category->getTreeParentCategories();
			
			$cat = JTable::getInstance('category', 'jshop');        
            $cat->load($categories_id[0]);
			//$cat->category_id = $category_id;
			$childs = $cat->getChildCategories($category_id);
			//$categories_arr = jShopCategoriesHelper::getCatsArray($field_sort, $ordering, $category_id, $categories_id);
			
			//print_r ($childs); ?>
		<input name="isfiltered" type="hidden" value="1">
		<?php/* foreach ($childs as $child) {
			echo '<input name="category_id" type="hidden" value="'.$child->category_id.'">';
		} */?>

		<?php for ($i = 0; $i < count($extraFields); $i++) { ?>
			<div class="uk-form-row filter_field_<?php echo $extraFields[$i]->id; ?>">
				<div class=""><?php echo $extraFields[$i]->{'name_ru-RU'}; ?>:</div>
				<select class="uk-width-1-1" name="extra_fields[<?php echo $extraFields[$i]->id; ?>][]">
					<option>Не важно</option>
					<?php for ($j = 0; $j < count($extraValues); $j++) {
						if ($extraValues[$j]->field_id == $extraFields[$i]->id) {
							echo '<option value="'.$extraValues[$j]->id.'">'.$extraValues[$j]->{'name_ru-RU'}.'</option>';
						}
					} ?>
				</select>
			</div>
		<?php } ?>
		<div class="uk-margin-large-top uk-clearfix">
			<button class="uk-button uk-button-small-filter uk-float-left"><span>Подобрать</span></button>
			<button class="uk-button uk-button-small-filter uk-float-right" onclick="modFilterclearPriceFilter();return false;"><span>Очистить</span></button>
		</div>
	</form>
</div>

<script type="text/javascript">
function modFilterclearPriceFilter(){
    jQuery("#fprice_from").val("");
    jQuery("#fprice_to").val("");
    document.jshop_filters.submit();
}

	jQuery(document).ready(function() {
	
		jQuery.ajax({
			type: "POST",
			url: "/modules/mod_jshop_filter_gr/add_filter.php",
			data: {"category": 1},
			success: function(msg){
				var showId = msg.split(',');
				for (var i=0; i< showId.length; i++) {
					jQuery('.filter_field_'+showId[i]).addClass('filter_field_show');
				}
			} 
		});			
	
	
		jQuery('.filter_cat_active').click(function() {	
			if (jQuery(".img_top").hasClass('img_hide')) {
				jQuery(".img_top").removeClass('img_hide');
				jQuery(".img_bottom").addClass('img_hide');
				jQuery(".filter_category").addClass('filter_hide');
			} else {
				jQuery(".img_bottom").removeClass('img_hide');
				jQuery(".img_top").addClass('img_hide');	
				jQuery(".filter_category").removeClass('filter_hide');				
			}			
		});		
	
		jQuery('.filter_change').click(function() {	
			if (jQuery(this).find(".filter_img_top").hasClass('img_hide')) {
				jQuery(this).find(".filter_img_top").removeClass('img_hide');
				jQuery(this).find(".filter_img_bottom").addClass('img_hide');
				jQuery(this).siblings('select').addClass('filter_hide');
			} else {
				jQuery(this).find(".filter_img_bottom").removeClass('img_hide');
				jQuery(this).find(".filter_img_top").addClass('img_hide');		
				jQuery(this).siblings('select').removeClass('filter_hide');				
			}			
		});		
		
		jQuery('.filter_category').change(function() {
			var categoryId = jQuery('.filter_category').val();
			var selectCategory = jQuery(".filter_category option:selected" ).text();
			jQuery(".filter_cat_active .text").html(selectCategory);
			
			jQuery.ajax({
				type: "POST",
				url: "/modules/mod_jshop_filter_gr/add_filter.php",
				data: {"category": categoryId},
				success: function(msg){
					jQuery('.filter_field').removeClass('filter_field_show');
					var showId = msg.split(',');
					for (var i=0; i< showId.length; i++) {
						jQuery('.filter_field_'+showId[i]).addClass('filter_field_show');
					}
				} 
			});		
		});
	});
</script>