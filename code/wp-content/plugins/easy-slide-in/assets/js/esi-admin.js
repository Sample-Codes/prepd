(function ($) {

function toggle_pool_conditions () {
	var $check = $("#esi-not_in_the_pool"),
		$target = $("#esi-conditions-container")
	;
	if (!$check.is(":checked")) $target.show();
	else $target.hide();
}

function toggle_show_after_overrides () {
	var $check = $("#esi-override_show_if"),
		$target = $("#esi-show_after_overrides-container")
	;
	if ($check.is(":checked")) $target.show();
	else $target.hide();
}

function toggle_content_types () {
	var $check = $(':radio[name="esi-type[content_type]"]');
	if (!$check.length) return false;

	var selected_raw = $check.filter(":checked").val(),
		selected = selected_raw || 'text',
		$item = $("#esi-content_type-options-" + selected),
		$editor = $(".postarea")
	;
	if (!$item.length) return false;

	$('.esi-content_type').hide();
	$item.show();

	if ('related' == selected || 'widgets' == selected || 'optin' == selected) $editor.css({'display' : 'none'})
	else $editor.css({'display': 'block'})
}

function toggle_reshow_conditions () {
	var $check = $(':radio[name="esi[on_hide]"]');
	if (!$check.length) return false;

	var selected = $check.filter(":checked").val(),
		reshow = !!selected,
		$item = $(".esi-reshow_after")
	;
	if (reshow) $item.show('medium');
	else $item.hide('medium');
	return false;
}

function esi_quick_message_settings_apply() {
	var current_style = $("#esi-quick-style-apply").val();

	switch (current_style) {
	case "1":
		$("#esi-full_width").removeAttr('checked');
		$("#esi-full_heightwidth").removeAttr('checked');
		$("#esi-width").val('450');
		$("#esi-custom_width").find("input").attr("disabled", false);
		$("#esi-vetical_cols").removeAttr('checked');
		$("#position-bottom_right").attr('checked', 'checked');
		break;
	case "2":
		$("#esi-full_width").attr('checked', 'checked');
		$("#esi-full_heightwidth").removeAttr('checked');
		$("#esi-width").val('0');
		$("#esi-custom_width").find("input").attr("disabled", true);
		$("#position-bottom_right").attr('checked', 'checked');
		$("#esi-vetical_cols").removeAttr('checked');
		break;
	case "3":
		$("#esi-full_width").attr('checked', 'checked');
		$("#esi-full_heightwidth").removeAttr('checked');
		$("#esi-width").val('0');
		$("#esi-custom_width").find("input").attr("disabled", true);
		$("#position-top_right").attr('checked', 'checked');
		$("#esi-vetical_cols").removeAttr('checked');
		break
	case "4":
		$("#esi-full_width").removeAttr('checked');
		$("#esi-full_heightwidth").attr('checked', 'checked');
		$("#esi-width").val('400');
		$("#esi-custom_width").find("input").attr("disabled", false);
		$("#position-bottom_left").attr('checked', 'checked');
		$("#esi-vetical_cols").attr('checked', 'checked');
		break
	case "5":
		$("#esi-full_width").removeAttr('checked');
		$("#esi-full_heightwidth").attr('checked', 'checked');
		$("#esi-width").val('400');
		$("#esi-custom_width").find("input").attr("disabled", false);
		$("#position-bottom_right").attr('checked', 'checked');
		$("#esi-vetical_cols").attr('checked', 'checked');
		break;
	case "6":
		$("#esi-full_width").attr('checked', 'checked');
		$("#esi-full_heightwidth").attr('checked', 'checked');
		$("#esi-width").val('0');
		$("#esi-custom_width").find("input").attr("disabled", true);
		$("#position-bottom_right").attr('checked', 'checked');
		//$("#esi-vetical_cols").attr('checked', 'checked');
		break
	}
}


$(function () {


	$(':radio[name="esi-type[content_type]"]').on("change", toggle_content_types);
	toggle_content_types();

	$("#esi-not_in_the_pool").on("change", toggle_pool_conditions);
	toggle_pool_conditions();

	$("#esi-override_show_if").on("change", toggle_show_after_overrides);
	$('[name="esi[show_after-condition]"]').on("change", function () {
		$('[name="esi[show_after-rule]"]').attr("disabled", true);
		$(this).parent("td").find('[name="esi[show_after-rule]"]').attr("disabled", false);
		$(this).parent("div").find('[name="esi[show_after-rule]"]').attr("disabled", false);
	});
	//toggle_show_after_overrides();

	$(':radio[name="esi[on_hide]"]').on("change", toggle_reshow_conditions);
	toggle_reshow_conditions();

	// Add fieldset clearing links
	$("#esi-conditions-container fieldset").each(function () {
		$(this)
			.append('<a href="#clear-set" class="esi-clear_set">' + l10nesi.clear_set + '</a>')
			.find("a.esi-clear_set").on("click", function () {
				$(this).parents("fieldset").first().find(":radio").attr("checked", false);
				return false;
			});
		;
	});

	// Width toggling
	$("#esi-full_width").on("change", function () {
		if (!$("#esi-full_width").is(":checked")) {
			$("#esi-custom_width").find("input").attr("disabled", false);
			//$('label[for="esi-full_width"]').addClass("esi-not_applicable");
		} else {
			$("#esi-custom_width").find("input").attr("disabled", true);
			//$('label[for="esi-full_width"]').removeClass("esi-not_applicable");
		}
	});
	
	$("#esi-stay-onscreen").on("click", function() {
		$(this).parent("td").find('[name="esi[show_for-time]"]').val("59");
		$(this).parent("td").find('[name="esi[show_for-unit]"]').val("h");
	});
	
	$("#esi-quick-style-apply").on("change", esi_quick_message_settings_apply);
	
	$("#edit-slug-box").css({'visibility': 'hidden'});
});

})(jQuery);



jQuery(document).ready(function($){
	 
	 
    var custom_uploader;
 
 
    $('#esi-button-backgroundimage').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Background Image File',
            button: {
                text: 'Select Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#esi-backgroundimage').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });

 
});