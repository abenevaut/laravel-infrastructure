<?php
declare(strict_types=1);

use Arkitect\ClassSet;
use Arkitect\CLI\Config;

return static function (Config $config): void {
    $rules = [
        \Tests\Architecture\CommandsContractsAreAbstract::rule(),
        \Tests\Architecture\CommandsContractsAreUniform::rule(),
        \Tests\Architecture\ControllersContractsAreAbstract::rule(),
        \Tests\Architecture\ControllersContractsAreUniform::rule(),
    ];

    $config->add(ClassSet::fromDir('./src'), ...$rules);
};
