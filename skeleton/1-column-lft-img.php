<section class="otw-twentyfour otw-columns icon__small otw-pm-list-section" id="otw-pm-list-<?php echo $this->listOptions['id'];?>">
	<?php echo $this->getViewAll(); ?>
	<?php $imageHover = $this->listOptions['image_hover'];?>
	<div class="otw-row otw_portfolio_manager-portfolio-items-holder otw_portfolio_manager-image-left <?php echo $this->getInfiniteScrollGrid();?>">
		<?php  foreach( $otw_pm_posts->posts as $post ){?>
			<div class="otw-twentyfour otw-columns otw_portfolio_manager-portfolio-item-holder">
				<div class="otw_portfolio_manager-portfolio-full <?php echo $imageHover?> <?php echo $this->containerBG; ?> <?php echo $this->containerBorder; ?>">
					<div class="otw-row">
						<div class="otw-twelve otw-columns">
							<?php $postMetaData = get_post_meta( $post->ID, 'otw_pm_meta_data', true );?>
							<?php echo $this->getMedia( $post, $postMetaData );?>
						</div>
						<div class="otw-twelve otw-columns">
							<?php $items = explode(',', $this->portfolioItems);?>
							<?php foreach( $items as $item ){?>
								
								<?php switch( $item ){
									case 'title':
											echo $this->getTitle( $post );
										break;
									case 'meta':
											echo $this->buildInterfaceMetaItems( $this->metaItems, $post );
										break;
									case 'description':
											echo $this->getContent( $post );
										break;
									case 'continue-reading':
											echo $this->getContinueRead( $post );
										break;
								}?>
							<?php }?>
							
						</div>
					</div>
					
				</div>
				
			</div>
			<?php echo $this->getSocial( $post ); ?>
			<?php echo $this->getDelimiter( $post ); ?>
		<?php }?>
	</div>
	<?php echo $this->getPagination( $otw_pm_posts ); ?>
</section>