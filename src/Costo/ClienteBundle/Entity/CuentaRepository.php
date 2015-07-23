<?php

namespace Costo\ClienteBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * FichaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CuentaRepository extends EntityRepository
{
    public function findCuentasDeFicha($fichaId) {
        $query = $this->getEntityManager()
                ->createQuery("SELECT c
                                 FROM ClienteBundle:Cuenta c
                                WHERE c.ficha = :id")
                ->setParameter('id', $fichaId);

        return $query->getResult();
    }
}