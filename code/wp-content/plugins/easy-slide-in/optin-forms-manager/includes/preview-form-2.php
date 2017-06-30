<?php ?>
						<div id="esi-optinforms-form2-container">
                            <div id="esi-optinforms-form2" style="background: <?php echo esi_optinforms_form2_default_background(); ?>;">
                                <div id="esi-optinforms-form2-title-container" <?php if (get_option('esi_optinforms_form2_hide_title')== '1') echo 'style="display:none;"'; ?>>
                                    <div id="esi-optinforms-form2-title" style="font-family:<?php echo esi_optinforms_form2_default_title_font(); ?>; font-size:<?php echo esi_optinforms_form2_default_title_size(); ?>; line-height:<?php echo esi_optinforms_form2_default_title_size(); ?>; color:<?php echo esi_optinforms_form2_default_title_color(); ?>"><?php echo esi_optinforms_form2_default_title(); ?></div><!--esi-optinforms-form2-title-->
                                </div><!--esi-optinforms-form2-title-container-->
                                <div id="esi-optinforms-form2-email-field-container" <?php if (get_option('esi_optinforms_form2_hide_title')== '1' && get_option('esi_optinforms_form2_hide_disclaimer')== '1') echo 'style="width:80%;"'; elseif (get_option('esi_optinforms_form2_hide_title')== '1') echo 'style="width:62%;"'; elseif (get_option('esi_optinforms_form2_hide_disclaimer')== '1') echo 'style="width:48%;"' ?>>
                                    <input type="text" id="esi-optinforms-form2-email-field" placeholder="<?php echo esi_optinforms_form2_default_email_field(); ?>" style="font-family:<?php echo esi_optinforms_form2_default_fields_font(); ?>; font-size:<?php echo esi_optinforms_form2_default_fields_size(); ?>; color:<?php echo esi_optinforms_form2_default_fields_color(); ?>;" />
                                </div><!--esi-optinforms-form2-email-field-container-->
                                <div id="esi-optinforms-form2-button-container">
                                    <input type="button" id="esi-optinforms-form2-button" value="<?php echo esi_optinforms_form2_default_button_text(); ?>" style="font-family:<?php echo esi_optinforms_form2_default_button_text_font(); ?>; font-size:<?php echo esi_optinforms_form2_default_button_text_size(); ?>; color:<?php echo esi_optinforms_form2_default_button_text_color(); ?>; background-color:<?php echo esi_optinforms_form2_default_button_background(); ?>" />
                                </div><!--esi-optinforms-form2-button-container-->
                                <div id="esi-optinforms-form2-disclaimer-container" <?php if (get_option('esi_optinforms_form2_hide_disclaimer')== '1') echo 'style="display:none;"'; ?>>
                                    <p id="esi-optinforms-form2-disclaimer" style="font-family:<?php echo esi_optinforms_form2_default_disclaimer_font(); ?>; font-size:<?php echo esi_optinforms_form2_default_disclaimer_size(); ?>; line-height: <?php echo esi_optinforms_form2_default_disclaimer_size(); ?>; color:<?php echo esi_optinforms_form2_default_disclaimer_color(); ?>"><?php echo esi_optinforms_form2_default_disclaimer(); ?></p>
                                </div><!--esi-optinforms-form2-disclaimer-container-->
                                <div class="clear"></div>
                            </div><!--esi-optinforms-form2-->
                        </div><!--esi-optinforms-form2-container-->
                        <div class="clear"></div>			
                   

<?php ?>