<?php
	$_wp_column_headers['toplevel_page_otw-pm'] = array(
		'list_name'			=> esc_html__( 'Portfolio List Name', 'otw_pml' ),
		'shortcode'			=> esc_html__( 'Short Code', 'otw_pml' ),
		'user_id'				=> esc_html__( 'Author', 'otw_pml' ),
		'date_created'	=> esc_html__( 'Created', 'otw_pml' ),
		'date_modified'	=> esc_html__( 'Modified', 'otw_pml' ),
	);
?>
<div class="wrap">
	<div id="icon-edit" class="icon32"></div>
	<h2>
		<?php esc_html_e('Portfolio Lists', 'otw_pml'); ?>
		<a class="add-new-h2" href="admin.php?page=otw-pml-add"><?php esc_html_e('Add List', 'otw_pml');?></a>
	</h2>
	<?php
		if( !empty( $action['success'] ) && $action['success'] == 'true' ) {
			$message = esc_html__('Item was saved.', 'otw_pml');
			echo '<div class="updated"><p>'.$message.'</p></div>';
		}

		if( !empty( $action['success_css'] ) && $action['success_css'] == 'true' ) {
			$message = esc_html__('Options page has been saved.', 'otw_pml');
			echo '<div class="updated"><p>'.$message.'</p></div>';
		}

			if( $writableError ) {
				$message = esc_html__('The folder \'wp-content/uploads/\' is not writable. Please make sure you add read/write permissions to this folder.', 'otw_pml');
				echo '<div class="error"><p>'.$message.'</p></div>';
			}

			if( $writableCssError ) {
				$message = esc_html__('The file \''.SKIN_PML_PATH.'\' is not writable. Please make sure you add read/write permissions to this file.', 'otw_pml');
				echo '<div class="error"><p>'.$message.'</p></div>';
			}
	?>

	<?php 
		if( !is_array( $otw_pm_lists ) || !empty( $otw_pm_lists['otw-pm-list'] ) || $otw_pm_lists['otw-pm-list'] == false ) :
		
		if( is_array( $otw_pm_lists ) && is_array(  $otw_pm_lists['otw-pm-list'] ) ){
			$arraySearch = array_keys( $otw_pm_lists['otw-pm-list'] );
		}else if( !isset( $arraySearch ) ){
			$arraySearch = array();
		}
		
		if( preg_grep('/^otw-pm-list-.*/', $arraySearch) ) {
	?>

	<table class="widefat fixed" cellspacing="0">
		<thead>
			<tr>
				<?php foreach( $_wp_column_headers['toplevel_page_otw-pm'] as $key => $name ){?>
					<th><?php echo esc_html( $name )?></th>
				<?php }?>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<?php foreach( $_wp_column_headers['toplevel_page_otw-pm'] as $key => $name ){?>
					<th><?php echo esc_html( $name )?></th>
				<?php }?>
			</tr>
		</tfoot>
		<tbody>
			<?php 
				$index = 0;
				foreach( $otw_pm_lists['otw-pm-list'] as $otw_pm_item ): 
					
					if( is_array($otw_pm_item) ) {

						$user_info = get_userdata( $otw_pm_item['user_id'] );

						//Used to add color to even rows
						$alternate = '';
						if( $index % 2 == 0 ) {
							$alternate = 'class="alternate"';	
						}

						$edit_link = admin_url( 'admin.php?page=otw-pml-add&amp;action=edit&amp;otw-pm-list-id='.$otw_pm_item['id'] );
						$delete_link = admin_url( 'admin.php?page=otw-pml&amp;action=delete&amp;otw-pm-list-id='.$otw_pm_item['id'] );
						$duplicate_link = admin_url( 'admin.php?page=otw-pml-copy&amp;otw-pm-list-id='.$otw_pm_item['id'] );
			?>
			<tr <?php echo $alternate;?> >
				<td>
					<?php echo '<a href="'.esc_attr( $edit_link ).'">' . $otw_pm_item['list_name'] . '</a>'; ?>
					<div class="row-actions">
					<?php
						echo '<a href="'.esc_attr( $edit_link ).'">' . esc_html__('Edit', 'otw_pml') . '</a>';
						echo ' | <a href="'.esc_attr( $delete_link ).'" data-name="'. esc_attr( $otw_pm_item['list_name']  ).'" class="js-delete-item">' . esc_html__('Delete', 'otw_pml'). '</a>';
						echo ' | <a href="'.esc_attr( $duplicate_link ).'" data-name="'. esc_attr( $otw_pm_item['list_name']  ).'" class="js-duplicate-item">' . esc_html__('Duplicate', 'otw_pml'). '</a>';
					?>
					</div>
				</td>
				<td><?php echo '[otw-pm-list id="'.esc_attr( $otw_pm_item['id'] ).'"]'; ?></td>
				<td><?php echo esc_html( $user_info->display_name );?></td>
				<td><?php echo date( get_option( 'date_format' ), strtotime( $otw_pm_item['date_created'] ) );?></td>
				<td><?php echo date( get_option( 'date_format' ), strtotime( $otw_pm_item['date_modified'] ) );?></td>
			</tr>
			<?php 
				$index++;
				} //End if Array item
				endforeach; 
			?>
		</tbody>
	</table>

	<?php }else{ ?>
		<?php 
			$add_link = $edit_link = admin_url( 'admin.php?page=otw-pml-add' );
		?>
		<p>
			<strong><?php esc_html_e('No custom portfolio list found.', 'otw_pml')?></strong>
			<?php echo '<a href="'.esc_attr( $add_link ).'">' . esc_html__('Add a list', 'otw_pml') . '</a>'; ?>
		</p>

	<?php } ?>
	<?php endif; ?>

</div>