<?php
/**
 * Create / Update / Display OTW Portfolio Manager Widgets
 */
class OTWPML_Widget extends WP_Widget {

	private $otwPMQuery = null;
	private $otwDispatcher = null;
	private $otwCSS = null;
	
	public $portfolio_post_type = 'otw_pm_portfolio';
	
	public $portfolio_category = 'otw_pm_portfolio_category';
	
	public $portfolio_tag = 'otw_pm_portfolio_tag';
	
	// Contructor 
	public function __construct() {

		parent::__construct(
			'otw_pm_widget_items', 
			'OTW Portfolio Manager Widget', 
			array(
				'description' => esc_html__('With the help of this widget you can add your created Widget Lists to the sidebars', 'otw_pml')
			)
		);
		
		$this->otwPMQuery = new OTWPMLQuery();
		$this->otwPMQuery->portfolio_category  = $this->portfolio_category;
		$this->otwPMQuery->portfolio_tag  = $this->portfolio_tag;
		$this->otwPMQuery->portfolio_post_type  = $this->portfolio_post_type;
		
		$this->otwDispatcher = new OTWPMLDispatcher();
		$this->otwDispatcher->portfolio_category  = $this->portfolio_category;
		$this->otwDispatcher->portfolio_tag  = $this->portfolio_tag;
		$this->otwDispatcher->portfolio_post_type  = $this->portfolio_post_type;
		
		$this->otwCSS = new OTWPMLCss();
	}

	/** 
	 * Widget Form Creation
	 * Form used to input the List ID.
	 * Once a List is created using the plugin there is going to be and ID supplied
	 * User will need to insert that ID within this FORM
	 */
	function form ( $instance ) {

		( !empty( $instance['id'] ) )? $currentWidgetID = $instance['id'] : $currentWidgetID = null;
		( !empty( $instance['title'] ) )? $currentWidgetTitle = $instance['title'] : $currentWidgetTitle = null;

		$field_id = $this->get_field_id( 'id' );
		$field_idName = $this->get_field_name( 'id' );
		$field_title = $this->get_field_id( 'title' );
		$field_titleName = $this->get_field_name( 'title' );

		$lists = $this->otwPMQuery->getLists();
		
		$htmlForm  = '<p>';
		$htmlForm .= '<label for="'.esc_attr( $field_title ).'">'. esc_html__('Title:', 'otw_pml') .'</label><br>';
		$htmlForm .= '<input type="text" id="'.esc_attr( $field_title ).'" name="'.esc_attr( $field_titleName ).'" value="'.esc_attr( $currentWidgetTitle ).'" class="widefat"><br><br>';

		$htmlForm .= '<label for="'.esc_attr( $field_id ).'">'. esc_html__('OTW Portfolio List Widget:', 'otw_pml') .'</label><br>';
		$htmlForm .= '<select id="'.esc_attr( $field_id ).'" name="'.esc_attr( $field_idName ).'">';
		$htmlForm .= '<option value="0"> ---'.__('Select Widget', 'otw_pml').'--- </option>';

		foreach( $lists['otw-pm-list'] as $optionData ): 
			
			if( isset( $optionData['id'] ) ) {
				
				$selected = '';
				if( $optionData['id'] == $currentWidgetID ) {
					$selected = 'selected="selected" ';
				}
				$htmlForm .= "<option value=\"".$optionData['id']."\" ".$selected.">".$optionData['list_name']."</option>";
			}
		endforeach;

		$htmlForm .= '</select>';
		$htmlForm .= '</p>';
 		
 		echo $htmlForm;

	}

	// Update widget
	function update ( $new_instance, $old_instance ) {
		return $new_instance;
	}

	// Display Widget
	function widget ( $args, $instance ) {

		$widgetID = $instance['id'];

		if( !empty( $widgetID ) ) {

			// Get Current Items in the DB
			$otw_pm_options = $this->otwPMQuery->getItemById( $widgetID );

			if ( !empty( $otw_pm_options ) ) {

				$otw_posts_result = $this->otwPMQuery->getPosts( $otw_pm_options );

				$templateResult = $this->otwDispatcher->generateTemplate( $otw_pm_options, $otw_posts_result );

				$widgetOutput = $templateResult;

				if( !empty( $instance['title'] ) ) {
					$widgetOutput  = $args['before_title'] . $instance['title'] . $args['after_title'];
					$widgetOutput .= $templateResult;

				}

				if( !empty( $args['before_widget'] ) && !empty( $args['after_widget'] ) ) {
					$widgetOutput = $args['before_widget'] . $widgetOutput . $args['after_widget'];
				}

	      // Enqueue Custom Styles CSS
	      			global $wp_filesystem;
				
				if( otw_init_filesystem() ){
					if( $wp_filesystem->exists(SKIN_PML_PATH . DS . 'otw-pm-list-'.$widgetID.'-custom.css') ) {
						wp_register_style( 'otw-pm-custom-widget-'.$widgetID.'-css', SKIN_PML_URL .'otw-pm-list-'.$widgetID.'-custom.css' );
						wp_enqueue_style( 'otw-pm-custom-widget-'.$widgetID.'-css' );
					}
				}

		    include( dirname( __FILE__ ) . '/../include' . DS . 'fonts.php' );
		    $googleFontsArray = json_decode($allFonts);

	      
	      if( !empty( $googleWidgetFonts ) ) {
	        $httpFonts = (!empty($_SERVER['HTTPS'])) ? "https" : "http";
	        $url = $httpFonts.'://fonts.googleapis.com/css?family='.$googleWidgetFonts.'&variant=italic:bold';
	        wp_enqueue_style('otw-pm-widget-googlefonts',$url, null, null);
	      }

				echo $widgetOutput;
			}
			 
		}

	}

}
?>