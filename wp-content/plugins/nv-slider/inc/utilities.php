<?php

// filter row-actions
add_filter( 'post_row_actions', 'remove_row_actions', 10, 1 );

// filter default messages
add_filter( 'post_updated_messages', 'updated_messages' );
add_filter( 'enter_title_here', 'post_type_title' );

/**
 * @desc	Update row actions
 */
function remove_row_actions( $actions )
{
    if( get_post_type() === 'titan-track' ) {
        unset( $actions['view'] );
        unset( $actions['inline hide-if-no-js'] );
        unset( $actions['edit'] );
        unset( $actions['trash'] );
	}
	
    return $actions;
}

/**
 * @desc	Update wordpress default messages
 */
function updated_messages( $msg ){
	global $post, $post_ID;
	
	$text_domain = PLUGIN_DOMAIN;
	
	$msg['titan-track'] = array(
		0 => '', //unused. Messages start at index 1.
		1 => __('Titan Tracks updated.', $text_domain),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Titan Tracks updated.'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Titan Tracks data restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('New titan tracks created.'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Titan Tracks saved.'),
		8 => __('Titan Tracks submitted.', $text_domain),
		9 => sprintf( __('Product Page scheduled for: <strong>%1$s</strong>.', $text_domain),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ) ),
		10 => __('Titan Tracks draft updated.', $text_domain )
	);
	
	return $msg;
}

function post_type_title( $title ){
	if( 'titan-track' == get_post_type() ){
		return 'Enter titan tracks title here';
	} else {
		return $title;
	}
}
?>