'use strict';

var $ =  jQuery.noConflict(); //Wordpress by default uses jQuery instead of $

jQuery(document).ready(function(){
	var $ =  jQuery.noConflict(); 
	
	var frameUpload; // WP Media holder;
	/**
	 * Init Portfolio Items Title, Description, Media, Meta, Continue Reading 
	 * Init Meta Items Author, Date, Category, Tags, Comments 
	 */
	setupPortfolioElements();

	// Translation enabled messages
	var $messages = JSON.parse( messages );

	// Disable caching of AJAX responses - DEVELOPMENT ONLY
	jQuery.ajaxSetup ({
	    cache: false
	});

	/**
	 * Enable jQuery UI Accordion for Add List Page
	 */
	jQuery( '.accordion-container' ).accordion({
		header: "> ul > li > h3",
		collapsible: true,
		heightStyle: 'content',
		speed: 'fast'
	});

	/**
	 * Enable Color Picker
	 */
	var $element = new Array();
	jQuery('.js-color-picker').each( function(index, element) {
		$element[index] = element;

		jQuery($element[index]).ColorPicker({
			color: '#000000',
				onShow: function (colpkr) {
					jQuery(colpkr).fadeIn(500);
					return false;
				},
				onHide: function (colpkr) {
					jQuery(colpkr).fadeOut(500);
					return false;
				},
				onChange: function (hsb, hex, rgb) {
					
					jQuery( $element[index] ).parent().children('.js-color-picker-value').val( '#'+hex );
					jQuery( $element[index] ).children('.js-color-container').css( 'backgroundColor', '#'+hex );
					
				}
			});	
		
	});

	/**
	 * Autocomplete Functionality for: Categories, Tags and Users Authors
	 */
	var req_url = ajaxurl;
	
	otw_select2( '.js-categories', { url: req_url, action: 'otw_pml_select2_options', otw_option_type: 'otw_pm_category' } );
	otw_select2( '.js-tags', { url: req_url, action: 'otw_pml_select2_options', otw_option_type: 'otw_pm_tag' } );
	otw_select2( '.js-users', { url: req_url, action: 'otw_pml_select2_options', otw_option_type: 'user' } );
	 
	jQuery( '#show-social-icons' ).on( 'change',  function(){
		otw_pm_set_social_related_controlers();
	});
	
	otw_pm_set_social_related_controlers();
	/**
	 * Select All Funcitonality
	 */

	jQuery('.js-select-categories, .js-select-tags, .js-select-users').on('change', function(e) {
		var sectionName = jQuery(this).data('section');

		if( jQuery(this).is(':checked') ) {
			jQuery('.js-'+sectionName+'-select').val( -1 );
			jQuery('.js-'+sectionName+'-counter').html( Number( jQuery( this ).attr( 'data-size' ) ) );
			jQuery('.js-'+sectionName+'-count').show();
			jQuery('.js-'+sectionName+'').prop("disabled", true);

		} else {
			jQuery('.js-'+sectionName+'-select').val( '' );
			jQuery('.js-'+sectionName+'-counter').html( '' );
			jQuery('.js-'+sectionName+'-count').hide();
			jQuery('.js-'+sectionName+'').prop("disabled", false);
		}

	});

	
	
	if( jQuery('.js-template-style').size() && jQuery('.js-template-style').val() ){
	
		var js_templ_val = jQuery('.js-template-style').val();
		if( typeof( js_template_options[ js_templ_val ] ) == 'object' ){
			jQuery( '.default_thumb_width' ).html( js_template_options[ js_templ_val ].width );
			jQuery( '.default_thumb_height' ).html( js_template_options[ js_templ_val ].height );
		}else{
			jQuery( '.default_thumb_width' ).html( '' );
			jQuery( '.default_thumb_height' ).html( '' );
		}
	}
	/**
	 * Load Front End preview based on selection
	 */
	 
	jQuery('.js-template-style').on('change', function(e){
		
		// Get Current Page Selection
		var pageName = jQuery(this).val();

		// Evaluate page selection and load preview
		// Variable templates can be found in otw-admin-pm-variables.js
		jQuery.each( templates, function( index, obj) {
			
			if ( obj.name == pageName ) {
				// Preview is disabled.
				
			}
			
		});
		
		if( typeof( js_template_options[ this.value ] ) == 'object' ){
		
			jQuery( '.default_thumb_width' ).html( js_template_options[ this.value ].width );
			jQuery( '.default_thumb_height' ).html( js_template_options[ this.value ].height );
		}else{
			jQuery( '.default_thumb_width' ).html( '' );
			jQuery( '.default_thumb_height' ).html( '' );
		}
		
		jQuery('.js-mosaic-settings').hide();
		jQuery('.js-slider-settings').hide();
		jQuery('.js-news-settings').hide();
		jQuery('.js-horizontal-settings').hide();
		jQuery('.js-grid-settings').hide();

		// Add Mosaic Specific Settings to the page
		if( pageName == '1-3-mosaic' || pageName == '1-4-mosaic' ) {
			// Show Mosaic Specific Settings
			jQuery('.js-mosaic-settings').show();

		} else if ( pageName == '2-column-news' || pageName == '3-column-news' || pageName == '4-column-news' ) {
			// Show News Specific Settings
			jQuery('.js-news-settings').show();

		} else if (
				pageName == 'slider' ||
				pageName == '3-column-carousel' || 
				pageName == '4-column-carousel' || 
				pageName == '5-column-carousel' ||
				pageName == '2-column-carousel-wid' ||
				pageName == '3-column-carousel-wid' ||
				pageName == '4-column-carousel-wid'
			) {
			// Show Slider / Carousel Specific Settings
			jQuery('.js-slider-settings').show();

		} else if ( pageName == 'horizontal-layout' ) {
			jQuery('.js-horizontal-settings').show();
		} else if ( pageName == '2-column' || pageName == '3-column' || pageName == '4-column' ) {
			jQuery('.js-grid-settings').show();
		}

	});

	
	/**
	 * POST and PAGES custom Meta BOX media selection
	 */

	jQuery('.js-otw-media-type').on('change', function(e) {
		
		var mediaType = jQuery(this).val();

		jQuery('.js-meta-youtube').hide();
		jQuery('.js-meta-vimeo').hide();
		jQuery('.js-meta-soundcloud').hide();
		jQuery('.js-meta-image').hide();
		jQuery('.js-meta-slider').hide();

		switch ( mediaType ) {
			case 'youtube':
				jQuery('.js-meta-youtube').show();
			break;
			case 'vimeo':
				jQuery('.js-meta-vimeo').show();
			break;
			case 'soundcloud':
				jQuery('.js-meta-soundcloud').show();
			break;
			case 'img':
				jQuery('.js-meta-image').show();
			break;
			case 'slider':
				jQuery('.js-meta-slider').show();
			break;
		}

	});

	/**
	 * Make Slider Elements Sortable
	 */
	jQuery('.js-meta-slider-preview').sortable({
		update: function( event, ui ) {
			updateSliderAssets();
		}
	});

	/**
	 * Add functionality to delete images from slider
	 */

	jQuery(document).on('click', '.b-delete_btn', function(e) {
		e.preventDefault();
		
		// Get current selected item
		var item = jQuery(this).parent();

		//Remove item from the list
		jQuery(item).remove();

		// Update assets list
		updateSliderAssets ();
	});

	/**
	 * Add Functionality for WordPress Media Upload
	 */
	jQuery(document).on('click', '.js-add-image', function(e) {
		e.preventDefault();
		/**
		 * WordPress Based Media Selection and Upload Images
		 * Used for Post Meta information: Images and Slider Images
		 */

		if( frameUpload ) {
			frameUpload.open();
			return;
		}

		frameUpload = wp.media({
			id: 'otw-pm-media-upload',
			// Set the title of the modal.
			title: $messages['modal_title'],
			multiple: false,
			// Tell the modal to show only images.
			library: {
				type: 'image'
			},
			// Customize the submit button.
			button: {
				// Set the text of the button.
				text: $messages['modal_btn'],
				// Change close: false, in order to prevent window to close on selection
				close: true
			}
		});

		frameUpload.on( 'select', function() {
			var attachements = frameUpload.state().get('selection').first().id;
			var attachementURL = wp.media.attachment( attachements ).attributes.url;

			if( jQuery('.js-otw-media-type').val() === 'slider' ) {

				imgTAG = '<li class="b-slider__item" data-src="'+attachementURL+'">';
				imgTAG += '<a href="#" class="b-delete_btn"></a>';
				imgTAG += '<img src="'+attachementURL+'" width="100" />';
				imgTAG += '</li>';
				
				jQuery('.js-meta-slider-preview').append( imgTAG ); //Display IMG
				updateSliderAssets();

			} else {
				// Create HTML for visual effect
				var imgTAG = '<img src="'+attachementURL+'" width="150" />';
				// Append HTML for visual preview
				jQuery('.js-img-preview').html( imgTAG ); //Display IMG

				// Add Image to Hidden input - save to DB
				jQuery('.js-img-url').val( attachementURL );
			}

		})

		frameUpload.open();
	});


	/**
	 * Capture All Links from Preview and Prevent Default
	 * Prevent Browser to follow # link
	 */
	jQuery('.js-preview').on('click', 'a', function(e) {
		e.preventDefault();
	});
	
	/**
	 * Interface for Portfolio List Elements
	 * Drag & Drop support + Sortable Support
	 */
	jQuery('.js-pl-active, .js-pl-inactive').sortable({
		connectWith: ".b-pl-box",
		update: function( event, ui ) {
			updatePortfolioListElements();
		},
		stop: function( event, ui ) {
			jQuery.event.trigger({
				type: "listEvent"
			});
		}
	});

	/**
	 * Detect Delete action and prompt message
	 */
	 jQuery('.js-delete-item').on('click', function(e) {
	 	e.preventDefault();

	 	var confirmation =  window.confirm( $messages.delete_confirm + ' ' + jQuery(this).data('name') + '?' );

	 	if( confirmation ) {
	 		window.location = jQuery(this).attr('href');
	 	}

	 });
	 
	jQuery('#white_spaces').on( 'change',  function(){
		
		if( this.value == 'no' ){
			jQuery( '#white_spaces_color_container' ).hide();
		}else{
			jQuery( '#white_spaces_color_container' ).show();
		}
	 } );
	 
	if( jQuery('#white_spaces').val() == 'no' ){
		jQuery( '#white_spaces_color_container' ).hide();
	}else{
		jQuery( '#white_spaces_color_container' ).show();
	}
	
	otw_pm_init_tabs_metabox();
	
	otw_pm_init_options_metabox();

});

