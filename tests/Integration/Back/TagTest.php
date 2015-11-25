<?php

namespace App\Test\Integration\Back;

use TagSeeder;

class TagTest extends ModuleTestCase
{
    protected $name = 'tag';
    protected $pluralName = 'tags';
    protected $controller = 'Back\TagController';
    protected $expectedProperties = [
        'id',
        'name',
        'url',
    ];

    /**
     * @test
     */
    public function models_have_their_expected_properties()
    {
        $this->assertCount(10, $this->models);

        foreach($this->models as $model) {
            foreach($this->expectedProperties as $expectedProperty) {
                $this->assertNotNull($model->$expectedProperty, "Property {$expectedProperty} was null");
            }
        }
    }

    public function setUp()
    {
        parent::setUp();

        $this->models = $this->app->make(TagSeeder::class)->seedRandomTags(10);
    }
}
