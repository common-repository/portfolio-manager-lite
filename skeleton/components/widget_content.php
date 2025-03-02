<!-- Widget Content -->
<div class="otw_portfolio_manager-portfolio-content">
	<p>
	<?php
	( !empty( $widgetPost->post_excerpt ) )? $postContentFull = $widgetPost->post_excerpt : $postContentFull = $widgetPost->post_content;
	
	$postContent = $postContentFull;
	$strip_tags = false;
	
	if( !isset( $this->listOptions['strip_tags'] ) || ( $this->listOptions['strip_tags'] != 'no' ) ){
		$postContent = strip_tags( $postContent );
		$strip_tags = true;
	}
	
	if( !isset( $this->listOptions['strip_shortcodes'] ) || ( $this->listOptions['strip_shortcodes'] != 'no' ) ){
		$postContent = strip_shortcodes( $postContent );
	}else{
		$postContent = do_shortcode( $postContent );
	}
	
	if( !empty( $this->listOptions['excerpt_length'] ) ){
		$postContent = $this->excerptLength( $postContent, $this->listOptions['excerpt_length'], $strip_tags );
	}
	
	echo nl2br( $postContent );
	?>
	</p>
</div>
<!-- End Widget Content -->