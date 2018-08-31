<?php declare(strict_types = 1);

namespace PHPStan\Rules\PHPUnit;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Type\FalseBooleanType;
use PHPStan\Type\TrueBooleanType;

class AssertSameBooleanExpectedRule implements \PHPStan\Rules\Rule
{

	public function getNodeType(): string
	{
		return \PhpParser\NodeAbstract::class;
	}

	/**
	 * @param \PhpParser\Node\Expr\MethodCall|\PhpParser\Node\Expr\StaticCall $node
	 * @param \PHPStan\Analyser\Scope $scope
	 * @return string[] errors
	 */
	public function processNode(Node $node, Scope $scope): array
	{
		if (!AssertRuleHelper::isMethodOrStaticCallOnTestCase($node, $scope)) {
			return [];
		}

		if (count($node->args) < 2) {
			return [];
		}
		if (!is_string($node->name) || strtolower($node->name) !== 'assertsame') {
			return [];
		}

		$leftType = $scope->getType($node->args[0]->value);

		if ($leftType instanceof TrueBooleanType) {
			return [
				'You should use assertTrue() instead of assertSame() when expecting "true"',
			];
		}

		if ($leftType instanceof FalseBooleanType) {
			return [
				'You should use assertFalse() instead of assertSame() when expecting "false"',
			];
		}

		return [];
	}

}
