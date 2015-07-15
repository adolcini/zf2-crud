<?php
namespace Application\Controller;

use Crud\Controller\CrudAbstractController;

class UserController extends CrudAbstractController
{

    protected $entityClass = '\Application\Entity\User';
}