<?php
/**
 * File Used to predefine variables 
 * $content - used on Add New List - preset default values
 * $widgets - used on Add New List - determin if a list is a widget or not
 */

  // Default Form Values
  $content = array(
    'list_name'               => '',
    'template'                => 0,
    'categories'              => '',
    'exclude_categories'      => '',
    'exclude_tags'            => '',
    'exclude_users'           => '',
    'select_categories'       => '',
    'all_categories'          => '',
    'tags'                    => '',
    'select_tags'             => '',
    'all_tags'                => '',
    'users'                   => '',
    'select_users'            => '',
    'all_users'               => '',
    'portfolio-items'              => 'media,title,meta,description,continue-reading',
    'meta-items'              => 'category,tags',
    'posts_limit'             => '',
    'posts_limit_skip'        => '',
    'posts_order'             => 'created_asc',
    'portfolio_list_title'         => '',
    'view_all_page'           => '',
    'view_all_page_text'      => '',
    'continue_reading'        => '',
    'strip_tags'              => 'yes',
    'strip_shortcodes'        => 'yes',
    'posts_limit_page'        => 10,
    'excerpt_length'          => 20,
    'image_link'              => 'single',
    'title_link'              => 'single',
    'image_hover'             => 'hover-style-1-full',
    'icon_hover'              => 0, 
    'show-pagination'         => 1,
    'show-post-icon'          => 0,
    'show-delimiter'          => 0,
    'show-border'             => 0,
    'show-background'         => 0,
    'show-social-icons'       => 1,
    'view_all_page'           => '',
    'view_all_page_link'      => '',
    'view_all_target'         => 0,
    'meta_type_align'         => 'horizontal',
    'meta_type'               => 'full',
    'meta_icons'              => 0,
    'date_created'            => '',
    'date_modified'           => '',
    'show-slider-title'       => 1,
    'space-tiles'             => 1,
    'title-color'             => '',
    'title_font'              => '',
    'title-font-size'         => '',
    'title-font-style'        => '',
    'meta-color'              => '',
    'meta_font'               => '',
    'meta-font-size'          => '',
    'meta-font-style'         => '',
    'excpert-font-size'       => '',
    'excpert-font-style'      => '',
    'excpert-color'           => '',
    'excpert_font'            => '',
    'read-more-color'         => '',
    'read-more_font'          => '',
    'read-more-font-size'     => '',
    'read-more-font-style'    => '',
    'custom_css'              => '',
    'slider_title_alignment'  => '',
    'slider_border'           => 0,
    'slider_title_bg'         => 1,
    'slider_nav'              => 1,
    'media_width'             => '',
    'cat-tag-relation'        => 'OR',
    'show-news-cat-filter'    => 1,
    'show-news-sort-filter'   => 1,
    'show-carousel-nav'       => 1,
    'slider-auto-scroll'      => 1,
    'show-mosaic-cat-filter'  => 1,
    'show-mosaic-sort-filter' => 1,
    'mosaic-content'          => 1,
    'horizontal-space-tiles'  => 1,
    'horizontal-content'      => 1,
    'grid-space-tiles'  => 1,
    'newspaper-space-tiles'  => 1,
    'show-social-icons-facebook'   => 1,
    'show-social-icons-twitter'    => 1,
    'show-social-icons-googleplus' => 1,
    'show-social-icons-linkedin'   => 1,
    'show-social-icons-pinterest'  => 1,
    'show-social-icons-custom'  => '',
    'border-color' => '',
    'border-size' => '',
    'border-style' => '',
    'background-color' => '',
    'horizontal-cell-width-0' => '244',
    'horizontal-cell-width-1' => '345',
    'horizontal-cell-width-2' => '246',
    'horizontal-cell-width-3' => '478',
    'horizontal-cell-width-4' => '264',
    'horizontal-cell-width-5' => '600',
    'horizontal-cell-width-6' => '172',
    'horizontal-cell-width-7' => '130',
    'horizontal-cell-width-8' => '391',
    'horizontal-cell-width-9' => '738'
  );

  $widgets = array(
    'widget-lft', 'widget-right', 'widget-top',
    '2-column-carousel-wid', '3-column-carousel-wid', '4-column-carousel-wid'
  );
  
	$details = $this->get_details();
	

  $templateOptions = array(
    array(
      'name'    => '1-column',
      'width'   => 740,
      'height'  => 340,
      'crop'    => false
    ),

    array(
      'name'    => '4-column',
      'width'   => 220,
      'height'  => 120,
      'crop'    => false
    ),
    array(
      'name'    => '1-column-lft-img',
      'width'   => 300,
      'height'  => 220,
      'crop'    => false
    ),
    array(
      'name'    => '3-column-news',
      'width'   => 350,
      'height'  => 0,
      'crop'    => false
    ),
    array(
      'name'    => 'timeline',
      'width'   => 460,
      'height'  => 0,
      'crop'    => false
    ),
    array( 
      'name'    => 'widget-lft', 
      'width'   => 60,
      'height'  => 60,
      'crop'    => false
    ),
    array( 
      'name'    => 'slider', 
      'width'   => 960,
      'height'  => 400,
      'crop'    => false
    ),
    array( 
      'name'    => '3-column-carousel', 
      'width'   => 350,
      'height'  => 250,
      'crop'    => false
    )
  );