<!-- Portfolio Newspaper Filter -->
<div class="otw_portfolio_manager-portfolio-newspaper-filter">
	<ul class="option-set otw_portfolio_manager-portfolio-filter pm_clearfix">
		<li><a href="#" data-filter="*" class="selected"><?php esc_html_e('All', 'otw_pml' )?></a></li>
		<?php 
			$filterCategories = array();
			if( isset( $this->listOptions['all_categories'] ) && strlen( $this->listOptions['all_categories'] ) ){
				
				$exists_categories = get_terms( $this->portfolio_category, array( 'number' => '', 'hide_empty' => false  ) );
				
				if( count( $exists_categories ) ){
					foreach( $exists_categories as $e_cat ){
						$filterCategories[ $e_cat->term_id ] = $e_cat->term_id;
					}
				}
			}elseif( strlen( $this->listOptions['categories'] ) ){
				$filterCategories = explode(',', $this->listOptions['categories']);
			}
			
			foreach( $filterCategories as $filterCategory ){
				$cat = get_term( $filterCategory, $this->portfolio_category );?>
			<li><a href="#" data-filter=".<?php echo $cat->slug;?>"><?php echo esc_html( $cat->name );?></a></li>
		<?php }; ?>
	</ul>
</div>