<?php

namespace Demo\TutorialBundle\Controller;

class HelloController {
    public function indexAction($name) {
        // Very basic needs met by this
        // return new Response('<html><body>Hello '.$name.'!</body></html>');

        return $this->render('AcmeHelloBundle:Hello:index.html.twig', array('name' => $name));

        // render a PHP template instead
        // return $this->render(
        //     'AcmeHelloBundle:Hello:index.html.php',
        //     array('name' => $name)
        // );
    }    
}
