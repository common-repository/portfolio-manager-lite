<?php
	$writableCssError = $this->check_writing( SKIN_PML_PATH );
	
	$selectOptionData = array(
		array( 'value' => 0, 'text'	=> '------' ),
		array( 'value' => '1-column', 'text' => esc_html__('Grid - Portfolio 1 Column', 'otw_pml') ),
		array( 'value' => '4-column', 'text' => esc_html__('Grid - Portfolio 4 Columns', 'otw_pml') ),
		array( 'value' => '1-column-lft-img', 'text' => esc_html__('Image Left - Portfolio 1 Column', 'otw_pml') ),
		array( 'value' => '3-column-news', 'text' => esc_html__('Newspaper - Portfolio 3 Columns', 'otw_pml') ),
		array( 'value' => 'timeline', 'text' => esc_html__('Timeline', 'otw_pml') ),
		array( 'value' => 'slider', 'text' => esc_html__('Slider', 'otw_pml') ),
		array( 'value' => '3-column-carousel', 'text' => esc_html__('Carousel - 3 Columns', 'otw_pml') ),
		array( 'value' => 'widget-lft', 'text' => esc_html__('Widget Style - Image Left', 'otw_pml') )
	);
	
	$selectPaginationData = array(
		array( 'value' => '0', 'text' => esc_html__('None (default)', 'otw_pml') ),
		array( 'value' => 'pagination', 'text' => esc_html__('Standard Pagination', 'otw_pml') )
	);	

	$selectSocialData = array(
		array( 'value' => '0', 'text' => esc_html__('None (default)', 'otw_pml') )
	);	

	$selectOrderData = array(
		array( 'value' => 'date_desc', 'text' => esc_html__('Latest Created (default)', 'otw_pml') ),
		array( 'value' => 'date_asc', 'text' => esc_html__('Oldest Created', 'otw_pml') ),
		array( 'value' => 'modified_desc', 'text' => esc_html__('Latest Modified', 'otw_pml') ),
		array( 'value' => 'modified_asc', 'text' => esc_html__('Oldest Modified', 'otw_pml') ),
		array( 'value' => 'title_asc', 'text' => esc_html__('Alphabetically: A-Z', 'otw_pml') ),
		array( 'value' => 'title_desc', 'text' => esc_html__('Alphabetically: Z-A', 'otw_pml') ),
		array( 'value' => 'rand_', 'text' => esc_html__('Random', 'otw_pml') )
	);

	$selectHoverData = array(
		array( 'value' => 'hover-none', 'text' => esc_html__('None', 'otw_pml') ),
		array( 'value' => 'otw_portfolio_manager-hover-effect-5', 'text' => esc_html__('Hover 5', 'otw_pml') ),
		array( 'value' => 'otw_portfolio_manager-hover-effect-11', 'text' => esc_html__('Hover 11', 'otw_pml') )
	);

	$selectIconData = array(
		array( 'value' => 0, 'text' => esc_html__('None (default)', 'otw_pml') ),
		array( 'value' => 'icon-expand', 'text' => esc_html__('Icon Expand', 'otw_pml') ),
		array( 'value' => 'icon-youtube-play', 'text' => esc_html__('Icon YouTube Play', 'otw_pml') ),
		array( 'value' => 'icon-file', 'text' => esc_html__('Icon File', 'otw_pml') ),
		array( 'value' => 'icon-book', 'text' => esc_html__('Icon Book', 'otw_pml') ),
		array( 'value' => 'icon-check-sign', 'text' => esc_html__('Icon Check Sign', 'otw_pml') ),
		array( 'value' => 'icon-comments', 'text' => esc_html__('Icon Comments', 'otw_pml') ),
		array( 'value' => 'icon-ok-sign', 'text' => esc_html__('Icon OK Sign', 'otw_pml') ),
		array( 'value' => 'icon-zoom-in', 'text' => esc_html__('Icon Zoom In', 'otw_pml') ),
		array( 'value' => 'icon-thumbs-up-alt', 'text' => esc_html__('Icon Thumbs Up Alt', 'otw_pml') ),
		array( 'value' => 'icon-plus-sign', 'text' => esc_html__('Icon Plus Sign', 'otw_pml') ),
		array( 'value' => 'icon-cloud', 'text' => esc_html__('Icon Cloud', 'otw_pml') ),
		array( 'value' => 'icon-chevron-sign-right', 'text' => esc_html__('Icon Chevron Sign Right', 'otw_pml') ),
		array( 'value' => 'icon-hand-right', 'text' => esc_html__('Icon Hand Right', 'otw_pml') ),
		array( 'value' => 'icon-fullscreen', 'text' => esc_html__('Icon Fullscreen', 'otw_pml') ),
	);
	
	$selectLinkData = array(
		array( 'value' => 'single', 'text' => esc_html__('Single Post (default)', 'otw_pml') )
	);

	$selectMetaData = array(
		array( 'value' => 'horizontal', 'text' => esc_html__('Horizontal (default)', 'otw_pml') )
	);

	$selectStripTags = array(
		array( 'value' => 'yes', 'text' => esc_html__('Yes (default)', 'otw_pml') )
	);
	
	$selectStripShortcodes = array(
		array( 'value' => 'yes', 'text' => esc_html__('Yes (default)', 'otw_pml') )
	);

	$selectSliderAlignmentData = array(
		array( 'value' => 'left', 'text' => esc_html__('Left (default)', 'otw_pml') ),
		array( 'value' => 'center', 'text' => esc_html__('Center', 'otw_pml') ),
		array( 'value' => 'right', 'text' => esc_html__('Right', 'otw_pml') ),
	);

	$selectMosaicData = array(
		array( 'value' => 'full', 'text' => esc_html__('Full Content on Hover (default)', 'otw_pml') ),
		array( 'value' => 'slide', 'text' => esc_html__('Slide Content on Hover', 'otw_pml') ),
	);

	$selectFontSizeData = array(
		array( 'value' => '', 'text' => esc_html__('None (default)', 'otw_pml') ),
		array( 'value' => '8', 'text' => '8px' ),
		array( 'value' => '10', 'text' => '10px' ),
		array( 'value' => '12', 'text' => '12px' ),
		array( 'value' => '14', 'text' => '14px' ),
		array( 'value' => '16', 'text' => '16px' ),
		array( 'value' => '18', 'text' => '18px' ),
		array( 'value' => '20', 'text' => '20px' ),
		array( 'value' => '22', 'text' => '22px' ),
		array( 'value' => '24', 'text' => '24px' ),
		array( 'value' => '26', 'text' => '26px' ),
		array( 'value' => '28', 'text' => '28px' ),
		array( 'value' => '30', 'text' => '30px' ),
		array( 'value' => '32', 'text' => '32px' ),
		array( 'value' => '34', 'text' => '34px' ),
		array( 'value' => '36', 'text' => '36px' ),
		array( 'value' => '38', 'text' => '38px' ),
		array( 'value' => '40', 'text' => '40px' ),
	);

	$selectFontStyleData = array(
		array( 'value' => '', 'text' => esc_html__('None (default)', 'otw_pml') ),
		array( 'value' => 'regular', 'text' => esc_html__('Regular', 'otw_pml') ),
		array( 'value' => 'bold', 'text' => esc_html__('Bold', 'otw_pml') ),
		array( 'value' => 'italic', 'text' => esc_html__('Italic', 'otw_pml') ),
		array( 'value' => 'bold_italic', 'text' => esc_html__('Bold and Italic', 'otw_pml') ),
	);

	$selectViewTargetData = array(
	);

	$selectCategoryTagRelation = array(
		array( 'value' => 'OR', 'text' => esc_html__('categories OR tags (default)', 'otw_pml') ),
		array( 'value' => 'AND', 'text' => esc_html__('categories AND tags', 'otw_pml') )
	);
	
	$thumb_format_options = array(
		'' => esc_html__('Keep original file format (default)', 'otw_pml' ),
		'jpg' => 'jpg',
		'png' => 'png',
		'gif' => 'gif'
	);
	
	$selectBorderStyleData = array(
		array( 'value' => '', 'text' => esc_html__('None (default)', 'otw_pml') ),
		array( 'value' => 'solid', 'text' => 'Solid' ),
		array( 'value' => 'dashed', 'text' => 'Dashed' ),
		array( 'value' => 'dotted', 'text' => 'Dotted' )
	);
	
	$selectBorderSizeData = array(
		array( 'value' => '', 'text' => esc_html__('None (default)', 'otw_pml') ),
		array( 'value' => '1', 'text' => '1px' ),
		array( 'value' => '2', 'text' => '2px' ),
		array( 'value' => '3', 'text' => '3px' ),
		array( 'value' => '4', 'text' => '4px' )
	);
	
	
	$js_template_options = array();
	
	if( isset( $templateOptions ) && is_array( $templateOptions ) ){
		
		foreach( $templateOptions as $t_option ){
			$js_template_options[ $t_option['name'] ] = $t_option;
		}
	}
	
	$total_meta_elements = 5;
	
	$meta_elements = array();
	$meta_elements['category'] = esc_html__( 'category', 'otw_pml' );
	$meta_elements['tags'] = esc_html__( 'tags', 'otw_pml' );
	
	$otw_details = $this->get_details();
	
	foreach( $otw_details as $detail ){
		$meta_elements['otw_portfolio_detail_'.$detail['id'] ] = $detail['title'];
		$total_meta_elements++;
	}
	
	$meta_elements_height = ( ( $total_meta_elements + 2 ) * 20 );
