<?php

namespace AppBundle\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\RequestStructure;
use AppBundle\Utils\Constants\Constants;

class CurlService {

	public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->em= $this->container->get('doctrine')->getEntityManager();
      
    }


    public function fetchRequestStructure($type){
	    $structure = $this->em->getRepository('AppBundle:RequestStructure')->findOneBy(['requestKey' => $type]);

	    if(!empty($structure)){
	    	 return json_decode($structure->getRequestStructure(),true);
	    } else {
	    	return;
	    }
	 }

	 public function parseRequestForHelpDesk($data,$type){
    	
    	$requestStructure = $this->container->get('curl_service')->fetchRequestStructure(Constants::$ticketTypes[$type]);
		switch($type) {
			case Constants::create :
							$requestStructure['departmentId'] = $data['department'];
							$requestStructure['category'] = $data['category'];
							$requestStructure['subject'] = $data['subject'];
							$requestStructure['description'] = $data['description'];
							$requestStructure['priority'] = Constants::$priorityList[$data['selectedPriority']];
							$requestStructure['email'] = $data['userName'];
			break;
		}
		return $requestStructure;
    }

    public function curlGetAction($params) {
          try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $params['url']);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $params['headers']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
        } catch (\Exception $e) {
            dump($e->getMessage());die;
            return false;
        }
        $result = json_decode($result,true);
        return $result;
    }

    public function curlPostAction($params, $apiRequest) {

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $params['url']);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $params['headers']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $apiRequest);
            $result = curl_exec($ch);
        } catch (\Exception $e) {
            dump($e->getMessage());die;
            return false;
        }
        return $result;
    }
    
}
