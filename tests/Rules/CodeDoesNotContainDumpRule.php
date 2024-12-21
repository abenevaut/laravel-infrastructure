<?php

namespace Tests\Rules;

use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Name as NodeName;
use PHPStan\Rules\Rule;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * https://laravel-france.com/posts/phpstan-il-est-ou-dd
 */
class CodeDoesNotContainDumpRule implements Rule
{
    public function getNodeType(): string
    {
        return FuncCall::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        if (! $node->name instanceof NodeName) {
            return [];
        }

        $functionName = $node->name->toString();

        if (in_array($functionName, ['dd', 'var_dump', 'dump'], true)) {
            return [
                RuleErrorBuilder::message(
                    sprintf('Method %s is prohibited', $functionName)
                )->build(),
            ];
        }

        return [];
    }
}
