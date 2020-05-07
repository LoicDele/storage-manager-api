<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * GET users
     *
     */
    public function testIndex()
    {
        $this->json("get", "/users");
        $this->assertResponseOk();
    }

    public function testShow()
    {
        $user = User::all()->random();
        $this->json("get", "/users/{$user->id}");
        $this->assertResponseOk();
    }

    public function testDelete()
    {
        $user = User::all()->random();
        $this->json("delete", "/users/{$user->id}");
        $this->assertResponseOk();
    }
}
