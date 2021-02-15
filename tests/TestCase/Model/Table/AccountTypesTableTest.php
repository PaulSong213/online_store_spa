<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AccountTypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AccountTypesTable Test Case
 */
class AccountTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AccountTypesTable
     */
    protected $AccountTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AccountTypes',
        'app.Buyers',
        'app.Sellers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AccountTypes') ? [] : ['className' => AccountTypesTable::class];
        $this->AccountTypes = $this->getTableLocator()->get('AccountTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AccountTypes);

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
