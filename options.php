<?php
add_action( 'admin_menu', 'tweet_phrase_add_admin_menu' );
add_action( 'admin_init', 'tweet_phrase_settings_init' );

function tweet_phrase_add_admin_menu(  ) { 

	add_options_page(
		'Tweet phrase', 
		'Tweet phrase', 
		'manage_options', 
		'tweet_phrase', 
		'tweet_phrase_options_page'
	);

}


function tweet_phrase_settings_init(  ) { 

	register_setting( 'pluginPage', 'tweet_phrase_settings' );

	add_settings_section(
		'tweet_phrase_pluginPage_section', 
		__( 'Welcome!', 'tweet_phrase' ), 
		'tweet_phrase_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'tweet_phrase_text_before', 
		__( 'Text before', 'tweet_phrase' ), 
		'tweet_phrase_text_before_render', 
		'pluginPage', 
		'tweet_phrase_pluginPage_section' 
	);

	add_settings_field( 
		'tweet_phrase_text_after', 
		__( 'Text after', 'tweet_phrase' ), 
		'tweet_phrase_text_after_render', 
		'pluginPage', 
		'tweet_phrase_pluginPage_section' 
	);

	add_settings_field( 
		'tweet_phrase_text_username', 
		__( 'Your Twitter username', 'tweet_phrase' ), 
		'tweet_phrase_text_username_render', 
		'pluginPage', 
		'tweet_phrase_pluginPage_section' 
	);

	add_settings_field( 
		'tweet_phrase_checkbox_getlink', 
		__( 'Include permalink?', 'tweet_phrase' ), 
		'tweet_phrase_checkbox_getlink_render', 
		'pluginPage', 
		'tweet_phrase_pluginPage_section' 
	);

	/* add_settings_field( 
		'tweet_phrase_checkbox_cut', 
		__( 'Cut the phrase?', 'tweet_phrase' ), 
		'tweet_phrase_checkbox_cut_render', 
		'pluginPage', 
		'tweet_phrase_pluginPage_section' 
	); */


}


function tweet_phrase_text_before_render(  ) { 

	$options = get_option( 'tweet_phrase_settings' );
	?>
	<input class="regular-text" type="text" name="tweet_phrase_settings[tweet_phrase_text_before]" value="<?php echo $options['tweet_phrase_text_before']; ?>">
	<p class="description"><?php _e('Add some text or symbols before the phrase to post on Twitter.') ?></p>
	<?php

}


function tweet_phrase_text_after_render(  ) { 

	$options = get_option( 'tweet_phrase_settings' );
		
	?>
	<input class="regular-text" type="text" name="tweet_phrase_settings[tweet_phrase_text_after]" value="<?php echo $options['tweet_phrase_text_after']; ?>">
	<p class="description"><?php _e('Add some text or symbols after the phrase to post on Twitter.') ?></p>
	<?php

}


function tweet_phrase_text_username_render(  ) { 

	$options = get_option( 'tweet_phrase_settings' );
	?>
	<input class="regular-text" type="text" name="tweet_phrase_settings[tweet_phrase_text_username]" value="<?php echo $options['tweet_phrase_text_username']; ?>">
	<p class="description"><?php _e('Your twitter username. If is set "via @[username]" will be added to the phrase.') ?></p>
	<?php

}


function tweet_phrase_checkbox_getlink_render(  ) { 

	$options = get_option( 'tweet_phrase_settings' );
	?>
	<input type="checkbox" name="tweet_phrase_settings[tweet_phrase_checkbox_getlink]" <?php checked( 1 == $options['tweet_phrase_checkbox_getlink'] ); ?> value="1">
	<p class="description"><?php _e('Include the permalink to the page where the phrase is.') ?></p>
	<?php

}


/* function tweet_phrase_checkbox_cut_render(  ) { 

	$options = get_option( 'tweet_phrase_settings' );
	?>
	<input type="checkbox" name="tweet_phrase_settings[tweet_phrase_checkbox_cut]" <?php checked( 1 == $options['tweet_phrase_checkbox_cut'] ); ?> value="1">
	<?php

} */


function tweet_phrase_settings_section_callback(  ) { 

	echo __( 'This section description', 'tweet_phrase' );

}


function tweet_phrase_options_page(  ) { 

	?>
	<form action='options.php' method='post'>
		
		<h2>Tweet phrase</h2>
		
		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>
		
	</form>
	<?php

}

?>