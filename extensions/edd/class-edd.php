<?php
/**
 * This Class is responsible for 
 * Easy Digital Downloads 
 * Conversions
 */
class FomoPress_EDD_Extension extends FomoPress_Extension {
    /**
     *  Type of notification.
     *
     * @var string
     */
    public $type = 'edd';
    public $template = 'edd_template';
    protected $ordered_products = [];
    /**
     * An array of all notifications
     *
     * @var [type]
     */
    protected $notifications = [];

    public function __construct() {
        parent::__construct();
        $this->notifications = $this->get_notifications( $this->type );

    }
    /**
     * This functions is hooked
     * @hooked fomopress_public_action
     *
     * @return void
     */
    public function public_actions(){
        if( ! $this->is_created( $this->type ) ) {
            return;
        }

        // some code will be here
    }
    /**
     * This functions is hooked
     * @hooked fomopress_admin_action
     * 
     * @return void
     */
    public function admin_actions(){
        if( ! $this->is_created( $this->type ) ) {
            return;
        }
        add_action( 'edd_complete_purchase', array( $this, 'update_notifications' ) );
    }

    public function source_tab_section( $options ){
        $options['config']['fields']['display_type']['hide']['comments']['fields'][] = 'edd_template';
        $options['config']['fields']['display_type']['hide']['comments']['fields'][] = 'show_product_image';
        
        $options['config']['fields']['display_type']['hide']['press_bar']['fields'][] = 'edd_template';

        if( ! class_exists( 'Easy_Digital_Downloads' ) ) {
            $options['config']['fields']['has_no_edd'] = array(
                'type'     => 'message',
                'message'    => __('You have to install Easy Digital Downloads plugin first.', 'fomopress'),
                'priority' => 0,
            );
        }

        return $options;
    }

