<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Goez\BehatLaravelExtension\Context\LaravelContext;
use Illuminate\Support\Facades\Auth;

/**
 * Defines application features from the specific context.
 */
class MembershipContext extends LaravelContext implements Context, SnippetAcceptingContext
{

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

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
     * @When 我註冊帳號 :username
     */
    public function iRegisterAccount($username)
    {
        $this->visit('/auth/register');
        $this->fillField('username', $username);
        $this->fillField('password', 'password');
        $this->fillField('password_confirmation', 'password');

        $this->pressButton('Register');
    }

    /**
     * @Then 我已登入系統
     */
    public function iHaveLoggedIn()
    {
        $this->assertTrue(Auth::check());
    }

    /**
     * @Then 被導向書籍列表畫面
     */
    public function iBeRedirectedHome()
    {
        $this->assertHomepage();
    }

    /**
     * @Then 頁面出現錯誤訊息 :message
     */
    public function assertPageContainsErrorMessage($message)
    {
        $this->assertPageContainsText($message);
    }

    /**
     * @When 用帳號 :username 及密碼 :password 登入系統
     */
    public function signIn($username, $password)
    {
        $this->visit('/auth/login');
        $this->fillField('username', $username);
        $this->fillField('password', $password);
        $this->pressButton('Login');
    }
}
