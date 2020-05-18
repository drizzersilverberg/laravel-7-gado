<?php

namespace Tests;

// use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public $baseUrl = 'http://localhost';

    use CreatesApplication;
}
