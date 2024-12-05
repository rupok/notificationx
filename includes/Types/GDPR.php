<?php

/**
 * Extension Abstract
 *
 * @package NotificationX\Extensions
 */

namespace NotificationX\Types;

use NotificationX\Core\Rule;
use NotificationX\Core\Rules;
use NotificationX\Extensions\ExtensionFactory;
use NotificationX\Extensions\GlobalFields;
use NotificationX\GetInstance;
use NotificationX\Modules;

/**
 * Extension Abstract for all Extension.
 * @method static GDPR get_instance($args = null)
 */
class GDPR extends Types {
    /**
     * Instance of GDPR
     *
     * @var GDPR
     */
    use GetInstance;

    public $priority = 10;
    public $themes = [];
    public $module = [
        'modules_gdpr',
    ];
    public $default_source = 'gdpr_notification';


    /**
     * Initially Invoked when initialized.
     */
    public function __construct() {
        $this->id    = 'gdpr';
        $this->title = __('GDPR Notification', 'notificationx');
        parent::__construct();

        // nx_comment_colored_themes
        $this->themes = [
            'theme-light-one'        => [
                'source'  => NOTIFICATIONX_ADMIN_URL . 'images/extensions/themes/gdpr/light-1.jpg',
                'image_shape' => 'circle',
                'template'  => [
                    'first_param'         => 'tag_name',
                    'custom_first_param'  => __('Someone', 'notificationx'),
                    'second_param'        => __('commented on', 'notificationx'),
                    'third_param'         => 'tag_post_title',
                    'custom_third_param'  => __('Anonymous Post', 'notificationx'),
                    'fourth_param'        => 'tag_time',
                    'custom_fourth_param' => __('Some time ago', 'notificationx'),
                ],
                'rules'                   => Rules::is('gdpr_theme', 'light'),
            ],
            'theme-light-two'        => [
                'source'  => NOTIFICATIONX_ADMIN_URL . 'images/extensions/themes/gdpr/light-2.jpg',
                'image_shape' => 'circle',
                'template'  => [
                    'first_param'         => 'tag_name',
                    'custom_first_param'  => __('Someone', 'notificationx'),
                    'second_param'        => __('commented on', 'notificationx'),
                    'third_param'         => 'tag_post_title',
                    'custom_third_param'  => __('Anonymous Post', 'notificationx'),
                    'fourth_param'        => 'tag_time',
                    'custom_fourth_param' => __('Some time ago', 'notificationx'),
                ],
                'rules'                   => Rules::is('gdpr_theme', 'light'),
            ],
            'theme-light-three'      => [
                'source'  => NOTIFICATIONX_ADMIN_URL . 'images/extensions/themes/gdpr/light-3.jpg',
                'image_shape' => 'square',
                'template'  => [
                    'first_param'         => 'tag_name',
                    'custom_first_param'  => __('Someone', 'notificationx'),
                    'second_param'        => __('commented on', 'notificationx'),
                    'third_param'         => 'tag_post_title',
                    'custom_third_param'  => __('Anonymous Post', 'notificationx'),
                    'fourth_param'        => 'tag_time',
                    'custom_fourth_param' => __('Some time ago', 'notificationx'),
                ],
                'rules'                   => Rules::is('gdpr_theme', 'light'),
            ],
            'theme-light-four'   => [
                'source'  => NOTIFICATIONX_ADMIN_URL . 'images/extensions/themes/gdpr/light-4.jpg',
                'image_shape' => 'rounded',
                'template'  => [
                    'first_param'         => 'tag_name',
                    'custom_first_param'  => __('Someone', 'notificationx'),
                    'second_param'        => __('commented on', 'notificationx'),
                    'third_param'         => 'tag_post_comment',
                    'custom_third_param'  => __('Anonymous Post', 'notificationx'),
                    'fourth_param'        => 'tag_time',
                    'custom_fourth_param' => __('Some time ago', 'notificationx'),
                ],
                'rules'                   => Rules::is('gdpr_theme', 'light'),
            ],
            'theme-dark-one'   => [
                'source'  => NOTIFICATIONX_ADMIN_URL . 'images/extensions/themes/gdpr/dark-1.jpg',
                'image_shape' => 'rounded',
                'template'  => [
                    'first_param'         => 'tag_name',
                    'custom_first_param'  => __('Someone', 'notificationx'),
                    'second_param'        => __('commented on', 'notificationx'),
                    'third_param'         => 'tag_post_comment',
                    'custom_third_param'  => __('Anonymous Post', 'notificationx'),
                    'fourth_param'        => 'tag_time',
                    'custom_fourth_param' => __('Some time ago', 'notificationx'),
                ],
                'rules'                   => Rules::is('gdpr_theme', 'dark'),
            ],
            'theme-dark-two'   => [
                'source'  => NOTIFICATIONX_ADMIN_URL . 'images/extensions/themes/gdpr/dark-2.jpg',
                'image_shape' => 'rounded',
                'template'  => [
                    'first_param'         => 'tag_name',
                    'custom_first_param'  => __('Someone', 'notificationx'),
                    'second_param'        => __('commented on', 'notificationx'),
                    'third_param'         => 'tag_post_comment',
                    'custom_third_param'  => __('Anonymous Post', 'notificationx'),
                    'fourth_param'        => 'tag_time',
                    'custom_fourth_param' => __('Some time ago', 'notificationx'),
                ],
                'rules'                   => Rules::is('gdpr_theme', 'dark'),
            ],
            'theme-dark-three'   => [
                'source'  => NOTIFICATIONX_ADMIN_URL . 'images/extensions/themes/gdpr/dark-3.jpg',
                'image_shape' => 'rounded',
                'template'  => [
                    'first_param'         => 'tag_name',
                    'custom_first_param'  => __('Someone', 'notificationx'),
                    'second_param'        => __('commented on', 'notificationx'),
                    'third_param'         => 'tag_post_comment',
                    'custom_third_param'  => __('Anonymous Post', 'notificationx'),
                    'fourth_param'        => 'tag_time',
                    'custom_fourth_param' => __('Some time ago', 'notificationx'),
                ],
                'rules'                   => Rules::is('gdpr_theme', 'dark'),
            ],
            'theme-dark-four'   => [
                'source'  => NOTIFICATIONX_ADMIN_URL . 'images/extensions/themes/gdpr/dark-4.jpg',
                'image_shape' => 'rounded',
                'template'  => [
                    'first_param'         => 'tag_name',
                    'custom_first_param'  => __('Someone', 'notificationx'),
                    'second_param'        => __('commented on', 'notificationx'),
                    'third_param'         => 'tag_post_comment',
                    'custom_third_param'  => __('Anonymous Post', 'notificationx'),
                    'fourth_param'        => 'tag_time',
                    'custom_fourth_param' => __('Some time ago', 'notificationx'),
                ],
                'rules'                   => Rules::is('gdpr_theme', 'dark'),
            ],
            'theme-banner-light-one' => [
                'source'  => NOTIFICATIONX_ADMIN_URL . 'images/extensions/themes/gdpr/banner-light-1.jpg',
                'image_shape' => 'circle',
                'template'  => [
                    'first_param'         => 'tag_name',
                    'custom_first_param'  => __('Someone', 'notificationx'),
                    'second_param'        => __('commented on', 'notificationx'),
                    'third_param'         => 'tag_post_comment',
                    'custom_third_param'  => __('Anonymous Post', 'notificationx'),
                    'fourth_param'        => 'tag_time',
                    'custom_fourth_param' => __('Some time ago', 'notificationx'),
                ],
                'rules'                   => Rules::is('gdpr_theme', 'light'),
            ],
            'theme-banner-light-two' => [
                'source'  => NOTIFICATIONX_ADMIN_URL . 'images/extensions/themes/gdpr/banner-light-2.jpg',
                'image_shape' => 'circle',
                'template'  => [
                    'first_param'         => 'tag_name',
                    'custom_first_param'  => __('Someone', 'notificationx'),
                    'second_param'        => __('commented on', 'notificationx'),
                    'third_param'         => 'tag_post_comment',
                    'custom_third_param'  => __('Anonymous Post', 'notificationx'),
                    'fourth_param'        => 'tag_time',
                    'custom_fourth_param' => __('Some time ago', 'notificationx'),
                ],
                'rules'                   => Rules::is('gdpr_theme', 'light'),
            ],
            'theme-banner-dark-one' => [
                'source'  => NOTIFICATIONX_ADMIN_URL . 'images/extensions/themes/gdpr/banner-dark-1.jpg',
                'image_shape' => 'circle',
                'template'  => [
                    'first_param'         => 'tag_name',
                    'custom_first_param'  => __('Someone', 'notificationx'),
                    'second_param'        => __('commented on', 'notificationx'),
                    'third_param'         => 'tag_post_comment',
                    'custom_third_param'  => __('Anonymous Post', 'notificationx'),
                    'fourth_param'        => 'tag_time',
                    'custom_fourth_param' => __('Some time ago', 'notificationx'),
                ],
                'rules'                   => Rules::is('gdpr_theme', 'dark'),
            ],
            'theme-banner-dark-two' => [
                'source'  => NOTIFICATIONX_ADMIN_URL . 'images/extensions/themes/gdpr/banner-dark-2.jpg',
                'image_shape' => 'circle',
                'template'  => [
                    'first_param'         => 'tag_name',
                    'custom_first_param'  => __('Someone', 'notificationx'),
                    'second_param'        => __('commented on', 'notificationx'),
                    'third_param'         => 'tag_post_comment',
                    'custom_third_param'  => __('Anonymous Post', 'notificationx'),
                    'fourth_param'        => 'tag_time',
                    'custom_fourth_param' => __('Some time ago', 'notificationx'),
                ],
                'rules'                   => Rules::is('gdpr_theme', 'dark'),
            ],
        ];
    }

