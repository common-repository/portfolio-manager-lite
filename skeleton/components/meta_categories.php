<?php 
	//Get Categories for Current Post
	$catArray = wp_get_post_terms( $post->ID, $this->portfolio_category );
?>
<?php if( is_array( $catArray ) && count( $catArray ) ){?>
	<div class="otw_portfolio_manager-portfolio-meta-item">
		<?php if( !$this->listOptions['meta_icons'] ) : ?>
			<span class="head"><?php esc_html_e('Category:', 'otw_pml');?></span>
		<?php else: ?>
			<span class="head"><i class="icon-folder-open-alt"></i></span>
		<?php endif; ?>
		<?php foreach( $catArray as $index => $cat ){ ?>
			<?php
				$category = get_term($cat, $this->portfolio_category);
				$catUrl = get_term_link( $category, $this->portfolio_category );
			?>
			<a href="<?php echo esc_attr( esc_url($catUrl) );?>" rel="category" title="<?php esc_html_e('View all posts in ', 'otw_pml'); echo $category->name;?>">
			<?php echo $category->name;?>
			</a>
			<?php if( $index < count( $catArray ) - 1 ) { echo ', '; }?>
		<?php }?>
	</div>
<?php }?>