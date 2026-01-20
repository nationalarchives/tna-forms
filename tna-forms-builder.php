<?php
/**
 * Form builder
 */
class Form_Builder {

    /**
     * @param $id
     * @param $value
     * @param bool $no_validate
     * @return string
     */
    public function form_begins($id, $value, $no_validate = false ) {
	    $token = form_token();
		$form = '<form action=""  id="%s" class="form-abandonment" method="POST" ' . $this->novalidate_for_testing( $no_validate ) . '>';
		$form .= '<input type="hidden" name="tna-form" value="%s">';
		$form .= '<input type="hidden" name="token" value="' . $token . '">';
		$form .= '<input type="hidden" name="timestamp" value="' . time() . '">';

		return sprintf( $form, $id, $value );
	}

    /**
     * @param string $action
     * @param $id
     * @param $name
     * @return string
     */
    public function form_foi_begins($action, $id, $name ) {
        if (!isset($action)) {
            $action = '';
        }
		$form = '<form action="%s"  id="%s" class="form-abandonment" name="%s" method="POST">';

		return sprintf( $form, $action, $id, $name );
	}

    /**
     * @return string
     */
    public function form_ends() {
		$form = '</form>';

		return $form;
	}

    /**
     * @param $legend
     * @return string
     */
    public function fieldset_begins($legend ) {
		$form = '<fieldset><legend>%s</legend>';

		return sprintf( $form, $legend );
	}

    /**
     * @return string
     */
    public function fieldset_ends() {
		$form = '</fieldset>';

		return $form;
	}

    /**
     * @param $name
     * @param $value
     * @return string
     */
    public function form_hidden_input($name, $value ) {
		$form = '<input type="hidden" name="%s" value="%s">';
		return sprintf( $form, $name, $value );
	}

    /**
     * @param $label
     * @param $id
     * @param $name
     * @param string $error
     * @param string $hint
     * @param bool $disabled
     * @return string
     */
    public function form_text_input($label, $id, $name, $error = '', $hint = '', $readonly = false ) {

	    // Add -required to the input name
        $name = $error ? $name.'-required' : $name;

		// Add disable to the input
		$read = $readonly == true ? 'readonly' : '';

		$form = '<div class="form-row">';
		$form .= '<label for="';
		$form .= $id;
		$form .= '">%s';
		$form .= $this->is_optional( $error );
		$form .= '</label>';
		$form .= $this->hint_text( $hint );
		$form .= '<input type="text" id="%s" name="%s" ';
		$form .= $this->required_atts( $error );
		$form .= $this->set_value( $name );
		$form .= $this->set_get_value_input( $name );
		$form .= $this->input_error_class( $name, $error );
		$form .= $read;
		$form .= '>';
		$form .= $this->input_error_message( $name, $error );
		$form .= '</div>';

		return sprintf( $form, $label, $id, $name );
	}

    /**
     * @param $label
     * @param $id
     * @param $name
     * @param string $error
     * @param string $hint
     * @return string
     */
    public function form_textarea_input($label, $id, $name, $error = '', $hint = '' ) {

		if ( $error ) {
			$name = $name.'-required';
		}

		$form = '<div class="form-row">';
		$form .= '<label for="';
		$form .= $id;
		$form .= '">%s';
		$form .= $this->is_optional( $error );
		$form .= '</label>';
		$form .= $this->hint_text( $hint );
		$form .= '<textarea id="%s" name="%s" ';
		$form .= $this->required_atts( $error );
		$form .= $this->input_error_class( $name, $error );
		$form .= '>';
		$form .= $this->set_value( $name, 'textarea' );
		$form .= '</textarea>';
		$form .= $this->input_error_message( $name, $error );
		$form .= '</div>';

		return sprintf( $form, $label, $id, $name );
	}

    /**
     * @param $label
     * @param $id
     * @param $name
     * @param string $error
     * @param string $match
     * @return string
     */
    public function form_email_input($label, $id, $name, $error = '', $match = '' ) {

		if ( $error ) {
			$name = $name.'-required';
		}

		$form = '<div class="form-row">';
		$form .= '<label for="';
		$form .= $id;
		$form .= '">%s';
		$form .= $this->is_optional( $error );
		$form .= '</label>';
		$form .= '<input type="email" id="%s" name="%s" ';
		$form .= $this->required_atts( $error );
		$form .= $this->set_value( $name );
		$form .= $this->input_error_class( $name, $error, $match );
		$form .= '>';
		$form .= $this->input_error_message( $name, $error, $match );
		$form .= '</div>';

		return sprintf( $form, $label, $id, $name );
	}

