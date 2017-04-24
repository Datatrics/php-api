<?php
$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__.'/examples')
    ->in(__DIR__.'/src')
    ->in(__DIR__.'/test');

return PhpCsFixer\Config::create()
    ->setRules(array('@PSR1' => true, '@PSR2' => true))
    ->setFinder($finder);
?>