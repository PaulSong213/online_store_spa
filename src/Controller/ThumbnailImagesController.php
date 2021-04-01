<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ThumbnailImages Controller
 *
 * @property \App\Model\Table\ThumbnailImagesTable $ThumbnailImages
 * @method \App\Model\Entity\ThumbnailImage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ThumbnailImagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Thumbnails'],
        ];
        $thumbnailImages = $this->paginate($this->ThumbnailImages);

        $this->set(compact('thumbnailImages'));
    }

    /**
     * View method
     *
     * @param string|null $id Thumbnail Image id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $thumbnailImage = $this->ThumbnailImages->get($id, [
            'contain' => ['Thumbnails'],
        ]);

        $this->set(compact('thumbnailImage'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $thumbnailImage = $this->ThumbnailImages->newEmptyEntity();
        if ($this->request->is('post')) {
            $thumbnailImage = $this->ThumbnailImages->patchEntity($thumbnailImage, $this->request->getData());
            if ($this->ThumbnailImages->save($thumbnailImage)) {
                $this->Flash->success(__('The thumbnail image has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The thumbnail image could not be saved. Please, try again.'));
        }
        $thumbnails = $this->ThumbnailImages->Thumbnails->find('list', ['limit' => 200]);
        $this->set(compact('thumbnailImage', 'thumbnails'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Thumbnail Image id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $thumbnailImage = $this->ThumbnailImages->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $thumbnailImage = $this->ThumbnailImages->patchEntity($thumbnailImage, $this->request->getData());
            if ($this->ThumbnailImages->save($thumbnailImage)) {
                $this->Flash->success(__('The thumbnail image has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The thumbnail image could not be saved. Please, try again.'));
        }
        $thumbnails = $this->ThumbnailImages->Thumbnails->find('list', ['limit' => 200]);
        $this->set(compact('thumbnailImage', 'thumbnails'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Thumbnail Image id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $thumbnailImage = $this->ThumbnailImages->get($id);
        if ($this->ThumbnailImages->delete($thumbnailImage)) {
            $this->Flash->success(__('The thumbnail image has been deleted.'));
        } else {
            $this->Flash->error(__('The thumbnail image could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
