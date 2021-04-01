<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ThumbnailImages Model
 *
 * @property \App\Model\Table\ThumbnailsTable&\Cake\ORM\Association\BelongsTo $Thumbnails
 *
 * @method \App\Model\Entity\ThumbnailImage newEmptyEntity()
 * @method \App\Model\Entity\ThumbnailImage newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ThumbnailImage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ThumbnailImage get($primaryKey, $options = [])
 * @method \App\Model\Entity\ThumbnailImage findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ThumbnailImage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ThumbnailImage[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ThumbnailImage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ThumbnailImage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ThumbnailImage[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ThumbnailImage[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ThumbnailImage[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ThumbnailImage[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ThumbnailImagesTable extends Table
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

        $this->setTable('thumbnail_images');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Thumbnails', [
            'foreignKey' => 'thumbnail_id',
            'joinType' => 'INNER',
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
            ->scalar('file_name')
            ->maxLength('file_name', 64)
            ->requirePresence('file_name', 'create')
            ->notEmptyFile('file_name');

        $validator
            ->scalar('file_path')
            ->maxLength('file_path', 64)
            ->requirePresence('file_path', 'create')
            ->notEmptyFile('file_path');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['thumbnail_id'], 'Thumbnails'), ['errorField' => 'thumbnail_id']);

        return $rules;
    }
}
