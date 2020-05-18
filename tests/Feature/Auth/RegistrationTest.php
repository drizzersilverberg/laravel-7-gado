<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    // do the database migration before tests performed
    use RefreshDatabase;

    /** @test */
    public function guest_users_can_access_register_page()
    {
        $response = $this->call('GET', '/register');

        $this->assertEquals(200, $response->status());
    }

    /** @test */
    public function guest_users_can_do_register()
    {
        // visit login page
        $response = $this->visit('/register');

        // submit the form with the correct credentials
        $response = $this->submitForm('Register', [
            'name'     => 'Richard Hendricks',
            'email'    => 'richard.hendricks@piedpiper.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ]);

        // $response->dump();

        // user should see the current page as the home page
        // $this->seePageIs('/home');

        // user should see the `Dashboard` text in the page
        // $this->seeText('Dashboard');
    }
}
