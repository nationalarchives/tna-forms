<?php

/**
 * Form builder
 */
class Form_Builder {

	public function __construct() {

	}

	public function input_error_message( $name, $error ) {
		$error_wrapper = '<span class="form-error form-hint">%s</span>';
		if ( isset( $_POST[$name] ) && isset( $_POST['tna-form'] ) ) {
			if ( trim( $_POST[$name] ) === '' ) {
				return sprintf( $error_wrapper, $error );
			}
		}
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

	public function form_text_input( $label, $id, $name, $required = false, $error ) {
		if ( $required ) {
			$optional = '';
			$required_att = 'aria-required="true" required ';
		} else {
			$optional = ' <span class="optional">(optional)</span>';
			$required_att = '';
		}
		$form = '<div class="form-row">';
		$form .= '<label for="forename">%s';
		$form .= $optional;
		$form .= '</label>';
		$form .= '<input type="text" id="%s" name="%s" ';
		$form .= $required_att;
		$form .= set_value( $name );
		$form .= '>';
		$form .= $this->input_error_message( $name, $error );
		$form .= '</div>';

		return sprintf( $form, $label, $id, $name );
	}

	public function submit_form( $name, $id ) {
		$form = '<div class="form-row">';
		$form .= '<input type="submit" name="%s" id="%s" value="Submit" class="button">';
		$form .= '</div>';

		return sprintf( $form, $name, $id );
	}

}