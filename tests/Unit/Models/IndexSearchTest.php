<?php

declare(strict_types=1);

namespace app\tests\Unit\Models;

use app\models\ArtistSearch;
use app\models\ProductSearch;
use app\models\ReleaseSearch;
use Yii;
use yii\db\Connection;

final class IndexSearchTest extends \Codeception\Test\Unit
{
    private Connection $_originalDb;
    private Connection $_testDb;

    protected function setUp(): void
    {
        parent::setUp();
        $this->_originalDb = Yii::$app->get('db');
        $this->_testDb = new Connection(['dsn' => 'sqlite::memory:']);
        Yii::$app->set('db', $this->_testDb);
        $this->createSchema();
        $this->insertFixtures();
    }

    protected function tearDown(): void
    {
        Yii::$app->set('db', $this->_originalDb);
        $this->_testDb->close();
        parent::tearDown();
    }

    public function testArtistFiltersByDisplayedFields(): void
    {
        $provider = (new ArtistSearch())->search([
            'ArtistSearch' => [
                'name' => 'Sample',
                'country' => 'Canada',
            ],
        ]);

        self::assertCount(1, $provider->getModels());
        self::assertSame('Sample Artist', $provider->getModels()[0]->name);
    }

    public function testReleaseFiltersByRelatedArtistAndType(): void
    {
        $provider = (new ReleaseSearch())->search([
            'ReleaseSearch' => [
                'artistName' => 'Sample Artist',
                'title' => 'Sample',
                'date' => '2024-01',
                'releaseTypeName' => 'Album',
                'genre' => 'Rock',
            ],
        ]);

        self::assertCount(1, $provider->getModels());
        self::assertSame('Sample Release', $provider->getModels()[0]->title);
    }

    public function testProductFiltersByRelatedValuesAndZeroStock(): void
    {
        $provider = (new ProductSearch())->search([
            'ProductSearch' => [
                'releaseTitle' => 'Sample Release',
                'mediaName' => 'Vinyl',
                'available_from_date' => '2024-02',
                'stock' => '0',
            ],
        ]);

        self::assertCount(1, $provider->getModels());
        self::assertSame(0, (int) $provider->getModels()[0]->stock);
    }

    private function createSchema(): void
    {
        $this->_testDb->createCommand()->createTable('{{%artists}}', [
            'id' => 'pk',
            'name' => 'string',
            'country' => 'string NULL',
        ])->execute();
        $this->_testDb->createCommand()->createTable('{{%release_types}}', [
            'id' => 'pk',
            'name' => 'string',
        ])->execute();
        $this->_testDb->createCommand()->createTable('{{%releases}}', [
            'id' => 'pk',
            'title' => 'string',
            'artistid' => 'integer',
            'date' => 'string',
            'typeid' => 'integer',
            'genre' => 'string NULL',
        ])->execute();
        $this->_testDb->createCommand()->createTable('{{%product_medias}}', [
            'id' => 'pk',
            'name' => 'string',
        ])->execute();
        $this->_testDb->createCommand()->createTable('{{%products}}', [
            'id' => 'pk',
            'releaseid' => 'integer',
            'mediaid' => 'integer',
            'available_from_date' => 'string',
            'stock' => 'integer',
        ])->execute();
    }

    private function insertFixtures(): void
    {
        $this->_testDb->createCommand()->batchInsert(
            '{{%artists}}',
            ['id', 'name', 'country'],
            [
                [1, 'Sample Artist', 'Canada'],
                [2, 'Other Artist', 'France'],
            ]
        )->execute();
        $this->_testDb->createCommand()->batchInsert(
            '{{%release_types}}',
            ['id', 'name'],
            [
                [1, 'Album'],
                [2, 'Single'],
            ]
        )->execute();
        $this->_testDb->createCommand()->batchInsert(
            '{{%releases}}',
            ['id', 'title', 'artistid', 'date', 'typeid', 'genre'],
            [
                [1, 'Sample Release', 1, '2024-01-01', 1, 'Rock'],
                [2, 'Other Release', 2, '2023-01-01', 2, 'Jazz'],
            ]
        )->execute();
        $this->_testDb->createCommand()->batchInsert(
            '{{%product_medias}}',
            ['id', 'name'],
            [
                [1, 'Vinyl'],
                [2, 'CD'],
            ]
        )->execute();
        $this->_testDb->createCommand()->batchInsert(
            '{{%products}}',
            ['id', 'releaseid', 'mediaid', 'available_from_date', 'stock'],
            [
                [1, 1, 1, '2024-02-01', 0],
                [2, 2, 2, '2023-02-01', 10],
            ]
        )->execute();
    }
}
