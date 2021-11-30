<?php
/**
 * Extension Abstract
 *
 * @package NotificationX\Extensions
 */

namespace NotificationX\Types;

use NotificationX\Core\Rules;
use NotificationX\Extensions\GlobalFields;
use NotificationX\GetInstance;
use NotificationX\Modules;
use NotificationX\NotificationX;

/**
 * Extension Abstract for all Extension.
 */
class Conversions extends Types {
    /**
     * Instance of Admin
     *
     * @var Admin
     */
	use GetInstance;

    // colored_themes
    public $priority = 5;
    public $themes = [];
    public $module = [
        'modules_woocommerce',
        'modules_edd',
        'modules_custom_notification',
        'modules_zapier',
        'modules_freemius',
        'modules_envato',
    ];

    public $conversions_count = array('conversions_conv-theme-seven', 'conversions_conv-theme-eight', 'conversions_conv-theme-nine');
    public $map_dependency = [];


    public $default_source    = 'woocommerce';
    public $default_theme = 'conversions_theme-one';

    /**
     * Initially Invoked when initialized.
     */
    public function __construct(){
        $this->id = 'conversions';
        $this->title = __('Sales Notification', 'notificationx');

        $is_pro = ! NotificationX::is_pro();
        // nx_colored_themes
        $common_fields = [
            'first_param'         => 'tag_name',
            'custom_first_param'  => __('Someone' , 'notificationx'),
            'second_param'        => __('just purchased', 'notificationx'),
            'third_param'         => 'tag_product_title',
            'custom_third_param'  => __('Anonymous Product', 'notificationx'),
            'fourth_param'        => 'tag_time',
            'custom_fourth_param' => __( 'Some time ago', 'notificationx' ),
        ];
        $this->themes = [
            'theme-one'   => [
                'source' => NOTIFICATIONX_ADMIN_URL . 'images/extensions/themes/nx-conv-theme-2.jpg',
                'image_shape' => 'square',
                'template'  => $common_fields,
            ],
            'theme-two'   => [
                'source' => NOTIFICATIONX_ADMIN_URL . 'images/extensions/themes/nx-conv-theme-1.jpg',
                'image_shape' => 'square',
                'template'  => $common_fields,
            ],
            'theme-three' => [
                'source' => NOTIFICATIONX_ADMIN_URL . 'images/extensions/themes/nx-conv-theme-3.jpg',
                'image_shape' => 'square',
                'template'  => $common_fields,
            ],
            'theme-four' => array(
                'is_pro' => true,
                'source' => NOTIFICATIONX_ADMIN_URL . 'images/extensions/themes/pro/nx-conv-theme-four.png',
                'image_shape' => 'circle',
                'template'  => $common_fields,
            ),
            'theme-five' => array(
                'is_pro' => true,
                'source' => NOTIFICATIONX_ADMIN_URL . 'images/extensions/themes/pro/nx-conv-theme-five.png',
                'image_shape' => 'circle',
                'template'  => $common_fields,
            ),
            // @todo pro map theme
            'conv-theme-six' => array(
                'is_pro' => true,
                'source' => NOTIFICATIONX_ADMIN_URL . 'images/extensions/themes/pro/nx-conv-theme-6.jpg',
                'image_shape' => 'circle',
            ),
            // @todo pro map theme
            'maps_theme' => array(
                'is_pro' => true,
                'source' => NOTIFICATIONX_ADMIN_URL . 'images/extensions/themes/pro/maps-theme.png',
                'image_shape' => 'square',
                'show_notification_image' => 'maps_image',
            ),
            'conv-theme-seven' => array(
                'is_pro' => true,
                'source' => NOTIFICATIONX_ADMIN_URL . 'images/extensions/themes/pro/nx-conv-theme-7.png',
                'image_shape' => 'rounded',
            ),
            'conv-theme-eight' => array(
                'is_pro' => true,
                'source' => NOTIFICATIONX_ADMIN_URL . 'images/extensions/themes/pro/nx-conv-theme-8.png',
                'image_shape' => 'circle',
            ),
            'conv-theme-nine' => array(
                'is_pro' => true,
                'source' => NOTIFICATIONX_ADMIN_URL . 'images/extensions/themes/pro/nx-conv-theme-9.png',
                'image_shape' => 'rounded',
            ),
        ];
        $this->templates = [
            'woo_template_new' => [
                'first_param' => GlobalFields::get_instance()->common_name_fields(),
                'third_param' => [
                    'tag_product_title' => __('Product Title', 'notificationx'),
                ],
                'fourth_param' => [
                    'tag_time' => __('Definite Time', 'notificationx'),
                ],
                '_themes' => [
                    'conversions_theme-one',
                    'conversions_theme-two',
                    'conversions_theme-three',
                    'conversions_theme-four',
                    'conversions_theme-five',
                ]
            ],
            'woo_template_sales_count' => [
                'first_param' => GlobalFields::get_instance()->common_name_fields(),
                'third_param' => [
                    'tag_product_title' => __('Product Title', 'notificationx'),
                ],
                'fourth_param' => [
                    // 'tag_time' => __('Definite Time', 'notificationx'),
                ],
                '_themes' => [
                    'conversions_conv-theme-six',
                    'conversions_conv-theme-seven',
                    'conversions_conv-theme-eight',
                    'conversions_conv-theme-nine',
                ]
            ],
        ];
        parent::__construct();
    }

