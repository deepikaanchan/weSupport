<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Utils\Constants\Constants;
use AppBundle\Utils\Constants\ValidationMessages;
use AppBundle\Entity\Users;


class DefaultController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('Security/login.html.twig');
    }

     /**
     * @Route("/authlogin", name="auth_login")
     */
    public function loginAction(Request $request)
    {
       
        $data = $request->request->all();
        $em = $this->getDoctrine()->getEntityManager();

        $userDetails = $em->getRepository('AppBundle:Users')->findOneByUserName($data['email']);

        if(empty($userDetails)) {
            try {
                $validationResult = $this->get('user_service')->validateUser($data);

                if($validationResult == false) {
                    $this->addFlash("error", ValidationMessages::SOMETHING_WENT_WRONG);
                    return $this->render('Security/login.html.twig');
                }
                $user = new Users();
                $user->setName($data['name']);
                $user->setUserName($data['email']);
                $user->setIsActive(Constants::ACTIVE);
                $encoder = $this->container->get('security.password_encoder');
                $encodedPassword = $encoder->encodePassword($user, $data['password']);
                $user->setPassword($encodedPassword);

                $em->persist($user);

                $em->flush();
                return $this->render('ManageTicket/createticket.html.twig',['user' => $user]);
            }catch(\Exception $e) {
                dump($e->getMessage());die;
                $this->addFlash("error", ValidationMessages::SOMETHING_WENT_WRONG);
                return $this->render('Security/login.html.twig');
            }
        }else {
           
            if(password_verify($data['password'], $userDetails->getPassword())){
                return $this->render('ManageTicket/createticket.html.twig',['user' => $userDetails]);
            } else {
                $this->addFlash("error", "Invalid username or password");
                return $this->redirectToRoute('login');
            }
        }
       
    }
}
