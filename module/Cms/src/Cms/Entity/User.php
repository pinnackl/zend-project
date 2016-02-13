<?php
namespace Cms\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Stdlib\ArraySerializableInterface;

/**
 * Category Entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="cms_user")
 * @property int $id
 * @property string $role
 */
class User implements ArraySerializableInterface, InputFilterAwareInterface
{
    protected $inputFilter;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $role;

    /**
     * @ORM\Column(type="string")
     */
    protected $first_name;

    /**
     * @ORM\Column(type="string")
     */
    protected $last_name;

    /**
     * @var string L'email
     * @ORM\Column(type="string", unique=true,  length=255, name="email")
     */
    protected $email;

    /**
     * Magic getter to expose protected properties.
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property)
    {
        return $this->$property;
    }

    /**
     * Magic setter to save protected properties.
     *
     * @param string $property
     * @param mixed $value
     */
    public function __set($property, $value)
    {
        $this->$property = $value;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setFirstName($name)
    {
        $this->frist_name = $name;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setLastName($name)
    {
        $this->last_name = $name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function exchangeArray(array $data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->email = (isset($data['email'])) ? $data['email'] : null;
        $this->first_name = (isset($data['first_name'])) ? $data['first_name'] : null;
        $this->last_name = (isset($data['last_name'])) ? $data['last_name'] : null;
    }

    /**
     * Initialise et/ou retourne un objet de type InputFilter
     * qui contrôle les différents attributs d'un objet de type Page
     */
    public function getInputFilter() {
        if (!$this -> inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

            //Vérifie que l'id est de type int
            $inputFilter -> add($factory -> createInput(array('name' => 'id', 'required' => true, 'filters' => array( array('name' => 'Int'), ), )));

            //Vérifie que le nom est de type text avec une
            //longueur de moins de 100 caractère
            //Retire aussi les espaces inutiles et les balises html
            $inputFilter -> add($factory -> createInput(array('name' => 'email', 'required' => true, 'filters' => array( array('name' => 'StripTags'), array('name' => 'StringTrim'), ), 'validators' => array( array('name' => 'StringLength', 'options' => array('encoding' => 'UTF-8', 'min' => 1, 'max' => 100, ), ), ), )));

            $this -> inputFilter = $inputFilter;
        }
        return $this -> inputFilter;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Les filtres sont définis directement dans la classe");
    }
}