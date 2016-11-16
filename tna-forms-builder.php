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

	public function form_text_input( $label, $id, $name, $required = false, $error = '', $hint = '', $match = '' ) {
		if ( $required == true ) {
			$optional = '';
			$required_att = 'aria-required="true" required ';
		} else {
			$optional = ' <span class="optional">(optional)</span>';
			$required_att = '';
		}
		if ( $hint ) {
			$hint_text = sprintf( '<p class="form-hint">%s</p>', $hint );
		} else {
			$hint_text = '';
		}
		$form = '<div class="form-row">';
		$form .= '<label for="';
		$form .= $id;
		$form .= '">%s';
		$form .= $optional;
		$form .= '</label>';
		$form .= $hint_text;
		$form .= '<input type="text" id="%s" name="%s" ';
		$form .= $required_att;
		$form .= set_value( $name );
		$form .= '>';
		$form .= input_error_message( $name, $error, $match );
		$form .= '</div>';

		return sprintf( $form, $label, $id, $name );
	}

	public function form_textarea_input( $label, $id, $name, $required = false, $error = '', $hint = '' ) {
		if ( $required ) {
			$optional = '';
			$required_att = 'aria-required="true" required ';
		} else {
			$optional = ' <span class="optional">(optional)</span>';
			$required_att = '';
		}
		if ( $hint ) {
			$hint_text = sprintf( '<p class="form-hint">%s</p>', $hint );
		} else {
			$hint_text = '';
		}
		$form = '<div class="form-row">';
		$form .= '<label for="';
		$form .= $id;
		$form .= '">%s';
		$form .= $optional;
		$form .= '</label>';
		$form .= $hint_text;
		$form .= '<textarea id="%s" name="%s" ';
		$form .= $required_att;
		$form .= '>';
		$form .= set_value( $name, 'textarea' );
		$form .= '</textarea>';
		$form .= input_error_message( $name, $error );
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