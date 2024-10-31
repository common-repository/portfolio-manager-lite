<!-- Portfolio Media -->
<?php
	$imgLink = $this->getLink( $post, 'media' );
	$permaLink = get_permalink( $post->ID );
	$itemMediaLink = $this->getListLink( $this->listOptions, $post, 'list_media' );
	
	if( !isset( $this->imageWidth ) || !strlen( $this->imageWidth ) ) { $this->imageWidth = 250; }
	if( !isset( $this->imageHeight ) || !strlen( $this->imageHeight ) ) { $this->imageHeight = 150; }
	
	$imageLightboxWidth = $this->lightboxImageWidth;
	$imageLightboxHeight = $this->lightboxImageHeight;
	$imageLightboxFormat = $this->lightboxImageFormat;
	
	
	$imageHover = $this->listOptions['image_hover'];
	
	$format = 'image';
	
	$icon = 'icon-camera';
	
	if( !isset( $postMetaData['media_type'] ) ){
		$postMetaData['media_type'] = '';
	}
	
	switch( $postMetaData['media_type'] ){
		case 'slider':
				$format = 'gallery';
			break;
	}
	
	$hoverMediaTypes = array( 'img', 'youtube', 'vimeo', 'soundcloud' );
	
	if( isset( $postMetaData['_otw_slider_image'] ) && $postMetaData['_otw_slider_image'] ){
		$hoverMediaTypes[] = 'slider';
		$format = 'image';
	}
	
