<?php
/**
 * Theme wrapper class
 *
 * @link http://roots.io/an-introduction-to-the-roots-theme-wrapper/
 * @link http://scribu.net/wordpress/theme-wrappers.html
 * @package mindgrub-starter-theme
 */

/**
 * Include the main template file.
 */
function mg_get_template() {
	global $post;
	@include MG_Theme_Wrapper::$main_template;
}

/**
 * Include the most specific header template.
 */
function mg_get_header() {
	global $post;
	@include new MG_Theme_Wrapper( 'partials/header.php' );
}

/**
 * Include the most specific footer template.
 */
function mg_get_footer() {
	global $post;
	@include new MG_Theme_Wrapper( 'partials/footer.php' );
}

/**
 * Include the most specific sidebar template.
 */
function mg_get_sidebar() {
	global $post;
	@include new MG_Theme_Wrapper( 'partials/sidebar.php' );
}

/**
 * Class to wrap template files in header, footer, and sidebar.
 */
class MG_Theme_Wrapper {
	/**
	 * Stores the full path to the main template file.
	 * 
	 * @var string
	 */
	public static $main_template;

	/**
	 * Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
	 * 
	 * @var string
	 */
	public static $base;

	/**
	 * Create array of possible templates for the requested post, according to template hierarchy.
	 * 
	 * @param string $template Fallback template if no other matches are found.
	 */
	public function __construct( $template = 'wrapper.php' ) {
		$this->slug      = basename( $template, '.php' );
		$this->templates = array( $template );

		if ( self::$base ) {
			$str = substr( $template, 0, -4 );
			array_unshift( $this->templates, sprintf( $str . '-%s.php', self::$base ) );
		}
	}

	/**
	 * Filter the templates array and return path to template to use.
	 * 
	 * @return string Path to most specific template.
	 */
	public function __toString() {
		$this->templates = apply_filters( 'wrap_' . $this->slug, $this->templates );
		return locate_template( $this->templates );
	}

	/**
	 * Store full path and basename of main template file.
	 * 
	 * @param string $main Full path of the main template file.
	 */
	public static function wrap( $main ) {
		self::$main_template = $main;
		self::$base          = basename( self::$main_template, '.php' );

		if ( 'index' === self::$base ) {
			self::$base = false;
		}

		return new MG_Theme_Wrapper();
	}
}
add_filter( 'template_include', array( 'MG_Theme_Wrapper', 'wrap' ), 99 );
