<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Category']
        ];
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Category']
        ]);

        $this->set('product', $product);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $category = $this->Products->Category->find('list', ['limit' => 200]);
        $this->set(compact('product', 'category'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $category = $this->Products->Category->find('list', ['limit' => 200]);
        $this->set(compact('product', 'category'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
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

    public function search(){

        if($this->request->getData('coo') != ''&&
            $this->request->getData('price') != '')
            {

                $products = $this->Products->find('all')

                    ->where(['product_country_of_origin LIKE' => "%".
                        $this->request->getData('coo')."%",
                        'poduct_sale_price <'=>$this->request->getData('price')])
                    ->order(['product_country_of_origin' => 'asc'])
                    ->contain(['Category']);
        }else if($this->request->getData('coo') != '' && $this->request->getData('price') == ''){
            $products = $this->Products->find('all')

                ->where(['product_country_of_origin LIKE' => "%".
                    $this->request->getData('coo')."%"])
                ->order(['product_country_of_origin' => 'asc'])
                ->contain(['Category']);
        }else if($this->request->getData('coo') == '' && $this->request->getData('price') != ''){
            $products = $this->Products->find('all')
            ->where(['poduct_sale_price <'=>$this->request->getData('price')])
                ->order(['product_country_of_origin' => 'asc'])
                ->contain(['Category']);
        }else{
            $this->paginate = [
                'contain' => ['Category']
            ];
            $products = $this->paginate($this->Products);


        }
        $this->set(compact('products'));



}
}

