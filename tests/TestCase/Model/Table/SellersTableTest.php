<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SellersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SellersTable Test Case
 */
class SellersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SellersTable
     */
    protected $Sellers;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Sellers',
        'app.AccountTypes',
        'app.Products',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Sellers') ? [] : ['className' => SellersTable::class];
        $this->Sellers = $this->getTableLocator()->get('Sellers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Sellers);

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
