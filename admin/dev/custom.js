$(document).ready(function() {
	(function($) {
			$.fn.clickoutside = function(callback) {
				var outside = 1, self = $(this);
				self.cb = callback;
				this.click(function() { 
					outside = 0; 
				});
				$(document).click(function() { 
					outside && self.cb();
					outside = 1;
				});
				return $(this);
			}
		})($);
	(function(jQuery) {
		// Browser supports HTML5 multiple file?
		var multipleSupport = typeof $('<input/>')[0].multiple !== 'undefined',
		isIE = /msie/i.test( navigator.userAgent );
		jQuery.fn.customFile = function() {
			return this.not(".customfile").each(function() {
				var $classes = $(this).attr('class');
				var $file = $(this).addClass('customfile');
				var $wrap = $('<div class="customfile-wrap ' + $classes + '">'),
					$input = $('<input type="text" class="customfile-filename" />'),
					$button = $('<button type="button" class="customfile-upload button">UPLOAD</button>');
					$label = $('<label class="customfile-upload" for="'+ $file[0].id +'">Browse</label>');
				$file.css({ position: 'absolute', left: '-9999px' });
				//$wrap.insertAfter( $file ).append( $file, $input, ( isIE ? $label : $button ) );
				//$wrap.insertAfter( $file ).append( $file, $input, $button );
				$wrap.insertAfter( $file ).append( $file, $button );
				$input.css('width', '100% !important').css('width', '-=91px'); //69px for button + 22px for padding+border
				$file.attr('tabIndex', - 1);
				$button.attr('tabIndex', - 1);
				$button.click(function () {
						$file.focus().click(); // Open dialog
					});
				$file.change(function() {
					var files = [], fileArr, filename;
					if ( multipleSupport ) {
						fileArr = $file[0].files;
						for ( var i = 0, len = fileArr.length; i < len; i++ ) {
							files.push( fileArr[i].name );
						}
						filename = files.join(', ');
					} else {
						filename = $file.val().split('').pop();
					}
					$input.val( filename ).attr('title', filename).focus();
				});
				$input.on({
					blur: function() { $file.trigger('blur'); },
					keydown: function( e ) {
						if ( e.which === 13 ) { // Enter
							if ( !isIE ) { $file.trigger('click'); }
						} else if ( e.which === 8 || e.which === 46 ) { // Backspace & Del
							// On some browsers the value is read - only
							// with this trick we remove the old input and add
							// a clean clone with all the original events attached
							$file.replaceWith( $file = $file.clone( true ) );
							$file.trigger('change');
							$input.val('');
						} else if ( e.which === 9 ){ // TAB
							return;
						} else { // All other keys
							return false;
						}
					}
				});
			});
		};
	}(jQuery));
	
	var offset = 520;
	var duration = 500;
	$(window).scroll(function() {
		var offset = 520;
		var duration = 500;
		if ($(this).scrollTop() > offset) {
			$('.back-to-top').fadeIn(duration);
		} else {
			$('.back-to-top').fadeOut(duration);
		}
	});
	
	$('.back-to-top').click(function(event) {
		event.preventDefault();
		$('html, body').animate({scrollTop: 0}, duration);
		return false;
	});
	
	$('.hidden').hide().removeClass('hidden');
	
	$("#formHome").submit(function(e) {
		e.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
			type:'POST',
			url: '/inc/form_process.php',
			data: formData,
			success: function(response) {
					$("#formHome_content").html(response);
				}
		});
		return false;
	});
	
	$(".clear_form").click(function(e) {
        $(this).parents('form').find('input').not('.button').each(function(index, element) {
            $(this).val('').prop('checked',false);
        });
		$("#listing_results").hide();
		$("#listing_complete").fadeIn();
    });
	
	$(".show_results").click(function(e) {
		e.preventDefault();
        $.ajax({
			type:'POST',
			url: '/admin/index.php',
			data: $(this).parents('form').serialize(),
			success: function(response) {
					$("#listing_complete").hide();
					$("#listing_results").html(response).fadeIn();
					var target = '#listing_results',
					$target = $(target);
					$('html, body').stop().animate({
						'scrollTop': $target.offset().top
					}, 900, 'swing', function () {
						window.location.hash = target;
					});
					$('.hidden').hide().removeClass('hidden');
					activate_links();
				}
		});
    });
	$(".pagescroll-parent").on( 'click', ".show_listings", function() {
        $("#listing_results").hide();
		$("#listing_complete").fadeIn();
    });
	$(".pagescroll-parent").on( 'click', ".page_next", function() {
		var panel = $(this).parents(".pagescroll-parent");
        var adjust = $(panel).find(".pagescroll").height();
		$(panel).find(".pagescroll-container").animate({
			top: "-=" + adjust
		}, 1500, function() {
			$(panel).find(".page_current").text(function(i,txt){ return parseInt(txt,10) + 1; });
			update_pagination( $(panel).attr('id') );
		});
    });
	$(".pagescroll-parent").on( 'click', ".page_prev", function() {
        var panel = $(this).parents(".pagescroll-parent");
        var adjust = $(panel).find(".pagescroll").height();
		$(panel).find(".pagescroll-container").animate({
			top: "+=" + adjust
		}, 1500, function() {
			$(panel).find(".page_current").text(function(i,txt){ return parseInt(txt,10) - 1; });
			update_pagination( $(panel).attr('id') );
		});
    });
	$("#service_selected, #visitation_selected").on( 'change',function(e) {
        var prefix = $(this).attr('id').replace('_selected','');
		var location = $("#location_" + $(this).val() );
		$("input[name=" + prefix + "_business]").val( $(location).children("span[data-id=business]").text() );
		$("input[name=" + prefix + "_branch]").val( $(location).children("span[data-id=branch]").text() );
		$("input[name=" + prefix + "_address]").val( $(location).children("span[data-id=address]").text() );
		$("input[name=" + prefix + "_address2]").val( $(location).children("span[data-id=address2]").text() );
		$("input[name=" + prefix + "_city]").val( $(location).children("span[data-id=city]").text() );
		$("input[name=" + prefix + "_state]").val( $(location).children("span[data-id=state]").text() );
		$("#" + prefix + "State_selector").attr('value', $(location).children("span[data-id=state]").text() ).find(".selectOptions").each(function(index, element) {
           $(this).removeClass('selectedOption');
		   if( $(this).val() == $(location).children("span[data-id=state]").text() ) $(this).addClass('selectedOption');
        });
		$("#" + prefix + "State_selector").find('span.selected').text( $(location).children("span[data-id=state]").text() );
		$("input[name=" + prefix + "_zip]").val( $(location).children("span[data-id=zip]").text() );
    });
	
	$(".img_swap").click(function(e) {
        $(this).siblings(".img_profile").attr( 'src', $(this).attr('src') );
		$(this).addClass('active').siblings(".img_swap").removeClass('active');
	});
	
	$(".post_condolence").click(function(e) {
		e.preventDefault();
        $.ajax({
			type:'POST',
			url: '/admin/index.php',
			data: $(this).parents('form').serialize(),
			success: function(response) {
					$(".obit-condolence-items").find(".mCSB_container").prepend(response);
					$(".scrolldiv").mCustomScrollbar("update");
					$("#body_fade").removeClass('active');
					$(".popup").hide();
					$(".post_condolence").siblings('input[name="name"]').val('');
					$(".post_condolence").siblings('textarea').val('');
				}
		});
    });
	
	var currentYear = new Date().getFullYear();
	$(".datepicker").datepicker({ dateFormat: "MM d, yy", showAnim: "slideDown", changeYear: true, yearRange: (currentYear - 120) + ":" + currentYear }).each(function() { $(this).datepicker('setDate', $(this).val()); });
	
	$(":file").customFile();
	$("[class^=folder_file]").change(function(){
		preview(this);
	});
	$(".clear_img").click(function(e) {
		$(this).parents(".folder_img").hide();
		var id = $(this).siblings('img').attr('id').replace('_preview','');
		$("#"+id).val('');
	});
	$(".form-delete").click(function(e) {
        var target = $(this).parents('.listing_box');
		var id = $(this).attr('data-id');
		$("#popup_form-delete").find(".js_delete").attr( 'data-id', id ).click(function(e) {
				$.ajax({
					type:'POST',
					url: '/admin/index.php',
					data: { process: 'listing', type: 'delete', id: id },
					success: function(response) {
							$("#body_fade").removeClass('active');
							$(".popup").hide();
							$(target).remove();
						}
				});
			});
    });
	$("#textarea_count").each(function(index, element) {
        $(this).text( $("#intro").val().length );
    });
	$("#intro").keyup(function(){
		$("#textarea_count").text( $(this).val().length );
	});
	
	
	
	/**
	 * Popups
	 */
	$("#body_fade, .popup_close").click(function(e) {
        $("#body_fade").removeClass('active');
		$(".popup").hide();
    });
	$(".popup_trigger").click(function(e) {
        $("#body_fade").addClass('active');
		var id = $(this).attr('id');
		$("#popup_"+id).show();
    });
	
	$(".btn_create_admin").click(function(e) {
		$(".create_admin").children(".title").text('Create a Content Admin');
		$("#admin_proc").attr('value','create_admin');
        $("#a_submit").addClass('btn_create');
        $("#create_admin").fadeIn();
    });
	$(".btn_create_director").click(function(e) {
		$(".create_director").children(".title").text('Add a Funeral Director');
		$("#director_proc").attr('value','create_director');
        $("#d_submit").addClass('btn_create');
        $("#create_director").fadeIn();
    });
	$(".btn_create_staff").click(function(e) {
		$(".create_staff").children(".title").text('Add Family Service Staff');
		$("#staff_proc").attr('value','create_staff');
        $("#s_submit").addClass('btn_create');
        $("#create_staff").fadeIn();
    });
	$(".admin_edit").click(function(e) {
		var form = $("#create_admin").children("form.create_admin");
		$(form).children(".title").text('Edit a Content Admin');
		$("#admin_proc").attr('value','edit_admin');
		var admin = $(this).parents(".admin_holder");
		var id = $(admin).attr('id').split('-',2);
		var name = $(admin).children(".admin_name").text();
		var username = $(admin).children(".admin_username").text();
		$(form).append('<input type="hidden" name="id" value="' + id[1] + '">');
		$("#a_name").attr('value',name);
        $("#a_username").attr('value',username);
		$("#a_submit").addClass('btn_save');
        $("#create_admin").fadeIn();
    });
	$(".director_edit").click(function(e) {
		var form = $("#create_director").children("form.create_admin");
		$(form).children(".title").text('Edit a Funeral Director');
		$("#director_proc").attr('value','edit_director');
		var admin = $(this).parents(".admin_holder");
		var id = $(admin).attr('id').split('-',2);
		var name = $(admin).children(".admin_name").children("span.name_full").text();
		var abbr = $(admin).children(".admin_name").children("span.name_abbr").text();
		$(form).append('<input type="hidden" name="id" value="' + id[1] + '">');
		$("#d_name").attr('value',name);
		$("#d_abbr").attr('value',abbr);
        $("#d_submit").addClass('btn_save');
        $("#create_director").fadeIn();
    });
	$(".staff_edit").click(function(e) {
		var form = $("#create_staff").children("form.create_admin");
		$(form).children(".title").text('Edit Family Service Staff');
		$("#staff_proc").attr('value','edit_staff');
		var admin = $(this).parents(".admin_holder");
		var id = $(admin).attr('id').split('-',2);
		var name = $(admin).children(".admin_name").children("span.name_full").text();
		var abbr = $(admin).children(".admin_name").children("span.name_abbr").text();
		$(form).append('<input type="hidden" name="id" value="' + id[1] + '">');
		$("#s_name").attr('value',name);
		$("#s_abbr").attr('value',abbr);
        $("#s_submit").addClass('btn_save');
        $("#create_staff").fadeIn();
    });
	$(".tooltip").parent().addClass('pointer').hover(function(){
		$(".tooltip").hide();
		$(this).children(".tooltip").show(500);
	},function(){
		$(this).children(".tooltip").hide(200);
	});
	$("#search_txt").click(function(){
			var value = $(this).val();
			if( value.indexOf('Search Listing') >= 0 ) $(this).val('');
			$("#search").clickoutside(function(){
					$("#search_txt").val(value);
				});
		}).keypress(function(event) {
			if (event.which == 13) {
				submitSearch();
			}
		});
	$(".search_icon").click(function(event){
			submitSearch();
		});
	$(".search_clear").click(function(e) {
        $("#search_txt").val('');
    });
	$(".cancel").click(function(e) {
        $(this).parents(".cancel_div").toggle();
    });
	
	activate_links();
	enableSelectBoxes();
	
	(function($){
        $(window).load(function(){
            $(".scrolldiv").mCustomScrollbar();
			$(".resize").each(function() {
				var folder = $(this).parents('.folder');
				var w_ratio = $(folder).outerWidth() / $(this).width();
				var h_ratio = $(folder).outerHeight() / $(this).height();
				var ratio = Math.max( w_ratio, h_ratio );
				$(this).css({
					'width':	$(this).width() * ratio,
					'height':	$(this).height() * ratio,
					'top':		( $(this).height() * ratio - $(folder).outerHeight() ) / -2,
					'left':		( $(this).width() * ratio - $(folder).outerWidth() ) / -2
				});
			});
        });
    })($);
	
});

