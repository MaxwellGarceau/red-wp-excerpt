<?php

define( 'RED_WP_EXCERPT_PATH', get_stylesheet_directory() . '/inc/red-wp-excerpt' );
define( 'RED_WP_EXCERPT_URI', get_stylesheet_directory_uri() . '/inc/red-wp-excerpt' );

class Red_WP_Excerpt {

  public static function init() {
    add_action( 'wp_enqueue_scripts', array( get_called_class(), 'enqueue_scripts' ) );
  }

  public static function enqueue_scripts() {
    /* CSS */
    wp_enqueue_style( 'red-wp-excerpt', RED_WP_EXCERPT_URI . '/css/style.css', array(), filemtime( RED_WP_EXCERPT_PATH . '/css/style.css' ) );

    /* JavaScript */
    wp_enqueue_script( 'red-wp-excerpt', RED_WP_EXCERPT_URI . '/js/functions.js', array( 'jquery' ), filemtime( RED_WP_EXCERPT_PATH . '/js/functions.js' ) );
  }

  /**
   * Creates excerpt and read more link that displays the rest of the excerpt on click
   *
   * Source: https://stackoverflow.com/questions/22864632/modify-wp-trim-words-function-to-return-content-split-in-2#answer-58211099
   */
  public static function create_excerpt( $text ) {
    $word_length = 20;
    $read_more = '<a href="#" class="red-excerpt-read-more"> [...read more]</a>';
    $trimmed_text = wp_trim_words( $text, $word_length, '' ); // Set read more to empty string to avoid throwing off width calculations below

    // Measure full and trimmed widths for comparison
    $full_width = mb_strwidth( $text );
    $trimmed_width = mb_strwidth( $trimmed_text );

    $return = $trimmed_text;
    if ( $full_width != $trimmed_width ) {
      $clipped_text = mb_strimwidth( $text, $trimmed_width, $full_width - $trimmed_width, '' );

      /* Add clipped text inside overflow container to output */
      $return .= $read_more . '<div class="red-overflow-excerpt red-hidden">' . $clipped_text . '</div>';
    }

    return $return;
  }
}
