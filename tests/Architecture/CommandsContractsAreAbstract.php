<?php

namespace Tests\Architecture;

use Arkitect\Expression\ForClasses\IsAbstract;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\Rules\DSL\ArchRule;
use Arkitect\Rules\Rule;
use Mortexa\LaravelArkitect\Contracts\RuleContract;
use Mortexa\LaravelArkitect\Rules\BaseRule;

class CommandsContractsAreAbstract extends BaseRule implements RuleContract
{
    public static function rule(): ArchRule
    {
        return Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('abenevaut\Infrastructure\Console'))
            ->should(new IsAbstract()) //  | new IsInterface() | new IsTrait()
            ->because('we want to be sure that commands contracts are abstract');
    }

    public static function path(): string
    {
        return 'src/Console';
    }
}
