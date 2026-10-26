<?php

declare(strict_types=1);

namespace app\tests\Unit;

use app\controllers\SiteController;
use Yii;
use yii\base\Security;
use yii\web\IdentityInterface;
use yii\web\View;

final class LogoutTest extends \Codeception\Test\Unit
{
    public function testRenderLogoutLinkWhenUserIsLoggedIn(): void
    {
        $user = new class implements IdentityInterface {
            public string $username = 'admin';

            public static function findIdentity($id)
            {
                return null;
            }

            public static function findIdentityByAccessToken($token, $type = null)
            {
                return null;
            }

            public function getId()
            {
                return 100;
            }

            public function getAuthKey()
            {
                return 'test-auth-key';
            }

            public function validateAuthKey($authKey)
            {
                return $authKey === $this->getAuthKey();
            }
        };

        $controller = new SiteController(
            'site',
            Yii::$app,
            Yii::$app->mailer,
            new Security(),
        );

        $view = new View(['context' => $controller]);

        self::assertInstanceOf(
            IdentityInterface::class,
            $user,
            "Failed asserting that the identity is an instance of 'Identity' class.",
        );

        Yii::$app->user->login($user);

        $html = $view->render('//layouts/navbar.php');

        self::assertStringContainsString(
            'class="nav-link navbar-username"',
            $html,
            'Failed asserting that the username is rendered for a logged-in user.',
        );
        self::assertStringContainsString(
            'admin',
            $html,
            'Failed asserting that the logged-in username is displayed.',
        );
        self::assertStringContainsString(
            'fas fa-sign-out-alt',
            $html,
            'Failed asserting that the logout icon is rendered for a logged-in user.',
        );
        self::assertStringContainsString(
            'aria-label="Logout"',
            $html,
            'Failed asserting that the logout icon has an accessible label.',
        );
        self::assertStringContainsString(
            'data-method="post"',
            $html,
            'Failed asserting that the logout button uses POST method.',
        );
        self::assertStringContainsString(
            'data-widget="pushmenu"',
            $html,
            'Failed asserting that the sidebar toggle is preserved.',
        );
        self::assertStringNotContainsString(
            'navbar-search',
            $html,
            'Failed asserting that the placeholder search controls are removed.',
        );
        self::assertStringNotContainsString(
            'navbar-badge',
            $html,
            'Failed asserting that the placeholder notification controls are removed.',
        );

        $controller->actionLogout();

        $html = $view->render('//layouts/navbar.php');

        self::assertStringNotContainsString(
            'navbar-username',
            $html,
            'Failed asserting that the username is not rendered after logout.',
        );
        self::assertStringNotContainsString(
            'fas fa-sign-out-alt',
            $html,
            'Failed asserting that the logout icon is not rendered after logout.',
        );
    }
}
