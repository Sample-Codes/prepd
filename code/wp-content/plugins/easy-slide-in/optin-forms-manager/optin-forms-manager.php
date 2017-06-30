<?php 

// Add translation to plugin
function esi_optinforms_init() {
	$plugin_dir = basename(dirname(__FILE__));
}
add_action('plugins_loaded', 'esi_optinforms_init');

// Allow for translation of plugin description
$plugin_header_translate = array(
	__('Create beautiful optin forms with ease. Choose a form design, customize it, and add your form to your blog with a simple mouse-click.', 'esi'),
);

// Add our menu to WordPress
add_action( 'admin_menu', 'esi_optinforms_menu' );

function esi_optinforms_menu() 
{
	// @since 1.1.2 added a menu position decimal fix to prevent conflict with other themes using 31, such as Thesis Theme
	// @http://gabrielharper.com/blog/2012/08/wordpress-admin-menu-positioning-conflicts/
	//$submenu = add_menu_page(__('Optin Forms','menu-test'), __('Optin Forms','menu-test'), 'manage_options', 'esi', 'esi_optinforms_main_page', plugins_url('optin-forms-manager/images/icon.png'), '30.1');
	$page = "edit.php?post_type=" . Easy_SlideIn::POST_TYPE;
	$perms = is_multisite () ? 'manage_network_options' : 'manage_options';
	$submenu = add_submenu_page ( $page, __ ( 'Optin Forms', 'esi' ), __ ( 'Optin Forms', 'esi' ), $perms, 'esi-optin', 'esi_optinforms_main_page' );
	
	// * We want our JS and CSS loaded on our admin pages only, so let's just load them for now
	add_action( 'load-' . $submenu, 'load_esi_optinforms_admin_scripts' );
}

// Enqueue our CSS and JS on WP Video Coach admin pages only
function load_esi_optinforms_admin_scripts() {
	add_action( 'admin_enqueue_scripts', 'esi_optinforms_admin_scripts' );
}

// Include our registration settings
include( plugin_dir_path( __FILE__ ) . 'includes/register-settings.php');
// Include our regular functions
include( plugin_dir_path( __FILE__ ) . 'includes/functions.php');
// Include our form functions
include( plugin_dir_path( __FILE__ ) . 'includes/functions-form-1.php');
include( plugin_dir_path( __FILE__ ) . 'includes/functions-form-2.php');
include( plugin_dir_path( __FILE__ ) . 'includes/functions-form-3.php');
include( plugin_dir_path( __FILE__ ) . 'includes/functions-form-4.php');
include( plugin_dir_path( __FILE__ ) . 'includes/functions-form-5.php');
include( plugin_dir_path( __FILE__ ) . 'includes/functions-forms.php');


