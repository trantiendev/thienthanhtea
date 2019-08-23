<?php

defined('ABSPATH') || exit;

function tnp_post_thumbnail_src($post, $size = 'thumbnail', $alternative = '') {
    if (is_object($post)) {
        $post = $post->ID;
    }

    // Find a media id to be used as featured image
    $media_id = get_post_thumbnail_id($post);
    if (empty($media_id)) {
        $attachments = get_children(array('numberpost' => 1, 'post_parent' => $post, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order'));
        if (!empty($attachments)) {
            foreach ($attachments as $id => &$attachment) {
                $media_id = $id;
                break;
            }
        }
    }

    if (!$media_id) {
        return $alternative;
    }

    if (!defined('NEWSLETTER_MEDIA_RESIZE') || NEWSLETTER_MEDIA_RESIZE) {
        if (is_array($size)) {
            $src = tnp_media_resize($media_id, $size);
            if (is_wp_error($src)) {
                Newsletter::instance()->logger->error($src);
                return $alternative;
            } else {
                return $src;
            }
        }
    }

    $media = wp_get_attachment_image_src($media_id, $size);
    if (strpos($media[0], 'http') !== 0) {
        $media[0] = 'http:' . $media[0];
    }
    return $media[0];
}

function tnp_post_excerpt($post, $length = 30) {
    if (empty($post->post_excerpt)) {
        $excerpt = wp_strip_all_tags(strip_shortcodes($post->post_content));
        $excerpt = wp_trim_words($excerpt, $length);
    } else {
        $excerpt = wp_trim_words($post->post_excerpt, $length);
    }
    
    $excerpt = preg_replace("/\[vc_row.*?\]/", "", $excerpt);
    return $excerpt;
}

function tnp_post_permalink($post) {
    return get_permalink($post->ID);
}

function tnp_post_content($post) {
    return $post->post_content;
}

function tnp_post_title($post) {
    return $post->post_title;
}

function tnp_post_date($post, $format = null) {
    if (empty($format)) {
        $format = get_option('date_format');
    }
    return mysql2date($format, $post->post_date);
}

/**
 * Tries to create a resized version of a media uploaded to the media library. 
 * Returns an empty string if the media does not exists or generally if the attached file
 * cannot be found. If the resize fails for whatever reason, fall backs to the
 * standard image source returned by WP which is usually not exactly the 
 * requested size.
 * 
 * @param int $media_id
 * @param array $size
 * @return string
 */
function tnp_media_resize($media_id, $size) {
    if (empty($media_id))
        return '';
    $relative_file = get_post_meta($media_id, '_wp_attached_file', true);
    if (empty($relative_file))
        return '';

    $width = $size[0];
    $height = $size[1];
    $crop = false;
    if (isset($size[2])) {
        $crop = (boolean) $size[2];
    }

    $uploads = wp_upload_dir();
    $absolute_file = $uploads['basedir'] . '/' . $relative_file;
    // Relative and absolute name of the thumbnail.
    $pathinfo = pathinfo($relative_file);
    $relative_thumb = $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '-' . $width . 'x' .
            $height . ($crop ? '-c' : '') . '.' . $pathinfo['extension'];
    $absolute_thumb = $uploads['basedir'] . '/newsletter/thumbnails/' . $relative_thumb;

    // Thumbnail generation if needed.
    if (!file_exists($absolute_thumb) || filemtime($absolute_thumb) < filemtime($absolute_file)) {
        $r = wp_mkdir_p($uploads['basedir'] . '/newsletter/thumbnails/' . $pathinfo['dirname']);

        if (!$r) {
            $src = wp_get_attachment_image_src($media_id, $size);
            return $src[0];
        }

        $editor = wp_get_image_editor($absolute_file);
        if (is_wp_error($editor)) {
            $src = wp_get_attachment_image_src($media_id, $size);
            return $src[0];
            //return $editor;
            //return $uploads['baseurl'] . '/' . $relative_file;
        }

        $editor->set_quality(80);
        $resized = $editor->resize($width, $height, $crop);

        if (is_wp_error($resized)) {
            $src = wp_get_attachment_image_src($media_id, $size);
            return $src[0];
        }

        $saved = $editor->save($absolute_thumb);
        if (is_wp_error($saved)) {
            $src = wp_get_attachment_image_src($media_id, $size);
            return $src[0];
            //return $saved;
            //return $uploads['baseurl'] . '/' . $relative_file;
        }
    }



    return $uploads['baseurl'] . '/newsletter/thumbnails/' . $relative_thumb;
}
