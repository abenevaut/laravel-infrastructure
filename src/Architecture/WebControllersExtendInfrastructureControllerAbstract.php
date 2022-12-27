<?php

namespace abenevaut\Infrastructure\Architecture;

use Arkitect\Expression\ForClasses\Extend;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\Rules\DSL\ArchRule;
use Arkitect\Rules\Rule;
use Mortexa\LaravelArkitect\Contracts\RuleContract;
use Mortexa\LaravelArkitect\Rules\BaseRule;

class WebControllersExtendInfrastructureControllerAbstract extends BaseRule implements RuleContract
{
    public static function rule(string $namespaces = 'App\Http\Controllers'): ArchRule
    {
        return Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces($namespaces))
            ->should(new Extend('abenevaut\Infrastructure\Http\Controllers\ControllerAbstract'))
            ->because('we use abenevaut/infrastructure abstract controller');
    }

    public static function path(): string
    {
        return 'app/Http/Controllers';
    }
}
