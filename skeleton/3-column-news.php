<!-- Portfoio 3 Columns -->
<section class="otw-twentyfour otw-columns icon__small otw-pm-list-section" id="otw-pm-list-<?php echo $this->listOptions['id'];?>">
	<?php echo $this->getViewAll(); ?>
	<?php echo $this->getNewsFilter(); ?>
	<?php echo $this->getNewsSort(); ?>
	<?php $imageHover = $this->listOptions['image_hover'];?>
	<?php ( $this->listOptions['newspaper-space-tiles'] )? $spacer = '' : $spacer = ' without-space'; ?>
	<div class="otw-row otw_portfolio_manager-portfolio-items-holder otw_portfolio_manager-portfolio-newspaper<?php echo $spacer;?> <?php echo $this->getInfiniteScroll();?>">
		<?php foreach( $otw_pm_posts->posts as $post ){?>
			<?php
				$categoriesString = '';
				
				$postCategories = wp_get_post_terms( $post->ID, $this->portfolio_category );
				foreach( $postCategories as $postCategory ){
					$categoriesString .= $postCategory->slug.' ';
				}
			?>
			<div class="otw-eight otw-columns otw_portfolio_manager-portfolio-newspaper-item <?php echo $categoriesString; ?>" data-title="<?php echo esc_attr( $post->post_name )?>" data-date="<?php echo esc_attr( $post->post_date )?>">
				<div class="otw_portfolio_manager-portfolio-full <?php echo $imageHover?> <?php echo $this->containerBG; ?> <?php echo $this->containerBorder; ?>">
					<?php echo $this->buildInterfacePortfolioItems( $post ); ?>
					<?php echo $this->getSocial( $post ); ?>
					<?php echo $this->getDelimiter( $post ); ?>
				</div>
			</div>
		<?php }?>
	</div>
	<?php echo $this->getPagination( $otw_pm_posts ); ?>
</section>