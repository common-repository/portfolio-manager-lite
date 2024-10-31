<?php
	( $this->listOptions['show-slider-title'] )? $caption = 'has-caption' : $caption = '';
	( $this->listOptions['slider_border'] )? $caption .= ' with-border' : $caption = $caption;
	( $this->listOptions['slider_title_bg'] )? $cationBG = 'with-bg' : $cationBG = '';
	
	$caption .= ' caption-left';
	
?>
<section class="otw-twentyfour otw-columns" id="otw-pm-list-<?php echo $this->listOptions['id'];?>">
	<div class="otw_portfolio_manager-slider <?php echo $caption;?>" data-animation="slide" data-item-per-page="1" data-item-margin="" data-nav="<?php echo esc_attr( $this->listOptions['slider_nav'] );?>" data-auto-slide="<?php echo esc_attr( $this->listOptions['slider-auto-scroll'] );?>" >
		<ul class="slides">
			
			<?php $embededMediaTypes = array('soundcloud', 'vimeo', 'youtube'); ?>
			
			<?php foreach( $otw_pm_posts->posts as $post ){?>
			
				<?php 
					$postAsset  = $this->getPostAsset( $post );
					$asset      = parse_url( $postAsset );
					
					$metaBoxInfo = get_post_meta( $post->ID, 'otw_pm_meta_data', true );
					( !empty( $metaBoxInfo ) )? $postMetaData = $metaBoxInfo : $postMetaData = array('media_type' => '');
					$widgetPostLink = $this->getLink($post, 'media');
					$widgetTitleLink = $this->getLink($post, 'title');
				?>
				<li>
					<figure class="otw_portfolio_manager-portfolio-media">
					<?php echo $this->getMedia( $post, $postMetaData, 'simple_media' ); ?>
					</figure>
						<div class="otw_portfolio_manager-flex-caption otw_portfolio_manager-format-gallery <?php echo $cationBG;?>">
							<h3 class="otw_portfolio_manager-caption-title" data-item="title">
								<?php echo $this->getSliderTitle( $post )?>
							</h3>
							<div class="otw_portfolio_manager-caption-excpert">
								<?php 
									( !empty( $post->post_excerpt ) )? $postContentFull = $post->post_excerpt : $postContentFull = $post->post_content;
									
									$postContent = $postContentFull;
									$strip_tags = false;
									
									if( !isset( $this->listOptions['strip_tags'] ) || ( $this->listOptions['strip_tags'] != 'no' ) ){
										$postContent = strip_tags( $postContent );
										$strip_tags = true;
									}
									
									if( !isset( $this->listOptions['strip_shortcodes'] ) || ( $this->listOptions['strip_shortcodes'] != 'no' ) ){
										$postContent = strip_shortcodes( $postContent );
									}else{
										$postContent = do_shortcode($postContent);
									}
									
									if( !empty( $this->listOptions['excerpt_length'] ) ){
										$postContent = $this->excerptLength( $postContent, $this->listOptions['excerpt_length'], $strip_tags );
									}
									
									echo nl2br( $postContent );
								?>
							</div>
						</div>
				</li>
			<?php } ?>
		</ul>
	</div>
</section>