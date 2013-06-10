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
 * User entity
 * @Entity
 */
class User
{
    /**
     * @var string
     * @Id
     */
    private $id;

    /**
     * @var string
     * @Column(unique="TRUE")
     */
    private $email;

    /**
     * @var string
     * @Column
     */
    private $password;

    /**
     * @var string
     * @Column
     */
    private $nameFirst;

    /**
     * @var string
     * @Column
     */
    private $nameLast;

    /**
     * @var string
     * @Column(length="9")
     */
    private $zipCode;

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
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $nameFirst
     */
    public function setNameFirst($nameFirst)
    {
        $this->nameFirst = $nameFirst;
    }

    /**
     * @return string
     */
    public function getNameFirst()
    {
        return $this->nameFirst;
    }

    /**
     * @param string $nameLast
     */
    public function setNameLast($nameLast)
    {
        $this->nameLast = $nameLast;
    }

    /**
     * @return string
     */
    public function getNameLast()
    {
        return $this->nameLast;
    }

    /**
     * @param string $zipCode
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }
}
