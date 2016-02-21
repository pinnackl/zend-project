<?php

namespace Cms\Entity;

use Doctrine\ORM\Mapping as ORM;
//
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Zend\Form\Annotation;

/**
 * Comment
 *
 * @ORM\Table(name="comments")
 * @ORM\Entity(repositoryClass="Cms\Entity\Repository\CommentRepository")
 * @Annotation\Name("comment")
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 */
class Comment
{	
    /**
     * @var Cms\Entity\Language
     *
	 * @ORM\ManyToOne(targetEntity="Cms\Entity\Language")
	 * @ORM\JoinColumn(name="lang_id", referencedColumnName="lang_id")
	 *
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
     * @var string
     *
     * @ORM\Column(name="com_email", type="string", length=64, nullable=false)
	 * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":64}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Email:"})	 
     */
    private $comEmail;
    
    /**
     * @var string
     *
     * @ORM\Column(name="com_username", type="string", length=64, nullable=false)
	 * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":128}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Email:"})	 
     */
    private $comUsername;

    /**
     * @var Cms\Entity\Article
     *
	 * @ORM\ManyToOne(targetEntity="Cms\Entity\Article", inversedBy="comments")
	 * @ORM\JoinColumn(name="art_id", referencedColumnName="art_id")
	 * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
	 * @Annotation\Options({
	 * "label":"Article:",
	 * "empty_option": "Please, choose the Article",
	 * "target_class":"Cms\Entity\Article",
	 * "property": "artcTitle"})
     */
    private $article;
	
    /**
     * @var string
     *
     * @ORM\Column(name="com_title", type="string", length=100, nullable=false)
	 * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":100}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[a-zA-Z][a-zA-Z0-9_-]{0,24}$/"}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Title:"})	 
     */
    private $comTitle;


    /**
     * @var string
     *
     * @ORM\Column(name="com_active", type="integer", nullable=false)
     */
    private $comActive;
	
    /**
     * @var string
     *
     * @ORM\Column(name="com_text", type="text", nullable=true)
     * @Annotation\Attributes({"type":"textarea"})
     * @Annotation\Options({"label":"COmmentaire:"})
     */
    private $comText;
	
    /**
     * @var DateTime
     *
     * @ORM\Column(name="com_created", type="datetime", nullable=true)
     * @Annotation\Attributes({"type":"Zend\Form\Element\DateTime", "min":"2010-01-01T00:00:00Z", "max":"2020-01-01T00:00:00Z", "step":"1"})
     * @Annotation\Options({"label":"Date\Time:", "format":"Y-m-d\TH:iP"})	 
     */
    private $comCreated;
	
    /**
     * @var integer
     *
     * @ORM\Column(name="com_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
	 * @Annotation\Exclude()
     */
    private $comId;

    public function __construct() {

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
     * @return Cms\Entity\Comment
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
     * Get comEmail
     *
     * @return string 
     */
    public function getComEmail()
    {
        return $this->comEmail;
    }

    /**
     * Set comEmail
     *
     * @param string $comEmail
     * @return Article
     */
    public function setComEmail($comEmail)
    {
        $this->comEmail = $comEmail;
    
        return $this;
    }
    
    /**
     * Get comUsername
     *
     * @return string 
     */
    public function getComUsername()
    {
        return $this->comUsername;
    }

    /**
     * Set comUsername
     *
     * @param string $comUsername
     * @return Article
     */
    public function setComUsername($comUsername)
    {
        $this->comUsername = $comUsername;
    
        return $this;
    }

    /**
     * Set article
     *
     * @param Cms\Entity\Article $article
     * @return Cms\Entity\Comment
     */
    public function setArticle($article)
    {
        $this->article = $article;
    
        return $this;
    }

    /**
     * Get article
     *
     * @return Cms\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }	
	
    /**
     * Get comTitle
     *
     * @return string 
     */
    public function getComTitle()
    {
        return $this->comTitle;
    }

    /**
     * Set comTitle
     *
     * @param string $comTitle
     * @return Article
     */
    public function setComTitle($comTitle)
    {
        $this->comTitle = $comTitle;
    
        return $this;
    }

    /**
     * Get comText
     *
     * @return string 
     */
    public function getComText()
    {
        return $this->comText;
    }

    /**
     * Set comText
     *
     * @param string $comText
     * @return Comment
     */
    public function setComText($comText)
    {
        $this->comText = $comText;
    
        return $this;
    }

    /**
     * Get comCreated
     *
     * @return DateTime 
     */
    public function getComCreated()
    {
        return $this->comCreated;
    }

    /**
     * Set comCreated
     *
     * @param DateTime $comCreated
     * @return Comment
     */
    public function setComCreated($comCreated)
    {
        $this->comCreated = $comCreated;
    
        return $this;
    }
	
    /**
     * Get comId
     *
     * @return integer 
     */
    public function getComId()
    {
        return $this->comId;
    }


    /**
     * Get comId
     *
     * @return integer
     */
    public function getComActive()
    {
        return $this->comActive;
    }
}