    /**
     * Hooked to nx_before_metabox_load action.
     *
     * @return void
     */
    public function init_fields() {
        parent::init_fields();
        add_filter('nx_content_fields', [$this, 'content_fields'], 9);
        add_filter('nx_type_trigger', [$this, 'type_trigger'], 20);
    }

    /**
     * Get themes for the extension.
     *
     *
     * @param array $args Settings arguments.
     * @return mixed
     */
    public function type_trigger($triggers) {
        $triggers[$this->id]['link_type'] = "@link_type:product_page";
        return $triggers;
    }

    /**
     * Adding fields in the metabox.
     *
     * @param array $args Settings arguments.
     * @return mixed
     */
    public function content_fields($fields) {
        $content_fields = &$fields['content']['fields'];
        $content_fields['combine_multiorder'] = [
            'label'       => __('Combine Multi Order', 'notificationx'),
            'name'        => 'combine_multiorder',
            'type'        => 'checkbox',
            'priority'    => 100,
            'default'     => true,
            'description' => __('Combine order like, 2 more products.', 'notificationx'),
            // 'rules'  => ["and", ['is', 'type', $this->id], ['includes', 'source', [ 'woocommerce', 'edd' ]]],
            'rules' => Rules::logicalRule([
                Rules::is('type', $this->id),
                Rules::is('notification-template.first_param', 'tag_sales_count', true),
                Rules::includes('source', [ 'woocommerce', 'edd' ]),
            ]),
        ];

        /**
         * For edd and woocommerce
         */
        $content_fields['product_control'] = array(
            'label'    => __('Show Purchase Of', 'notificationx'),
            'name'     => 'product_control',
            'type'     => 'select',
            'priority' => 94,
            'default'  => 'none',
            'is_pro'   => true,
            'disable' => true,
            'options'  => GlobalFields::get_instance()->normalize_fields([
                'none'             => __('All', 'notificationx'),
                'product_category' => __('Product Category', 'notificationx'),
                'manual_selection' => __('Selected Product', 'notificationx'),
            ]),
        );

        $content_fields['category_list'] = array(
            'label'    => __('Select Product Category', 'notificationx'),
            'name'     => 'category_list',
            'type'     => 'select',
            'multiple' => true,
            'priority' => 95,
            'options'  => apply_filters('nx_conversion_category_list', []),
            'rules'       => Rules::logicalRule([
                Rules::is( 'product_control', 'product_category' ),
            ]),
        );

        $content_fields['product_list'] = array(
            'label'    => __('Select Product', 'notificationx'),
            'name'     => 'product_list',
            'type'     => 'select',
            'multiple' => true,
            'priority' => 96,
            'options'  => apply_filters('nx_conversion_product_list', []),
            'rules'       => Rules::logicalRule([
                Rules::is( 'product_control', 'manual_selection' ),
            ]),
        );

        $content_fields['product_exclude_by'] = array(
            'label'    => __('Exclude By', 'notificationx'),
            'name'     => 'product_exclude_by',
            'type'     => 'select',
            'priority' => 97,
            'default'  => 'none',
            'is_pro'   => true,
            'disable' => true,
            'options'  => GlobalFields::get_instance()->normalize_fields([
                'none'             => __('None', 'notificationx'),
                'product_category' => __('Product Category', 'notificationx'),
                'manual_selection' => __('Selected Product', 'notificationx'),
            ]),
        );

        $content_fields['exclude_categories'] = array(
            'label'    => __('Select Product Category', 'notificationx'),
            'name'     => 'exclude_categories',
            'type'     => 'select',
            'multiple' => true,
            'priority' => 98,
            'options'  => apply_filters('nx_conversion_category_list', []),
            'rules'       => Rules::logicalRule([
                Rules::is( 'product_exclude_by', 'product_category' ),
            ]),
        );
        $content_fields['exclude_products'] = array(
            'label'    => __('Select Product', 'notificationx'),
            'name'     => 'exclude_products',
            'type'     => 'select',
            'multiple' => true,
            'priority' => 99,
            'options'  => apply_filters('nx_conversion_product_list', []),
            'rules'       => Rules::logicalRule([
                Rules::is( 'product_exclude_by', 'manual_selection' ),
            ]),
        );

        return $fields;
    }