    /**
     * Some extra field on the fly.
     * 
     * @param array $options
     * @return array
     */
    public function content_tab_section( $options ){
        $options[ 'content_config' ][ 'fields' ]['edd_template'] = array(
            'type'     => 'template',
            'label'    => __('Notification Template' , 'fomopress'),
            'priority' => 90,
            'defaults' => [
                __('{{name}} recently purchased', 'fomopress'), '{{title}}', '{{time}}'
            ],
            'variables' => [
                '{{name}}', '{{title}}', '{{time}}'
            ],
        );

        return $options;
    }
    /**
     * This function is responsible for the some fields of 
     * wp comments notification in display tab
     *
     * @param array $options
     * @return void
     */
    public function display_tab_section( $options ){
        // $options['image']['fields']['edd_show_product_image'] = array(
        //     'label'       => __( 'Show Product Image', 'fomopress' ),
        //     'priority'    => 25,
        //     'type'        => 'checkbox',
        //     'default'     => true,
        //     'description' => __( 'Show the product image in notification', 'fomopress' ),
        // );

        return $options;
    }
    /**
     * Some toggleData & hideData manipulation.
     *
     * @param array $options
     * @return void
     */
    public function conversion_from( $options ){
        if( ! class_exists( 'Easy_Digital_Downloads' ) ) {
            $options['toggle']['edd']['fields'] = [ 'has_no_edd' ];
            $options['hide']['custom']['fields'] = [ 'edd_template' ];
        } else {
            $options['toggle']['edd']['fields'] = [ 'edd_template', 'show_product_image' ];
            $options['toggle']['edd']['sections'] = [ 'image' ];
            $options['hide']['edd']['fields'] = [ 'show_custom_image' ];
        }

        return $options;
    }
    /**
     * This function is responsible for making the notification ready for first time we make the notification.
     *
     * @param string $type
     * @param array $data
     * @return void
     */
    public function get_notification_ready( $type, $data = array() ){
        if( ! class_exists( 'Easy_Digital_Downloads' ) ) {
            return;
        }

        if( $this->type === $type ) {
            $orders = $this->get_orders( $data );
            if( is_array( $orders ) ) {
                $this->save( $this->type, $orders );
            }
        }
    }
    /**
     * This function is responsible for get all payments
     *
     * @param int $days
     * @param int $amount
     * @return array
     */
    public function get_payments( $days, $amount ) {
        $date 		= '-' . intval( $days ) . ' days';
        $start_date = strtotime( $date );

        $amount = $amount > 0 ? $amount : -1;

        $args = array(
            'number'    => $amount,
            'status'    => array('publish'),
            'date_query'	=> array(
                'after'			=> date( 'Y-m-d', $start_date )
            )
        );

        return edd_get_payments( $args );
    }
    /**
     * This function is responsible for update notification
     *
     * @param int $payment_id
     * @return void
     */
    public function update_notifications( $payment_id ){
        if( count( $this->notifications ) === $this->cache_limit ) {
            $sorted_data = FomoPress_Helper::sorter( $this->notifications, 'timestamp' );
            array_pop( $sorted_data );
            $this->notifications = $sorted_data;
        }
        $this->ordered_products = $this->notifications;
        $this->ordered_products( $payment_id );
        $this->save( $this->type, $this->ordered_products );
    }
    /**
     * Get all the orders from database using a date query
     * for limitation.
     *
     * @param array $data
     * @return void
     */
    public function get_orders( $data ) {
        if( empty( $data ) ) return;
        $days     = $data['_fomopress_display_from'];
        $amount   = $data['_fomopress_display_last'];
        $payments = $this->get_payments( $days, $amount );
      
        if( is_array( $payments ) && ! empty( $payments ) ) {
            foreach( $payments as $payment ) {
                $this->ordered_products( $payment->ID );
            }
        }

        return $this->ordered_products;
    }
    /**
     * This function is responsible for 
     * making ready the product notifications array
     *
     * @param int $payment_id
     * @return void
     */
    protected function ordered_products( $payment_id ){
        $payment_meta = edd_get_payment_meta( $payment_id );
        $payment_key  = $payment_meta['key'];
        $date         = $payment_meta['date'];
        $time['timestamp']  = strtotime( $date );
        $buyer        = $this->buyer( $payment_meta['user_info'] );

        $cart_items = edd_get_payment_meta_cart_details( $payment_id );                
        if( is_array( $cart_items ) && ! empty( $cart_items ) ) {
            foreach( $cart_items as $item ) {
                $product_data = $this->product_data( $item );
                $this->ordered_products[ $payment_key . '-' . $item['id'] ] = array_merge( $buyer, $product_data, $time );
            }
        }
    }
    /**
     * This function is responsible for 
     * making ready the product array
     *
     * @param array $item
     * @return array
     */
    protected function product_data( $item ){
        if( empty( $item ) ) return;
        $data = [];
        $data['product_id'] = $item['id'];
        $data['title']      = $item['name'];
        $data['link']       = get_permalink( $item['id'] );
        return $data;
    }
    /**
     * This function is responsible 
     * for making buyer array ready
     *
     * @param array $user_info
     * @return void
     */
    protected function buyer( $user_info ) {
        if( empty( $user_info ) ) return;
        $buyer_data = [];
        $buyer_data['name'] = $user_info['first_name'] . ' ' . $user_info['last_name'];
        if( $user_info['id'] ) {
            $user = new WP_User( $user_info['id'] );
            if( $user->exists() ) {
                $buyer_data['user_id'] = $user->ID;
                $buyer_data['name']    = $user->display_name;
            }
        }
        return $buyer_data;
    }
    /**
     * This function is responsible for making ready the front of notifications
     *
     * @param array $data
     * @param boolean $settings
     * @param string $template
     * @return void
     */
    public function frontend_html( $data = [], $settings = false, $template = '' ){
        if( class_exists( 'Easy_Digital_Downloads' ) ) {
            return parent::frontend_html( $data, $settings, $template );
        }
    }
}
