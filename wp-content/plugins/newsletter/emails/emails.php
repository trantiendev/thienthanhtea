<?php

defined('ABSPATH') || exit;

require_once NEWSLETTER_INCLUDES_DIR . '/themes.php';
require_once NEWSLETTER_INCLUDES_DIR . '/module.php';

class NewsletterEmails extends NewsletterModule {

    static $instance;

    const EDITOR_COMPOSER = 2;
    const EDITOR_HTML = 1;
    const EDITOR_TINYMCE = 0;

    static $PRESETS_LIST;

    /**
     * @return NewsletterEmails
     */
    static function instance() {
        if (self::$instance == null) {
            self::$instance = new NewsletterEmails();
        }
        return self::$instance;
    }

    function __construct() {
        self::$PRESETS_LIST = array("cta", "invite", "announcement", "posts", "sales", "product", "tour", "simple", "blank");
        $this->themes = new NewsletterThemes('emails');
        parent::__construct('emails', '1.1.5');
        add_action('wp_loaded', array($this, 'hook_wp_loaded'));

        if (is_admin()) {
            add_action('wp_ajax_tnpc_render', array($this, 'tnpc_render_callback'));
            add_action('wp_ajax_tnpc_preview', array($this, 'tnpc_preview_callback'));
            add_action('wp_ajax_tnpc_css', array($this, 'tnpc_css_callback'));
            add_action('wp_ajax_tnpc_options', array($this, 'hook_wp_ajax_tnpc_options'));
            add_action('wp_ajax_tnpc_presets', array($this, 'hook_wp_ajax_tnpc_presets'));

            // Thank you to plugins which add the WP editor on other admin plugin pages...
            if (isset($_GET['page']) && $_GET['page'] == 'newsletter_emails_edit') {
                global $wp_actions;
                $wp_actions['wp_enqueue_editor'] = 1;
            }
        }
    }

    function options_decode($options) {

        // Start compatibility
        if (is_string($options) && strpos($options, 'options[') !== false) {
            $opts = array();
            parse_str($options, $opts);
            $options = $opts['options'];
        }
        // End compatibility

        if (is_array($options)) {
            return $options;
        }

        $tmp = json_decode($options, true);
        if (is_null($tmp)) {
            return json_decode(base64_decode($options), true);
        } else {
            return $tmp;
        }
    }

    /**
     *
     * @param array $options Options array
     */
    function options_encode($options) {
        return base64_encode(json_encode($options, JSON_HEX_TAG | JSON_HEX_AMP));
    }

    function hook_wp_ajax_tnpc_options() {
        global $wpdb;

        // TODO: Uniform to use id everywhere
        if (!isset($_REQUEST['id']))
            $_REQUEST['id'] = $_REQUEST['b'];

        $block = $this->get_block($_REQUEST['id']);
        if (!$block) {
            die('Block not found with id ' . esc_html($_REQUEST['id']));
        }

        if (!class_exists('NewsletterControls')) {
            include NEWSLETTER_INCLUDES_DIR . '/controls.php';
        }
        $options = $this->options_decode(stripslashes_deep($_REQUEST['options']));

//        $defaults = array(
//            'block_padding_top' => 15,
//            'block_padding_bottom' => 15,
//            'block_padding_right' => 0,
//            'block_padding_left' => 0,
//            'block_background' => '#ffffff'
//        );
//
//        $options = array_merge($defaults, $options);

        $controls = new NewsletterControls($options);
        $fields = new NewsletterFields($controls);

        $controls->init();
        echo '<input type="hidden" name="action" value="tnpc_render">';
        echo '<input type="hidden" name="b" value="' . esc_attr($_REQUEST['id']) . '">';

        ob_start();
        include $block['dir'] . '/options.php';
        $content = ob_get_clean();
        echo "<h2>", esc_html($block["name"]), "</h2>";
        echo $content;
        wp_die();
    }

    /**
     * Retrieves the presets list (no id in GET) or a specific preset id in GET)
     *
     * @return string
     */
    function hook_wp_ajax_tnpc_presets() {

        $content = "";

        if (!empty($_REQUEST['id'])) {

            // Preset render
            $preset = $this->get_preset($_REQUEST['id']);

            foreach ($preset->blocks as $item) {
                $this->render_block($item->block, true, (array) $item->options);
            }
        } else {

            $content = "<div class='clear tnpc-presets-title'>" . __('Choose a preset:', 'newsletter') . "</div>";

            foreach (self::$PRESETS_LIST as $id) {

                $preset = $this->get_preset($id);

                $content .= "<div class='tnpc-preset' onclick='tnpc_load_preset(\"$id\")'>";
                $content .= "<img src='$preset->icon' title='$preset->name' />";
                $content .= "<span class='tnpc-preset-label'>$preset->name</span>";
                $content .= '</div>';
            }

            $content .= '<div class="clear"></div>';
            echo $content;
        }

        wp_die();
    }

