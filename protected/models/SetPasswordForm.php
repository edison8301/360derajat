<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class SetPasswordForm extends CFormModel
{    
    public $password_baru;
    public $password_baru_konfirmasi;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            // name, email, subject and body are required
            array('password_baru, password_baru_konfirmasi', 'required','message'=>'{attribute} tidak boleh kosong'),            
            array('password_baru_konfirmasi','sama')
            // email has to be a valid email address
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return array(
            'password_baru_konfirmasi'=>'Password Baru (Konfirmasi)',
        );
    }




    public function sama()
    {
        if($this->password_baru!=$this->password_baru_konfirmasi)
        {
            $this->addError('password_baru_konfirmasi','Password baru (konfirmasi) tidak sesuai');
        }

        return true;
    }
}