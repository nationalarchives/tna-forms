<?php

class Form_Processor {

    private $blocked_email_list = [
        "danjohnpen1982@icloud.com",
    ];

	/**
	 * @param $key
	 *
	 * @return mixed
	 */
	public function sanitize_value( $key ) {
		$value          = filter_input( INPUT_POST, $key, FILTER_SANITIZE_STRING );
		$value          = trim( $value );
		$newline        = '--NEWLINE--';
		$value          = str_replace( "\n", $newline, $value );
		$sanitize_value = str_replace( $newline, '<br />', $value );

		return $sanitize_value;
	}

	/**
	 * @param $data
	 *
	 * @return string
	 */
	public function display_data( $data ) {
		if ( is_array( $data ) ) {
			$display_data = '<div class="form-data"><ul>';
			foreach ( $data as $field_name => $field_value ) {
				if ( strpos( $field_name, 'skype-name' ) !== false ||
                    $field_name == 'confirm-email-required' ||
                    $field_name == 'confirm-email' ||
                    $field_name == 'g-recaptcha-response' ||
                    $field_name == 'tna-form' ||
                    $field_name == 'timestamp'
				) {

					// do nothing

				} else {

					$field_name = str_replace( '-required', '', $field_name );
					$field_name = ucfirst( str_replace( '-', ' ', $field_name ) );

					$display_data .= '<li>' . $field_name . ': ' . $field_value . '</li>';
				}
			}
			$display_data .= '</ul></div>';

			return $display_data;
		}
	}


    /**
     * @param $data
     * @param $ref_number
     * @return string
     */
    public function display_data_xml($data, $ref_number)
    {
        if (is_array($data)) {

        	if (!empty($data['date-of-birth-required'])){
	            $display_data = '<div style="background:#eee; border:1px solid #ccc; ">';
	            foreach ($data as $field_name => $field_value) {
	                if (strpos($field_name,
	                        'skype-name') !== false || $field_name == 'confirm-email-required' || $field_name == 'confirm-email'
	                ) {
	                    // do nothing
	                }
	            }
	            $display_data .= '&lt;enquiry_id&gt;' . $ref_number . '&lt;/enquiry_id&gt;<br>
           		    &lt;subject_forename&gt;' . $data['first-name'] . '&lt;/subject_forename&gt;<br>
	            	    &lt;subject_surname&gt;' . $data['last-name-required'] . '&lt;/subject_surname&gt;<br>
	                    &lt;other_forename&gt;' . $data['alternative-first-name'] . '&lt;/other_forename&gt;<br>
	                    &lt;other_surname&gt;' . $data['alternative-last-name'] . '&lt;/other_surname&gt;<br>
	                    &lt;birth_date&gt;' . $data['date-of-birth-required'] . '&lt;/birth_date&gt;<br>
	                    &lt;death_date&gt;' . $data['date_of_death'] . '&lt;/death_date&gt;<br>
	                    &lt;country_of_birth&gt;' . $data['country-of-birth'] . '&lt;/country_of_birth&gt;<br>
	                    &lt;contact_title&gt;' . $data['title-contact'] . '&lt;/contact_title&gt;<br>
	                    &lt;contact_first_name&gt;' . $data['first-name-contact'] . '&lt;/contact_first_name&gt;<br>
	                    &lt;contact_last_name&gt;' . $data['last-name-contact-required'] . '&lt;/contact_last_name&gt;<br>
	                    &lt;contact_email&gt;' . $data['email-required'] . '&lt;/contact_email&gt;<br>
	                    &lt;contact_address_1&gt;' . $data['address-street-1-required'] . '&lt;/contact_address_1&gt;<br>
	                    &lt;contact_address_2&gt;' . $data['address-street-2'] . '&lt;/contact_address_2&gt;<br>
	                    &lt;contact_address_town_city&gt;' . $data['address-town-city-required'] . '&lt;/contact_address_town_city&gt;<br>
	                    &lt;contact_address_county&gt;' . $data['address-county'] . '&lt;/contact_address_county&gt;<br>
	                    &lt;contact_address_country&gt;' . $data['address-country-required'] . '&lt;/contact_address_country&gt;<br>
	                    &lt;contact_address_postcode&gt;' . $data['address-postcode-required'] . '&lt;/contact_address_postcode&gt;';

	            $display_data .= '</div>';
	        } else {
	            $display_data .= '&lt;enquiry_id&gt;' . $ref_number . '&lt;/enquiry_id&gt;<br>
	            		&lt;title&gt;' . $data['title'] . '&lt;/title&gt;<br>
	            		&lt;first_name&gt;' . $data['first-name-required'] . '&lt;/first_name&gt;<br>
	            		&lt;last_name&gt;' . $data['last-name-required'] . '&lt;/last_name&gt;<br>
	                    &lt;contact_email&gt;' . $data['email-required'] . '&lt;/contact_email&gt;<br>
	                    &lt;enquiry&gt;' . $data['enquiry-required'] . '&lt;/enquiry&gt;';
	            if ($data['country-required']) {
	            	$display_data .= '<br>&lt;contact_country&gt;' . $data['country-required'] . '&lt;/contact_country&gt;';
	            }
	            if ($data['country']) {
	            	$display_data .= '<br>&lt;contact_country&gt;' . $data['country'] . '&lt;/contact_country&gt;';
	            }
	        }

            return $display_data;
        }
    }

