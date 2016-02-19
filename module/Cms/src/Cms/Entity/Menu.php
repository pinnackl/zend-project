<?php
namespace Cms\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Zend\Form\Annotation;

/**
 * Menus
 *
 * @ORM\Table(name="menus")
 * @ORM\Entity
 * @Annotation\Name("menu")
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 */
class Menu
{
    /**
     * @var string
     *
     * @ORM\Column(name="menu_name", type="string", length=100, nullable=false)
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":30}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[a-zA-Z][a-zA-Z0-9_-]{0,24}$/"}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Menu Name:"})
     */
    private $menu_name;

    /**
     * @var integer
     *
     * @ORM\Column(name="menu_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Annotation\Exclude()
     */
    private $menu_id;


    /**
     * @var string
     *
     * @ORM\Column(name="menu_active", type="integer", nullable=false)
     * @Annotation\Options({"label":"Active:"})
     */
    private $menu_active;

    /**
     * @ORM\Column(type="string")
     */
    protected $order;

    public function __construct() {
        $this->pages = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->menu_name;
    }


    /**
     * @param string $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }
    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set menu_name
     *
     * @param string $menu_name
     * @return Menu
     */
    public function setMenuName($menu_name)
    {
        $this->menu_name = $menu_name;

        return $this;
    }

    /**
     * Get menu_name
     *
     * @return string
     */
    public function getMenuName()
    {
        return $this->menu_name;
    }

    /**
     * Get articles
     *
     * @return array
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Add page
     *
     * @return Collection
     */
    public function addPage(\Cms\Entity\Page $page)
    {
        return $this->pages[] = $page;
    }

    public function removePage(\Cms\Entity\Page $page)
    {
        $this->pages->removeElement($page);
    }

    /**
     * Get menuId
     *
     * @return integer
     */
    public function getMenuId()
    {
        return $this->menu_id;
    }

    /**
     * Get menuActive
     *
     * @return integer
     */
    public function getMenuActive()
    {
        return $this->menu_active;
    }
}