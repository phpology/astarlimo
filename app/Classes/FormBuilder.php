<?php
namespace App\Classes;

class FormBuilder
{
	private array $elements = [];
	private string $action = '';
	private string $method = 'POST';
	private string $enctype = 'application/x-www-form-urlencoded';

	public function setAction(string $action): self
	{
		$this->action = $action;
		return $this;
	}

	public function setMethod(string $method): self
	{
		$this->method = strtoupper($method);
		return $this;
	}

	public function setEnctype(string $enctype): self
	{
		$this->enctype = $enctype;
		return $this;
	}

	public function addElement(string $element): self
	{
		$this->elements[] = $element;
		return $this;
	}

	public function addSubmit(): self
	{
		$this->elements[] = '<div class="submit_but">
				<button type="submit" id="submit_update_close" name="update_close" class="update_close btn btn-primary btn-sm">Save/Update &amp; Close</button>
			</div>';
		return $this;
	}

	public function renderForm(): string
	{
		$formHtml = sprintf(
			'<form action="%s" method="%s" enctype="%s" id="dashboard-form" class="form-validate">',
			htmlspecialchars($this->action),
			htmlspecialchars($this->method),
			htmlspecialchars($this->enctype)
		);

		$formHtml .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';

		foreach ($this->elements as $element) {
			$formHtml .= $element . PHP_EOL;
		}

		$formHtml .= '</form>';
		return $formHtml;
	}

	public function hidden(string $name, string $id, string $value = '', array $attributes = [], string $class = '', string $style = ''): string
	{
		return $this->input('', 'hidden', $name, $id, $class, $style, $value, $attributes);
	}

	public function textbox(string $question, string $name, string $id, string $value = '', array $attributes = [], string $class = '', string $style = ''): string
	{
		return $this->input($question, 'text', $name, $id, $class, $style, $value, $attributes);
	}

	public function password(string $question, string $name, string $id, string $value = '', array $attributes = [], string $class = '', string $style = ''): string
	{
		return $this->input($question, 'password', $name, $id, $class, $style, $value, $attributes);
	}

	public function number(string $question, string $name, string $id, string $value = '', array $attributes = [], string $class = '', string $style = ''): string
	{
		return $this->input($question, 'number', $name, $id, $class, $style, $value, $attributes);
	}

	public function date(string $question, string $name, string $id, string $value = '', array $attributes = [], string $class = '', string $style = ''): string
	{
		return $this->input($question, 'date', $name, $id, $class, $style, $value, $attributes);
	}

	public function file(string $question, string $name, string $id, string $class = '', string $style = ''): string
	{
		return $this->input($question, 'file', $name, $id, $class, $style);
	}

	public function textarea(string $question, string $name, string $id, string $value = '', array $attributes = [], string $class = '', string $style = ''): string
	{
		return sprintf(
			'
			<div class="form-group">
				<label class="form-label" for="%s">%s</label>
				<div class="form-control-wrap"> 
					<textarea name="%s" id="%s" class="%s" style="%s">%s</textarea>
				</div>
			</div>',
			htmlspecialchars($id),
			htmlspecialchars($question),
			htmlspecialchars($name),
			htmlspecialchars($id),
			htmlspecialchars($class),
			htmlspecialchars($style),
			htmlspecialchars($value)
		);
	}

	public function wysiwyg(string $question, string $name, string $id, string $value = '', array $attributes = [], string $class = '', string $style = ''): string
	{
		return sprintf(
			'
			<div class="form-group">
				<label class="form-label" for="%s">%s</label>
				<div class="form-control-wrap"> 
					<textarea name="%s" id="summernote" class="%s" style="%s">%s</textarea>
				</div>
			</div>',
			htmlspecialchars($id),
			htmlspecialchars($question),
			htmlspecialchars($name),
			htmlspecialchars($class),
			htmlspecialchars($style),
			htmlspecialchars($value)
		);
	}

	public function select(string $question, string $name, string $id, string $selected = '', array $options = [], array $attributes = [], string $class = '', string $style = ''): string
	{
		$optionsHtml = '';
		foreach ($options as $value => $label) {
			$isSelected = $value == $selected ? ' selected' : '';
			$optionsHtml .= sprintf('<option value="%s"%s>%s</option>', htmlspecialchars($value), $isSelected, htmlspecialchars($label));
		}
		return sprintf(
			'
			<div class="form-group">
				<label class="form-label" for="%s">%s</label>
				<div class="form-control-wrap"> 
					<select name="%s" id="%s" class="%s" style="%s">%s</select>
				</div>
			</div>',
			htmlspecialchars($id),
			htmlspecialchars($question),
			htmlspecialchars($name),
			htmlspecialchars($id),
			htmlspecialchars($class),
			htmlspecialchars($style),
			$optionsHtml
		);
	}

