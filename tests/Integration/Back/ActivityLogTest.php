<?php

namespace App\Test\Integration\Back;

class ActivityLogTest extends BackTestCase
{
    /**
     * @test
     */
    public function it_can_display_the_activity_log()
    {
        $this
            ->visit(action('Back\ActivitylogController@index'))
            ->see('Log');
    }
}
