<?php

declare(strict_types=1);

namespace app\tests\Unit;

use app\models\LoginForm;
use Yii;

final class LoginViewTest extends \Codeception\Test\Unit
{
    public function testLoginViewCentersFormWithoutBrandingText(): void
    {
        Yii::$app->request->setUrl('/index-test.php?r=site%2Flogin');

        $html = Yii::$app->view->renderFile(
            Yii::getAlias('@app/views/site/login.php'),
            ['model' => new LoginForm()],
        );

        self::assertStringContainsString('login-form-card', $html);
        self::assertStringContainsString('id="login-form"', $html);
        self::assertStringNotContainsString('MusicStore', $html);
        self::assertStringNotContainsString('Welcome', $html);
        self::assertStringNotContainsString('Yii', $html);
        self::assertStringNotContainsString('yii3_full_', $html);
    }
}