	/**
	 * @param $data
	 *
	 * @return array
	 */
	public function get_data( $data ) {

        $form_data = array();

		foreach ( $data as $key => $value ) {
			if ( strpos( $key, 'submit' ) !== false ) {
				// do nothing
			} elseif ( $key == 'token' ) {
                $saved_token = get_transient( 'tna-token-'.$value );
                if ( !$saved_token ) {
                    $form_data['spam'] = true;
                } else {
                    delete_transient( 'tna-token-'.$value );
                }
            } elseif ( strpos( $key, 'skype-name' ) !== false && trim( $value ) !== '' ) {
				$form_data['spam'] = true;
			} else {
				if ( strpos( $key, 'required' ) !== false ) {
					if ( ( strpos( $key, 'email' ) !== false ) ) {
						if ( trim( $value ) === '' || is_email( $value ) == false ) {
							$form_data[ $key ] = false;
						} elseif ( $key == 'confirm-email-required' ) {
							if ( trim( $_POST['email-required'] ) !== trim( $_POST['confirm-email-required'] ) ) {
								$form_data[ $key ] = false;
							} else {
								$form_data[ $key ] = true;
							}
						} else {
							$sanitize_value    = $this->sanitize_value( $key );
							$form_data[ $key ] = $sanitize_value;
						}
					} else {
						if ( trim( $value ) === '' ) {
							$form_data[ $key ] = false;
						} else {
							$sanitize_value    = $this->sanitize_value( $key );
							$form_data[ $key ] = $sanitize_value;
						}
					}
				} elseif ( trim( $value ) !== '' ) {
					$sanitize_value    = $this->sanitize_value( $key );
					$form_data[ $key ] = $sanitize_value;
				} else {
					$form_data[ $key ] = '-';
				}
			}
		}

		return $form_data;
	}

