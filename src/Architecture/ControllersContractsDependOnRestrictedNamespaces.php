<?php

namespace abenevaut\Infrastructure\Architecture;

use Arkitect\Expression\ForClasses\DependsOnlyOnTheseNamespaces;
use Arkitect\Expression\ForClasses\HaveNameMatching;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\Rules\DSL\ArchRule;
use Arkitect\Rules\Rule;
use Mortexa\LaravelArkitect\Contracts\RuleContract;
use Mortexa\LaravelArkitect\Rules\BaseRule;

class ControllersContractsDependOnRestrictedNamespaces extends BaseRule implements RuleContract
{
    public static function rule(): ArchRule
    {
        return Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('abenevaut\Infrastructure\Http\Controllers'))
            ->should(new DependsOnlyOnTheseNamespaces('Illuminate\Routing', 'Illuminate\Foundation', 'abenevaut\Infrastructure\Http\Controllers'))
            ->because('we want to protect controllers contracts from external dependencies except for Illuminate\Routing & Illuminate\Foundation');
    }

    public static function path(): string
    {
        return 'src/Http/Controllers';
    }
}
