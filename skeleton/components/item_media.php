
<?php switch( $post['postMetaData']['media_type'] ){
	case 'slider':?>
		<?php $sliderImages = explode(',', $post['postMetaData']['slider_url']); ?>
		<div class="otw_portfolio_manager-slider otw_portfolio_manager-format-gallery" data-animation="slide">
			<ul class="slides">
				<?php foreach( $sliderImages as $sliderImage ){?>
				<?php $imagePath = parse_url($sliderImage); ?>
					<li>
						<img src="<?php echo $this->otwImageCrop->resize( $imagePath['path'], $post['imageWidth'], $post['imageHeight'], $post['imageCrop'], $post['imageWhiteSpaces'], $post['imageBackground'], $post['imageFormat'] )?>" alt="" data-item="media">
					</li>
				<?php }?>
			</ul>
		</div>
		<?php break;
	case 'img':?>
		<?php $imagePath = parse_url($post['postMetaData']['img_url']);?>
			<figure class="otw_portfolio_manager-portfolio-media otw_portfolio_manager-format-image">
				<img src="<?php echo $this->otwImageCrop->resize( $imagePath['path'], $post['imageWidth'], $post['imageHeight'], $post['imageCrop'], $post['imageWhiteSpaces'], $post['imageBackground'], $post['imageFormat'] )?>" alt="" />
			</figure>
		<?php break;
	case 'soundcloud':?>
			<figure class="otw_portfolio_manager-portfolio-media otw_portfolio_manager-format-video">
				<?php echo $this->otwImageCrop->embed_resize( wp_oembed_get($post['postMetaData']['soundcloud_url'], array('width' => $post['imageWidth'])), $post['imageWidth'], $post['imageHeight'], $post['imageCrop'] );?>
			</figure>
		<?php break;
	case 'vimeo':?>
			<figure class="otw_portfolio_manager-portfolio-media otw_portfolio_manager-format-video">
				<?php echo $this->otwImageCrop->embed_resize( wp_oembed_get($post['postMetaData']['vimeo_url'], array('width' => $post['imageWidth'])), $post['imageWidth'], $post['imageHeight'], $post['imageCrop'] );?>
			</figure>
		<?php break;
	case 'youtube':?>
			<figure class="otw_portfolio_manager-portfolio-media otw_portfolio_manager-format-video">
				<?php echo $this->otwImageCrop->embed_resize( wp_oembed_get($post['postMetaData']['youtube_url'], array('width' => $post['imageWidth'])), $post['imageWidth'], $post['imageHeight'], $post['imageCrop'] );?>
			</figure>
		<?php break;
}?>
<!-- End Portfolio Media -->