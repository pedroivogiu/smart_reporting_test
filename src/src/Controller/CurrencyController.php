<?php
namespace App\Controller;

use App\Entity\Currency;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CurrencyController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function currency(): Response
    {
        return $this->render('currency/list.html.twig', []);
    }

    /**
     * @Route("/save", methods={"POST","HEAD"})
     */
    public function save(EntityManagerInterface $em){
        $Currency = new Currency();

        $response = new JsonResponse();

        try{
            $Currency->setInitialCurrency($_POST['initialCurrency']);
            $Currency->setFinalCurrency($_POST['finalCurrency']);
            $Currency->setInitialValue($_POST['initialValue']);
            $Currency->setFinalValue($_POST['finalValue']);   

            $em->persist($Currency);
            $em->flush(); 

            $response->setData(['status' => true]);
        }catch(\Exception $e){
            $response->setData(['status' => false]);
        }finally{
            return $response;
        }
    }

    /**
     * @Route("/getValues", methods={"GET"})
     */
    public function getValues() : Response {
        $EntityManager = $this->getDoctrine()->getManager();
        $Currencies = $EntityManager->getRepository(Currency::class)->findAll();

        return $this->json($Currencies);
    }
}
?>