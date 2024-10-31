<?php
	$_wp_column_headers['toplevel_page_otw-pm'] = array(
	'title' => __( 'Title', OTW_PML_TRANSLATION ),
	'order' => __( 'Order', OTW_PML_TRANSLATION )
);
?>
<div class="wrap">
	<div id="icon-options-general" class="icon32"></div>
	<h2><?php _e('Portfolio Items Details', OTW_PML_TRANSLATION); ?>
	<a class="button add-new-h2 otw_disabled" href="javascript:;" disabled="disabled"><?php _e('Add New', OTW_PML_TRANSLATION) ?></a>
	</h2>
	<div id="icon-options-general" class="icon32"></div>
	<p class="description"><?php _e('The following details will be available for each of your portfolio items.', OTW_PML_TRANSLATION); ?></p>
	<div class="otw_pro_feature"><p><?php _e('This feature is available in the Pro version.', OTW_PML_TRANSLATION); ?></p></div><br />
	<?php if( is_array( $details ) && count( $details ) ){?>
		<table class="widefat fixed" cellspacing="0">
			<thead>
				<tr>
					<?php foreach( $_wp_column_headers['toplevel_page_otw-pm'] as $key => $name ){?>
						<th><?php echo $name?></th>
					<?php }?>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<?php foreach( $_wp_column_headers['toplevel_page_otw-pm'] as $key => $name ){?>
						<th><?php echo $name?></th>
					<?php }?>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach( $details as $d_key => $d_item ){?>
					<tr>
						<?php foreach( $_wp_column_headers['toplevel_page_otw-pm'] as $column_name => $column_title ){
							
							$edit_link = 'javascript:;';
							$delete_link = 'javascript:;';
							
							switch($column_name) {
								
								case 'title':
										echo '<td><strong><a href="'.$edit_link.'" title="'.esc_attr(sprintf(__('Edit &#8220;%s&#8221;', OTW_PML_TRANSLATION), $d_item['title'])).'" class="otw_disabled">'.$d_item['title'].'</a></strong><br />';
										echo '<div class="row-actions">';
											echo '<a href="'.$edit_link.'" class="otw_disabled">' . __('Edit', OTW_PML_TRANSLATION) . '</a>';
											echo ' | <a href="'.$delete_link.'" class="otw_disabled">' . __('Delete', OTW_PML_TRANSLATION). '</a>';
											echo '</div>';
										echo '</td>';
									break;
								case 'order':
										echo '<td>'.$d_item['order'].'</td>';
									break;
							}?>
						<?php }?>
					</tr>
				<?php }?>
			</tbody>
		</table>
	<?php }else{?>
		<p><?php _e('No details available.', OTW_PML_TRANSLATION)?></p>
	<?php }?>
</div>