    /**
     * Hooked to nx_before_metabox_load action.
     *
     * @return void
     */
    public function init_fields() {
        parent::init_fields();
        add_filter('nx_design_tab_fields', [$this, 'add_design_fields'], 9);
        add_filter('nx_content_gdpr', [$this, 'add_content_fields'], 9);
        add_filter('nx_content_fields', [$this, '__add_content_fields'], 9);
        // add_filter('nx_notification_template', [$this, 'notification_template'], 9);
        add_filter('nx_customize_fields', array($this, 'customize_fields'), 999);
    }

    public function customize_fields( $fields ) {
        $fields[] = [
            'label'  => __("Visibility", 'notificationx'),
            'name'   => "visibility",
            'type'   => "section",
            'rules'     => Rules::is('type', 'gdpr'),
            'priority'=> 10,
            'fields' => [
                [
                    'label' => __("Show On", 'notificationx'),
                    'name'  => "cookie_visibility_show_on",
                    'type'  => "select",
                    'default' => 'default',
                    'options'  => [
                        'default' => [
                            'label'    => __('Show Everywhere', 'notificationx'),
                            'value'    => 'default',
                            'selected' => 'selected',
                        ],
                    ]
                ],
                [
                    'label' => __("Display For", 'notificationx'),
                    'name'  => "cookie_visibility_display_for",
                    'type'  => "select",
                    'default' => 'default',
                    'options'  => [
                        'default' => [
                            'label'    => __('Everyone', 'notificationx'),
                            'value'    => 'default',
                            'selected' => 'selected',
                        ],
                    ]
                ],
                [
                    'label' => __("Delay Before First Notification", 'notificationx'),
                    'name'  => "cookie_visibility_delay_before",
                    'type'  => "text",
                    'default' => 5,
                    'help'  => __("Initial Delay", "notificationx"),
                ],
            ]
        ];

        return $fields;
    }

