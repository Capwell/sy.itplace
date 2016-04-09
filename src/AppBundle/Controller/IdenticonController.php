<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Components\Identicon;

class IdenticonController extends Controller
{
    /**
     * @Route("/hash/{hash}", name="hash")
     */
    public function indexAction(Request $request, $hash)
    {

        $image = new Identicon();
        $image->setSize( 300 );
        $image->rotator( TRUE );
        $image->filterize( TRUE );
        $image->useImagePool( $this->get('kernel')->getRootDir().'/image' );
        $image->hashBase( $hash );

        $image->display();
        exit();


    }
}
