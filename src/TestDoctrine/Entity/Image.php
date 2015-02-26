<?php
/**
 * Created by PhpStorm.
 * User: David-Laptop
 * Date: 26/02/2015
 * Time: 01:17
 */

namespace TestDoctrine\Entity;

/**
 * @Entity @Table(name="images")
 **/
class Image {

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /**
     * @Column(type="string", length=255)
     */
    protected $url;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }


}