    private function normalize_fields($fields, $key = '', $value = [], $return = []) {
        foreach ($fields as $val => $label) {
            $val = !empty( $label['value'] ) ? $label['value'] : $val;
            if (empty($return[$val]) && !is_array($label)) {
                $return[$val] = [
                    'value' => $val,
                    'label' => $label,
                ];
            }
            elseif (empty($return[$val])){
                $return[$val] = $label;
            }
            if(!empty($key)){
                $return[$val] = Rules::includes($key, $value, false, $return[$val]);
            }
        }

        return $return;
    }

    public function __add_content_fields( $fields ) {
        $_fields = &$fields;
        $_fields['preference_center'] = [
            'name'     => "preference_center",
            'type'     => "section",
            'priority' => 98,
            'label'    => 'Preference Center',
            'rules'     => Rules::is('type', 'gdpr'),
            'fields'   => [
                [
                    'label' => __("Title", 'notificationx'),
                    'name'  => "preference_title",
                    'type'  => "text",
                    'placeholder' => __("We value your privacy", 'notificationx'),
                ],
                [
                    'label' => __("Privacy Overview", 'notificationx'),
                    'name'  => "preference_overview",
                    'type'  => "textarea",
                    'placeholder' => __("We value your privacy", 'notificationx'),
                ],
                [
                    'label' => __("Show Google Privacy Policy", 'notificationx'),
                    'name'  => "preference_google",
                    'type'  => "toggle",
                    'default' => false,
                ],
                [
                    'label' => __("Save My Preferences Button", 'notificationx'),
                    'name'  => "preference_btn",
                    'type'  => "text",
                    'placeholder' => __("Save My Preferences", 'notificationx'),
                ],
                [
                    'label' => __("See More Button", 'notificationx'),
                    'name'  => "preference_more_btn",
                    'type'  => "text",
                    'placeholder' => __("See More", 'notificationx'),
                ],
                [
                    'label' => __("See Less Button", 'notificationx'),
                    'name'  => "preference_less_btn",
                    'type'  => "text",
                    'placeholder' => __("See Less", 'notificationx'),
                ],
            ]
        ];

        $_fields['cookies_list'] = [
            'name'     => "cookies_list",
            'type'     => "section",
            'priority' => 100,
            'label'    => 'Cookies List',
            'rules'    => Rules::is('type', 'gdpr'),
            'fields'   => [
                [
                    'label' => __("Show Cookie List on banner", 'notificationx'),
                    'name'  => "cookie_list_show_banner",
                    'type'  => "toggle",
                    'default' => false,
                    // 'help'  => __("Help text", "notificationx"),
                ],
                [
                    'label' => __("Embed Code", 'notificationx'),
                    'name'  => "cookie_list_embed_code",
                    'type'  => "textarea",
                    'placeholder' => __("We value your privacy", 'notificationx'),
                    'is_pro' => true,
                ],
                [
                    'label' => __("Cookie", 'notificationx'),
                    'name'  => "cookie_list_cookie",
                    'type'  => "text",
                    'placeholder' => __("Cookie", 'notificationx'),
                ],
                [
                    'label' => __("Duration", 'notificationx'),
                    'name'  => "cookie_list_duration",
                    'type'  => "text",
                    'default' => 0,
                ],
                [
                    'label' => __("Always Active Label", 'notificationx'),
                    'name'  => "cookie_list_active_label",
                    'type'  => "text",
                    'placeholder' => __("Always Active", 'notificationx'),
                ],
                [
                    'label' => __("No Cookies to Display Label", 'notificationx'),
                    'name'  => "cookie_list_no_cookies_label",
                    'type'  => "text",
                    'placeholder' => __("No Cookies to Display", 'notificationx'),
                ],
            ]
        ];

        return $fields;
    }

