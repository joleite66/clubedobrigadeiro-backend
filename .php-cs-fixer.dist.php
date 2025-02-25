<?php

$finder = PhpCsFixer\Finder::create()
    ->in(['src']) // Directories to scan
    ->exclude(['var', 'vendor']) // Ignore certain directories
    ->name('*.php')
    ->notName('*.blade.php') // Ignore Laravel Blade files (if using)
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true, // Apply Symfony coding standards
        'array_syntax' => ['syntax' => 'short'],
        'binary_operator_spaces' => ['default' => 'align_single_space_minimal'],
        'no_unused_imports' => true,
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'single_quote' => true,
        'trailing_comma_in_multiline' => true,
    ])
    ->setFinder($finder);
