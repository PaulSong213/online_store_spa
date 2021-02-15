<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Buyers Controller
 *
 * @property \App\Model\Table\BuyersTable $Buyers
 * @method \App\Model\Entity\Buyer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BuyersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['AccountTypes'],
        ];
        $buyers = $this->paginate($this->Buyers);

        $this->set(compact('buyers'));
    }

    /**
     * View method
     *
     * @param string|null $id Buyer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $buyer = $this->Buyers->get($id, [
            'contain' => ['AccountTypes', 'Carts'],
        ]);

        $this->set(compact('buyer'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $buyer = $this->Buyers->newEmptyEntity();
        if ($this->request->is('post')) {
            $buyer = $this->Buyers->patchEntity($buyer, $this->request->getData());
            if ($this->Buyers->save($buyer)) {
                $this->Flash->success(__('The buyer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The buyer could not be saved. Please, try again.'));
        }
        $accountTypes = $this->Buyers->AccountTypes->find('list', ['limit' => 200]);
        $this->set(compact('buyer', 'accountTypes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Buyer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $buyer = $this->Buyers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $buyer = $this->Buyers->patchEntity($buyer, $this->request->getData());
            if ($this->Buyers->save($buyer)) {
                $this->Flash->success(__('The buyer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The buyer could not be saved. Please, try again.'));
        }
        $accountTypes = $this->Buyers->AccountTypes->find('list', ['limit' => 200]);
        $this->set(compact('buyer', 'accountTypes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Buyer id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $buyer = $this->Buyers->get($id);
        if ($this->Buyers->delete($buyer)) {
            $this->Flash->success(__('The buyer has been deleted.'));
        } else {
            $this->Flash->error(__('The buyer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
