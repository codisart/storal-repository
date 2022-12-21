<?php

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'concat_space' => ['spacing' => 'one'],
        '@PHP80Migration' => true,
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()->in(__DIR__)
    )
    ->setRiskyAllowed(true)
;
