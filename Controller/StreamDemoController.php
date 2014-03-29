<?php

namespace Tg\DemoStreamBundle\Controller;

use Doctrine\Common\Proxy\Exception\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Tg\DemoStreamBundle\Helper\FlushHelper;


class StreamDemoController extends Controller
{

    /**
     * @Route("/streamDemo")
     */
    public function indexAction()
    {
        $helper = new FlushHelper();

        return new StreamedResponse(function() use ($helper) {

            $top = $this->renderView('TgDemoStreamBundle:StreamDemo:top.html.twig');
            $helper->out($top);

            sleep(2);
            $helper->outPlaceholder('start loading other stuff...'.mt_rand(0, 999999), 'info');

            sleep(3);

            $idRange = range(1, 19);
            shuffle($idRange);

            foreach($idRange as $id) {
                $helper->outPlaceholder('LOADED_'.$id, '_'.$id);
                $helper->outPlaceholder('Loaded '.$id, 'info');
                sleep(1);
            }

            $helper->outPlaceholder('change styles...'.mt_rand(0, 999999), 'info');
            # lets modify some styles...

            foreach(array('yellow', 'yellowgreen', 'red', 'transparent') as $color) {
                $helper->out('
                    <style>
                        div {
                            background-color:'.$color.';
                        }
                    </style>
                ');
                sleep(1);
            }

            $helper->outPlaceholder('all done.'.mt_rand(0, 999999), 'info');

            echo $this->renderView('TgDemoStreamBundle:StreamDemo:bottom.html.twig');

        });
    }

}