// Add our CSS and JS to admin head, but just for our pages (see load_esi_optinforms_admin_scripts above!)
function esi_optinforms_admin_scripts()
{
	wp_enqueue_style('esi-optinforms-admin-stylesheet', plugins_url('/css/esi-optinforms-admin.css', __FILE__ ), array('googleFont'));
	wp_enqueue_script('tabcontent', plugins_url('/js/tabcontent.js', __FILE__ ));
	wp_enqueue_style('wp-color-picker');
	wp_enqueue_script('esi-optinforms-color', plugins_url('/js/esi-optinforms-color.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
	wp_enqueue_script('placeholder', plugins_url('/js/placeholder.js', __FILE__ ));
	wp_enqueue_script('toggle', plugins_url('/js/custom.js', __FILE__ ));
	wp_register_style('googleFont', 'http://fonts.googleapis.com/css?family=Share+Tech|Droid+Sans|Lobster|Fenix|Unkempt|Flavors|Viga|Damion|Oleo+Script|Racing+Sans+One|Nixie+One|Fredoka+One|Open+Sans|Overlock+SC|Bubbler+One|Contrail+One|Gochi+Hand|Roboto+Condensed|Russo+One|Cinzel+Decorative|News+Cycle|Marcellus+SC|Chewy|Quicksand|Sanchez|Signika+Negative|Gloria+Hallelujah|Grand+Hotel|Droid+Serif|Englebert|Oswald|Pacifico|Titan+One|Shadows+Into+Light|Dancing+Script|Luckiest+Guy|Parisienne|Coming+Soon|Baumans|Belgrano');
}

// Enqueue our form CSS on front end
	add_action( 'wp_enqueue_scripts', 'esi_optinforms_scripts' );


// Add our CSS and JS to admin head, but just for our pages (see load_esi_optinforms_admin_scripts above!)
function esi_optinforms_scripts()
{
	global $esi_optinforms_form_design;
	wp_enqueue_script('jquery');
	wp_enqueue_style('esi-optinforms-stylesheet', plugins_url('/css/esi-optinforms.css', __FILE__ ), array('googleFont'));
	wp_enqueue_script('placeholder', plugins_url('/js/placeholder.js', __FILE__ ));
	wp_register_style('googleFont', esi_optinforms_used_fonts());
}

// Make sure user can manage options
function esi_optinforms_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
?>

<?php }
function esi_optinforms_main_page() {
	
	{ ?>
    <div class="wrap">
    	<div id="icon-optinforms" class="icon32">
        </div><!--icon-32-->
		<h2 class="title"><?php echo esi_optinforms_menu_tabs(); ?></h2>
    </div><!--wrap-->
    
		<?php echo esi_optinforms_configuration(); ?>

        <?php if( isset($_GET['settings-updated']) ) { ?>
    		<div id="message" class="updated">
        		<p><strong><?php _e('Settings updated') ?></strong></p>
    		</div>
		<?php } ?>
    
    <div id="optinforms">
      	<form method="post" action="options.php" id="frm1">
        <?php settings_fields( 'esi-optinforms-settings-group' ); ?>
    	
        <div id="esi-optinforms-email-solution-tab" class="tabcontent">
        	<div class="esi-optinforms-container-left">
                <?php include( plugin_dir_path( __FILE__ ) . 'includes/options-email-solution.php'); ?>
            </div><!--esi-optinforms-container-left-->
            <div class="esi-optinforms-container-right">
            </div><!--esi-optinforms-container-right-->
            <div class="clear"></div>
    	</div><!--esi-optinforms-email-solution-tab-->
        
    	<div id="esi-optinforms-posts-tab" class="tabcontent">
        	<div class="esi-optinforms-container-left">
                <div class="optiongroup">
                    <p><?php echo __('Add a beautiful optin form to your posts, custom post types and pages. Include the form on your website with a simple mouse-click, or use the shortcode to add it to specific posts and pages.', 'esi'); ?></p>
                    <div class="optionleft">
                        <label for="esi_optinforms_form_design" class="nopointer"><?php echo __('Form design', 'esi'); ?></label>
                    </div><!--optionleft-->
                    <div class="optionmiddle">
                        <select name="esi_optinforms_form_design" id="esi_optinforms_form_design">
                            <option value="esi_optinforms_form_design_option1" <?php if (get_option('esi_optinforms_form_design')== 'esi_optinforms_form_design_option1') echo 'selected="selected"'; ?>>01</option>
                            <option value="esi_optinforms_form_design_option2" <?php if (get_option('esi_optinforms_form_design')== 'esi_optinforms_form_design_option2') echo 'selected="selected"'; ?>>02</option>
                            <option value="esi_optinforms_form_design_option3" <?php if (get_option('esi_optinforms_form_design')== 'esi_optinforms_form_design_option3') echo 'selected="selected"'; ?>>03</option>
                            <option value="esi_optinforms_form_design_option4" <?php if (get_option('esi_optinforms_form_design')== 'esi_optinforms_form_design_option4') echo 'selected="selected"'; ?>>04</option>
                            <option value="esi_optinforms_form_design_option5" <?php if (get_option('esi_optinforms_form_design')== 'esi_optinforms_form_design_option5') echo 'selected="selected"'; ?>>05</option>
                        </select>
                        <script type="text/javascript">
                            document.getElementById('esi_optinforms_form_design').onchange = function() {
                                var i = 1;
                                var myDiv = document.getElementById("esi_optinforms_form_design_option" + i);
                                while(myDiv) {
                                    myDiv.style.display = 'none';
                                    myDiv = document.getElementById("esi_optinforms_form_design_option" + ++i);
                                }
                            document.getElementById(this.value).style.display = 'block';
                            var current_style_id = this.value.replace("esi_optinforms_form_design_option", "");
                            document.getElementById('esi_optinforms_form_shortcode').value = '[esi-optinform style="'+current_style_id+'"]';
                            
                        };
                        </script>
                    </div><!--optionmiddle-->
                    <div class="optionlast">
                                    
                    </div><!--optionlast-->
                    <div class="clear"></div>
        
                </div><!--optiongroup-->
                
                <div class="optiongroup">
                    <div id="esi_optinforms_form_design_option1" <?php if (get_option('esi_optinforms_form_design')== '' || get_option('esi_optinforms_form_design')== 'esi_optinforms_form_design_option1') echo 'style="display:block;"'; ?>>
                        
						<?php include( plugin_dir_path( __FILE__ ) . 'includes/preview-form-1.php'); ?>
                       	<?php include( plugin_dir_path( __FILE__ ) . 'includes/options-form-1.php'); ?>
                    
                    </div><!--esi_optinforms_form_design_option1-->
                    <div id="esi_optinforms_form_design_option2" <?php if (get_option('esi_optinforms_form_design')== 'esi_optinforms_form_design_option2') echo 'style="display:block;"'; ?>>
                        
                        <?php include( plugin_dir_path( __FILE__ ) . 'includes/preview-form-2.php'); ?>
                        <?php include( plugin_dir_path( __FILE__ ) . 'includes/options-form-2.php'); ?>
                        
                    </div><!--esi_optinforms_form_design_option2-->
                    <div id="esi_optinforms_form_design_option3" <?php if (get_option('esi_optinforms_form_design')== 'esi_optinforms_form_design_option3') echo 'style="display:block;"'; ?>>
                        
                        <?php include( plugin_dir_path( __FILE__ ) . 'includes/preview-form-3.php'); ?>
                        <?php include( plugin_dir_path( __FILE__ ) . 'includes/options-form-3.php'); ?>
                        
                    </div><!--esi_optinforms_form_design_option3-->
                    <div id="esi_optinforms_form_design_option4" <?php if (get_option('esi_optinforms_form_design')== 'esi_optinforms_form_design_option4') echo 'style="display:block;"'; ?>>
                    
                        <?php include( plugin_dir_path( __FILE__ ) . 'includes/preview-form-4.php'); ?>
                        <?php include( plugin_dir_path( __FILE__ ) . 'includes/options-form-4.php'); ?>
                        
                    </div><!--esi_optinforms_form_design_option4-->
                    <div id="esi_optinforms_form_design_option5" <?php if (get_option('esi_optinforms_form_design')== 'esi_optinforms_form_design_option5') echo 'style="display:block;"'; ?>>
                        
                        <?php include( plugin_dir_path( __FILE__ ) . 'includes/preview-form-5.php'); ?>
                        <?php include( plugin_dir_path( __FILE__ ) . 'includes/options-form-5.php'); ?>
                        
                    </div><!--esi_optinforms_form_design_option5-->
                </div><!--optiongroup-->
                
                <?php //include( plugin_dir_path( __FILE__ ) . 'includes/options-form-functionality.php'); ?>
                <?php include( plugin_dir_path( __FILE__ ) . 'includes/options-form-placement.php'); ?>
                
        	</div><!--esi-optinforms-container-left-->
            <div class="esi-optinforms-container-right">
            </div><!--esi-optinforms-container-right-->
            <div class="clear"></div>
        </div><!--esi-optinforms-posts-tab-->
        
        <script type="text/javascript">
			var wpthumbs=new ddtabcontent("esi-optinforms-menu-tabs") //enter ID of Tab Container
			wpthumbs.setpersist(true) //toogle persistence of the tabs' state
			wpthumbs.setselectedClassTarget("link") //"link" or "linkparent"
			wpthumbs.init()
        </script>
        
        <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </form>
        

	</div><!--esi-optinforms-->

<?php }


} ?>