?>
<figure class="otw_portfolio_manager-portfolio-media otw_portfolio_manager-format-<?php echo $format?>">
	<?php
	switch( $postMetaData['media_type'] ){
		
		case 'slider':
				$icon = 'icon-picture';
				$sliderImages = explode(',', $postMetaData['slider_url']);
				?>
				<?php if( isset( $postMetaData['_otw_slider_image'] ) && $postMetaData['_otw_slider_image'] ){?>
					<?php $imagePath = parse_url( $sliderImages[0] );?>
					<?php if( isset( $sliderImages[0] ) ){?>
						<?php if( isset( $this->listOptions['image_link'] ) && in_array( $this->listOptions['image_link'], array( 'lightbox' ) ) ){?>
							<?php $first_shown = false; ?>
							<?php foreach( $sliderImages as $sImage ){?>
								<?php $imagePath = parse_url( $sImage );?>
								<a href="<?php echo $this->otwImageCrop->resize( $imagePath['path'], $imageLightboxWidth, $imageLightboxHeight, $this->imageCrop, $this->imageWhiteSpaces, $this->imageBackground, $imageLightboxFormat )?>" rel="otw_fslide_<?php echo esc_attr( $post->ID )?>" title="<?php echo htmlentities( $post->post_title );?>" class="otw_in_slider otw_in_slider_<?php echo intval( $first_shown )?>" >
									<?php if( !$first_shown ){?>
										<img src="<?php echo $this->otwImageCrop->resize( $imagePath['path'], $this->imageWidth, $this->imageHeight, $this->imageCrop, $this->imageWhiteSpaces, $this->imageBackground, $this->imageFormat )?>" alt="" />
									<?php } ?>
								</a>
								<?php $first_shown = true;?>
							<?php }?>
						<?php }elseif( isset( $this->listOptions['image_link'] ) && in_array( $this->listOptions['image_link'], array( 'single' ) ) ){?>
							<a href="<?php echo esc_attr( $permaLink )?>">
								<img src="<?php echo $this->otwImageCrop->resize( $imagePath['path'], $this->imageWidth, $this->imageHeight, $this->imageCrop, $this->imageWhiteSpaces, $this->imageBackground, $this->imageFormat )?>" alt="" />
							</a>
						<?php }else{ ?>
							<img src="<?php echo $this->otwImageCrop->resize( $imagePath['path'], $this->imageWidth, $this->imageHeight, $this->imageCrop, $this->imageWhiteSpaces, $this->imageBackground, $this->imageFormat )?>" alt="" />
						<?php }?>
					<?php }?>
				<?php }else{?>
					<div class="otw_portfolio_manager-slider" data-animation="slide">
						<ul class="slides otw_portfolio_ul_slider">
							<?php foreach( $sliderImages as $sliderImage ){?>
								<li>
								<?php
									$imagePath = parse_url($sliderImage);
									$sliderImgLink = false;
								?>
								<?php if( isset( $this->listOptions['image_link'] ) && in_array( $this->listOptions['image_link'], array( 'lightbox' ) ) ){ $sliderImgLink = true;?>
									<a href="<?php echo esc_attr( $sliderImage )?>" rel="otw_fslide_<?php echo esc_attr( $post->ID )?>" class="otw_portfolio_manager-fancybox-slider" title="<?php echo htmlentities( $post->post_title );?>">
								<?php }?>
								<?php if( isset( $this->listOptions['image_link'] ) && in_array( $this->listOptions['image_link'], array( 'single' ) ) ){ $sliderImgLink = true;?>
									<a href="<?php echo esc_attr( $imgLink )?>" title="<?php echo esc_attr( $post->post_title );?>">
								<?php }?>
								<img src="<?php echo $this->otwImageCrop->resize( $imagePath['path'], $this->imageWidth, $this->imageHeight, $this->imageCrop, $this->imageWhiteSpaces, $this->imageBackground, $this->imageFormat )?>" alt="" data-item="media">
								<?php if( $sliderImgLink ){?>
									</a>
								<?php }?>
								</li>
							<?php }?>
							</ul>
						</div>
					<?php }?>
					
				<?php
			break;
		case 'youtube':?>
				<?php if( isset( $this->listOptions['image_link'] ) && in_array( $this->listOptions['image_link'], array( 'lightbox' ) ) ){?>
					<a href="javascript:;" rel="<?php echo esc_attr( $itemMediaLink )?>" class="otw_portfolio_manager_video_link otw_portfolio_manager-fancybox-movie-wrap" title="<?php echo htmlentities( $post->post_title );?>"></a>
				<?php }elseif( isset( $this->listOptions['image_link'] ) && in_array( $this->listOptions['image_link'], array( 'single' ) ) ){?>
					<a href="<?php echo esc_attr( $imgLink )?>" class="otw_portfolio_manager_video_link"></a>
				<?php }elseif( $imageHover != 'hover-none' ){?>
					<a href="javascript:;" class="otw_portfolio_manager_video_link"></a>
				<?php }?>
				<?php echo $this->otwImageCrop->embed_resize( wp_oembed_get($postMetaData['youtube_url'], array('width' => $this->imageWidth)), $this->imageWidth, $this->imageHeight, $this->imageCrop );
				$icon = 'icon-facetime-video';
			break;
		case 'vimeo':?>
		
		
				<?php if( isset( $this->listOptions['image_link'] ) && in_array( $this->listOptions['image_link'], array( 'lightbox' ) ) ){?>
					<a href="javascript:;" rel="<?php echo esc_attr( $itemMediaLink )?>" class="otw_portfolio_manager_video_link otw_portfolio_manager-fancybox-movie-wrap" title="<?php echo htmlentities( $post->post_title );?>"></a>
				<?php }elseif( isset( $this->listOptions['image_link'] ) && in_array( $this->listOptions['image_link'], array( 'single' ) ) ){?>
					<a href="<?php echo esc_attr( $imgLink )?>" class="otw_portfolio_manager_video_link"></a>
				<?php }elseif( $imageHover != 'hover-none' ){?>
					<a href="javascript:;" class="otw_portfolio_manager_video_link"></a>
				<?php }?>
				<?php echo $this->otwImageCrop->embed_resize( wp_oembed_get($postMetaData['vimeo_url'], array('width' => $this->imageWidth)), $this->imageWidth, $this->imageHeight, $this->imageCrop );
				$icon = 'icon-facetime-video';
			break;
		case 'soundcloud':?>
				<?php if( isset( $this->listOptions['image_link'] ) && in_array( $this->listOptions['image_link'], array( 'lightbox' ) ) ){?>
					<a href="javascript:;" rel="<?php echo esc_attr( $itemMediaLink )?>" class="otw_portfolio_manager_video_link otw_portfolio_manager-fancybox-movie-wrap" title="<?php echo htmlentities( $post->post_title );?>"></a>
				<?php }elseif( isset( $this->listOptions['image_link'] ) && in_array( $this->listOptions['image_link'], array( 'single' ) ) ){?>
					<a href="<?php echo esc_attr( $imgLink )?>" class="otw_portfolio_manager_video_link"></a>
				<?php }elseif( $imageHover != 'hover-none' ){?>
					<a href="javascript:;" class="otw_portfolio_manager_video_link"></a>
				<?php } ?>
				<?php echo $this->otwImageCrop->embed_resize( wp_oembed_get($postMetaData['soundcloud_url'], array('width' => $this->imageWidth, 'height' => $this->imageHeight )), $this->imageWidth, $this->imageHeight, $this->imageCrop );
				
				$icon = 'icon-music';
			break;
		case 'img':
				$imagePath = parse_url($postMetaData['img_url']);
				if( !empty($imgLink) ){
					?>
						<a href="<?php echo esc_attr( $imgLink )?>" title="<?php echo htmlentities( $post->post_title );?>">
							<img src="<?php echo $this->otwImageCrop->resize( $imagePath['path'], $this->imageWidth, $this->imageHeight, $this->imageCrop, $this->imageWhiteSpaces, $this->imageBackground, $this->imageFormat )?>" alt="" />
						</a>
					<?php
				}elseif( $imageHover != 'hover-none' ){
					?>
						<a href="javascript:;">
							<img src="<?php echo $this->otwImageCrop->resize( $imagePath['path'], $this->imageWidth, $this->imageHeight, $this->imageCrop, $this->imageWhiteSpaces, $this->imageBackground, $this->imageFormat )?>" alt="" />
						</a>
					<?php
				}else{
					?>
					<img src="<?php echo $this->otwImageCrop->resize( $imagePath['path'], $this->imageWidth, $this->imageHeight, $this->imageCrop, $this->imageWhiteSpaces, $this->imageBackground, $this->imageFormat )?>" alt="" />
					<?php
				}
			break;
	}
	?>
	<?php if( in_array( $postMetaData['media_type'], $hoverMediaTypes ) ){?>
		<?php switch( $imageHover ){
			
		}?>
	<?php }?>
	<?php if( $this->listOptions['show-post-icon'] ) : ?>
		<div class="otw_portfolio_manager-portfolio-type">
			<i class="<?php echo esc_attr( $icon );?>"></i>
		</div>
	<?php endif; ?>
</figure>
<div class="pm_clear"></div>