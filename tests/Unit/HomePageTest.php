<?php

declare(strict_types=1);

namespace app\tests\Unit;

use Yii;
use yii\helpers\Html;

final class HomePageTest extends \Codeception\Test\Unit
{
    public function testRenderCreateOrderAndCreateReleaseShortcutsOnly(): void
    {
        $html = Yii::$app->view->renderFile(Yii::getAlias('@app/views/site/index.php'), []);

        self::assertStringContainsString(
            Html::a(Yii::t('app', 'Create Order'), ['/order/create'], ['class' => 'btn btn-success btn-lg']),
            $html,
        );
        self::assertStringContainsString(
            Html::a(Yii::t('app', 'Create Release'), ['/release/create'], ['class' => 'btn btn-success btn-lg']),
            $html,
        );
        self::assertSame(2, substr_count($html, '<a '));
        self::assertStringNotContainsString('Build with Yii Framework', $html);
        self::assertStringNotContainsString('API Reference', $html);
        self::assertStringNotContainsString('yii2-debug', $html);
    }
}
