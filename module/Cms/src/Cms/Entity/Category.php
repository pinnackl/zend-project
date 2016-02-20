<?php
namespace Cms\Entity;

use Doctrine\ORM\Mapping as ORM;
//
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Zend\Form\Annotation;

/**
 * Categories
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity
 * @Annotation\Name("category")
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 */
class Category
{
    /**
     * @var string
     *
     * @ORM\Column(name="ctgr_name", type="string", length=100, nullable=false)
	 * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":30}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[a-zA-Z][a-zA-Z0-9_-]{0,24}$/"}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Category Name:"})	 
     */
    private $ctgrName;

    /**
	 * Bidirectional - Not neccessary !!! many categories to many Articles (INVERSE SIDE)
	 *
     * @ORM\ManyToMany(targetEntity="Cms\Entity\Article", mappedBy="categories")
	 * @Annotation\Exclude()
     */
    private $articles;

    /**
     * @var string
     *
     * @ORM\Column(name="ctgr_image_filename", type="text", nullable=true)
     *
     */
    private $ctgr_image_filename;

    /**
     * @var integer
     *
     * @ORM\Column(name="ctgr_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
	 * @Annotation\Exclude()
     */
    private $ctgrId;

    public function __construct() {
        $this->articles = new ArrayCollection();
    }

    public function __toString()
	{
		return $this->ctgrName;
	}	
	
    /**
     * Set ctgrName
     *
     * @param string $ctgrName
     * @return Category
     */
    public function setCtgrName($ctgrName)
    {
        $this->ctgrName = $ctgrName;
    
        return $this;
    }

    /**
     * Get ctgrName
     *
     * @return string 
     */
    public function getCtgrName()
    {
        return $this->ctgrName;
    }

    /**
     * Get articles
     *
     * @return array 
     */	
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Add article
     *
     * @return Collection 
     */	
	public function addArticle(\Cms\Entity\Article $article)
	{
		return $this->articles[] = $article;
	}
	
	public function removeArticle(\Cms\Entity\Article $article)
	{
		$this->articles->removeElement($article);
	}
	
    /**
     * Get ctgrId
     *
     * @return integer 
     */
    public function getCtgrId()
    {
        return $this->ctgrId;
    }
}