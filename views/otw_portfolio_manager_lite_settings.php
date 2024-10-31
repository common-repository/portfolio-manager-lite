<?php
	$_wp_column_headers['toplevel_page_otw-pm'] = array(
	'title' => esc_html__( 'Title', 'otw_pml' ),
	'order' => esc_html__( 'Order', 'otw_pml' )
);
	
	$otw_pm_plugin_options = get_option( 'otw_pm_plugin_options' );
	
	$otw_pm_plugin_options['otw_pm_promotions'] = get_option( $otw_pml_plugin_id.'_dnms' );
	
	if( empty( $otw_pm_plugin_options['otw_pm_promotions'] ) ){
		$otw_pm_plugin_options['otw_pm_promotions'] = 'on';
	}
	
	$otw_pm_plugin_options = $this->init_portfolio_item_values( $otw_pm_plugin_options );
	
	$otw_details = get_option( 'otw_pm_portfolio_details' );
	
	$message = '';
	$massages = array();
	$messages[1] = esc_html__( 'Detail saved.', 'otw_pml' );
	$messages[2] = esc_html__( 'Detail deleted.', 'otw_pml' );
	$messages[3] = esc_html__( 'OTW Portfolio Light plugin items imported successfully.', 'otw_pml' );
	
	if( otw_get('message',false) && isset( $messages[ otw_get('message','') ] ) ){
		$message .= $messages[ otw_get('message','') ];
	}
	
	$otw_pm_templates = array( 'default' => esc_html__( 'Default Theme\'s Post Template', 'otw_pml' ) ) + $this->otwDispatcher->portfolio_templates;
	
	$otw_pm_social_icons = array(
		'' => esc_html__( 'None (default)', 'otw_pml' ),
		'share_icons' => esc_html__( 'Share Icons', 'otw_pml' )
	);
	
	$otw_pm_prev_next_nav_options = array(
		'' => esc_html__( 'No (default)', 'otw_pml' )
	);
	
	$otw_pm_item_title_options = array(
		'yes' => esc_html__( 'Yes (default)', 'otw_pml' )
	);
	
	$otw_pm_related_posts_options = array(
		'' => esc_html__( 'No (default)', 'otw_pml' )
	);
	
	$otw_pm_related_posts_criteria_options = array(
		$this->portfolio_category => esc_html__( 'Category (default)', 'otw_pml' ),
		$this->portfolio_tag => esc_html__( 'Tag', 'otw_pml' )
	);
	
	$otw_pm_item_media_format_options = array(
		'' => esc_html__('Keep original file format (default)', 'otw_pml' )
	);
	
	$otw_pm_media_lightbox_options = array(
		'no' => esc_html__( 'No', 'otw_pml' )
	);
	
	$otw_pm_grid_pages_options = array(
		'yes' => esc_html__( 'Yes (default)', 'otw_pml' ),
		'no' => esc_html__( 'No', 'otw_pml' )
	);
?>
<?php if ( $message ) : ?>
<div id="message" class="updated"><p><?php echo esc_html( $message ); ?></p></div>
<?php
 endif; ?>
