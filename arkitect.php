<?php
declare(strict_types=1);

use Arkitect\ClassSet;
use Arkitect\CLI\Config;

return static function (Config $config): void {
    $rules = [
        \abenevaut\Infrastructure\Architecture\ControllersContractsAreAbstract::rule(),
        \abenevaut\Infrastructure\Architecture\ControllersContractsAreUniform::rule(),
    ];

    $config->add(ClassSet::fromDir('./src'), ...$rules);
};
