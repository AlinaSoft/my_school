<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\User;
use AppBundle\Entity\Training;

class DefaultController extends Controller
{

    /**
 * @Route("/", name="homepage")
 */
    public function indexAction(Request $request)
    {

        $data = $request->request->all();
        if (isset($data["register"]) ){
            $repositoryUser = $this->getDoctrine()
                ->getRepository('AppBundle:User');
            $user = $repositoryUser->findByEmail($data["userEmail"]);
            $this->get('session')->set('UserId', $user[0]->getId());
            $this->get('session')->set('UserName', $user[0]->getName());
            $this->get('session')->set('UserSurname', $user[0]->getSurname());
            $this->get('session')->set('worker', $user[0]->getWorker());

        }
            $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Training');
        $training = $repository->findAllOrderedByTime();

        if (!$training) {
            throw $this->createNotFoundException(
                ''
            );
        }
        //var_dump($training);
        return $this->render('default/index.html.twig', [
            'Training' => $training
        ]);
    }

    /**
 * @Route("/registration/{TrainingId}", name="registration")
 */
    public function registrationAction(Request $request, $TrainingId)
    {
        $returnData = array();
        $em = $this->getDoctrine()->getManager();
        $repositoryUserTraining = $this->getDoctrine()
            ->getRepository('AppBundle:UserTraining');
        $returnData['TrainingUserCount'] = 0;
        $returnData['TrainingUserCount'] = $repositoryUserTraining->getUserCount()[0]['TrainingUserCount'];

        $data = $request->request->all();

        if (isset($data["Patvirtinti"]) ) {
            $returnData = $this->verificationRegistration($data, $returnData);
            if($returnData["request"]) {
                $user = new User();
                $user->setName($data['userName']);
                $user->setSurname($data['userSurname']);
                $user->setEmail($data['userEmail']);
                $user->setPhone($data['userPhone']);
                $user->setWorker(false);
                $em->persist($user);
                $em->flush();
                $this->get('session')->set('UserId', $user->getId());
                $this->get('session')->set('UserName', $user->getName());
                $this->get('session')->set('UserSurname', $user->getSurname());
                $this->get('session')->set('worker', false);
                $repositoryUserTraining->setUserInTraining($user->getId(),$TrainingId);
            }
        }
        if(!is_null($this->get('session')->get('UserId'))) {
            $repositoryUserTraining->setUserInTraining($this->get('session')->get('UserId'),$TrainingId);
        }

        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Training');
        $training = $repository->findById($TrainingId);

        if (!$training) {
            throw $this->createNotFoundException(
                ''
            );
        }

        $returnData['TrainingName'] = $training[0]->getTrainingName();
        $returnData['TrainingUserCountMax'] = $training[0]->getTrainingUserCount();
        $returnData['TrainingId'] = $training[0]->getId();

        return $this->render('default/registration.html.twig', [
            'data' => $returnData
        ]);
    }

    private function verificationRegistration($data, $returnData){
        $allFields = true;
        $verificate = true;
        if(!isset($data["userName"])) {
            $allFields = false;
        }
        if(!isset($data["userSurname"])) {
            $allFields = false;
        }
        if(!isset($data["userEmail"])) {
            $allFields = false;
        }
        if(!isset($data["userPhone"])) {
            $allFields = false;
        }else {
            if (!(substr($data["userPhone"],0,4) == '3706' || substr($data["userPhone"],0,1) == '6' || substr($data["userPhone"],0,2) == '86')){
                $verificate = false;
            }

        }
        if ($allFields && $verificate) {
            $returnData["request"] = true;
        }elseif($verificate) {
            $returnData["request"] = false;
            $returnData["message"] = 'Prašome užpildyti visus laukus';
        }else{
            $returnData["request"] = false;
            $returnData["message"] = 'Prašome patkrinti telefono numerį';
        }
        return $returnData;
    }

    /**
     * @Route("/userinformation", name="Vartotojo informacija")
     */
    public function userinformationAction(Request $request)
    {

        if (is_null($this->get('session')->get('UserId'))) {
            $this->get('session')->invalidate();
            return $this->redirectToRoute('homepage');
        }
        $returnData = array();
        $repositoryUser = $this->getDoctrine()
            ->getRepository('AppBundle:User');
        $data = $request->request->all();

        if ($this->get('session')->get('worker')) {
            if (isset($data["findUserTraining"])) {
                $user = $repositoryUser->findByEmail($data["userEmail"]);
                $returnData['userId'] = $user[0]->getId();
            }
        } else {
            $returnData['userId'] = $this->get('session')->get('UserId');
        }
        $repositoryUserTraining = $this->getDoctrine()
            ->getRepository('AppBundle:UserTraining');
        if (isset($data["cancel"]) ) {
            $returnData['cancel'] = $repositoryUserTraining->cancelUserTraining($data["userId"], $data["trainingId"]);
        }
        if (isset($returnData['userId'])){

            $repositoryUser = $this->getDoctrine()
                ->getRepository('AppBundle:User');
            $userTrainigs = $repositoryUser->findTrainings($returnData['userId']);
            if (is_null($userTrainigs[0])){$userTrainigs = array();}
            $returnData['Training'] = $userTrainigs;
        }
        return $this->render('default/userinformation.html.twig', [
            'data' => $returnData
        ]);
    }
    /**
     * @Route("/logoff", name="logoff")
     */
    public function logoffAction(Request $request)
    {
        $this->get('session')->invalidate();
        return $this->redirectToRoute('homepage');
    }

}
