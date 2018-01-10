<?php
/**
 * Created by PhpStorm.
 * User: clement
 * Date: 28/11/17
 * Time: 09:42
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Competence;
use AppBundle\Entity\ExperienceProfessionnelle;
use AppBundle\Entity\Formation;
use AppBundle\Entity\InfoCV;
use AppBundle\form\CompetenceType;
use AppBundle\form\ExperienceProfessionnelleType;
use AppBundle\form\FormationType;
use AppBundle\form\InfoCVType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class CvController extends Controller
{
    public function showCvAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $cv = $em->getRepository('AppBundle:InfoCV')->find(1);

        return $this->render('AppBundle:cv:showcv.html.twig', [
            'cv' => $cv
        ]);


    }

}