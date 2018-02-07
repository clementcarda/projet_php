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
use FOS\UserBundle\Model\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;


class CvController extends Controller
{
    public function showCvAction(Request $request, $userID = null)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        if ($userID)
        {
            $user = $em->find('ClementBlogBundle:User', $userID);

        }


        $fs = new Filesystem();
        $username = $user->getUsername();
        $picname = $user->getImage();

        //Récupération du cv portant l'id de l'utilisateur
        $id = $user->getId();

        $cv = $em->getRepository('AppBundle:InfoCv')->findOneBy(array('auteur' => $user));

        //test si l'utilisateur à ajouté une photo de profile
        if ($fs->exists($this->getParameter('profile_folder').$id.$username.'/'.$picname))
        {
            $pic = 'assets/profile/'.$id.$username.'/'.$picname;
        }
        else
        {
            $pic = 'assets/img/profile-default.png';
        }

        return $this->render('AppBundle:cv:showMyCv.html.twig', [
            'cv' => $cv,
            'image' => $pic,
            'myid' => $this->getUser()->getId(),
        ]);
    }

    public function editCvAction(Request $request)
    {
        $user = $this->getUser();

        //récupération des données du User courant
        $em = $this->getDoctrine()->getManager();
        $myInfo = $em->getRepository('AppBundle:InfoCv')->findOneBy(array('auteur' => $user));


        //création d'un formulaire sur le model de InfoCvType
        $infoCv = new InfoCV();
        $form = $this->createForm(InfoCVType::class, $infoCv);
        $form->handleRequest($request);

        //création d'un formulaire pour photo
        $picForm = $this->createFormBuilder()
            ->add('new_image', FileType::class)
            ->add('submit', SubmitType::class, array('label' => 'Submit'))
            ->getForm();
        $picForm->handleRequest($request);

        //vérification si le form à été validé
        if ($form->isSubmitted() && $form->isValid())
        {
            //dans ce cas on pouse les modification dans la BDD
            if (!$myInfo)
            {
                $myInfo = new InfoCV();
            }
            $myInfo->setNom($form->get('nom')->getData());
            $myInfo->setPrenom($form->get('prenom')->getData());
            $myInfo->setAdresse($form->get('adresse')->getData());
            $myInfo->setcodePostal($form->get('codePostal')->getData());
            $myInfo->setVille($form->get('ville')->getData());
            $myInfo->setTelephone($form->get('telephone')->getData());
            $myInfo->setmail($form->get('mail')->getData());
            $myInfo->setAuteur($this->getUser());
            $em->persist($myInfo);
            $em->flush();

        }
        else if ($myInfo)
        {
            //préremplissage du formulaire
            $form->get('nom')->setData($myInfo->getNom());
            $form->get('prenom')->setData($myInfo->getPrenom());
            $form->get('adresse')->setData($myInfo->getAdresse());
            $form->get('codePostal')->setData($myInfo->getCodePostal());
            $form->get('ville')->setData($myInfo->getVille());
            $form->get('telephone')->setData($myInfo->getTelephone());
            $form->get('mail')->setData($myInfo->getMail());
        }

        //Vérification si image upload
        if ($picForm->isSubmitted() && $picForm->isValid())
        {
            //génère un nouveau nom d'image
            $fs = new Filesystem();
            if ($fs->exists($this->getParameter('profile_folder').$user->getId().$user->getUsername().'/'.$user->getImage()))
            {
                $fs->remove($this->getParameter('profile_folder').$user->getId().$user->getUsername().'/'.$user->getImage());
            }

            //pousse l'image sous son dossier picture
            $folder = $this->getParameter('profile_folder').$user->getId().$user->getUsername();
            $pic = $picForm->get('new_image')->getData();
            $picName = 'profile.'.$pic->guessExtension();

            //Sauvegarde image dans le dossier utilisateur
            $user->setImage($picName);
            $em->persist($user);
            $em->flush();

            $pic->move(
                $folder,
                $picName
            );


        }

        $currentPic = 'assets/profile/'.$user->getId().$user->getUsername().'/'.$user->getImage();

        return $this->render('AppBundle:cv:editcv.html.twig', [
            'form' => $form->createView(),
            'picform' => $picForm->createView(),
            'current_pic' => $currentPic,
            'cv' => $myInfo
        ]);
    }

    public function editFormationAction(Request $request, $id)
    {
        //Recuperation du User et Formation courant
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $formation = $em->getRepository('AppBundle:Formation')->find($id);
        $cv = $em->getRepository('AppBundle:InfoCv')->findOneBy(array(
            'auteur' => $user,
        ) );

        //création du formulaire
        if (!$formation)
        {
            $formation = new Formation();
        }
        $form = $this->createForm(FormationType::class, $formation);

        $form->handleRequest($request);

        //vérification si le form à été validé
        if ($form->isSubmitted() && $form->isValid())
        {
            $formation->setNom($form->get('nom')->getData());
            $formation->setDuree($form->get('duree')->getData());
            $formation->setCommentaire($form->get('commentaire')->getData());
            $formation->setCv($cv);

            $em->persist($formation);
            $em->flush();

            return $this->redirectToRoute('showcv');


        }


        return $this->render('AppBundle:cv:editFormation.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function editCompetenceAction(Request $request, $id)
    {
        //Recuperation du User et Formation courant
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $competence = $em->getRepository('AppBundle:Competence')->find($id);
        $cv = $em->getRepository('AppBundle:InfoCv')->findOneBy(array(
            'auteur' => $user,
        ) );

        //Creation du formulaire
        if (!$competence)
        {
            $competence = new Competence();
        }
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        //vérification si le form à été validé
        if ($form->isSubmitted() && $form->isValid())
        {
            $competence->setNom($form->get('nom')->getData());
            $competence->setNiveau($form->get('niveau')->getData());
            $competence->setCommentaire($form->get('commentaire')->getData());
            $competence->setCV($cv);

            $em->persist($competence);
            $em->flush();

            return $this->redirectToRoute('showcv');
        }

        return $this->render('AppBundle:cv:editCompetence.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function editExperienceAction(Request $request, $id)
    {
        //Recuperation du User et Formation courant
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $experience = $em->getRepository('AppBundle:ExperienceProfessionnelle')->find($id);
        $cv = $em->getRepository('AppBundle:InfoCv')->findOneBy(array(
            'auteur' => $user,
        ) );

        //Creation du formulaire
        if (!$experience)
        {
            $experience = new ExperienceProfessionnelle();
        }
        $form = $this->createForm(ExperienceProfessionnelleType::class, $experience);
        $form->handleRequest($request);

        //vérification si le form à été validé
        if ($form->isSubmitted() && $form->isValid())
        {
            $experience->setPeriode($form->get('periode')->getData());
            $experience->setOrganisme($form->get('organisme')->getData());
            $experience->setPoste($form->get('poste')->getData());
            $experience->setCommentaire($form->get('commentaire')->getData());
            $experience->setCV($cv);

            $em->persist($experience);
            $em->flush();

            return $this->redirectToRoute('showcv');
        }

        return $this->render('AppBundle:cv:editExperience.html.twig', [
            'form' => $form->createView()
        ]);
    }

}