<?php

namespace Cms\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Zend\Form\Annotation;

/**
 * Article
 *
 * @ORM\Table(name="articles")
 * @ORM\Entity(repositoryClass="Cms\Entity\Repository\ArticleRepository")
 * @Annotation\Name("article")
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 */
class Article
{
	/**
     * @ORM\OneToMany(targetEntity="Cms\Entity\Article", mappedBy="parent")
	 * @Annotation\Exclude()
     **/
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="Cms\Entity\Article", inversedBy="children")
     * @ORM\JoinColumn(name="art_parent_id", referencedColumnName="art_id")
	 * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
	 * @Annotation\Required(false)
	 * @Annotation\Options({
	 * "label":"Original Article:",
	 * "empty_option": "Please, choose the Original Article",
	 * "target_class":"Cms\Entity\Article",
	 * "property": "artcTitle"})
     **/
    private $parent = null;
	
    /**
     * @var Cms\Entity\Language
     *
	 * @ORM\ManyToOne(targetEntity="Cms\Entity\Language")
	 * @ORM\JoinColumn(name="lang_id", referencedColumnName="lang_id")
	 * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
	 * @Annotation\Options({
	 * "label":"Language:",
	 * "empty_option": "Please, choose your language",
	 * "target_class":"Cms\Entity\Language",
	 * "property": "lngName"})
     */
    private $language;

    /**
     * @var Auth\Entity\User
     *
	 * @ORM\ManyToOne(targetEntity="Auth\Entity\User")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
	 * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
	 * @Annotation\Options({
	 * "label":"Author:",
	 * "empty_option": "Please, choose the Author",
	 * "target_class":"Auth\Entity\User",
	 * "property": "usrName"})
     */
    private $author;
	
    /**
     * @var Cms\Entity\Resource
     *
	 * @ORM\ManyToOne(targetEntity="Cms\Entity\Resource")
	 * @ORM\JoinColumn(name="rs_id", referencedColumnName="rs_id")
	 * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
	 * @Annotation\Options({
	 * "label":"Resource:",
	 * "empty_option": "Please, choose the Resource",
	 * "target_class":"Cms\Entity\Resource",
	 * "property": "rsName"})
     */
    private $resource;
	
    /**
     * @var string
     *
     * @ORM\Column(name="art_title", type="string", length=100, nullable=false)
	 * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":100}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Title:"})	 
     */
    private $artcTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="art_slug", type="string", length=100, nullable=false)
	 * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":100}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[a-zA-Z][a-zA-Z0-9_-]{0,100}$/"}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Slug:"})	 
     */
    private $artcSlug;
	
    /**
     * @var string
     *
     * @ORM\Column(name="art_introtext", type="text", nullable=true)
     * @Annotation\Attributes({"type":"textarea"})
     * @Annotation\Options({"label":"Intro Text:"})	 
     */
    private $artcIntrotext;

    /**
     * @var string
     *
     * @ORM\Column(name="art_image_filename", type="text", nullable=true)
     *
     */
    private $art_image_filename;
	
    /**
     * @var string
     *
     * @ORM\Column(name="art_fulltext", type="text", nullable=true)
     * @Annotation\Attributes({"type":"textarea"})
     * @Annotation\Options({"label":"Full Text:"})	 
     */
    private $artcFulltext;
	
    /**
     * @var DateTime
     *
     * @ORM\Column(name="art_created", type="datetime", nullable=true)
     * @Annotation\Attributes({"type":"Zend\Form\Element\DateTime", "id": "artcCreated", "min":"2010-01-01T00:00:00Z", "max":"2020-01-01T00:00:00Z", "step":"1"})
     * @Annotation\Options({"label":"Date\Time:", "format":"Y-m-d\TH:iP"})	 
     */ 
    private $artcCreated;

    /**
     * @var Cms\Entity\Category
     *
	 * @ORM\ManyToMany(targetEntity="Cms\Entity\Category", inversedBy="articles")
     * @ORM\JoinTable(name="articles_categories",
     *      joinColumns={@ORM\JoinColumn(name="art_id", referencedColumnName="art_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="ctgr_id", referencedColumnName="ctgr_id")}
     *      )
	 * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
	 * @Annotation\Attributes({"multiple":true})
	 * @Annotation\Options({
	 * "label":"Categories:",
	 * "empty_option": "Please, choose the categories",
	 * "target_class":"Cms\Entity\Category",
	 * "property": "ctgrName"})
     */
    private $categories;
    
    /**
     * @var Cms\Entity\Tag
     *
	 * @ORM\ManyToMany(targetEntity="Cms\Entity\Tag", inversedBy="articles")
     * @ORM\JoinTable(name="articles_tags",
     *      joinColumns={@ORM\JoinColumn(name="art_id", referencedColumnName="art_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="tag_id")}
     *      )
	 * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
	 * @Annotation\Attributes({"multiple":true})
	 * @Annotation\Options({
	 * "label":"Tags:",
	 * "empty_option": "Please, choose the tags",
	 * "target_class":"Cms\Entity\Tag",
	 * "property": "tagName"})
     */
    private $tags;

    /**
     * @var Comment[]
     *
	 * @ORM\OneToMany(targetEntity="Cms\Entity\Comment", mappedBy="article")
	 * @Annotation\Exclude()
     */
    private $comments;
	
    /**
     * @var integer
     *
     * @ORM\Column(name="art_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
	 * @Annotation\Exclude()
     */
    private $artcId;

    public function __construct() {
        $this->children = new ArrayCollection; // \Doctrine\Common\Collections\ArrayCollection();
		$this->categories = new ArrayCollection;
		$this->comments = new ArrayCollection;
		$this->tags = new ArrayCollection;
		$this->artcCreated = new \DateTime();
    }
	
    /**
     * Set language
     *
     * @param Cms\Entity\Language $language
     * @return Article
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    
        return $this;
    }

    /**
     * Get language
     *
     * @return Cms\Entity\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set author
     *
     * @param Auth\Entity\User $author
     * @return Cms\Entity\Article
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    
        return $this;
    }

    /**
     * Get author
     *
     * @return Auth\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }	

    /**
     * Set resource
     *
     * @param Cms\Entity\Resource $resource
     * @return Cms\Entity\Article
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
    
        return $this;
    }

    /**
     * Get resource
     *
     * @return Cms\Entity\Resource
     */
    public function getResource()
    {
        return $this->resource;
    }
	
    /**
     * Get artcTitle
     *
     * @return string 
     */
    public function getArtcTitle()
    {
        return $this->artcTitle;
    }

    /**
     * Set artcTitle
     *
     * @param string $artcTitle
     * @return Article
     */
    public function setArtcTitle($artcTitle)
    {
        $this->artcTitle = $artcTitle;
    
        return $this;
    }

    /**
     * Get artcSlug
     *
     * @return string 
     */
    public function getArtcSlug()
    {
        return $this->artcSlug;
    }

    /**
     * Set artcSlug
     *
     * @param string $artcSlug
     * @return Article
     */
    public function setArtcSlug($artcSlug)
    {
        $this->artcSlug = $artcSlug;
    
        return $this;
    }

    /**
     * Get art_image_filename
     *
     * @return string
     */
    public function getArtcImageFilename()
    {
        return $this->art_image_filename;
    }

    /**
     * Set art_image_filename
     *
     * @param string $art_image_filename
     * @return Article
     */
    public function setArtcImageFilename($art_image_filename)
    {
        $this->art_image_filename = $art_image_filename;

        return $this;
    }

    /**
     * Get artcIntrotext
     *
     * @return string 
     */
    public function getArtcIntrotext()
    {
        return $this->artcIntrotext;
    }

    /**
     * Set artcIntrotext
     *
     * @param string $artcIntrotext
     * @return Article
     */
    public function setArtcIntrotext($artcIntrotext)
    {
        $this->artcIntrotext = $artcIntrotext;
    
        return $this;
    }

    /**
     * Get artcFulltext
     *
     * @return string 
     */
    public function getArtcFulltext()
    {
        return $this->artcFulltext;
    }

    /**
     * Set artcFulltext
     *
     * @param string $artcFulltext
     * @return Article
     */
    public function setArtcFulltext($artcFulltext)
    {
        $this->artcFulltext = $artcFulltext;
    
        return $this;
    }

    /**
     * Get artcCreated
     *
     * @return DateTime 
     */
    public function getArtcCreated()
    {
        return $this->artcCreated;
    }

    /**
     * Set artcCreated
     *
     * @param DateTime $artcCreated
     * @return Article
     */
    public function setArtcCreated($artcCreated)
    {
        $this->artcCreated = $artcCreated;
    
        return $this;
    }

    /**
     * Get categories
     *
     * @return Array
     */
    public function getCategories()
    {
		return $this->categories;
    }

    /**
     * Set categories
     *
     * @param array $categories
     * @return Article
     */
    public function setCategories($categories)
    {
		$this->categories = $categories; // NOT neccessary
    
        return $this;
    }
	
    /**
     * Add Catgories
     *
     * @param Collection $categories
     * @return Article
     */
    public function addCategories(Collection $categories)
	{
		foreach ($categories as $category) {
			$this->addCategory($category);
		}
		
		return $this;
	}

    /**
     * Add Catgory
     *
     * @param Cms\Entity\Category $category
     * @return Article
     */
	public function addCategory(\Cms\Entity\Category $category)
	{
		$category->addArticle($this); // synchronously updating inverse side
		$this->categories[] = $category;
		
		return $this;
	}
	
    /**
     * Remove Categories
     *
     * @param DateTime $artcCreated
     * @return Article
     */
    public function removeCategories(Collection $categories)
	{
		foreach ($categories as $category) {
			$this->removeCategory($category);
		}		
	
		return $this;
	}
	
    /**
     * Remove Category
     *
     * @param DateTime $artcCreated
     * @return Article
     */
	public function removeCategory(\Cms\Entity\Category $category)
	{
		$this->categories->removeElement($category);
		$category->removeArticle($this); // update the other site
		return $this;
	}
    
    /**
     * Get tags
     *
     * @return Array
     */
    public function getTags()
    {
		return $this->tags;
    }

    /**
     * Set tags
     *
     * @param array $tags
     * @return Article
     */
    public function setTags($tags)
    {
		$this->tags = $tags; // NOT neccessary
    
        return $this;
    }
	
    /**
     * Add Tags
     *
     * @param Collection $tags
     * @return Article
     */
    public function addTags(Collection $tags)
	{
		foreach ($tags as $tag) {
			$this->addTag($tag);
		}
		
		return $this;
	}

    /**
     * Add Tag
     *
     * @param Cms\Entity\Tag $tag
     * @return Article
     */
	public function addTag(\Cms\Entity\Tag $tag)
	{
		$tag->addArticle($this); // synchronously updating inverse side
		$this->tags[] = $tag;
		
		return $this;
	}
	
    /**
     * Remove Tags
     *
     * @param DateTime $artcCreated
     * @return Article
     */
    public function removeTags(Collection $tags)
	{
		foreach ($tags as $tag) {
			$this->removeTag($tag);
		}		
	
		return $this;
	}
	
    /**
     * Remove Tag
     *
     * @param DateTime $artcCreated
     * @return Article
     */
	public function removeTag(\Cms\Entity\Tag $tag)
	{
		$this->tags->removeElement($tag);
		$tag->removeArticle($this); // update the other site
		return $this;
	}

    /**
     * Get children
     *
     * @return Array
     */
    public function getChildren()
    {
		return $this->children;
    }

    /**
     * Set children
     *
     * @param array $children
     * @return Article
     */
    public function setChildren($children)
    {
		$this->children = $children; // NOT neccessary
    
        return $this;
    }

    /**
     * Add Child - translation
     *
     * @param Cms\Entity\Article $article
     * @return Article
     */
    public function addChildren(Collection $children)
	{
		foreach ($children as $child) {
			$this->addChild($child);
		}
		
		return $this;
	}

    /**
     * Add Child
     *
     * @param Cms\Entity\Article $child
     * @return Article
     */
	public function addChild(\Cms\Entity\Article $child)
	{
		$child->setParent($this); // synchronously updating inverse side
		$this->children[] = $child;
		
		return $this;
	}
	
    /**
     * Remove Children
     *
     * @param Collection $children
     * @return Article
     */
    public function removeChildren(Collection $children)
	{
		foreach ($children as $child) {
			$this->removeChild($child);
		}		
	
		return $this;
	}
	
    /**
     * Remove Child
     *
     * @param \Cms\Entity\Article $child
     * @return Article
     */
	public function removeChild(\Cms\Entity\Article $child)
	{
		$this->children->removeElement($child);
		$child->removeParent($this); // update the other site
		return $this;
	}

    /**
     * Get parent
     *
     * @return \Cms\Entity\Article
     */
    public function getParent()
    {
		return $this->parent;
    }

    /**
     * Set parent
     *
     * @param \Cms\Entity\Article $parent
     * @return Article
     */
    public function setParent($parent) //can be null in this case
    {
		//    public function setParent(\Cms\Entity\Article $parent) doesn't work with null parent
		$this->parent = $parent;
		// if ($parent) $parent->addChild($this); // Max nested functions update the inverse site
        return $this;
    }	

    /**
     * Remove parent
     *
     * @return Article
     */
    public function removeParent(\Cms\Entity\Article $parent)
    {
		$this->parent = null; 
		// $this->parent->removeElement($parent);
		// $parent->removeChild($this); // update othe site
	
        return $this;
    }	

    /**
     * Get comments
     *
     * @return Comment[]
     */
    public function getComments()
    {
		return $this->comments;
    }
	
    /**
     * Get artcId
     *
     * @return integer 
     */
    public function getArtcId()
    {
        return $this->artcId;
    }
}