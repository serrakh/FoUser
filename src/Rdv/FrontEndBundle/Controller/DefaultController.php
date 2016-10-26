<?php

namespace Rdv\FrontEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $family=$this->getFamily();
        $html = $this->get('twig')->render('@RdvFrontEnd/Default/template.html.twig');

//        $html = file_get_contents('./', FILE_USE_INCLUDE_PATH);

        $html =  $this->parsePlatform($html,$family);


        return $this->render('RdvFrontEndBundle:Default:index.html.twig' , [
            'html' => $html
        ]);
    }

    function getFamily() {

        $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);

        // par défaut, on dit que c'est du bureau.
        $family = 'desktop';

        // mobile, premier tri
        if (strstr($userAgent,'mobile') || strstr($userAgent,'android') || strstr($userAgent,'phone')) {
            $family = 'mobile';
        }

        // on affine maintenant

        // ipad ? facile.
        if (strstr($userAgent, 'ipad')) {
            $family = 'tablet';
        }

        // tablette android, presque facile.
        if (strstr($userAgent,'android')) {
            if (!strstr($userAgent,'mobile')) {
                $family = 'tablet';
            }
        }
        return $family;
    }

    function parsePlatform($html, $uaFamily){

        $uaFamily = $this->getFamily();
        $allFamilies = array('mobile');

        foreach ($allFamilies as $oneFamily) {

            if ($uaFamily == $oneFamily) {

                // on garde le nécessaire
                $pattern = '`\<\!\-\-only'.$oneFamily.'\-\-\>(.+)\<\!\-\-\/only'.$oneFamily.'\-\-\>`sU';
                if (preg_match_all($pattern,$html, $match)) {
                    $i=0;
                    foreach ($match[0] as $oneMatch) {
                        $html =     str_replace(  $match[0][$i],
                            $match[1][$i],
                            $html
                        );
                        $i++;
                    }
                }

                // on enlève ce qui doit l'être
                $pattern = '`\<\!\-\-no'.$oneFamily.'\-\-\>(.+)\<\!\-\-\/no'.$oneFamily.'\-\-\>`sU';
                if (preg_match_all($pattern,$html, $match)) {

                    $i=0;
                    foreach ($match[0] as $oneMatch) {
                        $html =     str_replace(  $match[0][$i],
                            '',
                            $html
                        );

                        $i++;
                    }
                }

            } else {

                $pattern = '`\<\!\-\-only'.$oneFamily.'\-\-\>(.+)\<\!\-\-\/only'.$oneFamily.'\-\-\>`sU';
                if (preg_match_all($pattern,$html, $match)) {
                    $i=0;
                    foreach ($match[0] as $oneMatch) {
                        $html =     str_replace(  $match[0][$i],
                            '',
                            $html
                        );
                        $i++;
                    }
                }

                $pattern = '`\<\!\-\-no'.$oneFamily.'\-\-\>(.+)\<\!\-\-\/no'.$oneFamily.'\-\-\>`sU';
                if (preg_match_all($pattern,$html, $match)) {
                    $i=0;
                    foreach ($match[0] as $oneMatch) {
                        $html =     str_replace(  $match[0][$i],
                            $match[1][$i],
                            $html
                        );
                        $i++;
                    }
                }
            }
        }
        return $html;
    }
}
