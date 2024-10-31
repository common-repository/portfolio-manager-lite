<section class="otw-twentyfour otw-columns otw-pm-list-section" id="otw-pm-list-<?php echo $this->listOptions['id'];?>">
	<?php echo $this->getViewAll(); ?>
	<?php $imageHover = $this->listOptions['image_hover'];?>
	<div class="otw-row otw_portfolio_manager-portfolio-items-holder otw_portfolio_manager-portfolio-timeline with-heading pm_clearfix">
	<?php $oldDate = '';?>
	<?php foreach( $otw_pm_posts->posts as $post ){?>
		<div class="otw-twelve otw-columns otw_portfolio_manager-portfolio-timeline-item">
			<?php if ( $oldDate != date('M-Y',strtotime( $post->post_date )) ) : $oldDate = date('M-Y', strtotime( $post->post_date )); ?>
				<h3 class="otw_portfolio_manager-timeline-title"><?php echo date('M Y', strtotime($post->post_date));?></h3>
			<?php endif;?>
			<div class="otw_portfolio_manager-portfolio-full  <?php echo $imageHover?> <?php echo $this->containerBG; ?> <?php echo $this->containerBorder; ?>">
				<?php echo $this->buildInterfacePortfolioItems( $post ); ?>
				<?php echo $this->getSocial( $post ); ?>
				<?php echo $this->getDelimiter( $post ); ?>
			</div>
		</div>
	<?php } ?>
	</div>
	<?php
		$uniqueHash = wp_create_nonce("otw_pm_get_posts_nonce"); 
		$listID = $this->listOptions['id'];
		$page = 2;
		$ajaxURL = admin_url( 'admin-ajax.php?action=get_pm_posts&page='. $page.'&post_id='. $listID .'&nonce='. $uniqueHash );
	?>
	<!-- Infinite Scroll -->
	<div class="otw_portfolio_manager-pagination hide">
		<a href="<?php echo esc_attr( $ajaxURL );?>">2</a>
	</div>
	<!-- End Infinite Scroll -->
</section>