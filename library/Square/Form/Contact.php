<?php

class Square_Form_Contact extends Zend_Form{
    public function init(){
        $this->setAction('/public/contact/index')
             ->setMethod('post');
        
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name: ')
             ->setOptions(array('size'=>'35'))
             ->setRequired(TRUE)
             ->addValidator('NotEmpty',TRUE)
             ->addValidator('Alpha',TRUE)
             ->addFilter('HtmlEntities')
             ->addFilter('StringTrim');
        
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email adres: ')
             ->setOptions(array('size'=>'50'))
             ->setRequired(TRUE)
             ->addValidator('NotEmpty',TRUE)
             ->addValidator('EmailAddress',TRUE)
             ->addFilter('StringToLower')
             ->addFilter('StringTrim');
        
        $message = new Zend_Form_Element_Text('message');
        $message->setLabel('Message: ')
             ->setOptions(array('rows'=>'8','cols'=>'40'))
             ->setRequired(TRUE)
             ->addValidator('NotEmpty',TRUE)
             ->addFilter('HtmlEntities')
             ->addFilter('StringTrim');
        
        $captha = new Zend_Form_Element_Captcha('captcha',array(
            'captcha'=>array(
                'captcha'=>'Image', 
                'font'=>'fonts/aBosaNova.ttf',
                'fontSize'=>'70',
                'width'=>300,
                'height'=>100,
                'wordLen'=>3,
                'timeout'=>300,
                'imgUrl'=>'public/images/captcha',
                'imgDir'=>'images/captcha',
                'expiration'    => 300, // время жизни капчи
                
            )
        ));
        $captha->setLabel('Проверка капчи: ');
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setOptions(array('class'=>'submit'));
        
        $this->addElement($name)
             ->addElement($email)
             ->addElement($message)
             ->addElement($captha)
             ->addElement($submit);
    }
}
