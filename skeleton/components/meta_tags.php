<?php 
	$tagsArray = wp_get_post_terms( $post->ID, $this->portfolio_tag );
	
if( is_array( $tagsArray ) && !empty($tagsArray[0]) ) :
?>
<div class="otw_portfolio_manager-portfolio-meta-item">  
  <?php if( !$this->listOptions['meta_icons'] ) : ?>
  <span class="head"><?php esc_html_e('Tags:', 'otw_pml');?></span>
  <?php else: ?>
  <span class="head"><i class="icon-tags"></i></span>
  <?php endif; ?>

  <?php
    foreach( $tagsArray as $index => $tag ):
      $tagUrl = get_term_link( $tag, $this->portfolio_tag );
  ?>
  <a href="<?php echo esc_attr( $tagUrl );?>" rel="tag"><?php echo esc_html( $tag->name );?></a> 
  <?php if( $index < count( $tagsArray ) - 1 ) { echo ', '; }?>
  <?php
    endforeach;
  ?>
</div>
<?php endif; ?>