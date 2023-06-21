<?php
declare(strict_types=1);

namespace App\Core\Validators;

use App\Core\Config;
use App\Core\Contracts\Validator;

class ValidatorForm implements Validator
{
    protected array $data = [];
    protected array $errors = [];
    protected array $message = [];

    public function __construct()
    {
        $this->message = Config::getInstance()->messages('form.messages')['errors'];
    }
    public function load(array $data): self
    {
        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }

        return $this;
    }

    public function clear(): self
    {
        foreach ($this->data as $key => $value) {
            $this->data[$key] = htmlspecialchars(strip_tags(trim($value)));
        }

        return $this;
    }

    public function isEmpty(): self
    {
        foreach ($this->data as $key => $value) {
            if (empty($value)) {
                $this->errors[$key] = $this->message[$key];
            }
        }

        return $this;
    }

    public function isValidEmail(): self
    {
        if (empty($this->errors['email']) && !filter_var($this->data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = $this->message['invalid_email'];
        }

        return $this;
    }

    public function except(string ...$values): self
    {
        if (count($values) !== count($values, COUNT_RECURSIVE)) {
            $values = array_merge(...$values);
        }

        foreach ($this->data as $key => $value) {
            if (in_array($key, $values)) {
                unset($this->data[$key]);
            }
        }

        return $this;
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
