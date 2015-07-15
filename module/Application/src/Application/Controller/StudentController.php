<?php
namespace Application\Controller;

use Crud\Controller\CrudAbstractController;

class StudentController extends CrudAbstractController
{
    protected $entityClass = '\Application\Entity\Student';
    
}