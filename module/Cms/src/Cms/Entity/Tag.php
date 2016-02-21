<?php
namespace Cms\Entity;

use Doctrine\ORM\Mapping as ORM;
//
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Zend\Form\Annotation;

/**
 * Tags
 *
 * @ORM\Table(name="tags")
 * @ORM\Entity
 * @Annotation\Name("tag")
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 */
class Tag
{
    /**
     * @var string
     *
     * @ORM\Column(name="tag_name", type="string", length=100, nullable=false)
	 * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":128}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[a-zA-Z][a-zA-Z0-9_-]{0,24}$/"}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Tag Name:"})	 
     */
    private $tagName;

    /**
	 * Bidirectional - Not neccessary !!! many tags to many Articles (INVERSE SIDE)
	 *
     * @ORM\ManyToMany(targetEntity="Cms\Entity\Article", mappedBy="tags")
	 * @Annotation\Exclude()
     */
    private $articles;


    /**
     * @var integer
     *
     * @ORM\Column(name="tag_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
	 * @Annotation\Exclude()
     */
    private $tagId;

    public function __construct() {
        $this->articles = new ArrayCollection();
    }

    public function __toString()
	{
		return $this->tagName;
	}	
	
    /**
     * Set tagName
     *
     * @param string $tagName
     * @return Tag
     */
    public function setTagName($tagName)
    {
        $this->tagName = $tagName;
    
        return $this;
    }

    /**
     * Get tagName
     *
     * @return string 
     */
    public function getTagName()
    {
        return $this->tagName;
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
     * Get tagId
     *
     * @return integer 
     */
    public function getTagId()
    {
        return $this->tagId;
    }
}