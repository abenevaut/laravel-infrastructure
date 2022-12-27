<?php

namespace abenevaut\Infrastructure\Architecture;

use Arkitect\Expression\ForClasses\HaveNameMatching;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\Rules\DSL\ArchRule;
use Arkitect\Rules\Rule;
use Mortexa\LaravelArkitect\Contracts\RuleContract;
use Mortexa\LaravelArkitect\Rules\BaseRule;

class ControllersContractsAreUniform extends BaseRule implements RuleContract
{
    public static function rule(): ArchRule
    {
        return Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('abenevaut\Infrastructure\Http\Controllers'))
            ->should(new HaveNameMatching('*ControllerAbstract'))
            ->because('we want uniform naming for controllers contracts');
    }

    public static function path(): string
    {
        return 'src/Http/Controllers';
    }
}
