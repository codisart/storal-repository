<?php
/*
 * This document has been generated with
 * https://mlocati.github.io/php-cs-fixer-configurator/#version:2.16.3|configurator
 * you can change this configuration by importing this file.
 */
return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR1' => true,
        '@PSR2' => true,
        'psr0' => true,
        'psr4' => true,
        'heredoc_indentation' => true,
        'ternary_to_null_coalescing' => true,
        'visibility_required' => true,
        '@PhpCsFixer' => true,
        'concat_space' => ['spacing' => 'one'],
        'blank_line_before_statement' => ['statements' => [
            'continue',
            'declare',
            'return',
            'throw',
            'try',
        ]],
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in('src')
    )
    ->setRiskyAllowed(true)
;