    /**
     * @return string
     */
    public function form_email_required_input() {
		$form = '<div class="form-row">';
		$form .= '<label for="email">Email address';
		$form .= '</label>';
		$form .= '<input type="email" id="email" name="email-required" aria-required="true" required';
		$form .= $this->set_value( 'email-required' );
		$form .= $this->input_error_class( 'email-required', 'Please enter a valid email address', '' );
		$form .= '>';
		$form .= $this->input_error_message( 'email-required', 'Please enter a valid email address', '' );
		$form .= '</div>';
		$form .= '<div class="form-row">';
		$form .= '<label for="confirm_email">Please re-type your email address';
		$form .= '</label>';
		$form .= '<input type="email" id="confirm_email" name="confirm-email-required" aria-required="true" required';
		$form .= $this->set_value( 'confirm-email-required' );
		$form .= $this->input_error_class( 'confirm-email-required', 'Please enter your email address again', 'Email address' );
		$form .= '>';
		$form .= $this->input_error_message( 'confirm-email-required', 'Please enter your email address again', 'Email address' );
		$form .= '</div>';

		return $form;
	}

    /**
     * @param $label
     * @param $id
     * @param $name
     * @param string $error
     * @param string $hint
     * @return string
     */
    public function form_tel_input($label, $id, $name, $error = '', $hint = '' ) {

		if ( $error ) {
			$name = $name.'-required';
		}

		$form = '<div class="form-row">';
		$form .= '<label for="';
		$form .= $id;
		$form .= '">%s';
		$form .= $this->is_optional( $error );
		$form .= '</label>';
		$form .= $this->hint_text( $hint );
		$form .= '<input type="tel" id="%s" name="%s" ';
		$form .= $this->required_atts( $error );
		$form .= $this->set_value( $name );
		$form .= $this->input_error_class( $name, $error );
		$form .= '>';
		$form .= $this->input_error_message( $name, $error );
		$form .= '</div>';

		return sprintf( $form, $label, $id, $name );
	}

    /**
     * @param $label
     * @param $id
     * @param $name
     * @param string $error
     * @param string $hint
     * @return string
     */
    public function form_date_input($label, $id, $name, $error = '', $hint = '' ) {

		if ( $error ) {
			$name = $name.'-required';
		}

		$form = '<div class="form-row">';
		$form .= '<label for="';
		$form .= $id;
		$form .= '">%s';
		$form .= $this->is_optional( $error );
		$form .= '</label>';
		$form .= $this->hint_text( $hint );
		$form .= '<input type="date" id="%s" name="%s" ';
		$form .= $this->required_atts( $error );
		$form .= $this->set_value( $name );
		$form .= $this->input_error_class( $name, $error );
		$form .= '>';
		$form .= $this->input_error_message( $name, $error );
		$form .= '</div>';

		return sprintf( $form, $label, $id, $name );
	}

    /**
     * @param $label
     * @param $id
     * @param $name
     * @param string $error
     * @return string
     */
    public function form_checkbox_input($label, $id, $name, $error = '', $disabled = false ) {

        // Add -required to the input name
        $name = $error ? $name.'-required' : $name;

        // Add disable to the input
        $disable = $disabled == true ? 'disabled' : '';

		$form = '<div class="form-row checkbox">';
		$form .= '<input type="checkbox" id="%s" name="%s" value="Yes" ';
		$form .= $this->required_atts( $error );
		$form .= $this->set_value( $name, 'checkbox' );
        $form .= $this->set_get_value_checkbox( $name );
        $form .= $disable;
		$form .= '>';
		$form .= '<label for="';
		$form .= $id;
		$form .= '">%s';
		$form .= '</label>';
		$form .= $this->input_error_message( $name, $error );
		$form .= '</div>';

		return sprintf( $form, $id, $name, $label );
	}

