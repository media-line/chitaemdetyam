<?php 
/**
* @version      4.11.0 17.09.2015
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');

print $this->_tmp_category_html_start;
?>
<div class="jshop" id="comjshop">
    <div class="tm-title uk-h1 uk-text-black"><?php print $this->category->name?></div>
    <div class="category_description">
        <?php print $this->category->description?>
    </div>

    <div class="jshop_list_category">
    <?php if ((count($this->categories)) && (JRequest::getInt('category_id') != 13) && (JRequest::getInt('isfiltered') != 1)) : ?>
        <div class = "jshop list_category uk-grid">
            <?php (count($this->categories) - count($this->categories) %3)/3; ?>
            <?php foreach($this->categories as $k=>$category) : ?>
            
                <?php if ($k % $this->count_category_to_row == 0) : ?>
                    <div class = "row-fluid">
                <?php endif; ?>
                
                <div class = "sblock<?php echo $this->count_category_to_row;?> jshop_categ category uk-margin-small-bottom">
                    <?php /*<div class = "sblock2 image">
                        <a href = "<?php print $category->category_link;?>">
                            <img class="jshop_img" src="<?php print $this->image_category_path;?>/<?php if ($category->category_image) print $category->category_image; else print $this->noimage;?>" alt="<?php print htmlspecialchars($category->name)?>" title="<?php print htmlspecialchars($category->name)?>" />
                        </a>
                    </div>
					*/?>
                    <div class = "sblock2">
                        <div class="category_name">
                            <a class="uk-category-link" href = "<?php print $category->category_link?>">
                                <?php print $category->name?>
                            </a>
                        </div>
                        <p class = "category_short_description uk-margin-remove">
                            <?php print $category->short_description?>
                        </p>                       
                    </div>
                </div>
                
                <?php if ($k % $this->count_category_to_row == $this->count_category_to_row - 1) : ?>
                    <div class = "clearfix"></div>
                    </div>
                <?php endif; ?>
                
            <?php endforeach; ?>
            
            <?php if ($k % $this->count_category_to_row != $this->count_category_to_row - 1) : ?>
                <div class = "clearfix"></div>
                </div>
            <?php endif; ?>
            
        </div>
    <?php endif; ?>
    </div>
        
    <?php // if(((JRequest::getInt('isfiltered') == 1) || (JRequest::getInt('category_id') == 13)) && ((JRequest::getInt('category_id') != 2) && (JRequest::getInt('category_id') != 3) && (JRequest::getInt('category_id') != 4) && (JRequest::getInt('category_id') != 5))){
			if (JRequest::getInt('isfiltered') == 1){
				include(dirname(__FILE__)."/products.php");
			} else if((JRequest::getInt('category_id') != 2) && (JRequest::getInt('category_id') != 3) && (JRequest::getInt('category_id') != 4) && (JRequest::getInt('category_id') != 5)){
				include(dirname(__FILE__)."/products.php");
			}
			/*if((JRequest::getInt('category_id') != 2) 
			&& (JRequest::getInt('category_id') != 3)
			&& (JRequest::getInt('category_id') != 4)
			&& (JRequest::getInt('category_id') != 5)){
				
				include(dirname(__FILE__)."/products.php");
	
			}*/
	?>
	
	<?php print $this->_tmp_category_html_end;?>
</div>