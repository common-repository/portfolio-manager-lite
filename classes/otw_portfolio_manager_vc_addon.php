<?php

class OTWPMLVCExtendAddonClass{

	private $has_vc = false;
	
	function __construct(){
		
		$this->otwPMQuery = new OTWPMLQuery();
		$this->otwDispatcher = new OTWPMLDispatcher();
		$this->otwCSS = new OTWPMLCss();
		
		add_action( 'init', array( $this, 'integrateWithVC' ) );
		
		add_shortcode( 'otw_pm_vc', array( $this, 'renderShortcode' ) );
		
	}
	
	public function renderShortcode( $params ){
		
		if( isset( $params['otw_portfolio_list'] ) && intval( $params['otw_portfolio_list'] ) ){
			return do_shortcode( '[otw-pm-list id="'.esc_attr( $params['otw_portfolio_list'] ).'"]' );
		}
	}
	
	public function integrateWithVC(){
		// Check if Visual Composer is installed
		if ( defined( 'WPB_VC_VERSION' ) ) {
			$this->has_vc = true;
		}
		
		if( $this->has_vc ){
			
			$lists = $this->otwPMQuery->getLists();
			
			$options = array();
			$default_value = 0;
			
			if( isset($lists['otw-pm-list'] ) && is_array($lists['otw-pm-list'] ) ){
				foreach( $lists['otw-pm-list'] as $optionData ){
					
					if( isset( $optionData['id'] ) ){
						
						if( $default_value ){
							$default_value = $optionData['id'];
						}
						
						$options[ $optionData['list_name'] ] = $optionData['id'];
					}
				}
			}
			
			vc_map( array(
				"name" => esc_html__("Portfolio Manager", 'otw_pml'),
				"description" => esc_html__("Select a post list created with Portfolio Manager plugin", 'otw_pml'),
				"base" => "otw_pm_vc",
				"class" => "",
				"controls" => "full",
				"icon" => WP_PLUGIN_URL . DS . OTW_PML_PATH . DS .'assets'. DS .'img'. DS .'menu_icon.png', // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
				"category" => esc_html__('Portfolio Manager', 'otw_pml'),
				"params" => array(
					array(
						'type' => 'dropdown',
						'holder' => 'div',
						'class' => '',
						'heading' => esc_html__( 'Portfolio list', 'otw_pml'),
						'param_name' => 'otw_portfolio_list',
						'value' => $options,
						'std' => $default_value,
						'description' => esc_html__( 'Description for portfolio list.', 'otw_pml')
					)
				)
			) );
		}
	}
} 
new OTWPMLVCExtendAddonClass();