<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    // do the database migration before tests performed
    use RefreshDatabase;

    /** @test */
    public function guest_users_can_access_login_page()
    {
        $response = $this->call('GET', '/login');

        $this->assertEquals(200, $response->status());
    }

    /** @test */
    public function guest_users_can_do_login()
    {
        // prepare and create user for the scenario
        $registeredUser = factory(User::class)->create([
            'email'    => 'username1@example.net',
            'password' => bcrypt('secret'),
        ]);

        // visit login page
        $response = $this->visit('/login');

        // submit the form with the correct credentials
        $this->submitForm('Login', [
            'email'    => 'username1@example.net',
            'password' => 'secret',
        ]);

        // user should see the current page as the home page
        $this->seePageIs('/home');

        // user should see the `Dashboard` text in the page
        $this->seeText('Dashboard');
    }
    
    /** @test */
    public function auth_users_redirected_when_access_login_page()
    {
        // prepare and create user for the scenario
        $registeredUser = factory(User::class)->create();

        // act as the user
        $this->actingAs($registeredUser);

        // visit login page
        $response = $this->visit('/login');

        // user should see the current page as the home page
        // TODO: try the redirect method instead of seePageIs
        $this->seePageIs('/home');
    }

    // TODO: logout
}
