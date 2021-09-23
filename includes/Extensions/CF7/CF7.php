<?php

/**
 * CF7 Extension
 *
 * @package NotificationX\Extensions
 */

namespace NotificationX\Extensions\CF7;

use NotificationX\Core\Rules;
use NotificationX\GetInstance;
use NotificationX\Extensions\Extension;
use NotificationX\Extensions\GlobalFields;

/**
 * CF7 Extension
 */
class CF7 extends Extension {
    /**
     * Instance of CF7
     *
     * @var CF7
     */
    use GetInstance;

    public $priority        = 5;
    public $id              = 'cf7';
    public $img             = '';
    public $doc_link        = 'https://notificationx.com/docs/contact-form-submission-alert/';
    public $types           = 'form';
    public $module          = 'modules_cf7';
    public $module_priority = 8;
    public $class           = 'WPCF7_ContactForm';

    /**
     * Initially Invoked when initialized.
     */
    public function __construct() {
        $this->title = __('Contact Form 7', 'notificationx');
        $this->module_title = __('Contact Form 7', 'notificationx');

        parent::__construct();
    }

    public function init(){
        parent::init();
        add_action('wpcf7_mail_sent', array($this, 'save_new_records'));
    }

    public function init_fields(){
        parent::init_fields();

        add_filter('nx_form_list', [$this, 'nx_form_list'], 9);
    }

    /**
     * This functions is hooked
     *
     * @hooked nx_public_action
     * @return void
     */
    public function admin_actions() {
        parent::admin_actions();
        if (!$this->is_active()) {
            return;
        }
        add_action('wp_ajax_nx_cf7_keys', [$this, 'keys']);
        add_filter('nx_data_key', array($this, 'key'), 10, 2);
    }

    /**
     * This functions is hooked
     *
     * @hooked nx_public_action
     * @return void
     */
    public function public_actions() {
        parent::public_actions();
        if (!$this->is_active()) {
            return;
        }
    }

    public function source_error_message($messages) {
        if(!$this->class_exists()){
            $url = admin_url('plugin-install.php?s=contact+form+7&tab=search&type=term');
            $messages['cf7'] = [
                'message' => sprintf(
                    '%s <a href="%s" target="_blank">%s</a> %s',
                    __('You have to install', 'notificationx'),
                    $url,
                    __('Contact Form 7', 'notificationx'),
                    __('plugin first.', 'notificationx')
                ),
                'html' => true,
                'type' => 'error',
                'rules' => Rules::is('source', $this->id),
            ];
        }
        return $messages;
    }

    /**
     * Adds available forms to the Select a Form field in Content tab.
     *
     * @param array $forms
     * @return array
     */
    public function nx_form_list($forms) {
        $_forms = GlobalFields::get_instance()->normalize_fields($this->get_forms(), 'source', $this->id);
        return array_merge($_forms, $forms);
    }

    // @todo frontend
    public function key($key, $settings) {
        if ($settings->type === 'form' && $settings->form_source === 'cf7') {
            $key = $key . '_' . $settings->cf7_form;
        }
        return $key;
    }

    /**
     * Lists available tags in the selected form.
     *
     * @return json
     */
    public function restResponse($args) {
        if (isset($args['form_id'])) {
            $form_id = intval($args['form_id']);

            $form = get_post($form_id);

            $keys = $this->keys_generator($form->post_content);

            $returned_keys = array();

            if (is_array($keys) && !empty($keys)) {
                foreach ($keys as $key) {
                    $returned_keys[] = array(
                        'label' => ucwords(str_replace(['_', '-'], ' ', $key)),
                        'value' => "tag_$key",
                    );
                }
                return $returned_keys;
            }
        }
        return [];
    }

    /**
     * Get available CF7 forms name.
     *
     * @return array
     */
    public function get_forms() {
        $args = array(
            'post_type' => 'wpcf7_contact_form',
            'order' => 'ASC',
            'posts_per_page' => -1,
        );
        $the_query = get_posts($args);
        $forms = [];
        if (!empty($the_query)) {
            foreach ($the_query as $form) {
                $forms["{$this->id}_{$form->ID}"] = $form->post_title;
            }
        }
        wp_reset_postdata();
        return $forms;
    }

    public function keys_generator($fieldsString) {
        $fieldsString = substr($fieldsString, 0, strpos($fieldsString, 'submit') - 2);
        preg_match_all('/\[(.+?)\]/', $fieldsString, $parsed_fields);
        $fields = array();
        if (!empty($parsed_fields[1])) {
            foreach ($parsed_fields[1] as $field) {
                if (strpos($field, 'submit') !== false) {
                    continue;
                } else {
                    $fields[] = explode(' ', $field)[1];
                }
            }
        }
        return $fields;
    }


    public function save_new_records($contact_form) {
        $submission   = \WPCF7_Submission::get_instance();
        $tags = $contact_form->scan_form_tags();
        $data = array();
        if (!empty($tags)) {
            foreach ($tags as $tag) {
                if (!empty($tag->name)) {
                    $tagged_value = $submission->get_posted_data($tag->name);
                    $data[$tag->name] = $tagged_value;
                    if (strpos(strtolower($tag->name), 'email') !== false) {
                        $data['email'] = $tagged_value;
                    }
                }
            }
            $data['title'] = $contact_form->title();
            $data['id'] = $contact_form->id();
            $data['timestamp'] = time();
        }

        if (!empty($data)) {
            $key = $this->id . '_' . $contact_form->id();
            $this->save([
                'source'    => $this->id,
                'entry_key' => $key,
                'data'      => $data,
            ]);
            return true;
        }
        return false;
    }

    // public function restResponse( $params ){
    //     dlog('FROM CF7');
    //     dlog( $params );
    // }

    public function doc(){
        // translators: links
        return sprintf(__('<p>Make sure that you have <a target="_blank" href="%1$s">Contact Form 7 installed & configured</a> to use its campaign & form subscriptions data. For further assistance, check out our step by step <a target="_blank" href="%2$s">documentation</a>.</p>
		<p>🎦 <a target="_blank" href="%3$s">Watch video tutorial</a> to learn quickly</p>
		<p>👉 NotificationX <a target="_blank" href="%4$s">Integration with Contact Form 7</a></p>
		<p><strong>Recommended Blog:</strong></p>
		<p>🔥 Hacks to Increase Your <a target="_blank" href="%5$s">WordPress Contact Forms Submission Rate</a> Using NotificationX</p>', 'notificationx'),
        'https://wordpress.org/plugins/contact-form-7/',
        'https://notificationx.com/docs/contact-form-submission-alert/',
        'https://youtu.be/SP9NXMioIK8',
        'https://notificationx.com/integrations/contact-form-7/',
        'https://notificationx.com/blog/wordpress-contact-forms/'
        );
    }
}
