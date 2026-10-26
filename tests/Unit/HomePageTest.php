<?php

declare(strict_types=1);

namespace app\tests\Unit;

use app\controllers\SiteController;
use Yii;
use yii\base\Security;
use yii\web\Response;
use yii\helpers\Url;

final class HomePageTest extends \Codeception\Test\Unit
{
    public function testHomepageRedirectsToOrderIndex(): void
    {
        $controller = new SiteController(
            'site',
            Yii::$app,
            Yii::$app->mailer,
            new Security(),
        );

        $response = $controller->actionIndex();

        self::assertInstanceOf(Response::class, $response);
        self::assertSame(Url::to(['/order/index'], true), $response->getHeaders()->get('Location'));
    }
}
