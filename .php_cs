<?php
$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__.'/src')
    ->in(__DIR__.'/tests');

return PhpCsFixer\Config::create()
    ->setRules(array('@PSR1' => true, '@PSR2' => true))
    ->setFinder($finder);
?>
