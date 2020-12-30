<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository implements CategoryRepositoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Category::class);
        $this->entityManager = $entityManager;
    }


    public function setCreate(Category $category): CategoryRepositoryInterface
    {
        $this->entityManager->persist($category);
        $this->entityManager->flush();

        return $this;
    }

    public function setSave(Category $category): CategoryRepositoryInterface
    {
        $this->entityManager->flush();

        return $this;
    }

    public function getOne(int $categoryId): object
    {
        return parent::find($categoryId);
    }

    public function getAll(): array
    {
        return parent::findAll();
    }

    public function setDelete(Category $category)
    {
        $this->entityManager->remove($category);
        $this->entityManager->flush();
    }
}