    function has_dynamic_blocks($theme) {
        preg_match_all('/data-json="(.*?)"/m', $theme, $matches, PREG_PATTERN_ORDER);
        foreach ($matches[1] as $match) {
            $a = html_entity_decode($match, ENT_QUOTES, 'UTF-8');
            $options = $this->options_decode($a);

            $block = $this->get_block($options['block_id']);
            if (!$block) {
                continue;
            }
            if ($block['type'] == 'dynamic')
                return true;
        }
        return false;
    }

    /**
     * Regenerates a saved composed email rendering each block. Regeneration is
     * conditioned (possibly) by the context. The context is usually passed to blocks
     * so they can act in the right manner.
     *
     * The last run parameter can instruct the block to generate content conditioned to
     * the passed timestamp (for example limiting the content to new posts from the last
     * run timestamp).
     *
     * @param string $theme (Rinominare)
     * @return string
     */
    function regenerate($theme, $context = array()) {
        
        if (empty($theme)) {
            return array('body' => '', 'subject' => '');
        }
        
        $context = array_merge(array('last_run' => 0, 'type' => ''), $context);

        preg_match_all('/data-json="(.*?)"/m', $theme, $matches, PREG_PATTERN_ORDER);
        $result = '';
        $all_empty = true; // If all dynamic content blocks return an empty html
        $has_dynamic_blocks = false;
        $subject = '';

        foreach ($matches[1] as $match) {
            $a = html_entity_decode($match, ENT_QUOTES, 'UTF-8');
            $options = $this->options_decode($a);

            $block = $this->get_block($options['block_id']);
            if (!$block) {
                continue;
            }

            ob_start();
            $out = $this->render_block($options['block_id'], true, $options, $context);
            if (empty($subject) && !empty($out['subject'])) {
                $subject = $out['subject'];
            }
            $block_html = ob_get_clean();
            $result .= $block_html;
            // If a dynamic block return something, we need to return a regenerated template
            if ($block['type'] == 'dynamic') {
                $has_dynamic_blocks = true;
                if (!empty($block_html)) {
                    $all_empty = false;
                }
            }
        }

        if ($has_dynamic_blocks && $all_empty) {
            die('all empty');
            return '';
        }

        $x = strpos($theme, '<body');
        if ($x !== false) {
            $x = strpos($theme, '>', $x);
            $result = substr($theme, 0, $x + 1) . $result . '</body></html>';
        } else {
            
        }
        return array('body' => $result, 'subject' => $subject);
    }

    function remove_block_data($text) {
        // TODO: Lavorare!
        return $text;
    }

