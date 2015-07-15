<?php
namespace Application\Entity;

use Zend\Form\Annotation;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Annotation\Name("Student")
 * @ORM\Entity
 */
class Student
{

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required({"required":"true"})
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Filter({"name":"StringToUpper"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":"1"}})
     * @Annotation\Options({"label":"Id:"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required({"required":"true" })
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":"1"}})
     * @Annotation\Options({"label":"Name:"})
     * @ORM\Column(type="string") 
     */
    public $name;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required({"required":"true" })
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":"1"}})
     * @Annotation\Options({"label":"Surname:"})
     * @ORM\Column(type="string") 
     */
    public $surname;

    /**
     * @Annotation\Type("Zend\Form\Element\Radio")
     * @Annotation\Required({"required":"true" })
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Gender:",
     * "value_options" : {"1":"Male","2":"Female"}})
     * @Annotation\Validator({"name":"InArray",
     * "options":{"haystack":{"1","2"},
     * "messages":{"notInArray":"Gender is not valid"}}})
     * @Annotation\Attributes({"value":"1"})
     * @ORM\Column(type="integer") 
     */
    public $gender;

    /**
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Required({"required":"true" })
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Class:",
     * "value_options" : {"0":"Select a Class","1":"A","2":"B","3":"C"}})
     * @Annotation\Validator({"name":"InArray",
     * "options":{"haystack":{"1","2","3"},
     * "messages":{"notInArray":"Please Select a Class"}}})
     * @Annotation\Attributes({"value":"0"})
     * @ORM\Column(type="integer") 
     */
    public $class;

    
}