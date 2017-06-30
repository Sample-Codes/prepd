jQuery(document).ready(function(a) {
    "use strict";
     a("#v_start_date").datepicker({
        dateFormat: "yy-mm-dd",
        numberOfMonths: 1,
        showButtonPanel: !0,
        showOn: "button",
        buttonImage: woocommerce_user_csv_import_params.calendar_icon,
        buttonImageOnly: !0
    }),a("#v_end_date").datepicker({
        dateFormat: "yy-mm-dd",
        numberOfMonths: 1,
        showButtonPanel: !0,
        showOn: "button",
        buttonImage: woocommerce_user_csv_import_params.calendar_icon,
        buttonImageOnly: !0
    }),
        a("#usr_enable_ftp_ie").click(function () {
        if (this.checked) {
            a("#usr_export_section_all").show();
        }else{
            a("#usr_export_section_all").hide();
        }
    });
    a("select[name=usr_auto_export]").change(function() {
        if("Disabled" === a(this).val()){
            a(".usr_export_section").hide();
        }else{
            a(".usr_export_section").show();
        }
    });
    
    if(woocommerce_user_csv_cron_params.usr_enable_ftp_ie != 1){
        a("#usr_export_section_all").hide();
    };
    if(woocommerce_user_csv_cron_params.usr_auto_export === 'Disabled'){
        a(".usr_export_section").hide();
    };
    a("select[name=usr_auto_import]").change(function() {
        if("Disabled" === a(this).val()){
            a(".usr_import_section").hide();
        }else{
            a(".usr_import_section").show();
        }
    })
    if(woocommerce_user_csv_cron_params.usr_auto_import === 'Disabled'){
        a(".usr_import_section").hide();
    }
});