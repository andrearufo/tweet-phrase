<?php

/*
	
	Plugin Name: Tweet Phrase
	Plugin URI:  http://www.orangedropdesign.com
	Description: A simple Wordpress plugin for tweet a single phrase with a click!
	Version:     0.2
	Author:      Andrea Rufo
	Author URI:  http://www.orangedropdesign.com
	License:     GPL2
	License URI: https://www.gnu.org/licenses/gpl-2.0.html
	Domain Path: /languages
	Text Domain: tweet_phrase
	
*/

// security
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// initialize
function tweet_phrase_shortcode( $atts, $content = "" ) {
	
	$options = get_option( 'tweet_phrase_settings' );
	
	$text_parts = array();
	
	if( isset($options['tweet_phrase_text_before']) )
		$text_parts[] = trim($options['tweet_phrase_text_before']);
	
	$text_parts[] = trim($content); // space? %20
	
	if( $options['tweet_phrase_text_after'] )
		$text_parts[] = trim($options['tweet_phrase_text_after']);
	
	if( $options['tweet_phrase_checkbox_getlink'] )
		$text_parts[] = get_the_permalink();
	
	if( isset($options['tweet_phrase_text_username']) )
		$text_parts[] = 'via @' . trim($options['tweet_phrase_text_username']);
	
	$text = join(' ', $text_parts);
	
	return '<a title="Click and share on your Twitter!" target="_blank" href="https://twitter.com/intent/tweet?text=' . htmlspecialchars($text) . '" class="tweet-phrase">' . $content . ' <i class="fa fa-twitter"></i></a>';

}

function tweet_phrase_register_shortcode() {
	add_shortcode( 'tweet', 'tweet_phrase_shortcode' );
}

add_action( 'init', 'tweet_phrase_register_shortcode' );

// multilingual
load_plugin_textdomain( 'tweet_phrase', false, basename( dirname( __FILE__ ) ) . '/languages' );

// style
function tweet_phrase_styles_method() {
	
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'tweet-phrase', $plugin_url . 'tweet-phrase.css' );
    wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );
    
}
add_action( 'wp_enqueue_scripts', 'tweet_phrase_styles_method' );

// create custom plugin settings menu
include dirname( __FILE__ ) . '/options.php';
