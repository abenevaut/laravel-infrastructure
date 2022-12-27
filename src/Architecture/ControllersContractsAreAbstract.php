<?php

namespace abenevaut\Infrastructure\Architecture;

use Arkitect\Expression\ForClasses\IsAbstract;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\Rules\DSL\ArchRule;
use Arkitect\Rules\Rule;
use Mortexa\LaravelArkitect\Contracts\RuleContract;
use Mortexa\LaravelArkitect\Rules\BaseRule;

class ControllersContractsAreAbstract extends BaseRule implements RuleContract
{
    public static function rule(): ArchRule
    {
        return Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('abenevaut\Infrastructure\Http\Controllers'))
            ->should(new IsAbstract())
            ->because('we want to be sure that controllers contracts are abstract');
    }

    public static function path(): string
    {
        return 'src/Http/Controllers';
    }
}