    /**
     * Renders a block identified by its id, using the block options and adding a wrapper
     * if required (for the first block rendering.
     * @param type $block_id
     * @param type $wrapper
     * @param type $options
     */
    function render_block($block_id = null, $wrapper = false, $options = array(), $context = array()) {
        include_once NEWSLETTER_INCLUDES_DIR . '/helper.php';

        $width = 600;
        $font_family = 'Helvetica, Arial, sans-serif';

        $info = Newsletter::instance()->get_options('info');

        // Just in case...
        if (!is_array($options)) {
            $options = array();
        }

        $block_options = get_option('newsletter_main');

        $block = $this->get_block($block_id);

        // Block not found
        if (!$block) {
            if ($wrapper) {
                echo '<table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" style="border-collapse: collapse; width: 100%;" class="tnpc-row tnpc-row-block" data-id="', esc_attr($block_id), '">';
                echo '<tr>';
                echo '<td data-options="" bgcolor="#ffffff" align="center" style="padding: 0; font-family: Helvetica, Arial, sans-serif;" class="edit-block">';
            }
            echo '<!--[if mso]><table border="0" cellpadding="0" align="center" cellspacing="0" width="' . $width . '"><tr><td width="' . $width . '"><![endif]-->';
            echo "\n";

            echo 'Block not found';

            echo "<!--[if mso]></td></tr></table><![endif]-->\n";
            if ($wrapper) {
                echo '</td></tr></table>';
            }
            return;
        }

        $out = array('subject' => '');


        ob_start();
        include $block['dir'] . '/block.php';
        $content = trim(ob_get_clean());

        if (empty($content)) {
            return $out;
        }

        $common_defaults = array(
            'block_padding_top' => 0,
            'block_padding_bottom' => 0,
            'block_padding_right' => 0,
            'block_padding_left' => 0,
            'block_background' => '#ffffff'
        );

        $options = array_merge($common_defaults, $options);

        // Obsolete
        $content = str_replace('{width}', $width, $content);

        $content = $this->inline_css($content, true);

        // CSS driven by the block
        // Requited for the server side parsing and rendering
        $options['block_id'] = $block_id;

        $options['block_padding_top'] = (int) str_replace('px', '', $options['block_padding_top']);
        $options['block_padding_bottom'] = (int) str_replace('px', '', $options['block_padding_bottom']);
        $options['block_padding_right'] = (int) str_replace('px', '', $options['block_padding_right']);
        $options['block_padding_left'] = (int) str_replace('px', '', $options['block_padding_left']);

        // Internal TD wrapper
        $style = 'text-align: center; ';
        $style .= 'width: 100%!important; ';
        $style .= 'padding-top: ' . $options['block_padding_top'] . 'px; ';
        $style .= 'padding-left: ' . $options['block_padding_left'] . 'px; ';
        $style .= 'padding-right: ' . $options['block_padding_right'] . 'px; ';
        $style .= 'padding-bottom: ' . $options['block_padding_bottom'] . 'px; ';
        $style .= 'background-color: ' . $options['block_background'] . ';';



        $data = $this->options_encode($options);
        // First time block creation wrapper
        if ($wrapper) {
            echo '<table type="block" border="0" cellpadding="0" cellspacing="0" align="center" width="100%" style="border-collapse: collapse; width: 100%;" class="tnpc-row tnpc-row-block" data-id="', esc_attr($block_id), '">', "\n";
            echo "<tr>";
            echo '<td align="center" style="padding: 0;" class="edit-block">', "\n";
        }

        // Container that fixes the width and makes the block responsive
        echo '<!--[if mso]><table border="0" cellpadding="0" align="center" cellspacing="0" width="' . $width . '"><tr><td width="' . $width . '"><![endif]-->';
        echo "\n";
        echo '<table type="options" data-json="', esc_attr($data), '" class="tnpc-block-content" border="0" cellpadding="0" align="center" cellspacing="0" width="100%" style="width: 100%!important; max-width: ', $width, 'px!important">', "\n";
        echo "<tr>";
        echo '<td align="center" style="', $style, '" bgcolor="', $options['block_background'], '" width="100%">', "\n";

        //echo "<!-- block generated content -->\n";
        echo $content;
        //echo "\n<!-- /block generated content -->\n";

        echo "\n</td></tr></table>";
        echo '<!--[if mso]></td></tr></table><![endif]-->';

        // First time block creation wrapper
        if ($wrapper) {
            echo "</td></tr></table>";
        }
        echo "\n";

        return $out;
    }

    /**
     * Ajax call to render a block with a new set of options after the settings popup
     * has been saved.
     *
     * @param type $block_id
     * @param type $wrapper
     */
    function tnpc_render_callback() {
        $block_id = $_POST['b'];
        $wrapper = isset($_POST['full']);
        if (isset($_POST['options']) && is_array($_POST['options'])) {
            $options = stripslashes_deep($_POST['options']);
        } else {
            $options = array();
        }
        $this->render_block($block_id, $wrapper, $options);
        wp_die();
    }

    function tnpc_preview_callback() {
        $email = Newsletter::instance()->get_email($_REQUEST['id'], ARRAY_A);

        if (empty($email)) {
            echo 'Wrong email identifier';
            return;
        }

        echo $email['message'];

        wp_die(); // this is required to terminate immediately and return a proper response
    }

    function tnpc_css_callback() {
        include NEWSLETTER_DIR . '/emails/tnp-composer/css/newsletter.css';
        wp_die(); // this is required to terminate immediately and return a proper response
    }

