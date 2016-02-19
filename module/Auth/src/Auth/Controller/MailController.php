<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Mail\Message;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mail\Transport\Smtp;

class MailController extends AbstractActionController
{
    public function initMail($action, $email, $password=null)
    {
        $message = new Message();
        $message->addTo($email);
        $message->setFrom('zend-cms@mydomain.com');

        switch($action)
        {
            case "commentCreated" :
                $message->setBody('This is the body');
                $message->setSubject('Test subject');
                break;
            case "forgotPassword" :
                $message->setBody("Your password has been changed. Your new password is: " . $password);
                $message->setSubject('Forgot Password');
                break;
            case "accountCreated" :
                $message->setBody("Your account has been created.");
                $message->setSubject('Account created');
                break;
        }
		
        
        $this->sendMail($message);
    }
    
    public function sendMail($message)
    {
        $smtpOptions = new SmtpOptions();
		$smtpOptions->setHost('smtp.numericable.fr')
			->setName('smtp.numericable.fr');

		$transport = new Smtp($smtpOptions);
		$transport->send($message);
    }
}