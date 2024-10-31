<aside class="otw_portfolio_manager-sidebar icon__small otw-pm-list-section" id="otw-pm-list-<?php echo $this->listOptions['id'];?>">
	<ul class="pm_clearfix">
		<li class="widget otw_portfolio_manager-widget-portfolio-latest left-image pm_clearfix">
			<?php echo $this->loadWidgetComp( 'list_title' ); ?>
			<ul class="pm_clearfix js-widget-list">
				<?php foreach( $otw_pm_posts->posts as $widgetPost ){?>
					<li class="otw_portfolio_manager-format-image <?php echo $this->containerBG; ?> <?php echo $this->containerBorder; ?>">
						<?php
							$widgetAsset = $this->getPostAsset( $widgetPost );
							$imgAsset = parse_url( $widgetAsset );
							$widgetPostLink = $this->getLink($widgetPost, 'media');
							$this->getMediaProportions();
							$items = explode(',', $this->portfolioItems);
						?>
						<div class="otw-widget-media">
							<?php if( in_array( 'media', $items ) ){?>
								<?php $postMetaData = get_post_meta( $widgetPost->ID, 'otw_pm_meta_data', true );?>
								<?php echo $this->getMedia( $widgetPost, $postMetaData, 'simple_media' );?>
							<?php }?>
						</div>
						<div class="otw-widget-data">
							<?php foreach( $items as $item ){?>
								<?php switch( $item ){
									case 'title':
											echo $this->loadWidgetComp( 'title', $widgetPost );
										break;
									case 'meta':
											echo $this->buildInterfaceMetaItems( $this->metaItems, $widgetPost );
										break;
									case 'description':
											echo $this->loadWidgetComp( 'content', $widgetPost );
										break;
									case 'continue-reading':
											echo $this->getContinueRead( $widgetPost );
										break;
								}?>
							<?php } ?>
						</div>
						<?php echo $this->getDelimiter( $widgetPost ); ?>
					</li>
				<?php } ?>
			</ul>
		</li>
	</ul>
	<div class="js-otw_portfolio_manager-widget-pagination-holder">
		<?php echo $this->getWidgetPagination( $otw_pm_posts ); ?>
	</div>
</aside>