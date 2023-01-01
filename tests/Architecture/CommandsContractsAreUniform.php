<?php

namespace Tests\Architecture;

use Arkitect\Expression\ForClasses\HaveNameMatching;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\Rules\DSL\ArchRule;
use Arkitect\Rules\Rule;
use Mortexa\LaravelArkitect\Contracts\RuleContract;
use Mortexa\LaravelArkitect\Rules\BaseRule;

class CommandsContractsAreUniform extends BaseRule implements RuleContract
{
    public static function rule(): ArchRule
    {
        return Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('abenevaut\Infrastructure\Console'))
            ->should(new HaveNameMatching('*CommandAbstract'))
            ->because('we want uniform naming for commands contracts');
    }

    public static function path(): string
    {
        return 'src/Console';
    }
}
