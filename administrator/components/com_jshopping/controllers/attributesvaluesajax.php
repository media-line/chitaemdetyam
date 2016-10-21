<?php
    /**
    * @version      1.1.0 25.03.2016
    * @author       MAXXmarketing GmbH
    * @package      AddonAttributeIndependentAdminType
    * @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
    * @license      GNU/GPL
    */

    defined('_JEXEC') or die;

    class JshoppingControllerAttributesValuesAjax extends JControllerLegacy {

        public function ajax_save_attribut_value() {
            JPluginHelper::importPlugin('jshoppingadmin');

            $db               = JFactory::getDbo();
            $jshopConfig      = JSFactory::getConfig();
            $dispatcher       = JDispatcher::getInstance();
            $return           = 0;

            $attrval          = new stdClass;
            $attrval->option  = 'com_jshopping';
            $attrval->attr_id = intval($_POST['attr_id']);
            $attrval->{'name_' . $jshopConfig->frontend_lang} = $_POST['attr_value_text'];

            $query = $db->getQuery(true)
                    ->select('value_id')
                    ->from('#__jshopping_attr_values')
                    ->where('attr_id = ' . $attrval->attr_id)
                    ->where( $db->qn('name_' . $jshopConfig->frontend_lang) . ' LIKE ' . $db->q($_POST['attr_value_text']));
            $db->setQuery($query);

            if( !$id = $db->loadResult() ) {
                $query = $db->getQuery(true)
                        ->select('MAX(value_ordering)')
                        ->from('#__jshopping_attr_values')
                        ->where('attr_id = ' . $attrval->attr_id);
                $db->setQuery($query);
                $ordering = $db->loadResult();
                $attrval->value_ordering = $ordering + 1;
                $attributValue = JTable::getInstance('attributValue', 'jshop');
                if( $attributValue->bind($attrval) && $attributValue->store() ) {
                    $return = $attributValue->value_id;
                }
            }
            else $return = $id;

            exit( (string) $return );
        }
    }