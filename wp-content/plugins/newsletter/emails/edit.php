<?php
defined('ABSPATH') || exit;

/* @var $wpdb wpdb */
require_once NEWSLETTER_INCLUDES_DIR . '/controls.php';
$controls = new NewsletterControls();
$module = NewsletterEmails::instance();

function tnp_prepare_controls($email, $controls) {
    $controls->data = $email;

    foreach ($email['options'] as $name => $value) {
        $controls->data['options_' . $name] = $value;
    }
}

// Always required
$email = $module->get_email($_GET['id'], ARRAY_A);

if (empty($email)) {
    echo 'Wrong email identifier';
    return;
}

$email_id = $email['id'];

/* Satus changes which require a reload */
if ($controls->is_action('pause')) {
    $wpdb->update(NEWSLETTER_EMAILS_TABLE, array('status' => 'paused'), array('id' => $email_id));
    $email = $module->get_email($_GET['id'], ARRAY_A);
    tnp_prepare_controls($email, $controls);
}

if ($controls->is_action('continue')) {
    $wpdb->update(NEWSLETTER_EMAILS_TABLE, array('status' => 'sending'), array('id' => $email_id));
    $email = $module->get_email($_GET['id'], ARRAY_A);
    tnp_prepare_controls($email, $controls);
} 

if ($controls->is_action('abort')) {
    $wpdb->query("update " . NEWSLETTER_EMAILS_TABLE . " set last_id=0, sent=0, status='new' where id=" . $email_id);
    $email = $module->get_email($_GET['id'], ARRAY_A);
    tnp_prepare_controls($email, $controls);
    $controls->messages = __('Delivery definitively cancelled', 'newsletter');
}

if ($controls->is_action('change-private')) {
    $data = array();
    $data['private'] = $controls->data['private'] ? 1 : 0;
    $data['id'] = $email['id'];
    $email = Newsletter::instance()->save_email($data, ARRAY_A);
    $controls->add_message_saved();

    tnp_prepare_controls($email, $controls);
}


$editor_type = $module->get_editor_type($email);

// Backward compatibility: preferences conversion
if (!$controls->is_action()) {
    if (!isset($email['options']['lists'])) {

        $options_profile = get_option('newsletter_profile');

        if (empty($controls->data['preferences_status_operator'])) {
            $email['options']['lists_operator'] = 'or';
        } else {
            $email['options']['lists_operator'] = 'and';
        }
        $controls->data['options_lists'] = array();
        $controls->data['options_lists_exclude'] = array();

        if (!empty($email['preferences'])) {
            $preferences = explode(',', $email['preferences']);
            $value = empty($email['options']['preferences_status']) ? 'on' : 'off';

            foreach ($preferences as $x) {
                if ($value == 'on') {
                    $controls->data['options_lists'][] = $x;
                } else {
                    $controls->data['options_lists_exclude'][] = $x;
                }
            }
        }
    }
}
// End backward compatibility

if (!$controls->is_action()) {
    tnp_prepare_controls($email, $controls);
}

if ($controls->is_action('html')) {

    $data = array();
    $data['editor'] = NewsletterEmails::EDITOR_HTML;
    $data['id'] = $email_id;

    // Backward compatibility: clean up the composer flag
    $data['options'] = $email['options'];
    unset($data['options']['composer']);
    // End backward compatibility

    $email = Newsletter::instance()->save_email($data, ARRAY_A);
    $controls->messages = 'You can now edit the newsletter as pure HTML';

    tnp_prepare_controls($email, $controls);
    
    $editor_type = NewsletterEmails::EDITOR_HTML;
}



