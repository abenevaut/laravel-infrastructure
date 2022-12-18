<?php

namespace abenevaut\Infrastructure\Console;

use Illuminate\Validation\Validator as CurrentValdiator;

interface ValidateCommandArgumentsInterface
{
    public function validate(): CurrentValdiator;

    public function displayErrors(): int;
}
