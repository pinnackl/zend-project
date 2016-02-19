<?php

namespace Auth\Entity; //

use Doctrine\ORM\Mapping as ORM;
//
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Zend\Form\Annotation;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Auth\Entity\Repository\UserRepository")
 * @Annotation\Name("user")
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 */
class User
{
    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=100, nullable=false)
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":30}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[a-zA-Z][a-zA-Z0-9_-]{0,24}$/"}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Username:"})
     */
   private $usrName;

    /**
     * @var string
     *
     * @ORM\Column(name="user_password", type="string", length=100, nullable=false)
     * @Annotation\Attributes({"type":"password"})
     * @Annotation\Options({"label":"Password:"})
     */
    private $usrPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string", length=60, nullable=false)
     * @Annotation\Type("Zend\Form\Element\Email")
     * @Annotation\Options({"label":"Your email address:"})
     */
    private $usrEmail;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_role_id", type="integer", nullable=true)
     * @ORM\OneToMany(targetEntity="user_roles")
     * @ORM\JoinColumn(name="user_role_id", referencedColumnName="user_role_id")
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Options({
     * "label":"User Role:",
     * "value_options":{ "0":"Select Role", "1":"Public", "2": "Member"}})
     */
    private $usrlId;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_theme_id", type="integer", nullable=true)
     * @ORM\OneToOne(targetEntity="user_themes")
     * @ORM\JoinColumn(name="theme_id", referencedColumnName="theme_id")
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Options({
     * "label":"User Role:",
     * "value_options":{ "0":"Theme 1", "1":"Theme 2 ", "2": "theme 3"}})
     */
    private $usrthId;

    /**
     * @var integer
     *
     * @ORM\Column(name="lang_id", type="integer", nullable=true)
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Language Id:"})
     */
    private $lngId;


    /**
     * @var string
     *
     * @ORM\Column(name="user_picture", type="string", length=255, nullable=true)
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"User Picture:"})
     */
    private $usrPicture;

    /**
     * @var string
     *
     * @ORM\Column(name="user_password_salt", type="string", length=100, nullable=true)
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Password Salt:"})
     */
    //private $usrPasswordSalt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_registration_date", type="datetime", nullable=true)
     * @Annotation\Attributes({"type":"datetime","min":"2010-01-01T00:00:00Z","max":"2020-01-01T00:00:00Z","step":"1"})
     * @Annotation\Options({"label":"Registration Date:", "format":"Y-m-d\TH:iP"})
     */
    private $usrRegistrationDate; // = '2013-07-30 00:00:00'; // new \DateTime() - coses synatx error


    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Annotation\Exclude()
     */
    private $usrId;

    public function __construct()
    {
        $this->usrRegistrationDate = new \DateTime();
    }

    /**
     * Set usrName
     *
     * @param string $usrName
     * @return Users
     */
    public function setUsrName($usrName)
    {
        $this->usrName = $usrName;

        return $this;
    }

    /**
     * Get usrName
     *
     * @return string
     */
    public function getUsrName()
    {
        return $this->usrName;
    }

    /**
     * Set usrPassword
     *
     * @param string $usrPassword
     * @return Users
     */
    public function setUsrPassword($usrPassword)
    {
        $this->usrPassword = $usrPassword;

        return $this;
    }

    /**
     * Get usrPassword
     *
     * @return string
     */
    public function getUsrPassword()
    {
        return $this->usrPassword;
    }

    /**
     * Set usrEmail
     *
     * @param string $usrEmail
     * @return Users
     */
    public function setUsrEmail($usrEmail)
    {
        $this->usrEmail = $usrEmail;

        return $this;
    }

    /**
     * Get usrEmail
     *
     * @return string
     */
    public function getUsrEmail()
    {
        return $this->usrEmail;
    }

    /**
     * Set usrlId
     *
     * @param integer $usrlId
     * @return Users
     */
    public function setUsrlId($usrlId)
    {
        $this->usrlId = $usrlId;

        return $this;
    }

    /**
     * Get usrlId
     *
     * @return integer
     */
    public function getUsrlId()
    {
        return $this->usrlId;
    }

    /**
     * Set usrlId
     *
     * @param integer $usrthId
     * @return Users
     */
    public function setUsrthId($usrthId)
    {
        $this->usrlId = $usrthId;

        return $this;
    }

    /**
     * Get usrthId
     *
     * @return integer
     */
    public function getUsrthId()
    {
        return $this->usrthId;
    }

    /**
     * Set lngId
     *
     * @param integer $lngId
     * @return Users
     */
    public function setLngId($lngId)
    {
        $this->lngId = $lngId;

        return $this;
    }

    /**
     * Get lngId
     *
     * @return integer
     */
    public function getLngId()
    {
        return $this->lngId;
    }

    /**
     * Set usrActive
     *
     * @param boolean $usrActive
     * @return Users
     */
    public function setUsrActive($usrActive)
    {
        $this->usrActive = $usrActive;

        return $this;
    }

    /**
     * Get usrActive
     *
     * @return boolean
     */
    public function getUsrActive()
    {
        return $this->usrActive;
    }

    /**
     * Set usrQuestion
     *
     * @param string $usrQuestion
     * @return Users
     */
    public function setUsrQuestion($usrQuestion)
    {
        $this->usrQuestion = $usrQuestion;

        return $this;
    }

    /**
     * Get usrQuestion
     *
     * @return string
     */
    public function getUsrQuestion()
    {
        return $this->usrQuestion;
    }

    /**
     * Set usrAnswer
     *
     * @param string $usrAnswer
     * @return Users
     */
    public function setUsrAnswer($usrAnswer)
    {
        $this->usrAnswer = $usrAnswer;

        return $this;
    }

    /**
     * Get usrAnswer
     *
     * @return string
     */
    public function getUsrAnswer()
    {
        return $this->usrAnswer;
    }

    /**
     * Set usrPicture
     *
     * @param string $usrPicture
     * @return Users
     */
    public function setUsrPicture($usrPicture)
    {
        $this->usrPicture = $usrPicture;

        return $this;
    }

    /**
     * Get usrPicture
     *
     * @return string
     */
    public function getUsrPicture()
    {
        return $this->usrPicture;
    }


    /**
     * Set usrRegistrationDate
     *
     * @param string $usrRegistrationDate
     * @return Users
     */
    public function setUsrRegistrationDate($usrRegistrationDate)
    {
        $this->usrRegistrationDate = $usrRegistrationDate;

        return $this;
    }

    /**
     * Get usrRegistrationDate
     *
     * @return string
     */
    public function getUsrRegistrationDate()
    {
        return $this->usrRegistrationDate;
    }


    /**
     * Get usrId
     *
     * @return integer
     */
    public function getUsrId()
    {
        return $this->usrId;
    }


}