?>
<div class="wrap">
	<div id="icon-edit" class="icon32"></div>
	<h2>
		<?php
			if( empty($this->errors) && !empty($content['list_name']) ) {
				echo __( 'Edit Portfolio List', 'otw_pml' ); 	
			} else {
				echo __( 'Add New Portfolio List', 'otw_pml' );
			}
		?>
		<a class="add-new-h2" href="admin.php?page=otw-pml"><?php esc_html_e('Back', 'otw_pml');?></a>
	</h2>
	<?php
		if( $writableCssError ) {
			$message = esc_html__('The folder \''.SKIN_PML_PATH.'\' is not writable. Please make sure you add read/write permissions to this folder.', 'otw_pml');
			 echo '<div class="error"><p>'.$message.'</p></div>';
		}
	?>
	<?php
	if( !empty( otw_get( 'success', '' ) ) && otw_get( 'success', '' ) == 'true' ) {
			$message = esc_html__('Item was saved.', 'otw_pml');
			echo '<div class="updated"><p>'.$message.'</p></div>';
	}
	?>
	<form name="otw-pm-list" method="post" action="" class="validate">

		<input type="hidden" name="id" value="<?php echo esc_attr( $nextID );?>" />
		<input type="hidden" name="edit" value="<?php echo esc_attr( $edit );?>" />
		<input type="hidden" name="date_created" value="<?php echo esc_attr( $content['date_created'] );?>" />
		<input type="hidden" name="user_id" value="<?php echo esc_attr( get_current_user_id() );?>" />

		<?php
			if( !empty($this->errors) ){
				$errorMsg = esc_html__('Oops! Please check form for errors.', 'otw_pml');
				echo '<div class="error"><p>'.$errorMsg.'</p></div>';
			}
		?>
		<script type="text/javascript">
		<?php
			
			echo 'var js_template_options='.json_encode( $js_template_options ).';'
		?>
		</script>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="list_name" class="required"><?php esc_html_e('Portfolio List Name', 'otw_pml');?></label></th>
					<td>
						<input type="text" name="list_name" id="list_name" size="53" value="<?php echo esc_attr( $content['list_name'] );?>" />
						<p class="description"><?php esc_html_e( 'Note: The List Name is going to be used ONLY for the admin as a reference.', 'otw_pml');?></p>
						<div class="inline-error">
							<?php 
								( !empty($this->errors['list_name']) )? $errorMessage = $this->errors['list_name'] : $errorMessage = ''; 
								echo $errorMessage;
							?>
						</div>
					</td>
				</tr>				
				<tr valign="top">
					<th scope="row"><label for="template" class="required"><?php esc_html_e('Choose Template', 'otw_pml');?></label></th>
					<td>
						<select id="template" name="template" class="js-template-style">
						<?php 
						foreach( $selectOptionData as $optionData ): 
							$selected = '';
							if( $optionData['value'] === $content['template'] ) {
								$selected = 'selected="selected"';
							}
							echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
							
						endforeach;
						?>
						</select>
						<div class="inline-error">
							<?php 
								( !empty($this->errors['template']) )? $errorMessage = $this->errors['template'] : $errorMessage = ''; 
								echo $errorMessage;
							?>
						</div>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="categories"><?php esc_html_e('Portfolio Categories:', 'otw_pml');?></label>
					</th>
					<td>
						<?php 
								$categoriesCount 	= wp_count_terms( $this->portfolio_category, array( 'number' => '', 'hide_empty' => false  ) );
								$categoriesStatus = 'otw-admin-hidden';
								$categoriesAll 		= '';
								$categoriesInput 	= '';
								if( !empty($content['select_categories']) ) {
									
									$categoriesStatus = '';
									$categoriesAll = 'checked="checked"';
									$categoriesInput = 'disabled="disabled"';
								}
						?>
						<select name="categories[]" id="categories" class="js-categories" multiple="multiple" data-value="<?php echo esc_attr( $content['categories'] );?>" <?php echo $categoriesInput ?>></select><br />
						<?php esc_html_e('- OR -', 'otw_pml'); ?><br/>
						<input type="hidden" name="all_categories" class="js-categories-select" value="<?php echo esc_attr( $content['all_categories'] );?>" />
						<input type="checkbox" name="select_categories" value="1" data-size="<?php echo esc_attr( $categoriesCount );?>" class="js-select-categories" id="select_all_categories" data-section="categories" <?php echo $categoriesAll;?> />
						<label for="select_all_categories">
							<?php esc_html_e('Select All', 'otw_pml');?>
							<span class="js-categories-count <?php echo $categoriesStatus; ?>">
								(
								<span class="js-categories-counter"><?php echo esc_html( $categoriesCount );?></span>
								<?php esc_html_e(' categories selected', 'otw_pml');?>
								)
							</span>
						</label>
						<p class="description"><?php esc_html_e( 'Choose categories to include posts from those categories in your list or use the Select all checkbox to include posts from all categories.', 'otw_pml');?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="tags"><?php esc_html_e('Portfolio Tags:', 'otw_pml');?></label>
					</th>
					<td>
						<?php 
								$tagsCount 	= wp_count_terms( $this->portfolio_tag, array( 'number' => '', 'hide_empty' => false  ) );
								$tagsStatus = 'otw-admin-hidden';
								$tagsAll 		= '';
								$tagsInput 	= '';
								if( !empty($content['select_tags']) ) {
									$tagsStatus = '';
									$tagsAll = 'checked="checked"';
									$tagsInput = 'disabled="disabled"';
								}
						?>
						<select name="tags[]" id="tags" class="js-tags" multiple="multiple" data-value="<?php echo esc_attr( $content['tags'] );?>" <?php echo $tagsInput;?>></select><br />
						<?php esc_html_e('- OR -', 'otw_pml'); ?><br/><br/>
						<input type="hidden" name="all_tags" class="js-tags-select" value="<?php echo esc_attr( $content['all_tags'] );?>" />
						<input type="checkbox" name="select_tags" value="1" data-size="<?php echo esc_attr( $tagsCount );?>" class="js-select-tags" id="select_all_tags" data-section="tags" <?php echo $tagsAll;?>/>
						<label for="select_all_tags">
							<?php esc_html_e('Select All', 'otw_pml'); ?>
							<span class="js-tags-count <?php echo $tagsStatus;?>">
								(
								<span class="js-tags-counter"><?php echo esc_html( $tagsCount );?></span>
								<?php esc_html_e(' tags selected', 'otw_pml');?>
								)
							</span>
						</label>
						<p class="description"><?php esc_html_e( 'Choose tags to include posts from those tags in your list or use the Select all checkbox to include posts from all tags.', 'otw_pml');?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="authors"><?php esc_html_e('Post Author:', 'otw_pml');?></label>
					</th>
					<td>
						<?php 
								$count_users = count_users();
								$usersCount = $count_users['total_users'];
								$usersStatus = 'otw-admin-hidden';
								$usersAll 		= '';
								$usersInput 	= '';
								if( !empty($content['select_users']) ) {
									$usersStatus = '';
									$usersAll = 'checked="checked"';
									$usersInput = 'disabled="disabled"';
								}
						?>
						<select name="users[]" id="users" class="js-users" multiple="multiple" data-value="<?php echo esc_attr( $content['users'] );?>" <?php echo $usersInput ?>></select><br />
						<?php esc_html_e('- OR -', 'otw_pml'); ?><br/><br/>
						<input type="hidden" name="all_users" class="js-users-select" value="<?php echo esc_attr( $content['all_users'] );?>" />
						<input type="checkbox" name="select_users" value="1" data-size="<?php echo esc_attr( $usersCount ); ?>" class="js-select-users" id="select_all_users" data-section="users" <?php echo $usersAll;?>/>
						<label for="select_all_users">
							<?php esc_html_e('Select All', 'otw_pml'); ?>
							<span class="js-users-count <?php echo $usersStatus; ?>">
								(
								<span class="js-users-counter"><?php echo esc_html( $usersCount ); ?></span>
								<?php esc_html_e(' authors selected', 'otw_pml');?>
								)
							</span>
						</label>
						<p class="description"><?php esc_html_e( 'Choose authors to include posts from those authors in your list or use the Select all checkbox to include posts from all authors.', 'otw_pml');?></p>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<div class="inline-error">
							<?php 
								( !empty($this->errors['content']) )? $errorMessage = $this->errors['content'] : $errorMessage = ''; 
								echo $errorMessage;
							?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>

		<div class="accordion-container otw-accordion-container">
			<ul class="outer-border">
				
				<!-- List Elements and Order -->
				<li class="control-section accordion-section  add-page top">
					<h3 class="accordion-section-title hndl" tabindex="0" title="<?php esc_html_e('List Elements and Order', 'otw_pml');?>"><?php esc_html_e('List Elements and Order', 'otw_pml');?></h3>
					<div class="accordion-section-content" style="display: none;">
						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr>
										<th scope="row">
											<label for="meta_order"><?php esc_html_e('Portfolio List Items', 'otw_pml');?></label>
										</th>
										<td>
											<div class="active_elements">
												<h3><?php esc_html_e('Active Elements', 'otw_pml');?></h3>
												<input type="hidden" name="portfolio-items" class="js-portfolio-items" value="<?php echo esc_attr( $content['portfolio-items'] );?>"/>
												<ul id="meta-active" class="b-pl-box js-pl-active">
												</ul>
											</div>
											<div class="inactive_elements">
												<h3><?php esc_html_e('Inactive Elements', 'otw_pml');?></h3>
												<ul id="meta-inactive" class="b-pl-box js-pl-inactive">
													<li data-item="main" data-value="media" class="b-pl-items js-pl--item"><?php esc_html_e('Media', 'otw_pml');?></li>
													<li data-item="main" data-value="title" class="b-pl-items js-pl--item"><?php esc_html_e('Title', 'otw_pml');?></li>
													<li data-item="main" data-value="meta" class="b-pl-items js-pl--item"><?php esc_html_e('Portfolio Item Details', 'otw_pml');?></li>
													<li data-item="main" data-value="description" class="b-pl-items js-pl--item"><?php esc_html_e('Description / Excerpt', 'otw_pml');?></li>
													<li data-item="main" data-value="continue-reading" class="b-pl-items js-pl--item"><?php esc_html_e('Continue Reading', 'otw_pml');?></li>
												</ul>
											</div>
											<p class="description">
												<?php esc_html_e('Drag & drop the items that you\'d like to show in the Active Elements area on the left. Arrange them however you want to see them in your list.', 'otw_pml');?>
											</p>
											<p class="description">
												<?php esc_html_e('The setting will not affect the following templates: Slider, Carousel, Widget Style, Carousel Widget', 'otw_pml'); ?>
											</p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="show-pagination"><?php esc_html_e('Show Pagination', 'otw_pml');?></label>
										</th>
										<td>
											
										<select id="show-pagination" name="show-pagination">
											<?php 
											foreach( $selectPaginationData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['show-pagination'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>
											<p class="description">
												<?php esc_html_e('Choose pagination type for your template.', 'otw_pml'); ?><br/>
												<strong><?php esc_html_e('Note:', 'otw_pml');?></strong><br/>
												<?php esc_html_e('Widget Style templates support only Load More Pagination.', 'otw_pml'); ?><br/>
												<?php esc_html_e('Slider templates do not support pagination.', 'otw_pml'); ?><br/>
												<?php esc_html_e('Timeline template will have the Infinite Scroll by default.', 'otw_pml'); ?>
											</p>
										</td>
									</tr>
									<tr id="otw-show-social-icons-custom">
										<th scope="row">
											<label for="show-social-icons-custom"><?php esc_html_e('Custom Social Icons', 'otw_pml');?></label>
										</th>
										<td>
											<textarea id="show-social-icons-custom" name="show-social-icons-custom" rows="6" cols="80"><?php echo ( $content['show-social-icons-custom'] )?></textarea>
											<p class="description"><?php esc_html_e( 'Insert your Custom Social Icons. HTML and Shortcodes are allowed.', 'otw_pml');?></p>
										</td>
									</tr>
								</tbody>
							</table>
						</div><!-- .inside -->
					</div><!-- .accordion-section-content -->

				</li><!-- .accordion-section -->
				<!-- END List Elements and Order -->

				<!-- Post Order and Limits -->
				<li class="control-section accordion-section add-page top">
					<h3 class="accordion-section-title hndl" tabindex="1" title="<?php esc_html_e('Posts Order and Limits', 'otw_pml');?>"><?php esc_html_e('Posts Order and Limits', 'otw_pml');?></h3>
					<div class="accordion-section-content" style="display: none;">
						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr valign="top">
										<th scope="row">
											<label for="posts_limit"><?php esc_html_e('Number of Posts in the List:', 'otw_pml');?></label>
										</th>
										<td>
											<input type="text" name="posts_limit" id="posts_limit" value="<?php echo esc_attr( $content['posts_limit'] );?>" />
											<p class="description"><?php esc_html_e('Please leave empty for all posts.', 'otw_pml');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="posts_limit_skip"><?php esc_html_e('Number of Posts to Skip:', 'otw_pml');?></label>
										</th>
										<td>
											<input type="text" name="posts_limit_skip" id="posts_limit_skip" value="<?php echo esc_attr( $content['posts_limit_skip'] );?>" />
											<p class="description"><?php esc_html_e('By default this field is empty which means no posts will be skipped.', 'otw_pml');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="posts_limit_page"><?php esc_html_e('Number of Posts per Page:', 'otw_pml');?></label>
										</th>
										<td>
											<input type="text" name="posts_limit_page" id="posts_limit_page" value="<?php echo esc_attr( $content['posts_limit_page'] );?>" />
											<p class="description"><?php esc_html_e('Show pagination should be ebabled in the section above in order for this option to work.', 'otw_pml');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="posts_order"><?php esc_html_e('Order of Posts:', 'otw_pml');?></label>
										</th>
										<td>
											<select name="posts_order" id="posts_order">
											<?php 
											foreach( $selectOrderData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['posts_order'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>
											<p class="description"><?php esc_html_e('Choose the order of the posts in the list. Timeline Template will ignore this selection and use Latest Created. Note that when Random is selected and pagination is enabled there might be posts displayed on more than one of the pagination pages.', 'otw_pml');?></p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div><!-- .accordion-section-content -->

				</li><!-- .accordion-section -->
				<!-- END Post Order and Limits -->

				<!-- Settings -->
				<li class="control-section accordion-section add-page top">
					<h3 class="accordion-section-title hndl" tabindex="2" title="<?php esc_html_e('Settings', 'otw_pml');?>"><?php esc_html_e('Settings', 'otw_pml');?></h3>
					<div class="accordion-section-content" style="display: none;">
						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr valign="top">
										<th scope="row">
											<label for="excerpt_length"><?php esc_html_e('Excerpt Length:', 'otw_pml');?></label>
										</th>
										<td>
											<input type="text" name="excerpt_length" id="excerpt_length" value="<?php echo esc_attr( $content['excerpt_length'] ) ?>" size="53"/>
											<p class="description"><?php esc_html_e('Excerpt is pulled from excerpt field for each post. If excerpt fields is empty excerpt is pulled from the text area (the post editor). If Excerpt length is empty or 0 this means pull the entire text.', 'otw_pml');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="image_hover"><?php esc_html_e('Hover Effect', 'otw_pml');?></label>
										</th>
										<td>
											<select name="image_hover" id="image_hover">
											<?php 
											foreach( $selectHoverData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['image_hover'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>									
											<p class="description"><?php esc_html_e('Choose the hover for the images in the posts list.', 'otw_pml');?></p>
											<p class="description">
												<?php esc_html_e('The setting will not affect the following templates since they have their own specific hovers: Slider, Carousel.', 'otw_pml'); ?> 
											</p>
											<p class="description">
												<?php esc_html_e('Widget Templates support only Full and None hover options.', 'otw_pml'); ?> 
											</p>
										</td>
									</tr>

								</tbody>
							</table>
						</div> <!-- .inside -->
					</div><!-- .accordion-section-content -->

				</li><!-- .accordion-section -->
				<!-- END Settings -->

				<!-- Media Tab -->
				<li class="control-section accordion-section add-page top">
					<h3 class="accordion-section-title hndl" tabindex="4" title="<?php esc_html_e('Media', 'otw_pml');?>"><?php esc_html_e('Media', 'otw_pml');?></h3>
					<div class="accordion-section-content" style="display: none;">
						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr valign="top">
										<th scope="row">
											<label for="thumb_width"><?php esc_html_e('Thumbnail Width', 'otw_pml');?></label>
										</th>
										<td>
											<?php ( !isset($content['thumb_width']) )? $thumbWidth = '' : $thumbWidth = $content['thumb_width']; ?>
											<input type="text" name="thumb_width" id="thumb_width" size="3" value="<?php echo esc_attr( $thumbWidth );?>" />
											<p class="description"><?php esc_html_e('The width for your thumbnails in px. If left empty the default value will be used. Default value for the selected template is: ', 'otw_pml');?><span class="default_thumb_width"></span></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="thumb_height"><?php esc_html_e('Thumbnail Height', 'otw_pml');?></label>
										</th>
										<td>
											<?php ( !isset($content['thumb_height']) )? $thumbHeight = '' : $thumbHeight = $content['thumb_height']; ?>
											<input type="text" name="thumb_height" id="thumb_height" size="3" value="<?php echo esc_attr( $thumbHeight );?>" />
											<p class="description"><?php esc_html_e('The height for your thumbnails in px. If left empty the default value will be used. Default value for the selected template is: ', 'otw_pml');?><span class="default_thumb_height"></span></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="thumb_format"><?php esc_html_e('Thumbnail Format', 'otw_pml');?></label>
										</th>
										<td>
											<?php ( !isset($content['thumb_format']) )? $thumbFormat = '' : $thumbFormat = $content['thumb_format']; ?>
											<select id="thumb_format" name="thumb_format">
											<?php foreach( $thumb_format_options as $key => $name ){?>
												<?php
													$selected = '';
													if( $thumbFormat == $key ){
														$selected = ' selected="selected"';
													}
												?>
												<option value="<?php echo esc_attr( $key )?>"<?php echo $selected?>><?php echo esc_html( $name )?></option>
											<?php }?>
											</select>
											<p class="description"><?php esc_html_e('The format for your thumbnails.', 'otw_pml');?></p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</li><!-- .accordion-section -->
				<!-- Style Tab -->
				
				<li class="control-section accordion-section add-page top">
					<h3 class="accordion-section-title hndl" tabindex="5" title="<?php esc_html_e('Styles', 'otw_pml');?>"><?php esc_html_e('Styles', 'otw_pml');?></h3>
					<div class="accordion-section-content" style="display: none;">
						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr valign="top">
										<th scope="row">
											<label for="custom_css"><?php esc_html_e('Custom CSS:', 'otw_pml');?></label>
										</th>
										<td>
											<textarea name="custom_css" cols="70" rows="10"><?php echo str_replace('\\', '', $content['custom_css']);?></textarea>
										</td>
									</tr>
								</tbody>
							</table>
						</div> <!-- .inside -->
					</div><!-- .accordion-section-content -->

				</li><!-- .accordion-section -->
				<!-- Style Tab -->
			</ul><!-- .outer-border -->
			
		</div>

		<p class="submit">
			<input type="submit" value="<?php esc_html_e( 'Save', 'otw_pml') ?>" name="submit-otw-pml" class="button button-primary button-hero"/>
		</p>

	</form>

<div class="live_preview js-preview"></div>