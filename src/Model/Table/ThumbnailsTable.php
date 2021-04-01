<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Thumbnails Model
 *
 * @property \App\Model\Table\ThumbnailImageTable&\Cake\ORM\Association\HasMany $ThumbnailImage
 *
 * @method \App\Model\Entity\Thumbnail newEmptyEntity()
 * @method \App\Model\Entity\Thumbnail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Thumbnail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Thumbnail get($primaryKey, $options = [])
 * @method \App\Model\Entity\Thumbnail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Thumbnail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Thumbnail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Thumbnail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Thumbnail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Thumbnail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Thumbnail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Thumbnail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Thumbnail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ThumbnailsTable extends Table
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

        $this->setTable('thumbnails');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('ThumbnailImages', [
            'foreignKey' => 'thumbnail_id',
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
            ->maxLength('description', 120)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->requirePresence('is_displayed', 'create')
            ->notEmptyString('is_displayed');

        return $validator;
    }
}
