<?php

namespace GenyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="geny_form")
 * @ORM\Entity(repositoryClass="GenyBundle\Repository\FormRepository")
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 * @Serializer\ExclusionPolicy("NONE")
 */
class Form
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Id
     * @Serializer\Exclude
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=128)
     * @Assert\Length(min = 1, max = 128)
     * @Serializer\Type("string")
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * @Assert\Length(min = 0, max = 4096)
     * @Serializer\Type("string")
     */
    protected $description;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Field", mappedBy="form", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     * @Assert\Valid()
     * @Serializer\Type("ArrayCollection<GenyBundle\Entity\Field>")
     */
    protected $fields;

    /**
     * @var string
     *
     * @ORM\Column(name="submit", type="text")
     * @Assert\Length(min = 1, max = 64)
     * @Serializer\Type("string")
     */
    protected $submit;

    public function __construct()
    {
        $this->fields = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function getSubmit()
    {
        return $this->submit;
    }

    public function setSubmit($submit)
    {
        $this->submit = $submit;
    }
}
