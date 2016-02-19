<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Mail\Message;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mail\Transport\Smtp;

class MailController extends AbstractActionController
{
    public function initMail($action, $email)
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