/**
 * Iterate Assets from media slider and put them into a hidden field
 * Used to save possition + image path in DB
 */
function updateSliderAssets () {
	var imagesArray = new Array();
	jQuery('.b-slider-preview > .b-slider__item').each(function( item, value) {
		imagesArray.push( jQuery(value).data('src') );
	});

	// Add Array to hidden input
	jQuery('.js-img-slider-url').val( imagesArray );
}
/** 
 * Show soccial related contollers based in the selected value
 */
function otw_pm_set_social_related_controlers(){
	var social_value = jQuery( '#show-social-icons' ).val();
	
	switch( social_value ){
		
		case '0':
				jQuery( '#otw-show-social-icons-type' ).hide();
				jQuery( '#otw-show-social-icons-custom' ).hide();
			break;
		case 'custom_icons':
				jQuery( '#otw-show-social-icons-type' ).hide();
				jQuery( '#otw-show-social-icons-custom' ).show();
			break;
		case 'like_buttons':
				var labels = jQuery( '#otw-show-social-icons-type label' );
				var inputs = jQuery( '#otw-show-social-icons-type input' );
				
				jQuery( labels[4] ).hide();
				jQuery( labels[5] ).hide();
				
				jQuery( inputs[3] ).hide();
				jQuery( inputs[4] ).hide();
				
				jQuery( '#otw-show-social-icons-type' ).show();
				jQuery( '#otw-show-social-icons-custom' ).hide();
			break;
		default:
				jQuery( '#otw-show-social-icons-type' ).show();
				jQuery( '#otw-show-social-icons-custom' ).hide();
				jQuery( '#otw-show-social-icons-type label' ).show();
				jQuery( '#otw-show-social-icons-type input' ).show();
			break;
	}
}
/**
 * Iterate On Portfolio List Items
 * Detect Items that will be used in the list
 * Drag & Drop List Functionality
 */