<div class="wrap">
	<div id="icon-options-general" class="icon32"></div>
	<h2><?php esc_html_e('Portfolio Options', 'otw_pml'); ?></h2>
  <?php
    if( $writableCssError ) {
      $message = esc_html__('The file \''.SKIN_PML_PATH.'custom.css\' is not writable. Please make sure you add read/write permissions to this file.', 'otw_pml');
      echo '<div class="error"><p>'.$message.'</p></div>';
    }

  ?>
	<?php
		if( !empty( otw_get( 'success_css', '' ) ) && otw_get( 'success_css', '' ) == 'true' ) {
			$message = esc_html__('Options page has been saved.', 'otw_pml');
			echo '<div class="updated"><p>'.$message.'</p></div>';
			flush_rewrite_rules();
		}
	?>
	<div id="icon-options-general" class="icon32"></div>
	
	<form name="otw-pm-list-style" method="post" action="" class="validate">
		<br />
		<h3><?php esc_html_e('OTW Promotions', 'otw_pml'); ?></h3>
		<div class="otw_pm_sp_settings">
			<table class="form-table">
				<tr>
					<th>
						<label for="otw_pm_promotions"><?php esc_html_e('Show OTW Promotion Messages in my WordPress admin', 'otw_pml'); ?></label>
						<select id="otw_pm_promotions" name="otw_pm_promotions">
							<option value="on" <?php echo ( isset( $otw_pm_plugin_options['otw_pm_promotions'] ) && ( $otw_pm_plugin_options['otw_pm_promotions'] == 'on' ) )? 'selected="selected"':''?>>on(default)</option>
							<option value="off"<?php echo ( isset( $otw_pm_plugin_options['otw_pm_promotions'] ) && ( $otw_pm_plugin_options['otw_pm_promotions'] == 'off' ) )? 'selected="selected"':''?>>off</option>
						</select>
					</th>
				</tr>
			</table>
		</div>
		<p class="submit">
			<input type="hidden" name="otw_pm_save_settings" value="1" />
			<input type="submit" value="<?php esc_html_e( 'Save', 'otw_pml') ?>" name="submit" class="button button-primary button-hero"/>
		</p>
		<h3><?php esc_html_e('Portfolio items single page', 'otw_pml'); ?></h3>
		<div class="otw_pm_sp_settings">
			<table class="form-table">
				<tr>
					<th scope="row"><label for="otw_pm_template"><?php esc_html_e('Template', 'otw_pml'); ?></label></th>
					<td>
						<select id="otw_pm_template" name="otw_pm_template">
						<?php foreach( $otw_pm_templates as $template_key => $template_name ){?>
							<?php
								$selected = '';
								if( isset( $otw_pm_plugin_options['otw_pm_template'] ) && ( $otw_pm_plugin_options['otw_pm_template'] == $template_key ) ){
									$selected = ' selected="selected"';
								}
							?>
							<?php if( $template_key == '-' ){ ?>
								<option disabled="disabled">------------------------------------------</option>
							<?php }else{ ?>
								<option value="<?php echo esc_attr( $template_key )?>"<?php echo $selected?>><?php echo esc_html( $template_name )?></option>
							<?php } ?>
						<?php }?>
						</select>
						<p class="description"><?php esc_html_e( 'This is the template for your single portfolio page.', 'otw_pml' )?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="otw_pm_social_icons"><?php esc_html_e('Social Icons', 'otw_pml'); ?></label></th>
					<td>
						<select id="otw_pm_social_icons" name="otw_pm_social_icons">
						<?php foreach( $otw_pm_social_icons as $icon_key => $icon_name ){?>
							<?php
								$selected = '';
								if( isset( $otw_pm_plugin_options['otw_pm_social_icons'] ) && ( $otw_pm_plugin_options['otw_pm_social_icons'] == $icon_key ) ){
									$selected = ' selected="selected"';
								}
							?>
							<option value="<?php echo esc_attr( $icon_key )?>"<?php echo $selected?>><?php echo esc_html( $icon_name )?></option>
						<?php }?>
						</select>
						<p class="description"><?php esc_html_e( 'Show Social Icons for Portfolio items single page.', 'otw_pml' )?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="otw_pm_item_media_width"><?php esc_html_e('Media Width', 'otw_pml'); ?></label></th>
					<td>
						<input type="text" name="otw_pm_item_media_width" id="otw_pm_item_media_width" value="<?php echo esc_attr( $otw_pm_plugin_options['otw_pm_item_media_width'] )?>" />
						<p class="description"><?php esc_html_e( 'Default 650px.', 'otw_pml' )?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="otw_pm_item_media_height"><?php esc_html_e('Media Height', 'otw_pml'); ?></label></th>
					<td>
						<input type="text" name="otw_pm_item_media_height" id="otw_pm_item_media_height" value="<?php echo esc_attr( $otw_pm_plugin_options['otw_pm_item_media_height'] )?>" />
						<p class="description"><?php esc_html_e( 'Default 580px.', 'otw_pml' )?></p>
					</td>
				</tr>
			</table>
		</div>
		<p class="submit">
			<input type="hidden" name="otw_pm_save_settings" value="1" />
			<input type="submit" value="<?php esc_html_e( 'Save', 'otw_pml') ?>" name="submit" class="button button-primary button-hero"/>
		</p>
		<h3><?php esc_html_e('Slugs', 'otw_pml'); ?></h3>
		<div class="otw_pm_sp_settings">
			<table class="form-table">
				<tr>
					<th scope="row"><label for="otw_pm_portfolio_slug"><?php esc_html_e('Portfolio Single Page Slug', 'otw_pml'); ?></label></th>
					<td>
						<input type="text" name="otw_pm_portfolio_slug" id="otw_pm_portfolio_slug" value="<?php echo esc_attr( $otw_pm_plugin_options['otw_pm_portfolio_slug'] )?>" />
						<p class="description"><?php esc_html_e( 'Edit the Portfolio Single Page Slug. Default is: '.$this->portfolio_post_type, 'otw_pml' )?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="otw_pm_portfolio_category_slug"><?php esc_html_e('Portfolio Category Slug', 'otw_pml'); ?></label></th>
					<td>
						<input type="text" name="otw_pm_portfolio_category_slug" id="otw_pm_portfolio_category_slug" value="<?php echo esc_attr( $otw_pm_plugin_options['otw_pm_portfolio_category_slug'] )?>" />
						<p class="description"><?php esc_html_e( 'Edit the Portfolio Category Slug. Default is: '.$this->portfolio_category, 'otw_pml' )?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="otw_pm_portfolio_tag_slug"><?php esc_html_e('Portfolio Tag Slug', 'otw_pml'); ?></label></th>
					<td>
						<input type="text" name="otw_pm_portfolio_tag_slug" id="otw_pm_portfolio_tag_slug" value="<?php echo esc_attr( $otw_pm_plugin_options['otw_pm_portfolio_tag_slug'] )?>" />
						<p class="description"><?php esc_html_e( 'Edit the Portfolio Tag Slug. Default is: '.$this->portfolio_tag, 'otw_pml' )?></p>
					</td>
				</tr>
			</table>
		</div>
		<br />
		<h3><?php esc_html_e('Category & Tag Archive Pages', 'otw_pml'); ?></h3>
		<div class="otw_pm_sp_settings">
			<table class="form-table">
				<tr>
					<th scope="row"><label for="otw_pm_archive_media_width"><?php esc_html_e('Media Width', 'otw_pml'); ?></label></th>
					<td>
						<input type="text" name="otw_pm_archive_media_width" id="otw_pm_archive_media_width" value="<?php echo esc_attr( $otw_pm_plugin_options['otw_pm_archive_media_width'] )?>" />
						<p class="description"><?php esc_html_e( 'Default 220px.', 'otw_pml' )?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="otw_pm_archive_media_height"><?php esc_html_e('Media Height', 'otw_pml'); ?></label></th>
					<td>
						<input type="text" name="otw_pm_archive_media_height" id="otw_pm_archive_media_height" value="<?php echo esc_attr( $otw_pm_plugin_options['otw_pm_archive_media_height'] )?>" />
						<p class="description"><?php esc_html_e( 'Default 170px.', 'otw_pml' )?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="otw_pm_archive_media_format"><?php esc_html_e('Media Lightbox Format', 'otw_pml'); ?></label></th>
					<td>
						<select id="otw_pm_archive_media_format" name="otw_pm_archive_media_format">
						<?php foreach( $otw_pm_item_media_format_options as $key => $name ){?>
							<?php
								$selected = '';
								if( isset( $otw_pm_plugin_options['otw_pm_archive_media_format'] ) && ( $otw_pm_plugin_options['otw_pm_archive_media_format'] == $key ) ){
									$selected = ' selected="selected"';
								}
							?>
							<option value="<?php echo esc_attr( $key )?>"<?php echo $selected?>><?php echo esc_html( $name )?></option>
						<?php }?>
						</select>
						<p class="description"><?php esc_html_e( 'Cropping images formats.', 'otw_pml' )?></p>
					</td>
				</tr>
			</table>
		</div>
		<p class="submit">
			<input type="submit" value="<?php esc_html_e( 'Save', 'otw_pml') ?>" name="submit" class="button button-primary button-hero"/>
		</p>
		<h3><?php esc_html_e('Custom CSS', 'otw_pml'); ?></h3>
		<p class="description"><?php esc_html_e('Adjust your own CSS for all of your Portfolio Lists. Please use with caution.', 'otw_pml'); ?></p>
		
		
		<textarea name="otw_css" cols="100" rows="35" class="otw-pm-custom-css" ><?php echo esc_textarea( $customCss );?></textarea>
		<p class="submit">
			<input type="submit" value="<?php esc_html_e( 'Save', 'otw_pml') ?>" name="submit" class="button button-primary button-hero"/>
		</p>
		<?php if( isset( $import_from_light ) && $import_from_light ){?>
		<br />
		<h3><?php esc_html_e('Import from OTW Portfolio Light', 'otw_pml'); ?></h3>
		<p class="description"><?php esc_html_e( 'This button will import portfolio items from your OTW Portfolio Light plugin into Portfolio Manager Pro.', 'otw_pml') ?></p>
		<br />
		<a href="admin.php?page=otw-pm-import-from-light" class="add-new-h2"><?php esc_html_e('Import from OTW Portfolio Light', 'otw_pml'); ?></a>
		<?php }?>
	</form>
</div>