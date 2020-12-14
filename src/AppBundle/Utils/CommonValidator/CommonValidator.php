<?php
namespace AppBundle\Utils\CommonValidator;

class CommonValidator
{

    public  static function validateEmail($data)
    {   
        if (!preg_match("/^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/", $data)) {
            return false;
        }
        return true;
    }

}
