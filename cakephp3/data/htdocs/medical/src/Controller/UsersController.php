<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public $components = ["Test"=>[]];

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['login','add']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {

                $this->Auth->setUser($user);
                // if ($user['role'] == "user") {
                    return $this->redirect(['action' => 'index']);
                // }else if($user['role'] == "admin"){
                //     return $this->redirect(['action' => 'indexadmin']);
                // }
                //return $this->Auth->redirect($this->Auth->login());
            }else{
                $this->Flash->error(__('ログインできません。'));
            }
        }
    }

    public function logout()
    {
        $this->request->getSession()->destroy();
        return $this->redirect($this->Auth->logout());
    }

    public function isAuthorized($user)
    {
        return true;
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        //$this->Test = $this->loadComponent('Test');
        //$data = $this->Test->test();
        $user = $this->Auth->user('id');
        $sex = $this->Auth->user('sex');
        $this->set(compact('user','sex'));
    }

    public function index2()
    {
        $data = $this->Test->test();
        $user = $this->Auth->user('id');
        $sex = $this->Auth->user('sex');
        $this->set(compact('user','sex','data'));
    }

    /**
     * Indexadmin method
     *
     * @return \Cake\Http\Response|null
     */
    public function indexadmin()
    {
        $user = $this->Auth->user('id');
        $sex = $this->Auth->user('sex');
        $this->set(compact('user','sex'));
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [ 'Patients'],
        ]);
        $this->set('user', $user);
        $sex = $this->Auth->user('sex');
        $this->set(compact('sex'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $doctors = $this->Users->Doctors->find('list', ['limit' => 200]);
        $this->set(compact('user', 'doctors'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        $sex = $this->Auth->user('sex');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'view',$user->id]);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $doctors = $this->Users->Doctors->find('list', ['limit' => 200]);
        $this->set(compact('sex','user', 'doctors'));
    }

        /**
     * Editadmin method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editadmin($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        $sex = $this->Auth->user('sex');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'indexadmin']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $doctors = $this->Users->Doctors->find('list', ['limit' => 200]);
        $this->set(compact('user','sex', 'doctors'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
