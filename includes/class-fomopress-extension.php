<?php
/**
 * Register all extensions for the plugin.
 * 
 * @link       https://wpdeveloper.net
 * @since      1.0.0
 * 
 * @package    FomoPress
 * @subpackage FomoPress/extensions
 * @author     WPDeveloper <support@wpdeveloper.net>
 */
class FomoPress_Extension {
    /**
     * Settings options for all notifications we saw
     * @var array
     */
    protected static $settings;
    /**
     * Limit of the store
     * for storing notification in options table.
     * @var array ( multi dimensional, has key for every types of notification );
     */
    protected $cache_limit;
    /**
     * Prefix
     *
     * @var string
     */
    protected $prefix = 'fomopress_';
    /**
     * All Active Notification Items
     *
     * @var array
     */
    public static $active_items = [];
    /**
     * Constructor of extension for ready the settings and cache limit.
     */
    public function __construct( ){
        self::$settings      = FomoPress_DB::get_settings();

        if( ! empty( self::$settings ) && isset( self::$settings['cache_limit'] ) ) {
            $this->cache_limit = intval( self::$settings['cache_limit'] );
        }
        /**
         * Get all Active Notification Items
         */
        self::$active_items = FomoPress_Admin::get_active_items();
    }
    /**
     * this function is responsible for check a type of notification is created or not
     *
     * @param string $type
     * @return boolean
     */
    public static function is_created( $type = '' ){
        if( empty( $type ) ) {
            return false;
        }

        if( ! empty( self::$active_items ) ) {
            return in_array( $type, array_keys( self::$active_items ) );
        } else {
            return false;
        }
    }
    /**
     * This method is responsible for get all 
     * the notifications we have stored
     *
     * @param string $type
     * @return array - Multidimensional, has a key for every type of notification with all data stored.
     */
    public function get_notifications( $type = '' ){
        $notifications = FomoPress_DB::get_notifications();
        if( empty( $type ) || empty( $notifications ) || ! isset( $notifications[ $type ] ) ) {
            return [];
        }
        return $notifications[ $type ];
    }
    /**
     * This method is responsible for save the data
     *
     * @param string $type - notification type
     * @param array $data - notification data to save.
     * @return boolean
     */
    protected function save( string $type = '', array $data = [] ){
        if( empty( $type ) ) {
            return;
        }
        $notifications = FomoPress_DB::get_notifications();
        $notifications[ $type ] = $data;
        return FomoPress_DB::update_notifications( $notifications );
    }
    /**
     * This function will convert all the data key into double curly braces format
     * {{key}} = $value
     *
     * @param boolean $data
     * @return void
     */
    protected static function newData( $data = array() ) {
        if( empty( $data ) ) return;
        $new_data = array();
        foreach( $data as $key => $single_data ) {
            if( $key == 'link' || $key == 'post_link' ) continue;
            if( $key == 'timestamp' ) {
                $new_data[ '{{time}}' ] = FomoPress_Helper::get_timeago_html( $single_data );
                continue;
            }
            $new_data[ '{{'. $key .'}}' ] = $single_data;
        }
        return $new_data;
    }
    /**
     * This function responsible for all
     *
     * @param array $data
     * @param boolean $settings
     * @return void
     */
    public function frontend_html( $data = [], $settings = false, $template = '' ){
        if( ! is_object( $settings ) || empty( $data ) ) {
            return;
        }
        $output = '';
        $unique_id = uniqid( 'fomopress-notification-' ); 
        $image_data = self::get_image_url( $data, $settings );
        $output .= '<div id="'. esc_attr( $unique_id ) .'" class="fomopress-notification '. self::get_classes( $settings ) .'">';
            $output .= '<div class="fomopress-notification-inner '. self::get_classes( $settings, 'inner' ) .'">';
                if( $image_data ) :
                    $output .= '<div class="fomopress-notification-image fp-img-'. esc_attr( $settings->image_shape ) .' fp-img-'. esc_attr( $settings->image_position ) .'">';
                        $output .= '<img src="'. $image_data['url'] .'" alt="'. esc_attr( $image_data['alt'] ) .'">';
                    $output .= '</div>';
                endif;
                $output .= '<div class="fomopress-notification-content">';
                    $output .= FomoPress_Template::get_template_ready( $settings->{ $template }, self::newData( $data ) );
                $output .= '</div>';
                if( $settings->close_button ) :
                    $output .= '<span class="fomopress-notification-close">x</span>';
                endif;
            $output .= '</div>';
            $output .= '<!-- Link Code Will Be Here -->';
        $output .= '</div>';
        return $output;
    }
    /**
     * This function is responsible for generate classes for wrapper, inner
     *
     * @param stdClass $settings
     * @param string $type
     * @return string
     */
	public static function get_classes( $settings, $type = 'wrapper' ){
		if( empty( $settings ) ) return;
		$classes = [];
		
		if( $settings->theme == 'customize' ) {
			$classes[ 'inner' ][] = 'fomopress-customize-style-' . $settings->id;
		}
		if( $settings->close_button ) {
			$classes[ 'inner' ][] = 'fomopress-has-close-btn';
		}
		$classes[ 'wrapper' ][] = 'fomopress-' . esc_attr( $settings->conversion_from );
		$classes[ 'wrapper' ][] = 'fomopress-' . esc_attr( $settings->conversion_position );
		$classes[ 'wrapper' ][] = 'fomopress-notification-' . $settings->id;

		$classes[ 'inner' ][] = 'fp-notification-' . esc_attr( $settings->theme );

		return implode( ' ', $classes[ $type ] );
	}
    /**
     * This function is responsible for getting the image url 
     * using Product ID or from default image settings.
     *
     * @param array $data
     * @param stdClass $settings
     * @return array of image data, contains url and title as alt text
     */
    protected static function get_image_url( $data = [], $settings ) {
        $image_url = $alt_title = '';
        $alt_title = isset( $data['name'] ) ? $data['name'] : $data['title'];
        switch( $settings->display_type ) {
            case 'comments' :
                if( $settings->show_avatar ) {
                    $avatar = '';
                    if( isset( $data['user_id'] ) ) {
                        $avatar = get_avatar_url( $data['user_id'], array(
                            'size' => '60'    
                        ));
                    }
                    $image_url = $avatar;
                }
                break;
            case 'conversions' :
                if( $settings->conversion_from != 'custom' ) {
                    if( $settings->show_product_image && has_post_thumbnail( $data['product_id'] ) ) {
                        $product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $data['product_id'] ), '_fomopress_notification_image', false );
                        $image_url = is_array( $product_image ) ? $product_image[0] : '';
                    }
                }
                if( $settings->conversion_from == 'custom' ) {
                    if( ! empty( $data ) ) {
                        $image_url = $alt_title = '';
                        if( isset( $data['image'] ) && ! empty( $data['image'] ) ) {
                            $product_image = wp_get_attachment_image_src( $data['image']['id'], '_fomopress_notification_image', false );
                            $image_url = is_array( $product_image ) ? $product_image[0] : '';
                        }
                        if( isset( $data['title'] ) && ! empty( $data['title'] ) ) {
                            $alt_title = $data['title'];
                        }
                    }
                }
                break;
        }

        if( isset( $settings->show_default_image ) && $settings->show_default_image && $image_url == '' ) {
            $product_image = wp_get_attachment_image_src( $settings->image_url['id'], '_fomopress_notification_image', false );
            $image_url = is_array( $product_image ) ? $product_image[0] : '';
        }       

        if( $image_url ) {
            return [ 'url' => $image_url, 'alt' => $alt_title ];
        }

        return false;
    }
}

/**
 * This function is responsible for getting frontend
 * html to generate the output.
 * 
 * @param string $key
 * @param array $data
 * @param stdObject $settings
 */
function get_extension_frontend( $key, $data, $settings = false ){
    if( empty( $key ) ) return;
    global $fomopress_extension_factory;
    $extension_name = $fomopress_extension_factory->get_extension( $key );
    if( class_exists( $extension_name ) ) {
        $extension = new $extension_name;
        return $extension->frontend_html( $data, $settings, $extension->template );
    }
}