function updatePortfolioListElements () {
	var elementsArray = new Array();

	jQuery('.js-pl-active > .js-pl--item').each( function( item, value )  {
		elementsArray.push( jQuery(value).data('value') );
	});

	jQuery('.js-portfolio-items').val( elementsArray );
}

/**
 * Iterate On Portfolio Meta Items
 * Detect Items that will be used in the meta
 * Drag & Drop List Functionality
 */
function updatePortfolioMetaElements () {
	var elementsArray = new Array();

	jQuery('.js-meta-active > .js-meta--item').each( function( item, value )  {
		elementsArray.push( jQuery(value).data('value') );
	});

	jQuery('.js-meta-items').val( elementsArray );
}


/**
 * Get state of Portfolio List Elements and Portfolio Meta Elements
 * Modify interface based on current input Edit / Add Error
 */
function setupPortfolioElements () {
	
	var $ =  jQuery.noConflict();
	
	var portfolioElements = jQuery('.js-portfolio-items').val();
	var metaElements = jQuery('.js-meta-items').val();
	
	if( typeof portfolioElements !== 'undefined' ) {
		var portfolioItems = portfolioElements.split(',');

		jQuery(portfolioItems).each( function( item, value ) {

			jQuery('.js-pl-inactive > .js-pl--item').each( function( blItem, blValue )  {
				if( jQuery(blValue).data('value') == value ) {

					jQuery('.js-pl-active').append( jQuery(blValue) );
				} 
			});

		});

	}
	
	if( typeof metaElements !== 'undefined' ) {
		metaItems = metaElements.split(',');

		jQuery(metaItems).each( function( item, value ) {

			jQuery('.js-meta-inactive > .js-meta--item').each( function( miItem, miValue )  {

				if( jQuery(miValue).data('value') === value ) {
					jQuery('.js-meta-active').append( miValue );
				}
			});

		});

	}
}