	public function radio(string $question, string $name, string $idPrefix, string $checked = '', array $options = [], array $attributes = [], string $class = '', string $style = ''): string
	{
		$radioHtml = '';
		foreach ($options as $value => $label) {
			$isChecked = $value == $checked ? ' checked' : '';
			$id = $idPrefix . '_' . $value;
			$radioHtml .= sprintf(
				'
				<div class="form-group">
					<label class="form-label" for="%s">%s</label>
					<div class="form-control-wrap"> 
						<input type="radio" name="%s" id="%s" class="%s" style="%s" value="%s"%s> <span for="%s">%s</span>
					</div>
				</div>',
				htmlspecialchars($id),
				htmlspecialchars($question),
				htmlspecialchars($name),
				htmlspecialchars($id),
				htmlspecialchars($class),
				htmlspecialchars($style),
				htmlspecialchars($value),
				$isChecked,
				htmlspecialchars($id),
				htmlspecialchars($label)
			);
		}
		return $radioHtml;
	}

	public function checkbox(string $question, string $name, string $idPrefix, array $checkedValues = [], array $options = [], array $attributes = [], string $class = '', string $style = ''): string
	{
		$checkboxHtml = '';
		foreach ($options as $value => $label) {
			$isChecked = in_array($value, $checkedValues) ? ' checked' : '';
			$id = $idPrefix . '_' . $value;
			$checkboxHtml .= sprintf(
				'
				<div class="form-group">
					<label class="form-label" for="%s">%s</label>
					<div class="form-control-wrap"> 
						<input type="checkbox" name="%s[]" id="%s" class="%s" style="%s" value="%s"%s> <span for="%s">%s</span>
					</div>
				</div>',
				htmlspecialchars($id),
				htmlspecialchars($question),
				htmlspecialchars($name),
				htmlspecialchars($id),
				htmlspecialchars($class),
				htmlspecialchars($style),
				htmlspecialchars($value),
				$isChecked,
				htmlspecialchars($id),
				htmlspecialchars($label)
			);
		}
		return $checkboxHtml;
	}

	/**
	 * Predefined select list for status options
	 */
	public function statusSelect(string $question, string $name = 'status', string $id = 'status', int $selected = STATUS_PENDING, array $attributes = [], string $class = 'form-select', string $style = ''): string
	{
		$statusOptions = [
			STATUS_LIVE     => 'Live',
			STATUS_PENDING  => 'Pending',
			STATUS_ARCHIVED => 'Archive',
		];

		return $this->select($question, $name, $id, $selected, $statusOptions, $attributes, $class, $style);
	}

	/**
	 * Predefined select list for permissions options
	 */
	public function permissionsSelect(string $question, string $name = 'permission_id', string $id = 'permission_id', int $selected = 2, array $attributes = [], string $class = 'form-select', string $style = ''): string
	{
		$permissionOptions = [
			1 => 'Admin',
			2 => 'User',
		];

		return $this->select($question, $name, $id, $selected, $permissionOptions, $attributes, $class, $style);
	}

	public function getStatusValue(int $status = STATUS_PENDING): string
	{
		return match ($status) {
			STATUS_LIVE     => 'Live',
			STATUS_PENDING  => 'Pending',
			STATUS_ARCHIVED => 'Archive',
			default         => 'Unknown',
		};
	}

	private function input(string $question, string $type, string $name, string $id, string $class, string $style, string $value = '', array $attributes = []): string
	{
		$attributesString = $this->buildAttributes($attributes);

		return sprintf(
			'
			<div class="form-group">
				<label class="form-label" for="%s">%s</label>
				<div class="form-control-wrap"> 
					<input type="%s" name="%s" id="%s" class="%s" style="%s" value="%s" %s>
				</div>
			</div>',
			htmlspecialchars($id),
			htmlspecialchars($question),
			htmlspecialchars($type),
			htmlspecialchars($name),
			htmlspecialchars($id),
			htmlspecialchars($class),
			htmlspecialchars($style),
			htmlspecialchars($value),
			$attributesString
		);
	}

	private function buildAttributes(array $attributes): string
	{
		$attributesString = '';
		foreach ($attributes as $key => $value) {
			$attributesString .= sprintf(' %s="%s"', htmlspecialchars($key), htmlspecialchars($value));
		}
		return trim($attributesString);
	}
}
