<?php
	$detail_values = array();
	
	foreach( $portfolio_meta_details as $detail_id => $detail_data ){
		
		$key_name = 'otw_pm_portfolio_detail_'.$detail_id;
		
		$detail_values[ $key_name ] = '';
		
		$meta_value = get_post_meta(  $post->ID, $key_name, true );
		
		if( strlen( trim( $meta_value ) ) ){
			$detail_values[ $key_name ] = $meta_value;
		}
		
		if( otw_post( $key_name, false ) ){
			$detail_values[ $key_name ] = otw_post( $key_name, '' );
		}
	}
?>
<input type="hidden" name="otw_pm_meta_details" value="1" />
<i><?php esc_html_e( 'HTML is enabled for all details fields.', 'otw_pml' )?></i>
<table class="form-table">
	<tbody>
		<?php foreach( $portfolio_meta_details as $detail_id => $detail_data ){ $key_name = 'otw_pm_portfolio_detail_'.$detail_id; ?>
			<tr valign="top">
				<th>
					<label for="<?php echo esc_attr( $key_name )?>"><?php echo esc_html( $detail_data['title'] );?></label>
				</th>
				<td>
					<input type="text" id="<?php echo esc_attr( $key_name )?>" name="<?php echo esc_attr( $key_name )?>" value="<?php echo otw_htmlentities( $detail_values[ $key_name ] ) ?>" size="63"/>
				</td>
			</tr>
		<?php }?>
	</tbody>
</table>