function submitSearch(id_ext) {
	var search_txt = encodeURIComponent( $("#search_txt").val() );
	window.location.assign( "/admin/index.php?page=results&search=" + search_txt );
}

function preview(input) {
	var id = $(input).attr('id');
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			var image = $('#'+id+'_preview');
			var folder = $(image).parents('.folder');
			$(image).attr('src', e.target.result).load(function(e) {
				var w_ratio = $(folder).outerWidth() / $(image).width();
				var h_ratio = $(folder).outerHeight() / $(image).height();
				var ratio = Math.max( w_ratio, h_ratio );
				$(image).css({
					'width':	$(image).width() * ratio,
					'height':	$(image).height() * ratio,
					'top':		( $(image).height() * ratio - $(folder).outerHeight() ) / -2,
					'left':		( $(image).width() * ratio - $(folder).outerWidth() ) / -2
				});
			});
			$(image).parents('.folder_img').fadeIn();
		}
		reader.readAsDataURL(input.files[0]);
	}
}

function update_pagination( panel ) {
	var current = parseInt( $("#"+panel).find(".page_current").text() );
	var total = parseInt( $("#"+panel).find(".page_total").text() );
	if( current > 1 ) {
		$("#"+panel).find(".page_prev").fadeIn();
	} else {
		$("#"+panel).find(".page_prev").hide();
	}
	if( current < total ) {
		$("#"+panel).find(".page_next").fadeIn();
	} else {
		$("#"+panel).find(".page_next").hide();
	}
}

