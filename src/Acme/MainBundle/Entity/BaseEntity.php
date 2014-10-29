<?php
/**
 * Created by PhpStorm.
 * User: sergey@slepokurov.com
 * Date: 29.10.2014
 * Time: 12:45
 */

namespace Acme\MainBundle\Entity;


class BaseEntity {
    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return BaseEntity
     */
    public function setUpdated($updated)
    {
        return $this;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return BaseEntity
     */
    public function setCreated($created)
    {
        return $this;
    }

    public function setCreatedValue()
    {
        $this->setCreated(new \DateTime());
    }


    public function setUpdatedValue()
    {
        $this->setUpdated(new \DateTime());
    }
} 