<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;
/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Sellers', 'ProductTypes','Images'],
        ];
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Sellers', 'ProductTypes', 'Tags', 'Carts','Images'],
        ]);

        $this->set(compact('product'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEmptyEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $sellers = $this->Products->Sellers->find('list', ['limit' => 200]);
        $productTypes = $this->Products->ProductTypes->find('list', ['limit' => 200]);
        $tags = $this->Products->Tags->find('list', ['limit' => 200]);
        $this->set(compact('product', 'sellers', 'productTypes', 'tags'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Tags'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $sellers = $this->Products->Sellers->find('list', ['limit' => 200]);
        $productTypes = $this->Products->ProductTypes->find('list', ['limit' => 200]);
        $tags = $this->Products->Tags->find('list', ['limit' => 200]);
        $this->set(compact('product', 'sellers', 'productTypes', 'tags'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function discover()
    {
        $this->paginate = [
            'contain' => ['Sellers', 'ProductTypes'],
        ];
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
    }
    
    public function show($productTypeId = 0){
        
        $requestedProductType = "allProducts";
        
        if($productTypeId > 0){
            $this->paginate = [
                'contain' => ['Sellers', 'ProductTypes','Images'],
                'conditions' =>['Products.product_type_id' => $productTypeId],
            ];
            
            // Prior to 3.6 use TableRegistry::get('Articles')
            $productTypes = TableRegistry::getTableLocator()->get('ProductTypes');

            // Start a new query.
            $query = $productTypes
                ->find()
                ->select(['name'])
                ->where(['id' => $productTypeId])
                ->toList();

            $requestedProductType = lcfirst(ucwords(str_replace(" ", "", $query[0]->name)));
        }else{
            $this->paginate = [
                'contain' => ['Sellers', 'ProductTypes','Images'],
            ];
        }
        
        $products = $this->paginate($this->Products);
        $this->set(compact('products','requestedProductType'));
    }
    
}
