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
 * @ORM\Table(name="pages")
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $structure
 * @property string $block_element
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
     * @ORM\Column(type="string")
     */
    protected $structure;

    /**
     * @ORM\Column(type="string")
     */
    protected $block_element;


    /**
     * @ManyToOne(targetEntity="Category")
     * @JoinColumn(name="ctgr_id", referencedColumnName="ctgr_id")
     */
    protected $category;
    /**
     * Magic getter to expose protected properties.
     *
     * @param string $property
     * @return mixed
     */

    /**
     * @ManyToOne(targetEntity="Menu")
     * @JoinColumn(name="menu_id", referencedColumnName="menu_id")
     */
//    protected $menu;
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
     * @param Cms\Entity\Menu $menu
     */
//    public function setMenu($menu)
//    {
//        $this->menu = $menu;
//    }
    /**
     * @return Cms\Entity\Menu
     */
//    public function getMenu()
//    {
//        return $this->menu;
//    }
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
     * @param string $structure
     */
    public function setStructure($structure)
    {
        $this->structure = $structure;
    }
    /**
     * @return string
     */
    public function getStructure()
    {
        return $this->structure;
    }

    /**
     * @param string $block_element
     */
    public function setBlockElement($block_element)
    {
        $this->block_element = $block_element;
    }
    /**
     * @return string
     */
    public function getBlockElement()
    {
        return $this->block_element;
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
        $this->category = (isset($data['ctgr_id'])) ? $data['ctgr_id'] : null;
    }
    /**
     * Initialise et/ou retourne un objet de type InputFilter
     * qui contrôle les différents attributs d'un objet de type Page
     */
    public function getInputFilter() {

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