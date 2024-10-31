<div class="otw_portfolio_manager-portfolio-content">
<a href="<?php echo esc_attr( get_permalink($post->ID) );?>" class="otw_portfolio_manager-portfolio-continue-reading">
  <?php 
    (!empty($this->listOptions['continue_reading']))?  $read_link = $this->listOptions['continue_reading'] : $read_link = _e('Continue reading →', 'otw_pml');
    echo $read_link;
  ?>
</a>
</div>