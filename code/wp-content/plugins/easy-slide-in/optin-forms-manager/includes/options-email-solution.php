<?php ?>
			<div class="optiongroup">
                    <p><?php echo __('Select your email solution and configure the required fields.', 'esi'); ?></p>
                    <div class="optionleft">
                        <label for="esi_optinforms_email_solution" class="nopointer"><?php echo __('My email solution is', 'esi'); ?></label>
                    </div><!--optionleft-->
                    <div class="optionmiddle">
                        <select name="esi_optinforms_email_solution" id="esi_optinforms_email_solution">
                            <option value="esi_optinforms_email_solution_option1" <?php if (get_option('esi_optinforms_email_solution')== 'esi_optinforms_email_solution_option1') echo 'selected="selected"'; ?>>aWeber</option>
                            <option value="esi_optinforms_email_solution_option2" <?php if (get_option('esi_optinforms_email_solution')== 'esi_optinforms_email_solution_option2') echo 'selected="selected"'; ?>>iContact</option>
                            <option value="esi_optinforms_email_solution_option3" <?php if (get_option('esi_optinforms_email_solution')== 'esi_optinforms_email_solution_option3') echo 'selected="selected"'; ?>>MailChimp</option>
                            <option value="esi_optinforms_email_solution_option4" <?php if (get_option('esi_optinforms_email_solution')== 'esi_optinforms_email_solution_option4') echo 'selected="selected"'; ?>>GetResponse</option>
                            <option value="esi_optinforms_email_solution_option5" <?php if (get_option('esi_optinforms_email_solution')== 'esi_optinforms_email_solution_option5') echo 'selected="selected"'; ?>>Mad Mimi</option>
                            <option value="esi_optinforms_email_solution_option6" <?php if (get_option('esi_optinforms_email_solution')== 'esi_optinforms_email_solution_option6') echo 'selected="selected"'; ?>>Interspire Email Marketer</option>
                        </select>
                        <script type="text/javascript">
                            document.getElementById('esi_optinforms_email_solution').onchange = function() {
                                var i = 1;
                                var myDiv = document.getElementById("esi_optinforms_email_solution_option" + i);
                                while(myDiv) {
                                    myDiv.style.display = 'none';
                                    myDiv = document.getElementById("esi_optinforms_email_solution_option" + ++i);
                                }
                            document.getElementById(this.value).style.display = 'block';
                        };
                        </script>
                    </div><!--optionmiddle-->
                    <div class="clear"></div>
        
                </div><!--optiongroup-->
                
                <div class="optiongroup">
                    <div id="esi_optinforms_email_solution_option1" <?php if (get_option('esi_optinforms_email_solution')== '' || get_option('esi_optinforms_email_solution')== 'esi_optinforms_email_solution_option1') echo 'style="display:block;"'; ?>>
                    	<!--<p class="esi-optinforms-integration"><a href="#"></?php echo __('Learn how to integrate aWeber: watch the short video', 'esi'); ?></a></p>-->
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label><a onclick="esi_optinforms_explain_aweber()"><span class="explain">?</span></a></label> <label for="esi_optinforms_form_list_name_aweber" class="nopointer"><?php echo __('List name', 'esi'); ?> <span class="required">*</span></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form_list_name_aweber" name="esi_optinforms_form_list_name_aweber" value="<?php echo esi_optinforms_form_list_name_aweber(); ?>" />
                            </div><!--optionmiddle-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <script type="text/javascript">
                            function esi_optinforms_explain_aweber() {
                                // Get the DOM reference
                                var contentId = document.getElementById("esi-optinforms-explain-aweber");
                                // Toggle 
                                contentId.style.display == "block" ? contentId.style.display = "none" : 
                                contentId.style.display = "block"; 
                            }
                        </script>
                        <div id="esi-optinforms-explain-aweber" style="display:none;">
                            <div class="esi-optinforms-step">
                            	<h4><?php echo __('How to find your list name', 'esi'); ?></h4>
                                <p><span class="step">1</span> <?php echo __('Log in to your aWeber account', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-aweber-001.png" class="step-image" />
                                <p><span class="step">2</span> <?php echo __('Click on My Lists in the navigation menu', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-aweber-002.png" class="step-image" />
                                <p><span class="step">3</span> <?php echo __('Click on List Settings from the submenu options', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-aweber-003.png" class="step-image" />
                                <p><span class="step">4</span> <?php echo __('You will find your list name in the List Name field', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-aweber-004.png" class="step-image" />
                            </div><!--esi-optinforms-step-->
                        </div><!--esi-optinforms-explain-aweber-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label><a onclick="esi_optinforms_explain_redirect_aweber()"><span class="explain">?</span></a></label> <label for="esi_optinforms_form_redirect_aweber" class="nopointer"><?php echo __('Redirect URL', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form_redirect_aweber" name="esi_optinforms_form_redirect_aweber" value="<?php echo esi_optinforms_form_redirect_aweber(); ?>" />
                            </div><!--optionmiddle-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <script type="text/javascript">
                            function esi_optinforms_explain_redirect_aweber() {
                                // Get the DOM reference
                                var contentId = document.getElementById("esi-optinforms-explain-redirect-aweber");
                                // Toggle 
                                contentId.style.display == "block" ? contentId.style.display = "none" : 
                                contentId.style.display = "block"; 
                            }
                        </script>
                        <div id="esi-optinforms-explain-redirect-aweber" style="display:none;">
                            <div class="esi-optinforms-help">
                                <p><?php echo __('Enter the URL of the page where your visitors will be taken to, once they successfully subscribe.', 'esi'); ?> <?php echo __('If you leave this field blank, the default aWeber message will be used.', 'esi'); ?></p>
                            </div><!--esi-optinforms-help-->
                        </div><!--esi-optinforms-explain-redirect-aweber-->
                        
                        
                    </div><!--esi_optinforms_email_solution_option1-->
                    <div id="esi_optinforms_email_solution_option2" <?php if (get_option('esi_optinforms_email_solution')== 'esi_optinforms_email_solution_option2') echo 'style="display:block;"'; ?>>
                        <!--<p class="esi-optinforms-integration"></?php echo __('Learn how to integrate iContact: watch the short video', 'esi'); ?></p>-->
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label><a onclick="esi_optinforms_explain_icontact()"><span class="explain">?</span></a></label> <label for="esi_optinforms_form_listid_icontact" class="nopointer"><?php echo __('List ID', 'esi'); ?> <span class="required">*</span></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form_listid_icontact" name="esi_optinforms_form_listid_icontact" value="<?php echo esi_optinforms_form_listid_icontact(); ?>" />
                            </div><!--optionmiddle-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label><a onclick="esi_optinforms_explain_icontact()"><span class="explain">?</span></a></label> <label for="esi_optinforms_form_specialid_icontact" class="nopointer"><?php echo __('Special ID', 'esi'); ?> <span class="required">*</span></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form_specialid_icontact" name="esi_optinforms_form_specialid_icontact" value="<?php echo esi_optinforms_form_specialid_icontact(); ?>" />
                            </div><!--optionmiddle-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label><a onclick="esi_optinforms_explain_icontact()"><span class="explain">?</span></a></label> <label for="esi_optinforms_form_clientid_icontact" class="nopointer"><?php echo __('Client ID', 'esi'); ?> <span class="required">*</span></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form_clientid_icontact" name="esi_optinforms_form_clientid_icontact" value="<?php echo esi_optinforms_form_clientid_icontact(); ?>" />
                            </div><!--optionmiddle-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <script type="text/javascript">
                            function esi_optinforms_explain_icontact() {
                                // Get the DOM reference
                                var contentId = document.getElementById("esi-optinforms-explain-icontact");
                                // Toggle 
                                contentId.style.display == "block" ? contentId.style.display = "none" : 
                                contentId.style.display = "block"; 
                            }
                        </script>
                        <div id="esi-optinforms-explain-icontact" style="display:none;">
                            <div class="esi-optinforms-step">
                            	<h4><?php echo __('How to find your list ID, special ID and client ID values', 'esi'); ?></h4>
                                <p><span class="step">1</span> <?php echo __('Log in to your iContact account', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-icontact-001.png" class="step-image" />
                                <p><span class="step">2</span> <?php echo __('Click on Contacts in the navigation menu', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-icontact-002.png" class="step-image" />
                                <p><span class="step">3</span> <?php echo __('Click on Sign-up Forms in the submenu', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-icontact-003.png" class="step-image" />
                                <p><span class="step">4</span> <?php echo __('Click on the Create HTML Form button', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-icontact-004.png" class="step-image" />
                                <p><span class="step">5</span> <?php echo __('Click on Next', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-icontact-005.png" class="step-image" />
                                <p><span class="step">6</span> <?php echo __('Name your form, assign it to a list and include the First Name field', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-icontact-006.png" class="step-image" />
                                <p><span class="step">7</span> <?php echo __('Click on Save', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-icontact-007.png" class="step-image" />
                                <p><span class="step">8</span> <?php echo __('Click on the View HTML link', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-icontact-008.png" class="step-image" />
                                <p><span class="step">9</span> <?php echo __('Scroll down to the Manual Sign-up Form and copy the values of listid, specialid and clientid fields', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-icontact-009.png" class="step-image" />
                            </div><!--esi-optinforms-step-->
                        </div><!--esi-optinforms-explain-icontact-->
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label><a onclick="esi_optinforms_explain_redirect_icontact()"><span class="explain">?</span></a></label> <label for="esi_optinforms_form_redirect_icontact" class="nopointer"><?php echo __('Redirect page URL', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form_redirect_icontact" name="esi_optinforms_form_redirect_icontact" value="<?php echo esi_optinforms_form_redirect_icontact(); ?>" />
                            </div><!--optionmiddle-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <script type="text/javascript">
                            function esi_optinforms_explain_redirect_icontact() {
                                // Get the DOM reference
                                var contentId = document.getElementById("esi-optinforms-explain-redirect-icontact");
                                // Toggle 
                                contentId.style.display == "block" ? contentId.style.display = "none" : 
                                contentId.style.display = "block"; 
                            }
                        </script>
                        <div id="esi-optinforms-explain-redirect-icontact" style="display:none;">
                            <div class="esi-optinforms-help">
                                <p><?php echo __('Enter the URL of the page where your visitors will be taken to, once they successfully subscribe.', 'esi'); ?> <?php echo __('If you leave this field blank, the default iContact message will be used.', 'esi'); ?></p>
                            </div><!--esi-optinforms-help-->
                        </div><!--esi-optinforms-explain-redirect-icontact-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label><a onclick="esi_optinforms_explain_error_icontact()"><span class="explain">?</span></a></label> <label for="esi_optinforms_form_error_icontact" class="nopointer"><?php echo __('Error page URL', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form_error_icontact" name="esi_optinforms_form_error_icontact" value="<?php echo esi_optinforms_form_error_icontact(); ?>" />
                            </div><!--optionmiddle-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <script type="text/javascript">
                            function esi_optinforms_explain_error_icontact() {
                                // Get the DOM reference
                                var contentId = document.getElementById("esi-optinforms-explain-error-icontact");
                                // Toggle 
                                contentId.style.display == "block" ? contentId.style.display = "none" : 
                                contentId.style.display = "block"; 
                            }
                        </script>
                        <div id="esi-optinforms-explain-error-icontact" style="display:none;">
                            <div class="esi-optinforms-help">
                                <p><?php echo __('Enter the URL of the page where your visitors will be taken to, if there are any errors.', 'esi'); ?> <?php echo __('If you leave this field blank, the default iContact error message will be used.', 'esi'); ?></p>
                            </div><!--esi-optinforms-help-->
                        </div><!--esi-optinforms-explain-error-icontact-->
                        
                    </div><!--esi_optinforms_email_solution_option2-->
                    <div id="esi_optinforms_email_solution_option3" <?php if (get_option('esi_optinforms_email_solution')== 'esi_optinforms_email_solution_option3') echo 'style="display:block;"'; ?>>
                    	<!--<p class="esi-optinforms-integration"></?php echo __('Learn how to integrate MailChimp: watch the short video', 'esi'); ?></p>-->
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label><a onclick="esi_optinforms_explain_mailchimp()"><span class="explain">?</span></a></label> <label for="esi_optinforms_form_action_mailchimp" class="nopointer"><?php echo __('Form action URL', 'esi'); ?> <span class="required">*</span></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form_action_mailchimp" name="esi_optinforms_form_action_mailchimp" value="<?php echo esi_optinforms_form_action_mailchimp(); ?>" />
                            </div><!--optionmiddle-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <script type="text/javascript">
                            function esi_optinforms_explain_mailchimp() {
                                // Get the DOM reference
                                var contentId = document.getElementById("esi-optinforms-explain-mailchimp");
                                // Toggle 
                                contentId.style.display == "block" ? contentId.style.display = "none" : 
                                contentId.style.display = "block"; 
                            }
                        </script>
                        <div id="esi-optinforms-explain-mailchimp" style="display:none;">
                            <div class="esi-optinforms-step">
                            	<h4><?php echo __('How to find your form action URL', 'esi'); ?></h4>
                                <p><span class="step">1</span> <?php echo __('Log in to your MailChimp account', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-mailchimp-001.png" class="step-image" />
                                <p><span class="step">2</span> <?php echo __('Click on Lists in the navigation menu', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-mailchimp-002.png" class="step-image" />
                                <p><span class="step">3</span> <?php echo __('Click on the arrow next to the list you wish to use and click on Signup forms', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-mailchimp-003.png" class="step-image" />
                                <p><span class="step">4</span> <?php echo __('Select Embedded forms', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-mailchimp-004.png" class="step-image" />
                                <p><span class="step">5</span> <?php echo __('Select the Naked form', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-mailchimp-005.png" class="step-image" />
                                <p><span class="step">6</span> <?php echo __('You will find the form action URL in the HTML box', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-mailchimp-006.png" class="step-image" />
                            </div><!--esi-optinforms-step-->
                        </div><!--esi-optinforms-explain-mailchimp-->
                    </div><!--esi_optinforms_email_solution_option3-->
                    <div id="esi_optinforms_email_solution_option4" <?php if (get_option('esi_optinforms_email_solution')== 'esi_optinforms_email_solution_option4') echo 'style="display:block;"'; ?>>
                    	<!--<p class="esi-optinforms-integration"></?php echo __('Learn how to integrate GetResponse: watch the short video', 'esi'); ?></p>-->
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label><a onclick="esi_optinforms_explain_getresponse()"><span class="explain">?</span></a></label> <label for="esi_optinforms_form_webformid_getresponse" class="nopointer"><?php echo __('Webform ID', 'esi'); ?> <span class="required">*</span></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form_webformid_getresponse" name="esi_optinforms_form_webformid_getresponse" value="<?php echo esi_optinforms_form_webformid_getresponse(); ?>" />
                            </div><!--optionmiddle-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <script type="text/javascript">
                            function esi_optinforms_explain_getresponse() {
                                // Get the DOM reference
                                var contentId = document.getElementById("esi-optinforms-explain-getresponse");
                                // Toggle 
                                contentId.style.display == "block" ? contentId.style.display = "none" : 
                                contentId.style.display = "block"; 
                            }
                        </script>
                        <div id="esi-optinforms-explain-getresponse" style="display:none;">
                            <div class="esi-optinforms-step">
                            	<h4><?php echo __('How to find your webform ID value', 'esi'); ?></h4>
                                <p><span class="step">1</span> <?php echo __('Log in to your GetResponse account', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-getresponse-001.png" class="step-image" />
                                <p><span class="step">2</span> <?php echo __('Click on Web Forms in the navigation menu and click on Create New', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-getresponse-002.png" class="step-image" />
                                <p><span class="step">3</span> <?php echo __('Click on Next Step at the bottom of the page', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-getresponse-003.png" class="step-image" />
                                <p><span class="step">4</span> <?php echo __('Click on Next Step at the bottom of the page', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-getresponse-003.png" class="step-image" />
                                <p><span class="step">5</span> <?php echo __('Click on the Show HTML Code tab', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-getresponse-005.png" class="step-image" />
                                <p><span class="step">6</span> <?php echo __('Scroll down and find the value of the webform_id field', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-getresponse-006.png" class="step-image" />
                            </div><!--esi-optinforms-step-->
                        </div><!--esi-optinforms-explain-getresponse-->
                    
                    </div><!--esi_optinforms_email_solution_option4-->
                    <div id="esi_optinforms_email_solution_option5" <?php if (get_option('esi_optinforms_email_solution')== 'esi_optinforms_email_solution_option5') echo 'style="display:block;"'; ?>>
                    	<!--<p class="esi-optinforms-integration"></?php echo __('Learn how to integrate Mad Mimi: watch the short video', 'esi'); ?></p>-->
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label><a onclick="esi_optinforms_explain_madmimi()"><span class="explain">?</span></a></label> <label for="esi_optinforms_form_action_madmimi" class="nopointer"><?php echo __('Form action URL', 'esi'); ?> <span class="required">*</span></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form_action_madmimi" name="esi_optinforms_form_action_madmimi" value="<?php echo esi_optinforms_form_action_madmimi(); ?>" />
                            </div><!--optionmiddle-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <script type="text/javascript">
                            function esi_optinforms_explain_madmimi() {
                                // Get the DOM reference
                                var contentId = document.getElementById("esi-optinforms-explain-madmimi");
                                // Toggle 
                                contentId.style.display == "block" ? contentId.style.display = "none" : 
                                contentId.style.display = "block"; 
                            }
                        </script>
                        <div id="esi-optinforms-explain-madmimi" style="display:none;">
                            <div class="esi-optinforms-step">
                            	<h4><?php echo __('How to find your form action URL', 'esi'); ?></h4>
                                <p><span class="step">1</span> <?php echo __('Log in to your Mad Mimi account', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-madmimi-001.png" class="step-image" />
                                <p><span class="step">2</span> <?php echo __('Click on Webform', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-madmimi-002.png" class="step-image" />
                                <p><span class="step">3</span> <?php echo __('Click on the Add a Webform button', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-madmimi-003.png" class="step-image" />
                                <p><span class="step">4</span> <?php echo __('Name your form, assign it to a list and include the Name field', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-madmimi-004.png" class="step-image" />
                                <p><span class="step">5</span> <?php echo __('Click on the Embed button', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-madmimi-005.png" class="step-image" />
                                <p><span class="step">6</span> <?php echo __('Click on the Plain Embed tab', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-madmimi-006.png" class="step-image" />
                                <p><span class="step">7</span> <?php echo __('You will find the form action URL in the HTML box', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-madmimi-007.png" class="step-image" />
                            </div><!--esi-optinforms-step-->
                        </div><!--esi-optinforms-explain-madmimi-->
                    </div><!--esi_optinforms_email_solution_option5-->
                    <div id="esi_optinforms_email_solution_option6" <?php if (get_option('esi_optinforms_email_solution')== 'esi_optinforms_email_solution_option6') echo 'style="display:block;"'; ?>>
                    	<!--<p class="esi-optinforms-integration"></?php echo __('Learn how to integrate Interspire Email Marketer: watch the short video', 'esi'); ?></p>-->
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label><a onclick="esi_optinforms_explain_interspire()"><span class="explain">?</span></a></label> <label for="esi_optinforms_form_action_interspire" class="nopointer"><?php echo __('Form action URL', 'esi'); ?> <span class="required">*</span></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form_action_interspire" name="esi_optinforms_form_action_interspire" value="<?php echo esi_optinforms_form_action_interspire(); ?>" />
                            </div><!--optionmiddle-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <script type="text/javascript">
                            function esi_optinforms_explain_interspire() {
                                // Get the DOM reference
                                var contentId = document.getElementById("esi-optinforms-explain-interspire");
                                // Toggle 


                                contentId.style.display == "block" ? contentId.style.display = "none" : 
                                contentId.style.display = "block"; 
                            }
                        </script>
                        <div id="esi-optinforms-explain-interspire" style="display:none;">
                            <div class="esi-optinforms-step">
                            	<h4><?php echo __('How to find your form action URL', 'esi'); ?></h4>
                                <p><span class="step">1</span> <?php echo __('Log in to your Interspire Email Marketer administration panel', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-interspire-001.png" class="step-image" />
                                <p><span class="step">2</span> <?php echo __('Click on Forms in the navigation menu', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-interspire-002.png" class="step-image" />
                                <p><span class="step">3</span> <?php echo __('Click on Create a Website Form from the submenu options', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-interspire-003.png" class="step-image" />
                                <p><span class="step">4</span> <?php echo __('Make sure to uncheck CAPTCHA form security', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-interspire-004.png" class="step-image" />
                                <p><span class="step">5</span> <?php echo __('Name your form, assign it to a list and include the Name field', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-interspire-005.png" class="step-image" />
                                <p><span class="step">6</span> <?php echo __('Complete all the steps and click on Save', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-interspire-006.png" class="step-image" />
                                <p><span class="step">7</span> <?php echo __('You will find the form action URL in the HTML box', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-interspire-007.png" class="step-image" />
                            </div><!--esi-optinforms-step-->
                        </div><!--esi-optinforms-explain-interspire-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label><a onclick="esi_optinforms_explain_interspire_name()"><span class="explain">?</span></a></label> <label for="esi_optinforms_form_name_field_interspire" class="nopointer"><?php echo __('Name field ID', 'esi'); ?> <span class="required">*</span></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form_name_field_interspire" name="esi_optinforms_form_name_field_interspire" value="<?php echo esi_optinforms_form_name_field_interspire(); ?>" />
                            </div><!--optionmiddle-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <script type="text/javascript">
                            function esi_optinforms_explain_interspire_name() {
                                // Get the DOM reference
                                var contentId = document.getElementById("esi-optinforms-explain-interspire-name");
                                // Toggle 
                                contentId.style.display == "block" ? contentId.style.display = "none" : 
                                contentId.style.display = "block"; 
                            }
                        </script>
                        <div id="esi-optinforms-explain-interspire-name" style="display:none;">
                            <div class="esi-optinforms-step">
                            	<h4><?php echo __('How to find your name field ID', 'esi'); ?></h4>
                                <p><span class="step">1</span> <?php echo __('Log in to your Interspire Email Marketer administration panel', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-interspire-001.png" class="step-image" />
                                <p><span class="step">2</span> <?php echo __('Click on Contact Lists in the navigation menu', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-interspire-008.png" class="step-image" />
                                <p><span class="step">3</span> <?php echo __('Click on View Custom Fields from the submenu options', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-interspire-009.png" class="step-image" />
                                <p><span class="step">4</span> <?php echo __('Find the name field and click on Edit', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-interspire-010.png" class="step-image" />
                                <p><span class="step">5</span> <?php echo __('You will find the name field ID in the address bar', 'esi'); ?></p>
                                <img src="<?php echo plugins_url(); ?>/easy-slide-in/optin-forms-manager/images/support-interspire-011.png" class="step-image" />
                            </div><!--esi-optinforms-step-->
                        </div><!--esi-optinforms-explain-interspire-->
                        
                    </div><!--esi_optinforms_email_solution_option6-->
                </div><!--optiongroup-->
<?php ?>