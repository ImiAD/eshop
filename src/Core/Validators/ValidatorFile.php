<?php
declare(strict_types=1);

namespace App\Core\Validators;

use App\Core\Config;
use App\Core\Contracts\Validator;

class ValidatorFile implements Validator
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

    public function check(): void
    {
        if ($this->data['error']) {
            $this->setErrors('error_load', $this->message['error_load']);
        }

        if (empty($this->data['name'])) {
            $this->setErrors('empty', $this->message['empty']);
        }

        if ($this->data['size']) {
            $this->setErrors('size', $this->message['file_size_error']);
        }

        if (!in_array($this->getExtension(), $this->message['white_list'], true)) {
            $this->setErrors('extension', $this->message['while_list_error']);
        }
    }

    private function getSize(): int
    {
        return $this->getExtension() === 'txt' ? $this->message['file_size_txt'] : $this->message['file_size'];
    }

    private function setErrors(string $key, string $value): void
    {
        if (!array_key_exists($key, $this->getErrors())) {
            $this->errors[$key] = $value;
        }
    }

    private function getExtension(): string
    {
        return strtolower(pathinfo($this->data['name'], PATHINFO_EXTENSION));
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
