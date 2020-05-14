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

    public function testCreate()
    {
        $newUser = factory(User::class)->raw();
        if(User::where('email', '=', $newUser['email'])->first() == null)
        {
            $response = $this->json("post", "/users", $newUser);
            $response->assertResponseOk();
            //$this->seeInDatabase('users', $newUser);
        }
        else
        {
            $this->json('POST', '/users', $newUser);
            $this->assertResponseStatus(422);
        }

    }

    public function testUpdate()
    {
        $update = factory(User::class)->raw();
        $user = User::all()->random();
        if(User::where('email', '=', $update['email'])->first() == null or $user->email == $update['email'])
        {
            $this->json("put", "/users/{$user->id}", $update);
            $this->assertResponseOk();
            //$this->seeInDatabase('users', $update);
        }
        else
        {
            $this->json("put", "/users/{$user->id}", $update);
            $this->assertResponseStatus(404);
        }
    }

    public function testDelete()
    {
        $user = User::all()->random();
        $this->json("delete", "/users/{$user->id}");
        $this->assertResponseOk();
    }
}
