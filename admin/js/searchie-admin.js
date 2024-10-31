(function( $ ) {
	'use strict';

	//searchie-widget-custom-button-html

	 var widget_bock_meta = function() {

		 return {
			 init : function() {
				 var _search_text = $('.searchie-widget-custom-button-html');
				 _search_text.on('focus', function(e){
					 var _this = $(this);
					 /* Select the text field */
	 			  _this.select();
					/* Copy the text inside the text field */
				  document.execCommand("copy");
				 });

			 }
		 };
	 }();

	 var search_api = function() {

		function _ajax( ajaxData, dataType = 'json' ) {
			var request = $.ajax({
				url: ajaxurl,
				method: "POST",
				data: ajaxData,
				dataType: dataType,
				cache: false
			});

			return request;
		}

		 return {
			 init : function() {
				$('.search-api').on('click', function(e){
					var _search_text = $('.searchie-search-text').find('.cf-text__input');

					var data = {
						action: 'sio_search_api',
						search: _search_text.val()
					};

					var _ajax_res = _ajax(data, 'html');

					_ajax_res.done(function(m){
						$('.searchie-search-ajax-result').find('.cf-html__content').html(m);
					});

				});

				$(document).on('click', '.searchie-choose-me', function(e){
					var _this = $(this);
					var _id = _this.data('id');
					console.log(_id);
					$("input[name='crb_phone_number']").attr('value', _id);
				});

			 }
		 };
	 }();

	 var sio_search_items = function() {

		 function _filter( _text ) {
			 	var _all_items = $('.searchie-search-items > li');
				_all_items.hide().filter(function(){
					var _item = $(this).text();
					var _search = new RegExp(_text, 'i');
					return _search.test(_item);
				}).closest('li').show();
		 }

		 return {
			 init : function() {
				 $('.searchie-input-search').on('keyup', function(e){
					 var _this = $(this);
					 var _text = _this.val();
					 console.log(_text);
					 _filter(_text);
				 });
			 }
		 };
	 }();

	 var sio_set_global_widgets = function(){

		function _ajax( ajaxData, dataType = 'json' ) {

			var request = $.ajax({
				url: ajaxurl,
				method: "POST",
				data: ajaxData,
				dataType: dataType,
				cache: false
			});

			return request;
		}

 		return {
 			init : function() {
				this.set();
 			},//init
			set: function() {
				var widgets = $('#globalWidget');
				var widgetType = $('#widgetType');
				var widgetTypeContainer = $('#widgetTypeContainer');
				var floatPosition = $('#floatPosition');
				var widgetButton = $('.sio-widget-embed-button');
				var useCustomButton = $('.useCustomButton');
				var useWidgetButton = $('.use-custom-button');
				var leftSide = $('.leftSide');
				var useLeftSide = $('.use-left-side');
				var floatPositionContainer = $('.float-position');
				var set_global_widget_btn = $('.set-global-widget-btn');

				function initWidget() {
					var _widgets = widgets;
					if ( widgets.val() == '-1' ) {
							$('.sio-input').hide();
					} else {
						$('.sio-input').show();
					}
					_widgets.on('change', function(e){
						var _this = $(this);
						if ( _this.val() == '-1' ) {
								$('.sio-input').hide();
						} else {
							$('.sio-input').show();
						}
					});
				}
				initWidget();

				function initWidgetType() {
					var _widget_type = widgetType;
					var _float_position = floatPositionContainer;

					_widget_type.on('change', function(e){
						var _this = $(this);
						if ( _this.val() == 'floating-widget' ) {
							useWidgetButton.show();
							floatPositionContainer.show();
							initCustomButton();
						} else {
							//full height
							$('#useCustomButtonYes').prop('checked',true);
							useWidgetButton.hide();
							floatPositionContainer.hide();
							initCustomButton();
							_float_position.hide();
						}
					});

					if ( _widget_type.val() == 'full-height' ) {
						useWidgetButton.hide();
						floatPositionContainer.hide();

					} else if ( _widget_type.val() == 'float' ) {
						useWidgetButton.show();
						floatPositionContainer.show();

					}

				}
				initWidgetType();

				function initCustomButton() {
					var _use_custom_button = useCustomButton;
					var _widget_embed_button = widgetButton;
					var _float_position = floatPositionContainer;

					if ( $("input[name='useCustomButton']:checked").val() == 'yes' && widgets.val() != '-1' ) {
						_widget_embed_button.show();
						_float_position.hide();
					} else if ( $("input[name='useCustomButton']:checked").val() == 'no' && widgets.val() != '-1' ) {
						_widget_embed_button.hide();
						_float_position.show();
					}

					_use_custom_button.on('change', function(e){
						var _this = $(this);
						if ( _this.val() == 'yes' ) {
							_widget_embed_button.show();
							_float_position.hide();
						} else if ( _this.val() == 'no' ) {
							_widget_embed_button.hide();
							_float_position.show();
						}
					});

				}
				initCustomButton();

				$('.set-global-widget-btn').on('click',  function(e) {
					e.preventDefault();
					var _sel_custom_button_radio = $("input[name='useCustomButton']:checked").val()
					var _sel_left_side_radio = $("input[name='leftSide']:checked").val()

					var _left_side = _sel_left_side_radio;
					if ( typeof _left_side === 'undefined' ) {
						_left_side = 0;
					}

					var data = {
						action: 'sio_set_global_widget',
						widget: widgets.val(),
						widget_type: widgetType.val(),
						float_position: floatPosition.val(),
						custom_button: _sel_custom_button_radio,
						left_side: _left_side
					};
					$('.ajax-msg-set-global-widget').html('Updating global widget setting..');

					var ret = _ajax(data);
					ret.done(function(ajaxData){
							$('.ajax-msg-set-global-widget').html('');
					});
				});
			}
		};

 	}();

	$( window ).load(function() {
		sio_set_global_widgets.init();
		sio_search_items.init();
		search_api.init();
		widget_bock_meta.init();

		$('body').on('click', '.copy-to-clipboard', function(e){
			$(this).parents('.media-item').find('.copy-clipboard').select();
	  	document.execCommand("copy");
		});
		$('body').on('click', '.copy-to-clipboard-settings', function(e){
			$(this).parents('.input-group').find('.copy-clipboard').select();
	  	document.execCommand("copy");
		});
	});

})( jQuery );
