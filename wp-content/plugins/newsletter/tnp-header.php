<?php
global $current_user, $wpdb;

defined('ABSPATH') || exit;

$dismissed = get_option('newsletter_dismissed', array());

$user_count = $wpdb->get_var("select count(*) from " . NEWSLETTER_USERS_TABLE . " where status='C'");

$is_administrator = current_user_can('administrator');

function newsletter_print_entries($group) {
    $entries = apply_filters('newsletter_menu_' . $group, array());
    if ($entries) {
        foreach ($entries as &$entry) {
            echo '<li><a href="';
            echo $entry['url'];
            echo '">';
            echo $entry['label'];
            if (!empty($entry['description'])) {
                echo '<small>';
                echo $entry['description'];
                echo '</small>';
            }
            echo '</a></li>';
        }
    }
}

// Check the status to show a warning if needed
$status_options = Newsletter::instance()->get_options('status');
$warning = false;

$warning |= empty($status_options['mail']);
?>

<div class="tnp-drowpdown" id="tnp-header">
    <a href="?page=newsletter_main_index"><img src="<?php echo plugins_url('newsletter'); ?>/images/header/tnp-logo-red-header.png" class="tnp-header-logo" style="vertical-align: bottom;"></a>
    <ul>
        <li><a href="#"><i class="fa fa-users"></i> <?php _e('Subscribers', 'newsletter') ?> <i class="fa fa-chevron-down"></i></a>
            <ul>
                <li><a href="?page=newsletter_users_index"><i class="fa fa-search"></i> <?php _e('Search And Edit', 'newsletter') ?>
                        <small><?php _e('Add, edit, search', 'newsletter') ?></small></a></li>
                <li><a href="?page=newsletter_profile_index"><i class="fa fa-user-circle"></i> <?php _e('Profile page', 'newsletter') ?>
                        <small><?php _e('The subscriber personal profile editing panel', 'newsletter') ?></small></a></li>
                <li><a href="?page=newsletter_users_import"><i class="fa fa-upload"></i> <?php _e('Import', 'newsletter') ?>
                        <small><?php _e('Import from external sources', 'newsletter') ?></small></a></li>
                <li><a href="?page=newsletter_users_export"><i class="fa fa-download"></i> <?php _e('Export', 'newsletter') ?>
                        <small><?php _e('Export your subscribers list', 'newsletter') ?></small></a></li>
                <li><a href="?page=newsletter_users_massive"><i class="fa fa-wrench"></i> <?php _e('Maintenance', 'newsletter') ?>
                        <small><?php _e('Massive actions: change list, clean up, ...', 'newsletter') ?></small></a></li>
                <li><a href="?page=newsletter_users_statistics"><i class="fa fa-chart-bar"></i> <?php _e('Statistics', 'newsletter') ?>
                        <small><?php _e('All about your subscribers', 'newsletter') ?></small></a></li>
                <?php
                newsletter_print_entries('subscribers');
                ?>
            </ul>
        </li>
        <li><a href="#"><i class="fa fa-list"></i> <?php _e('List Building', 'newsletter') ?> <i class="fa fa-chevron-down"></i></a>
            <ul>
                <li><a href="?page=newsletter_subscription_options"><i class="fa fa-sign-in-alt"></i> <?php _e('Subscription', 'newsletter') ?>
                        <small><?php _e('The subscription process in detail', 'newsletter') ?></small></a></li>

                <li><a href="?page=newsletter_subscription_antibot"><i class="fa fa-lock"></i> <?php _e('Security', 'newsletter') ?>
                        <small><?php _e('Spam subscriptions control', 'newsletter') ?></small></a></li>

                <li>
                    <a href="?page=newsletter_subscription_profile"><i class="fa fa-check-square"></i> <?php _e('Subscription Form Fields, Buttons, Labels', 'newsletter') ?>
                        <small><?php _e('When and what data to collect', 'newsletter') ?></small></a>
                </li>
                <li>
                    <a href="?page=newsletter_subscription_lists"><i class="fa fa-th-list"></i> <?php _e('Lists', 'newsletter') ?>
                        <small><?php _e('Profile the subscribers for a better targeting', 'newsletter') ?></small></a>
                </li>
                <li>
                    <a href="?page=newsletter_unsubscription_index"><i class="fa fa-sign-out-alt"></i> <?php _e('Unsubscription', 'newsletter') ?>
                        <small><?php _e('How to give the last goodbye (or avoid it!)', 'newsletter') ?></small></a>
                </li>

                <li>
                    <a href="?page=newsletter_subscription_forms"><i class="fa fa-edit"></i> <?php _e('Custom Forms', 'newsletter') ?>
                        <small><?php _e('Hand coded form storage', 'newsletter') ?></small></a>
                </li>

                <?php
                newsletter_print_entries('subscription');
                ?>
            </ul>
        </li>
        <li><a href="#"><i class="fa fa-newspaper"></i> <?php _e('Newsletters', 'newsletter') ?> <i class="fa fa-chevron-down"></i></a>
            <ul>
                <li><a href="?page=newsletter_emails_theme"><i class="fa fa-plus"></i> <?php _e('Create newsletter', 'newsletter') ?>
                        <small><?php _e('Start your new campaign', 'newsletter') ?></small></a></li>
                <li><a href="?page=newsletter_emails_index"><i class="fa fa-newspaper"></i> <?php _e('Newsletters', 'newsletter') ?>
                        <small><?php _e('The classic "write & send" newsletters', 'newsletter') ?></small></a></li>
                <li><a href="?page=<?php echo apply_filters('newsletter_admin_page', 'newsletter_statistics_index') ?>"><i class="fa fa-chart-bar"></i> <?php _e('Statistics', 'newsletter') ?>
                        <small><?php _e('Tracking configuration and basic data', 'newsletter') ?></small></a></li>
                <?php
                newsletter_print_entries('newsletters');
                ?>
            </ul>
        </li>
        <li><a href="#"><i class="fa fa-cog"></i> <?php _e('Settings', 'newsletter') ?> <i class="fa fa-chevron-down"></i></a>
            <ul>
                <?php if ($is_administrator) { ?>
                <li>
                    <a href="?page=newsletter_main_main"><i class="fa fa-cogs"></i> <?php _e('General Settings', 'newsletter') ?>
                        <small><?php _e('Delivery speed, sender details, ...', 'newsletter') ?></small></a>
                </li>
                <?php if (!class_exists('NewsletterSmtp')) { ?>
                    <li>
                        <a href="?page=newsletter_main_smtp"><i class="fa fa-server"></i> <?php _e('SMTP', 'newsletter') ?>
                            <small><?php _e('External mail server', 'newsletter') ?></small>
                        </a>
                    </li>
                <?php } ?>
                <?php } ?>
                        
                <li><a href="?page=newsletter_main_info"><i class="fa fa-info"></i> <?php _e('Company Info', 'newsletter') ?>
                        <small><?php _e('Social, address, logo and general info', 'newsletter') ?></small></a></li>
                <li>
                    <a href="?page=newsletter_subscription_template"><i class="fa fa-file-alt"></i> <?php _e('Messages Template', 'newsletter') ?>
                        <small><?php _e('Change the look of your service emails', 'newsletter') ?></small></a>
                </li>

                <?php
                newsletter_print_entries('settings');
                ?>
            </ul>
        </li>

        <?php if ($is_administrator) { ?>
        <li>
            <a href="?page=newsletter_main_status"><i class="fa fa-thermometer"></i> <?php _e('Status', 'newsletter') ?>
                <?php if ($warning) { ?>
                    <i class="fa fa-exclamation-triangle" style="color: red;"></i>
                <?php } ?>
            </a>
        </li>
        <?php } ?>

        <?php
        if (empty(Newsletter::instance()->options['contract_key']) && !defined('NEWSLETTER_LICENSE_KEY')) {
            ?>
            <li class="tnp-professional-extensions-button"><a href="https://www.thenewsletterplugin.com/premium?utm_source=plugin&utm_medium=link&utm_campaign=header" target="_blank">
                    <i class="fa fa-trophy"></i> <?php _e('Get Professional Addons', 'newsletter') ?></a>
            </li>
        <?php } else {
            ?>
            <?php if (empty(Newsletter::instance()->options['licence_expires'])) { ?>
                <li class="tnp-professional-extensions-button-red">
                    <a href="?page=newsletter_main_main"><i class="fa fa-hand-paper" style="color: white"></i> <?php _e('Licence not valid', 'newsletter') ?></a>
                <?php } else { ?>
                    <?php if (Newsletter::instance()->options['licence_expires'] > time()) { ?>
                    <li class="tnp-professional-extensions-button">
                        <?php
                        if (!class_exists('NewsletterExtensions')) {
                            echo '<a href="?page=newsletter_main_extensions">';
                        } else {
                            echo '<a href="?page=newsletter_extensions_index">';
                        }
                        ?>
                        <i class="fa fa-check-square"></i> <?php _e('Licence active', 'newsletter') ?></a>
                    <?php } elseif (Newsletter::instance()->options['licence_expires'] < time()) { ?>
                    <li class="tnp-professional-extensions-button-red">
                        <a href="?page=newsletter_main_main"><i class="fa fa-hand-paper" style="color: white"></i> <?php _e('Licence expired', 'newsletter') ?></a>
                    <?php } ?>
                <?php } ?>
            </li>
        <?php } ?>
    </ul>
