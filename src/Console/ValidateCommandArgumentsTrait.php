<?php

namespace abenevaut\Infrastructure\Console;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as CurrentValdiator;
use Symfony\Component\Console\Command\Command;

trait ValidateCommandArgumentsTrait
{
    private CurrentValdiator $validator;

    abstract protected function rules(): array;

    /**
     * @throws \Exception
     */
    public function validate(): CurrentValdiator
    {
        $this->validator = Validator::make($this->arguments(), $this->rules());

        if ($this->validator->fails()) {
            throw new \Exception();
        }

        return $this->validator;
    }

    public function displayErrors(): int
    {
        foreach ($this->validator->errors()->messages() as $key => $messages) {
            foreach ($messages as $message) {
                $this->error($message);
            }
        }

        return Command::FAILURE;
    }
}
