<?php
namespace App\Repository;

use App\Entity\Note;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class NoteRepository extends ServiceEntityRepository
{
public function __construct(ManagerRegistry $registry)
{
parent::__construct($registry, Note::class);
}

/**
* Поиск заметок по ключевому слову в содержимом
* @param string $keyword
* @return Note[] Returns an array of Note objects
*/
public function findByContent(string $keyword): array
{
return $this->createQueryBuilder('n')
->where('n.content LIKE :keyword')
->setParameter('keyword', '%' . $keyword . '%')
->orderBy('n.id', 'ASC')
->getQuery()
->getResult();
}
}
