<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestAuthentication
{
    /**
     * list all users in system
     *
     * @return void
     */
    public function testUserList()
    {
        $response = $this->authenticated()
            ->get('/user');

        $response->assertSee($this->testUser['name']);
    }

    /**
     * create new user in system
     *
     * @return void
     */
    public function testUserCreate()
    {
        $response = $this->authenticated()
            ->followingRedirects()
            ->post('/user', [
                'email' => 'test_user@cmu.ac.th',
                'is_admin' => '1',
                'has_research_read' => '0',
                'has_research_write' => '0',
                'has_service_read' => '0',
                'has_service_write' => '0',
                'has_meeting_read' => '0',
                'has_meeting_write' => '0',
                'has_foreign_read' => '0',
                'has_foreign_write' => '0'
            ]);

        $response->assertSee('test_user@cmu.ac.th');
    }

    // @todo implement user update test

    // @todo implement user show test

    // @todo implement user delete test
}
