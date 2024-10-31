<!-- Social Share Buttons -->
<?php 
  ( !empty( $post->post_excerpt ) )? $postContentFull = $post->post_excerpt : $postContentFull = $post->post_content;
  
  $socialLink         = get_permalink($post->ID);
  $socialTitle        = $post->post_title;
  $socialDescription  = $this->excerptLength( wp_strip_all_tags( $postContentFull ), $this->listOptions['excerpt_length'] );
  $socialAsset        = $this->getPostAsset( $post );

  $class = '';
  if( $this->listOptions['show-social-icons'] == 'share_btn_small' ) {
    $class = 'small-style';
  }
?>
<?php if( !is_array( $postMetaData ) && ( $postMetaData == 'single' ) ){?>
	<h3 class="otw_portfolio_manager-mb25">
		<?php if( !empty( $this->listOptions['otw_pm_social_title_text'] ) ){?>
			<?php echo $this->listOptions['otw_pm_social_title_text']?>
		<?php }else{ ?>
			<?php esc_html_e( 'Hey, like this? Why not share it with a buddy?', 'otw_pml' )?>
		<?php }?>
	</h3>
<?php }?>
<div 
  class="otw_portfolio_manager-social-share-buttons-wrapper otw_portfolio_manager-social-wrapper <?php echo $class;?> pm_clearfix" 
  data-title="<?php echo esc_attr( $socialTitle );?>"
  data-description="<?php echo esc_html( $socialDescription );?>"
  data-image="<?php echo esc_attr( $socialAsset ); ?>"
  data-url="<?php echo esc_attr( $socialLink );?>">

<?php if( $this->listOptions['show-social-icons'] == 'share_icons' ) : ?>
	<?php if( !empty( $this->listOptions['show-social-icons-facebook'] ) ){?>
		<a class="otw_portfolio_manager-social-item otw-facebook" target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo $socialLink;?>"><i class="icon-facebook" href=""></i></a>
	<?php }?>
	<?php if( !empty( $this->listOptions['show-social-icons-twitter'] ) ){?>
		<a class="otw_portfolio_manager-social-item otw-twitter" target="_blank" href="https://twitter.com/intent/tweet?source=tweetbutton&amp;text=<?php echo esc_attr( $socialTitle );?>&amp;url=<?php echo $socialLink;?>"><i class="icon-twitter" href=""></i></a>
	<?php }?>
	<?php if( !empty( $this->listOptions['show-social-icons-googleplus'] ) ){?>
		<a class="otw_portfolio_manager-social-item otw-google_plus" target="_blank" href="https://plus.google.com/share?url=<?php echo $socialLink;?>"><i class="icon-google-plus" href=""></i></a>
	<?php }?>
	<?php if( !empty( $this->listOptions['show-social-icons-linkedin'] ) ){?>
		<a class="otw_portfolio_manager-social-item otw-linkedin" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $socialLink;?>&amp;title=<?php echo esc_attr( $socialTitle );?>&amp;summary=<?php echo $socialDescription;?>"><i class="icon-linkedin" href=""></i></a>
	<?php }?>
	<?php if( !empty( $this->listOptions['show-social-icons-pinterest'] ) ){?>
		<a class="otw_portfolio_manager-social-item otw-pinterest" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo $socialLink;?>&amp;media=<?php echo $socialAsset; ?>&amp;description=<?php echo $socialDescription;?>&amp;title=<?php echo esc_attr( $socialTitle );?>"><i class="icon-pinterest" href=""></i></a>
	<?php }?>
<?php endif;?>
<?php if( $this->listOptions['show-social-icons'] == 'share_btn_small' || $this->listOptions['show-social-icons'] == 'share_btn_large') : ?>
	<?php if( !empty( $this->listOptions['show-social-icons-facebook'] ) ){?>
		<div class="otw_portfolio-manager-share-button-boxy">
			<a class="otw_portfolio-manager-social-share otw-facebook" target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo $socialLink;?>"><i class="icon-facebook-sign"></i></a>
		</div>
	<?php }?>
	<?php if( !empty( $this->listOptions['show-social-icons-twitter'] ) ){?>
		<div class="otw_portfolio-manager-share-button-boxy">
			<a class="otw_portfolio-manager-social-share otw-twitter" target="_blank" href="https://twitter.com/intent/tweet?source=tweetbutton&amp;text=<?php echo esc_attr( $socialTitle );?>&amp;url=<?php echo $socialLink;?>"><i class="icon-twitter-sign"></i></a>
		</div>
	<?php }?>
	<?php if( !empty( $this->listOptions['show-social-icons-googleplus'] ) ){?>
		<div class="otw_portfolio-manager-share-button-boxy">
			<a class="otw_portfolio-manager-social-share otw-google_plus" target="_blank" href="https://plus.google.com/share?url=<?php echo $socialLink;?>"><i class="icon-google-plus-sign"></i></a>
		</div>
	<?php }?>
	<?php if( !empty( $this->listOptions['show-social-icons-linkedin'] ) ){?>
		<div class="otw_portfolio-manager-share-button-boxy">
			<a class="otw_portfolio-manager-social-share otw-linkedin" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $socialLink;?>&amp;title=<?php echo urlencode( $socialTitle );?>&amp;summary=<?php echo urlencode( $socialDescription );?>"><i class="icon-linkedin-sign"></i></a>
		</div>
	<?php }?>
	<?php if( !empty( $this->listOptions['show-social-icons-pinterest'] ) ){?>
		<div class="otw_portfolio-manager-share-button-boxy">
			<a class="otw_portfolio-manager-social-share otw-pinterest" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo $socialLink;?>&amp;media=<?php echo $socialAsset; ?>&amp;description=<?php echo urlencode( $socialDescription );?>&amp;title=<?php echo urlencode( $socialTitle );?>"><i class="icon-pinterest-sign"></i></a>
		</div>
	<?php }?>
<?php endif;?>
<?php if( $this->listOptions['show-social-icons'] == 'like_buttons' ) : ?>
	<?php if( !empty( $this->listOptions['show-social-icons-facebook'] ) ){?>
		<div class="otw_portfolio-manager-like-button-boxy">
			<iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $socialLink;?>&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=21&amp;appId=426590060736305" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe>
		</div>
	<?php }?>
	<?php if( !empty( $this->listOptions['show-social-icons-twitter'] ) ){?>
		<div class="otw_portfolio-manager-like-button-boxy">
			<a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php echo esc_attr( $socialTitle );?>" data-url="<?php echo esc_attr( $socialLink );?>">Tweet</a>  
		</div>
	<?php }?>
	<?php if( !empty( $this->listOptions['show-social-icons-googleplus'] ) ){?>
		<div class="otw_portfolio-manager-like-button-boxy">
			<!-- Place this tag where you want the +1 button to render. -->
			<div class="g-plusone" data-size="medium" data-href="<?php echo esc_attr( $socialLink );?>"></div>
			<!-- Scrip has been moved into scripts.js - because JS reponse thru ajax will not fire the inline JS -->
			<!-- “Scripts in the resulting document tree will not be executed, resources referenced will not be 
			loaded and no associated XSLT will be applied.” -->
		</div>
	<?php }?>
<?php endif;?>
<?php if( $this->listOptions['show-social-icons'] == 'custom_icons' ) : ?>
	<?php echo do_shortcode( $this->listOptions['show-social-icons-custom'] );?>
<?php endif;?>
</div>
<!-- End Social Share Buttons  -->