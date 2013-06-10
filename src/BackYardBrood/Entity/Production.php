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
 * Production class
 * @Entity
 * @Table(uniqueConstraints={
 *      @UniqueConstraint(name="bird_date", columns={"bird", "date"})
 * })
 */
class Production
{
    /**
     * @var int
     * @Id
     */
    private $id;

    /**
     * @var Bird
     * @ManyToOne(targetEntity="Bird")
     */
    private $bird;

    /**
     * @var \DateTime
     * @Column(type="date")
     */
    private $date;

    /**
     * @var int
     * @Column(type="integer")
     */
    private $count;

    /**
     * Constructor sets ID
     */
    public function __construct()
    {
        $this->id = IdGenerator::getId();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \BackYardBrood\Entity\Bird $bird
     */
    public function setBird($bird)
    {
        $this->bird = $bird;
    }

    /**
     * @return \BackYardBrood\Entity\Bird
     */
    public function getBird()
    {
        return $this->bird;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param int $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

}
