<?php

namespace Tests\Rules;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Node\InClassNode;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

class CommandsExtendBaseCommandRule implements Rule
{
    public function getNodeType(): string
    {
        return InClassNode::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        if (
            empty($scope->getNamespace())
            || !str_starts_with($scope->getNamespace(), 'abenevaut\Infrastructure\Console\Commands')
        ) {
            return [];
        }

        $reflectionClass = $node->getClassReflection();

//        if (
//            $reflectionClass->getName() === 'abenevaut\Infrastructure\Console\Commands\CommandAbstract'
//            && !$reflectionClass->isSubclassOf('Illuminate\Console\Command')
//        ) {
//            return [
//                RuleErrorBuilder::message("CommandAbstract should extend 'Illuminate\Console\Command'")->build(),
//            ];
//        }

        if (
            $reflectionClass->getName() !== 'abenevaut\Infrastructure\Console\Commands\CommandAbstract'
            && !$reflectionClass->isSubclassOf('Illuminate\Console\Command')
        ) {
            return [
                RuleErrorBuilder::message("Listener should extend 'Illuminate\Console\Command'")
                    ->build(),
            ];
        }

        return [];
    }
}
