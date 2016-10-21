<?php
    /**
    * @version      1.1.0 25.03.2016
    * @author       MAXXmarketing GmbH
    * @package      AddonAttributeIndependentAdminType
    * @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
    * @license      GNU/GPL
    */

    defined('_JEXEC') or die;

    class plgJshoppingAdminAttr_admin_type extends JPlugin {
        
        function __construct(& $subject, $config){
            parent::__construct($subject, $config);
            JSFactory::loadExtLanguageFile('addon_attr_admin_type');
        }

        function onBeforeEditAtribut(&$view,&$attribut){

                $arr_type = array();        
                $arr_type[] = JHTML::_('select.option',  '0', _JSHOP_TYPE_SELECT, 'type_id', 'type_value' );
                $arr_type[] = JHTML::_('select.option',  '1', _JSHOP_TYPE_AS_DATE, 'type_id', 'type_value' );  
                $arr_type[] = JHTML::_('select.option',  '2', _JSHOP_TYPE_AS_TEXT, 'type_id', 'type_value' );   

                $select_type = JHTML::_('select.genericlist', $arr_type , 'attr_admin_type', 'class="inputbox" size="1"','type_id', 'type_value' , $attribut->attr_admin_type );

            $ret = '<tr>   <td class="key">'._JSHOP_TYPE_ADMIN_ATRIBUT.'</td>';
            $ret .= '<td> '.$select_type.'</td></tr> '; 

            $view->assign('etemplatevar', $ret);
        }

        function onBeforeDisplayEditProduct(&$product, &$related_products, &$lists, &$listfreeattributes, &$tax_value){

            $document = JFactory::getDocument();
            $document->addCustomTag('<script type = "text/javascript" src = "'.JURI::root().'plugins/jshoppingadmin/attr_admin_type/ajax.js"></script>');        
            $db = JFactory::getDBO();

            foreach($lists['all_independent_attributes'] as $k=>$v){
                $query = "SELECT attr_admin_type FROM `#__jshopping_attr` WHERE attr_id='".$v->attr_id."'";
                $db->setQuery($query);
                $lists['all_independent_attributes'][$k]->attr_admin_type = $db->loadResult();

                if ($lists['all_independent_attributes'][$k]->attr_admin_type=='1'){
                   $lists['all_independent_attributes'][$k]->values_select= JHTML::_('calendar', '',   'attr_ind_id_tmp_'.$v->attr_id,   'attr_ind_id_tmp_'.$v->attr_id,   '%d.%m.%Y %H:%M', array('class'=>'inputbox', 'size'=>'25', 'maxlength'=>'19'));
                   $lists['all_independent_attributes'][$k]->submit_button = '<input type = "button" class="btn" onclick = "addAttributValue2Ajax('.$v->attr_id.');" value = "'._JSHOP_ADD_ATTRIBUT_VALUE.'" />';     
                }
                if ($lists['all_independent_attributes'][$k]->attr_admin_type=='2'){
                   $lists['all_independent_attributes'][$k]->values_select= '<input type = "text" name="attr_ind_id_tmp_'.$v->attr_id.'" id="attr_ind_id_tmp_'.$v->attr_id.'"  class="inputbox" value="" size="25" /> ';
                   $lists['all_independent_attributes'][$k]->submit_button = '<input type = "button" class="btn" onclick = "addAttributValue2Ajax('.$v->attr_id.');" value = "'._JSHOP_ADD_ATTRIBUT_VALUE.'" />';
                }                 
            }
        }
    }