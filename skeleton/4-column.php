<section class="otw-twentyfour otw-columns icon__small otw-pm-list-section" id="otw-pm-list-<?php echo $this->listOptions['id'];?>">
	<?php echo $this->getViewAll();?>
	<?php $imageHover = $this->listOptions['image_hover'];?>
	<?php ( $this->listOptions['grid-space-tiles'] )? $spacer = '' : $spacer = ' without-space'; ?>
	<div class="otw_portfolio_manager-grid-layout-wrapper otw_portfolio_manager-portfolio-items-holder pm_clearfix<?php echo $spacer?> <?php echo $this->getInfiniteScrollGrid();?>">
		<?php
			$items = array_chunk( $otw_pm_posts->posts , 4 );
		?>
		<?php foreach( $items as $postItem ){?>
			<div class="otw-row otw_portfolio_manager-portfolio-item-holder">
				<?php foreach( $postItem as $index => $post ){ ?>
				<?php
					$endClass = '';
					if( $index == count($postItem)-1 ){
						$endClass = ' end';
					}
				?>
					<div class="otw-six otw-columns<?php echo $endClass;?>">
						<div class="otw_portfolio_manager-portfolio-full <?php echo $imageHover?> <?php echo $this->containerBG; ?> <?php echo $this->containerBorder; ?>">
							<?php echo $this->buildInterfacePortfolioItems( $post ); ?>
							<?php echo $this->getSocial( $post ); ?>
							<?php echo $this->getDelimiter( $post ); ?>
						</div>
					</div>
				<?php }?>
			</div>
		<?php }?>
	</div>
	<?php echo $this->getPagination( $otw_pm_posts ); ?>
</section>