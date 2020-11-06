<?php
namespace App\Controller;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WebserviceController extends AbstractController
{
    /**
     * @Route("/getCurrencies", methods={"GET"})
     */
    public function getCurrencies(): Response{
        $returnArray = array();
        try{
            $client = HttpClient::create();
            $response = $client->request('GET', 'https://free.currconv.com/api/v7/currencies?apiKey=2c4f68308168fbf5a700');
            $data = $response->toArray();
            if (!empty($data['results'])){
                foreach($data['results'] as $key => $value){
                    $returnArray['currencies'][$key]['value'] = $value['id'];
                    $returnArray['currencies'][$key]['label'] = $value['currencyName'];
                }

                $returnArray['status'] = true;
            }
        }catch(\Exception $e){
            $returnArray['status'] = false;
        }finally{
            return $this->json($returnArray);
        }
    }

    /**
     * @Route("/convert", methods={"POST"})
     */
    public function convert() : Response{

        $returnArray = array();
        try{
            $client = HttpClient::create();

            $initialCurrency = $_POST['initialCurrency'];
            $finalCurrency = $_POST['finalCurrency'];
            $initialValue = $_POST['initialValue'];

            $query = $initialCurrency."_".$finalCurrency;

            $response = $client->request('GET', 'https://free.currconv.com/api/v7/convert',[
                'query' => [
                    'q' => $query,
                    'apiKey' => '2c4f68308168fbf5a700'
                ],
            ]);
            $data = $response->toArray();
            if (!empty($data['results'])){
                foreach($data['results'] as $key => $value){
                    $returnArray['final_value'] = number_format($value['val'] * $initialValue, 2, '.', '');
                }

                $returnArray['status'] = true;
            }
        }catch(\Exception $e){
            $returnArray['status'] = false;
        }finally{
            return $this->json($returnArray);
        }        
    }
}
?>