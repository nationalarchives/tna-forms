<?php
/**
 * TNA forms functions
 */

function set_value( $name, $type = 'text', $select_value = '' ) {
	if ( isset( $_POST[$name] ) ) {
		switch( $type ) {
			case 'text': {
				return ' value="' . htmlspecialchars( trim( $_POST[$name] ) ) . '" ';
				break;
			}
			case 'textarea': {
				if ( trim( $_POST[$name] ) !== '' ) {
					return htmlspecialchars( $_POST[$name] );
				}
				return '';
				break;
			}
			case 'checkbox': {
				return ' checked="checked" ';
				break;
			}
			case 'radio': {
				if( $_POST[$name] == $select_value ){
					return ' checked="checked" ';
				}
				break;
			}
			case 'select': {
				if ( $_POST[$name] == $select_value ) {
					return ' selected="selected" ';
				}
				break;
			}
		}
	}
	return '';
}

function field_error_message( $input_name, $error_field_name, $type = 'required', $reconfirm_name = '' ) {
	global $tna_error_messages;
	$error_wrapper = '<span class="form-error form-hint">%s</span>';
	if ( isset( $_POST[$input_name] ) && isset( $_POST['tna-form'] ) ) {
		switch( $type ) {
			case 'required': {
				if ( trim( $_POST[$input_name] ) === '' ) {
					return sprintf( $error_wrapper, $tna_error_messages[$error_field_name] );
				}
				break;
			}
			case 'reconfirm': {
				if ( trim( $_POST[$input_name] ) !== trim( $_POST[$reconfirm_name] ) ) {
					return sprintf( $error_wrapper, $tna_error_messages[$error_field_name] );
				}
				break;
			}
		}
	} elseif ( !isset( $_POST[$input_name] ) && $type == 'radio' && isset( $_POST['tna-form'] ) ) {
		return sprintf( $error_wrapper, $tna_error_messages[$error_field_name] );
	}
}

function ref_number( $prefix, $time_stamp ) {
	$letter = chr(rand(65,90));
	$suffix = $letter . rand(10, 99);

	return $prefix . $time_stamp . $suffix;
}

function success_message_header( $content = '', $number ) {
	$wrapper = '<div class="reference-number emphasis-block success-message"><span>%s</span><h2>%s</h2></div>';

	return sprintf( $wrapper, $content, $number );
}

function print_page() {
	$print = '<input class="print_button" type="button" onClick="window.print()" value="Print this page"/>';

	return $print;
}

function display_compiled_form_data( $data ) {
	if ( is_array( $data ) ) {
		$display_data = '<div class="form-data"><ul>';
		foreach ( $data as $field_name => $field_value ) {
			if ( $field_name == 'Spam' || $field_name == 'Confirm email') {
				// do nothing
			} else {
				$display_data .= '<li>' . $field_name . ': ' . $field_value . '</li>';
			}
		}
		$display_data .= '</ul></div>';

		return $display_data;
	}
}

function display_error_message() {
	$error_message = '<div class="emphasis-block error-message" role="alert"><h3>Sorry, there was a problem</h3>';
	$error_message .= '<p>Please check the highlighted fields to proceed.</p></div>';

	return $error_message;
}

function confirmation_content( $id ) {

	$child = get_pages(
		array( 'child_of' => $id,
		       'parent' => $id,
		       'number' => '1',
		       'sort_column' => 'post_date',
		       'sort_order' => 'desc'
		));

	$content = '';
	if ( $child ) {
		foreach( $child as $page ) {
			$content .= apply_filters( 'the_content', $page->post_content );
		}
	}

	return $content;
}

function confirmation_email_content( $id ) {

	$content = get_post_meta($id, 'cf_receipt_email_content', true);

	return $content;
}

function send_form_via_email( $email, $subject, $ref_number, $content, $spam ) {
	if ( is_email( $email ) && $spam !== 'yes' ) {

		// Email Subject
		$email_subject = $subject . ' ' . $ref_number;

		// Email message
		$email_message = $content;

		// Email header
		$email_headers = 'From: The National Archives (DO NOT REPLY) <no-reply@nationalarchives.gov.uk>';

		wp_mail( $email, $email_subject, $email_message, $email_headers );
	}
}

function form_token() {
	$token = md5( uniqid( "", true ) );

	// Save token and keep for 6 hours
	set_transient( 'tna-token-'.$token, $token, 6*HOUR_IN_SECONDS );

	return $token;
}

function get_tna_email( $user = '' ) {
	global $post;
	$meta_user = get_post_meta($post->ID, 'cf_get_tna_email', true);
	if ( $user ) {
		$contact_user = get_user_by( 'login', $user );
		if( $contact_user ) {
			$email = $contact_user->user_email;
			return $email;
		} else {
			$email = get_option( 'admin_email' );
			return $email;
		}
	} elseif ( $meta_user ) {
		$contact_user = get_user_by( 'login', $meta_user );
		if( $contact_user ) {
			$email = $contact_user->user_email;
			return $email;
		} else {
			$email = get_option( 'admin_email' );
			return $email;
		}
	} else {
		$email = get_option( 'admin_email' );
		return $email;
	}
}

