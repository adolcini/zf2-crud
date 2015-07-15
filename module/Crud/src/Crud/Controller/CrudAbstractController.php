<?php
namespace Crud\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\Form\Element\Submit;
use Zend\View\Model\ViewModel;

abstract class CrudAbstractController extends AbstractActionController
{

    protected $entityClass;

    protected $entityPrototype;

    public function editAction()
    {
        $id = $this->params('id', 0);
        $entity = $this->getEntityManager()->find($this->entityClass, $id);
        $form = $this->createForm($entity);
        
        $viewModel = new ViewModel();
        $viewModel->setTemplate('crud/crud/edit');
        $viewModel->setVariables(array(
            'form' => $form
        ));
        
        return $viewModel;
    }
    
    public function addAction()
    {
        $form = $this->createForm();
        $viewModel = new ViewModel();
        $viewModel->setTemplate('crud/crud/add');
        $viewModel->setVariables(array(
            'form' => $form
        ));
        
        return $viewModel;
    }

    public function viewAction()
    {
        $id = $this->params('id', 0);
        $entity = $this->getEntityManager()->find($this->entityClass, $id);
        $form = $this->createForm(null, true);
        
        $viewModel = new ViewModel();
        $viewModel->setTemplate('crud/crud/view');
        $viewModel->setVariables(array(
            'form' => $form,
            'item' => $entity,
        ));
        
        return $viewModel;
    }
    
    public function listAction()
    {
        
        $items = $this->getEntityManager()->getRepository($this->entityClass)->findAll();
        
        $form = $this->createForm(null, true);

        $viewModel = new ViewModel();
        $viewModel->setTemplate('crud/crud/list');
        $viewModel->setVariables(array(
            'form' => $form,
            'items' => $items,
        ));
    
        return $viewModel;
    }

    public function saveAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $id = $this->params()->fromPost('id', 0);
            $entity = $this->getEntityManager()->find($this->entityClass, $id);
            if (!$entity) {
                $entity = $this->createEntity();
            }
            $form = $this->createForm($entity);
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getEntityManager()->persist($entity);
                $this->getEntityManager()->flush();
                
                return $this->redirect()->toRoute('application/default', array( 'action'=> 'view', 'id' => $entity->id), true);
                
            }
            var_dump($form->getMessages());
        }
        die('ciccio');
        return;
    }

    public function getEntityClass()
    {
        return $this->entityClass;
    }

    public function createEntity()
    {
        if (! $this->entityPrototype) {
            $className = $this->getEntityClass();
            $this->entityPrototype = new $className();
        }
        return clone $this->entityPrototype;
    }

    public function createForm($entity = null, $noBtn = null)
    {
        if (! $entity) {
            $entity = $this->createEntity();
        }
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($entity);
        
        $form->bind($entity);
        if (! $noBtn) {
            $submit = new Submit('submit');
            $submit->setValue('Save');
            $form->add($submit);
        }
        
        return $form;
    }

    /**
     *
     * @var DoctrineORMEntityManager
     */
    protected $em;

    /**
     * 
     * @return DoctrineORMEntityManager
     */
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }
}