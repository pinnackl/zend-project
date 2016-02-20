<?php

namespace DoctrineORMModule\Proxy\__CG__\Auth\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class User extends \Auth\Entity\User implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', '' . "\0" . 'Auth\\Entity\\User' . "\0" . 'usrName', '' . "\0" . 'Auth\\Entity\\User' . "\0" . 'usrPassword', '' . "\0" . 'Auth\\Entity\\User' . "\0" . 'usrEmail', '' . "\0" . 'Auth\\Entity\\User' . "\0" . 'usrlId', '' . "\0" . 'Auth\\Entity\\User' . "\0" . 'usrthId', '' . "\0" . 'Auth\\Entity\\User' . "\0" . 'lngId', '' . "\0" . 'Auth\\Entity\\User' . "\0" . 'usrPicture', '' . "\0" . 'Auth\\Entity\\User' . "\0" . 'usrRegistrationDate', '' . "\0" . 'Auth\\Entity\\User' . "\0" . 'usrId');
        }

        return array('__isInitialized__', '' . "\0" . 'Auth\\Entity\\User' . "\0" . 'usrName', '' . "\0" . 'Auth\\Entity\\User' . "\0" . 'usrPassword', '' . "\0" . 'Auth\\Entity\\User' . "\0" . 'usrEmail', '' . "\0" . 'Auth\\Entity\\User' . "\0" . 'usrlId', '' . "\0" . 'Auth\\Entity\\User' . "\0" . 'usrthId', '' . "\0" . 'Auth\\Entity\\User' . "\0" . 'lngId', '' . "\0" . 'Auth\\Entity\\User' . "\0" . 'usrPicture', '' . "\0" . 'Auth\\Entity\\User' . "\0" . 'usrRegistrationDate', '' . "\0" . 'Auth\\Entity\\User' . "\0" . 'usrId');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (User $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function setUsrName($usrName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUsrName', array($usrName));

        return parent::setUsrName($usrName);
    }

    /**
     * {@inheritDoc}
     */
    public function getUsrName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsrName', array());

        return parent::getUsrName();
    }

    /**
     * {@inheritDoc}
     */
    public function setUsrPassword($usrPassword)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUsrPassword', array($usrPassword));

        return parent::setUsrPassword($usrPassword);
    }

    /**
     * {@inheritDoc}
     */
    public function getUsrPassword()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsrPassword', array());

        return parent::getUsrPassword();
    }

    /**
     * {@inheritDoc}
     */
    public function setUsrEmail($usrEmail)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUsrEmail', array($usrEmail));

        return parent::setUsrEmail($usrEmail);
    }

    /**
     * {@inheritDoc}
     */
    public function getUsrEmail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsrEmail', array());

        return parent::getUsrEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function setUsrlId($usrlId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUsrlId', array($usrlId));

        return parent::setUsrlId($usrlId);
    }

    /**
     * {@inheritDoc}
     */
    public function getUsrlId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsrlId', array());

        return parent::getUsrlId();
    }

    /**
     * {@inheritDoc}
     */
    public function setUsrthId($usrthId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUsrthId', array($usrthId));

        return parent::setUsrthId($usrthId);
    }

    /**
     * {@inheritDoc}
     */
    public function getUsrthId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsrthId', array());

        return parent::getUsrthId();
    }

    /**
     * {@inheritDoc}
     */
    public function setLngId($lngId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLngId', array($lngId));

        return parent::setLngId($lngId);
    }

    /**
     * {@inheritDoc}
     */
    public function getLngId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLngId', array());

        return parent::getLngId();
    }

    /**
     * {@inheritDoc}
     */
    public function setUsrActive($usrActive)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUsrActive', array($usrActive));

        return parent::setUsrActive($usrActive);
    }

    /**
     * {@inheritDoc}
     */
    public function getUsrActive()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsrActive', array());

        return parent::getUsrActive();
    }

    /**
     * {@inheritDoc}
     */
    public function setUsrQuestion($usrQuestion)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUsrQuestion', array($usrQuestion));

        return parent::setUsrQuestion($usrQuestion);
    }

    /**
     * {@inheritDoc}
     */
    public function getUsrQuestion()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsrQuestion', array());

        return parent::getUsrQuestion();
    }

    /**
     * {@inheritDoc}
     */
    public function setUsrAnswer($usrAnswer)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUsrAnswer', array($usrAnswer));

        return parent::setUsrAnswer($usrAnswer);
    }

    /**
     * {@inheritDoc}
     */
    public function getUsrAnswer()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsrAnswer', array());

        return parent::getUsrAnswer();
    }

    /**
     * {@inheritDoc}
     */
    public function setUsrPicture($usrPicture)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUsrPicture', array($usrPicture));

        return parent::setUsrPicture($usrPicture);
    }

    /**
     * {@inheritDoc}
     */
    public function getUsrPicture()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsrPicture', array());

        return parent::getUsrPicture();
    }

    /**
     * {@inheritDoc}
     */
    public function setUsrRegistrationDate($usrRegistrationDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUsrRegistrationDate', array($usrRegistrationDate));

        return parent::setUsrRegistrationDate($usrRegistrationDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getUsrRegistrationDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsrRegistrationDate', array());

        return parent::getUsrRegistrationDate();
    }

    /**
     * {@inheritDoc}
     */
    public function getUsrId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getUsrId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsrId', array());

        return parent::getUsrId();
    }

}
