/**
* Module mod_sj_html5_audiofly For Joomla 3.x
* Created by	: SuperJoom
* Email			: info@superjoom.com
* Created on	: 05 Feb 2013
* Last Modified : 06 August 2013
* URL			: www.superjoom.com
* Copyright (C) 2011-2013  Super Joom
* License GPLv2.0 - http://www.gnu.org/licenses/gpl-2.0.html
*/
var modal = (function(){
				var 
				method = {},
				$overlay,
				$modal,
				$content_modal,
				$close;
				method.center = function () {
				var top, left;
					left = Math.max($(window).width() - $modal.outerWidth(), 0) / 2;
					$modal.css({
						left:left + $(window).scrollLeft()
					});
				};
				method.open = function (settings) {
					$content_modal.empty().append(settings.content_modal);
					$modal.css({
						width: settings.width || 'auto', 
						height: settings.height || 'auto'
					});
					method.center();
					$(window).bind('resize.modal', method.center);
					$modal.show();
					$overlay.show();
				};
				method.close = function () {
					$modal.hide();
					$overlay.hide();
					$content_modal.empty();
					$(window).unbind('resize.modal');
				};
				$overlay = $('<div id="overlay"></div>');
				$modal = $('<div id="modal"></div>');
				$content_modal = $('<div id="content_modal"></div>');
				$close = $('<a id="close" href="#">close</a>');
				$modal.hide();
				$overlay.hide();
				$modal.append($content_modal, $close);
				$(document).ready(function(){
					$('body').append($overlay, $modal);						
				});
				$close.click(function(e){
					e.preventDefault();
					method.close();
				});
				return method;
			}());