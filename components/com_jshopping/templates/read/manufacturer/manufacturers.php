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
<?php if ($this->params->get('show_page_heading') && $this->params->get('page_heading')) : ?>    
    <div class="shophead<?php print $this->params->get('pageclass_sfx');?>">
        <div class="uk-h1 uk-text-bold uk-text-black uk-margin-large-bottom"><?php print $this->params->get('page_heading')?></div>
    </div>
<?php endif; ?>

<div class="jshop" id="comjshop">

    <div class="manufacturer_description">
        <?php print $this->manufacturer->description?>
    </div>

    <?php $rowsCount = count($this->rows);
	$remainder = ($rowsCount % 2);
	$firstColumn = $secondColumn = $rowsInColumn = ($rowsCount-$remainder)/2;
	if ($remainder == 1){
		$firstColumn = $rowsInColumn + 1;
	}
/*	if ($remainder == 2){
		$firstColumn = $rowsInColumn + 1;
		$secondColumn = $rowsInColumn + 1;
	}*/
	$firstLetter = '';
	
	if ($rowsCount) : ?>
    <div class="jshop_list_manufacturer">
        <div class = "jshop uk-grid">
			<div class = "uk-width-1-2">
            <?php 
			$count = 1;
			foreach($this->rows as $k=>$row) : ?>
            
                <?php if ($k % $this->count_manufacturer_to_row == 0) : ?>
                    <div class = "row-fluid">
                <?php endif; ?>
                
                <div class = "sblock<?php echo $this->count_manufacturer_to_row?> jshop_categ manufacturer">
                    <?php /*<div class = "sblock2 image">
                        <a href = "<?php print $row->link;?>">
                            <img class = "jshop_img" src = "<?php print $this->image_manufs_live_path;?>/<?php if ($row->manufacturer_logo) print $row->manufacturer_logo; else print $this->noimage;?>" alt="<?php print htmlspecialchars($row->name);?>" />
                        </a>
                    </div>*/?>
                    <div>
                        <div class="manufacturer_name">
                            <a class = "product_link" href = "<?php print $row->link?>">
								<?php/* print_r(mb_substr($row->name,0,1)); */?>
                                <?php print $row->name?>
                            </a>
                        </div>
                        <p class = "manufacturer_short_description uk-margin-remove">
                            <?php print $row->short_description?>
                        </p>
                        <?php if ($row->manufacturer_url != "") : ?>
                            <div class="manufacturer_url">
                                <a target="_blank" href="<?php print $row->manufacturer_url?>">
                                    <?php print _JSHOP_MANUFACTURER_INFO?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <?php if ($k % $this->count_manufacturer_to_row == $this->count_manufacturer_to_row - 1) : ?>
                    <div class = "clearfix"></div>
                    </div>
                <?php endif; 
				
				if($count == $firstColumn) echo '</div><div class = "uk-width-1-2">'; 
                $count++;
				
            endforeach; ?>
            </div>
            <?php if ($k % $this->count_manufacturer_to_row != $this->count_manufacturer_to_row - 1) : ?>
                <div class = "clearfix"></div>
                </div>
            <?php endif; ?>
            
        </div>
    </div>
    <?php endif; ?>
</div>