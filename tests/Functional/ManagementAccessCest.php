<?php

declare(strict_types=1);

namespace app\tests\Functional;

use app\tests\Support\FunctionalTester;

final class ManagementAccessCest
{
    public function guestsAreRedirectedFromSitePages(FunctionalTester $I): void
    {
        $routes = [
            'site/index',
            'site/about',
            'site/contact',
            'site/logout',
            'site/captcha',
            'site/error',
        ];

        foreach ($routes as $route) {
            $I->amOnRoute($route);
            $I->see('Login', 'h1');
        }
    }

    public function guestsAreRedirectedFromManagementTools(FunctionalTester $I): void
    {
        $routes = [
            'artist/index',
            'customer/index',
            'order/index',
            'order-item/index',
            'order-status/index',
            'price/index',
            'product/index',
            'product-media/index',
            'release/index',
            'release-type/index',
        ];

        foreach ($routes as $route) {
            $I->amOnRoute($route);
            $I->see('Login', 'h1');
        }
    }

    public function authenticatedUsersCanAccessManagementTools(FunctionalTester $I): void
    {
        $I->amLoggedInAs(100);
        $I->amOnRoute('product/index');
        $I->dontSee('Login', 'h1');
    }
}