    /**
     * @param string $title
     * @param $name
     * @param array $radios
     * @return string
     */
    public function form_radio_group($title, $name, $radios, $disabled = false) {
        if (!isset($title)) {
            $title = '';
        }
        if (!isset($radios)) {
            $radios = array();
        }
        if (!isset($disabled)) {
            $disabled = false;
        }
		$counter = 0;
		$form = '<div class="form-row">';
		if ( $title ) {
			$form .= '<p>' . $title . '</p>';
		}

        // Add disable to the input
        $disable = $disabled == true ? ' disabled' : '';

		foreach ( $radios as $radio ) {
			$id = strtolower( str_replace(' ', '_', $radio) );
            $checked = $counter == 0 && !isset( $_POST['tna-form'] ) ? 'checked' : '';

			$form .= '<div class="radio">';
			$form .= '<input type="radio" id="' . $id . '" name="' . $name . '" value="' . $radio . '" ' . $checked;
			$form .= $this->set_value( $name, 'radio', $radio );
            $form .= $disable;
			$form .= '>';
			$form .= '<label for="' . $id . '">';
			$form .= $radio;
			$form .= '</label></div>';
			$counter ++;
		}
		$form .= '</div>';

		return $form;
	}

    /**
     * @param $label
     * @param $id
     * @param $name
     * @param array $options
     * @param string $error
     * @param string $hint
     * @return string
     */
    public function form_select_input($label, $id, $name, $options = array(), $error = '', $hint = '' ) {

		if ( $error ) {
			$name = $name.'-required';
		}

		$form = '<div class="form-row">';
		$form .= '<label for="';
		$form .= $id;
		$form .= '">%s';
		$form .= $this->is_optional( $error );
		$form .= '</label>';
		$form .= $this->hint_text( $hint );
		$form .= '<select id="%s" name="%s" ';
		$form .= $this->required_atts( $error );
		$form .= $this->input_error_class( $name, $error );
		$form .= '>';
		$form .= '<option value="">Please select</option>';
		foreach ( $options as $option ) {
			$form .= '<option value="' . $option . '" ';
			$form .= $this->set_value( $name, 'select', $option );
			$form .= '>';
			$form .= $option;
			$form .= '</option>';
		}
		$form .= '</select>';
		$form .= $this->input_error_message( $name, $error );
		$form .= '</div>';

		return sprintf( $form, $label, $id, $name );
	}

    /**
     * @param $label
     * @param $id
     * @param $name
     * @param array $options
     * @param string $error
     * @param string $hint
     * @return string
     */
    public function form_select_input_training($label, $id, $name, $options = array(), $error = '', $hint = '' ) {

		if ( $error ) {
			$name = $name.'-required';
		}

		$form = '<div class="form-row">';
		$form .= '<label for="';
		$form .= $id;
		$form .= '">%s';
		$form .= $this->is_optional( $error );
		$form .= '</label>';
		$form .= $this->hint_text( $hint );
		$form .= '<select id="%s" name="%s" ';
		$form .= $this->required_atts( $error );
		$form .= $this->input_error_class( $name, $error );
		$form .= '>';
		$form .= '<option value="">Please select</option>';
		foreach ( $options as $option ) {
			if ( strpos($option, '(') !== false ) {
				$option = str_replace('(', '', $option);
				$form .= '<optgroup label="' . $option . '">';
			} elseif ( strpos($option, ')') !== false ) {
				$option = str_replace(')', '', $option);
				$form .= '<option value="' . $option . '" ';
				$form .= $this->set_value( $name, 'select', $option );
				$form .= '>';
				$form .= $option;
				$form .= '</option></optgroup>';
			} else {
				$form .= '<option value="' . $option . '" ';
				$form .= $this->set_value( $name, 'select', $option );
				$form .= '>';
				$form .= $option;
				$form .= '</option>';
			}
		}
		$form .= '</select>';
		$form .= $this->input_error_message( $name, $error );
		$form .= '</div>';

		return sprintf( $form, $label, $id, $name );
	}

    /**
     * @param $name
     * @param $id
     * @param string $value
     * @return string
     */
    public function submit_form($name, $id, $value = 'Submit' ) {
		$form = '<div class="form-row">';
		$form .= '<input type="submit" name="%s" id="%s" value="%s">';
		$form .= '</div>';

		return sprintf( $form, $name, $id, $value );
	}

    /**
     * @param $text
     * @return string
     */
    public function help_text($text ) {
		$form = '<div class="form-row">';
		$form .= '<p>%s</p>';
		$form .= '</div>';

		return sprintf( $form, $text );
	}

