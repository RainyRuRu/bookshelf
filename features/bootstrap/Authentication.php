<?php

use Illuminate\Support\Facades\Auth;

trait Authentication
{
	/**
     * @Given 帳號 :username 已註冊
     */
    public function registeredAccount($username)
    {
        factory(App\User::class)->create([
            'username' => $username,
            'password' => bcrypt('password'),
        ]);
    }

    /**
     * @Then 我已登入系統
     */
    public function iHaveLoggedIn()
    {
        $this->assertTrue(Auth::check());
    }


    /**
     * @param string $username
     * @param string $password
     */
    public function signInAs($username, $password = 'password'){
    	Auth::attempt([
    		'username' => $username, 
    		'password' => $password,
    	]);
    }
}
