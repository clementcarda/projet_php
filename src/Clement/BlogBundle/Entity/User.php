<?php

namespace Clement\BlogBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \Clement\BlogBundle\Entity\Commentaire
     *
     * @ORM\OneToMany(targetEntity="Clement\BlogBundle\Entity\Commentaire", mappedBy="auteur", cascade={"remove", "persist"})
     */
    private $commentaires;

    /**
     * @var \AppBundle\Entity\InfoCV
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\InfoCV", mappedBy="auteur")
     */
    private $cv;

    /**
     * Add commentaire
     *
     * @param \Clement\BlogBundle\Entity\Commentaire $comm
     *
     * @return User
     */
    public function addCommentaire(\Clement\BlogBundle\Entity\Commentaire $comm)
    {
        $this->commentaires[] = $comm;
        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \Clement\BlogBundle\Entity\Commentaire $comm
     */
    public function removeCommentaire(\Clement\BlogBundle\Entity\Commentaire $comm)
    {
        $this->commentaires->removeElement($comm);
    }

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

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
     * set cv
     *
     * @param \AppBundle\Entity\InfoCV
     */
    public function setCv(\AppBundle\Entity\InfoCV $cv)
    {
        $this->cv = $cv;
    }

    /**
     * Get cv
     *
     * @return \AppBundle\Entity\InfoCV
     */
    public function getCv()
    {
        return $this->cv;
    }
}
