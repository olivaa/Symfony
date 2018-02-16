<?php

namespace App\Repository;

use App\Entity\Noticia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class NoticiaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Noticia::class);
    }




    /**
     * @param $seccion
     * @param $fecha
     * @param $equipo
     * @return Noticia[]
     */
    public function listadoNoticias($seccion,$fecha,$equipo)
    {
        return $this->createQueryBuilder('n')
            ->where('n.seccion = :seccion')->setParameter('seccion', $seccion)
            ->andWhere('n.equipo = :equipo')->setParameter('equipo', $equipo)
            ->andWhere('n.fecha = :fecha')->setParameter('fecha', $fecha)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }


    /**
     * @param $seccion
     * @param $fecha
     * @param $equipo
     * @param $titular
     * @return Noticia
     */
    public function verNoticia($seccion,$fecha,$equipo,$titular)
    {

        return $this->createQueryBuilder('n')
            ->where('n.seccion = :seccion')->setParameter('seccion', $seccion)
            ->andWhere('n.equipo = :equipo')->setParameter('equipo', $equipo)
            ->andWhere('n.fecha = :fecha')->setParameter('fecha', $fecha)
            ->andWhere('n.textoTitular = :titular')->setParameter('titular', $titular)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }

}
