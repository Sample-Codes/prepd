<?php if ( ! defined( 'ABSPATH' ) ) exit;

final class NF_ExcelExport_Admin_Menus_ExcelExport extends NF_Abstracts_Submenu
{
    public $parent_slug = 'ninja-forms';

    public $menu_slug = 'nf-excel-export';

    public $page_title = 'Excel Export';

    public $priority = 12;

    public function __construct()
    {
        parent::__construct();
    }


    public function get_capability()
    {
        $capability = apply_filters( 'ninja_forms_admin_spreadsheet_capabilities', $this->capability ); // keep this for backwards compatibility
        return apply_filters( 'ninja_forms_admin_excel_export_capabilities', $capability );
    }


    public function display()
    {
        wp_enqueue_script('haet_nf_spreadsheet_js',  NF_ExcelExport::$url.'/js/nf-spreadsheet.js', array( 'jquery','jquery-ui-sortable','jquery-ui-datepicker'));

        wp_enqueue_style( 'haet_nf_spreadsheet_css',  NF_ExcelExport::$url.'/css/nf-spreadsheet.css',array());



        $grouped_settings = array();
        $groups = array();

        $groups['spreadsheet_export_form'] = array(
                'id'    =>  'spreadsheet_export_form',
                'label' =>  __('Select a form','ninja-forms')
            );
        $groups['spreadsheet_export_fields'] = array(
                'id'    =>  'spreadsheet_export_fields',
                'label' =>  __('Select fields for export','ninja-forms')
            );
        $groups['spreadsheet_export_submit'] = array(
                'id'    =>  'spreadsheet_export_submit',
                'label' =>  __('Export','ninja-forms')
            );

        $forms = Ninja_Forms()->form()->get_forms();

        if(count($forms)==0)
            $grouped_settings['spreadsheet_export_form'] = array(
                    'no_forms' => array(
                                        'id' => 'nf_excel[no_forms]',
                                        'type' => 'desc',
                                        'label' => __('You don\'t have any forms yet.', 'ninja-forms-spreadsheet'),
                                        'desc' => '',
                                        'value' => ''
                                    )
                );
        else{
            $form_selection_array=array();

            foreach( $forms as $form ){
                $form_selection_array[]=array(
                    'label'  =>  $form->get_setting( 'title' ),
                    'value' =>  $form->get_id()
                );
            }


            $grouped_settings['spreadsheet_export_form'] = array(
                    'form_id'   => array(
                            'id' => 'spreadsheet_export_form_id',
                            'type' => 'select',
                            'label' => __('Select a form','ninja-forms'),
                            'options' => $form_selection_array,
                            'value' => ''
                        ),
                    'begin_date' => array(
                        'id' => 'spreadsheet_export_begin_date',
                        'type' => 'textbox',
                        'label' => __('Begin Date','ninja-forms'),
                        'value' => ''
                    ),
                    'end_date'   => array(
                        'id' => 'spreadsheet_export_end_date',
                        'type' => 'textbox',
                        'label' => __('End Date','ninja-forms'),
                        'value' => ''
                    ),
                );
             


            // field selection
            foreach( $forms as $form ){
                $current_form_id = $form->get_id();
                break;
            }
            if(isset($_GET['spreadsheet_export_form_id']))
                $current_form_id = $_GET['spreadsheet_export_form_id'];
            else if(isset($_POST['spreadsheet_export_form_id']))
                $current_form_id = $_POST['spreadsheet_export_form_id'];
            $fields = Ninja_Forms()->form($current_form_id)->get_fields();

            $field_order_settings = get_option( 'nf_excel_field_settings_' . $current_form_id );
            if( ! is_array($field_order_settings) )
                $field_order_settings = array();

            // echo '<pre>'.print_r($fields,true).'</pre>';
            $grouped_settings['spreadsheet_export_fields'] = array();
            foreach($fields as $field){
                $field_settings = $field->get_settings();
                //echo '<pre>'.print_r($field_settings,true).'</pre>';
                if(!in_array( $field_settings['type'], array('submit','hr','html','_page_divider','recaptcha','spam'))){
                    $grouped_settings['spreadsheet_export_fields']['spreadsheet_export_field_'.$field_settings['key']]=array(
                        'id' => 'spreadsheet_export_field_keys['.$field_settings['key'].']',
                        'key' => $field_settings['key'],
                        'type' => 'checkbox',
                        'label'=> '<span class="dashicons dashicons-menu"></span>' . (isset($field_settings['admin_label']) && $field_settings['admin_label'] ? $field_settings['admin_label'] : $field_settings['label']).' <br><span style="font-size:10px;color:#999;text-transform:uppercase;">'.__('Field type','ninja-forms-spreadsheet').':</span> <span style="font-size:11px;">'.str_replace('_', ' ', $field_settings['type']).'</span>',
                        'value'=> ( array_key_exists($field_settings['key'], $field_order_settings) && !$field_order_settings[$field_settings['key']]['checked'] ? 0 : 1 ) 
                    );
                }
            }
            if( is_array($field_order_settings) ){
                $sorted_fields = array();
                foreach ($field_order_settings as $field_order_setting) {
                    if( array_key_exists('spreadsheet_export_field_'.$field_order_setting['field_key'], $grouped_settings['spreadsheet_export_fields'])){
                        $sorted_fields['spreadsheet_export_field_'.$field_order_setting['field_key']] = $grouped_settings['spreadsheet_export_fields']['spreadsheet_export_field_'.$field_order_setting['field_key']];
                        unset( $grouped_settings['spreadsheet_export_fields']['spreadsheet_export_field_'.$field_order_setting['field_key']] );
                    }
                }
                $grouped_settings['spreadsheet_export_fields'] = array_merge( $sorted_fields, $grouped_settings['spreadsheet_export_fields'] );
            }
            
            ob_start();
            ?>
            <input type="submit" value="<?php _e('Download Excel file','ninja-forms-spreadsheet');?>" id="ninja_forms_spreadsheet_submit" class="button-primary">
            <p>
                <?php _e( 'File type', 'ninja-forms-spreadsheet' ); ?>:<br>
                <input type="radio" id="spreadsheet_export_file_format_xlsx" name="spreadsheet_export_file_format" value="xlsx" checked="checked">
                <label for="spreadsheet_export_file_format_xlsx"> XLSX</label> &nbsp; &nbsp;
                <input type="radio" id="spreadsheet_export_file_format_xls" name="spreadsheet_export_file_format" value="xls">
                <label for="spreadsheet_export_file_format_xlsx">  XLS</label>
            </p>
            <p class="description">
                <?php _e( 'In some server environments XLS has better compatibility.', 'ninja-forms-spreadsheet' ); ?>
            </p>


            <div class="spreadsheet-export-progress">
                <img src="<?php echo admin_url(); ?>/images/spinner.gif" title="" alt="">
                <?php _e( 'exporting ...', 'ninja-forms-spreadsheet' ); ?>
                <div class="percent">0 %</div>
                <progress max="100" value="0"></progress>
            </div>
            <?php
            $submit_html = ob_get_clean();
            $grouped_settings['spreadsheet_export_submit'] = array(
                'spreadsheet_export_button' => array(
                    'id' => 'spreadsheet_export_button',
                    'type' => 'html',
                    'html' => $submit_html,
                    'label'=> '',
                )
            );
            


        }


        $errors = array();



        NF_ExcelExport::template( 'excelexport.html.php', compact( 'grouped_settings', 'groups', 'errors' ) );
    }

} // End Class NF_ExcelExport_Admin_Menus_ExcelExport
