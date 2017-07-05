<?php if ( ! defined( 'ABSPATH' ) ) exit;

/*
 * Plugin Name: Ninja Forms - Excel Export
 * Plugin URI: http://etzelstorfer.com/en/
 * Description: Export Ninja Forms submissions to Excel file
 * Version: 3.1
 * Author: Hannes Etzelstorfer
 * Author URI: http://etzelstorfer.com/en/
 * Text Domain: ninja-forms-excel-export
 *
 * Copyright 2017 Hannes Etzelstorfer.
 */


if( version_compare( get_option( 'ninja_forms_version', '0.0.0' ), '3.0', '<' ) || get_option( 'ninja_forms_load_deprecated', FALSE ) ) {
    include 'deprecated/ninja-forms-excel-export.php';

} else {

    /**
     * Class NF_ExcelExport
     */
    final class NF_ExcelExport
    {
        const VERSION = '3.1';
        const SLUG    = 'excel-export';
        const NAME    = 'Excel Export';
        const AUTHOR  = 'Hannes Etzelstorfer';
        const PREFIX  = 'NF_ExcelExport';

        /**
         * @var NF_ExcelExport
         * @since 3.0
         */
        private static $instance;

        /**
         * Plugin Directory
         *
         * @since 3.0
         * @var string $dir
         */
        public static $dir = '';

        /**
         * Plugin URL
         *
         * @since 3.0
         * @var string $url
         */
        public static $url = '';

        private $subs_per_page = 200;

        /**
         * Main Plugin Instance
         *
         * Insures that only one instance of a plugin class exists in memory at any one
         * time. Also prevents needing to define globals all over the place.
         *
         * @since 3.0
         * @static
         * @static var array $instance
         * @return NF_ExcelExport Highlander Instance
         */
        public static function instance()
        {
            if (!isset(self::$instance) && !(self::$instance instanceof NF_ExcelExport)) {
                self::$instance = new NF_ExcelExport();

                self::$dir = plugin_dir_path(__FILE__);

                self::$url = plugin_dir_url(__FILE__);

                /*
                 * Register our autoloader
                 */
                spl_autoload_register(array(self::$instance, 'autoloader'));
            }
        }

        public function __construct()
        {
            /*
             * Required for all Extensions.
             */
            add_action( 'admin_init', array( $this, 'setup_license') );

            //require self::$dir . 'includes/class-ninjaformsspreadsheet.php';
            load_plugin_textdomain('ninja-forms-spreadsheet', false, self::$dir . '/translations' );

            add_action( 'admin_menu', array( $this, 'add_admin_page'));
            add_action( 'wp_ajax_nf_spreadsheet_export', array($this,'export_file') );
            add_action( 'wp_ajax_nf_spreadsheet_save_field_settings', array($this,'save_field_settings') );
            add_action( 'admin_init', array( $this, 'output_export_file' ));
        }




        public function add_admin_page(){
            if( function_exists('Ninja_Forms') )
                Ninja_Forms()->menus[ 'excel-export' ]         = new NF_ExcelExport_Admin_Menus_ExcelExport();
        }
        

        /*
         * Optional methods for convenience.
         */

        public function autoloader($class_name)
        {

            if (class_exists($class_name)) return;

            if ( false === strpos( $class_name, self::PREFIX ) ) return;

            $class_name = str_replace( self::PREFIX, '', $class_name );
            $classes_dir = realpath(plugin_dir_path(__FILE__)) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR;
            $class_file = str_replace('_', DIRECTORY_SEPARATOR, $class_name) . '.php';

            if (file_exists($classes_dir . $class_file)) {
                require_once $classes_dir . $class_file;
            }
        }




        public function save_field_settings(){
            $form_id = $_POST['form_id'];
            $field_settings = $_POST['field_settings'];
            $fields_associative = array();
            foreach ($field_settings as $field) {
                $fields_associative[ $field['field_key'] ] = $field;
            }

            update_option( 'nf_excel_field_settings_' . $form_id, $fields_associative );
            wp_die();
        }
                



        public function export_file(){
            $form_id = $_POST['spreadsheet_export_form_id'];
            $field_key_raw = $_POST['spreadsheet_export_field_keys'];
            $begin_date = $_POST['spreadsheet_export_begin_date'];
            $end_date = $_POST['spreadsheet_export_end_date'];
            $use_xls = false;

            if( $_POST['spreadsheet_export_file_format'] == 'xls' )
                $use_xls = true;

            if( $use_xls )
                $tmp_file = 'form-submissions'.$_POST['spreadsheet_export_tmp_name'].'.xls';
            else
                $tmp_file = 'form-submissions'.$_POST['spreadsheet_export_tmp_name'].'.xlsx';

            $tmp_file = trailingslashit( get_temp_dir() ).$tmp_file;

            $iteration = $_POST['spreadsheet_export_iteration'];

            $sub_results = $this->get_submissions($form_id,$begin_date,$end_date,$iteration);

            $num_submissions = $this->count_submissions($form_id,$begin_date,$end_date);

            $fields_meta = Ninja_Forms()->form($form_id)->get_fields();
            
            $selected_fields = array();
            foreach($field_key_raw AS $key => $active){
                if($active == 1)
                    $selected_fields[] = $key;
            }
            
            $field_names=array();

            $header_row=array();
            $header_row['id'] = __('ID','ninja-forms-spreadsheet');
            $header_row['date_submitted'] = __('Submission date','ninja-forms-spreadsheet');
            $selected_field_names = array();
            foreach($fields_meta as $field){
                $field_settings = $field->get_settings();
                $field_names[$field_settings['key']] = sanitize_title( $field_settings['label'].'-'.$field_settings['key'] );
                $field_types[$field_settings['key']] = $field_settings['type'];
                if(in_array($field_settings['key'], $selected_fields)){
                    $selected_field_names[$field_settings['key']]=(isset($field_settings['admin_label']) && $field_settings['admin_label'] ? $field_settings['admin_label'] : $field_settings['label']);
                }
            }

            foreach ($selected_fields as $key) {
                $header_row[$key] = $selected_field_names[$key];
            }
            
            
            require_once(self::$dir.'includes/PHPExcel.php');

            $cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_serialized;
            if (!PHPExcel_Settings::setCacheStorageMethod($cacheMethod)) {
                die($cacheMethod . " caching method is not available" . EOL);
            }
            
            if( $iteration > 0 ){
                $objPHPExcel = PHPExcel_IOFactory::load($tmp_file);
                $row_number = $this->subs_per_page * $iteration+1;
            }else{
                $objPHPExcel = new PHPExcel(); 
                $row_number = 1;
            }

            if( $use_xls )
                $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
            else
                $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            
            // Table Headline
            if( $iteration==0 ){
                $col_index = 0;
                foreach ($header_row as $headline) {
                    $col = PHPExcel_Cell::stringFromColumnIndex( $col_index );
                    $objPHPExcel->getActiveSheet()->getCell($col.$row_number)->setValue( $headline );
                    $objPHPExcel->getActiveSheet()->getStyle($col.$row_number)->getFont()->setBold(true);
                    $col_index++;
                }
                $objPHPExcel->getActiveSheet()->freezePane( "A2" );
            }
            $row_number++; 

            foreach($sub_results as $sub){
                $col = 'A';
                $objPHPExcel->getActiveSheet()->getCell($col++.$row_number)->setValueExplicit( $sub['_seq_num'], PHPExcel_Cell_DataType::TYPE_NUMERIC );
                $objPHPExcel->getActiveSheet()->getCell($col++.$row_number)->setValueExplicit( $sub['date_submitted'] );
                foreach ($selected_fields as $col_index => $field_key) {
                    if( isset($sub[$field_key]) ){
                        $field_value = $sub[$field_key];
                        $col = PHPExcel_Cell::stringFromColumnIndex( 2+$col_index );


                        if( in_array($field_types[$field_key], array( 'shipping', 'total', 'number' ) ) ){ // float values
                            $objPHPExcel->getActiveSheet()->getCell($col.$row_number) ->setValueExplicit( $field_value, PHPExcel_Cell_DataType::TYPE_NUMERIC );
                            $objPHPExcel->getActiveSheet()->getStyle($col.$row_number)
                                ->getNumberFormat()
                                ->setFormatCode('#,##');
                        }elseif( in_array($field_types[$field_key], array( 'starrating', 'quantity' ) ) ){ // integer values
                            $objPHPExcel->getActiveSheet()->getCell($col.$row_number) ->setValueExplicit( $field_value, PHPExcel_Cell_DataType::TYPE_NUMERIC );
                            $objPHPExcel->getActiveSheet()->getStyle($col.$row_number)
                                ->getNumberFormat()
                                ->setFormatCode('#');
                        }elseif( in_array($field_types[$field_key], array( 'checkbox' ) ) || strpos($field_types[$field_key], '-optin') ){
                            $objPHPExcel->getActiveSheet()->getCell($col.$row_number)->setValueExplicit( ($field_value?__('yes'):__('no') ), PHPExcel_Cell_DataType::TYPE_STRING );
                        }elseif( in_array($field_types[$field_key], array( 'listcheckbox' ) ) ){
                            $field_output = $field_value;
                            $field_value = unserialize( $field_value );
                            if( is_array($field_value) ){
                                $field_output = '';
                                foreach ($field_value as $key => $value) {
                                    if( $field_output == '' )
                                        $field_output = $value;
                                    else
                                        $field_output .= ', ' . $value;
                                }
                            }
                            $objPHPExcel->getActiveSheet()->getCell($col.$row_number)->setValueExplicit( htmlspecialchars_decode ( $field_output,ENT_QUOTES ), PHPExcel_Cell_DataType::TYPE_STRING );
                        }elseif( $field_types[$field_key] == 'file_upload' ){
                            $file_urls = '';
                            $field_value = unserialize($field_value);
                            if( is_array($field_value)){
                                $file_urls = implode("\n", $field_value);
                            }
                            $objPHPExcel->getActiveSheet()->getCell($col.$row_number)->setValueExplicit( htmlspecialchars_decode ( $file_urls,ENT_QUOTES ), PHPExcel_Cell_DataType::TYPE_STRING );
                            $objPHPExcel->getActiveSheet()->getStyle($col.$row_number)
                                ->getAlignment()
                                ->setWrapText(true);
                        }else{
                            if( is_array($field_value) ){
                                $field_value = implode('; ', $field_value);
                            }
                            $objPHPExcel->getActiveSheet()->getCell($col.$row_number)->setValueExplicit( htmlspecialchars_decode ( $field_value,ENT_QUOTES ), PHPExcel_Cell_DataType::TYPE_STRING );
                        }
                    }
                }
                $row_number++;
            }

            if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){
                echo json_encode(array(
                        'iteration'     => intval( $iteration ),
                        'num_iterations' => ceil( $num_submissions/$this->subs_per_page ),
                        //'debug' => 'Iteration: ' . $iteration . ' #Results (this iteration): ' . count($sub_results) . ' Results (total): ' . $num_submissions
                    )
                );
                $objWriter->save($tmp_file);
            }else{
                //echo 'Iteration: ' . $iteration . ' #Results (this iteration): ' . count($sub_results) . ' Results (total): ' . $num_submissions;
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
                foreach ($selected_fields as $col_index => $field_key) {
                    $col = PHPExcel_Cell::stringFromColumnIndex( 2+$col_index );
                    $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
                }

                $output_file_name = sanitize_title( Ninja_Forms()->form($form_id)->get()->get_setting( 'title' ) ) . '_' . date('Y-m-d_His');
                if( $use_xls ){
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="' . $output_file_name . '.xls"');
                }else{
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header('Content-Disposition: attachment;filename="' . $output_file_name . '.xlsx"');
                }
                header('Cache-Control: max-age=0');
                $objWriter->save("php://output");
            }
            
            die();
            
        }




        public function output_export_file(){
            if( ! current_user_can( apply_filters( 'ninja_forms_admin_excel_export_capabilities', 'manage_options' ) ) ) return;

            if( isset($_POST['spreadsheet_export_tmp_name']) ){
                $this->export_file();
                die;
            }
        }





        private function get_submissions($form_id,$begin_date,$end_date,$iteration){
            $query_args = array(
                'post_type'         => 'nf_sub',
                'posts_per_page'    => $this->subs_per_page,
                'offset'            => $this->subs_per_page * $iteration,
                'date_query'        => array(
                    'inclusive'     => true,
                ),
                'meta_query'        => array(
                    array(
                        'key' => '_form_id',
                        'value' => $form_id,
                    )
                ),
            );

            if( isset( $begin_date ) AND $begin_date != '') {
                $query_args['date_query']['after'] = $begin_date .= ' 00:00:00';
            }

            if( isset( $end_date ) AND $end_date != '' ) {
                $query_args['date_query']['before'] = $end_date .= ' 23:59:59';
            }

            $subs = new WP_Query( $query_args );

            $sub_objects = array();
            $sub_index = 0;

            if ( is_array( $subs->posts ) && ! empty( $subs->posts ) ) {
                foreach ( $subs->posts as $sub ) {
                    $sub_objects[$sub_index] = Ninja_Forms()->form( $form_id )->get_sub( $sub->ID )->get_field_values();
                    $sub_objects[$sub_index]['date_submitted'] = get_the_date('', $sub->ID );
                    $sub_index++;
                }           
            }

            return $sub_objects;
        }


        private function count_submissions($form_id,$begin_date,$end_date){
            $query_args = array(
                'post_type'         => 'nf_sub',
                'posts_per_page'    => -1,
                'date_query'        => array(
                    'inclusive'     => true,
                ),
                'meta_query'        => array(
                    array(
                        'key' => '_form_id',
                        'value' => $form_id,
                    )
                ),
                'fields' => 'ids'
            );

            if( isset( $begin_date ) AND $begin_date != '') {
                $query_args['date_query']['after'] = $begin_date .= ' 00:00:00';
            }

            if( isset( $end_date ) AND $end_date != '' ) {
                $query_args['date_query']['before'] = $end_date .= ' 23:59:59';
            }

            $subs = new WP_Query( $query_args );;
            $num_submissions = $subs->found_posts;
            wp_reset_postdata();
            return $num_submissions;
        }

    

        public static function template( $file_name = '', array $data = array(), $return = FALSE )
        {
            if( ! $file_name ) return FALSE;

            extract( $data );

            $path = self::$dir . 'includes/Templates/' . $file_name;

            if( ! file_exists( $path ) ) return FALSE;

            if( $return ) return file_get_contents( $path );

            include $path;
        }

        /*
         * Required methods for all extension.
         */

        public function setup_license()
        {
            if ( ! class_exists( 'NF_Extension_Updater' ) ) return;

            new NF_Extension_Updater( self::NAME, self::VERSION, self::AUTHOR, __FILE__, self::SLUG );
        }
    }

    /**
     * The main function responsible for returning The Highlander Plugin
     * Instance to functions everywhere.
     *
     * Use this function like you would a global variable, except without needing
     * to declare the global.
     *
     * @since 3.0
     * @return {class} Highlander Instance
     */
    function NF_ExcelExport()
    {
        return NF_ExcelExport::instance();
    }

    NF_ExcelExport();
}