    /** Returns the correct admin page to edit the newsletter with the correct editor. */
    function get_editor_url($email_id, $editor_type) {
        switch ($editor_type) {
            case NewsletterEmails::EDITOR_COMPOSER: return admin_url("admin.php") . '?page=newsletter_emails_composer&id=' . $email_id;
            case NewsletterEmails::EDITOR_HTML: return admin_url("admin.php") . '?page=newsletter_emails_editorhtml&id=' . $email_id;
            case NewsletterEmails::EDITOR_TINYMCE: return admin_url("admin.php") . '?page=newsletter_emails_editortinymce&id=' . $email_id;
        }
    }

    /**
     * Returns the button linked to the correct "edit" page for the passed newsletter. The edit page can be an editor
     * or the targeting page (it depends on newsletter status).
     * 
     * @param TNP_Email $email
     */
    function get_edit_button($email) {

        $editor_type = $this->get_editor_type($email);
        if ($email->status == 'new') {
            $edit_url = $this->get_editor_url($email->id, $editor_type);
        } else {
            $edit_url = 'admin.php?page=newsletter_emails_edit&id=' . $email->id;
        }
        switch ($editor_type) {
            case NewsletterEmails::EDITOR_COMPOSER:
                $icon_class = 'th-large';
                break;
            case NewsletterEmails::EDITOR_HTML:
                $icon_class = 'code';
                break;
            default:
                $icon_class = 'edit';
                break;
        }

        return '<a class="button-primary" href="' . $edit_url . '">' .
                '<i class="fa fa-' . $icon_class . '"></i> ' . __('Edit', 'newsletter') . '</a>';
    }

    /** Returns the correct editor type for the provided newsletter. Contains backward compatibility code. */
    function get_editor_type($email) {
        $email = (object) $email;
        $editor_type = $email->editor;

        // Backward compatibility
        $email_options = maybe_unserialize($email->options);
        if (isset($email_options['composer'])) {
            $editor_type = NewsletterEmails::EDITOR_COMPOSER;
        }
        // End backward compatibility

        return $editor_type;
    }

    function hook_wp_loaded() {
        global $wpdb;

        $newsletter = Newsletter::instance();

        switch ($newsletter->action) {
            case 'v':
            case 'view':
                $email = $this->get_email($_GET['id']);
                if (empty($email)) {
                    header("HTTP/1.0 404 Not Found");
                    die('Email not found');
                }

                $user = NewsletterSubscription::instance()->get_user_from_request();

                if (!is_user_logged_in() || !(current_user_can('editor') || current_user_can('administrator'))) {

                    if ($email->status == 'new') {
                        header("HTTP/1.0 404 Not Found");
                        die('Not sent yet');
                    }

                    if ($email->private == 1) {
                        if (!$user) {
                            header("HTTP/1.0 404 Not Found");
                            die('No available for online view');
                        }
                        $sent = $wpdb->get_row($wpdb->prepare("select * from " . NEWSLETTER_SENT_TABLE . " where email_id=%d and user_id=%d limit 1", $email->id, $user->id));
                        if (!$sent) {
                            header("HTTP/1.0 404 Not Found");
                            die('No available for online view');
                        }
                    }
                }


                header('Content-Type: text/html;charset=UTF-8');
                header('X-Robots-Tag: noindex,nofollow,noarchive');
                header('Cache-Control: no-cache,no-store,private');

                echo $newsletter->replace($email->message, $user, $email);

                die();
                break;

            case 'emails-css':
                $email_id = (int) $_GET['id'];

                $body = Newsletter::instance()->get_email_field($email_id, 'message');

                $x = strpos($body, '<style');
                if ($x === false)
                    return;

                $x = strpos($body, '>', $x);
                $y = strpos($body, '</style>');

                header('Content-Type: text/css;charset=UTF-8');

                echo substr($body, $x + 1, $y - $x - 1);

                die();
                break;

            case 'emails-composer-css':
                header('Cache: no-cache');
                header('Content-Type: text/css');
                echo $this->get_composer_css();
                die();
                break;

            case 'emails-preview':
                if (!Newsletter::instance()->is_allowed()) {
                    die('Not enough privileges');
                }

                if (!check_admin_referer('view')) {
                    die();
                }

                // Used by theme code
                $theme_options = $this->get_current_theme_options();
                $theme_url = $this->get_current_theme_url();
                header('Content-Type: text/html;charset=UTF-8');

                include($this->get_current_theme_file_path('theme.php'));

                die();
                break;

            case 'emails-preview-text':
                header('Content-Type: text/plain;charset=UTF-8');
                if (!Newsletter::instance()->is_allowed()) {
                    die('Not enough privileges');
                }

                if (!check_admin_referer('view')) {
                    die();
                }

                // Used by theme code
                $theme_options = $this->get_current_theme_options();

                $file = $this->get_current_theme_file_path('theme-text.php');
                if (is_file($file)) {
                    include($this->get_current_theme_file_path('theme-text.php'));
                }

                die();
                break;


            case 'emails-create':

                if (!Newsletter::instance()->is_allowed()) {
                    die('Not enough privileges');
                }

                require_once NEWSLETTER_INCLUDES_DIR . '/controls.php';
                $controls = new NewsletterControls();

                if ($controls->is_action('create')) {
                    $this->save_options($controls->data);

                    $email = array();
                    $email['status'] = 'new';
                    $email['subject'] = ''; //__('Here the email subject', 'newsletter');
                    $email['track'] = 1;

                    $theme_options = $this->get_current_theme_options();

                    $theme_url = $this->get_current_theme_url();
                    $theme_subject = '';

                    ob_start();
                    include $this->get_current_theme_file_path('theme.php');
                    $email['message'] = ob_get_clean();

                    if (!empty($theme_subject)) {
                        $email['subject'] = $theme_subject;
                    }

                    ob_start();
                    include $this->get_current_theme_file_path('theme-text.php');
                    $email['message_text'] = ob_get_clean();

                    $email['type'] = 'message';
                    $email['send_on'] = time();
                    $email = $newsletter->save_email($email);

                    $edit_url = $this->get_editor_url($email->id, $email->editor);

                    header('Location: ' . $edit_url);
                }
                die();
                break;
        }
    }

