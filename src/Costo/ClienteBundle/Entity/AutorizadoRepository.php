<?php

namespace Costo\ClienteBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * FichaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AutorizadoRepository extends EntityRepository
{
    public function findAutorizadosDeFicha($fichaId) {
        $query = $this->getEntityManager()
                ->createQuery("SELECT a
                                 FROM ClienteBundle:Autorizado a
                                WHERE a.ficha = :id")
                ->setParameter('id', $fichaId);

        return $query->getResult();
    }
}
