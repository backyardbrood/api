<?php
/**
 * Copyright (c) 2013 Adam L. Englander
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software
 * is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A
 * PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
 * CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE
 * OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace BackYardBrood\Entity;

/**
 * @author Adam L. Englander <adam.l.englander@coupla.co>
 *
 * Bird entity
 * @Entity
 */
class Bird
{
    /**
     * @var string
     * @Id
     */
    private $id;

    /**
     * @var User
     * @ManyToOne(targetEntity="User")
     */
    private $user;

    /**
     * @var Type
     * @ManyToOne(targetEntity="Type")
     */
    private $type;

    /**
     * @var string
     * @Column
     */
    private $name;

    /**
     * @var Gender
     * @ManyToOne(targetEntity="Gender")
     */
    private $gender;

    /**
     * @var \DateTime
     * @Column(type="date")
     */
    private $hatched;

    /**
     * @var \DateTime
     * @Column(type="date")
     */
    private $died;

    public function __construct()
    {
        $this->id = IdGenerator::getId();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \BackYardBrood\Entity\User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return \BackYardBrood\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \BackYardBrood\Entity\Type $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return \BackYardBrood\Entity\Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param \BackYardBrood\Entity\Gender $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return \BackYardBrood\Entity\Gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param \DateTime $hatched
     */
    public function setHatched($hatched)
    {
        $this->hatched = $hatched;
    }

    /**
     * @return \DateTime
     */
    public function getHatched()
    {
        return $this->hatched;
    }

    /**
     * @param \DateTime $died
     */
    public function setDied($died)
    {
        $this->died = $died;
    }

    /**
     * @return \DateTime
     */
    public function getDied()
    {
        return $this->died;
    }
}
