<?php

namespace Tests\Rules;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Node\InClassNode;
use PHPStan\Rules\Rule;

class ControllersExtendBaseControllerRule implements Rule
{
    public function getNodeType(): string
    {
        return InClassNode::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        if (
            empty($scope->getNamespace())
            || !str_starts_with($scope->getNamespace(), 'abenevaut\Infrastructure\Http\Controllers')
        ) {
            return [];
        }

        $reflectionClass = $node->getClassReflection();

        if ($reflectionClass->getName() === 'abenevaut\Infrastructure\Http\Controllers\ControllerAbstract') {
            return [];
        }

        if (!$reflectionClass->isSubclassOf('Illuminate\Routing\Controller')) {
            return [
                "Controllers should extend 'Illuminate\Routing\Controller' (see rule #49)"
            ];
        }

        return [];
    }
}
