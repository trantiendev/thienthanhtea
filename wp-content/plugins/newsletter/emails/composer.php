<?php
defined('ABSPATH') || exit;

require_once NEWSLETTER_INCLUDES_DIR . '/controls.php';
$controls = new NewsletterControls();
$module = NewsletterEmails::instance();

wp_enqueue_style('tnpc-style', plugins_url('/tnp-composer/_css/newsletter-builder.css', __FILE__), array(), time());
wp_enqueue_style('tnpc-newsletter-style', home_url('/') . '?na=emails-composer-css');

include NEWSLETTER_INCLUDES_DIR . '/codemirror.php';

if ($controls->is_action()) {

    /*     * * Save or create ** */

    if (empty($_GET['id'])) {

        $email = array();
        $email['status'] = 'new';
        $email['track'] = Newsletter::instance()->options['track'];
        $email['token'] = $module->get_token();

        $email['message'] = $controls->data['body'];
        $email['subject'] = $controls->data['subject'];

        $email['message_text'] = 'This email requires a modern e-mail reader but you can view the email online here:
{email_url}.

Thank you, ' . wp_specialchars_decode(get_option('blogname'), ENT_QUOTES) . '

To change your subscription follow: {profile_url}.';


        $email['editor'] = NewsletterEmails::EDITOR_COMPOSER;
        $email['type'] = 'message';
        $email['send_on'] = time();
        $email['query'] = "select * from " . NEWSLETTER_USERS_TABLE . " where status='C'";

        $email = Newsletter::instance()->save_email($email, ARRAY_A);
    } else {

        $email['id'] = $_GET['id'];
        $email['editor'] = NewsletterEmails::EDITOR_COMPOSER;
        $email['message'] = $controls->data['body'];
        $email['subject'] = $controls->data['subject'];
        $email = Newsletter::instance()->save_email($email, ARRAY_A);
    }

    $controls->add_message_saved();


    /*     * * Post save tasks ** */

    if ($controls->is_action('test')) {
        $module->send_test_email($module->get_email($email['id']), $controls);
    }

    if ($controls->is_action('preview')) {
        $redirect = $module->get_admin_page_url('edit');
    } else {
        $redirect = $module->get_admin_page_url('composer');
    }

    $controls->js_redirect($redirect . '&id=' . $email['id']);

    return;
} else {

    if (!empty($_GET['id'])) {
        $email = Newsletter::instance()->get_email((int) $_GET['id'], ARRAY_A);
        $controls->data = $email;
    }
}

if (isset($email)) {
    $controls->data['body'] = $email['message'];
    $controls->data['subject'] = $email['subject'];
}
?>

<div id="tnp-notification">
    <?php
        $controls->show();
        $controls->messages = '';
        $controls->errors = '';
    ?>
</div>

<div class="wrap tnp-emails-composer" id="tnp-wrap">

    <?php $controls->composer_load('body', true); ?>

    <div id="tnp-heading" class="tnp-composer-heading">
        <div class="tnpc-logo">
            <p>The Newsletter Plugin <strong>Composer</strong></p>
        </div>
        <div class="tnpc-controls">
            <form method="post" action="" id="tnpc-form">
                <?php $controls->init(); ?>

                <?php $controls->composer_fields(); ?>

                <?php $controls->button_confirm('reset', __('Back to last save', 'newsletter'), 'Are you sure?'); ?>
                <?php $controls->button('save', __('Save', 'newsletter'), 'tnpc_save(this.form); this.form.submit();'); ?>
                <?php $controls->button('preview', __('Next', 'newsletter') . ' &raquo;', 'tnpc_save(this.form); this.form.submit();'); ?>
            </form>
        </div>
    </div>
</div>