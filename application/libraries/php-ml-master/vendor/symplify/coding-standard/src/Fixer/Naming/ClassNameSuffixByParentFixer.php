<?php declare(strict_types=1);

namespace Symplify\CodingStandard\Fixer\Naming;

use Nette\Utils\Strings;
use PhpCsFixer\Fixer\ConfigurationDefinitionFixerInterface;
use PhpCsFixer\Fixer\DefinedFixerInterface;
use PhpCsFixer\FixerConfiguration\FixerConfigurationResolver;
use PhpCsFixer\FixerConfiguration\FixerConfigurationResolverInterface;
use PhpCsFixer\FixerConfiguration\FixerOptionBuilder;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;
use SplFileInfo;
use Symplify\TokenRunner\Wrapper\FixerWrapper\ClassWrapper;
use Symplify\TokenRunner\Wrapper\FixerWrapper\ClassWrapperFactory;

final class ClassNameSuffixByParentFixer implements DefinedFixerInterface, ConfigurationDefinitionFixerInterface
{
    /**
     * @var string
     */
    private const PARENT_TYPES_TO_SUFFIXES_OPTION = 'parent_types_to_suffixes';

    /**
     * @var string[]
     */
    private $defaultParentClassToSuffixMap = [
        '*Command' => 'Command',
        '*Controller' => 'Controller',
        '*Repository' => 'Repository',
        '*Presenter' => 'Presenter',
        '*Request' => 'Request',
        '*Response' => 'Response',
        '*EventSubscriber' => 'EventSubscriber',
        '*FixerInterface' => 'Fixer',
        '*Sniff' => 'Sniff',
        '*Exception' => 'Exception',
        '*Handler' => 'Handler',
    ];

    /**
     * @var mixed[]
     */
    private $configuration = [];

    /**
     * @var ClassWrapperFactory
     */
    private $classWrapperFactory;

    public function __construct(ClassWrapperFactory $classWrapperFactory)
    {
        $this->classWrapperFactory = $classWrapperFactory;

        // set defaults
        $this->configuration = $this->getConfigurationDefinition()
            ->resolve([]);
    }

    public function getDefinition(): FixerDefinitionInterface
    {
        return new FixerDefinition('Class should have suffix by parent class/interface', [
            new CodeSample(
                <<<CODE
<?php

class SomeClass extends Command
{
}
CODE
            ),
        ]);
    }

    public function isCandidate(Tokens $tokens): bool
    {
        return $tokens->isAllTokenKindsFound([T_STRING, T_CLASS])
            && $tokens->isAnyTokenKindsFound([T_EXTENDS, T_IMPLEMENTS]);
    }

    public function fix(SplFileInfo $file, Tokens $tokens): void
    {
        for ($index = $tokens->count() - 1; $index >= 0; --$index) {
            $token = $tokens[$index];

            if (! $token->isClassy()) {
                continue;
            }

            $classWrapper = $this->classWrapperFactory->createFromTokensArrayStartPosition($tokens, $index);
            $this->processClassWrapper($tokens, $classWrapper);
        }
    }

    public function isRisky(): bool
    {
        return true;
    }

    public function getName(): string
    {
        return self::class;
    }

    public function getPriority(): int
    {
        return 0;
    }

    public function supports(SplFileInfo $file): bool
    {
        return true;
    }

    /**
     * @param mixed[]|null $configuration
     */
    public function configure(?array $configuration = null): void
    {
        if ($configuration === null) {
            return;
        }

        $this->configuration = $this->getConfigurationDefinition()
            ->resolve($configuration);
    }

    public function getConfigurationDefinition(): FixerConfigurationResolverInterface
    {
        $fixerOptionBuilder = new FixerOptionBuilder(
            self::PARENT_TYPES_TO_SUFFIXES_OPTION,
            'Map of parent classes to suffixes, that their children should have'
        );

        $parentTypesToSuffixesOption = $fixerOptionBuilder->setAllowedTypes(['array'])
            ->setDefault($this->defaultParentClassToSuffixMap)
            ->getOption();

        return new FixerConfigurationResolver([$parentTypesToSuffixesOption]);
    }

    private function processClassWrapper(Tokens $tokens, ClassWrapper $classWrapper): void
    {
        $className = $classWrapper->getName();
        if ($className === null) {
            return;
        }

        $parentClassName = $classWrapper->getParentClassName();

        if ($parentClassName) {
            $this->processType($tokens, $classWrapper, $parentClassName, $className);
        }

        foreach ($classWrapper->getInterfaceNames() as $interfaceName) {
            $this->processType($tokens, $classWrapper, $interfaceName, $className);
        }
    }

    private function processType(
        Tokens $tokens,
        ClassWrapper $classWrapper,
        string $parentType,
        string $className
    ): void {
        $classToSuffixMap = $this->configuration[self::PARENT_TYPES_TO_SUFFIXES_OPTION];

        foreach ($classToSuffixMap as $classMatch => $suffix) {
            if (! fnmatch($classMatch, $parentType) && ! fnmatch($classMatch . 'Interface', $parentType)) {
                continue;
            }

            if (Strings::endsWith($className, $suffix)) {
                continue;
            }

            $tokens[$classWrapper->getNamePosition()] = new Token([T_STRING, $className . $suffix]);
        }
    }
}