function checkDates() {
	var errordiv = '<div class="message text-right" style="margin-top: -30px;">This field is required.</div>';
	var error = false;
	$(".datepicker[required]").each(function(index, element) {
        if( $(this).val() == '' ) {
			$(this).after(errordiv);
			error = true;
		}
    });
	if( error ) {
		$('html, body').stop().animate({
			'scrollTop': $("#create").offset().top
		}, 900, 'swing', function () {
			window.location.hash = '#create';
		});
		return false;
	}
	return true;
}

function activate_links() {
	$(".btn_active").click(function(event){ event.stopPropagation(); });
	$("[class*=link_]").each(function(index, linkElement) {
    	var linkTarget = '#test';
		var linkOpen = 'same';
		var linkTitle = 'New Window';
		var linkArgs = '';
		var classList = $(linkElement).attr('class').split(/\s+/);
		$.each( classList, function(index2, classString){
			if( classString.substr(0,5) == 'link_' ) {
				var linkType = classString.replace('link_','');
				switch( linkType ) {
					case 'action_archive':
					case 'action_unarchive':
					case 'action_delete':
						var id = $(linkElement).parents("[id^=listing]").attr('id').split('-',2);
						var type = linkType.replace('action_','');
						linkTarget = '/admin/index.php?process=listing&type=' + type + '&id=' + id[1];
						break;
					case 'action_edit':
					case 'action_view':
						var id = $(linkElement).parents("[id^=listing]").attr('id').split('-',2);
						linkTarget = '/admin/index.php?page=listing&view=edit&id=' + id[1];
						break;
					case 'active': linkTarget = '/admin/index.php?page=default&view=Active'; break;
					case 'admin_delete':
						var id = $(linkElement).parents("[id^=admin]").attr('id').split('-',2);
						linkTarget = '/admin/index.php?process=admin&proc_type=' + linkType + '&id=' + id[1];
						break;
					case 'archive': linkTarget = '/admin/index.php?page=default&view=Archive'; break;
					case 'back': linkTarget = '/admin/index.php?page=default'; break;
					case 'cancel': linkTarget = '/admin/index.php?page=default'; break;
					case 'client-recover': linkTarget = '/obituaries/recovery.php'; break;
					case 'contact': linkTarget = '/admin/index.php?page=contact'; break;
					case 'create': linkTarget = '/obituaries/create.php'; break;
					case 'director_delete':
						var id = $(linkElement).parents("[id^=director]").attr('id').split('-',2);
						linkTarget = '/admin/index.php?process=admin&proc_type=' + linkType + '&id=' + id[1];
						break;
					case 'edit': linkTarget = '/obituaries/edit.php?id=' + $(linkElement).attr('data-id'); break;
					case 'flowers':
						linkOpen = 'new';
						linkTarget = 'http://flowerboxrockwall.com/';
						break;
					case 'listings': linkTarget = '/obituaries/listings.php'; break;
					case 'logging': linkTarget = '/admin/index.php?page=logs'; break;
					case 'login': linkTarget = '/admin/index.php?page=login'; break;
					case 'logout': linkTarget = '/admin/logoff.php'; break;
					case 'logslast':
					case 'logsnext':
					case 'logsprev':
						var data = $(linkElement).attr('data-id');
						linkTarget = '/admin/index.php?page=logs&pg=' + data[0];
						break;
					case 'pagelast':
					case 'pagenext':
					case 'pageprev':
						var data = $(linkElement).attr('data-id').split('-');
						linkTarget = '/admin/index.php?page=default&view=' + data[0] + '&pg=' + data[1];
						break;
					case 'recover': linkTarget = '/admin/index.php?page=login&view=recover'; break;
					case 'return': linkTarget = '/obituaries/'; break;
					case 'staff_delete':
						var id = $(linkElement).parents("[id^=staff]").attr('id').split('-',2);
						linkTarget = '/admin/index.php?process=admin&proc_type=' + linkType + '&id=' + id[1];
						break;
					case 'sysadmin': linkTarget = '/admin/index.php?page=admin'; break;
					case 'terms':
						linkOpen = 'new';
						linkTarget = '/terms/';
						break;
					case 'view': linkTarget = '/obituaries/obit.php?id=' + $(linkElement).attr('data-id'); break;
					default: linkTarget = '#' + linkType;
				}
			}
		});
		if( $(this).prop('tagName') === 'A' ) {
			$(this).attr('href', linkTarget);
			if( linkOpen == 'new' ) {
				$(this).attr('target', '_blank');
			}
		} else {
			if( linkOpen == 'new' ) {
				$(this).click(function(){ window.open( linkTarget, linkTitle, linkArgs ) });
			} else {
				$(this).click(function(){ window.location.assign( linkTarget ); });
			}
		}
    });
}

function enableSelectBoxes(){
	$('div.selectBox').each(function(){
		var box = $(this);
		var selected = $(this).find(".selectedOption");
		var selectedSpan = box.find("span.selected");
		selectedSpan.html( selected.html() );
		box.attr('value', selected.attr('value'));
		$(this).children(".selectedBox").click(function(){
			var thisSelect = $(this).siblings(".selectOptions");
			$(".selectOptions").not(thisSelect).slideUp(200);
			$(this).parents(".selectBox").clickoutside(function(){
				$(thisSelect).slideUp(100);
			});
			$(thisSelect).slideToggle(300).find(".selectOption").click(function(e) {
                $(this).addClass('selectedOption').siblings().removeClass('selectedOption');
				$(this).parent().hide();
				if( !selectedSpan.hasClass('ignore_select') ) {
					selectedSpan.html( $(this).html() );
				}
				//selectedSpan.trigger('setNextSelector');
				box.attr('value', $(this).attr('value'));
				var identifier = box.attr('id').replace('_selector','');
				$("#"+identifier+"_selected").attr('value',$(this).attr('value')).change();
            });
		});
	});
	$('.selectOptions').hover(function(){
		
	},function(){
		$(this).slideUp(300);
	});
}
