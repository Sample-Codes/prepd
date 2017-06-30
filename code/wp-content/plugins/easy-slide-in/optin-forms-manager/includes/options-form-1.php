<?php ?>
					
                    <div class="toggle-wrap">
                        <span class="trigger">
                            <a><?php echo __('Style Your Form', 'esi'); ?></a>
                        </span>
                        
                        <div class="toggle-container" style="display: none;">
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_background" class="nopointer"><?php echo __('Form background color', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <input type="text" id="esi_optinforms_form1_background" name="esi_optinforms_form1_background" class="esi-optinforms-color" value="<?php echo esi_optinforms_form1_default_background(); ?>" data-default-color="#FFFFFF" />
                                    <script>
                                        jQuery(document).ready(function($){
                                            $('#esi_optinforms_form1_background').wpColorPicker({
                                                color: true,
                                                hide: true,
                                                palettes: true,
                                                change: function(event, ui) {
                                                    $("#esi-optinforms-form1").css( 'background-color', ui.color.toString());
                                                }
                                            });
                                        }); 
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_border" class="nopointer"><?php echo __('Form border color', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <input type="text" id="esi_optinforms_form1_border" name="esi_optinforms_form1_border" class="esi-optinforms-color" value="<?php echo esi_optinforms_form1_default_border(); ?>" data-default-color="#E0E0E0" />
                                    <script>
                                        jQuery(document).ready(function($){
                                            $('#esi_optinforms_form1_border').wpColorPicker({
                                                color: true,
                                                hide: true,
                                                palettes: true,
                                                change: function(event, ui) {
                                                    $("#esi-optinforms-form1").css( 'border-color', ui.color.toString());
                                                }
                                            });
                                        }); 
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <?php if (get_option('esi_optinforms_form1_hide_title')== '1') echo '<div class="optionsgroup"><p class="hidden-warning">' . __('You\'ve hidden your title in Form Options', 'esi') . '.</p></div>'; ?>
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_title" class="nopointer"><?php echo __('Title', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <input type="text" id="esi_optinforms_form1_title" name="esi_optinforms_form1_title" value="<?php echo esi_optinforms_form1_default_title(); ?>" onchange='esi_optinforms_change_form1_title()' <?php if (get_option('esi_optinforms_form1_hide_title')== '1') echo 'disabled="disabled"'; ?> />
                                    <script type="text/javascript">
                                        function esi_optinforms_change_form1_title() {
                                            document.getElementById('esi-optinforms-form1-title').innerHTML = document.getElementById('esi_optinforms_form1_title').value;
                                        }
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_title_font" class="nopointer"><?php echo __('Title font', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <select name="esi_optinforms_form1_title_font" id="esi_optinforms_form1_title_font" onchange='esi_optinforms_change_form1_title_font()' <?php if (get_option('esi_optinforms_form1_hide_title')== '1') echo 'disabled="disabled"'; ?>>
                                        <?php echo esi_optinforms_get_form1_title_font_options(); ?>
                                    </select>
                                    <script type="text/javascript">
                                        function esi_optinforms_change_form1_title_font() {
                                            document.getElementById("esi-optinforms-form1-title").style.fontFamily = document.getElementById('esi_optinforms_form1_title_font').value;
                                        }
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_title_size" class="nopointer"><?php echo __('Title size', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <select name="esi_optinforms_form1_title_size" id="esi_optinforms_form1_title_size" onchange='esi_optinforms_change_form1_title_size()' <?php if (get_option('esi_optinforms_form1_hide_title')== '1') echo 'disabled="disabled"'; ?>>
                                        <?php echo esi_optinforms_get_form1_title_size_options(); ?>
                                    </select>
                                    <script type="text/javascript">
                                        function esi_optinforms_change_form1_title_size() {
                                            document.getElementById("esi-optinforms-form1-title").style.fontSize = document.getElementById('esi_optinforms_form1_title_size').value;
                                            document.getElementById("esi-optinforms-form1-title").style.lineHeight = document.getElementById('esi_optinforms_form1_title_size').value;
                                        }
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_title_color" class="nopointer"><?php echo __('Title color', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <input type="text" id="esi_optinforms_form1_title_color" name="esi_optinforms_form1_title_color" class="esi-optinforms-color" value="<?php echo esi_optinforms_form1_default_title_color(); ?>" data-default-color="#eb432c" <?php if (get_option('esi_optinforms_form1_hide_title')== '1') echo 'disabled'; ?> />
                                    <script>
                                        jQuery(document).ready(function($){
                                            $('#esi_optinforms_form1_title_color').wpColorPicker({
                                                color: true,
                                                hide: true,
                                                palettes: true,
                                                change: function(event, ui) {
                                                    $("#esi-optinforms-form1-title").css( 'color', ui.color.toString());
                                                }
                                            });
                                        }); 
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <?php if (get_option('esi_optinforms_form1_hide_subtitle')== '1') echo '<div class="optionsgroup"><p class="hidden-warning">' . __('You\'ve hidden your subtitle in Form Options', 'esi') . '.</p></div>'; ?>
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_subtitle" class="nopointer"><?php echo __('Subtitle', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <input type="text" id="esi_optinforms_form1_subtitle" name="esi_optinforms_form1_subtitle" value="<?php echo esi_optinforms_form1_default_subtitle(); ?>" onchange='esi_optinforms_change_form1_subtitle()' <?php if (get_option('esi_optinforms_form1_hide_subtitle')== '1') echo 'disabled="disabled"'; ?> />
                                    <script type="text/javascript">
                                        function esi_optinforms_change_form1_subtitle() {
                                            document.getElementById('esi-optinforms-form1-subtitle').innerHTML = document.getElementById('esi_optinforms_form1_subtitle').value;
                                        }
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_subtitle_font" class="nopointer"><?php echo __('Subtitle font', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <select name="esi_optinforms_form1_subtitle_font" id="esi_optinforms_form1_subtitle_font" onchange='esi_optinforms_change_form1_subtitle_font()' <?php if (get_option('esi_optinforms_form1_hide_subtitle')== '1') echo 'disabled="disabled"'; ?>>
                                        <?php echo esi_optinforms_get_form1_subtitle_font_options(); ?>
                                    </select>
                                    <script type="text/javascript">
                                        function esi_optinforms_change_form1_subtitle_font() {
                                            document.getElementById("esi-optinforms-form1-subtitle").style.fontFamily = document.getElementById('esi_optinforms_form1_subtitle_font').value;
                                        }
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_subtitle_size" class="nopointer"><?php echo __('Subtitle size', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <select name="esi_optinforms_form1_subtitle_size" id="esi_optinforms_form1_subtitle_size" onchange='esi_optinforms_change_form1_subtitle_size()' <?php if (get_option('esi_optinforms_form1_hide_subtitle')== '1') echo 'disabled="disabled"'; ?>>
                                        <?php echo esi_optinforms_get_form1_subtitle_size_options(); ?>
                                    </select>
                                    <script type="text/javascript">
                                        function esi_optinforms_change_form1_subtitle_size() {
                                            document.getElementById("esi-optinforms-form1-subtitle").style.fontSize = document.getElementById('esi_optinforms_form1_subtitle_size').value;
                                            document.getElementById("esi-optinforms-form1-subtitle").style.lineHeight = document.getElementById('esi_optinforms_form1_subtitle_size').value;
                                        }
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_subtitle_color" class="nopointer"><?php echo __('Subtitle color', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <input type="text" id="esi_optinforms_form1_subtitle_color" name="esi_optinforms_form1_subtitle_color" class="esi-optinforms-color" value="<?php echo esi_optinforms_form1_default_subtitle_color(); ?>" data-default-color="#000000" <?php if (get_option('esi_optinforms_form1_hide_subtitle')== '1') echo 'disabled'; ?> />
                                    <script>
                                        jQuery(document).ready(function($){
                                            $('#esi_optinforms_form1_subtitle_color').wpColorPicker({
                                                color: true,
                                                hide: true,
                                                palettes: true,
                                                change: function(event, ui) {
                                                    $("#esi-optinforms-form1-subtitle").css( 'color', ui.color.toString());
                                                }
                                            });
                                        }); 
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <?php if (get_option('esi_optinforms_form1_hide_name_field')== '1') echo '<div class="optionsgroup"><p class="hidden-warning">' . __('You\'ve hidden your name field in Form Options', 'esi') . '.</p></div>'; ?>
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_name_field" class="nopointer"><?php echo __('Input field: name', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <input type="text" id="esi_optinforms_form1_name_field" name="esi_optinforms_form1_name_field" value="<?php echo esi_optinforms_form1_default_name_field(); ?>" onchange='esi_optinforms_change_form1_name_field()' <?php if (get_option('esi_optinforms_form1_hide_name_field')== '1') echo 'disabled'; ?> />
                                    <script type="text/javascript">
                                        function esi_optinforms_change_form1_name_field() {
                                            document.getElementById('esi-optinforms-form1-name-field').value = document.getElementById('esi_optinforms_form1_name_field').value;
                                        }
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_email_field" class="nopointer"><?php echo __('Input field: email', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <input type="text" id="esi_optinforms_form1_email_field" name="esi_optinforms_form1_email_field" value="<?php echo esi_optinforms_form1_default_email_field(); ?>" onchange='esi_optinforms_change_form1_email_field()' />
                                    <script type="text/javascript">
                                        function esi_optinforms_change_form1_email_field() {
                                            document.getElementById('esi-optinforms-form1-email-field').value = document.getElementById('esi_optinforms_form1_email_field').value;
                                        }
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_fields_font" class="nopointer"><?php echo __('Input fields font', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <select name="esi_optinforms_form1_fields_font" id="esi_optinforms_form1_fields_font" onchange='esi_optinforms_change_form1_fields_font()'>
                                        <?php echo esi_optinforms_get_form1_fields_font_options(); ?>
                                    </select>
                                    <script type="text/javascript">
                                        function esi_optinforms_change_form1_fields_font() {
                                            document.getElementById("esi-optinforms-form1-name-field").style.fontFamily = document.getElementById('esi_optinforms_form1_fields_font').value;
                                            document.getElementById("esi-optinforms-form1-email-field").style.fontFamily = document.getElementById('esi_optinforms_form1_fields_font').value;
                                        }
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_fields_size" class="nopointer"><?php echo __('Input fields size', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <select name="esi_optinforms_form1_fields_size" id="esi_optinforms_form1_fields_size" onchange='esi_optinforms_change_form1_fields_size()'>
                                        <?php echo esi_optinforms_get_form1_fields_size_options(); ?>
                                    </select>
                                    <script type="text/javascript">
                                        function esi_optinforms_change_form1_fields_size() {
                                            document.getElementById("esi-optinforms-form1-name-field").style.fontSize = document.getElementById('esi_optinforms_form1_fields_size').value;
                                            document.getElementById("esi-optinforms-form1-email-field").style.fontSize = document.getElementById('esi_optinforms_form1_fields_size').value;
                                        }
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_fields_color" class="nopointer"><?php echo __('Input fields color', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <input type="text" id="esi_optinforms_form1_fields_color" name="esi_optinforms_form1_fields_color" class="esi-optinforms-color" value="<?php echo esi_optinforms_form1_default_fields_color(); ?>" data-default-color="#666666" />
                                    <script>
                                        jQuery(document).ready(function($){
                                            $('#esi_optinforms_form1_fields_color').wpColorPicker({
                                                color: true,
                                                hide: true,
                                                palettes: true,
                                                change: function(event, ui) {
                                                    $("#esi-optinforms-form1-name-field").css( 'color', ui.color.toString());
                                                    $("#esi-optinforms-form1-email-field").css( 'color', ui.color.toString());
                                                }
                                            });
                                        }); 
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_button_text" class="nopointer"><?php echo __('Button text', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <input type="text" id="esi_optinforms_form1_button_text" name="esi_optinforms_form1_button_text" value="<?php echo esi_optinforms_form1_default_button_text(); ?>" onchange='esi_optinforms_change_form1_button_text()' />
                                    <script type="text/javascript">
                                        function esi_optinforms_change_form1_button_text() {
                                            document.getElementById('esi-optinforms-form1-button').value = document.getElementById('esi_optinforms_form1_button_text').value;
                                        }
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_button_text_font" class="nopointer"><?php echo __('Button text font', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <select name="esi_optinforms_form1_button_text_font" id="esi_optinforms_form1_button_text_font" onchange='esi_optinforms_change_form1_button_text_font()'>
                                        <?php echo esi_optinforms_get_form1_button_text_font_options(); ?>
                                    </select>
                                    <script type="text/javascript">
                                        function esi_optinforms_change_form1_button_text_font() {
                                            document.getElementById("esi-optinforms-form1-button").style.fontFamily = document.getElementById('esi_optinforms_form1_button_text_font').value;
                                        }
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_button_text_size" class="nopointer"><?php echo __('Button text size', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <select name="esi_optinforms_form1_button_text_size" id="esi_optinforms_form1_button_text_size" onchange='esi_optinforms_change_form1_button_text_size()'>
                                        <?php echo esi_optinforms_get_form1_button_text_size_options(); ?>
                                    </select>
                                    <script type="text/javascript">
                                        function esi_optinforms_change_form1_button_text_size() {
                                            document.getElementById("esi-optinforms-form1-button").style.fontSize = document.getElementById('esi_optinforms_form1_button_text_size').value;
                                        }
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_button_text_color" class="nopointer"><?php echo __('Button text color', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <input type="text" id="esi_optinforms_form1_button_text_color" name="esi_optinforms_form1_button_text_color" class="esi-optinforms-color" value="<?php echo esi_optinforms_form1_default_button_text_color(); ?>" data-default-color="#FFFFFF" />
                                    <script>
                                        jQuery(document).ready(function($){
                                            $('#esi_optinforms_form1_button_text_color').wpColorPicker({
                                                color: true,
                                                hide: true,
                                                palettes: true,
                                                change: function(event, ui) {
                                                    $("#esi-optinforms-form1-button").css( 'color', ui.color.toString());
                                                }
                                            });
                                        }); 
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_button_background" class="nopointer"><?php echo __('Button background color', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <input type="text" id="esi_optinforms_form1_button_background" name="esi_optinforms_form1_button_background" class="esi-optinforms-color" value="<?php echo esi_optinforms_form1_default_button_background(); ?>" data-default-color="#20A64C" />
                                    <script>
                                        jQuery(document).ready(function($){
                                            $('#esi_optinforms_form1_button_background').wpColorPicker({
                                                color: true,
                                                hide: true,
                                                palettes: true,
                                                change: function(event, ui) {
                                                    $("#esi-optinforms-form1-button").css( 'background-color', ui.color.toString());
                                                }
                                            });
                                        }); 
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <?php if (get_option('esi_optinforms_form1_hide_disclaimer')== '1') echo '<div class="optionsgroup"><p class="hidden-warning">' . __('You\'ve hidden your disclaimer in Form Options', 'esi') . '.</p></div>'; ?>
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_disclaimer" class="nopointer"><?php echo __('Disclaimer text', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <input type="text" id="esi_optinforms_form1_disclaimer" name="esi_optinforms_form1_disclaimer" value="<?php echo esi_optinforms_form1_default_disclaimer(); ?>" onchange='esi_optinforms_change_form1_disclaimer()' <?php if (get_option('esi_optinforms_form1_hide_disclaimer')== '1') echo 'disabled="disabled"'; ?> />
                                    <script type="text/javascript">
                                        function esi_optinforms_change_form1_disclaimer() {
                                            document.getElementById('esi-optinforms-form1-disclaimer').innerHTML = document.getElementById('esi_optinforms_form1_disclaimer').value;
                                        }
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_disclaimer_font" class="nopointer"><?php echo __('Disclaimer font', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <select name="esi_optinforms_form1_disclaimer_font" id="esi_optinforms_form1_disclaimer_font" onchange='esi_optinforms_change_form1_disclaimer_font()' <?php if (get_option('esi_optinforms_form1_hide_disclaimer')== '1') echo 'disabled="disabled"'; ?>>
                                        <?php echo esi_optinforms_get_form1_disclaimer_font_options(); ?>
                                    </select>
                                    <script type="text/javascript">
                                        function esi_optinforms_change_form1_disclaimer_font() {
                                            document.getElementById("esi-optinforms-form1-disclaimer").style.fontFamily = document.getElementById('esi_optinforms_form1_disclaimer_font').value;
                                        }
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_disclaimer_size" class="nopointer"><?php echo __('Disclaimer size', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <select name="esi_optinforms_form1_disclaimer_size" id="esi_optinforms_form1_disclaimer_size" onchange='esi_optinforms_change_form1_disclaimer_size()' <?php if (get_option('esi_optinforms_form1_hide_disclaimer')== '1') echo 'disabled="disabled"'; ?>>
                                        <?php echo esi_optinforms_get_form1_disclaimer_size_options(); ?>
                                    </select>
                                    <script type="text/javascript">
                                        function esi_optinforms_change_form1_disclaimer_size() {
                                            document.getElementById("esi-optinforms-form1-disclaimer").style.fontSize = document.getElementById('esi_optinforms_form1_disclaimer_size').value;
                                        }
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_disclaimer_color" class="nopointer"><?php echo __('Disclaimer color', 'esi'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <input type="text" id="esi_optinforms_form1_disclaimer_color" name="esi_optinforms_form1_disclaimer_color" class="esi-optinforms-color" value="<?php echo esi_optinforms_form1_default_disclaimer_color(); ?>" data-default-color="#666666" <?php if (get_option('esi_optinforms_form1_hide_disclaimer')== '1') echo 'disabled'; ?> />
                                    <script>
                                        jQuery(document).ready(function($){
                                            $('#esi_optinforms_form1_disclaimer_color').wpColorPicker({
                                                color: true,
                                                hide: true,
                                                palettes: true,
                                                change: function(event, ui) {
                                                    $("#esi-optinforms-form1-disclaimer").css( 'color', ui.color.toString());
                                                }
                                            });
                                        }); 
                                    </script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_width" class="nopointer"><?php echo __('Form width', 'esi'); ?></label> <label><a onclick="esi_optinforms_explain_width_1()"><span class="explain">?</span></a></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <div class="choose-width">
                                        <input name="esi_optinforms_form1_width" id="esi_optinforms_form1_width_100" type="radio" value="0" class="radiobutton" <?php echo esi_optinforms_form1_checked_width_100(); ?> onclick="document.getElementById('esi_optinforms_form1_width_pixels').disabled=true;" /> <label for="esi_optinforms_form1_width_100" class="radiobutton-label">100%</label>
                                    </div><!--choose-width-->
                                    <div class="choose-width">
                                        <input name="esi_optinforms_form1_width" id="esi_optinforms_form1_width_fixed" type="radio" value="1" class="radiobutton" <?php echo esi_optinforms_form1_checked_width_fixed(); ?> onclick="document.getElementById('esi_optinforms_form1_width_pixels').disabled=false;" /> <label for="esi_optinforms_form1_width_fixed" class="radiobutton-label">Fixed:</label>
                                    </div><!--choose-width-->
                                    <input type="text" id="esi_optinforms_form1_width_pixels" name="esi_optinforms_form1_width_pixels" value="<?php echo esi_optinforms_form1_default_width_pixels(); ?>" class="fixed-width" <?php echo esi_optinforms_form1_disabled_width_pixels(); ?> /> <p class="fixed-width-px">px</p>
                                    <div class="clear"></div>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                                
                            </div><!--optiongroup-->
                            
                            <script type="text/javascript">
                                function esi_optinforms_explain_width_1() {
                                    // Get the DOM reference
                                    var contentId = document.getElementById("esi-optinforms-explain-width-1");
                                    // Toggle 
                                    contentId.style.display == "block" ? contentId.style.display = "none" : 
                                    contentId.style.display = "block"; 
                                }
                            </script>
                            <div id="esi-optinforms-explain-width-1" style="display:none;">
                                <div class="esi-optinforms-help">
                                    <p><?php echo __('In most cases, you can leave the form width at 100%. This will ensure your form will align perfectly with any WordPress theme and act responsive when scaled on different devices. Please note that the form preview displayed in your WordPress administration panel will not be affected by changing this value.', 'esi'); ?></p>
                                </div><!--esi-optinforms-help-->
                            </div><!--esi-optinforms-explain-width-1-->
                        
                        </div><!--toggle-container-->
                        <div class="clear"></div>
                    </div><!--toggle-wrap-->
                    
                    <div class="toggle-wrap">
                    	<span class="trigger">
                            <a><?php echo __('Form Options', 'esi'); ?></a>
                        </span>
                        
                        <div class="toggle-container" style="display: none;">
                        
                        	<div class="optiongroup">
                                <div class="optionleft">
                                    
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                	<input type="checkbox" name="esi_optinforms_form1_hide_title" value="1" id="esi_optinforms_form1_hide_title" <?php if (get_option('esi_optinforms_form1_hide_title')== '1') echo 'checked="checked"'; ?> onclick="esi_optinforms_form1_title_visibility(this.checked);" /> <label for="esi_optinforms_form1_hide_title" class="nopointer"><?php echo __('Hide the title', 'esi'); ?></label>
                                    <script type="text/javascript">
										function esi_optinforms_form1_title_visibility(optinchecked) {
											if(optinchecked) {
												document.getElementById("esi-optinforms-form1-title").style.display = "none";
											}
											else {
												document.getElementById("esi-optinforms-form1-title").style.display = "";
											}
										}
									</script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                	<input type="checkbox" name="esi_optinforms_form1_hide_subtitle" value="1" id="esi_optinforms_form1_hide_subtitle" <?php if (get_option('esi_optinforms_form1_hide_subtitle')== '1') echo 'checked="checked"'; ?> onclick="esi_optinforms_form1_subtitle_visibility(this.checked);" /> <label for="esi_optinforms_form1_hide_subtitle" class="nopointer"><?php echo __('Hide the subtitle', 'esi'); ?></label>
                                    <script type="text/javascript">
										function esi_optinforms_form1_subtitle_visibility(optinchecked) {
											if(optinchecked) {
												document.getElementById("esi-optinforms-form1-subtitle").style.display = "none";
											}
											else {
												document.getElementById("esi-optinforms-form1-subtitle").style.display = "";
											}
										}
									</script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                	<input type="checkbox" name="esi_optinforms_form1_hide_name_field" value="1" id="esi_optinforms_form1_hide_name_field" <?php if (get_option('esi_optinforms_form1_hide_name_field')== '1') echo 'checked="checked"'; ?> onclick="esi_optinforms_form1_name_field_visibility(this.checked);" /> <label for="esi_optinforms_form1_hide_name_field" class="nopointer"><?php echo __('Hide the name field', 'esi'); ?></label>
                                    <script type="text/javascript">
										function esi_optinforms_form1_name_field_visibility(optinchecked) {
											if(optinchecked) {
												document.getElementById("esi-optinforms-form1-name-field-container").style.display = "none";
												document.getElementById("esi-optinforms-form1-email-field-container").style.width = "78%";
											}
											else {
												document.getElementById("esi-optinforms-form1-name-field-container").style.display = "";
												document.getElementById("esi-optinforms-form1-email-field-container").style.width = "38%";
											}
										}
									</script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <div class="optiongroup">
                                <div class="optionleft">
                                    
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                	<input type="checkbox" name="esi_optinforms_form1_hide_disclaimer" value="1" id="esi_optinforms_form1_hide_disclaimer" <?php if (get_option('esi_optinforms_form1_hide_disclaimer')== '1') echo 'checked="checked"'; ?> onclick="esi_optinforms_form1_disclaimer_visibility(this.checked);" /> <label for="esi_optinforms_form1_hide_disclaimer" class="nopointer"><?php echo __('Hide the disclaimer', 'esi'); ?></label>
                                    <script type="text/javascript">
										function esi_optinforms_form1_disclaimer_visibility(optinchecked) {
											if(optinchecked) {
												document.getElementById("esi-optinforms-form1-disclaimer").style.display = "none";
											}
											else {
												document.getElementById("esi-optinforms-form1-disclaimer").style.display = "";
											}
										}
									</script>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                        
                        	<div class="optiongroup">
                                <div class="optionleft">
                                    <label for="esi_optinforms_form1_css" class="nopointer"><?php echo __('Custom CSS', 'esi'); ?></label> <label><a onclick="esi_optinforms_explain_css_1()"><span class="explain">?</span></a></label> 
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                	<textarea id="esi_optinforms_form1_css" name="esi_optinforms_form1_css"><?php echo esi_optinforms_form1_css(); ?></textarea>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <script type="text/javascript">
								function esi_optinforms_explain_css_1() {
									// Get the DOM reference
									var contentId = document.getElementById("esi-optinforms-explain-css-1");
									// Toggle 
									contentId.style.display == "block" ? contentId.style.display = "none" : 
									contentId.style.display = "block"; 
								}
							</script>
							<div id="esi-optinforms-explain-css-1" style="display:none;">
								<div class="esi-optinforms-help">
									<p><?php echo __('Override the plugin\'s CSS values by entering your own custom CSS.', 'esi'); ?></p>
								</div><!--esi-optinforms-help-->
							</div><!--esi-optinforms-explain-css-1-->
                            
                        </div><!--toggle-container-->
                        <div class="clear"></div>
                    </div><!--toggle-wrap-->

<?php ?>