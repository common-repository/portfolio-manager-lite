<!-- Carousel 3 Columns -->
<?php
	( $this->listOptions['show-slider-title'] )? $caption = 'has-caption' : $caption = '';
	( $this->listOptions['slider_border'] )? $caption .= ' with-border' : $caption = $caption;
	( $this->listOptions['slider_title_bg'] )? $cationBG = 'with-bg' : $cationBG = '';
	
	$caption .= ' caption-left';
?>
<div class="otw_portfolio_manager-slider  otw_portfolio_manager-carousel <?php echo $caption;?>" id="otw-pm-list-<?php echo $this->listOptions['id'];?>" data-animation="slide" data-item-per-page="3" data-item-margin="20" data-nav="<?php echo esc_attr( $this->listOptions['slider_nav'] );?>" data-auto-slide="<?php echo esc_attr( $this->listOptions['slider-auto-scroll'] );?>">
	<ul class="slides">
		<?php $embededMediaTypes = array('soundcloud', 'vimeo', 'youtube');?>
		<?php foreach( $otw_pm_posts->posts as $post ){?>
		<?php 
			$widgetTitleLink = $this->getLink($post, 'title' );
			
			$metaBoxInfo = get_post_meta( $post->ID, 'otw_pm_meta_data', true );
			( !empty( $metaBoxInfo ) )? $postMetaData = $metaBoxInfo : $postMetaData = array('media_type' => '');
			
		?>
		<li>
			<div class="otw_portfolio_manager-portfolio-media">
				<?php echo $this->getMedia( $post, $postMetaData, 'simple_media'); ?>
				<div class="otw_portfolio_manager-flex-caption otw_portfolio_manager-flex-caption--small <?php echo $cationBG;?>">
					<h3 class="otw_portfolio_manager-caption-title otw_portfolio_manager--small-title" data-item="title">
						<?php echo $this->getSliderTitle( $post )?>
					</h3>
				</div> <!-- End Caption -->
			</div>
		</li>
		<?php }?>
	</ul>
</div>