</div>

<?php if (isset($_GET['debug']) || !isset($dismissed['newsletter-shortcode'])) { ?>
    <?php
    // Check of Newsletter dedicated page
    if (!empty(Newsletter::instance()->options['page'])) {
        if (get_post_status(Newsletter::instance()->options['page']) === 'publish') {
            $content = get_post_field('post_content', Newsletter::instance()->options['page']);
            // With and without attributes
            if (strpos($content, '[newsletter]') === false && strpos($content, '[newsletter ') === false) {
                ?>    
                <div class="tnp-notice">
                    <a href="<?php echo $_SERVER['REQUEST_URI'] . '&noheader=1&dismiss=newsletter-shortcode' ?>" class="tnp-dismiss">&times;</a>
                    The Newsletter dedicated page does not contain the [newsletter] shortcode. If you're using a visual composer it could be ok.
                    <a href="<?php echo site_url('/wp-admin/post.php') ?>?post=<?php echo esc_attr(Newsletter::instance()->options['page']) ?>&action=edit"><strong>Edit the page</strong></a>.

                </div>
                <?php
            }
        }
    }
    ?>
<?php } ?>

<?php if (isset($_GET['debug']) || !isset($dismissed['rate']) && $user_count > 300) { ?>
    <div class="tnp-notice">
        <a href="<?php echo $_SERVER['REQUEST_URI'] . '&noheader=1&dismiss=rate' ?>" class="tnp-dismiss">&times;</a>

        We never asked before and we're curious: <a href="http://wordpress.org/plugins/newsletter/" target="_blank">would you rate this plugin</a>?
        (few seconds required - account on WordPress.org required, every blog owner should have one...). <strong>Really appreciated, The Newsletter Team</strong>.

    </div>
<?php } ?>

