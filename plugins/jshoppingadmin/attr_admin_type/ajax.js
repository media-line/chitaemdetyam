function addAttributValue2Ajax(id) {

    var attr_value_text = jQuery('#attr_ind_id_tmp_' + id).val();
    
    jQuery.ajax({
        type    : 'POST',
        url     : 'index.php?option=com_jshopping&controller=attributesvaluesajax&task=ajax_save_attribut_value&ajax=1',
        data    : {
            attr_id: id,
            attr_value_text: attr_value_text
        }
    }).always(function(reply, textStatus) {
        var value_id = ( typeof reply === 'string' ) ? +reply : 0;
        if( textStatus !== 'success' || !value_id ) {
            alert('An error has occurred while saving the attribute value');
            return false;
        }
        
        var mod_price  = jQuery('#attr_price_mod_tmp_' + id).val();
        var price      = jQuery('#attr_ind_price_tmp_' + id).val();    
        var existcheck = jQuery('#attr_ind_' + id + '_' + value_id).val();    
        if( existcheck ) {
            alert(lang_attribute_exist);
            return false;
        }    
        if( value_id == '0' ) {
            alert(lang_error_attribute);
            return false;
        }
        var html       = "<tr id='attr_ind_row_" + id + "_" + value_id + "'>"; 
        var hidden     = "<input type='hidden' id='attr_ind_" + id + "_" + value_id + "' name='attrib_ind_id[]' value='" + id + "'>";
        var hidden2    = "<input type='hidden' name='attrib_ind_value_id[]' value='" + value_id + "'>";
        var tmpimg     = "";
        if( value_id != 0 && typeof attrib_images[value_id] !== 'undefined' ) {
            tmpimg ='<img src="' + folder_image_attrib + '/' + attrib_images[value_id] + '" style="margin-right:5px;" width="16" height="16" class="img_attrib">';
        }
        html += "<td>"  +  hidden  +  hidden2  +  tmpimg  +  attr_value_text  +  "</td>";
        html += "<td><input type='text' name='attrib_ind_price_mod[]' value='" + mod_price + "'></td>";
        html += "<td><input type='text' name='attrib_ind_price[]' value='" + price + "'></td>";
        html += "<td><a href='#' onclick=\"jQuery('#attr_ind_row_" + id + "_" + value_id + "').remove();return false;\"><img src='components/com_jshopping/images/publish_r.png' border='0'></a></td>";
        html += "</tr>";    
        jQuery("#list_attr_value_ind_" + id).append(html);
    });
}