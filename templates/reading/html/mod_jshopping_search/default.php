<script type = "text/javascript">
function isEmptyValue(value){
    var pattern = /\S/;
    return ret = (pattern.test(value)) ? (true) : (false);
}
</script>
<div class="uk-search-shadow"></div>
<div class="uk-search-wrapper">
<form class="uk-search uk-width-1-1" name = "searchForm" method = "post" action="<?php print SEFLink("index.php?option=com_jshopping&controller=search&task=result", 1);?>" onsubmit = "return isEmptyValue(jQuery('#jshop_search').val())">
<input type="hidden" name="setsearchdata" value="1">
<input type = "hidden" name = "category_id" value = "<?php print $category_id?>" />
<input type = "hidden" name = "search_type" value = "<?php print $search_type;?>" />
<input type = "text" class = "uk-width-1-1 uk-input-text uk-margin-remove" name = "search" id = "jshop_search" value = "<?php print $search?>" placeholder="<?php echo JText::_("TPL_SEARCH_PLACEHOLDER"); ?>"/>
<button class = "uk-button uk-button-small" type = "submit" value = "" ><?php echo JText::_("TPL_SEARCH"); ?></button>
<?php if ($adv_search) {?>
<a href = "<?php print $adv_search_link?>"><?php print _JSHOP_ADVANCED_SEARCH?></a>
<?php } ?>
</form>
</div>