var nf_excelexport = nf_excelexport || {};


nf_excelexport.serialize_export_fields = function(){
    var $ = jQuery;
    var html_ids = $( '#ninja_forms_metabox_spreadsheet_export_fields_settings .form-table tbody' ).sortable( "toArray");
    console.log(html_ids);
    var fields = [];
    for (var i = 0; i < html_ids.length; i++) {
        var $field = $('#'+html_ids[i]);
        var field_key = $field.data('key');
        var checked = $field.find('input[type="checkbox"]').prop('checked');
        fields.push({
            'field_key' : field_key,
            'checked' : (checked?1:0)
        });
    }
    console.log(fields);
    $.post(
    	ajaxurl, 
    	{ 
    		action : 'nf_spreadsheet_save_field_settings', 
    		form_id : $('#spreadsheet_export_form_id').val(),
    		field_settings : fields
    	}
	);
}


nf_excelexport.spreadsheet_iteration = function(formData){
	var $ = jQuery;
	
	formData['action'] = 'nf_spreadsheet_export';

	$.post(ajaxurl, formData, function(data) {	
		data = JSON.parse(data);	
		// console.log(data); 
		if( data.iteration < data.num_iterations-2 ){
			formData['spreadsheet_export_iteration'] = (data.iteration+1);
			nf_excelexport.spreadsheet_iteration(formData);
			$('.spreadsheet-export-progress .percent').text( Math.floor((data.iteration+1)/data.num_iterations*100) + ' %' );
			$('.spreadsheet-export-progress progress').val( Math.floor((data.iteration+1)/data.num_iterations*100) );
		}else{
			$('#spreadsheet_export_iteration').val( data.iteration+1 );
			$('#nf_spreadsheet_export_form input[name],select').prop('disabled',false);
			$('#nf_spreadsheet_export_form .postbox').removeClass('exporting');
			$('.spreadsheet-export-progress .percent').text( '100 %' );
			$('.spreadsheet-export-progress progress').val( 100 );
			$('#ninja_forms_spreadsheet_submit').removeClass('disabled');
			$('#nf_spreadsheet_export_form').submit();
		}
	});
}


jQuery(document).ready(function($) {
	$('#spreadsheet_export_begin_date,#spreadsheet_export_end_date').datepicker( {
		dateFormat: "yy-mm-dd"
	} );
	$('#spreadsheet_export_form_id').change(function(){
		var $form_select = $(this);
		var url_array = window.location.href.split( '?' );
		$( '#ninja_forms_metabox_spreadsheet_export_fields_settings' ).addClass('loading');
		$( '#ninja_forms_spreadsheet_submit').addClass('disabled');
		$.get( url_array[0],{
				'page'	: 'nf-excel-export',
				'spreadsheet_export_form_id'	:	$form_select.val()
			}, function( data ) {
			$( '#ninja_forms_metabox_spreadsheet_export_fields_settings' ).replaceWith( 
				$($.parseHTML(data)).find("#ninja_forms_metabox_spreadsheet_export_fields_settings")
			);
			$( '#ninja_forms_metabox_spreadsheet_export_fields_settings .form-table tbody' ).sortable({
				stop: function( event, ui ) {
				    nf_excelexport.serialize_export_fields();
				}});
			$('#ninja_forms_metabox_spreadsheet_export_fields_settings .form-table tbody input[type="checkbox"]').change(function(){
				nf_excelexport.serialize_export_fields();
			})
			$('#ninja_forms_spreadsheet_submit').removeClass('disabled');
		});
		
	});
	$('#spreadsheet_export_form_id').change();

	$('#ninja_forms_spreadsheet_submit').live('click',function(e){
		e.preventDefault();
		var $button = $(this);
		if( !$button.hasClass('disabled') ){
			$('#nf_spreadsheet_export_form').find('input[name],select').prop('disabled',true);
			$('#nf_spreadsheet_export_form .postbox').addClass('exporting');
			$button.addClass('disabled');
			$('.spreadsheet-export-progress .percent').text( '0 %' );
			$('.spreadsheet-export-progress progress').val( 0 );

			$('#spreadsheet_export_iteration').val( 0 );
			var formData = {};
			$('#nf_spreadsheet_export_form').find('input[name],select').each(function(){
				var $field = $(this);
				if( $field.attr('type') == 'checkbox' )
					formData[$field.attr('name')] = ( $field.prop('checked')?1:0 );
				else if( $field.attr('type') == 'radio' ){
					if(  $field.prop('checked') )
						formData[$field.attr('name')] = $field.val();
				}else
					formData[$field.attr('name')] = $field.val();
				
			});

			nf_excelexport.spreadsheet_iteration(formData);
		}
		return false;
	});


	$( '#ninja_forms_metabox_spreadsheet_export_fields_settings .form-table' ).sortable();
});

