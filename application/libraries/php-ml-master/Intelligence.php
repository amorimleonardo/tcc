<?php declare(strict_types=1);
/**
* 
*/

// namespace PhpmlExamples;
require_once 'vendor/autoload.php';
use Phpml\Regression\LeastSquares;

class Intelligence
{
	public function predicao($quatity = array(), $date = array())
	{
		$samples = $quatity;
		$targets = $date;
		// 2013-05-26, 2013-06-26, 2013-07-26, 2013-08-26, 2013-09-26

		$regression = new LeastSquares();
		$regression->train($samples, $targets);

		$predicted = (int) $regression->predict([6]);

		return $predicted;
	}
}