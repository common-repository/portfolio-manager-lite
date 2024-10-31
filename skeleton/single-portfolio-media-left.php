<?php get_header()?>
	<!-- Wrapper with sidebar -->
	<div class="otw-row">
		<section class="otw-twentyfour otw-columns">
			<!-- Single Project -->
			<div class="otw_portfolio_manager-portfolio-full otw_portfolio_manager-single-project">
				<div class="pm_clear otw_portfolio_manager-mb15"></div>
				<!-- Project Title -->
				<?php if( $otw_pm_posts['otw_pm_item_title'] == 'yes' ){?>
				<?php echo $this->getTitle( $otw_pm_posts['post'] );?>
				<?php }?>
				<div class="pm_clear otw_portfolio_manager-mb15"></div>
				<div class="otw-row">
					<div class="otw-sixteen otw-columns">
						<?php echo $this->getItemMedia( $otw_pm_posts ) ?>
					</div>
					<div class="otw-eight otw-columns">
						<h3 class="otw_portfolio_manager-mb25">
							<?php if( !empty( $otw_pm_posts['otw_pm_plugin_options']['otw_pm_description_title_text'] ) ){?>
								<?php echo $otw_pm_posts['otw_pm_plugin_options']['otw_pm_description_title_text']?>
							<?php }else{ ?>
								<?php esc_html_e( 'Project Description', 'otw_pml' )?>
							<?php }?>
						</h3>
						<div class="otw_portfolio_manager-portfolio-content">
							<p><?php echo otw_esc_text( $otw_pm_posts['post']->post_content, 'cont' );?></p>
						</div>
						<div class="pm_clear otw_portfolio_manager-mb40"></div>
						<h3 class="otw_portfolio_manager-mb25">
							<?php if( !empty( $otw_pm_posts['otw_pm_plugin_options']['otw_pm_details_title_text'] ) ){?>
								<?php echo $otw_pm_posts['otw_pm_plugin_options']['otw_pm_details_title_text']?>
							<?php }else{ ?>
								<?php esc_html_e( 'Project Details', 'otw_pml' )?>
							<?php }?>
						</h3>
						<div class="otw_portfolio_manager-project-info">
							<?php if( is_array( $otw_pm_posts['categories'] ) && count( $otw_pm_posts['categories'] ) ){?>
								<div class="otw_portfolio_manager-project-info-box">
									<h4><?php esc_html_e( 'Categories', 'otw_pml' )?>:</h4>
									<div class="otw_portfolio_manager-project-info-box-content">
										<?php $total_items = count( $otw_pm_posts['categories'] ) - 1;?>
										<?php foreach( $otw_pm_posts['categories'] as $item_num => $cat ){?>
											<?php
												$category = get_term($cat, $this->portfolio_category);
												$catUrl = get_term_link( $category, $this->portfolio_category );
											?>
											<a href="<?= $catUrl?>" rel="tag"><?= $category->name?></a><?php if( $item_num < $total_items ){echo ', ';}?>
										<?php }?>
									</div>
								</div>
							<?php }?>
							<?php if( is_array( $otw_pm_posts['tags'] ) && count( $otw_pm_posts['tags'] ) ){?>
								<div class="otw_portfolio_manager-project-info-box">
									<h4><?php esc_html_e( 'Tags', 'otw_pml' )?>:</h4>
									<div class="otw_portfolio_manager-project-info-box-content">
										<?php $total_items = count( $otw_pm_posts['tags'] ) - 1;?>
										<?php foreach( $otw_pm_posts['tags'] as $item_num => $tag ){?>
											<?php
												$tagUrl = get_term_link( $tag, $this->portfolio_tag );
											?>
											<a href="<?= $tagUrl?>" rel="tag"><?= $tag->name?></a><?php if( $item_num < $total_items ){echo ', ';}?>
										<?php }?>
									</div>
								</div>
							<?php }?>
							<?php foreach( $otw_pm_posts['otw_details'] as $detail_id => $detail ){?>
								<?php if( !empty( $otw_pm_posts['otw_details_value'][ 'otw_pm_portfolio_detail_'.$detail_id ] ) ){?>
									<div class="otw_portfolio_manager-project-info-box">
										<h4><?php echo esc_html( $detail['title'] );?></h4>
										<div class="otw_portfolio_manager-project-info-box-content">
											<?php echo $otw_pm_posts['otw_details_value'][ 'otw_pm_portfolio_detail_'.$detail_id ];?>
										</div>
									</div>
								<?php }?>
							<?php }?>
						</div>

					</div>
				</div>
				<div class="pm_clear"></div>
				<?php echo $this->getSocial( $otw_pm_posts['post'], 'single' ); ?>
				<?php echo $this->getPortfolioPagination( $otw_pm_posts ); ?>
				<?php echo $this->getPortfolioRelatedPosts( $otw_pm_posts ); ?>
			</div>
			
			<!-- End Single Project -->
		</section>
	</div>
	<!-- End Wrapper with sidebar -->
<?php get_footer()?>