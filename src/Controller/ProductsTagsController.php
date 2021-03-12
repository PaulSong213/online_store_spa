<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ProductsTags Controller
 *
 * @property \App\Model\Table\ProductsTagsTable $ProductsTags
 * @method \App\Model\Entity\ProductsTag[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsTagsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Products', 'Tags'],
        ];
        $productsTags = $this->paginate($this->ProductsTags);

        $this->set(compact('productsTags'));
    }

    /**
     * View method
     *
     * @param string|null $id Products Tag id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $productsTag = $this->ProductsTags->get($id, [
            'contain' => ['Products', 'Tags'],
        ]);

        $this->set(compact('productsTag'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $productsTag = $this->ProductsTags->newEmptyEntity();
        if ($this->request->is('post')) {
            $productsTag = $this->ProductsTags->patchEntity($productsTag, $this->request->getData());
            if ($this->ProductsTags->save($productsTag)) {
                $this->Flash->success(__('The products tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The products tag could not be saved. Please, try again.'));
        }
        $products = $this->ProductsTags->Products->find('list', ['limit' => 200]);
        $tags = $this->ProductsTags->Tags->find('list', ['limit' => 200]);
        $this->set(compact('productsTag', 'products', 'tags'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Products Tag id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $productsTag = $this->ProductsTags->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $productsTag = $this->ProductsTags->patchEntity($productsTag, $this->request->getData());
            if ($this->ProductsTags->save($productsTag)) {
                $this->Flash->success(__('The products tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The products tag could not be saved. Please, try again.'));
        }
        $products = $this->ProductsTags->Products->find('list', ['limit' => 200]);
        $tags = $this->ProductsTags->Tags->find('list', ['limit' => 200]);
        $this->set(compact('productsTag', 'products', 'tags'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Products Tag id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productsTag = $this->ProductsTags->get($id);
        if ($this->ProductsTags->delete($productsTag)) {
            $this->Flash->success(__('The products tag has been deleted.'));
        } else {
            $this->Flash->error(__('The products tag could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function show($tag = null)
    {
		if(!$tag){
			$this->paginate = [
				'contain' => ['Products', 'Tags'],
			];
		}else{
			
			$this->paginate = [
				'contain' => ['Products', 'Tags'],
				'conditions' =>['ProductsTags.tag_id' => $tag],
			];
		}
        $productsTags = $this->paginate($this->ProductsTags);
        
        $this->set(compact('productsTags','tag'));
    }
    
}
