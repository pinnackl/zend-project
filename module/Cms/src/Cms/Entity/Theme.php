<?php
namespace Cms\Entity;

use Doctrine\ORM\Mapping as ORM;
// added by Stoyan
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Zend\Form\Annotation; // !!!! Absolutely neccessary

/**
 * Categories
 *
 * @ORM\Table(name="themes")
 * @ORM\Entity
 * @Annotation\Name("theme")
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 */
class Theme
{
    /**
     * @var string
     *
     * @ORM\Column(name="theme_name", type="string", length=100, nullable=false)
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":30}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[a-zA-Z][a-zA-Z0-9_-]{0,24}$/"}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Theme Name:"})
     */
    private $theme_name;

    /**
     * @var integer
     *
     * @ORM\Column(name="theme_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Annotation\Exclude()
     */
    private $theme_id;

    public function __construct() {
        $this->articles = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->theme_name;
    }

    /**
     * Set ctgrName
     *
     * @param string $theme_name
     * @return Category
     */
    public function setThemeName($theme_name)
    {
        $this->theme_name = $theme_name;

        return $this;
    }

    /**
     * Get ctgrName
     *
     * @return string
     */
    public function getThemeName()
    {
        return $this->theme_name;
    }


    /**
     * Get ctgrId
     *
     * @return integer
     */
    public function getThemeId()
    {
        return $this->theme_id;
    }
}