function subscribe_to_newsletter_post( $subscribe, $name, $email, $source ) {
	if ( $subscribe == 'Yes' ) {

		$parts = explode(' ', $name);
		$last_name = array_pop($parts);
		$first_name = implode(' ', $parts);

		// set POST variables
		$url = 'https://r1-t.trackedlink.net/signup.ashx';
		$fields = array(
			'cd_FIRSTNAME' => $first_name,
			'cd_LASTNAME' => $last_name,
			'Email' => $email,
			'addressbookid' => '636353',
			'userid' => '173459',
			'cd_SOURCE' => $source
		);

		$fields_string = '';

		// url-ify the data for the POST
		foreach($fields as $key=>$value) {
			$fields_string .= $key.'='.$value.'&';
		}
		rtrim($fields_string, '&');

		// open connection
		$ch = curl_init($url);

		// set proxy, timeout, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_PROXY, WP_PROXY_HOST . ':' . WP_PROXY_PORT);
		curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_POST, count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

		// execute post
		$result = curl_exec($ch);

		// close connection
		curl_close($ch);
	}
}

function log_spam( $spam, $time, $email ) {
	if ( $spam == 'yes' ) {
		$file = plugin_dir_path( __FILE__ ) . 'spam_log.txt';
		$log = $time . ' - ' . $email . PHP_EOL;
		file_put_contents( $file, $log, FILE_APPEND );
	}
}

function cf_receipt_email_markup( $post ) {
	$value = get_post_meta($post->ID, 'cf_receipt_email_content', true);
	$args = array(
		'media_buttons' => false,
		'textarea_rows' => 8,
		'tinymce'       => false,
		'quicktags'     => array( 'buttons' => 'strong,em,ul,ol,li,link' ),
		'wpautop'       => false
	);
	wp_nonce_field(basename(__FILE__), 'cf_receipt_email_nonce');
	?>
	<table class="form-table">
		<tbody>
		<tr>
			<th style="width:20%">
				<label for="cf_receipt_email_content">Content</label>
			</th>
			<td>
				<?php wp_editor( $value, 'cf_receipt_email_content', $args ); ?>
				<p>The text entered here will appear in between the reference number (at the top) and the form input summary (at the bottom).</p>
			</td>
		</tr>
		</tbody>
	</table>
	<?php
}

function cf_get_tna_email_markup( $post ) {
	$value = get_post_meta($post->ID, 'cf_get_tna_email', true);
	wp_nonce_field(basename(__FILE__), 'cf_get_tna_email_nonce');
	?>
	<div class="form-row">
		<label for="cf_get_tna_email">Username</label>
	</div>
	<div class="form-row">
		<input type="text" id="cf_get_tna_email" name="cf_get_tna_email" value="<?php echo $value; ?>">
	</div>
	<?php
}

function cf_meta_box_save( $post_id ) {
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_cf_receipt_email_nonce = ( isset( $_POST[ 'cf_receipt_email_nonce' ] ) && wp_verify_nonce( $_POST[ 'cf_receipt_email_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
	$is_valid_cf_get_tna_email_nonce = ( isset( $_POST[ 'cf_get_tna_email_nonce' ] ) && wp_verify_nonce( $_POST[ 'cf_get_tna_email_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
	if ( $is_autosave || $is_revision || !$is_valid_cf_receipt_email_nonce || !$is_valid_cf_get_tna_email_nonce ) {
		return;
	}
	$allowed = array(
		'a' => array(
			'href' => array(),
			'title' => array()
		),
		'br' => array(),
		'em' => array(),
		'strong' => array(),
		'p' => array(),
		'ul' => array(),
		'li' => array(),
		'ol' => array()
	);
	if( isset( $_POST[ 'cf_receipt_email_content' ] ) ) {
		update_post_meta( $post_id, 'cf_receipt_email_content', wp_kses( $_POST[ 'cf_receipt_email_content' ], $allowed ) );
	}
	if( isset( $_POST[ 'cf_get_tna_email' ] ) ) {
		update_post_meta( $post_id, 'cf_get_tna_email', esc_html( $_POST[ 'cf_get_tna_email' ] ) );
	}
}

function cf_add_contact_forms_meta_box() {
	add_meta_box('cf-receipt-email', 'Contact form user receipt email', 'cf_receipt_email_markup', 'page', 'normal', 'high', null);
	add_meta_box('cf-get-tna-email', 'Contact form TNA recipient', 'cf_get_tna_email_markup', 'page', 'side', 'low', null);
}

function get_client_ip() {
    //whether ip is from share internet
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from remote address
    else
    {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }
    return $ip_address;
}