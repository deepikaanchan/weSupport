<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Utils\Constants\Constants;
use AppBundle\Utils\Constants\ValidationMessages;
use AppBundle\Entity\TicketCreationCallLogs;


class TicketManagementController extends Controller
{
	

	 /**
     * @Route("/createTicket", name="create_ticket")
     */
    public function createTicketAction(Request $request)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$data = $request->request->all();
    	$type = Constants::create;
    	$method = Constants::METHOD_POST;

    	$userObj = $em->getRepository('AppBundle:Users')->findOneByUserName($data['userName']);
        $requestStructure = $this->container->get('curl_service')->parseRequestForHelpDesk($data,$type);
        $requestStructure = json_encode($requestStructure);
    //    $params['url'] = Constants::ZOHO_CREATE_TICKET_URL;
    //    $params['auth'] = 
    //    $curlResult = $this->container->get('curl_service')->curlPostAction($params,$requestStructure);
        $result = $curlResult = true;  // Will be removed once zoho API is integrated
        // Save Logs and redirect
        if($result != false) {
        	$status = Constants::SUCCESS;
        	$this->saveTicketCreationLogs($requestStructure,$status,$curlResult,$userObj);
        	$this->addFlash("notice", ValidationMessages::TICKET_SUCCESS);
        	return $this->render('ManageTicket/createticket.html.twig',['user' => $userObj]);
        }else {
        	$status = Constants::ERROR;
        	$this->saveTicketCreationLogs($requestStructure,$status,$curlResult,$userObj);
        	$this->addFlash("error", ValidationMessages::SOMETHING_WENT_WRONG);
            return $this->render('Security/login.html.twig');
        }
    }

    private function saveTicketCreationLogs($requestStructure,$status,$curlResult,$userObj) {
 		
 		$em = $this->getDoctrine()->getEntityManager();

    	$log = new TicketCreationCallLogs();
    	$log->setApiRequest($requestStructure);
    	$log->setApiResponse($curlResult);
    	$log->setStatus($status);
    	$log->setUserId($userObj);
    	$em->persist($log);
    	$em->flush();

    }

     /**
     * @Route("/listTicket", name="manage_ticket")
     */
    public function listTicketAction(Request $request)
    {
    
    	$userName = $request->request->get('userName');
    
    //    $params['url'] = Constants::ZOHO_CREATE_TICKET_URL;
    //    $params['auth'] = 
    //    $curlResult = $this->container->get('curl_service')->curlGetAction($params);
        $curlResult = true; // Will be removed once zoho API is integrated
        if($curlResult != false) {
        	return $this->render('ManageTicket/manageticket.html.twig');
        }
    }
}