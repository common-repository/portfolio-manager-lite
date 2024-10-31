<!-- Portfolio Title -->
<?php
    $titleLink = $this->getLink($post, 'title');
    
    $postMetaData = get_post_meta( $post->ID, 'otw_pm_meta_data', true );
?>
<div class="otw_portfolio_manager-portfolio-title-wrapper">
	<h3 class="otw_portfolio_manager-portfolio-title">
	
	<?php if( !empty( $titleLink ) ){?>
		<?php if( isset( $this->listOptions['title_link'] ) && in_array( $this->listOptions['title_link'], array( 'lightbox' ) ) ){ $sliderImgLink = true;?>
		
			<?php switch( $postMetaData['media_type'] ){
				
				case 'youtube':
				case 'vimeo':
				case 'soundcloud':?>
						<a href="javascript:;" class="otw_portfolio_manager-fancybox-movie" rel="<?php echo esc_attr( $titleLink ) ?>" ><?php echo esc_html( $post->post_title );?></a>
					<?php break;
				default:?>
						<a href="<?php echo esc_attr( $titleLink );?>" class="otw_portfolio_manager-fancybox-img"><?php echo esc_html( $post->post_title );?></a>
					<?php break;
			}?>
			
		<?php }else{?>
			<a href="<?php echo esc_attr( $titleLink );?>"><?php echo esc_html( $post->post_title );?></a>
		<?php }?>
	<?php }else{?>
		<?php echo $post->post_title;?></a>
	<?php }?>
	</h3>
</div>
<!-- End Portfolio Title -->