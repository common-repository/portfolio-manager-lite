<?php 
if( $this->listOptions['show-pagination'] == 'pagination' && !empty( $this->listOptions['posts_limit_page'] ) ) :
  // If we have more then one Page, show pagination
  if( $otw_pm_posts->max_num_pages > 1 ) :

    $big = 99999;
    $currentPage = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

    $pagedArgs = array(
      'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      'format'        => '?paged=%#%',
      'current'       => max( 1, get_query_var('paged') ),
      'total'         => $otw_pm_posts->max_num_pages,
      'show_all'      => false,
      'end_size'      => 2,
      'mid_size'      => 3,
      'prev_next'     => true,
      'prev_text'     => esc_html__('« Previous', 'otw_pml'),
      'next_text'     => esc_html__('Next »', 'otw_pml'),
      'type'          => 'array',
      'add_args'      => false,
      'add_fragment'  => ''
    );  

    $pages = paginate_links( $pagedArgs );
?>
    <div class="otw_portfolio_manager-pagination">
      <span class="pages">
        <?php
          esc_html_e('Page', 'otw_pml');
          echo ' '.$currentPage.' ';
          _e('of', 'otw_pml');
          echo ' '.$otw_pm_posts->max_num_pages;
        ?>
      </span>
      <?php 
        foreach( $pages as $page ): 
          echo $page;
        endforeach;
      ?>
    </div>
<?php 
  endif;
endif;
?>

<!-- Load More Pagination -->
<?php 
  $newsArray = array( '2-column-news', '3-column-news', '4-column-news', '1-3-mosaic', '1-4-mosaic' );

  $paginationClass = 'otw_portfolio_manager-pagination';
  $paginationLoadMore = 'otw_portfolio_manager-load-more';

  if( in_array( $this->listOptions['template'], $newsArray ) ) {
    $paginationClass = 'otw_portfolio_manager-load-more-newspapper';
    $paginationLoadMore = 'otw_portfolio_manager-load-more-newspapper';
  }
  
  if( $this->listOptions['show-pagination'] == 'load-more' && !empty( $this->listOptions['posts_limit_page'] ) ) :

    $uniqueHash = wp_create_nonce("otw_pm_get_posts_nonce"); 
    $listID = $this->listOptions['id'];
    // $paginationPage is set from the otw_portfolio_manager.php
    ( !isset($paginationPage) )? $page = 2 : $page = $paginationPage;

    $ajaxURL = admin_url( 'admin-ajax.php?action=get_pm_posts&post_id='. $listID .'&nonce='. $uniqueHash .'&page='. $page );
?>
<div class="js-pagination_container">
	<div class="<?php echo $paginationClass;?> hide">
		<a href="<?php echo esc_attr( $ajaxURL );?>" class="js-pagination-no"><?php echo esc_html( $page );?></a>
	</div>
	<div class="<?php echo $paginationLoadMore;?> js-otw_portfolio_manager-load-more">
		<a href="<?php echo esc_attr( $ajaxURL );?>" data-empty="<?php esc_html_e('No more items to load.', 'otw_pml');?>" data-isotope="true"><?php esc_html_e('Load More', 'otw_pml');?></a>
	</div>
</div>
<?php endif; ?>
<!-- End Load More Pagination -->
<?php 
  if( $this->listOptions['show-pagination'] == 'infinit-scroll' && !empty( $this->listOptions['posts_limit_page'] )) : 
    $uniqueHash = wp_create_nonce("otw_pm_get_posts_nonce"); 
    $listID = $this->listOptions['id'];
    
    // $paginationPage is set from the otw_portfolio_manager.php
    ( !isset($paginationPage) )? $page = 2 : $page = $paginationPage;
    $ajaxURL = admin_url( 'admin-ajax.php?action=get_pm_posts&nonce='. $uniqueHash .'&page='. $page.'&post_id='. $listID  );
?>

<!-- Infinite Scroll -->
<div class="otw_portfolio_manager-pagination hide">
  <a href="<?php echo esc_attr( $ajaxURL );?>" data-empty="<?php esc_html_e('No more items to load.', 'otw_pml');?>" data-isotope="true"><?php echo esc_html( $paginationPage ) ?></a>
</div>
<!-- End Infinite Scroll -->
<?php endif; ?>