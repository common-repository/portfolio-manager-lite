<?php
/**
 * Class Used to interface with the DB
 */

if( !class_exists('OTWPMLQuery') ) {

class OTWPMLQuery {

  public $listOptions = null;
  
  public $portfolio_category = '';
  
  public $portfolio_tab = '';
  
  public $portfolio_post_type = '';

  public function __construct() {}

  /**
   * Get POSTS based on the selected options for a list
   * @param $options array()
   * @param $page - int - Used for paged results
   * @return array()
   */
  public function getPosts ( $options = array(), $page = null ) {
    $otw_pm_posts = array();

    if( !empty( $options ) ) {
      
      $this->listOptions = $options;
      
      $template   = $options['template'];
      $categories = $options['categories'];
      $tags       = $options['tags'];
      $authors    = $options['users'];
      $order      = explode('_', $options['posts_order']);
      $exclude_categories = array();
      $exclude_tags = array();
      $exclude_authors = array();
      
	( !empty( $categories ) )? $categoriesArray = explode(',', $categories) : $categoriesArray = '';
	( !empty( $tags ) )? $tagsArray = explode(',', $tags) : $tagsArray = '';
	( !empty( $authors ) )? $authorsArray = explode(',', $authors) : $authorsArray = '';
	
	$categoriesAll = false;
	$tagsAll = false;
	$authorsAll = false;
	
	if( isset( $options['all_categories'] ) && !empty( $options['all_categories'] ) ){
		
		$categoriesArray = array();;
		$categoriesAll = true;
	}
	
	//if all selected
	if( isset( $options['all_tags'] ) && !empty( $options['all_tags'] ) ){
		
		$tagsArray = array();
		$tagsAll = true;
	}
	if( isset( $options['all_users'] ) && !empty( $options['all_users'] ) ){
		
		$authorsArray = array();
		$authorsAll = true;
	}
	
	if( isset( $options['exclude_categories'] ) && strlen( trim( $options['exclude_categories'] ) ) && is_array( $categoriesArray ) && count( $categoriesArray ) ){
		
		$exclude_categories = explode( ',', $options['exclude_categories'] );
		
		if( count( $exclude_categories ) ){
			
			$tmpCategoriesArray = $categoriesArray;
			
			foreach( $tmpCategoriesArray as $tmpKey => $tmpCat ){
				
				if( in_array( $tmpCat, $exclude_categories ) ){
					unset( $categoriesArray[ $tmpKey ] );
				}
			}
		}
		if( !count( $categoriesArray ) ){
			$categoriesArray = array( 0 );
		}
	}elseif( isset( $options['exclude_categories'] ) && strlen( trim( $options['exclude_categories'] ) ) && ( !is_array( $categoriesArray ) || !count( $categoriesArray ) ) ){
		
		$exclude_categories = explode( ',', $options['exclude_categories'] );
		
	}
	
	if( isset( $options['exclude_tags'] ) && strlen( trim( $options['exclude_tags'] ) ) && is_array( $tagsArray ) && count( $tagsArray ) ){
		$exclude_tags = explode( ',', $options['exclude_tags'] );
		
		if( count( $exclude_tags ) ){
			
			$tmpTagsArray = $tagsArray;
			
			foreach( $tmpTagsArray as $tmpKey => $tmpCat ){
				
				if( in_array( $tmpCat, $exclude_tags ) ){
					unset( $tagsArray[ $tmpKey ] );
				}
			}
		}
		if( !count( $tagsArray ) ){
			$tagsArray = array( 0 );
		}
	}elseif( isset( $options['exclude_tags'] ) && strlen( trim( $options['exclude_tags'] ) ) && ( !is_array( $tagsArray ) || !count( $tagsArray ) ) ){
		
		$exclude_tags = explode( ',', $options['exclude_tags'] );
	}
	
	if( isset( $options['exclude_users'] ) && strlen( trim( $options['exclude_users'] ) ) && is_array( $authorsArray ) && count( $authorsArray ) ){
		
		$exclude_authors = explode( ',', $options['exclude_users'] );
		
		if( count( $exclude_authors ) ){
			
			$tmpAuthorsArray = $authorsArray;
			
			foreach( $tmpAuthorsArray as $tmpKey => $tmpCat ){
				
				if( in_array( $tmpCat, $exclude_authors ) ){
					unset( $authorsArray[ $tmpKey ] );
				}
			}
		}
		if( !count( $authorsArray ) ){
			$authorsArray = array( 0 );
		}
		
	}elseif( isset( $options['exclude_users'] ) && strlen( trim( $options['exclude_users'] ) ) && ( !is_array( $authorsArray ) || !count( $authorsArray ) ) ){
	
		$exclude_authors = explode( ',', $options['exclude_users'] );
	}
	
	$catTagRelation = 'OR';

      // Code Use to get only posts with attachment
      $metaQuery = null;
      $sliderArray = array(
        'slider', '3-column-carousel', '4-column-carousel', '5-column-carousel',
        '2-column-carousel-wid', '3-column-carousel-wid', '4-column-carousel-wid',
        '1-3-mosaic', '1-4-mosaic', 'horizontal-layout'
      );
      if( in_array( $options['template'] , $sliderArray) ) {
        $metaQuery = array(
            'relation' => 'OR',
            array(
              'key' => '_thumbnail_id'
            ),
            array(
              'key'     => 'otw_pm_meta_data',
              'compare' => 'EXISTS'
            )
        );
      }

      // Used for pagination
      $currentPage = ( !empty($page) ) ? $page : 1;

      if( $template == 'timeline' ) {
        // If we have a timeline Layout we need to ignore the selected Order Options and use custom ones.
        $order[0] = 'date';
        $order[1] = 'DESC';
      }

      // For more information about the query, visit: http://codex.wordpress.org/Class_Reference/WP_Query
      $queryPM = array(
	'post_type'	  => $this->portfolio_post_type,
        'meta_query'      => $metaQuery,
        'post_status'     => 'publish',
        'posts_per_page'  => $options['posts_limit_page'],
        'paged'           => $currentPage,
        'orderby'         => $order[0], //Order Field
        'order'           => $order[1], // Order Value (ASC, DESC)
        'tax_query'       => array(
          'relation'      => $catTagRelation,
        ),
      );
	
	if( intval( $queryPM['posts_per_page'] ) == 0 ){
		$queryPM['posts_per_page'] = -1;
	}
	
	if( is_array( $categoriesArray ) && count( $categoriesArray ) ){
		
		if( !isset( $queryPM['tax_query'] ) ){
			$queryPM['tax_query'] = array();
		}
		$queryPM['tax_query'][] = array(
			'taxonomy' => $this->portfolio_category,
			'field'    => 'id',
			'terms'    => $categoriesArray,
			'operator' => 'IN'
		
		);
		
	}elseif( is_array( $exclude_categories ) && count( $exclude_categories ) ){
		
		if( !isset( $queryPM['tax_query'] ) ){
			$queryPM['tax_query'] = array();
		}
		$queryPM['tax_query'][] = array(
			'taxonomy' => $this->portfolio_category,
			'field'    => 'id',
			'terms'    => $exclude_categories,
			'operator' => 'NOT IN'
		
		);
	}elseif( $categoriesAll ){
		
		$taxonomy_terms = get_terms( $this->portfolio_category, array( 'hide_empty' => 0, 'fields' => 'ids' ) );
		
		if( !isset( $queryPM['tax_query'] ) ){
			$queryPM['tax_query'] = array();
		}
		$queryPM['tax_query'][] = array(
			'taxonomy' => $this->portfolio_category,
			'field'    => 'id',
			'terms'    => $taxonomy_terms,
			'operator' => 'IN'
		
		);
	}
	
	if( is_array( $tagsArray ) && count( $tagsArray ) ){
		
		if( !isset( $queryPM['tax_query'] ) ){
			$queryPM['tax_query'] = array();
		}
		$queryPM['tax_query'][] = array(
			'taxonomy' => $this->portfolio_tag,
			'field'    => 'id',
			'terms'    => $tagsArray,
			'operator' => 'IN'
		
		);
		
	}elseif( is_array( $exclude_tags ) && count( $exclude_tags ) ){
		
		if( !isset( $queryPM['tax_query'] ) ){
			$queryPM['tax_query'] = array();
		}
		$queryPM['tax_query'][] = array(
			'taxonomy' => $this->portfolio_tag,
			'field'    => 'id',
			'terms'    => $exclude_tags,
			'operator' => 'NOT IN'
		
		);
	}
	elseif( $tagsAll ){
		
		$taxonomy_terms = get_terms( $this->portfolio_tag, array( 'hide_empty' => 0, 'fields' => 'ids' ) );
		
		if( !isset( $queryPM['tax_query'] ) ){
			$queryPM['tax_query'] = array();
		}
		$queryPM['tax_query'][] = array(
			'taxonomy' => $this->portfolio_tag,
			'field'    => 'id',
			'terms'    => $taxonomy_terms,
			'operator' => 'IN'
		
		);
	}
	
	if( is_array( $authorsArray ) && count( $authorsArray ) ){
		
		if( empty( $options['author-relation'] ) || ( $options['author-relation'] !== 'or' ) ){
			$queryPM['author__in'] = $authorsArray;
		}else{
			$this->listOptions['authorsArray'] = $authorsArray;
			add_filter( 'posts_where', array( $this, 'addORAuthors' ) );
		}
		
	}elseif( is_array( $exclude_authors ) && count( $exclude_authors ) ){
		
		if( empty( $options['author-relation'] ) || ( $options['author-relation'] !== 'or' ) ){
			$queryPM['author__not_in'] = $exclude_authors;
		}else{
			
			$this->listOptions['authorsArray'] = false;
			$this->listOptions['excludeAuthorsArray'] = $exclude_authors;
			add_filter( 'posts_where', array( $this, 'addORAuthors' ) );
		}
		
	}elseif( $authorsAll ){
		
		$authorsArray = get_users( array( 'fields' => 'ids' ) );
		
		if( empty( $options['author-relation'] ) || ( $options['author-relation'] !== 'or' ) ){
			$queryPM['author__in'] = $authorsArray;
		}else{
			$this->listOptions['authorsArray'] = $authorsArray;
			add_filter( 'posts_where', array( $this, 'addORAuthors' ) );
		}
	}
	
	
      if( !empty($options['posts_limit_skip']) ){
        
        $querySKIP = $queryPM;
        unset( $querySKIP['posts_per_page'] );
        unset( $querySKIP['paged'] );
        add_filter( 'post_limits', array($this, 'filterSkipLimit'), 10, 2);
		
        wp_reset_query();

        $otw_pm_post_skip_ids = new WP_Query( $querySKIP );

        remove_filter('post_limits', array($this, 'filterSkipLimit'), 10, 2);

        if( isset( $otw_pm_post_skip_ids->posts ) && count( $otw_pm_post_skip_ids->posts ) ) {
          $skip_post_ids = array();

          foreach( $otw_pm_post_skip_ids->posts as $skip_post_data ):
            $skip_post_ids[ $skip_post_data->ID ] = $skip_post_data->ID;
          endforeach;
        
          $queryPM['post__not_in'] = $skip_post_ids;
        }
		
      }
        
      if( !empty($options['posts_limit']) ) {
		
        $queryID = $queryPM;
        unset( $queryID['posts_per_page'] );
        unset( $queryID['paged'] );
        if( $queryPM['posts_per_page'] == -1 ){
    		unset( $queryPM['posts_per_page'] );
        }

        add_filter( 'post_limits', array($this, 'filterLimit'), 10, 2);
		
        wp_reset_query();
        $otw_pm_post_ids = new WP_Query( $queryPM );
        remove_filter('post_limits', array($this, 'filterLimit'), 10, 2);

        if( isset( $otw_pm_post_ids->posts ) && count( $otw_pm_post_ids->posts ) ) {
          $post_ids = array();
			
          foreach( $otw_pm_post_ids->posts as $post_data ):
            $post_ids[ $post_data->ID ] = $post_data->ID;
          endforeach;

          $queryPM['post__in'] = $post_ids;
			
          wp_reset_query();

          $otw_pm_posts = new WP_Query( $queryPM );
			
        } else {
          $otw_pm_posts = $otw_pm_post_ids;
        }

      } else {
        wp_reset_query();
        $otw_pm_posts = new WP_Query( $queryPM );
      }
      
    }

  	
    return $otw_pm_posts;
    
  }

	public function addORAuthors( $query ){
		
		global $wpdb;
		
		$query = str_replace( "\n", " ", $query );
		
		if( !empty( $this->listOptions['authorsArray'] ) ){
			
			if( preg_match( "/AND (\(.*term_taxonomy_id.*\)) AND/", $query, $matches ) ){
			
				$query = str_replace( $matches[1], '('.$matches[1]." OR {$wpdb->posts}.post_author IN (".implode( ',', $this->listOptions['authorsArray'] ).' ) ) ', $query );
			}else{
				$query .= " AND {$wpdb->posts}.post_author IN (".implode( ',', $this->listOptions['authorsArray'] ).") ";
			}
			
		}elseif( !empty( $this->listOptions['excludeAuthorsArray'] ) ){
			
			if( preg_match( "/AND (\(.*term_taxonomy_id.*\)) AND/", $query, $matches ) ){
			
				$query = str_replace( $matches[1], '('.$matches[1]." OR {$wpdb->posts}.post_author NOT IN (".implode( ',', $this->listOptions['excludeAuthorsArray'] ).' ) ) ', $query );
			}else{
				$query .= " AND {$wpdb->posts}.post_author NOT IN (".implode( ',', $this->listOptions['excludeAuthorsArray'] ).") ";
			}
		}
		
		return $query;
	}
  public function filterLimit( $limit, $query ) {
     return 'LIMIT 0, '. $this->listOptions['posts_limit'];
  }
  
  public function filterSkipLimit( $limit, $query ) {
     return 'LIMIT 0, '. $this->listOptions['posts_limit_skip'];
  }

  /**
   * Get a list of all the item in the DB
   * @return array()
   */
  public function getLists () {
    $otw_lists = get_option( 'otw_pm_lists' );

    return $otw_lists;
  }

  /**
   * Get a specific item based on it's ID
   * @param $id - int
   * @return array()
   */
  public function getItemById ( $id = null ) {
    $otw_lists = get_option( 'otw_pm_lists' );
    
    if( !empty( $otw_lists['otw-pm-list']['otw-pm-list-'.$id] ) ) {
      $otw_list = $otw_lists['otw-pm-list']['otw-pm-list-'.$id];
      return $otw_list; 
    }

    return null;
  }

  /**
   * Get All Categories That have content and prepare the content for Select2 jQuery plugin use
   * @return array()
   */
public function select2Categories(){
	$args = array(
		'hide_empty' => 0
	);
	
	$categories = get_terms( $this->portfolio_category, $args );
	
	$catCount = 0;
	$categoriesData = '';
	foreach( $categories as $category ){
		$categoriesData[$catCount]['id'] = $category->term_id;
		$categoriesData[$catCount]['text'] = $category->name;
		$catCount++;
	}
	return array(
		'categories'  => $categoriesData,
		'count'       => $catCount
	);
}

  /**
   * Get All Tags That have content and prepare the content for Select2 jQuery plugin use
   * @return array()
   */
public function select2Tags(){
	$args = array(
		'hide_empty' => 0
	);
	
	$tags = get_terms( $this->portfolio_tag, $args );
	
	$tagCount = 0;
	$tagsData = '';
	foreach( $tags as $tag ){
		$tagsData[$tagCount]['id'] = $tag->term_id;
		$tagsData[$tagCount]['text'] = $tag->name;
		$tagCount++;
	}
	return array(
		'tags'  => $tagsData,
		'count' => $tagCount
	);
}

  /**
   * Get All Users and prepare the content for Select2 jQuery plugin use
   * @return array()
   */
  public function select2Users () {
    $users = get_users();
    $userCount = 0;
    $usersData = '';
    foreach( $users as $user):
      $usersData[$userCount]['id'] = $user->data->ID;
      $usersData[$userCount]['text'] = $user->data->user_login;
      $userCount++;
    endforeach;

    return array(
      'users' => $usersData,
      'count' => $userCount
    );
  }

  /**
   * Get All Page and prepare the content for Select2 jQuery plugin use
   * @return array()
   */
  public function select2Pages () {
    $pages = get_pages();
    $pageCount = 0;
    $pagesData = '';
    foreach( $pages as $page ):
      $pagesData[$pageCount]['id'] = $page->ID;
      $pagesData[$pageCount]['text'] = $page->post_title;
      $pageCount++;
    endforeach;

    return array(
      'pages' => $pagesData,
      'count' => $pageCount
    );
  }


}

} // End if class exists