    function upgrade() {
        global $wpdb, $charset_collate;

        parent::upgrade();

        $this->upgrade_query("alter table " . NEWSLETTER_EMAILS_TABLE . " change column `type` `type` varchar(50) not null default ''");
        $this->upgrade_query("alter table " . NEWSLETTER_EMAILS_TABLE . " add column token varchar(10) not null default ''");
        $this->upgrade_query("alter table " . NEWSLETTER_EMAILS_TABLE . " drop column visibility");
        $this->upgrade_query("alter table " . NEWSLETTER_EMAILS_TABLE . " add column private tinyint(1) not null default 0");

        // Force a token to email without one already set.
        //$token = self::get_token();
        //$wpdb->query("update " . NEWSLETTER_EMAILS_TABLE . " set token='" . $token . "' where token=''");
        if ($this->old_version < '1.1.5') {
            $this->upgrade_query("update " . NEWSLETTER_EMAILS_TABLE . " set type='message' where type=''");
            $wpdb->query("update " . NEWSLETTER_EMAILS_TABLE . " set token=''");
        }
        $wpdb->query("update " . NEWSLETTER_EMAILS_TABLE . " set total=sent where status='sent' and type='message'");

        return true;
    }

    function admin_menu() {
        $this->add_menu_page('index', 'Newsletters');
        $this->add_admin_page('list', 'Email List');
        $this->add_admin_page('new', 'Email New');
        $this->add_admin_page('edit', 'Email Edit');
        $this->add_admin_page('theme', 'Email Themes');
        $this->add_admin_page('composer', 'The Composer');
        $this->add_admin_page('editorhtml', 'HTML Editor');
        $this->add_admin_page('editortinymce', 'TinyMCE Editor');
        //$this->add_admin_page('cpreview', 'The Composer Preview');
    }

    /**
     * Returns the current selected theme.
     */
    function get_current_theme() {
        $theme = $this->options['theme'];
        if (empty($theme))
            return 'blank';
        else
            return $theme;
    }

    function get_current_theme_options() {
        $theme_options = $this->themes->get_options($this->get_current_theme());
        // main options merge
        $main_options = Newsletter::instance()->options;
        foreach ($main_options as $key => $value) {
            $theme_options['main_' . $key] = $value;
        }
        $info_options = Newsletter::instance()->get_options('info');
        foreach ($info_options as $key => $value) {
            $theme_options['main_' . $key] = $value;
        }
        return $theme_options;
    }

    /**
     * Returns the file path to a theme using the theme overriding rules.
     * @param type $theme
     * @param type $file
     */
    function get_theme_file_path($theme, $file) {
        return $this->themes->get_file_path($theme);
    }

    function get_current_theme_file_path($file) {
        return $this->themes->get_file_path($this->get_current_theme(), $file);
    }

