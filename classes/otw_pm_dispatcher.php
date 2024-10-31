<?php
if( !class_exists('OTWPMLDispatcher') ) {

class OTWPMLDispatcher {

  // Portfolio Specific Items Title, Media, Meta, Excerpt, Continue Read
  public $portfolioItems = null;

  // Meta Items Speicif Author, Comments, Tags, Categories, Date
  public $metaItems = null;
  
  public $portfolio_category = '';
  
  public $portfolio_tag = '';
  
  public $portfolio_post_type = '';
  
  public $portfolio_templates = array();
  
  public $otw_custom_templates = array();
  
  /**
    * instance of grid component object
    */
  public $grid_manager_component_object = false;

  // List Options
  public $listOptions = null;

  // Image Crop Class
  public $otwImageCrop = null;

  public $mediaContainer = 'otw_portfolio_manager-format-image';

  public $containerBG = null;

  public $containerBorder = null;

  public $postIcon = null;

  // Different image resolutions based on template selection
  private $templateOptions = null;

  private $ajaxPageNo = null;

  // Width - used by templates for image resize
  public $imageWidth  = 250;
  // Height - used by templates for image resize
  public $imageHeight = 340;
  // Add white spaces to images when their size is smaller that the required thumbnail
  public $imageWhiteSpaces = true;
  //default background for white spaces of the thumbs
  public $imageBackground = '#FFFFFF';
  //the type of image croping
  public $imageCrop = 'center_center';
  // Width - used by templates for lightbox image resize
  public $lightboxImageWidth  = 1024;
  // Height - used by templates for lightbox  image resize
  public $lightboxImageHeight = 600;
  // Format - used by templates for lightbox  image resize
  public $lightboxImageFormat  = 'jpg';

  public function __construct() {}

  /**
   * generateTemplate - Get all the components into one big HTML chuck and output them based on filter raw or normal
   * @param $pm_options - array() - full list o list options
   * @param $pm_results - array() - list of posts that are used as content providers
   * @return mixed
   */
  public function generateTemplate ( $pm_options = null, $pm_results = null, $templateMediaOptions = null, $ajax = false, $ajaxPage = null ) {

    if( empty( $pm_options ) || empty( $pm_results ) ) {
      throw new Exception(_e('There was an error in OTWPMLDispatcher: $results or $options is missing', 'otw_pml'), 1);
    }
    $this->otwImageCrop = new OTWPMImageCropLite();

    $this->portfolioItems        = $pm_options['portfolio-items'];
    $this->metaItems        = $pm_options['meta-items'];
    $this->listOptions      = $pm_options;
    $this->templateOptions  = $templateMediaOptions;
    $this->ajaxPageNo       = $ajaxPage;
    
    $this->containerBG      = null;
    $this->containerBorder  = null;

    if( $this->listOptions['show-background'] ) {
      $this->containerBG = 'with-bg';
    }

    if( $this->listOptions['show-border'] ) {
      $this->containerBorder = 'with-border';
    }
    
    $outputHtml = $this->loadTemplate( $pm_options['template'], $pm_results );
    $outputHtml = '<div class="otw-row">'. $outputHtml . '</div>';

    // Hack to solve some idiotic themes that use remove_filters for wpautop
    if( !has_filter( 'the_content', 'wpautop' ) && !$ajax && !$pm_options['widget'] && !has_filter( 'the_content', 'do_blocks' ) ) {
      return '[raw]'.$outputHtml.'[/raw]';
    } else {
      return $outputHtml; 
    }

  }
	public function getArchiveMedia( $post_id ){
	
		$this->otwImageCrop = new OTWPMImageCropLite();
		
		$post = get_post( $post_id );
		
		$postMetaData = get_post_meta( $post->ID, 'otw_pm_meta_data', true );
		
		$this->imageWidth = 220;
		$this->imageHeight = 170;
		$this->imageFormat = '';
		
		if( isset( $this->otw_pm_plugin_options['otw_pm_archive_media_width'] ) && strlen( $this->otw_pm_plugin_options['otw_pm_archive_media_width'] ) ){
			$this->imageWidth = intval( $this->otw_pm_plugin_options['otw_pm_archive_media_width'] );
		}
		if( isset( $this->otw_pm_plugin_options['otw_pm_archive_media_height'] ) && strlen( $this->otw_pm_plugin_options['otw_pm_archive_media_height'] ) ){
			$this->imageHeight = intval( $this->otw_pm_plugin_options['otw_pm_archive_media_height'] );
		}
		if( isset( $this->otw_pm_plugin_options['otw_pm_archive_media_format'] ) && strlen( $this->otw_pm_plugin_options['otw_pm_archive_media_format'] ) ){
			$this->imageFormat = $this->otw_pm_plugin_options['otw_pm_archive_media_format'];
		}
		
		if( $this->imageWidth == $this->imageHeight && $this->imageWidth == 0 ){
			$this->imageWidth = '';
			$this->imageHeight = '';
		}
		
		return $this->loadComponent( 'simple_media', $post, $postMetaData );
	}
	
	public function buildPortfolioTemplate( $post, $otw_details ){
	
		$post_data = array();
		$post_data['post'] = $post;
		
		$post_data['otw_details'] = $otw_details;
		$post_data['otw_details_value'] = '';
		foreach( $post_data['otw_details'] as $detail_id => $otw_detail ){
			$key_name = 'otw_pm_portfolio_detail_'.$detail_id;
			$post_data['otw_details_value'][ $key_name ] = get_post_meta( $post->ID, $key_name, true );
		}
		$post_data['categories'] = wp_get_post_terms( $post->ID, $this->portfolio_category );
		$post_data['tags'] = wp_get_post_terms( $post->ID, $this->portfolio_tag );
		$post_data['tabs'] = get_post_meta( $post->ID, 'otw_pm_tabs_meta_data', true );
		$post_data['options'] = get_post_meta( $post->ID, 'otw_pm_options_meta_data', true );
		
		$post_data['postMetaData'] = get_post_meta( $post->ID, 'otw_pm_meta_data', true );
		
		if( !isset( $post_data['postMetaData']['media_type'] ) ){
			$post_data['postMetaData']['media_type'] = '';
		}
		
		$post_data['imageWidth'] = '650';
		$post_data['imageHeight'] = '580';
		$post_data['imageFormat'] = '';
		$post_data['imageLightboxWidth'] = '1024';
		$post_data['imageLightboxHeight'] = '640';
		$post_data['imageLightboxFormat'] = '';
		$post_data['imageCrop'] = 'center_center';
		$post_data['imageWhiteSpaces'] = false;
		$post_data['imageBackground'] = false;
		
		$single_item_settings = array();
		
		if( isset( $post_data['options']['otw_pm_options_type'] ) && ( $post_data['options']['otw_pm_options_type'] == 'custom' ) ){
			$single_item_settings = $post_data['options']['options'];
		}else{
			$single_item_settings = $this->otw_pm_plugin_options;
		}
		
		if( isset( $single_item_settings['otw_pm_item_media_width'] ) && strlen( $single_item_settings['otw_pm_item_media_width'] ) ){
			$post_data['imageWidth'] = intval( $single_item_settings['otw_pm_item_media_width'] );
		}
		if( isset( $single_item_settings['otw_pm_item_media_height'] ) && strlen( $single_item_settings['otw_pm_item_media_height'] ) ){
			$post_data['imageHeight'] = intval( $single_item_settings['otw_pm_item_media_height'] );
		}
		if( isset( $single_item_settings['otw_pm_item_media_format'] ) && strlen( $single_item_settings['otw_pm_item_media_format'] ) ){
			$post_data['imageFormat'] = $single_item_settings['otw_pm_item_media_format'];
		}
		
		if( ( $post_data['imageWidth'] == $post_data['imageHeight'] ) && ( $post_data['imageWidth'] == 0 ) ){
			$post_data['imageWidth'] = '650';
			$post_data['imageHeight'] = '580';
		}
		
		if( isset( $single_item_settings['otw_pm_item_media_lightbox_width'] ) && strlen( $single_item_settings['otw_pm_item_media_lightbox_width'] ) ){
			$post_data['imageLightboxWidth'] = intval( $single_item_settings['otw_pm_item_media_lightbox_width'] );
		}
		if( isset( $single_item_settings['otw_pm_item_media_lightbox_height'] ) && strlen( $single_item_settings['otw_pm_item_media_lightbox_height'] ) ){
			$post_data['imageLightboxHeight'] = intval( $single_item_settings['otw_pm_item_media_lightbox_height'] );
		}
		if( isset( $single_item_settings['otw_pm_item_media_lightbox_format'] ) && strlen( $single_item_settings['otw_pm_item_media_lightbox_format'] ) ){
			$post_data['imageLightboxFormat'] = $single_item_settings['otw_pm_item_media_lightbox_format'];
		}
		
		if( ( $post_data['imageLightboxWidth'] == $post_data['imageLightboxHeight'] ) && ( $post_data['imageLightboxWidth'] == 0 ) ){
			$post_data['imageLightboxWidth'] = '1024';
			$post_data['imageLightboxHeight'] = '640';
		}
		
		$post_data['imageRelatedWidth'] = '220';
		$post_data['imageRelatedHeight'] = '150';
		$post_data['imageRelatedFormat'] = '';
		$post_data['imageRelatedCrop'] = 'center_center';
		$post_data['imageRelatedWhiteSpaces'] = false;
		$post_data['imageRelatedBackground'] = false;
		
		if( isset( $single_item_settings['otw_pm_related_media_width'] ) && strlen( $single_item_settings['otw_pm_related_media_width'] ) ){
			$post_data['imageRelatedWidth'] = intval( $single_item_settings['otw_pm_related_media_width'] );
		}
		if( isset( $single_item_settings['otw_pm_related_media_height'] ) && strlen( $single_item_settings['otw_pm_related_media_height'] ) ){
			$post_data['imageRelatedHeight'] = intval( $single_item_settings['otw_pm_related_media_height'] );
		}
		if( isset( $single_item_settings['otw_pm_related_media_format'] ) && strlen( $single_item_settings['otw_pm_related_media_format'] ) ){
			$post_data['imageRelatedFormat'] = $single_item_settings['otw_pm_related_media_format'];
		}
		
		if( ( $post_data['imageRelatedWidth'] == $post_data['imageRelatedHeight'] ) && ( $post_data['imageRelatedWidth'] == 0 ) ){
			$post_data['imageRelatedWidth'] = '220';
			$post_data['imageRelatedHeight'] = '150';
		}
		
		$this->otwImageCrop = new OTWPMImageCropLite();
		
		if( empty( $single_item_settings['otw_pm_template'] ) || !array_key_exists( $single_item_settings['otw_pm_template'], $this->portfolio_templates ) ){
			
			if( $single_item_settings['otw_pm_template'] == 'default' ){
				$template = 'default';
			}else{
				$template = 'single-portfolio-media-left';
			}
		}else{
			$template = $single_item_settings['otw_pm_template'];
		}
		
		if( preg_match( "/^otw_custom_template_([0-9]+)$/", $template, $template_matches ) ){
			
			$otw_custom_templates = $this->otw_custom_templates;
			
			if( isset( $otw_custom_templates[ $template_matches[1] ] ) ){
				$template = 'otw_custom_template';
				$post_data['otw_custom_template'] = $otw_custom_templates[ $template_matches[1] ];
				
			}else{
				$template = 'default';
			}
		}
		
		$this->listOptions = array();
		
		if( !empty( $single_item_settings['otw_pm_social_icons'] ) ){
			$this->listOptions['show-social-icons'] = $single_item_settings['otw_pm_social_icons'];
			$this->listOptions['show-social-icons-facebook'] = true;
			$this->listOptions['show-social-icons-twitter'] = true;
			$this->listOptions['show-social-icons-googleplus'] = true;
			$this->listOptions['show-social-icons-linkedin'] = true;
			$this->listOptions['show-social-icons-pinterest'] = true;
			
			if( !empty( $single_item_settings['otw_pm_social_title_text'] ) ){
				$this->listOptions['otw_pm_social_title_text'] = $single_item_settings['otw_pm_social_title_text'];
			}else{
				$this->listOptions['otw_pm_social_title_text'] = '';
			}
		}
		$this->listOptions['excerpt_length'] = '';
		
		if( !empty( $single_item_settings['otw_pm_prev_next_nav'] ) ){
			$post_data['otw_pm_prev_next_nav'] = $single_item_settings['otw_pm_prev_next_nav'];
		}else{
			$post_data['otw_pm_prev_next_nav'] = 'no';
		}
		
		if( !empty( $single_item_settings['otw_pm_related_posts'] ) ){
			$post_data['otw_pm_related_posts'] = $single_item_settings['otw_pm_related_posts'];
		}else{
			$post_data['otw_pm_related_posts'] = 'no';
		}
		if( !empty( $single_item_settings['otw_pm_related_posts_criteria'] ) ){
			$post_data['otw_pm_related_posts_criteria'] = $single_item_settings['otw_pm_related_posts_criteria'];
		}else{
			$post_data['otw_pm_related_posts_criteria'] = $this->portfolio_category;
		}
		
		if( !empty( $single_item_settings['otw_pm_item_title'] ) ){
			$post_data['otw_pm_item_title'] = $single_item_settings['otw_pm_item_title'];
		}else{
			$post_data['otw_pm_item_title'] = 'yes';
		}
		
		if( !empty( $single_item_settings['otw_pm_media_lightbox'] ) ){
			$post_data['otw_pm_media_lightbox'] = $single_item_settings['otw_pm_media_lightbox'];
		}else{
			$post_data['otw_pm_media_lightbox'] = 'no';
		}
		
		if( !empty( $single_item_settings['otw_pm_related_posts_number'] ) && intval( $single_item_settings['otw_pm_related_posts_number'] ) ){
			$post_data['otw_pm_related_posts_number'] = $single_item_settings['otw_pm_related_posts_number'];
		}else{
			$post_data['otw_pm_related_posts_number'] = '4';
		}
		
		$post_data['otw_pm_plugin_options'] = $single_item_settings;
		
		$this->listOptions['title_link'] = 'single';
		
		if( $template != 'default' ){
		
			if( $template == 'otw_custom_template' ){
				
				global $otw_porfolio_items_data;
				
				if( !is_array( $otw_porfolio_items_data ) ){
					$otw_porfolio_items_data = array();
				}
				$otw_porfolio_items_data[ $post_data['post']->ID ] = array();
				$otw_porfolio_items_data[ $post_data['post']->ID ]['data'] = $post_data;
				$otw_porfolio_items_data[ $post_data['post']->ID ]['dispatcher'] = &$this;
			}
			
			echo $this->loadTemplate( $template, $post_data );
			die;
		}
	}
  /**
   * Get Portfolio Items in the specific order
   * @param $templateItems - string (format: title,media,meta,description,continue-reading)
   * @return void()
   */
  private function buildInterfacePortfolioItems ( $post ) {
    if( empty( $post ) ) {
      throw new Exception(_e('There was an error in OTWPMLDispatcher -> buildInterfacePortfolioItems ', 'otw_pml'), 1);
    }

    $items = explode(',', $this->portfolioItems);
    $postMetaData = get_post_meta( $post->ID, 'otw_pm_meta_data', true );

    $interfaceHTML = '';

    foreach( $items as $item ): 
      switch ( $item ) {
        case 'title':
          $interfaceHTML .= $this->getTitle( $post );
        break;
        case 'media':
          $interfaceHTML .= $this->getMedia( $post, $postMetaData );
        break;
        case 'meta':
          $interfaceHTML .= $this->buildInterfaceMetaItems( $this->metaItems, $post );
        break;
        case 'description':
          $interfaceHTML .= $this->getContent( $post );
        break;
        case 'continue-reading':
          $interfaceHTML .= $this->getContinueRead( $post );
        break;
      }
    endforeach;

    return $interfaceHTML;

  }

  /**
   * Get Meta Items in the specific order
   * @param $metaItems - string (format: author,date,category,tags,comments)
   * @return void()
   */
  private function buildInterfaceMetaItems ( $metaItems, $post ) {

    $items = explode(',', $this->metaItems);
    
    $metaHTML = '';
    
    $otw_details = get_option( 'otw_pm_portfolio_details' );
    
    foreach( $items as $item ) :
      switch ( $item ) {
        case 'author':
          $metaHTML .= $this->loadComponent( 'meta_authors', $post );
        break;
        case 'date':
          $metaHTML .= $this->loadComponent( 'meta_date', $post );
        break;
        case 'category':
          $metaHTML .= $this->loadComponent( 'meta_categories', $post );
        break;
        case 'tags':
          $metaHTML .= $this->loadComponent( 'meta_tags', $post );
        break;
        case 'comments':
          $metaHTML .= $this->loadComponent( 'meta_comments', $post );
        break;
        default:
    		if( preg_match( "/^otw_portfolio_detail_(\d+)$/", $item, $matches ) ){
    		
    			$detail_value = '';
    			$detail_title = '';
    			
    			if( isset( $otw_details[ $matches[1] ] ) ){
    				$detail_title = $otw_details[ $matches[1] ]['title'];
    			}
			$detail_value = get_post_meta( $post->ID, 'otw_pm_portfolio_detail_'.$matches[1], true );
    			
    			$metaHTML .= $this->loadComponent( 'meta_portfolio_detail', $post, array( $detail_title, $detail_value, $item ) );
    		}
        break;
      }
    endforeach;

    return $this->loadWrapper('meta', $metaHTML);

  }

  /**
   * getTitle - Get Item Post Title
   * @param $post - array
   * @return mixed
   */
  public function getTitle ( $post ) {
    return $this->loadComponent( 'title', $post );
  }
  
   /**
   * getTitle - Get Item Post Title
   * @param $post - array
   * @return mixed
   */
  public function getSliderTitle ( $post ) {
    return $this->loadComponent( 'slider_title', $post );
  }

  public function getItemMedia( $otw_pm_posts ){
	return $this->loadComponent( 'item_media', $otw_pm_posts );
  }

  /**
   * getMedia - Get Item's Media. Featured Image, Custom Post Data Image, Slider, Vimeo, YouTube, SoundCloud
   * @par$otwDispatcheram $post - array
   * @param $postMetaData - array
   
   * @return mixed
   */
  private function getMedia ( $post, $postMetaData = null, $component = null ) {

    if( empty( $postMetaData ) ) {
      $postMetaData = get_post_meta( $post->ID, 'otw_pm_meta_data', true );
    }

    // Get Featured Image
    $postAttachement = $this->getPostAsset( $post );

    // If we don't have an asset or media item Vimeo, YouTube, etc return null
    if( empty( $postMetaData ) && empty( $postAttachement ) ) {
      return null;
    }
    
    // Post that has no Meta Data - Image Attached Via OTW Meta Box, Vimeo, YouTube, etc
    if( empty( $postMetaData ) && !empty( $postAttachement ) ) {
      $postMetaData['media_type']   = 'wp-native';
      $postMetaData['featured_img'] = $postAttachement;
    }
    // Set Class For Sliders
    $this->mediaContainer = 'otw_portfolio_manager-format-image';
    if( !empty( $postMetaData ) && !empty($postMetaData['slider_url']) ) {
      $this->mediaContainer = 'otw_portfolio_manager-format-gallery';
    }

    // Set Width and Height of the Media Item
    $this->getMediaProportions();
    
    if( empty( $component ) ){
	    $component = 'media';
    }
	if( isset( $postMetaData['_otw_force_imageWidth'] ) ){
		$this->imageWidth = $postMetaData['_otw_force_imageWidth'];
	}
	
	if( isset( $postMetaData['_otw_force_imageHeight'] ) ){
		$this->imageHeight = $postMetaData['_otw_force_imageHeight'];
	}
    
    
    return $this->loadComponent( $component, $post, $postMetaData );
  }

  /**
   * getContent - Get Post Content. Strip Tags, get Content or Excpert. Word count output
   * @param $post - array
   * @return mixed
   */
  private function getContent ( $post ) {
    return $this->loadComponent( 'content', $post );
  }

  /**
   * getContinueRead - Get Post Link. Create link with custom text
   * @param $post - array
   * @return mixed
   */
  private function getContinueRead ( $post ) {
    return $this->loadComponent( 'continue_read', $post );
  }

  /**
   * getSocial - Get Social Links for a specific Post
   * @param $post - array
   * @return mixed
   */
  public function getSocial ( $post, $type = 'list' ) {
    if( !empty( $this->listOptions['show-social-icons'] ) ) {
      return $this->loadComponent( 'social', $post, $type );
    }
  }

  /**
   * getDelimiter - Get Post delimiter
   * @param $post - array
   * @return array
   */
  private function getDelimiter ( $post ) {
    if( $this->listOptions['show-delimiter'] ) {
      return $this->loadComponent( 'delimiter', $post );
    }
  }
  /**
   * getPortfolioRelatedPosts - Get Related posts
   * @param $args - array
   * @return html
   */
  public function getPortfolioRelatedPosts( $args ){
	
	$content = '';
	
	if( isset( $args['otw_pm_related_posts'] ) && ( $args['otw_pm_related_posts'] == 'yes' ) && isset( $args['post'] ) && isset( $args['post']->ID ) ){
		
		$term_ids = array();
		
		if( !isset( $args['otw_pm_related_posts_criteria'] ) || ( $args['otw_pm_related_posts_criteria'] == $this->portfolio_category ) ){
			if( isset( $args['categories'] ) && count( $args['categories'] ) ){
				foreach( $args['categories'] as $cat ){
					$term_ids[] = $cat->term_id;
				}
				
				$related_args = array(
					'post_type' => $this->portfolio_post_type,
					'post_status'     => 'publish',
					'tax_query'       => array( array(
						'taxonomy' => $this->portfolio_category,
						'field' => 'id',
						'terms' => $term_ids
					) ),
					'post__not_in' => array($args['post']->ID)
				);
				
				$related_posts = new wp_query( $related_args );
				
				$content = $this->loadComponent( 'related_posts', $args['post'], $args, $related_posts );
			}
		}elseif( isset( $args['otw_pm_related_posts_criteria'] ) && ( $args['otw_pm_related_posts_criteria'] == $this->portfolio_tag ) ){
			
			if( isset( $args['tags'] ) && count( $args['tags'] ) ){
			
				foreach( $args['tags'] as $tag ){
					$term_ids[] = $tag->term_id;
				}
				
				$related_args = array(
					'post_type' => $this->portfolio_post_type,
					'post_status'     => 'publish',
					'tax_query'       => array( array(
						'taxonomy' => $this->portfolio_tag,
						'field' => 'id',
						'terms' => $term_ids
					) ),
					'post__not_in' => array($args['post']->ID)
				);
				
				$related_posts = new wp_query( $related_args );
				
				$content = $this->loadComponent( 'related_posts', $args['post'], $args, $related_posts );
			}
		}elseif( isset( $args['otw_pm_related_posts_criteria'] ) && preg_match( "/^otw_pm_portfolio_detail_(\d+)$/", $args['otw_pm_related_posts_criteria'], $criteria_match ) ){
		
			$detail_value = get_post_meta( $args['post']->ID, 'otw_pm_portfolio_detail_'.$criteria_match[1], true );
			
			if( strlen( trim( $detail_value ) ) ){
			
				$related_args = array(
					'post_type' => $this->portfolio_post_type,
					'post_status'     => 'publish',
					'meta_key' => 'otw_pm_portfolio_detail_'.$criteria_match[1],
					'meta_value' => $detail_value,
					'post__not_in' => array($args['post']->ID)
				);
				
				$related_posts = new wp_query( $related_args );
				
				$content = $this->loadComponent( 'related_posts', $args['post'], $args, $related_posts );
			}
		}
	}
	
	return $content;
  }
  /**
   * getPortfolioPagination - Get Pagination HTML based on the selection made.
   * @param $args - array
   * @return html
   */
  public function getPortfolioPagination( $args = array() ) {
	
	$content = '';
	
	if( isset( $args['otw_pm_prev_next_nav'] ) && ( $args['otw_pm_prev_next_nav'] == 'yes' ) ){
		
		$args = wp_parse_args( $args, array(
			'prev_text'          => '%title',
			'next_text'          => '%title'
		) );
		
		$previous   = get_previous_post_link( '%link', '&laquo; %title' );
		$next       = get_next_post_link( '%link', '%title &raquo;' );
		
		if ( $previous || $next ){
			$previous = str_replace( '<a ', '<a class="prev" ', $previous );
			$next = str_replace( '<a ', '<a class="next" ', $next );
			
			$content .= '<div class="pm_clear otw_portfolio_manager-mb30"></div>';
			$content .= '<div class="otw_portfolio_manager-nav-single pm_clearfix">';
			$content .= $previous;
			$content .= $next;
			$content .= '</div>';
		}
	
	}
	return $content;
  }
  /**
   * getPagination - Get Pagination HTML based on the selection made. Standard, Load Mode, Infinite Scroll
   * @param $otw_pm_posts - array
   * @return mixed
   */
  private function getPagination( $otw_pm_posts ) {
    if( !empty( $this->listOptions['show-pagination'] ) ) {

      if( !empty( $this->listOptions['posts_limit'] ) && ( $this->listOptions['posts_limit'] <= $this->listOptions['posts_limit_page'] ) ) {
        return;
      }
      
      return $this->loadComponent( 'pagination', null, null, $otw_pm_posts );
    }
  }

  /**
   * getWidgetPagination - Widget Will only support Load More pagination
   * @param $otw_pm_posts
   * @return mixed
   */
  private function getWidgetPagination( $otw_pm_posts ) {
    if( !empty( $this->listOptions['show-pagination'] ) && $this->listOptions['show-pagination'] == 'load-more' ) {

      if( !empty( $this->listOptions['posts_limit'] ) && ( $this->listOptions['posts_limit'] <= $this->listOptions['posts_limit_page'] ) ) {
        return;
      }
      return $this->loadComponent( 'widget_pagination', null, null, $otw_pm_posts );
    }
  }

  /**
   * getInfiniteScroll - Get Infinite Scroll options
   * @return string
   */
  private function getInfiniteScroll() {
    $infinitScroll = '';
    if( !empty($this->listOptions['show-pagination']) && $this->listOptions['show-pagination'] == 'infinit-scroll' ) {
      $infinitScroll = 'otw_portfolio_manager-infinite-scroll';
    }

    return $infinitScroll;
  }

  /**
   * getInfiniteScrollGrid - Get Infinite Scroll for Grid Templates
   * @return string
   */
  public function getInfiniteScrollGrid() {
    $infinitScroll = '';

    if( !empty($this->listOptions['show-pagination']) && $this->listOptions['show-pagination'] == 'infinit-scroll' ) {
      $infinitScroll = 'otw_portfolio_manager-infinite-pagination-holder';
    }

    return $infinitScroll;
  }

  /**
   * getInfiniteScrollHorizontal - Get Infinite Scroll For Horizontal Layout
   * @return string
   */
  public function getInfiniteScrollHorizontal() {
    $infinitScroll = '';
    if( !empty($this->listOptions['show-pagination']) && ($this->listOptions['show-pagination'] == 'infinit-scroll') ) {
      $infinitScroll = 'otw_portfolio_manager-horizontal-layout-items-infinite-scroll';
    }

    return $infinitScroll;
  }

  /**
   * getNewsFilter - Get Filter for news
   * @return mixed
   */
  private function getNewsFilter () {
    
    if( empty( $this->ajaxPageNo ) ) {
      if( $this->listOptions['show-news-cat-filter'] ) {
        return $this->loadComponent( 'news_filter' );  
      }
    }
  }

  private function getMosaicFilter () {
    if( empty( $this->ajaxPageNo ) ) {
      if( $this->listOptions['show-mosaic-cat-filter'] ) {
        return $this->loadComponent( 'news_filter' );  
      }
    }
  }

  /**
   * getNewsSort - Get News Sort Options
   * @return mixed
   */
  private function getNewsSort () {
    if( empty( $this->ajaxPageNo ) ) {
      if( $this->listOptions['show-news-sort-filter'] ){
        return $this->loadComponent( 'news_sort' );  
      }
    }
  }

  private function getMosaicSort () {
    if( empty( $this->ajaxPageNo ) ) {
      if( $this->listOptions['show-mosaic-sort-filter'] ){
        return $this->loadComponent( 'news_sort' );  
      }
    }
  }

  /**
   * getViewAll - Get View All link
   * @return mixed
   */
  private function getViewAll() {
    if ( 
        !empty($this->listOptions['portfolio_list_title']) ||
        ( !empty($this->listOptions['view_all_page']) || !empty($this->listOptions['view_all_page_link']) ) 
        && empty( $this->ajaxPageNo )
    ) {
      return $this->loadComponent('view_all');
    }
  }

  /**
   * getLink - get link for title or media items
   * @param $post - array - post info
   * @param $type - string - title or media item for getLink
   */
	private function getLink ( $post , $type = null ) {
		if( !empty($type) ) {
			switch ( $type ) {
			
				case 'item_media':
						return $this->getPostAsset( $post, $type );
					break;
				case 'media':
						switch ( $this->listOptions['image_link'] ) {
							case 'single':
									return get_permalink( $post->ID );
								break;
							case 'lightbox':
									return $this->getPostAsset( $post, $type );
								break;
							default:
									return null;
								break;
						}
					break;
				case 'title':
						switch ( $this->listOptions['title_link'] ) {
							
							case 'single':
									return get_permalink( $post->ID );
								break;
							case 'lightbox':
									return $this->getPostAsset( $post, $type );
								break;
							default:
									return null;
								break;
						}
					break;
			}
		}
	}

  /**
   * getListLink - get link for title or media items
   * @param $post - array - post info
   * @param $type - string - title or media item for getLink
   */
	private function getListLink ( $listOptions , $post, $type = null ) {
		if( !empty($type) ) {
			switch ( $type ) {
			
				case 'list_media':
						return $this->getListAsset( $listOptions, $post, $type );
					break;
			}
		}
	}

  /**
   * excerptLength - Get content based on word count.
   * @return string
   */
  private function excerptLength($content, $count, $strip_tags = true ){
	
	if( $strip_tags ){
		$content = strip_tags($content);
		$content = str_replace('&nbsp;', ' ', $content);
		
		$content = preg_split("/[\s,]+/", $content);
		
		if( $count == 0 ){
			$count = 1;
		}
		
		if ($count < count($content) ) {
			$content = array_slice($content, 0, $count);
		}
		$content = join(" ", $content);
	}else{
		$content = $this->htmlExcerptLength( $content, $count  );
	}
	return $content;
  }
	private function htmlExcerptLength( $content, $count ){
		
		$new_content = '';
		
		$content_size = strlen( $content );
		
		$open_tag = false;
		
		$tags = array();
		
		$tag_index = 0;
		
		$new_count = 0;
		
		$word_started = true;
		
		$opened_tags = array();
		
		for( $cC = 0; $cC < $content_size; $cC++ ){
			
			$current_char = $content[ $cC ];
			
			if( $current_char == '<' ){
				
				$tag_index = count( $tags );
				$open_tag = true;
				$tags[ $tag_index ] = array();
				$tags[ $tag_index ]['open'] = '<';
				$tags[ $tag_index ]['closed'] = false;
				
				if( $new_count >= $count ){
					
					if( isset( $content[ $cC + 1 ] ) && ( $content[ $cC + 1 ] != '/' ) ){
						break;
					}
				}
			}
			elseif( $current_char == '>' ){
				
				$open_tag = false;
				$tags[ $tag_index ]['open'] .= '>';
				$new_content .= $tags[ $tag_index ]['open'];
				
				if( preg_match_all( "/^\<([a-zA-Z0-9]+)([\s+])?(.*)?\>$/", $tags[ $tag_index ]['open'], $o_tag_match ) ){
					
					//check if this tags is closed
					if( !preg_match( "/\/\>$/", $tags[ $tag_index ]['open'] ) ){
						$opened_tags[] = trim( $o_tag_match[1][0] );
					}
					
					
				}elseif( preg_match_all( "/^\<\/([a-zA-Z0-9]+)([\s+])?(.*)?\>$/", $tags[ $tag_index ]['open'], $o_tag_match ) ){
					
					$closing_tag = trim( $o_tag_match[1][0] );
					$total_opened_tags  = count( $opened_tags );
					
					if( $total_opened_tags ){
						
						$total_opened_tags = $total_opened_tags - 1;
						for( $cO = $total_opened_tags; $cO >=0; $cO-- ){
							
							if( $closing_tag == $opened_tags[ $cO ] ){
								unset( $opened_tags[ $cO ] );
								$opened_tags = array_values( $opened_tags );
								break;
							}
						}
					}
				}
			}
			elseif( !$open_tag ){
				
				if( preg_match( "/[[:space:][:punct:]]/", $current_char, $match ) ){
				
					if( $word_started ){
						$new_count++;
						$word_started = false;
					}
					
					if( $new_count < $count ){
						$new_content .= $match[0];
					}
				}else{
					if( $new_count < $count ){
						$new_content .= $current_char;
					}
					$word_started = true;
				}
			}
			elseif( $open_tag ){
				
				$tags[ $tag_index ]['open'] .= $current_char;
			}
		}
		
		if( count( $opened_tags ) ){
			
			foreach( $opened_tags as $o_tag ){
			
				if( !in_array( $o_tag, array( 'area', 'base', 'br', 'col', 'command', 'embed', 'hr', 'img', 'input', 'keygen', 'link', 'meta', 'param', 'source', 'track', 'wbr' ) ) ){
					$new_content .= '</'.$o_tag.'>';
				}
			}
		}
		return $new_content;
	}

  /**
   * getMediaProportions - Get Media Proportions for the specific layout
   * @return null
   */
  public function getMediaProportions() {

    if( empty( $this->templateOptions ) ) {
      // Load $templateOptions - array
      include( dirname( __FILE__ ) . '/../include' . DS . 'content.php');
      $this->templateOptions = $templateOptions;
    }
    
    foreach ( $this->templateOptions as $key => $value):
      if( $value['name'] == $this->listOptions['template'] ) {
        $optionIndex = $key;
      }
    endforeach;
    
    $this->imageWidth   = $this->templateOptions[$optionIndex]['width'];
    $this->imageHeight  = $this->templateOptions[$optionIndex]['height'];
    $this->imageCrop    = $this->templateOptions[$optionIndex]['crop'];
    $this->imageFormat  = '';
    
	if( isset( $this->listOptions['thumb_width'] ) && preg_match( "/^\d+$/", $this->listOptions['thumb_width'] ) ){
		
		$this->imageWidth = $this->listOptions['thumb_width'];
	}
	
	if( isset( $this->listOptions['thumb_height'] ) && preg_match( "/^\d+$/", $this->listOptions['thumb_height'] ) ) {
		
		$this->imageHeight = $this->listOptions['thumb_height'];
	}
	if( isset( $this->listOptions['thumb_format'] ) ){
		
		$this->imageFormat = $this->listOptions['thumb_format'];
	}
	
	
	$this->imageWhiteSpaces = false;
	$this->imageBackground = '';
	$this->imageCrop = 'center_center';
  }

  /**
   * Get Post Assets - First Look For OTW Meta Box Content img, if no Meta Box content has been found,
   * use featured image
   * @param $post - array()
   * @return string
   */
  private function getPostAsset ( $post, $type = '' ){
	$postMetaData = get_post_meta( $post->ID, 'otw_pm_meta_data', true );
	
	$media_type = 'img';
	if( isset( $postMetaData['media_type'] ) ){
		$media_type = $postMetaData['media_type'];
	}
	switch( $media_type ){
	
		case 'img':
				if( !empty( $postMetaData ) && !empty( $postMetaData['img_url'] ) ){
					
					$imagePath = parse_url( $postMetaData['img_url'] );
					
					return $this->otwImageCrop->resize( $imagePath['path'], $this->lightboxImageWidth, $this->lightboxImageHeight, $this->imageCrop, $this->imageWhiteSpaces, $this->imageBackground, $this->lightboxImageFormat );
				}
			break;
		case 'slider':
				if ( !empty( $postMetaData ) && !empty( $postMetaData['slider_url'] ) ){
					$sliderImages = explode(',', $postMetaData['slider_url']);
					
					if( !empty( $sliderImages[0] ) ){
						$imagePath = parse_url($sliderImages[0]);
						
						return $this->otwImageCrop->resize( $imagePath['path'], $this->lightboxImageWidth, $this->lightboxImageHeight, $this->imageCrop, $this->imageWhiteSpaces, $this->imageBackground, $this->lightboxImageFormat );
					}
					return $sliderImages[0];
				}
			break;
		case 'vimeo':
		case 'youtube':
		case 'soundcloud':
				$uniqueHash = wp_create_nonce("otw_pm_get_video"); 
				$view_ref = '';
				if( strlen( $type ) ){
					$view_ref = '&vr='.$type;
				}
				return admin_url( 'admin-ajax.php?action=otw_pm_get_video&post_id='. $post->ID.$view_ref.'&nonce='. $uniqueHash);
			break;
	}
	$postAsset = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
	
	if( !empty( $postAsset ) ) {
		return $postAsset;
	}
	return null;
  } 
  
   /**
   * Get List Assets - First Look For OTW Meta Box Content img, if no Meta Box content has been found,
   * use featured image
   * @param $post - array()
   * @return string
   */
  private function getListAsset ( $listOptions, $post, $type = '' ){
 
	$postMetaData = get_post_meta( $post->ID, 'otw_pm_meta_data', true );
	
	$media_type = 'img';
	if( isset( $postMetaData['media_type'] ) ){
		$media_type = $postMetaData['media_type'];
	}
	
	switch( $media_type ){
	
		case 'img':
				if( !empty( $postMetaData ) && !empty( $postMetaData['img_url'] ) ){
					return $postMetaData['img_url'];
				}
			break;
		case 'slider':
				if ( !empty( $postMetaData ) && !empty( $postMetaData['slider_url'] ) ){
					$sliderImages = explode(',', $postMetaData['slider_url']);
					return $sliderImages[0];
				}
			break;
		case 'vimeo':
		case 'youtube':
		case 'soundcloud':
				$uniqueHash = wp_create_nonce("otw_pm_get_video"); 
				$view_ref = '';
				if( strlen( $type ) ){
					$view_ref = '&vr='.$type;
				}
				return admin_url( 'admin-ajax.php?action=otw_pm_get_video&list_id='.$listOptions['id'].'&post_id='. $post->ID.$view_ref.'&nonce='. $uniqueHash);
			break;
	}
	$postAsset = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
	
	if( !empty( $postAsset ) ) {
		return $postAsset;
	}
	return null;
  } 

  /**
   * loadComponent - Loads components found in /plugin_name/skeleton/components/*.php
   * @param $componentName - string
   * @param $post - array() - Post Data
   * @return mixed
   */
  private function loadComponent( $componentName, $post = null, $postMetaData = null, $otw_pm_posts = null ) {
    ob_start();
    $paginationPage = $this->ajaxPageNo;
    include( OTW_PML_SERVER_PATH . DS . 'skeleton' . DS . 'components' . DS . $componentName . '.php' );  
    return ob_get_clean();
  }

  /**
   * loadWidgetComp - Loads widget components found in /plugin_name/skeleton/components/*.php
   * @param $componentName - string
   * @param $widgetPost - array() - Post Data
   * @return mixed
   */
  private function loadWidgetComp( $componentName, $widgetPost = null, $postMetaData = null ) {
    ob_start();
    include( OTW_PML_SERVER_PATH . DS . 'skeleton' . DS . 'components' . DS . 'widget_'.$componentName . '.php' );  
    return ob_get_clean();
  }

  /**
   * loadTemplate - Loads components found in /plugin_name/skeleton/*.php
   * @param $templateName - string
   * @param $otw_pm_posts - array() - Array of Posts to be used in the template
   * @return mixed
   */
  private function loadTemplate ( $templateName, $otw_pm_posts ) {
    ob_start();
    
    global $wp_filesystem;
    
    if( otw_init_filesystem() ){
	    if( $wp_filesystem->is_file( OTW_PML_SERVER_PATH . DS . 'skeleton' . DS . $templateName . '.php' ) ){
		include( OTW_PML_SERVER_PATH . DS . 'skeleton' . DS . $templateName . '.php' );
	    }
    }
    return ob_get_clean();
  } 

  private function loadWrapper( $wrapperName, $metaData ) {
    ob_start();
    include( OTW_PML_SERVER_PATH . DS . 'skeleton' . DS . 'wrappers' . DS . $wrapperName . '.php' );
    return ob_get_clean();
  }
    public function get_details(){

	$otw_details = get_option( 'otw_pm_portfolio_details' );
	
	if( is_array( $otw_details ) && count( $otw_details ) ){
		
		uasort( $otw_details, array( $this, 'sort_details' ) );
		
	}else{
		$otw_details = array();
	}
	return $otw_details;
    }  
	public function sort_details( $a, $b ){
	
	if( $a['order'] > $b['order'] ){
		return 1;
	}elseif( $a['order'] < $b['order'] ){
		return -1;
	}elseif( $a['id'] > $b['id'] ){
		return 1;
	}elseif( $a['id'] < $b['id'] ){
		return -1;
	}
	return 0;
	
}

} // End OTWPMLDispatcher Class

} // End IF Class Exists