function otw_pm_init_tabs_metabox(){
	
	if( jQuery( '#otw_pm_add_tab' ).size() ){
		
		jQuery( '#otw_pm_add_tab' ).on( 'click',  function(){
			
			
			var table = jQuery( '#otw_pm_tabs_table' );
			
			var new_table = jQuery( '#otw_pm_tabs_add_table' );
			var new_table_rows = new_table.find( 'tr' );
			
			/*find the number of the last row*/
			var last_area = table.find( 'tr:last' ).find( 'textarea' );
			
			if( last_area.size() ){
				var matches = false;
				if( matches = last_area.attr( 'id' ).match( /^otw_pm_tab_content_(\d+)$/ ) ){
					var new_row_id = Number( matches[1] ) + 1;
				}
			}else{
				
				var new_row_id = 0;
			}
			for( var cR = 0; cR < new_table_rows.length; cR++ ){
				
				var new_row = jQuery( new_table_rows[ cR ] ).clone();
				new_row.hide();
				
				var labels = new_row.find( 'label' );
				
				for( var cL = 0; cL < labels.length; cL++ ){
					jQuery( labels[cL] ).attr( 'for',  jQuery( labels[cL] ).attr( 'for' ).replace( /next_row_id/, new_row_id ) );
				}
				
				var controls = new_row.find( 'textarea,input' );
				
				for( var cL = 0; cL < controls.length; cL++ ){
					
					var control = jQuery( controls[cL] );
					
					control.attr( 'id', control.attr( 'id' ).replace( /next_row_id/, new_row_id ) );
					control.attr( 'name', control.attr( 'name' ).replace( /next_row_id/, new_row_id ) );
					control.val( '' );
				}
				
				table.find( 'tbody' ).append( new_row );
				new_row.fadeIn();
			};
		});
	};
};

function otw_pm_init_options_metabox(){

	if( jQuery( '#otw_pm_options_type' ).size() ){
		
		otw_pm_set_options_metabox();
		
		jQuery( '#otw_pm_options_type' ).on( 'change',  function(){ otw_pm_set_options_metabox() } )
	}
};

function otw_pm_set_options_metabox(){
	
	if( jQuery( '#otw_pm_options_type' ).val() == 'custom' ){
		
		jQuery( '#otw_pm_custom_options_table' ).show();
	}else{
	
		jQuery( '#otw_pm_custom_options_table' ).hide();
	}
};

function otw_select2( otw_selector, otw_params ){
		
	var otw_select2_params = {};
	otw_select2_params.placeholder = "";
	
	if( typeof( otw_params.url ) == 'string' ){
		otw_select2_params.ajax = {
			url: otw_params.url,
			dataType: 'json',
			data: function ( params ) {
				return {
					action: otw_params.action,
					otw_options_type: otw_params.otw_option_type, //search term
					otw_options_search: params.term,
					otw_options_limit: 10 // page size
				};
			},
			type: 'post',
			processResults: function (data, params) {
				return {
					results: data.results
				}
			}
		};
	}else{
		otw_select2_params.data = otw_params.data;
	}
	otw_select2_params.templateSelection = function( item ){
		return item.text;
	};
	otw_select2_params.templateResult = function( item ){ 
		return item.text;
	};
	
	var otw_select_2_object = jQuery( otw_selector ).select2( otw_select2_params );
	
	otw_select_2_object.on("select2:unselecting", function(e) {
		jQuery(this).data('state', 'unselected');
	} );
	
	otw_select_2_object.on("select2:open", function(e) {
		
		if( jQuery(this).data('state') === 'unselected') {
			jQuery(this).removeData('state');
			var self = jQuery(this);
			setTimeout(function() {
				self.select2('close');
			}, 1);
		};
	});
	
	var initial_value = otw_select_2_object.attr( 'data-value' );
	
	if( typeof( otw_params.url ) == 'string' ){
		
		if( ( typeof( initial_value ) == 'string' ) && ( initial_value.length ) ){
			
			jQuery.ajax( otw_params.url , {
				data: {
					otw_options_ids: initial_value,
					action: otw_params.action,
					otw_options_type: otw_params.otw_option_type
				},
				method: 'post',
				dataType: "json"
			}).done(function(data) {
			
				if( typeof( data.results ) == 'object' ){
					
					for( var cD = 0; cD < data.results.length; cD++ ){
						
						otw_select_2_object.append( '<option value="' + data.results[ cD ].id + '" selected="selected">' + data.results[ cD ].text + '</option>');
					};
				};
			});
		};
	};
};