    function get_current_theme_url() {
        return $this->themes->get_theme_url($this->get_current_theme());
    }

    /**
     * Returns true if the emails database still contain old 2.5 format emails.
     *
     * @return boolean
     */
    function has_old_emails() {
        return $this->store->get_count(NEWSLETTER_EMAILS_TABLE, "where type='email'") > 0;
    }

    function convert_old_emails() {
        global $newsletter;
        $list = $newsletter->get_emails('email', ARRAY_A);
        foreach ($list as &$email) {
            $email['type'] = 'message';
            $query = "select * from " . NEWSLETTER_USERS_TABLE . " where status='C'";

            if ($email['list'] != 0)
                $query .= " and list_" . $email['list'] . "=1";
            $email['preferences'] = $email['list'];

            if (!empty($email['sex'])) {
                $query .= " and sex='" . $email['sex'] . "'";
            }
            $email['query'] = $query;

            $newsletter->save_email($email);
        }
    }

    function build_block($dir) {
        $file = basename($dir);
        $block_id = sanitize_key($file);
        $full_file = $dir . '/block.php';
        if (!is_file($full_file)) {
            return new WP_Error('1', 'Missing block.php file in ' . $dir);
        }

        if (!is_file($dir . '/icon.png')) {
            $relative_dir = substr($dir, strlen(WP_CONTENT_DIR));
            $data['icon'] = content_url($relative_dir . '/icon.png');
        }

        $data = get_file_data($full_file, array('name' => 'Name', 'section' => 'Section', 'description' => 'Description', 'type' => 'Type'));
        $defaults = array('section' => 'content', 'name' => $file, 'descritpion' => '', 'icon' => NEWSLETTER_URL . '/images/block-icon.png', 'content' => '');
        $data = array_merge($defaults, $data);

        if (is_file($dir . '/icon.png')) {
            $relative_dir = substr($dir, strlen(WP_CONTENT_DIR));
            $data['icon'] = content_url($relative_dir . '/icon.png');
        }

        $data['id'] = $block_id;

        // Absolute path of the block files
        $data['dir'] = $dir;

        return $data;
    }

    function scan_blocks_dir($dir) {

        if (!is_dir($dir)) {
            return array();
        }

        $handle = opendir($dir);
        $list = array();
        $relative_dir = substr($dir, strlen(WP_CONTENT_DIR));
        while ($file = readdir($handle)) {

            if ($file == '.' || $file == '..')
                continue;

            $data = $this->build_block($dir . '/' . $file);

            if (is_wp_error($data)) {
                $this->logger->error($data);
                continue;
            }
            $list[$data['id']] = $data;
        }
        closedir($handle);
        return $list;
    }

    /**
     * Array of arrays with every registered block and legacy block converted to the new
     * format.
     *
     * @return array
     */
    function get_blocks() {

        static $blocks = null;

        if (!is_null($blocks))
            return $blocks;

        $blocks = $this->scan_blocks_dir(__DIR__ . '/blocks');

        $extended = $this->scan_blocks_dir(WP_CONTENT_DIR . '/extensions/newsletter/blocks');

        $blocks = array_merge($extended, $blocks);

        $dirs = apply_filters('newsletter_blocks_dir', array());

        foreach ($dirs as $dir) {
            $dir = str_replace('\\', '/', $dir);
            $list = $this->scan_blocks_dir($dir);
            $blocks = array_merge($list, $blocks);
        }

        do_action('newsletter_register_blocks');

        foreach (TNP_Composer::$block_dirs as $dir) {
            $block = $this->build_block($dir);
            if (is_wp_error($block)) {
                $this->logger->error($block);
                continue;
            }
            if (!isset($blocks[$block['id']])) {
                $blocks[$block['id']] = $block;
            } else {
                $this->logger->error('The block "' . $block['id'] . '" is already registered');
            }
        }

        $blocks = array_reverse($blocks);
        return $blocks;
    }