    public function add_content_fields( $fields ) {
        $_fields = &$fields['fields'];
        $_fields['gdpr_title'] = [
            'label'    => __('Title', 'notificationx'),
            'name'     => 'gdpr_title',
            'type'     => 'text',
            'priority' => 101,
            'default' => __('We value your privacy', 'notificationx'),       
        ];
        $_fields['gdpr_message'] = [
            'label'    => __('Message', 'notificationx'),
            'name'     => 'gdpr_message',
            'type'     => 'textarea',
            'priority' => 102,
            'default' => __('We value your privacy', 'notificationx'),       
        ];
        $_fields['gdpr_accept_btn'] = [
            'label'    => __('Accept All Button', 'notificationx'),
            'name'     => 'gdpr_accept_btn',
            'type'     => 'text',
            'priority' => 103,
            'default' => __('Accept All', 'notificationx'),       
        ];
        $_fields['gdpr_reject_btn'] = [
            'label'    => __('Reject All Button', 'notificationx'),
            'name'     => 'gdpr_reject_btn',
            'type'     => 'text',
            'priority' => 104,
            'default' => __('Reject All', 'notificationx'),       
        ];
        $_fields['gdpr_customize_btn'] = [
            'label'    => __('Customize Button', 'notificationx'),
            'name'     => 'gdpr_customize_btn',
            'type'     => 'text',
            'priority' => 105,
            'default' => __('Customize', 'notificationx'),       
        ];
        $_fields['gdpr_cookies_policy_toggle'] = [
            'label'    => __('Cookies Policy Link', 'notificationx'),
            'name'     => 'gdpr_cookies_policy_toggle',
            'type'     => 'toggle',
            'priority' => 106,
            'default' => true,       
        ];
        $_fields['gdpr_cookies_policy_link_text'] = [
            'label'    => __('Cookies Policy Link Text', 'notificationx'),
            'name'     => 'gdpr_cookies_policy_link_text',
            'type'     => 'text',
            'priority' => 107,
            'placeholder' => __('Link Text', 'notificationx'),
            'rules' => Rules::logicalRule([
                Rules::is('gdpr_cookies_policy_toggle', true),
            ]),      
        ];
        $_fields['gdpr_cookies_policy_link_url'] = [
            'label'    => __('Cookies Policy URL', 'notificationx'),
            'name'     => 'gdpr_cookies_policy_link_url',
            'type'     => 'text',
            'priority' => 108,
            'placeholder' => __('Cookies Policy URL', 'notificationx'),
            'rules' => Rules::logicalRule([
                Rules::is('gdpr_cookies_policy_toggle', true),
            ]),      
        ];
        $_fields['gdpr_custom_logo'] = [
            'label'    => __('Custom Logo', 'notificationx'),
            'name'     => 'gdpr_custom_logo',
            'type'     => 'media',
            'priority' => 109, 
            'is_pro'   => true,      
        ];
        return $fields;
    }

