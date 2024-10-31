<section class="otw-twentyfour otw-columns otw-pm-list-section" id="otw-pm-list-<?php echo $this->listOptions['id'];?>">
	<?php echo $this->getViewAll();?>
	<div class="otw_portfolio_manager-grid-layout-wrapper pm_clearfix otw_portfolio_manager-portfolio-items-holder <?php echo $this->getInfiniteScrollGrid();?>">
		<?php  foreach( $otw_pm_posts->posts as $post ){
			$imageHover = $this->listOptions['image_hover'];
		?>
			<div class="otw-row otw_portfolio_manager-portfolio-item-holder">
				<div class="otw-twentyfour otw-columns">
					<div class="otw-twentyfour otw-columns">
						<div class="otw_portfolio_manager-portfolio-full <?php echo $imageHover?> <?php echo $this->containerBG; ?> <?php echo $this->containerBorder; ?>">
							<?php echo $this->buildInterfacePortfolioItems( $post ); ?>
							<?php echo $this->getSocial( $post ); ?>
							<?php echo $this->getDelimiter( $post ); ?>
						</div>
					</div>
				</div>
			</div>
		<?php }?>
	</div>
	<?php echo $this->getPagination( $otw_pm_posts ); ?>
</section>