    /**
     * Return a single block (associative array) checking for legacy ID as well.
     *
     * @param string $id
     * @return array
     */
    function get_block($id) {
        switch ($id) {
            case 'content-03-text.block':
                $id = 'text';
                break;
            case 'footer-03-social.block':
                $id = 'social';
                break;
            case 'footer-02-canspam.block':
                $id = 'canspam';
                break;
            case 'content-05-image.block':
                $id = 'image';
                break;
            case 'header-01-header.block':
                $id = 'header';
                break;
            case 'footer-01-footer.block':
                $id = 'footer';
                break;
            case 'content-02-heading.block':
                $id = 'heading';
                break;
            case 'content-07-twocols.block':
            case 'content-06-posts.block':
                $id = 'posts';
                break;
            case 'content-04-cta.block': $id = 'cta';
                break;
            case 'content-01-hero.block': $id = 'hero';
                break;
//            case 'content-02-heading.block': $id = '/plugins/newsletter/emails/blocks/heading';
//                break;
        }

        // Conversion for old full path ID
        $id = sanitize_key(basename($id));

        // TODO: Correct id for compatibility
        $blocks = $this->get_blocks();
        if (!isset($blocks[$id])) {
            return null;
        }
        return $blocks[$id];
    }

    function scan_presets_dir($dir = null) {

        if (is_null($dir)) {
            $dir = __DIR__ . '/presets';
        }

        if (!is_dir($dir)) {
            return array();
        }

        $handle = opendir($dir);
        $list = array();
        $relative_dir = substr($dir, strlen(WP_CONTENT_DIR));
        while ($file = readdir($handle)) {

            if ($file == '.' || $file == '..')
                continue;

            // The block unique key, we should find out how to build it, maybe an hash of the (relative) dir?
            $preset_id = sanitize_key($file);

            $full_file = $dir . '/' . $file . '/preset.json';

            if (!is_file($full_file)) {
                continue;
            }

            $icon = content_url($relative_dir . '/' . $file . '/icon.png');

            $list[$preset_id] = $icon;
        }
        closedir($handle);
        return $list;
    }

    function get_preset($id, $dir = null) {

        if (is_null($dir)) {
            $dir = __DIR__ . '/presets';
        }

        $id = $this->sanitize_file_name($id);

        if (!is_dir($dir . '/' . $id) || !in_array($id, self::$PRESETS_LIST)) {
            return array();
        }

        $json_content = file_get_contents("$dir/$id/preset.json");
        $json_content = str_replace("{placeholder_base_url}", plugins_url('newsletter') . '/emails/presets', $json_content);
        $json = json_decode($json_content);
        $json->icon = NEWSLETTER_URL . "/emails/presets/$id/icon.png";

        return $json;
    }

    function get_composer_css() {
        $css = file_get_contents(__DIR__ . '/tnp-composer/css/newsletter.css');
        $dirs = apply_filters('newsletter_blocks_dir', array());
        array_push($dirs, __DIR__ . '/blocks');
        foreach ($dirs as $dir) {
            $dir = str_replace('\\', '/', $dir);
            $list = NewsletterEmails::instance()->scan_blocks_dir($dir);

            foreach ($list as $key => $data) {
                if (!file_exists($data['dir'] . '/style.css'))
                    continue;
                $css .= "\n\n";
                $css .= "/* " . $data['name'] . " */\n";
                $css .= file_get_contents($data['dir'] . '/style.css');
            }
        }
        return $css;
    }

    function send_test_email($email, $controls) {
        if (!$email) {
            $controls->errors = __('Newsletter should be saved before send a test', 'newsletter');
            return;
        }
        if ($email->subject == '') {
            $email->subject = 'Dummy subject, it was empty (remember to set it)';
        }
        $users = NewsletterUsers::instance()->get_test_users();
        if (count($users) == 0) {
            $controls->errors = '' . __('There are no test subscribers to send to', 'newsletter') .
                    '. <a href="https://www.thenewsletterplugin.com/plugins/newsletter/subscribers-module#test" target="_blank"><strong>' .
                    __('Read more', 'newsletter') . '</strong></a>.';
        } else {
            Newsletter::instance()->send($email, $users);
            $controls->messages = __('Test newsletter sent to:', 'newsletter');
            foreach ($users as $user) {
                $controls->messages .= ' ' . $user->email;
            }
            $controls->messages .= '.<br>';
            $controls->messages .= '<a href="https://www.thenewsletterplugin.com/documentation/subscribers#test" target="_blank"><strong>' .
                    __('Read more about test subscribers', 'newsletter') . '</strong></a>.<br>';
            $controls->messages .= '<a href="https://www.thenewsletterplugin.com/documentation/email-sending-issues" target="_blank"><strong>' . __('Read more about delivery issues', 'newsletter') . '</strong></a>.';
        }
    }

}

NewsletterEmails::instance();
