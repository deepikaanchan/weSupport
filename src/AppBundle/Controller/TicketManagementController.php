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
        $params['url'] = Constants::ZOHO_CREATE_TICKET_URL;
        $params['headers'][] = "orgId:60001280952"; 
        $params['headers'][] = "Authorization:9446933330c7f886fbdf16782906a9e0";
 		$params['headers'][] = "Content-Type:application/json;";
        $params['headers'][] = "Accept:application/json";
        $curlResult = $this->container->get('curl_service')->curlPostAction($params,$requestStructure);
  
        // Save Logs and redirect to create ticket page again
        if($curlResult != false) {
        	$status = Constants::SUCCESS;
        	$this->saveTicketCreationLogs($requestStructure,$status,$curlResult,$userObj);
        	$this->addFlash("notice", ValidationMessages::TICKET_SUCCESS);
        	return $this->render('ManageTicket/createticket.html.twig',['user' => $userObj]);
        }else {
        	$status = Constants::ERROR;
        	$this->saveTicketCreationLogs($requestStructure,$status,$curlResult,$userObj);
        	$this->addFlash("error", ValidationMessages::SOMETHING_WENT_WRONG);
            return $this->render('ManageTicket/createticket.html.twig',['user' => $userObj]);
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
 		$params['url'] = Constants::ZOHO_CREATE_TICKET_URL;
        $params['headers'][] = "orgId:60001280952"; 
        $params['headers'][] = "Authorization:9446933330c7f886fbdf16782906a9e0";
 
        $curlResult = $this->container->get('curl_service')->curlGetAction($params);
        if($curlResult) {
        	return $this->render('ManageTicket/manageticket.html.twig',['masterData' => $curlResult]);
        }
    }
}