if ($controls->is_action('test') || $controls->is_action('save') || $controls->is_action('send') || $controls->is_action('schedule')) {

    $email['subject'] = $controls->data['subject'];
    $email['track'] = $controls->data['track'];
    $email['editor'] = $editor_type;
    $email['private'] = $controls->data['private'];
    $email['message_text'] = $controls->data['message_text'];
    if ($controls->is_action('send')) {
        $email['send_on'] = time();
    } else {
        $email['send_on'] = $controls->data['send_on'];
    }

    // Reset and refill the options
    $email['options'] = array();

    foreach ($controls->data as $name => $value) {
        if (strpos($name, 'options_') === 0) {
            $email['options'][substr($name, 8)] = $value;
        }
    }

    // Before send, we build the query to extract subscriber, so the delivery engine does not
    // have to worry about the email parameters
    if ($email['options']['status'] == 'S') {
        $query = "select * from " . NEWSLETTER_USERS_TABLE . " where status='S'";
    } else {
        $query = "select * from " . NEWSLETTER_USERS_TABLE . " where status='C'";
    }

    if ($email['options']['wp_users'] == '1') {
        $query .= " and wp_user_id<>0";
    }
    
    
    $list_where = array();
    if (isset($email['options']['lists']) && count($email['options']['lists'])) {
        foreach ($email['options']['lists'] as $list) {
            $list = (int) $list;
            $list_where[] = 'list_' . $list . '=1';
        }
    }

    if (!empty($list_where)) {
        if (isset($email['options']['lists_operator']) && $email['options']['lists_operator'] == 'and') {
            $query .= ' and (' . implode(' and ', $list_where) . ')';
        } else {
            $query .= ' and (' . implode(' or ', $list_where) . ')';
        }
    }

    // Excluded lists
    $list_where = array();
    if (isset($email['options']['lists_exclude']) && count($email['options']['lists_exclude'])) {
        foreach ($email['options']['lists_exclude'] as $list) {
            $list = (int) $list;
            $list_where[] = 'list_' . $list . '=0';
        }
    }
    if (!empty($list_where)) {
        // Must not be in one of the excluded lists
        $query .= ' and (' . implode(' and ', $list_where) . ')';
    }

    // Gender
    if (isset($email['options']['sex'])) {
        $sex = $email['options']['sex'];
        if (is_array($sex) && count($sex)) {
            $query .= " and sex in (";
            foreach ($sex as $x) {
                $query .= "'" . esc_sql((string) $x) . "', ";
            }
            $query = substr($query, 0, -2);
            $query .= ")";
        }
    }

    // Temporary save to have an object and call the query filter
    $e = Newsletter::instance()->save_email($email);
    $query = apply_filters('newsletter_emails_email_query', $query, $e);

    $email['query'] = $query;
    if ($email['status'] == 'sent') {
        $email['total'] = $email['sent'];
    } else {
        $email['total'] = $wpdb->get_var(str_replace('*', 'count(*)', $query));
    }

    if ($controls->is_action('send') && $controls->data['send_on'] < time()) {
        $controls->data['send_on'] = time();
    }

    $email = Newsletter::instance()->save_email($email, ARRAY_A);

    tnp_prepare_controls($email, $controls);
    
    if ($email === false) {
        $controls->errors = 'Unable to save. Try to deactivate and reactivate the plugin may be the database is out of sync.';
    }

    $controls->add_message_saved();
}

if ($controls->is_action('send') || $controls->is_action('schedule')) {
    if ($email['subject'] == '') {
        $controls->errors = __('A subject is required to send', 'newsletter');
    } else {
        $wpdb->update(NEWSLETTER_EMAILS_TABLE, array('status' => 'sending'), array('id' => $email_id));
        $email['status'] = 'sending';
        if ($controls->is_action('send')) {
	        $controls->messages = __( 'Now sending.', 'newsletter' );
        } else {
	        $controls->messages = __( 'Scheduled.', 'newsletter' );
        }
    }
}




if (isset($email['options']['status']) && $email['options']['status'] == 'S') {
    $controls->warnings[] = __('This newsletter will be sent to not confirmed subscribers.', 'newsletter');
}

if (strpos($email['message'], '{profile_url}') === false && strpos($email['message'], '{unsubscription_url}') === false && strpos($email['message'], '{unsubscription_confirm_url}') === false) {
    $controls->warnings[] = __('The message is missing the subscriber profile or cancellation link.', 'newsletter');
}


if ($email['status'] != 'sent') {
    $subscriber_count = $wpdb->get_var(str_replace('*', 'count(*)', $email['query']));
} else {
    $subscriber_count = $email['sent'];
}
                             
?>
<style>
    .select2-container {
        max-width: 500px;
        display: block;
        margin: 1px;
        margin-top: 5px;
    }
</style>

