<?php ?>

					<span class="trigger">
                    	<a><?php echo __('Style Your Form', 'esi'); ?></a>
                    </span>
					
                    <div class="toggle-container" style="display: none;">
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form4_background" class="nopointer"><?php echo __('Form background color', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form4_background" name="esi_optinforms_form4_background" class="esi-optinforms-color" value="<?php echo esi_optinforms_form4_default_background(); ?>" data-default-color="#FCFCFC" />
                                <script>
                                    jQuery(document).ready(function($){
                                        $('#esi_optinforms_form4_background').wpColorPicker({
                                            color: true,
                                            hide: true,
                                            palettes: true,
                                            change: function(event, ui) {
                                                $("#esi-optinforms-form4").css( 'background-color', ui.color.toString());
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
                                <label for="esi_optinforms_form4_border" class="nopointer"><?php echo __('Form border color', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form4_border" name="esi_optinforms_form4_border" class="esi-optinforms-color" value="<?php echo esi_optinforms_form4_default_border(); ?>" data-default-color="#ECEAED" />
                                <script>
                                    jQuery(document).ready(function($){
                                        $('#esi_optinforms_form4_border').wpColorPicker({
                                            color: true,
                                            hide: true,
                                            palettes: true,
                                            change: function(event, ui) {
                                                $("#esi-optinforms-form4").css( 'border-color', ui.color.toString());
                                            }
                                        });
                                    }); 
                                </script>
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                
                            </div><!--optionlast-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <?php if (get_option('esi_optinforms_form4_hide_title')== '1') echo '<div class="optionsgroup"><p class="hidden-warning">' . __('You\'ve hidden your title in Form Options', 'esi') . '.</p></div>'; ?>
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form4_title" class="nopointer"><?php echo __('Title', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form4_title" name="esi_optinforms_form4_title" value="<?php echo esi_optinforms_form4_default_title(); ?>" onchange='esi_optinforms_change_form4_title()' <?php if (get_option('esi_optinforms_form4_hide_title')== '1') echo 'disabled="disabled"'; ?> />
                                <script type="text/javascript">
                                    function esi_optinforms_change_form4_title() {
                                        document.getElementById('esi-optinforms-form4-title').innerHTML = document.getElementById('esi_optinforms_form4_title').value;
                                    }
                                </script>
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                
                            </div><!--optionlast-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form4_title_font" class="nopointer"><?php echo __('Title font', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <select name="esi_optinforms_form4_title_font" id="esi_optinforms_form4_title_font" onchange='esi_optinforms_change_form4_title_font()' <?php if (get_option('esi_optinforms_form4_hide_title')== '1') echo 'disabled="disabled"'; ?>>
                                    <?php echo esi_optinforms_get_form4_title_font_options(); ?>
                                </select>
                                <script type="text/javascript">
                                    function esi_optinforms_change_form4_title_font() {
                                        document.getElementById("esi-optinforms-form4-title").style.fontFamily = document.getElementById('esi_optinforms_form4_title_font').value;
                                    }
                                </script>
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                
                            </div><!--optionlast-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form4_title_size" class="nopointer"><?php echo __('Title size', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <select name="esi_optinforms_form4_title_size" id="esi_optinforms_form4_title_size" onchange='esi_optinforms_change_form4_title_size()' <?php if (get_option('esi_optinforms_form4_hide_title')== '1') echo 'disabled="disabled"'; ?>>
                                    <?php echo esi_optinforms_get_form4_title_size_options(); ?>
                                </select>
                                <script type="text/javascript">
                                    function esi_optinforms_change_form4_title_size() {
                                        document.getElementById("esi-optinforms-form4-title").style.fontSize = document.getElementById('esi_optinforms_form4_title_size').value;
                                        document.getElementById("esi-optinforms-form4-title").style.lineHeight = document.getElementById('esi_optinforms_form4_title_size').value;
                                    }
                                </script>
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                
                            </div><!--optionlast-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form4_title_color" class="nopointer"><?php echo __('Title color', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form4_title_color" name="esi_optinforms_form4_title_color" class="esi-optinforms-color" value="<?php echo esi_optinforms_form4_default_title_color(); ?>" data-default-color="#505050" <?php if (get_option('esi_optinforms_form4_hide_title')== '1') echo 'disabled="disabled"'; ?> />
                                <script>
                                    jQuery(document).ready(function($){
                                        $('#esi_optinforms_form4_title_color').wpColorPicker({
                                            color: true,
                                            hide: true,
                                            palettes: true,
                                            change: function(event, ui) {
                                                $("#esi-optinforms-form4-title").css( 'color', ui.color.toString());
                                            }
                                        });
                                    }); 
                                </script>
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                
                            </div><!--optionlast-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <?php if (get_option('esi_optinforms_form4_hide_subtitle')== '1') echo '<div class="optionsgroup"><p class="hidden-warning">' . __('You\'ve hidden your subtitle in Form Options', 'esi') . '.</p></div>'; ?>
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form4_subtitle" class="nopointer"><?php echo __('Subtitle', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form4_subtitle" name="esi_optinforms_form4_subtitle" value="<?php echo esi_optinforms_form4_default_subtitle(); ?>" onchange='esi_optinforms_change_form4_subtitle()' <?php if (get_option('esi_optinforms_form4_hide_subtitle')== '1') echo 'disabled="disabled"'; ?> />
                                <script type="text/javascript">
                                    function esi_optinforms_change_form4_subtitle() {
                                        document.getElementById('esi-optinforms-form4-subtitle').innerHTML = document.getElementById('esi_optinforms_form4_subtitle').value;
                                    }
                                </script>
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                
                            </div><!--optionlast-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form4_subtitle_font" class="nopointer"><?php echo __('Subtitle font', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <select name="esi_optinforms_form4_subtitle_font" id="esi_optinforms_form4_subtitle_font" onchange='esi_optinforms_change_form4_subtitle_font()' <?php if (get_option('esi_optinforms_form4_hide_subtitle')== '1') echo 'disabled="disabled"'; ?>>
                                    <?php echo esi_optinforms_get_form4_subtitle_font_options(); ?>
                                </select>
                                <script type="text/javascript">
                                    function esi_optinforms_change_form4_subtitle_font() {
                                        document.getElementById("esi-optinforms-form4-subtitle").style.fontFamily = document.getElementById('esi_optinforms_form4_subtitle_font').value;
                                    }
                                </script>
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                
                            </div><!--optionlast-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form4_subtitle_size" class="nopointer"><?php echo __('Subtitle size', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <select name="esi_optinforms_form4_subtitle_size" id="esi_optinforms_form4_subtitle_size" onchange='esi_optinforms_change_form4_subtitle_size()' <?php if (get_option('esi_optinforms_form4_hide_subtitle')== '1') echo 'disabled="disabled"'; ?>>
                                    <?php echo esi_optinforms_get_form4_subtitle_size_options(); ?>
                                </select>
                                <script type="text/javascript">
                                    function esi_optinforms_change_form4_subtitle_size() {
                                        document.getElementById("esi-optinforms-form4-subtitle").style.fontSize = document.getElementById('esi_optinforms_form4_subtitle_size').value;
                                        document.getElementById("esi-optinforms-form4-subtitle").style.lineHeight = document.getElementById('esi_optinforms_form4_subtitle_size').value;
                                    }
                                </script>
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                
                            </div><!--optionlast-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form4_subtitle_color" class="nopointer"><?php echo __('Subtitle color', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form4_subtitle_color" name="esi_optinforms_form4_subtitle_color" class="esi-optinforms-color" value="<?php echo esi_optinforms_form4_default_subtitle_color(); ?>" data-default-color="#505050" <?php if (get_option('esi_optinforms_form4_hide_subtitle')== '1') echo 'disabled="disabled"'; ?> />
                                <script>
                                    jQuery(document).ready(function($){
                                        $('#esi_optinforms_form4_subtitle_color').wpColorPicker({
                                            color: true,
                                            hide: true,
                                            palettes: true,
                                            change: function(event, ui) {
                                                $("#esi-optinforms-form4-subtitle").css( 'color', ui.color.toString());
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
                                <label for="esi_optinforms_form4_email_field" class="nopointer"><?php echo __('Email field', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form4_email_field" name="esi_optinforms_form4_email_field" value="<?php echo esi_optinforms_form4_default_email_field(); ?>" onchange='esi_optinforms_change_form4_email_field()' />
                                <script type="text/javascript">
                                    function esi_optinforms_change_form4_email_field() {
                                        document.getElementById('esi-optinforms-form4-email-field').value = document.getElementById('esi_optinforms_form4_email_field').value;
                                    }
                                </script>
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                
                            </div><!--optionlast-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form4_fields_font" class="nopointer"><?php echo __('Email field font', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <select name="esi_optinforms_form4_fields_font" id="esi_optinforms_form4_fields_font" onchange='esi_optinforms_change_form4_fields_font()'>
                                    <?php echo esi_optinforms_get_form4_fields_font_options(); ?>
                                </select>
                                <script type="text/javascript">
                                    function esi_optinforms_change_form4_fields_font() {
                                        document.getElementById("esi-optinforms-form4-email-field").style.fontFamily = document.getElementById('esi_optinforms_form4_fields_font').value;
                                    }
                                </script>
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                
                            </div><!--optionlast-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form4_fields_size" class="nopointer"><?php echo __('Email field size', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <select name="esi_optinforms_form4_fields_size" id="esi_optinforms_form4_fields_size" onchange='esi_optinforms_change_form4_fields_size()'>
                                    <?php echo esi_optinforms_get_form4_fields_size_options(); ?>
                                </select>
                                <script type="text/javascript">
                                    function esi_optinforms_change_form4_fields_size() {
                                        document.getElementById("esi-optinforms-form4-email-field").style.fontSize = document.getElementById('esi_optinforms_form4_fields_size').value;
                                    }
                                </script>
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                
                            </div><!--optionlast-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form4_fields_color" class="nopointer"><?php echo __('Email field color', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form4_fields_color" name="esi_optinforms_form4_fields_color" class="esi-optinforms-color" value="<?php echo esi_optinforms_form4_default_fields_color(); ?>" data-default-color="#666666" />
                                <script>
                                    jQuery(document).ready(function($){
                                        $('#esi_optinforms_form4_fields_color').wpColorPicker({
                                            color: true,
                                            hide: true,
                                            palettes: true,
                                            change: function(event, ui) {
                                                $("#esi-optinforms-form4-email-field").css( 'color', ui.color.toString());
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
                                <label for="esi_optinforms_form4_button_text" class="nopointer"><?php echo __('Button text', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form4_button_text" name="esi_optinforms_form4_button_text" value="<?php echo esi_optinforms_form4_default_button_text(); ?>" onchange='esi_optinforms_change_form4_button_text()' />
                                <script type="text/javascript">
                                    function esi_optinforms_change_form4_button_text() {
                                        document.getElementById('esi-optinforms-form4-button').value = document.getElementById('esi_optinforms_form4_button_text').value;
                                    }
                                </script>
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                
                            </div><!--optionlast-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form4_button_text_font" class="nopointer"><?php echo __('Button text font', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <select name="esi_optinforms_form4_button_text_font" id="esi_optinforms_form4_button_text_font" onchange='esi_optinforms_change_form4_button_text_font()'>
                                    <?php echo esi_optinforms_get_form4_button_text_font_options(); ?>
                                </select>
                                <script type="text/javascript">
                                    function esi_optinforms_change_form4_button_text_font() {
                                        document.getElementById("esi-optinforms-form4-button").style.fontFamily = document.getElementById('esi_optinforms_form4_button_text_font').value;
                                    }
                                </script>
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                
                            </div><!--optionlast-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form4_button_text_size" class="nopointer"><?php echo __('Button text size', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <select name="esi_optinforms_form4_button_text_size" id="esi_optinforms_form4_button_text_size" onchange='esi_optinforms_change_form4_button_text_size()'>
                                    <?php echo esi_optinforms_get_form4_button_text_size_options(); ?>
                                </select>
                                <script type="text/javascript">
                                    function esi_optinforms_change_form4_button_text_size() {
                                        document.getElementById("esi-optinforms-form4-button").style.fontSize = document.getElementById('esi_optinforms_form4_button_text_size').value;
                                    }
                                </script>
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                
                            </div><!--optionlast-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form4_button_text_color" class="nopointer"><?php echo __('Button text color', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form4_button_text_color" name="esi_optinforms_form4_button_text_color" class="esi-optinforms-color" value="<?php echo esi_optinforms_form4_default_button_text_color(); ?>" data-default-color="#1d629b" />
                                <script>
                                    jQuery(document).ready(function($){
                                        $('#esi_optinforms_form4_button_text_color').wpColorPicker({
                                            color: true,
                                            hide: true,
                                            palettes: true,
                                            change: function(event, ui) {
                                                $("#esi-optinforms-form4-button").css( 'color', ui.color.toString());
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
                                <label for="esi_optinforms_form4_button_background" class="nopointer"><?php echo __('Button background color', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form4_button_background" name="esi_optinforms_form4_button_background" class="esi-optinforms-color" value="<?php echo esi_optinforms_form4_default_button_background(); ?>" data-default-color="#faff5b" />
                                <script>
                                    jQuery(document).ready(function($){
                                        $('#esi_optinforms_form4_button_background').wpColorPicker({
                                            color: true,
                                            hide: true,
                                            palettes: true,
                                            change: function(event, ui) {
                                                $("#esi-optinforms-form4-button").css( 'background-color', ui.color.toString());
                                            }
                                        });
                                    }); 
                                </script>
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                
                            </div><!--optionlast-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <?php if (get_option('esi_optinforms_form4_hide_disclaimer')== '1') echo '<div class="optionsgroup"><p class="hidden-warning">' . __('You\'ve hidden your disclaimer in Form Options', 'esi') . '.</p></div>'; ?>
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form4_disclaimer" class="nopointer"><?php echo __('Disclaimer text', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form4_disclaimer" name="esi_optinforms_form4_disclaimer" value="<?php echo esi_optinforms_form4_default_disclaimer(); ?>" onchange='esi_optinforms_change_form4_disclaimer()' <?php if (get_option('esi_optinforms_form4_hide_disclaimer')== '1') echo 'disabled="disabled"'; ?> />
                                <script type="text/javascript">
                                    function esi_optinforms_change_form4_disclaimer() {
                                        document.getElementById('esi-optinforms-form4-disclaimer').innerHTML = document.getElementById('esi_optinforms_form4_disclaimer').value;
                                    }
                                </script>
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                
                            </div><!--optionlast-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form4_disclaimer_font" class="nopointer"><?php echo __('Disclaimer font', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <select name="esi_optinforms_form4_disclaimer_font" id="esi_optinforms_form4_disclaimer_font" onchange='esi_optinforms_change_form4_disclaimer_font()' <?php if (get_option('esi_optinforms_form4_hide_disclaimer')== '1') echo 'disabled="disabled"'; ?>>
                                    <?php echo esi_optinforms_get_form4_disclaimer_font_options(); ?>
                                </select>
                                <script type="text/javascript">
                                    function esi_optinforms_change_form4_disclaimer_font() {
                                        document.getElementById("esi-optinforms-form4-disclaimer").style.fontFamily = document.getElementById('esi_optinforms_form4_disclaimer_font').value;
                                    }
                                </script>
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                
                            </div><!--optionlast-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form4_disclaimer_size" class="nopointer"><?php echo __('Disclaimer size', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <select name="esi_optinforms_form4_disclaimer_size" id="esi_optinforms_form4_disclaimer_size" onchange='esi_optinforms_change_form4_disclaimer_size()' <?php if (get_option('esi_optinforms_form4_hide_disclaimer')== '1') echo 'disabled="disabled"'; ?>>
                                    <?php echo esi_optinforms_get_form4_disclaimer_size_options(); ?>
                                </select>
                                <script type="text/javascript">
                                    function esi_optinforms_change_form4_disclaimer_size() {
                                        document.getElementById("esi-optinforms-form4-disclaimer").style.fontSize = document.getElementById('esi_optinforms_form4_disclaimer_size').value;
                                    }
                                </script>
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                
                            </div><!--optionlast-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form4_disclaimer_color" class="nopointer"><?php echo __('Disclaimer color', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form4_disclaimer_color" name="esi_optinforms_form4_disclaimer_color" class="esi-optinforms-color" value="<?php echo esi_optinforms_form4_default_disclaimer_color(); ?>" data-default-color="#999999" <?php if (get_option('esi_optinforms_form4_hide_disclaimer')== '1') echo 'disabled="disabled"'; ?> />
                                <script>
                                    jQuery(document).ready(function($){
                                        $('#esi_optinforms_form4_disclaimer_color').wpColorPicker({
                                            color: true,
                                            hide: true,
                                            palettes: true,
                                            change: function(event, ui) {
                                                $("#esi-optinforms-form4-disclaimer").css( 'color', ui.color.toString());
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
                                <label for="esi_optinforms_form4_width" class="nopointer"><?php echo __('Form width', 'esi'); ?></label> <label><a onclick="esi_optinforms_explain_width_4()"><span class="explain">?</span></a></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <div class="choose-width">
                                    <input name="esi_optinforms_form4_width" id="esi_optinforms_form4_width_100" type="radio" value="0" class="radiobutton" <?php echo esi_optinforms_form4_checked_width_100(); ?> onclick="document.getElementById('esi_optinforms_form4_width_pixels').disabled=true;" /> <label for="esi_optinforms_form4_width_100" class="radiobutton-label">100%</label>
                                </div><!--choose-width-->
                                <div class="choose-width">
                                    <input name="esi_optinforms_form4_width" id="esi_optinforms_form4_width_fixed" type="radio" value="1" class="radiobutton" <?php echo esi_optinforms_form4_checked_width_fixed(); ?> onclick="document.getElementById('esi_optinforms_form4_width_pixels').disabled=false;" /> <label for="esi_optinforms_form4_width_fixed" class="radiobutton-label">Fixed:</label>
                                </div><!--choose-width-->
                                <input type="text" id="esi_optinforms_form4_width_pixels" name="esi_optinforms_form4_width_pixels" value="<?php echo esi_optinforms_form4_default_width_pixels(); ?>" class="fixed-width" <?php echo esi_optinforms_form4_disabled_width_pixels(); ?> /> <p class="fixed-width-px">px</p>
                                <div class="clear"></div>
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                
                            </div><!--optionlast-->
                            <div class="clear"></div>
                        </div><!--optiongroup-->
                        
                        <script type="text/javascript">
                            function esi_optinforms_explain_width_4() {
                                // Get the DOM reference
                                var contentId = document.getElementById("esi-optinforms-explain-width-4");
                                // Toggle 
                                contentId.style.display == "block" ? contentId.style.display = "none" : 
                                contentId.style.display = "block"; 
                            }
                        </script>
                        <div id="esi-optinforms-explain-width-4" style="display:none;">
                            <div class="esi-optinforms-help">
                                <p><?php echo __('In most cases, you can leave the form width at 100%. This will ensure your form will align perfectly with any WordPress theme and act responsive when scaled on different devices. Please note that the form preview displayed in your WordPress administration panel will not be affected by changing this value.', 'esi'); ?></p>
                            </div><!--esi-optinforms-help-->
                        </div><!--esi-optinforms-explain-width-4-->
                    
                    </div><!--toggle-container-->
                    <div class="clear"></div>
                    
                    <div class="toggle-wrap">
                    	<span class="trigger">
                            <a><?php echo __('Form Options', 'esi'); ?></a>
                        </span>
                        
                        <div class="toggle-container" style="display: none;">
                        
                        	<div class="optiongroup">
                                <div class="optionleft">
                                    
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                	<input type="checkbox" name="esi_optinforms_form4_hide_title" value="1" id="esi_optinforms_form4_hide_title" <?php if (get_option('esi_optinforms_form4_hide_title')== '1') echo 'checked="checked"'; ?> onclick="esi_optinforms_form4_title_visibility(this.checked);" /> <label for="esi_optinforms_form4_hide_title" class="nopointer"><?php echo __('Hide the title', 'esi'); ?></label>
                                    <script type="text/javascript">
										function esi_optinforms_form4_title_visibility(optinchecked) {
											if(optinchecked) {
												document.getElementById("esi-optinforms-form4-title").style.display = "none";
											}
											else {
												document.getElementById("esi-optinforms-form4-title").style.display = "";
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
                                	<input type="checkbox" name="esi_optinforms_form4_hide_subtitle" value="1" id="esi_optinforms_form4_hide_subtitle" <?php if (get_option('esi_optinforms_form4_hide_subtitle')== '1') echo 'checked="checked"'; ?> onclick="esi_optinforms_form4_hide_subtitle_visibility(this.checked);" /> <label for="esi_optinforms_form4_hide_subtitle" class="nopointer"><?php echo __('Hide the subtitle', 'esi'); ?></label>
                                    <script type="text/javascript">
										function esi_optinforms_form4_hide_subtitle_visibility(optinchecked) {
											if(optinchecked) {
												document.getElementById("esi-optinforms-form4-subtitle").style.display = "none";
											}
											else {
												document.getElementById("esi-optinforms-form4-subtitle").style.display = "";
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
                                	<input type="checkbox" name="esi_optinforms_form4_hide_disclaimer" value="1" id="esi_optinforms_form4_hide_disclaimer" <?php if (get_option('esi_optinforms_form4_hide_disclaimer')== '1') echo 'checked="checked"'; ?> onclick="esi_optinforms_form4_hide_disclaimer_visibility(this.checked);" /> <label for="esi_optinforms_form4_hide_disclaimer" class="nopointer"><?php echo __('Hide the disclaimer', 'esi'); ?></label>
                                    <script type="text/javascript">
										function esi_optinforms_form4_hide_disclaimer_visibility(optinchecked) {
											if(optinchecked) {
												document.getElementById("esi-optinforms-form4-disclaimer").style.display = "none";
											}
											else {
												document.getElementById("esi-optinforms-form4-disclaimer").style.display = "";
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
                                    <label for="esi_optinforms_form4_css" class="nopointer"><?php echo __('Custom CSS', 'esi'); ?></label> <label><a onclick="esi_optinforms_explain_css_4()"><span class="explain">?</span></a></label> 
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                	<textarea id="esi_optinforms_form4_css" name="esi_optinforms_form4_css"><?php echo esi_optinforms_form4_css(); ?></textarea>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
                            <script type="text/javascript">
								function esi_optinforms_explain_css_4() {
									// Get the DOM reference
									var contentId = document.getElementById("esi-optinforms-explain-css-4");
									// Toggle 
									contentId.style.display == "block" ? contentId.style.display = "none" : 
									contentId.style.display = "block"; 
								}
							</script>
							<div id="esi-optinforms-explain-css-4" style="display:none;">
								<div class="esi-optinforms-help">
									<p><?php echo __('Override the plugin\'s CSS values by entering your own custom CSS.', 'esi'); ?></p>
								</div><!--esi-optinforms-help-->
							</div><!--esi-optinforms-explain-css-4-->
                            
                        </div><!--toggle-container-->
                        <div class="clear"></div>
                    </div><!--toggle-wrap-->

<?php ?>