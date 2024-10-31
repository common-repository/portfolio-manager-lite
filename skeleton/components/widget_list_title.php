<?php if( !empty($this->listOptions['portfolio_list_title']) ) : ?>
<!-- Widget List Title -->
<h3 class="widget-title"><?php echo esc_html( $this->listOptions['portfolio_list_title'] );?></h3>
<!-- End Widget List Title -->
<?php endif; ?>

<?php 
if( !empty($this->listOptions['view_all_page']) || !empty($this->listOptions['view_all_page_link']) ) : 
  
  ( empty($this->listOptions['view_all_page_text']) )? $view_all_msg = esc_html__('View All', 'otw_pml') : $view_all_msg = $this->listOptions['view_all_page_text'];
  ( !empty($this->listOptions['view_all_page']) )? $page_link = get_page_link($this->listOptions['view_all_page']) : $page_link = $this->listOptions['view_all_page_link'];

?>
<a href="<?php echo esc_attr( $page_link );?>" target="<?php echo esc_attr( $this->listOptions['view_all_target'] );?>" class="pm_clearfix otw_portfolio_manager-view-all-widget"><?php echo esc_html( $view_all_msg ); ?></a>
<?php endif;?>