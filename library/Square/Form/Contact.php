<?php

class Square_Form_Contact extends Zend_Form{
    public function init(){
        $this->setAction('/contact/index')
             ->setMethod('post');
        
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name: ')
             ->setOptions(array('size'=>'35'))
             ->setRequired(TRUE)
             ->addValidator('Alpha',TRUE,array(
                 'messages'=>array(
                 Zend_Validate_Alpha::INVALID
                    =>"Помилка: невірне ім’я",
                 Zend_Validate_Alpha::NOT_ALPHA
                    =>"Помилка: містить недопустимі символи",
                 Zend_Validate_Alpha::STRING_EMPTY
                    =>"Помилка: не може бути пустим"
                 )
             ))
             ->addFilter('HtmlEntities')
             ->addFilter('StringTrim');
        
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email adres: ')
             ->setOptions(array('size'=>'50'))
             ->setRequired(TRUE)
             ->addValidator('EmailAddress',TRUE,array(
                 'messages'=>array(
                     Zend_Validate_EmailAddress::INVALID=>"Помилка: Не вірний E-mail",
                     Zend_Validate_EmailAddress::INVALID_FORMAT=>"Помилка: Не вірний E-mail",
                     Zend_Validate_EmailAddress::INVALID_HOSTNAME=>"Помилка: Не вірний Host",
                     Zend_Validate_EmailAddress::INVALID_LOCAL_PART=>"Помилка: Не вірний Username",
                     Zend_Validate_EmailAddress::LENGTH_EXCEEDED=>"Помилка: E-mail занадто довгий"
                 )
             ))
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
                'imgUrl'=>'images/captcha',
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