    public function add_design_fields( $fields ) {
        $_fields = &$fields['themes']['fields'];
        $_fields['gdpr_design'] = [
            'name'   => "gdpr_design",
            'type'   => "section",
            'priority'=> 15,
            'fields' => [
                [
                    'label'   => __("Position", 'notificationx'),
                    'name'    => "gdpr_position",
                    'type'    => "select",
                    'default' => 'bottom-left',
                    'options' => GlobalFields::get_instance()->normalize_fields([
                        'bottom_left'  => __('Bottom Left', 'notificationx'),
                        'bottom_right' => __('Bottom Right', 'notificationx'),
                        'center' => __('Center', 'notificationx'),
                    ]),
                    'rules'   => Rules::logicalRule([
                        Rules::includes('themes', [ 'gdpr_theme-light-one', 'gdpr_theme-light-two', 'gdpr_theme-light-three',
                     'gdpr_theme-light-four', 'gdpr_theme-dark-one', 'gdpr_theme-dark-two', 'gdpr_theme-dark-three', 'gdpr_theme-dark-four' ], false),
                    ]),
                ],
                [
                    'label'   => __("Position", 'notificationx'),
                    'name'    => "gdpr_banner_position",
                    'type'    => "select",
                    'default' => 'bottom',
                    'options' => GlobalFields::get_instance()->normalize_fields([
                        'bottom'  => __('Bottom', 'notificationx'),
                        'top' => __('Top', 'notificationx'),
                    ]),
                    'rules'   => Rules::logicalRule([
                        Rules::includes('themes', [ 'gdpr_theme-banner-light-one', 'gdpr_theme-banner-light-two', 'gdpr_theme-banner-dark-one', 'gdpr_theme-banner-dark-two' ], false),
                    ]),
                ],
                [
                    'label'       => __('Display Close Option', 'notificationx'),
                    'name'        => 'dispaly_close_option',
                    'type'        => 'checkbox',
                    'priority'    => 10,
                    'is_pro'      => true,
                    'default'     => false,
                    'description' => __('Display a close button', 'notificationx'),
                    'rules'       => Rules::includes('source', ['gdpr_notification']),
                ],
            ]
        ];

        return $fields;
    }

}
