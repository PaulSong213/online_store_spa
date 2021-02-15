<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AccountTypes Model
 *
 * @property \App\Model\Table\BuyersTable&\Cake\ORM\Association\HasMany $Buyers
 * @property \App\Model\Table\SellersTable&\Cake\ORM\Association\HasMany $Sellers
 *
 * @method \App\Model\Entity\AccountType newEmptyEntity()
 * @method \App\Model\Entity\AccountType newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\AccountType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AccountType get($primaryKey, $options = [])
 * @method \App\Model\Entity\AccountType findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\AccountType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AccountType[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AccountType|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AccountType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AccountType[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AccountType[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\AccountType[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AccountType[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AccountTypesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('account_types');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Buyers', [
            'foreignKey' => 'account_type_id',
        ]);
        $this->hasMany('Sellers', [
            'foreignKey' => 'account_type_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 64)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->maxLength('description', 4294967295)
            ->allowEmptyString('description');

        return $validator;
    }
}
