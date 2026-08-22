<?php

use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Modules\Inventory\src\Entities\Category;
use Tests\TestCase;

uses(TestCase::class);

describe('categories', function () {

    // Integration tests

    beforeEach(function () {
        Sanctum::actingAs(Operator::factory()->create());
    });

    test('should return a list', function () {

        Category::factory()->create();
        $this->getJson(route('categories.index'))->assertStatus(200);
    });
});
