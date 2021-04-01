<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ThumbnailImagesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ThumbnailImagesTable Test Case
 */
class ThumbnailImagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ThumbnailImagesTable
     */
    protected $ThumbnailImages;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ThumbnailImages',
        'app.Thumbnails',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ThumbnailImages') ? [] : ['className' => ThumbnailImagesTable::class];
        $this->ThumbnailImages = $this->getTableLocator()->get('ThumbnailImages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ThumbnailImages);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
