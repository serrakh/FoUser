<?php

namespace Rdv\FrontEndBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Rdv\FrontEndBundle\Entity\Opticien;
use Rdv\FrontEndBundle\Entity\Patient;
use Rdv\FrontEndBundle\Entity\Professionnel;
use Rdv\FrontEndBundle\Form\OpticienType;
use Rdv\FrontEndBundle\Form\PatientType;
use Rdv\FrontEndBundle\Form\ProfessionnelType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{

    public function opticienAction(Request $request)
    {

        // login *******************************************************

        /* @var $request \Symfony\Component\HttpFoundation\Request */
        $session = $request->getSession();
        /* @var $session \Symfony\Component\HttpFoundation\Session\Session */

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        if ($error) {
            // TODO: this is a potential security risk (see http://trac.symfony-project.org/ticket/9523)
            $error = $error->getMessage();
        }
        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);

        $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');

        // inscription *******************************************************************************
        $em = $this->getDoctrine()->getEntityManager();
        $opticien = new Opticien();
        $form = $this->createForm(new OpticienType(), $opticien);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $opticien->addRole('ROLE_OPTICIEN');
            $opticien->setEnabled(true);
            $em->persist($opticien);
            $em->flush();
            $route = 'rdv_front_end_test';
            $this->addFlash(
                'userep',
                'votre compte à éte bien céer!'
            );
            $url = $this->container->get('router')->generate($route);
            $response = new RedirectResponse($url);
            $this->authenticateUser($opticien, $response);
            return $response;
        }

        return $this->render('@RdvFrontEnd/Default/opticien.html.twig', [
            'form' => $form->createView(),
            'last_username' => $lastUsername,
            'error'         => $error,
            'csrf_token' => $csrfToken,
        ]);
    }

    public function patientAction(Request $request)
    {

        // login *******************************************************

        /* @var $request \Symfony\Component\HttpFoundation\Request */
        $session = $request->getSession();
        /* @var $session \Symfony\Component\HttpFoundation\Session\Session */

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        if ($error) {
            // TODO: this is a potential security risk (see http://trac.symfony-project.org/ticket/9523)
            $error = $error->getMessage();
        }
        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);

        $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');

        // inscription *******************************************************************************
        $em = $this->getDoctrine()->getEntityManager();
        $patient = new Patient();
        $form = $this->createForm(new PatientType(), $patient);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $patient->addRole('ROLE_PATIENT');
            $patient->setEnabled(true);
            $em->persist($patient);
            $em->flush();
            $route = 'rdv_front_end_test';
            $this->addFlash(
                'userep',
                'votre compte à éte bien céer!'
            );
            $url = $this->container->get('router')->generate($route);
            $response = new RedirectResponse($url);
            $this->authenticateUser($patient, $response);
            return $response;
        }

        return $this->render('@RdvFrontEnd/Default/patient.html.twig', [
            'form' => $form->createView(),
            'last_username' => $lastUsername,
            'error'         => $error,
            'csrf_token' => $csrfToken,
        ]);

    }

    public function professionelAction(Request $request)
    {


        // login *******************************************************

        /* @var $request \Symfony\Component\HttpFoundation\Request */
        $session = $request->getSession();
        /* @var $session \Symfony\Component\HttpFoundation\Session\Session */

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        if ($error) {
            // TODO: this is a potential security risk (see http://trac.symfony-project.org/ticket/9523)
            $error = $error->getMessage();
        }
        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);

        $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');

        // inscription *******************************************************************************
        $em = $this->getDoctrine()->getEntityManager();
        $professionnel = new Professionnel();
        $form = $this->createForm(new ProfessionnelType(), $professionnel);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $professionnel->addRole('ROLE_PROFESSIONNEL');
            $professionnel->setEnabled(true);
            $em->persist($professionnel);
            $em->flush();
            $route = 'rdv_front_end_test';
            $this->addFlash(
                'userep',
                'votre compte à éte bien céer!'
            );
            $url = $this->container->get('router')->generate($route);
            $response = new RedirectResponse($url);
            $this->authenticateUser($professionnel, $response);
            return $response;
        }

        return $this->render('@RdvFrontEnd/Default/professionnel.html.twig', [
            'form' => $form->createView(),
            'last_username' => $lastUsername,
            'error'         => $error,
            'csrf_token' => $csrfToken,
        ]);

    }

    public function testAction(Request $request)
    {

        return $this->render('@RdvFrontEnd/Default/accueil.html.twig');
    }


    public function indexAction()
    {
        $family = $this->getFamily();
        $html = $this->get('twig')->render('@RdvFrontEnd/Default/template.html.twig');

//        $html = file_get_contents('./', FILE_USE_INCLUDE_PATH);

        $html = $this->parsePlatform($html, $family);

        return $this->render('RdvFrontEndBundle:Default:index.html.twig', [
            'html' => $html
        ]);

    }

    function getFamily()
    {

        $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);

        // par défaut, on dit que c'est du bureau.
        $family = 'desktop';

        // mobile, premier tri
        if (strstr($userAgent, 'mobile') || strstr($userAgent, 'android') || strstr($userAgent, 'phone')) {
            $family = 'mobile';
        }

        // on affine maintenant

        // ipad ? facile.
        if (strstr($userAgent, 'ipad')) {
            $family = 'tablet';
        }

        // tablette android, presque facile.
        if (strstr($userAgent, 'android')) {
            if (!strstr($userAgent, 'mobile')) {
                $family = 'tablet';
            }
        }
        return $family;
    }

    function parsePlatform($html, $uaFamily)
    {

        $uaFamily = $this->getFamily();
        $allFamilies = array('mobile');

        foreach ($allFamilies as $oneFamily) {

            if ($uaFamily == $oneFamily) {

                // on garde le nécessaire
                $pattern = '`\<\!\-\-only' . $oneFamily . '\-\-\>(.+)\<\!\-\-\/only' . $oneFamily . '\-\-\>`sU';
                if (preg_match_all($pattern, $html, $match)) {
                    $i = 0;
                    foreach ($match[0] as $oneMatch) {
                        $html = str_replace($match[0][$i],
                            $match[1][$i],
                            $html
                        );
                        $i++;
                    }
                }

                // on enlève ce qui doit l'être
                $pattern = '`\<\!\-\-no' . $oneFamily . '\-\-\>(.+)\<\!\-\-\/no' . $oneFamily . '\-\-\>`sU';
                if (preg_match_all($pattern, $html, $match)) {

                    $i = 0;
                    foreach ($match[0] as $oneMatch) {
                        $html = str_replace($match[0][$i],
                            '',
                            $html
                        );

                        $i++;
                    }
                }

            } else {

                $pattern = '`\<\!\-\-only' . $oneFamily . '\-\-\>(.+)\<\!\-\-\/only' . $oneFamily . '\-\-\>`sU';
                if (preg_match_all($pattern, $html, $match)) {
                    $i = 0;
                    foreach ($match[0] as $oneMatch) {
                        $html = str_replace($match[0][$i],
                            '',
                            $html
                        );
                        $i++;
                    }
                }

                $pattern = '`\<\!\-\-no' . $oneFamily . '\-\-\>(.+)\<\!\-\-\/no' . $oneFamily . '\-\-\>`sU';
                if (preg_match_all($pattern, $html, $match)) {
                    $i = 0;
                    foreach ($match[0] as $oneMatch) {
                        $html = str_replace($match[0][$i],
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


    /**
     * Authenticate a user with Symfony Security
     *
     * @param \FOS\UserBundle\Model\UserInterface $user
     * @param \Symfony\Component\HttpFoundation\Response $response
     */
    protected function authenticateUser(UserInterface $user, Response $response)
    {
        try {
            $this->container->get('fos_user.security.login_manager')->loginUser(
                $this->container->getParameter('fos_user.firewall_name'),
                $user,
                $response);
        } catch (AccountStatusException $ex) {
        }
    }
}
