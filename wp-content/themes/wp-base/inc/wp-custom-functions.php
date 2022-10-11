<?php
/**
 * Simple function for set the 'alt' in all images if not set on the wp dashboard
 *
 * @param $alt_source
 * @return string
 */
function set_alt_img ($alt_source): string
{
    if ($alt_source) {
        $alt = $alt_source;
    } else {
        $alt = "Shiru Image";
    }
    return $alt;
}

/**
 * Simple function for set the 'target' in anchor if not set open in new window
 *
 * @param $target_source
 * @return string
 */
function set_target_a ($target_source): string
{
    if ($target_source) {
        $target = $target_source .'"' . 'rel="noopener noreferrer';
    } else {
        $target = "_self";
    }
    return $target;
}

/**
 * Simple function for set the image with responsive options, change image between mobile, tablet, desktop.
 * The function check if set all images, put null if you don't want to change the image or isn't necessary.
 * Also set the alt, you can call the function "set_alt_img()" for check the 'alt'.
 *
 * @param $default
 * @param $mobile
 * @param $tablet
 * @param $alt
 * @return string
 */
function set_responsive_img ($default, $mobile, $tablet, $alt): string
{
    $template = "<picture>";
    if (!empty($mobile)) {
        $template .= "<source media='(max-width: 767px)' srcset='$mobile'>";
    }
    if (!empty($tablet)) {
        $template .= "<source media='(max-width: 1200px)' srcset='$tablet'>";
    }
    $template .= "<img class='sh-general-responsive-img' src='$default' alt='$alt'/>";
    $template .= "</picture>";

    return $template;
}


/**
 * Simple function for set the background image with responsive options, change image between mobile, tablet, desktop.
 * The function check if set all images, put null if you don't want to change the image or isn't necessary.
 *
 *
 * @param $class_section
 * @param $default
 * @param $mobile
 * @param $tablet
 * @return string
 */
function set_responsive_bk_img ($class_section, $default, $mobile, $tablet): string
{

    $template = '<style>';
    $template .= ".$class_section { background-image: url( $default )}";

    if (!empty($tablet)) {
        $template .= "@media only screen and (max-width: 1200px) { .$class_section { background-image: url( $tablet ); } }";
    }

    if (!empty($mobile)) {
        $template .= "@media only screen and (max-width: 767px) { .$class_section { background-image: url( $mobile ); } }";
    }

    $template .= "</style>";

    return $template;
}

/**
 * Simple function to delete HTML tags and limit string
 *
 * @param string  $string Text to limit
 * @param int     $limit Number of characters to show
 * @return string The truncated string
 */
function limit_string (string $string, int $limit): string
{
    $remove_html_tags = strip_tags($string);

    return mb_strimwidth($remove_html_tags, 0, $limit, '...');
}

/**
 * Simple function set the thumbnail or default image for blog post
 *
 * @param int $ID ID for post
 * @return string The image url
 */

// function thumbnail_default (int $ID): string
// {
//     $default_img = get_field('default_placeholder_image', 'option');

//     if ( get_the_post_thumbnail_url($ID) ) {
//         return get_the_post_thumbnail_url($ID);
//     } else {
//         return $default_img ? $default_img : "Don't set default photo in settings";
//     }
// }

/**
 * Estimated reading time in minutes
 *
 * @param string $content
 * @param int $words_per_minute
 * @param bool $with_gutenberg
 *
 * @return int estimated time in minutes
 */

function estimate_reading_time_in_minutes (string $content = '', int $words_per_minute = 300, bool $with_gutenberg = false ): int
{
    // In case if content is build with gutenberg parse blocks
    if ( $with_gutenberg ) {
        $blocks = parse_blocks( $content );
        $contentHtml = '';

        foreach ( $blocks as $block ) {
            $contentHtml .= render_block( $block );
        }

        $content = $contentHtml;
    }

    // Remove HTML tags from string
    $content = wp_strip_all_tags( $content );

    // When content is empty return 0
    if ( !$content ) {
        return 0;
    }

    // Count words containing string
    $words_count = str_word_count( $content );

    // Update ACF field and Calculate time for read all words and round

    return ceil( $words_count / $words_per_minute );
}

// Async load
function sh_custom_async_scripts($url)
{
    if ( strpos( $url, '#asyncload') === false )
        return $url;
    else if ( is_admin() )
        return str_replace( '#asyncload', '', $url );
    else
    return str_replace( '#asyncload', '', $url )."' async='async"; 
    }
add_filter( 'clean_url', 'sh_custom_async_scripts', 11, 1 );

/**
 * Esta función agrega los parámetros "async" y "defer" a recursos de Javascript.
 * Solo se debe agregar "async" o "defer" en cualquier parte del nombre del 
 * recurso (atributo "handle" de la función wp_register_script).
 *
 * @param $tag
 * @param $handle
 *
 * @return mixed
 */
function mg_add_async_defer_attributes( $tag, $handle ) {
	// Busco el valor "async"
	if( strpos( $handle, "async" ) ):
		$tag = str_replace(' src', ' async="async" src', $tag);
	endif;
	// Busco el valor "defer"
	if( strpos( $handle, "defer" ) ):
        var_dump($handle);
		$tag = str_replace(' src', ' defer="defer" src', $tag);
	endif;

    if( strpos( $handle, "preload" ) ):
		$tag = str_replace("rel='stylesheet'", "rel='preload' as='style' ", $tag);
	endif;
	return $tag;
}
add_filter('script_loader_tag', 'mg_add_async_defer_attributes', 10, 2);
