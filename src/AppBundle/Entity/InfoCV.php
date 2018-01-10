<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InfoCV
 *
 * @ORM\Table(name="info_cv")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InfoCVRepository")
 */
class InfoCV
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=20)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=20)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=50)
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="code_postal", type="integer")
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=25)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=15)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=50)
     */
    private $mail;

    /**
     * @var \AppBundle\Entity\Formation
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Formation", mappedBy="cv", cascade={"remove", "persist"})
     */
    private $formations;

    /**
     * @var \AppBundle\Entity\ExperienceProfessionnelle
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ExperienceProfessionnelle", mappedBy="cv", cascade={"remove", "persist"})
     */
    private $experiences;

    /**
     * @var \AppBundle\Entity\Competence
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Competence", mappedBy="cv", cascade={"remove", "persist"})
     */
    private $competences;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return InfoCV
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return InfoCV
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return InfoCV
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set codePostal
     *
     * @param integer $codePostal
     *
     * @return InfoCV
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return int
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return InfoCV
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return InfoCV
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return InfoCV
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Get formations
     *
     * @return \AppBundle\Entity\Formation
     */
    public function getFormations()
    {
        return $this->formations;
    }

    /**
     * Add formation
     *
     * @param \AppBundle\Entity\Formation $formation
     *
     * @return InfoCV
     */
    public function addFormation(\AppBundle\Entity\Formation $formation)
    {
        $this->formations[] = $formation;
        return $this;
    }

    /**
     * Remove formation
     *
     * @param \AppBundle\Entity\Formation $formation
     */
    public function removeFormation(\AppBundle\Entity\Formation $formation)
    {
        $this->formations->removeElement($formation);
    }

    /**
     * Get experiences
     *
     * @return \AppBundle\Entity\ExperienceProfessionnelle
     */
    public function getExperiences()
    {
        return $this->experiences;
    }

    /**
     * Add experience
     *
     * @param \AppBundle\Entity\ExperienceProfessionnelle $experience
     *
     * @return InfoCV
     */
    public function addExperience(\AppBundle\Entity\ExperienceProfessionnelle $experience)
    {
        $this->experiences[] = $experience;
        return $this;
    }

    /**
     * Remove experience
     *
     * @param \AppBundle\Entity\ExperienceProfessionnelle $experience
     */
    public function removeExperience(\AppBundle\Entity\ExperienceProfessionnelle $experience)
    {
        $this->experiences->removeElement($experience);
    }

    /**
     * Get competences
     *
     * @return \AppBundle\Entity\Competence
     */
    public function getCompetences()
    {
        return $this->competences;
    }

    /**
     * Add competence
     *
     * @param \AppBundle\Entity\Competence $competence
     *
     *@return InfoCV
     */
    public function addCompetence(\AppBundle\Entity\Competence $competence)
    {
        $this->competences[] = $competence;
        return $this;
    }
    /**
     * Remove competence
     *
     * @param \AppBundle\Entity\Competence $competence
     */
    public function removeCompetence(\AppBundle\Entity\Competence $competence)
    {
        $this->competences->removeElement($competence);
    }
}

