<?php 
/**
* @version      4.9.1 13.08.2013
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');
?>
<div class="jshop list_product" id="comjshop_list_product">
<?php print $this->_tmp_list_products_html_start?>
<?php foreach ($this->rows as $k=>$product) : ?>
    <?php if ($k % $this->count_product_to_row == 0) : ?>
        <div class = "row-fluid">
    <?php endif; ?>
    
    <div class = "sblock<?php echo $this->count_product_to_row;?>">
        <div class = "block_product">
            <?php include(dirname(__FILE__)."/".$product->template_block_product);?>
        </div>
    </div>
            
    <?php if ($k % $this->count_product_to_row == $this->count_product_to_row - 1) : ?>
        <div class = "clearfix"></div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<?php if ($k % $this->count_product_to_row != $this->count_product_to_row - 1) : ?>
    <div class = "clearfix"></div>
    </div>
<?php endif; ?>
<?php 
if(!strpos(JURI::current(), 'search/result')){
		
	$product = JTable::getInstance('product', 'jshop');
	$db=JFactory::getDBO();

	$sql = 'SELECT `id` FROM `#__jshopping_products_extra_field_values` WHERE `field_id` = 22 AND `name_ru-RU` = "'.$this->manufacturer->{'name_ru-RU'}.'"';
	$db->setQuery($sql);
	$extraManufacturerId = $db->loadObjectList();

	if ($extraManufacturerId[0]->id != ''){
	$sql = 'SELECT `product_id` FROM `mzelq_jshopping_products` WHERE `extra_field_22` like "%'.$extraManufacturerId[0]->id.'%" ORDER BY `product_id` DESC';
	$db->setQuery($sql);
	$productsId = $db->loadObjectList();
	if ($productsId != ''){
	foreach ($productsId as $id){
		$product->load($id->product_id);
		$productExtraFields = $product->getExtraFields();
		print_r($product->image);
		?>
		<div class="row-fluid">
			<div class="sblock1">
				<div class="block_product">
					<div class="product productitem_<?php print $product->product_id?> uk-grid">
						<div class="uk-width-1-1 uk-teaser-description">
							<div class="uk-teaser-title uk-text-bold">
								<a href="/component/jshopping/product/view/13/<?php print $product->product_id?>">
									<?php print $product->{'name_ru-RU'}?>
								</a>
							</div>
							
							<?php /*
							<div class="manufacturer_name uk-grid uk-grid-collapse">
								<div class="uk-width-1-4">Автор:</div>
								<div class="uk-width-3-4"><?php print $product->getManufacturerInfo()->name; ?></div>
							</div>
							*/?>
							<?php/* Характеристики
							<?php if (is_array($productExtraFields)){?>
								<div class="extra_fields uk-width-1-1 uk-grid uk-grid-collapse">
									<?php foreach($productExtraFields as $extrafield){?>
										<?php 
											$hideExtraArray = array(1,7,8,14,15,18,19,20,21,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92);
											if (!in_array($extrafield['id'], $hideExtraArray)): ?>
											<div class=" uk-width-1-1 uk-grid uk-grid-collapse">
												<div class="label-name uk-width-1-4"><?php print $extrafield['name'];?>:</div>
												<div class="data uk-width-3-4"><?php print $extrafield['value'];?></div>
											</div>
										<?php endif;?>
									<?php }/*?>
									<div class="image_block">
										<a class="lightbox" id="main_image_full_<?php print $product->product_id?>" href="<?php if($product->image != '') echo $product->image; else echo '/components/com_jshopping/files/img_products/noimage.gif';?>" data-lightbox-type="image" data-uk-lightbox="on">
											<img class="jshop_img uk-teaser-image" id="main_image_full_<?php print $product->product_id?>" src="<?php if($product->image != '') echo $product->image; else echo '/components/com_jshopping/files/img_products/noimage.gif';?>" alt="<?php print htmlspecialchars($product->{'name_ru-RU'});?>" title="<?php print htmlspecialchars($product->{'name_ru-RU'});?>"  />
										</a>
									</div>
									?>//конец блока с изображением
								</div>            
							<?php }?>
							*/?>
							
							<div class="uk-teaser-text">
								<?php print $product->short_description?>
							</div>
							
							<?php /*
							<div class="buttons">

								<a class="uk-button uk-button-small uk-teaser-readmore uk-position-absolute" href="/component/jshopping/product/view/13/<?php print $product->product_id?>?Itemid=0">
									<?php print _JSHOP_DETAIL?>
								</a>
								
							</div>*/?>
							
						</div>
						
					</div>		
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
<?php	
	}
	}
	}
}
?>
<?php print $this->_tmp_list_products_html_end;?>
</div>