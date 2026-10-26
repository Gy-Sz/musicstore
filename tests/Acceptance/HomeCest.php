<?php

declare(strict_types=1);

namespace app\tests\Acceptance;

use app\tests\Support\AcceptanceTester;
use yii\helpers\Url;

final class HomeCest
{
    public function ensureThatHomePageWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->fillField('input[name="LoginForm[username]"]', 'admin');
        $I->fillField('input[name="LoginForm[password]"]', 'admin');
        $I->click('login-button');

        $I->amOnPage(Url::toRoute('/site/index'));

        $I->seeLink('Create Order');
        $I->seeLink('Create Release');
        $I->dontSee('Build with Yii Framework');
        $I->dontSee('API Reference');
    }
}
