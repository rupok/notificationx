(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	/**
	 * TODO: NEW STYLE OF CODE
	 */

	$.notificationx = $.notificationx || {};

	$(document).ready(function(){
		$.notificationx.init();
		$('body').on('click', '.nx-metatab-menu li, .nx-builder-tab-menu li, .nx-meta-next, .nx-quick-builder-btn', 
		function(e){
			e.preventDefault();
			$.notificationx.tabChanger( this );
		});
	});

	$( window ).load(function(){
		$('body').on('change', '#nx_meta_display_type', function(){
			var type = $(this).val();
			// NotificationX_Admin.shownPreview( type );
			if( type == 'conversions' ) {
				$('#nx_meta_conversion_from').trigger('change');
			}
		});

		$('body').on('change', '#nx_meta_display_type.nx-select', function( e ){
			var type = $(this).val(),
				title = e.currentTarget.selectedOptions[0].innerText,
				options = { year: 'numeric', month: 'short', day: 'numeric' },
				date = ( new Date() ).toLocaleDateString('en-US', options);
			if( type === 'conversions' ) {
				$('body').on('change', '#nx_meta_conversion_from.nx-select', function( e ){
					var type = $(this).val(),
						title = e.currentTarget.selectedOptions[0].innerText;
					$('.finalize_notificationx_name').text("NotificationX - " + title + ' - ' + date);
				});
				$('#nx_meta_conversion_from.nx-select').trigger('change');
			} else {
				$('.finalize_notificationx_name').text("NotificationX - " + title + ' - ' + date);
			}
		});

		$('#nx_meta_display_type').trigger('change');
	});

	$.notificationx.init = function(){
		$.notificationx.enabledDisabled();
		$.notificationx.toggleFields();
		$.notificationx.bindEvents();
		$.notificationx.initializeFields();
	};

	$.notificationx.bindEvents = function(){
		$('body').on('click', '.nx-single-theme-wrapper', function(){
			$.notificationx.selectTheme( this )
		});

		/**
		 * Group Field Events
		 */
		$('body').delegate( '.nx-group-field .nx-group-field-title', 'click', function(e) {
			e.preventDefault();
			if( $( e.srcElement ).hasClass( 'nx-group-field-title' ) ) {
				$.notificationx.groupToggle( this );
			}
		});
		$('body').delegate( '.nx-group-field .nx-group-remove', 'click', function() {
			$.notificationx.removeGroup(this);
		});

		/**
		 * Media Field
		 */
		$('body').delegate( '.nx-media-field-wrapper .nx-media-upload-button', 'click', function(e) {
			e.preventDefault();
			$.notificationx.initMediaField( this );
		});
		$('body').delegate( '.nx-media-field-wrapper .nx-media-remove-button', 'click', function(e) {
			e.preventDefault();
			$.notificationx.removeMedia(this);
		});
	};
	/**
	 * This function is responsible for 
	 * enabling and disabling the notificationXs
	 */
	$.notificationx.enabledDisabled = function(){
		$('.wp-list-table .column-notification_status img').off('click').on('click', function(e) {
            e.stopPropagation();
            var $this       = $(this),
                isActive    = $this.attr('src').indexOf('active1.png') >= 0,
                postID      = $this.data('post'),
                nonce       = $this.data('nonce');

            if ( isActive ) {
                $this.attr('src', $this.attr('src').replace('active1.png', 'active0.png'));
                $this.attr('title', 'Inactive').attr('alt', 'Inactive');
            } else {
                $this.attr('src', $this.attr('src').replace('active0.png', 'active1.png'));
                $this.attr('title', 'Active').attr('alt', 'Active');
            }

            $.ajax({
                type: 'post',
                url: window.ajaxurl,
                data: {
                    action: 'notifications_toggle_status',
                    post_id: postID,
                    nonce: nonce,
                    status: isActive ? 'inactive' : 'active'
                },
                success: function(res) {
                    if ( res !== 'success' ) {
                        alert( res );
                        isActive = $this.attr('src').indexOf('active1.png') >= 0;
                        if ( isActive ) {
                            $this.attr('src', $this.attr('src').replace('active1.png', 'active0.png'));
                            $this.attr('title', 'Inactive').attr('alt', 'Inactive');
                        } else {
                            $this.attr('src', $this.attr('src').replace('active0.png', 'active1.png'));
                            $this.attr('title', 'Active').attr('alt', 'Active');
                        }
                    }
                }
            });
        });
	};

	$.notificationx.initializeFields = function(){
		// NotificationX_Admin.initSelect2();
		if( $('.nx-meta-field').length > 0 ) {
			$('.nx-meta-field').map(function( iterator, item ){
				var node = item.nodeName;
				if( node === 'SELECT' ) {
					$(item).select2();
				}
			});
		}
		// NotificationX_Admin.initDatepicker();
		if( $('.nx-countdown-datepicker').length > 0 ) {
			$('.nx-countdown-datepicker').each(function(){
				$(this).find('input').datepicker({
					changeMonth: true,
					changeYear: true,
					dateFormat : 'DD, d MM, yy'
				});
			});
		}
        
		$('.notificationx-metabox-wrapper .nx-meta-field:not(#nx_meta_conversion_from)').trigger('change');
		
		// NotificationX_Admin.initColorField();
		if( $( '.nx-colorpicker-field' ).length > 0 ){
			if ( 'undefined' !== typeof $.fn.wpColorPicker ) {
				$( '.nx-colorpicker-field' ).each(function() {
					var color = $(this).val();
					$(this).wpColorPicker({
						change: function(event, ui) {
							var element = event.target;
							var color = ui.color.toString();
							$(element).parents('.wp-picker-container').find('input.nx-colorpicker-field').val(color).trigger('change');
						}
					}).parents('.wp-picker-container').find('.wp-color-result').css('background-color', '#' + color);
				});
			}
		}
        $.notificationx.groupField();
	};

	$.notificationx.groupField = function(){

        if( $('.nx-group-field-wrapper').length < 0 ) {
            return;
        }

        var fields = $('.nx-group-field-wrapper');

        fields.each(function(){

            var $this  = $( this ),
                groups = $this.find('.nx-group-field'),
                firstGroup   = $this.find('.nx-group-field:first'),
                lastGroup   = $this.find('.nx-group-field:last');

            groups.each(function() {
                var groupContent = $(this).find('.nx-group-field-title:not(.open)').next();
                if ( groupContent.is(':visible') ) {
                    groupContent.addClass('open');
                }
            });

            $this.find('.nx-group-field-add').on('click', function( e ){
                e.preventDefault();

                var fieldId     = $this.attr('id'),
                    dataId      = $this.data( 'name' ),
                    wrapper     = $this.find( '.nx-group-fields-wrapper' ),
                    groups      = $this.find('.nx-group-field'),
                    firstGroup  = $this.find('.nx-group-field:first'),
                    lastGroup   = $this.find('.nx-group-field:last'),
                    clone       = $( $this.find('.nx-group-template').html() ),
                    groupId     = parseInt( lastGroup.data('id') ),
                    nextGroupId = groupId + 1,
                    title       = clone.data('group-title');

                groups.each(function() {
                    $(this).removeClass('open');
                });

                // Reset all data of clone object.
                clone.attr('data-id', nextGroupId);
                clone.addClass('open');
                // clone.find('.nx-group-field-title > span').html(title + ' ' + nextGroupId);
                clone.find('tr.nx-field[id*='+fieldId+']').each(function() {
                    var fieldName       = dataId;
                    var fieldNameSuffix = $(this).attr('id').split('[1]')[1];
                    var nextFieldId     = fieldName + '[' + nextGroupId + ']' + fieldNameSuffix;
                    var label           = $(this).find('th label');

                    $(this).find('[name*="'+fieldName+'[1]"]').each(function() {
                        var inputName       = $(this).attr('name').split('[1]');
                        var inputNamePrefix = inputName[0];
                        var inputNameSuffix = inputName[1];
                        var newInputName    = inputNamePrefix + '[' + nextGroupId + ']' + inputNameSuffix;
                        $(this).attr('id', newInputName).attr('name', newInputName);
                        label.attr('for', newInputName);
                    });

                    $(this).attr('id', nextFieldId);
                });

                clone.insertBefore( $( this ) );
            });

        });

	};

	/**
	 * This function will change tab 
	 * with menu click & Next Previous Button Click
	 */
	$.notificationx.tabChanger = function( buttonName ){
		var button = $( buttonName ),
			tabID = button.data('tabid'),
			tabKey = button.data('tab'), tab;

		if( tabKey != '' ) {
			tab = $( '#nx-' + tabKey );
			$('#nx_builder_current_tab').val( tabKey );
		}
	
		if( buttonName.nodeName !== 'BUTTON' ) {
			button.parent().find('li').each(function( i ){
				if( i < tabID ) {
					$( this ).addClass('nx-complete');
				} else {
					$( this ).removeClass('nx-complete');
				}
			});

			button.addClass( 'active' ).siblings().removeClass('active');
			tab.addClass( 'active' ).siblings().removeClass('active');
			return;
		}
		if( tab === undefined ){
			$('#publish').trigger('click');
			return;
		}
		$('.nx-metatab-menu li[data-tabid="'+ tabID +'"]').trigger('click');
		$('.nx-builder-tab-menu li[data-tabid="'+ tabID +'"]').trigger('click');
	};

	$.notificationx.toggleFields = function(){
		$( "body" ).delegate( '.nx-meta-field', 'change', function( e ) {
                $.notificationx.checkDependencies( this );
            }
		);
	};

	$.notificationx.toggle = function( array, func, prefix, suffix ) {
		var i = 0;
		suffix = 'undefined' == typeof suffix ? '' : suffix;
		if(typeof array !== 'undefined') {
			for( ; i < array.length; i++) {
				$(prefix + array[i] + suffix)[func]();
			}
		}
	};

	$.notificationx.checkDependencies = function( variable ){
		if ( notificationx.toggleFields === null ) {
			return;
		}

		var current = $( variable ),
			container = current.parents( '.nx-field:first' ),
			id = container.data( 'id' ),
			value = current.val();

		
		if ( 'checkbox' === current.attr('type') ) {
			if( ! current.is(':checked') ) {
				value = 0;
			} else {
				value = 1;
			}
		} 

		if ( current.hasClass('nx-theme-selected') ) {
			var currentTheme = current.parents('.nx-theme-control-wrapper').data('name');
			value = $( '#' + currentTheme ).val();
		}
		
		if ( ! notificationx.toggleFields.hasOwnProperty( id ) ) {
			return;
		}

		var canShow = notificationx.toggleFields[id].hasOwnProperty( value );
		if( notificationx.toggleFields.hasOwnProperty( id ) ) {
			$.each(notificationx.toggleFields[id], function( key, array ){
				$.notificationx.toggle(array.fields, 'hide', '#nx-meta-', '', id);
				$.notificationx.toggle(array.sections, 'hide', '#nx-meta-section-', '', id);
			})

		}

		if( canShow ) {
			$.notificationx.toggle(notificationx.toggleFields[id][value].fields, 'show', '#nx-meta-', '', id);
			$.notificationx.toggle(notificationx.toggleFields[id][value].sections, 'show', '#nx-meta-section-', '', id);
		}

		if( notificationx.hideFields.hasOwnProperty( id ) ) {
			var hideFields = notificationx.hideFields[id];
			if( hideFields.hasOwnProperty( value ) ) {
				$.notificationx.toggle(hideFields[ value ].fields, 'hide', '#nx-meta-', '', id);
				$.notificationx.toggle(hideFields[ value ].sections, 'hide', '#nx-meta-section-', '', id);
			}
		}

	};

	$.notificationx.selectTheme = function( image ){
		var imgParent = $( image ),
			img = imgParent.find('img'),
			value = img.data('theme'),
			wrapper = $( imgParent.parents('.nx-theme-control-wrapper') ),
			inputID = wrapper.data('name');

		imgParent.addClass('nx-theme-selected').siblings().removeClass('nx-theme-selected');
		$('#' + inputID).val( value );
		imgParent.trigger('change');
	};

	$.notificationx.groupToggle = function( group ){
		var input = $( group ),
			wrapper = input.parents('.nx-group-field');

		if( wrapper.hasClass('open') ) {
			wrapper.removeClass( 'open' );
		} else {
			wrapper.addClass('open').siblings().removeClass('open');
		}
	};

	$.notificationx.removeGroup = function( button ){
		var groupId = $(button).parents('.nx-group-field').data('id'),
			group   = $(button).parents('.nx-group-field[data-id="'+groupId+'"]');

		group.fadeOut({
			duration: 300,
			complete: function() {
				$(this).remove();
			}
		});
	};

	$.notificationx.cloneGroup = function( button ){
		var groupId = $(button).parents('.nx-group-field').data('id'),
			group   = $(button).parents('.nx-group-field[data-id="'+groupId+'"]'),
			clone   = $( group.clone() ),
			lastGroup   = $( button ).parents('.nx-group-fields-wrapper').find('.nx-group-field:last'),
			parent  = group.parent(),
			nextGroupID = $( lastGroup ).data('id') + 1;

		clone.attr('data-id', nextGroupID);
		clone.insertAfter(group);
		// $.notificationx.resetFieldIds( parent.find('.nx-group-field') );
	};

	$.notificationx.initMediaField = function( button ){
		var button = $( button ),
			wrapper = button.parents('.nx-media-field-wrapper'),
			removeButton = wrapper.find('.nx-media-remove-button'),
			imgContainer = wrapper.find('.nx-thumb-container'),
			idField = wrapper.find('.nx-media-id'),
			urlField = wrapper.find('.nx-media-url');

		// Create a new media frame
		var frame = wp.media({
			title: 'Upload Photo',
			button: {
				text: 'Use this photo'
			},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected in the media frame...
		frame.on( 'select', function() {
			// Get media attachment details from the frame state
			var attachment = frame.state().get('selection').first().toJSON();
			/**
			 * Set image to the image container
			 */
			imgContainer.addClass('nx-has-thumb').append( '<img src="'+attachment.url+'" alt="" style="max-width:100%;"/>' );
			idField.val( attachment.id ); // set image id
			urlField.val( attachment.url ); // set image url
			// Hide the upload button
			button.addClass( 'hidden' );
			// Show the remove button
			removeButton.removeClass( 'hidden' );
		});
		// Finally, open the modal on click
		frame.open();
	};

	$.notificationx.removeMedia = function( button ){
		var button = $( button ),
			wrapper = button.parents('.nx-media-field-wrapper'),
			uploadButton = wrapper.find('.nx-media-upload-button'),
			imgContainer = wrapper.find('.nx-has-thumb'),
			idField = wrapper.find('.nx-media-id'),
			urlField = wrapper.find('.nx-media-url');

		imgContainer.removeClass('nx-has-thumb').find('img').remove();

		urlField.val(''); // URL field has to be empty
		idField.val(''); // ID field has to empty as well

		button.addClass('hidden'); // Hide the remove button first
		uploadButton.removeClass('hidden'); // Show the uplaod button
	};

})( jQuery );
