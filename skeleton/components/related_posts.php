<?php  if( isset( $otw_pm_posts->posts ) ){?>
	<?php $details = $postMetaData;?>
	<h3 class="otw_portfolio_manager_related_posts_header">
	<?php if( !empty( $this->otw_pm_plugin_options['otw_pm_related_title_text'] ) ){?>
		<?php echo $this->otw_pm_plugin_options['otw_pm_related_title_text']?>
	<?php }else{ ?>
		<?php esc_html_e( 'Related Projects', 'otw_pml' );?>
	<?php }?>
	</h3>
	<div class="otw_portfolio_manager-slider otw_portfolio_manager-carousel no-control-nav" data-animation="slide" data-item-per-page="<?php echo esc_attr( $details['otw_pm_related_posts_number'] )?>" data-item-margin="20">
		<ul class="slides">
			<?php foreach( $otw_pm_posts->posts as $otw_pm_post ){?>
				<?php $postMetaData = get_post_meta( $otw_pm_post->ID, 'otw_pm_meta_data', true );?>
				<?php 
					$imageWidth = $details['imageRelatedWidth'];
					$imageHeight = $details['imageRelatedHeight'];
					$imageFormat = $details['imageRelatedFormat'];
					$imageCrop = $details['imageRelatedCrop'];
					$imageBigWidth = 1024;
					$imageBigHeight = 640;
					$imageBigCrop = 'center_center';
					$preview_image_href = '';
				?>
				<li class="otw_portfolio_manager_related_posts_holder">
					<div class="otw_portfolio_manager-hover-effect-4 otw_portfolio_manager_related_posts_hover">
						<figure class="otw_portfolio_manager-portfolio-media otw_portfolio_manager-format-image otw_portfolio_manager-related-posts">
						
							<a href="<?php echo get_permalink( $otw_pm_post->ID );?>">
							<?php switch( $postMetaData['media_type'] ){
							
								case 'vimeo':
										echo $this->otwImageCrop->embed_resize( wp_oembed_get($postMetaData['vimeo_url'], array('width' => $imageWidth)), $imageWidth, $imageHeight, $imageCrop );
										$preview_image_href = $postMetaData['vimeo_url'];
									break;
								case 'youtube':
										echo $this->otwImageCrop->embed_resize( wp_oembed_get($postMetaData['youtube_url'], array('width' => $imageWidth)), $imageWidth, $imageHeight, $imageCrop );
										$preview_image_href = $postMetaData['youtube_url'];
									break;
								case 'slider':
										$sliderImages = explode(',', $postMetaData['slider_url']);
										foreach( $sliderImages as $sliderImage ){
											$imagePath = parse_url($sliderImage);?>
											<img src="<?php echo $this->otwImageCrop->resize( $imagePath['path'], $imageWidth, $imageHeight, $imageCrop, true, false, $imageFormat )?>" alt="" data-item="media">
											<?php 
											$preview_image_href = $this->otwImageCrop->resize( $imagePath['path'], $imageBigWidth, $imageBigHeight, $imageBigCrop, true, false, $imageFormat  );
											break;
										}
									break;
								case 'soundcloud':
										echo $this->otwImageCrop->embed_resize( wp_oembed_get($postMetaData['soundcloud_url'], array('width' => $imageWidth ) ), $imageWidth, $imageHeight, $imageCrop );
										$preview_image_href = $postMetaData['soundcloud_url'];
									break;
								case 'img':
										$imagePath = parse_url($postMetaData['img_url']);?>
										<img src="<?php echo $this->otwImageCrop->resize( $imagePath['path'], $imageWidth, $imageHeight, $imageCrop, true, false, $imageFormat  )?>" alt="" data-item="media" />
										<?php
										$preview_image_href = $this->otwImageCrop->resize( $imagePath['path'], $imageBigWidth, $imageBigHeight, $imageBigCrop, true, false, $imageFormat  );
									break;
							}?>
							</a>
							<!-- Portfolio Overlay -->
							<div class="otw_portfolio_manager-portfolio-overlay">
								<!-- Portfolio Icons -->
								<div class="otw_portfolio_manager-portfolio-icon-wrapper">
									<a href="<?php echo get_permalink( $otw_pm_post->ID );?>" class="icon-link"></a>
									<a href="<?php echo esc_attr( $preview_image_href )?>" class="otw_portfolio_manager-fancybox-img icon-search" title="Project Title #1"></a>
								</div>
								<!-- End Portfolio Icons -->
							</div>
							<!-- End Portfolio Overlay -->
							
						</figure>
					</div>
				</li>
			<?php }?>
		</ul>
	</div>
<?php }?>