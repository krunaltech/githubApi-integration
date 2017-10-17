<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $client = new \Github\Client();
        $repos = $client->api('repo')->find('symfony');
        $repos = $repos['repositories'];
        $responseData = array();
        for($i=0; $i < count($repos); $i++)
        {
            $responseData[$i]['url'] = $repos[$i]['url']; 
            $responseData[$i]['desc'] = $repos[$i]['description'];
        }

        return $this->render('default/index.html.twig', [
            'repos' => $responseData
        ]);
    }
}
