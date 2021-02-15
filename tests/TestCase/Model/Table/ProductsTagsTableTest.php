<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductsTagsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductsTagsTable Test Case
 */
class ProductsTagsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductsTagsTable
     */
    protected $ProductsTags;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ProductsTags',
        'app.Products',
        'app.Tags',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ProductsTags') ? [] : ['className' => ProductsTagsTable::class];
        $this->ProductsTags = $this->getTableLocator()->get('ProductsTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ProductsTags);

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
