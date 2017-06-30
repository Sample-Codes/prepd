<?php ?>
                    
				<div class="toggle-wrap">
               		<span class="trigger">
                    	<a><?php echo __('Form Placement', 'esi'); ?></a>
                    </span>
                    <div class="toggle-container" style="display: none;">
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form_placement_post" class="nopointer"><?php echo __('On posts and custom post types', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input name="esi_optinforms_form_placement_post" id="esi_optinforms_form_placement_post_1" type="radio" value="1" class="radiobutton" onclick="document.getElementById('esi_optinforms_form_exclude_posts').disabled=false;" <?php if (get_option('esi_optinforms_form_placement_post')== '1') echo 'checked="checked"'; ?> /> <label for="esi_optinforms_form_placement_post_1" class="radiobutton-label"><?php echo __('After the first paragraph', 'esi'); ?></label>
                                <div class="clear"></div>
                                <input name="esi_optinforms_form_placement_post" id="esi_optinforms_form_placement_post_2" type="radio" value="2" class="radiobutton" onclick="document.getElementById('esi_optinforms_form_exclude_posts').disabled=false;" <?php if (get_option('esi_optinforms_form_placement_post')== '2') echo 'checked="checked"'; ?> /> <label for="esi_optinforms_form_placement_post_2" class="radiobutton-label"><?php echo __('After the second paragraph', 'esi'); ?></label>
                                <div class="clear"></div>
                                <input name="esi_optinforms_form_placement_post" id="esi_optinforms_form_placement_post_3" type="radio" value="3" class="radiobutton" onclick="document.getElementById('esi_optinforms_form_exclude_posts').disabled=false;" <?php if (get_option('esi_optinforms_form_placement_post')== '3') echo 'checked="checked"'; ?> /> <label for="esi_optinforms_form_placement_post_3" class="radiobutton-label"><?php echo __('After the post', 'esi'); ?></label>
                                <div class="clear"></div>
                                <input name="esi_optinforms_form_placement_post" id="esi_optinforms_form_placement_post_4" type="radio" value="4" class="radiobutton" onclick="document.getElementById('esi_optinforms_form_exclude_posts').disabled=true;" <?php if (get_option('esi_optinforms_form_placement_post')== '') echo 'checked="checked"';  if (get_option('esi_optinforms_form_placement_post')== '4') echo 'checked="checked"'; ?> /> <label for="esi_optinforms_form_placement_post_4" class="radiobutton-label"><?php echo __('Don\'t display on posts and custom post types', 'esi'); ?></label>
                                <div class="clear"></div>
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                            
                            </div><!--optionlast-->
                            <div class="clear"></div>
                
                        </div><!--optiongroup-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form_exclude_posts" class="nopointer"><?php echo __('Exclude on posts', 'esi'); ?></label> <label><a onclick="esi_optinforms_explain_form_exclude_posts()"><span class="explain">?</span></a></label> 
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form_exclude_posts" name="esi_optinforms_form_exclude_posts" value="<?php echo esi_optinforms_form_exclude_posts(); ?>" <?php if (get_option('esi_optinforms_form_placement_post')== '4') echo 'disabled="disabled"'; ?> />
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                            
                            </div><!--optionlast-->
                            <div class="clear"></div>
                
                        </div><!--optiongroup-->
                        
                        <script type="text/javascript">
                            function esi_optinforms_explain_form_exclude_posts() {
                            // Get the DOM reference
                            var contentId = document.getElementById("esi_optinforms_explain_form_exclude_posts");
                            // Toggle 
                            contentId.style.display == "block" ? contentId.style.display = "none" : 
                            contentId.style.display = "block"; 
                            }
                        </script>
                        <div id="esi_optinforms_explain_form_exclude_posts" style="display:none;">
                            <div class="esi-optinforms-help">
                                <p><?php echo __('To exclude the form on certain posts, enter a comma separated list of post ID\'s, e.g. 6, 27, 41', 'esi'); ?></p>
                            </div><!--esi-optinforms-help-->
                        </div><!--esi_optinforms_explain_form_exclude_posts-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form_placement_page" class="nopointer"><?php echo __('On pages', 'esi'); ?></label>
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input name="esi_optinforms_form_placement_page" id="esi_optinforms_form_placement_page_1" type="radio" value="1" class="radiobutton" onclick="document.getElementById('esi_optinforms_form_exclude_pages').disabled=false;" <?php if (get_option('esi_optinforms_form_placement_page')== '1') echo 'checked="checked"'; ?> /> <label for="esi_optinforms_form_placement_page_1" class="radiobutton-label"><?php echo __('After the first paragraph', 'esi'); ?></label>
                                <div class="clear"></div>
                                <input name="esi_optinforms_form_placement_page" id="esi_optinforms_form_placement_page_2" type="radio" value="2" class="radiobutton" onclick="document.getElementById('esi_optinforms_form_exclude_pages').disabled=false;" <?php if (get_option('esi_optinforms_form_placement_page')== '2') echo 'checked="checked"'; ?> /> <label for="esi_optinforms_form_placement_page_2" class="radiobutton-label"><?php echo __('After the second paragraph', 'esi'); ?></label>
                                <div class="clear"></div>
                                <input name="esi_optinforms_form_placement_page" id="esi_optinforms_form_placement_page_3" type="radio" value="3" class="radiobutton" onclick="document.getElementById('esi_optinforms_form_exclude_pages').disabled=false;" <?php if (get_option('esi_optinforms_form_placement_page')== '3') echo 'checked="checked"'; ?> /> <label for="esi_optinforms_form_placement_page_3" class="radiobutton-label"><?php echo __('After the page', 'esi'); ?></label>
                                <div class="clear"></div>
                                <input name="esi_optinforms_form_placement_page" id="esi_optinforms_form_placement_page_4" type="radio" value="4" class="radiobutton" onclick="document.getElementById('esi_optinforms_form_exclude_pages').disabled=true;" <?php  if (get_option('esi_optinforms_form_placement_page')== '') echo 'checked="checked"';  if (get_option('esi_optinforms_form_placement_page')== '4') echo 'checked="checked"'; ?> /> <label for="esi_optinforms_form_placement_page_4" class="radiobutton-label"><?php echo __('Don\'t display on pages', 'esi'); ?></label>
                                <div class="clear"></div>
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                            
                            </div><!--optionlast-->
                            <div class="clear"></div>
                
                        </div><!--optiongroup-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form_exclude_pages" class="nopointer"><?php echo __('Exclude on pages', 'esi'); ?></label> <label><a onclick="esi_optinforms_explain_form_exclude_pages()"><span class="explain">?</span></a></label> 
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form_exclude_pages" name="esi_optinforms_form_exclude_pages" value="<?php echo esi_optinforms_form_exclude_pages(); ?>" <?php if (get_option('esi_optinforms_form_placement_page')== '4') echo 'disabled="disabled"'; ?> />
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                            
                            </div><!--optionlast-->
                            <div class="clear"></div>
                
                        </div><!--optiongroup-->
                        
                        <script type="text/javascript">
                            function esi_optinforms_explain_form_exclude_pages() {
                            // Get the DOM reference
                            var contentId = document.getElementById("esi_optinforms_explain_form_exclude_pages");
                            // Toggle 
                            contentId.style.display == "block" ? contentId.style.display = "none" : 
                            contentId.style.display = "block"; 
                            }
                        </script>
                        <div id="esi_optinforms_explain_form_exclude_pages" style="display:none;">
                            <div class="esi-optinforms-help">
                                <p><?php echo __('To exclude the form on certain pages, enter a comma separated list of page ID\'s, e.g. 12, 43, 57', 'esi'); ?></p>
                            </div><!--esi-optinforms-help-->
                        </div><!--esi_optinforms_explain_form_exclude_pages-->
                        
                        <div class="optiongroup">
                            <div class="optionleft">
                                <label for="esi_optinforms_form_shortcode" class="nopointer"><?php echo __('Shortcode', 'esi'); ?></label> <label><a onclick="esi_optinforms_explain_form_shortcode()"><span class="explain">?</span></a></label> 
                            </div><!--optionleft-->
                            <div class="optionmiddle">
                                <input type="text" id="esi_optinforms_form_shortcode" name="esi_optinforms_form_shortcode" value="[esi-optinform]" readonly="readonly" />
                            </div><!--optionmiddle-->
                            <div class="optionlast">
                                            
                            </div><!--optionlast-->
                            <div class="clear"></div>
                
                        </div><!--optiongroup-->
                        
                        <script type="text/javascript">
                            function esi_optinforms_explain_form_shortcode() {
                            // Get the DOM reference
                            var contentId = document.getElementById("esi_optinforms_explain_form_shortcode");
                            // Toggle 
                            contentId.style.display == "block" ? contentId.style.display = "none" : 
                            contentId.style.display = "block"; 
                            }
                        </script>
                        <div id="esi_optinforms_explain_form_shortcode" style="display:none;">
                            <div class="esi-optinforms-help">
                                <p><?php echo __('Use the following shortcode to add your form to any post, page or custom post type. Simply paste the shortcode in your editor and you\'re done. For example, you can disable the automatic inclusion of forms on posts and pages and manually add forms to posts and pages of your choice.', 'esi'); ?></p>
                            </div><!--esi-optinforms-help-->
                        </div><!--esi_optinforms_explain_form_exclude_pages-->
                        
                        <div class="optiongroup">
                            <div class="optionlast">
                                            
                            </div><!--optionlast-->
                            <div class="clear"></div>
                
                        </div><!--optiongroup-->
               		</div><!--toggle-container-->
                </div><!--toggle-wrap-->

<?php ?>