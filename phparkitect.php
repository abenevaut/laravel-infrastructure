<?php
declare(strict_types=1);

use Arkitect\ClassSet;
use Arkitect\CLI\Config;
use Arkitect\Expression\ForClasses\HaveNameMatching;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\Rules\Rule;

return static function (Config $config): void {
    $srcClassSet = ClassSet::fromDir('./src');

    $rules = [];

    $rules[] = Rule::allClasses()
        ->that(new ResideInOneOfTheseNamespaces('abenevaut\Infrastructure\App\Listeners'))
        ->should(new HaveNameMatching('*Listener'))
        ->because('we want uniform naming');

    $rules[] = Rule::allClasses()
        ->that(new ResideInOneOfTheseNamespaces('abenevaut\Infrastructure\Http\Controllers'))
        ->should(new HaveNameMatching('*Controller'))
        ->because('we want uniform naming');

    $config->add($srcClassSet, ...$rules);
};
