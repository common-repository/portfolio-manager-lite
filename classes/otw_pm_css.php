<?php
if( !class_exists('OTWPMLCss') ) {

class OTWPMLCss {

  public $contentCss = '';

  public $googleFontsString = null;

  public function __construct() {}

  /**
   * Build Custom Css and write it to a file
   * @param $style - array
   * @param $filePath - string
   * @return void
   */
  public function buildCSS( $style = array(), $filePath = null) {
    $this->contentCss = '';
    if( !empty( $style['font'] ) ) {
      $this->contentCss .= 'font-family: "'. $style['font'] .'" !important;';
    }

    if( !empty( $style['color'] ) ) {
      $this->contentCss .= 'color:'. $style['color'] .' !important;';
    }

    if( !empty( $style['size'] ) ) {
      $this->contentCss .= 'font-size:'. $style['size'] .'px !important;';
    }

    if( !empty( $style['font-style'] ) ) {
      if( $style['font-style'] == 'bold' ) {
        $this->contentCss .= 'font-weight: bold !important; ';
        $this->contentCss .= 'font-style: normal !important; ';
      } elseif( $style['font-style'] == 'italic' ) {
        $this->contentCss .= 'font-style: italic !important; ';
      } elseif( $style['font-style'] == 'bold_italic' ) {
        $this->contentCss .= 'font-weight: bold !important; ';
        $this->contentCss .= 'font-style: italic !important; ';
      } elseif( $style['font-style'] == 'regular' ) {
        $this->contentCss .= 'font-style: normal !important; ';
      }
    }
    
	if( !empty( $style['border-style'] ) ) {
		$this->contentCss .= 'border-style: '.$style['border-style'].' !important; ';
	}
	if( !empty( $style['border-size'] ) ) {
		$this->contentCss .= 'border-width: '.$style['border-size'].'px !important; ';
	}
	if( !empty( $style['border-color'] ) ) {
		$this->contentCss .= 'border-color: '.$style['border-color'].' !important; ';
	}
	if( !empty( $style['background-color'] ) ) {
		$this->contentCss .= 'background-color: '.$style['background-color'].' !important; ';
	}

    if( !empty( $style['container'] ) && !empty( $filePath ) ) {
		global $wp_filesystem;
		
		if( otw_init_filesystem() ){
			
			// Get Current Css From File
			$customContentCss = '';
			if( $wp_filesystem->exists( $filePath ) ) {
				$customContentCss = $wp_filesystem->get_contents( $filePath );
			}
			
			$customBuildCss = ' '.$style['container'] . '{' . $this->contentCss . '}' . $customContentCss;
			str_replace('\\', '', $customBuildCss);
			
			$wp_filesystem->put_contents( $filePath , $customBuildCss);
			
			$this->contentCss = '';
		}
    }

  }

  /**
   * Write raw css from an textarea to a file
   * @param $rawCSS - string
   * @param $filePath - string
   * @return void
   */
	public function writeCSS ( $rawCSS = null, $filePath = null ) {
		
		if( !empty( $rawCSS ) && !empty( $filePath ) ) {
			
			global $wp_filesystem;
			
			if( otw_init_filesystem() ){
				// Get Current Css From File
				$customContentCss = '';
				if( $wp_filesystem->exists( $filePath ) ) {
					$customContentCss = $wp_filesystem->get_contents( $filePath );
				}
				$rawBuildCSS = $customContentCss . $rawCSS;
				$wp_filesystem->put_contents( $filePath , $rawBuildCSS);
			}
		}
	}

  public function getGoogleFonts ( $fonts = null, $fontList = array() ) {
    if( empty( $fonts ) || empty($fontList) || !is_array($fonts)) {
      return null;
    }

    foreach( $fonts as $font ):
      // Font ID is from the Google Fonts
      if( $font > 9 ) {
        $this->googleFontsString .= urlencode($fontList[ $font ]->text).'|';
      }
    endforeach;

    return $this->googleFontsString;
  }


} // End OTWPMLCss Class

} // End IF class exists