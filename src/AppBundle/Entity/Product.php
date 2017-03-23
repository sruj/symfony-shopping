<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class Product
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Proszę podać nazwę")
     */
    public $name='';

    /**
     * @var string
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Proszę podać opis")
     * @Assert\Length(min=100, minMessage="Opis nie może być krótszy niż 100 znaków")
     */
    public $description='';

    /**
     * @var float
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Proszę podać cenę")
     */
    public $price=0.0;
}