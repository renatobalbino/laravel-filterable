<?php

use Illuminate\Http\Request;
use RbdevSys\Filterable\Filters\DummyFilter;
use RbdevSys\Tests\TestCase;

uses(TestCase::class)->in('Unit');

test('it should query filter the model', function () {
    $request = new Request();
    $request->merge(['dummyFilter' => 1]);

    $filters = (new DummyFilter($request))->filters();
    return expect($filters)
        ->toBeArray()
        ->toHaveKey('dummyFilter');
});
