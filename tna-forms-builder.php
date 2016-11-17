<?php
/**
 * Form builder
 */
class Form_Builder {

	public function __construct() {

	}

	public function form_begins( $id, $value ) {
		$form = '<form action=""  id="%s" method="POST" novalidate>';
		$form .= '<input type="hidden" name="tna-form" value="%s">';
		$form .= '<input type="hidden" name="token" value="' . form_token() . '">';

		return sprintf( $form, $id, $value );
	}

	public function form_ends() {
		$form = '</form>';

		return $form;
	}

	public function fieldset_begins( $legend ) {
		$form = '<fieldset><legend>%s</legend>';

		return sprintf( $form, $legend );
	}

	public function fieldset_ends() {
		$form = '</fieldset>';

		return $form;
	}

	public function form_text_input( $label, $id, $name, $error = '', $hint = '' ) {
		$form = '<div class="form-row">';
		$form .= '<label for="';
		$form .= $id;
		$form .= '">%s';
		$form .= $this->is_optional( $error );
		$form .= '</label>';
		$form .= $this->hint_text( $hint );
		$form .= '<input type="text" id="%s" name="%s" ';
		$form .= $this->required_atts( $error );
		$form .= set_value( $name );
		$form .= '>';
		$form .= $this->input_error_message( $name, $error );
		$form .= '</div>';

		return sprintf( $form, $label, $id, $name );
	}

	public function form_textarea_input( $label, $id, $name, $error = '', $hint = '' ) {
		$form = '<div class="form-row">';
		$form .= '<label for="';
		$form .= $id;
		$form .= '">%s';
		$form .= $this->is_optional( $error );
		$form .= '</label>';
		$form .= $this->hint_text( $hint );
		$form .= '<textarea id="%s" name="%s" ';
		$form .= $this->required_atts( $error );
		$form .= '>';
		$form .= set_value( $name, 'textarea' );
		$form .= '</textarea>';
		$form .= $this->input_error_message( $name, $error );
		$form .= '</div>';

		return sprintf( $form, $label, $id, $name );
	}

	public function form_email_input( $label, $id, $name, $error = '', $match = '' ) {
		$form = '<div class="form-row">';
		$form .= '<label for="';
		$form .= $id;
		$form .= '">%s';
		$form .= $this->is_optional( $error );
		$form .= '</label>';
		$form .= '<input type="email" id="%s" name="%s" ';
		$form .= $this->required_atts( $error );
		$form .= set_value( $name );
		$form .= '>';
		$form .= $this->input_error_message( $name, $error, $match );
		$form .= '</div>';

		return sprintf( $form, $label, $id, $name );
	}

	public function form_checkbox_input( $label, $id, $name, $error = '' ) {
		$form = '<div class="form-row checkbox">';
		$form .= '<input type="checkbox" id="%s" name="%s" value="Yes" ';
		$form .= $this->required_atts( $error );
		$form .= set_value( $name, 'checkbox' );
		$form .= '>';
		$form .= '<label for="';
		$form .= $id;
		$form .= '">%s';
		$form .= '</label>';
		$form .= $this->input_error_message( $name, $error );
		$form .= '</div>';

		return sprintf( $form, $id, $name, $label );
	}

	public function submit_form( $name, $id ) {
		$form = '<div class="form-row">';
		$form .= '<input type="submit" name="%s" id="%s" value="Submit" class="button">';
		$form .= '</div>';

		return sprintf( $form, $name, $id );
	}

	public function help_text( $text ) {
		$form = '<div class="form-row">';
		$form .= '<p>%s</p>';
		$form .= '</div>';

		return sprintf( $form, $text );
	}

	public function required_atts( $error ) {
		if ( $error ) {
			return ' aria-required="true" required ';
		}
		return '';
	}

	public function is_optional( $error ) {
		if ( !$error ) {
			return ' <span class="optional">(optional)</span>';
		}
		return '';
	}

	public function hint_text( $hint ) {
		if ( $hint ) {
			return sprintf( '<p class="form-hint">%s</p>', $hint );
		}
		return '';
	}

	public function input_error_message( $name, $error, $match = '' ) {
		$error_wrapper = '<span class="form-error form-hint">%s</span>';
		if ( $error && isset( $_POST['tna-form'] ) ) {
			if ( isset( $_POST[$name] ) && isset( $_POST[$match] ) ) {
				if ( trim( $_POST[$name] ) !== trim( $_POST[$match] ) ) {
					return sprintf( $error_wrapper, $error );
				}
			}
			if ( isset( $_POST[$name] ) ) {
				if ( trim( $_POST[$name] ) === '' ) {
					return sprintf( $error_wrapper, $error );
				}
			}
			if ( !isset( $_POST[$name] ) ) {
				return sprintf( $error_wrapper, $error );
			}
		}
		return '';
	}

}