    /**
     * @param $error
     * @return string
     */
    public function required_atts($error ) {
		if ( $error ) {
			return ' aria-required="true" required ';
		}
		return '';
	}

    /**
     * @param $error
     * @return string
     */
    public function is_optional($error ) {
		if ( !$error ) {
			return ' <span class="optional">(optional)</span>';
		}
		return '';
	}

    /**
     * @param $hint
     * @return string
     */
    public function hint_text($hint ) {
		if ( $hint ) {
			return sprintf( '<p class="form-hint">%s</p>', $hint );
		}
		return '';
	}

    /**
     * @param $name
     * @param $error
     * @param string $match
     * @return string
     */
    public function input_error_message($name, $error, $match = '' ) {
		$error_wrapper = '<span id="%s-error" class="form-error form-hint">%s</span>';
		if ( $error && isset( $_POST['tna-form'] ) ) {
			if ( isset( $_POST[$name] ) && isset( $_POST[$match] ) ) {
				if ( trim( $_POST[$name] ) !== trim( $_POST[$match] ) ) {
					return sprintf( $error_wrapper, $name, $error );
				}
			}
			if ( isset( $_POST[$name] ) ) {
				if ( trim( $_POST[$name] ) === '' ) {
					return sprintf( $error_wrapper, $name, $error );
				}
			}
			if ( !isset( $_POST[$name] ) ) {
				return sprintf( $error_wrapper, $name, $error );
			}
		}
		return '';
	}

    /**
     * @param $name
     * @param $error
     * @param string $match
     * @return string
     */
    public function input_error_class($name, $error, $match = '' ) {
		if ( $error && isset( $_POST['tna-form'] ) ) {
			if ( isset( $_POST[$name] ) && isset( $_POST[$match] ) ) {
				if ( trim( $_POST[$name] ) !== trim( $_POST[$match] ) ) {
					return ' class="form-warning" aria-describedby="' . $name . '-error" ';
				}
			}
			if ( isset( $_POST[$name] ) ) {
				if ( trim( $_POST[$name] ) === '' ) {
					return ' class="form-warning" aria-describedby="' . $name . '-error" ';
				}
			}
			if ( !isset( $_POST[$name] ) ) {
				return ' class="form-warning" aria-describedby="' . $name . '-error" ';
			}
		}
		return '';
	}

    /**
     * @param $no_validate
     * @return string
     */
    public function novalidate_for_testing($no_validate ) {
		if ( $no_validate ) {
			return 'novalidate';
		}
		return '';
	}

    /**
     * @return string
     */
    public function form_newsletter_checkbox() {
		$form = '<div class="form-row checkbox">';
		$form .= '<input type="checkbox" id="newsletter" name="newsletter" value="Yes" ';
		$form .= set_value( 'newsletter', 'checkbox' );
		$form .= '>';
		$form .= '<label for="newsletter">';
		$form .= 'Tick here to receive regular email updates about our news, products and services';
		$form .= '</label>';
		$form .= '<p><small>';
		$form .= 'The National Archives only records personal information, including email addresses, for the purposes provided. We will not share your details with third parties. ';
		$form .= 'For more information read our <a href="http://www.nationalarchives.gov.uk/legal/privacy.htm" target="_blank">privacy policy</a>.';
		$form .= '</small></p></div>';

		return $form;
	}

    /**
     * @param $rand
     * @return string
     */
    public function form_spam_filter($rand ) {
		$form = '<div class="form-row hidden">';
		$form .= '<label for="skype_name">Skype name (please ignore this field)</label>';
		$form .= '<input type="text" id="skype_name" name="skype-name-' . $rand . '">';
		$form .= '</div>';

		return $form;
	}

    /**
     * @param $name
     * @param string $type
     * @param string $select_value
     * @return string
     */
    public function set_value($name, $type = 'text', $select_value = '' ) {
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

    /**
     * @param $name
     * @return string
     */
    public function set_get_value_input($name ) {
		return isset( $_GET[$name] )  ? ' value="' . htmlspecialchars( trim( $_GET[$name] ) ) . '" ' :  '';
	}

    /**
     * @param $name
     * @return string
     */
    public function set_get_value_checkbox($name ) {
        return (isset( $_GET[$name] ) && $_GET[$name] == true) ? ' checked="checked" ' : '';
    }
}
