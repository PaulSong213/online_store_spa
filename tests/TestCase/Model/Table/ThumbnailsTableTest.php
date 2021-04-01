<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ThumbnailsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ThumbnailsTable Test Case
 */
class ThumbnailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ThumbnailsTable
     */
    protected $Thumbnails;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Thumbnails',
        'app.ThumbnailImage',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Thumbnails') ? [] : ['className' => ThumbnailsTable::class];
        $this->Thumbnails = $this->getTableLocator()->get('Thumbnails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Thumbnails);

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
}
