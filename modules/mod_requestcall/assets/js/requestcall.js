	function requestcall(empty_phone, incorrect_phone, error_sending, successful_sending, disable_btn, module_id) {
		event.preventDefault();
		var form = jQuery(this); 
		var error = false; 		var product_url = window.location.href;				jQuery("#product_url-"+module_id).val(product_url);				var phone = jQuery("#phone-"+module_id).val();
		var email = jQuery("#email-"+module_id).val();
		var errortext = '';
		var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);		
		/*if ( /[a-zа-яё]+/i.test(phone) ) {			
			//jQuery('form')[0].reset();
			jQuery("#messages-"+module_id).text('');						error = true; 
			jQuery("#messages-"+module_id).append('<div class="uk-alert uk-alert-danger" data-uk-alert><p>'+incorrect_phone+'</p></div>');						jQuery("#phone-"+module_id).addClass('uk-error');
		}
		if (phone == '') { 			jQuery("#messages-"+module_id).text('');						error = true; 
			jQuery("#messages-"+module_id).append('<div class="uk-alert uk-alert-danger" data-uk-alert><p>'+empty_phone+'</p></div>');						jQuery("#phone-"+module_id).addClass('uk-error');
		}*/				if ( !pattern.test(email) ) {			//jQuery('form')[0].reset();			jQuery("#messages-"+module_id).text('');						error = true; 			jQuery("#messages-"+module_id).append('<div class="uk-alert uk-alert-danger" data-uk-alert><p>Неверный формат email</p></div>');						jQuery("#email-"+module_id).addClass('uk-error');		}				if (email == '') { 			jQuery("#messages-"+module_id).text('');						error = true; 			jQuery("#messages-"+module_id).append('<div class="uk-alert uk-alert-danger" data-uk-alert><p>Введите Ваш email</p></div>');						jQuery("#email-"+module_id).addClass('uk-error');		}
		if (!error) { 			jQuery("#phone-"+module_id).removeClass('uk-error');			jQuery("#email-"+module_id).removeClass('uk-error');			
			var data = jQuery("#requestform-"+module_id).serialize();
			jQuery.ajax({ 
				type: 'POST', 
			    url: '/modules/mod_requestcall/send.php', 
			    data: data, 
		        beforeSend: function() { 
		            jQuery('#sendform-'+module_id).attr('disabled', 'disabled'); 
		        },
				success: function(data){ 
		       		if (data != 'success') { 
						if (data == 'error_captcha') { 
							jQuery("#messages-"+module_id).text('');
							jQuery("#messages-"+module_id).append('<div class="uk-alert uk-alert-danger" data-uk-alert><p>Введите капчу</p></div>');
						} else {							//alert(data);
							jQuery('form')[0].reset();
							jQuery("#messages-"+module_id).text('');
							jQuery("#messages-"+module_id).append('<div class="uk-alert uk-alert-danger" data-uk-alert><p>'+error_sending+'</p></div>');
						}
		       		} else { 
						jQuery('form')[0].reset();
						jQuery("#messages-"+module_id).text('');						jQuery("#messages-"+module_id).append('<div class="uk-alert uk-alert-success" data-uk-alert><p>Сообщение отправлено</p></div>');
		       		}
		        },
		        error:function(){
					jQuery('form')[0].reset(); 
					jQuery("#messages-"+module_id).text('');
					jQuery("#messages-"+module_id).append('<div class="uk-alert uk-alert-danger" data-uk-alert><p>'+error_sending+'</p></div>');
				},
				complete:function(){
					jQuery('#sendform-'+module_id).prop('disabled', false); 
				}
				
			});
		}
		return false; 
	};	
