<?php

it('will not be suppressed', function ($value) {
    expect(true)->toBe(true);
})->with(function () {
    throw new Exception('error');

    return [
        [1],
    ];
});