	/**
	 * @param $form_name
	 * @param $form_data
	 * @param string $tna_recipient
	 * @param string $alt_recipient
	 */
	public function process_data( $form_name, $form_data, $tna_recipient = '', $alt_recipient = '', $send_xml_format = false ) {

		// Global variables
		global $tna_success_message,
		       $tna_error_message;

		// Reset global variables
		$tna_success_message = '';
		$tna_error_message   = '';

		if ( isset( $form_data['email-required'] ) ) {
			$user_email = $form_data['email-required'];
		} elseif ( isset( $form_data['email'] ) ) {
			$user_email = $form_data['email'];
		} else {
			$user_email = '';
		}

		$ip_status = $this->check_ip( get_client_ip(), $user_email, $form_data['tna-form'], $form_data['timestamp'] );

		if ( $ip_status == false ) {
            $form_data['spam'] = true;
        }

		// If any value inside the array is false then there is an error
		if ( isset( $form_data['spam'] ) ) {

			$client_ip   = get_client_ip();

			// Oops! Spam!
			$this->log_spam( 'yes', date_timestamp_get( date_create() ), $user_email, $client_ip );

		} elseif ( in_array( false, $form_data ) ) {

			// Oops! Error!
			$tna_error_message = $this->error_message();

		} else {

			// Yay! Success!

			global $post;
			$ref_number   = $this->ref_number( 'TNA', date_timestamp_get( date_create() ) );
			$form_content = $this->display_data( $form_data );

			// Confirmation message
			$tna_success_message = $this->message( $form_name, $form_content, $ref_number, $post->ID, 'success' );

			// Confirmation email to user
			$user_email_content = $this->message( $form_name, $form_content, $ref_number, $post->ID, 'user' );
			$this->send_email( $user_email, $form_name . ' - Ref:', $ref_number, $user_email_content );

			// Email to TNA
            if ($send_xml_format) {
                //$alt_email = $this->get_tna_email($alt_recipient); ---> Please keep for further reference

		        if ($form_name == 'Freedom of information enquiry'  || $form_name == 'Request a paid search' || $form_name == 'Letters of no evidence' || $form_name == 'Records and research enquiry') {
                   $form_content = $this->display_data_xml($form_data, $ref_number);
		        } else {
	                $form_content = $this->display_data($form_data) .
	                    $form_content = "<br>" .
	                        $form_content = "Cut and paste the XML appearing below this line into the 'Description' field in Infoservice." .
	                            $form_content = "<br>" .
	                                $form_content = "<br>" .
	                                    $form_content = $this->display_data_xml($form_data, $ref_number);
		        }
            } else {
                $alt_email = '';
            }

            $tna_email = $this->get_tna_email($tna_recipient);


            if ($form_name == 'Freedom of information enquiry' || $form_name == 'Request a paid search' || $form_name == 'Letters of no evidence' || $form_name == 'Records and research enquiry') {
            	$tna_email_content = $form_content;
            } else {
            	$tna_email_content = $this->message($form_name, $form_content, $ref_number, $post->ID);
			}

			if ($form_name == 'Freedom of information enquiry') {
					$tna_subject = '? FOI DIRECT ';
				} elseif($form_name == 'Request a paid search') {
					$tna_subject = '? FOI DIRECT PAID SEARCH';
				} elseif($form_name == 'Letters of no evidence') {
					$tna_subject = '? FOI DIRECTAA LONE';
				} elseif($form_name == 'Records and research enquiry') {
					$tna_subject = '? FOI DIRECT GENAA';
				} else {
				$tna_subject = $form_name . ' - Ref:';
			}

            if (! in_array($user_email, $this->blocked_email_list) {
                $this->send_email($tna_email, $tna_subject, $ref_number, $tna_email_content, $alt_email);
            }

			// Subscribe to newsletter
			if ( isset( $form_data['newsletter'] ) ) {
				 subscribe_to_newsletter_post( $form_data['newsletter'], $form_data['full-name'], $user_email, $form_name );
			}
		}
	}

	/**
	 * @param $prefix
	 * @param $time_stamp
	 *
	 * @return string
	 */
	public function ref_number( $prefix, $time_stamp ) {
		$letter = chr( rand( 65, 90 ) );
		$suffix = $letter . rand( 10, 99 );

		return $prefix . $time_stamp . $suffix;
	}

	/**
	 * @return string
	 */
	public function error_message() {
		$error_message = '<div class="emphasis-block error-message" role="alert">';
		$error_message .= '<h3>Sorry, there was a problem</h3>';
		$error_message .= '<p>Please check the highlighted fields and the reCAPTCHA checkbox to proceed.</p></div>';

		return $error_message;
	}

	/**
	 * @param $form_name
	 * @param $form_content
	 * @param $ref_number
	 * @param $id
	 * @param string $type
	 *
	 * @return string
	 */
	public function message( $form_name, $form_content, $ref_number, $id, $type = '' ) {
		if ( $type ) {
			$subject = 'Your reference number:';
		} else {
			$subject = 'Reference number:';
		}
		$content = success_message_header( $subject, $ref_number );
		if ( $type == 'user' ) {
			$content .= confirmation_email_content( $id );
		} elseif ( $type == 'success' ) {
			$content .= confirmation_content( $id );
		}
		if ( $type ) {
			$content .= '<h3>Summary of your enquiry</h3>';
		} else {
			$content .= '<h3>' . $form_name . '</h3>';
			$content .= '<h3>Summary of enquiry</h3>';
		}


		$content .= $form_content;

		return $content;
	}

	/**
	 * @param $email
	 * @param $subject
	 * @param $ref_number
	 * @param $content
	 * @param $alt_email
	 */
	public function send_email( $email, $subject, $ref_number, $content, $alt_email='' ) {
		if ( is_email( $email ) ) {

			// Email Subject

			if (strpos($subject, 'FOI DIRECT') === false) {
				$email_subject = $subject . ' ' . $ref_number;
			} else {
				$email_subject = $subject;
			}

			// Email message
			$email_message = $content;

			// Email header
			$email_headers = 'From: The National Archives (DO NOT REPLY) <no-reply@nationalarchives.gov.uk>';

			wp_mail( $email, $email_subject, $email_message, $email_headers );

			if ($alt_email) {
				wp_mail( $alt_email, $email_subject, $email_message, $email_headers );
			}
		}
	}

	/**
	 * @param string $user
	 *
	 * @return mixed
	 */
	public function get_tna_email( $user = '' ) {
		global $post;
		$meta_user = get_post_meta( $post->ID, 'cf_get_tna_email', true );
		if ( $user ) {
			$contact_user = get_user_by( 'login', $user );
			if ( $contact_user ) {
				$email = $contact_user->user_email;

				return $email;
			} else {
				$email = get_option( 'admin_email' );

				return $email;
			}
		} elseif ( $meta_user ) {
			$contact_user = get_user_by( 'login', $meta_user );
			if ( $contact_user ) {
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

	/**
	 * @param $spam
	 * @param $time
	 * @param $email
	 */
	public function log_spam( $spam, $time, $email, $ip ) {
		if ( $spam == 'yes' ) {
			$file = plugin_dir_path( __FILE__ ) . 'spam_log.txt';
			$log  = $ip . ' : ' . $time . ' - ' . $email . PHP_EOL;
			file_put_contents( $file, $log, FILE_APPEND );
		}
	}

    /**
     * @param $time
     * @param $email
     * @param $ip
     */
    public function log_ip($time, $email, $ip ) {
        $file = plugin_dir_path( __FILE__ ) . 'ip_log.txt';
        $log  = $ip . ' : ' . $time . ' - ' . $email . PHP_EOL;
        file_put_contents( $file, $log, FILE_APPEND );
    }

    /**
     * @param $client_ip
     * @param $user_email
     * @param $id
     * @param $time_stamp
     * @return bool
     */
    public function check_ip( $client_ip, $user_email, $id, $time_stamp ) {

        if (strpos($client_ip, ':') !== false) {
            $client_ip = current(explode(':', $client_ip));
        }

        if ( (time() - $time_stamp) < 3  ) {
            $this->log_ip( $time_stamp, $user_email, 'Too fast - '.$id.' - '.$client_ip );
            return false;
        }

        $tans_id = str_replace(' ', '_', $id ).'_ip_'.$client_ip;

        $stored_ip = get_transient($tans_id);

        if ( !$stored_ip ) {
            set_transient( $tans_id, 1, 20*MINUTE_IN_SECONDS );
        } else {
            $n = $stored_ip+1;
            set_transient( $tans_id, $n, 20*MINUTE_IN_SECONDS );

            if ( $stored_ip > 3 ) {
                $this->log_ip( $time_stamp, $user_email, $id.' - '.$client_ip );
                return false;
            }
        }
        return true;
    }
}
