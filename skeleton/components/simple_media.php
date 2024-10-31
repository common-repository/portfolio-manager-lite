<!-- Portfolio Media -->
<?php
	$imgLink = $this->getLink( $post, 'media' );
	$permaLink = get_permalink( $post->ID );
	$itemMediaLink = $this->getListLink( $this->listOptions, $post, 'list_media' );
	
	if( !isset( $this->imageWidth ) || !strlen( $this->imageWidth ) ) { $this->imageWidth = 250; }
	if( !isset( $this->imageHeight ) || !strlen( $this->imageHeight ) ) { $this->imageHeight = 150; }
	
	$imageHover = $this->listOptions['image_hover'];
	
	$imageLightboxWidth = $this->lightboxImageWidth;
	$imageLightboxHeight = $this->lightboxImageHeight;
	$imageLightboxFormat = $this->lightboxImageFormat;
	
	if( !isset( $postMetaData['media_type'] ) ){
		$postMetaData['media_type'] = '';
	}
?>
<?php
	switch( $postMetaData['media_type'] ){
		
		case 'slider':
				$sliderImages = explode(',', $postMetaData['slider_url']);
				if( isset( $sliderImages[0] ) ){?>
					<?php $imagePath = parse_url( $sliderImages[0] );
					
					if( isset( $this->listOptions['image_link'] ) && in_array( $this->listOptions['image_link'], array( 'lightbox' ) ) ){?>
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
				<?php
			break;
		case 'youtube':?>
				<?php if( isset( $this->listOptions['image_link'] ) && in_array( $this->listOptions['image_link'], array( 'lightbox' ) ) ){?>
					<a href="javascript:;" rel="<?php echo esc_attr( $itemMediaLink )?>" class="otw_portfolio_manager_video_link otw_portfolio_manager-fancybox-movie-wrap" title="<?php echo htmlentities( $post->post_title );?>"></a>
				<?php }?>
				<?php if( isset( $this->listOptions['image_link'] ) && in_array( $this->listOptions['image_link'], array( 'single' ) ) ){?>
					<a href="<?php echo esc_attr( $permaLink )?>" class="otw_portfolio_manager_video_link"></a>
				<?php }
				echo $this->otwImageCrop->embed_resize( wp_oembed_get($postMetaData['youtube_url'], array('width' => $this->imageWidth)), $this->imageWidth, $this->imageHeight, $this->imageCrop );
			break;
		case 'vimeo':?>
				<?php if( isset( $this->listOptions['image_link'] ) && in_array( $this->listOptions['image_link'], array( 'lightbox' ) ) ){?>
					<a href="javascript:;" rel="<?php echo esc_attr( $itemMediaLink )?>" class="otw_portfolio_manager_video_link otw_portfolio_manager-fancybox-movie-wrap" title="<?php echo htmlentities( $post->post_title );?>"></a>
				<?php }?>
				<?php if( isset( $this->listOptions['image_link'] ) && in_array( $this->listOptions['image_link'], array( 'single' ) ) ){?>
					<a href="<?php echo esc_attr( $permaLink )?>" class="otw_portfolio_manager_video_link"></a>
				<?php }
				echo $this->otwImageCrop->embed_resize( wp_oembed_get($postMetaData['vimeo_url'], array('width' => $this->imageWidth)), $this->imageWidth, $this->imageHeight, $this->imageCrop );
			break;
		case 'soundcloud':?>
				<?php if( isset( $this->listOptions['image_link'] ) && in_array( $this->listOptions['image_link'], array( 'lightbox' ) ) ){?>
					<a href="javascript:;" rel="<?php echo esc_attr( $itemMediaLink )?>" class="otw_portfolio_manager_video_link otw_portfolio_manager-fancybox-movie-wrap" title="<?php echo htmlentities( $post->post_title );?>"></a>
				<?php }?>
				<?php if( isset( $this->listOptions['image_link'] ) && in_array( $this->listOptions['image_link'], array( 'single' ) ) ){?>
					<a href="<?php echo esc_attr( $permaLink )?>" class="otw_portfolio_manager_video_link"></a>
				<?php }
				echo $this->otwImageCrop->embed_resize( wp_oembed_get($postMetaData['soundcloud_url'], array('width' => $this->imageWidth, 'height' => $this->imageHeight )), $this->imageWidth, $this->imageHeight, $this->imageCrop );
			break;
		case 'img':
				$imagePath = parse_url($postMetaData['img_url']);
				
				if( isset( $this->listOptions['image_link'] ) && in_array( $this->listOptions['image_link'], array( 'lightbox' ) ) ){?>
					<a href="<?php echo $this->otwImageCrop->resize( $imagePath['path'], $imageLightboxWidth, $imageLightboxHeight, $this->imageCrop, $this->imageWhiteSpaces, $this->imageBackground, $imageLightboxFormat )?>" title="<?php echo htmlentities( $post->post_title );?>">
						<img src="<?php echo $this->otwImageCrop->resize( $imagePath['path'], $this->imageWidth, $this->imageHeight, $this->imageCrop, $this->imageWhiteSpaces, $this->imageBackground, $this->imageFormat )?>" alt="" />
					</a>
				<?php }elseif( isset( $this->listOptions['image_link'] ) && in_array( $this->listOptions['image_link'], array( 'single' ) ) ){?>
					<a href="<?php echo esc_attr( $permaLink )?>">
						<img src="<?php echo $this->otwImageCrop->resize( $imagePath['path'], $this->imageWidth, $this->imageHeight, $this->imageCrop, $this->imageWhiteSpaces, $this->imageBackground, $this->imageFormat )?>" alt="" />
					</a>
				<?php }else{
					?>
					<img src="<?php echo $this->otwImageCrop->resize( $imagePath['path'], $this->imageWidth, $this->imageHeight, $this->imageCrop, $this->imageWhiteSpaces, $this->imageBackground, $this->imageFormat )?>" alt="" />
					<?php
				}
			break;
	}
?>