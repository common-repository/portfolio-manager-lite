<?php
class OTW_Shortcode_Portfolio_Manager extends OTW_Shortcodes{
	
	public function __construct(){
		
		$this->has_custom_options = false;
		
		$this->has_preview = false;
		
		parent::__construct();
	}
	
	/**
	 * apply settings
	 */
	public function apply_settings(){
		
		$this->settings = array();
		
		$this->settings['portfoliolists_options'] = array( '' => '--/--' );
		
		if( class_exists( 'OTWPMQuery' ) ){
			$this->otwPMQuery = new OTWPMQuery();
		}elseif( class_exists( 'OTWPMLQuery' ) ){
			$this->otwPMQuery = new OTWPMLQuery();
		}
		
		if( class_exists( 'OTWPMDispatcher' ) ){
			$this->otwPMDispatcher = new OTWPMDispatcher();
		}elseif( class_exists( 'OTWPMLDispatcher' ) ){
			$this->otwPMDispatcher = new OTWPMLDispatcher();
		}
		
		if( class_exists( 'OTWPMCss' ) ){
			$this->otwPMCSS = new OTWPMCss();
		}elseif( class_exists( 'OTWPMLCss' ) ){
			$this->otwPMCSS = new OTWPMLCss();
		}
		
		$lists = $this->otwPMQuery->getLists();
		
		if( isset($lists['otw-pm-list'] ) && is_array($lists['otw-pm-list'] ) ){
			foreach( $lists['otw-pm-list'] as $optionData ){
				if( isset( $optionData['id'] ) ){
					$this->settings['portfoliolists_options'][ $optionData['id'] ] = $optionData['list_name'];
				}
			}
		}
		
		$this->settings['default_portfoliolist'] = '';
		
	}
	/**
	 * Shortcode icon_link admin interface
	 */
	public function build_shortcode_editor_options(){
		
		$this->apply_settings();
		
		$html = '';
		
		$source = array();
		if( otw_post( 'shortcode_object', false, array(), 'json' ) ){
			$source = otw_post( 'shortcode_object', array(), array(), 'json' );
		}
		$html .= '<br />';
		$html .= OTW_Form::select( array( 'id' => 'otw-shortcode-element-portfoliolist_id', 'label' => $this->get_label( 'Select portfolio list' ), 'parse' => $source, 'options' => $this->settings['portfoliolists_options'], 'value' => $this->settings['default_portfoliolist'] )  );
		
		return $html;
	}
	
	/** build icon link shortcode
	 *
	 *  @param array
	 *  @return string
	 */
	public function build_shortcode_code( $attributes ){
		
		$code = '';
		
		if( !isset( $attributes['portfoliolist_id'] ) || !strlen( trim( $attributes['portfoliolist_id'] ) ) ){
			$this->add_error( $this->get_label( 'Portfolio list is required field' ) );
		}
		
		if( !$this->has_error ){
		
			$code = '[otw_shortcode_portfolio_manager';
			
			$code .= $this->format_attribute( 'portfoliolist_id', 'portfoliolist_id', $attributes );
			
			$code .= ']';
			
			$code .= '[/otw_shortcode_portfolio_manager]';
			
		}
		
		return $code;
	}
	
	/**
	 * Process shortcode icon link
	 */
	public function display_shortcode( $attributes, $content ){
		
		$html = '';
		
		if( is_admin() ){
			$html = '<img src="'.$this->component_url.'images/sidebars-icon-placeholder.png'.'" alt=""/>';
		}elseif( isset( $attributes['portfoliolist_id'] ) ){
			$html = do_shortcode( '[otw-pm-list id="'.esc_attr( $attributes['portfoliolist_id'] ).'"]' );
		}
		return $this->format_shortcode_output( $html );
	}
	
	/**
	 * Return shortcode attributes
	 */
	public function get_shortcode_attributes( $attributes ){
		
		$shortcode_attributes = array();
		
		if( isset( $attributes['portfoliolist_id'] ) && isset( $this->settings['portfoliolists_options'][ $attributes['portfoliolist_id'] ] ) ){
			$shortcode_attributes['iname'] = $this->settings['portfoliolists_options'][ $attributes['portfoliolist_id'] ];
		}
		
		return $shortcode_attributes;
	}
}
?>