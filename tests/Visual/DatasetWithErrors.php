<?php

use Symfony\Component\Process\Process;

$run = function (string $target, $decorated = false) {
    $process = new Process(
        ['php', 'bin/pest', $target, '--colors=always'],
        dirname(__DIR__, 2),
        ['COLLISION_PRINTER' => 'DefaultPrinter', 'COLLISION_IGNORE_DURATION' => 'true'],
    );

    $process->run();

    return $decorated ? $process->getOutput() : preg_replace('#\\x1b[[][^A-Za-z]*[A-Za-z]#', '', $process->getOutput());
};

test('dataset runtime errors will not be suppressed', function () use ($run) {
    $output = $run('tests/Fixtures/DatasetWithErrors');
    expect(trim($output))->not()->toBe('INFO  No tests found.');
});