<div class="wrap tnp-emails tnp-emails-edit" id="tnp-wrap">

    <?php include NEWSLETTER_DIR . '/tnp-header.php'; ?>

    <div id="tnp-heading">

        <h2><?php _e('Edit Newsletter', 'newsletter') ?></h2>

    </div>

    <div id="tnp-body">
        <form method="post" action="" id="newsletter-form">
            <?php $controls->init(array('cookie_name' => 'newsletter_emails_edit_tab')); ?>
            <div class="tnp-status-header">

                <div class="tnp-two-thirds">

                    <div class="tnp-submit">

                        <?php if ($email['status'] == 'sending' || $email['status'] == 'sent') { ?>

                            <?php $controls->button_back('?page=newsletter_emails_index') ?>

                        <?php } else { ?>
                        
                        <a class="button-primary" href="<?php echo $module->get_editor_url($email_id, $editor_type)?>">
                                <i class="fa fa-edit"></i> <?php _e('Edit', 'newsletter') ?>
                            </a>

                        <?php } ?>

                        <?php if ($email['status'] != 'sending' && $email['status'] != 'sent') $controls->button_save(); ?>
                        <?php if ($email['status'] == 'new') { ?>
                            <?php $controls->button_confirm('send', __('Send now', 'newsletter'), __('Start real delivery?', 'newsletter')); ?>
                            <a id="tnp-schedule-button" class="button-secondary" href="javascript:tnp_toggle_schedule()"><i class="far fa-clock"></i> <?php _e("Schedule") ?></a>
                            <span id="tnp-schedule" style="display: none;">
                                <?php $controls->datetime('send_on') ?>
                                <?php $controls->button_confirm('schedule', __('Schedule', 'newsletter'), __('Schedule delivery?', 'newsletter')); ?>
                                <a class="button-secondary tnp-button-cancel" href="javascript:tnp_toggle_schedule()"><?php _e("Cancel") ?></a>
                            </span>
                        <?php } ?>
                        <?php if ($email['status'] == 'sending') $controls->button_confirm('pause', __('Pause', 'newsletter'), __('Pause the delivery?', 'newsletter')); ?>
                        <?php if ($email['status'] == 'paused') $controls->button_confirm('continue', __('Continue', 'newsletter'), 'Continue the delivery?'); ?>
                        <?php if ($email['status'] == 'paused') $controls->button_confirm('abort', __('Stop', 'newsletter'), __('This totally stop the delivery, ok?', 'newsletter')); ?>

                    </div>

                    <?php $controls->text('subject', null, 'Subject'); ?>
                    <a href="#" class="tnp-suggest-button" onclick="tnp_suggest_subject(); return false;"><?php _e('Get ideas', 'newsletter') ?></a>
                    <!--
                    <a href="#" class="tnp-suggest-button" onclick="tnp_emoji(); return false;"><?php _e('Insert emoji', 'newsletter') ?></a>
                    -->
                </div>

                <div class="tnp-one-third">

                    <div id="tnp-nl-status">
                        <span class="tnp-nl-status-title"><?php _e("Status:") ?></span>
                        <span class="tnp-nl-status-title-value"><?php _e("") ?> <?php $module->show_email_status_label($email) ?></span>

                        <?php $module->show_email_progress_bar($email, array('numbers' => $email['status'] == 'sent' ? false : true)) ?>

                        <?php if ($email['status'] == 'sent' || $email['status'] == 'sending') { ?>
                        <div class="tnp-nl-status-row">
                            <span class="tnp-nl-status-schedule-value"><?php if ($email['status'] == 'sent') {
                                    echo __('Sent on'), ' ', $module->format_date( $email['send_on']);
	                            } else if ($email['status'] == 'sending' && $email['send_on'] > time()) {
		                            echo __('Scheduled on'), ' ', $module->format_date( $email['send_on']);
                                }
	                            ?></span>
                        </div>
                        <?php } ?>
                        <div class="tnp-nl-status-row">
                            <span class="tnp-nl-status-schedule-targeting"><?php _e('Targeted subscribers', 'newsletter') ?>:</span>
                            <span class="tnp-nl-status-schedule-value"><?php echo $subscriber_count ?></span>
                        </div>

                    </div>
                </div>

            </div>

            <div id="tabs">
                
                <ul>
                    <li><a href="#tabs-options"><?php _e('Sending Options', 'newsletter') ?></a></li>
                    <li><a href="#tabs-advanced"><?php _e('Advanced', 'newsletter') ?></a></li>
                    <li><a href="#tabs-preview"><?php _e('Preview', 'newsletter') ?></a></li>
                </ul>


                <div id="tabs-options" class="tnp-list-conditions">
                    <p>
                        <?php $controls->panel_help('https://www.thenewsletterplugin.com/documentation/newsletter-targeting') ?>
                    </p>

                    <p>
                        <?php _e('Leaving all multichoice options unselected is like to select all them', 'newsletter'); ?>
                    </p>
                    <table class="form-table">
                        <tr>
                            <th><?php _e('Lists', 'newsletter') ?></th>
                            <td>
                                <?php
                                $lists = $controls->get_list_options();
                                ?>
                                <?php $controls->select('options_lists_operator', array('or' => __('Match at least one of', 'newsletter'), 'and' => __('Match all of', 'newsletter'))); ?>

                                <?php $controls->select2('options_lists', $lists, null, true, null, __('All', 'newsletter')); ?>

                                <br>
                                <?php _e('must not in one of', 'newsletter') ?>

                                <?php $controls->select2('options_lists_exclude', $lists, null, true, null, __('None', 'newsletter')); ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php _e('Gender', 'newsletter') ?></th>
                            <td>
                                <?php $controls->checkboxes_group('options_sex', array('f' => 'Women', 'm' => 'Men', 'n' => 'Not specified')); ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php _e('Status', 'newsletter') ?></th>
                            <td>
                                <?php $controls->select('options_status', array('C' => __('Confirmed', 'newsletter'), 'S' => __('Not confirmed', 'newsletter'))); ?>

                            </td>
                        </tr>
                        <tr>
                            <th><?php _e('Only to subscribers linked to WP users', 'newsletter') ?></th>
                            <td>
                                <?php $controls->yesno('options_wp_users'); ?>
                            </td>
                        </tr>
                    </table>

                    <?php do_action('newsletter_emails_edit_target', $module->get_email($email_id), $controls) ?>

                </div>

                
                <div id="tabs-advanced">

                    <table class="form-table">
                        <tr>
                            <th><?php _e('Keep private', 'newsletter') ?></th>
                            <td>
                                <?php $controls->yesno('private'); ?>
                                <?php if ($email['status'] == 'sent') { ?>
                                    <?php $controls->button('change-private', __('Toggle')) ?>
                                <?php } ?>
                                <p class="description">
                                    <?php _e('Hide/show from public sent newsletter list.', 'newsletter') ?>
                                    <?php _e('Required', 'newsletter') ?>: <a href="" target="_blank">Newsletter Archive Extension</a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th><?php _e('Track clicks and message opening', 'newsletter') ?></th>
                            <td>
                                <?php $controls->yesno('track'); ?>
                            </td>
                        </tr>
                    </table>

                    <?php do_action('newsletter_emails_edit_other', $module->get_email($email_id), $controls) ?>

                    <table class="form-table">
                        <tr>
                            <th>Query (tech)</th>
                            <td><?php echo esc_html($email['query']); ?></td>
                        </tr>
                        <tr>
                            <th>Token (tech)</th>
                            <td><?php echo esc_html($email['token']); ?></td>
                        </tr>
                        <tr>
                            <th>This is the textual version of your newsletter. If you empty it, only an HTML version will be sent but is an anti-spam best practice to include a text only version.</th>
                            <td>
                                <?php if (Newsletter::instance()->options['phpmailer'] == 0) { ?>
                                    <p class="tnp-tab-warning">The text part is sent only when Newsletter manages directly the sending process. <a href="admin.php?page=newsletter_main_main" target="_blank">See the main settings</a>.</p>
                                <?php } ?>
                                <?php $controls->textarea_fixed('message_text', '100%', '500'); ?>
                            </td>
                        </tr>
                    </table>
                </div>
                

                <div id="tabs-preview">

                    <div class="tnpc-preview">
                        <!-- Flat Laptop Browser -->
                        <div class="fake-browser-ui">
                            <div class="frame">
                                <span class="bt-1"></span>
                                <span class="bt-2"></span>
                                <span class="bt-3"></span>
                            </div>
                            <iframe id="tnpc-preview-desktop" src="" width="700" height="520" alt="" frameborder="0"></iframe>
                        </div>

                        <!-- Flat Mobile Browser -->
                        <div class="fake-mobile-browser-ui">
                            <iframe id="tnpc-preview-mobile" src="" width="320" height="445" alt="" frameborder="0"></iframe>
                            <div class="frame">
                                <span class="bt-4"></span>
                            </div>
                        </div>
                    </div>

                    <script type="text/javascript">
                        preview_url = ajaxurl + "?action=tnpc_preview&id=<?php echo $email_id ?>";
                        jQuery('#tnpc-preview-desktop, #tnpc-preview-mobile').attr("src", preview_url);
                        setTimeout(function () {
                            jQuery('#tnpc-preview-desktop, #tnpc-preview-mobile').contents().find("a").click(function (e) {
                                e.preventDefault();
                            })
                        }, 500);
                    </script>

                    <p>
                    <?php if ($editor_type != NewsletterEmails::EDITOR_HTML && $email['status'] != 'sending' && $email['status'] != 'sent') $controls->button_confirm('html', __('Convert to HTML newsletter', 'newsletter'), 'Attention: no way back!'); ?>
                    </p>
                </div>

            </div>

        </form>
    </div>

    <?php include NEWSLETTER_DIR . '/emails/subjects.php'; ?>

    <?php include NEWSLETTER_DIR . '/tnp-footer.php'; ?>

</div>
