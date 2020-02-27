<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class TestAuthentication extends TestCase
{
    use RefreshDatabase;

    public $testUser = [
        'name' => 'tester engineering',
        'email' => 'test@cmu.ac.th'
    ];

    public function setUp() 
    {   
        parent::setUp();

        User::create($this->testUser);
    }

    public function authenticated()
    {
        $user = User::where('email', $this->testUser['email'])->first();

        return $this->actingAs($user);
    }
}