<?php if (isset($_GET['debug']) || !isset($dismissed['newsletter-page']) && empty(Newsletter::instance()->options['page'])) { ?>
    <div class="tnp-notice">
        <a href="<?php echo $_SERVER['REQUEST_URI'] . '&noheader=1&dismiss=newsletter-page' ?>" class="tnp-dismiss">&times;</a>

        You should create a blog page to show the subscription form and the subscription messages. Go to the
        <a href="?page=newsletter_main_main">general settings panel</a> to configure it.

    </div>
<?php } ?>

<?php if (isset($_GET['debug']) || !isset($dismissed['newsletter-subscribe']) && get_option('newsletter_install_time') && get_option('newsletter_install_time') < time() - 86400 * 15) { ?>
    <div class="tnp-notice">
        <a href="<?php echo $_SERVER['REQUEST_URI'] . '&noheader=1&dismiss=newsletter-subscribe' ?>" class="tnp-dismiss">&times;</a>
        If you want to be informed of important updates of Newsletter, you may want to subscribe to our newsletter<br>
        <form action="https://www.thenewsletterplugin.com/?na=s" target="_blank" method="post">
            <input type="hidden" value="plugin-header" name="nr">
            <input type="hidden" value="3" name="nl[]">
            <input type="hidden" value="single" name="optin">
            <input type="email" name="ne" value="<?php echo esc_attr(get_option('admin_email')) ?>">
            <input type="submit" value="<?php esc_attr_e('Subscribe', 'newsletter') ?>">
        </form>
    </div>
<?php } ?>

<div id="tnp-notification">
    <?php
    if (isset($controls)) {
        $controls->show();
        $controls->messages = '';
        $controls->errors = '';
    }
    ?>
</div>
