<?php if ( ! defined( 'ABSPATH' ) || ! class_exists( 'NF_Abstracts_Action' )) exit;

/**
 * Class NF_Action_ZapierAction
 */
final class NF_Zapier_Actions_ZapierAction extends NF_Abstracts_Action {
    /**
     * @var string
     */
    protected $_name  = 'zapier';

    /**
     * @var array
     */
    protected $_tags = array('Zapier');

    /**
     * @var string
     */
    protected $_timing = 'normal';

    /**
     * @var int
     */
    protected $_priority = '10';

    /**
     * Constructor
     */
    public function __construct() {
		parent::__construct();

		$this->_nicename = __( 'Zapier', 'zapier' );
		
		$settings = array (	
			'zapier' => array(
				'name' => 'zapier-hook',
				'type' => 'textbox',
				'label' => __( 'Zapier Web Hook', 'zapier' ),
				'placeholder' => __( 'Paste your Zapier Webhooks URL here', 'zapier' ),
				'width' => 'full',
				'group' => 'primary',
				'use_merge_tags' => FALSE,
			)	
		
		);
		$this->_settings = array_merge ( $this->_settings, $settings );
		
	}

    /*
    * PUBLIC METHODS
    */
		
	public function publish( $data ) {
	
		//CHECK IF ANYTHING CHANGED, IF SO, WHEN WE PUBLISH WE WILL RUN A TEST SYNC
		$is_new = update_option( 'nf_zapier_last_form', $data );
		$test_results = array();
		
		if ( $is_new ) {
			forEach ( $data['actions'] as $action ) {
				if ( $action['type'] == 'zapier' ) {
					$test_results[] = do_zapier_test_sync( $action['zapier-hook'], $data['fields'] );
				}
			}
		}
		
		if ( in_array ( FALSE, $test_results ) ) {
			$data['zapier']['zapier_sync'] = FALSE;
		} else if ( in_array ( TRUE, $test_results ))  {
			$data['zapier']['zapier_sync'] = TRUE;
		} else {
			// do nothing
		}
				
		return $data;
	
	}

    public function save( $action_settings ) {
		//RUN SYNC ON PUBLISH RATHER THAN SAVE
			
	}

    public function process( $action_settings, $form_id, $data ) {
	
		$url = $action_settings['zapier-hook'];
		$fields = array();
		$field_data = $data['fields'];
		$fields['Date'] = date('Y-m-d H:i:s');
		
		forEach ( $field_data as $field_array ) {
			$fields[$field_array['label']] = $field_array['value'];
		}
					
		$result = ninja_forms_zapier_post_to_webhook($url, $fields);
				
		return $data;
	}
}