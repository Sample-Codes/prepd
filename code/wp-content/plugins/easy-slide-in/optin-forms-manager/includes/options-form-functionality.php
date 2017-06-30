<?php ?>
					<div class="toggle-wrap">
               			<span class="trigger">
                    		<a><?php echo __('Form Functionality', 'esi'); ?></a>
                   		</span>
                        
                    	<div class="toggle-container" style="display: none;">

                			<div class="optiongroup">
                                <div class="optionleft">
                                    
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                	<input type="checkbox" name="esi_optinforms_form_target" value="1" id="esi_optinforms_form_target" <?php if (get_option('esi_optinforms_form_target')== '1') echo 'checked="checked"'; ?> /> <label for="esi_optinforms_form_target" class="nopointer"><?php echo __('Open form submission in a new window', 'esi'); ?></label>
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->
                            
						</div><!--toggle-container-->
                	</div><!--toggle-wrap-->

<?php ?>