    /**
     * @todo remove in the future.
     *
     * @param [type] $data
     * @param [type] $settings
     * @return void
     */
    public function excludes_product( $data, $settings ){
        if( empty( $settings['product_exclude_by'] ) || $settings['product_exclude_by'] === 'none' ) {
            return $data;
        }

        $new_data = [];


        if( ! empty( $data ) ) {
            foreach( $data as $key => $product ) {
                if( $this->_excludes_product($product, $settings) ) {
                    $new_data[ $key ] = $product;
                }
            }
        }

        return $new_data;

    }

    public function _excludes_product( $product, $settings ){
        if( empty( $settings['product_exclude_by'] ) || $settings['product_exclude_by'] === 'none' ) {
            return true;
        }

        $product_category_list = [];

        $product_id = $product['product_id'];
        if( $settings['product_exclude_by'] == 'product_category' ) {
            $product_categories = get_the_terms( $product_id, 'product_cat' );
            if( ! is_wp_error( $product_categories ) ) {
                foreach( $product_categories as $category ) {
                    $product_category_list[] = $category->slug;
                }
            }

            $product_category_count = count( $product_category_list );
            $array_diff = array_diff( $product_category_list, $settings['exclude_categories'] );
            $array_diff_count = count( $array_diff );

            if( ! ( $array_diff_count < $product_category_count ) ) {
                return true;
            }
            $product_category_list = [];
        }
        if( $settings['product_exclude_by'] == 'manual_selection' ) {
            if( ! in_array( $product_id, $settings['exclude_products'] ) ) {
                return true;
            }
        }

        return false;

    }

    /**
     * @todo remove in the future.
     *
     * @param [type] $data
     * @param [type] $settings
     * @return void
     */
    public function show_purchaseof( $data, $settings ){
        if( empty( $settings['product_control'] ) || $settings['product_control'] === 'none' ) {
            return $data;
        }

        $new_data = [];

        if( ! empty( $data ) ) {
            foreach( $data as $key => $product ) {
                if( $this->_show_purchaseof($product, $settings) ) {
                    $new_data[ $key ] = $product;
                }
            }
        }
        return $new_data;
    }

    public function _show_purchaseof( $product, $settings ){
        if( empty( $settings['product_control'] ) || $settings['product_control'] === 'none' ) {
            return true;
        }

        $product_category_list = [];

        $product_id = $product['product_id'];
        if( $settings['product_control'] == 'product_category' ) {
            $product_categories = get_the_terms( $product_id, 'product_cat' );
            if( ! is_wp_error( $product_categories ) ) {
                foreach( $product_categories as $category ) {
                    $product_category_list[] = $category->slug;
                }
            }

            $product_category_count = count( $product_category_list );
            $array_diff = array_diff( $settings['category_list'], $product_category_list );
            $array_diff_count = count( $array_diff );

            $cute_logic = ( count( $settings['category_list'] ) - ( $product_category_count +  $array_diff_count) );

            if( ! $cute_logic ) {
                return true;
            }
        }
        if( $settings['product_control'] == 'manual_selection' ) {
            if( in_array( $product_id, $settings['product_list'] ) ) {
                return true;
            }
        }

        return false;
    }


}
