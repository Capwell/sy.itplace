<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GitHUbController extends Controller
{
    /**
     * @Route("/showTable")
     */
    public function showTableAction()
    {
        return $this->render('AppBundle:GitHUb:show_table.html.twig', array(
            // ...
        ));
    }

}
