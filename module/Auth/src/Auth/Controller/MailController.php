<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Mail\Message;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mail\Transport\Smtp;

class MailController extends AbstractActionController
{
    public function initMail($action, $email, $username, $parameter=null)
    {
        $message = new Message();
        $message->addTo($email);
        $message->setFrom('zend-cms@mydomain.com');

        switch($action)
        {
            case "commentCreated" :
                $message->setBody('New comment for the article :'. $parameter);
                $message->setSubject('New comment');
                break;
            case "forgotPassword" :
                $message->setBody($username .", your password has been changed. Your new password is: " . $parameter);
                $message->setSubject('Forgot Password');
                break;
            case "accountCreated" :
                $message->setBody($username .", your account has been created.");
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
		
        try {
            $transport->send($message);
        }catch (\Exception $ex) {
           
        }
    }
}