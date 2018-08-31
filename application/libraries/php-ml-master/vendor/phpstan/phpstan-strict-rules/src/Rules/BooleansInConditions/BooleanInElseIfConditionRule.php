<?php declare(strict_types = 1);

namespace PHPStan\Rules\BooleansInConditions;

class BooleanInElseIfConditionRule implements \PHPStan\Rules\Rule
{

	public function getNodeType(): string
	{
		return \PhpParser\Node\Stmt\ElseIf_::class;
	}

	/**
	 * @param \PhpParser\Node\Stmt\ElseIf_ $node
	 * @param \PHPStan\Analyser\Scope $scope
	 * @return string[] errors
	 */
	public function processNode(\PhpParser\Node $node, \PHPStan\Analyser\Scope $scope): array
	{
		$conditionExpressionType = $scope->getType($node->cond);
		if (BooleanRuleHelper::passesAsBoolean($conditionExpressionType)) {
			return [];
		}

		return [
			sprintf(
				'Only booleans are allowed in an elseif condition, %s given.',
				$conditionExpressionType->describe()
			),
		];
	}

}
