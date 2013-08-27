<?php namespace AdamWathan\BootForms;

use Illuminate\Html\FormBuilder;

class BootFormBuilder extends FormBuilder {

	public function textGroup($label, $name, $value = null, $groupOptions = array(), $textOptions = array(), $labelOptions = array())
	{
		$groupOptions = $this->addClass('form-group', $groupOptions);

		$groupOptions = $this->addValidationState($name, $groupOptions);

		return '<div' . $this->html->attributes($groupOptions) . '>' . $this->label($name, $label, $labelOptions) . $this->text($name, $value, $textOptions) . '</div>';
	}


	public function emailGroup($label, $name, $value = null, $groupOptions = array(), $emailOptions = array(), $labelOptions = array())
	{
		$groupOptions = $this->addClass('form-group', $groupOptions);

		$groupOptions = $this->addValidationState($name, $groupOptions);

		return '<div' . $this->html->attributes($groupOptions) . '>' . $this->label($name, $label, $labelOptions) . $this->email($name, $value, $emailOptions) . '</div>';
	}


	public function passwordGroup($label, $name, $groupOptions = array(), $textOptions = array(), $labelOptions = array())
	{
		$groupOptions = $this->addClass('form-group', $groupOptions);

		$groupOptions = $this->addValidationState($name, $groupOptions);

		return '<div' . $this->html->attributes($groupOptions) . '>' . $this->label($name, $label, $labelOptions) . $this->password($name, $textOptions) . '</div>';
	}

	protected function addValidationState($name, $options)
	{
		if (! $this->session->has('errors')) {
			return $options;
		}
		
		$errors = $this->session->get('errors');

		if ($errors->has($name)) {
			$options = $this->addClass('has-error', $options);
		}

		return $options;
	}

	public function label($name, $value = null, $options = array())
	{
		$options = $this->addClass('control-label', $options);

		return parent::label($name, $value, $options);
	}

	
	public function text($name, $value = null, $options = array())
	{
		$options = $this->addClass('form-control', $options);
		
		return parent::text($name, $value, $options);
	}


	public function email($name, $value = null, $options = array())
	{
		$options = $this->addClass('form-control', $options);
		
		return parent::email($name, $value, $options);
	}


	public function password($name, $options = array())
	{
		$options = $this->addClass('form-control', $options);
		
		return parent::password($name, $options);
	}


	protected function addClass($class, $options)
	{
		return $this->addOption('class', $class, $options);
	}


	protected function addOption($option, $value, $options)
	{
		if ( ! isset($options[$option])) {
			$options[$option] = "";
		}

		$options[$option] = trim($options[$option] .= " " . $value);

		return $options;
	}


	public function submit($value = null, $type = 'btn-default', $options = array())
	{
		$options = $this->addClass('btn', $options);
		$options = $this->addClass($type, $options);
		
		return parent::submit($value, $options);
	}
}