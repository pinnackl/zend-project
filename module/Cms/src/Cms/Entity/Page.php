<?php
namespace Cms\Entity;
use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Stdlib\ArraySerializableInterface;

use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
/**
 * Page Entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="cms_page")
 * @property int $id
 * @property string $title
 * @property string $content
 */
class Page implements ArraySerializableInterface, InputFilterAwareInterface
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
    protected $title;
    /**
     * @ORM\Column(type="string")
     */
    protected $content;
    /**
     * @ManyToOne(targetEntity="Category")
     * @JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;
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
    /**
     * @param Cms\Entity\Category $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }
    /**
     * @return Cms\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
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
        $this->title = (isset($data['title'])) ? $data['title'] : null;
        $this->content = (isset($data['content'])) ? $data['content'] : null;
        $this->category = (isset($data['category_id'])) ? $data['category_id'] : null;
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
            $inputFilter -> add($factory -> createInput(array('name' => 'category_id', 'required' => false, 'filters' => array( array('name' => 'Int'), ), )));
            //Vérifie que le titre est de type text avec une
            //longueur de moins de 100 caractère
            //Retire aussi les espaces inutiles et les balises html
            $inputFilter -> add($factory -> createInput(array('name' => 'title', 'required' => true, 'filters' => array( array('name' => 'StripTags'), array('name' => 'StringTrim'), ), 'validators' => array( array('name' => 'StringLength', 'options' => array('encoding' => 'UTF-8', 'min' => 1, 'max' => 100, ), ), ), )));
            //Vérifie que le contenu est de type text avec une
            //longueur de moins de 10000 caractère
            //Retire aussi les espaces inutiles
            $inputFilter -> add($factory -> createInput(array('name' => 'content', 'required' => true, 'filters' => array( array('name' => 'StringTrim'), ), 'validators' => array( array('name' => 'StringLength', 'options' => array('encoding' => 'UTF-8', 'min' => 1, 'max' => 10000, ), ), ), )));
            $this -> inputFilter = $inputFilter;
        }
        return $this -> inputFilter;
    }
    /**
     * @param \Zend\InputFilter\InputFilterInterface $inputFilter
     * @return void|\Zend\InputFilter\InputFilterAwareInterface
     * @throws \Exception
     */
    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Les filtres sont définis directement dans la classe");
    }
}