<?php

namespace AppBundle\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Utils\CommonValidator\CommonValidator;

class UserService {

	public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
      
    }
	public function validateUser($requestData) {
		$result = true;
		foreach($requestData as $key => $data){
			switch($key){
				case "email": $result = $this->container->get('common_validator')->validateEmail($data);
				break;
				case "name": if(empty($data)) $result = false;
				break;
			}
			if($result ==  false) {
				return $result;
			}
		}
		return $result;
	}
}