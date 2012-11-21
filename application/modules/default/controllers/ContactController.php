<?php

class ContactController extends Zend_Controller_Action{
    public function init(){
        $this->view->doctype('XHTML1_STRICT');
    }
    
    public function indexAction(){
        $form = new Square_Form_Contact();
        $this->view->form = $form;
        
        if($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getPost())){
                $values = $form->getValues();
                $mail = new Zend_Mail();
                $mail->setBodyText($values['message']);
                $mail->setFrom($values['email'],$values['name']);
                $mail->addTo('i-working@mail.ru');
                $mail->setSubject('Contact form submission');
                $mail->send();
                $this->_helper->getHelper('FlashMessenger')
                              ->addMessage('Спасибо собщение отправлено');
                      $this->_redirect('/contact/success');
            }
        }
    }
    public function  successAction(){
        if ($this->_helper->getHelper('FlashMessenger')->getMessages()){
            $this->view->messages = 
            $this->_helper->getHelper('FlashMessenger')->getMessages();
        }else{
            $this->_redirect('/');
        }
    }
}
