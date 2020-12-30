<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository implements PostRepositoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Post::class);
        $this->entityManager = $entityManager;
    }


    public function setCreate(Post $post): PostRepositoryInterface
    {
        $this->entityManager->persist($post);
        $this->entityManager->flush();

        return $this;
    }

    public function setSave(Post $post): PostRepositoryInterface
    {
        $this->entityManager->flush();

        return $this;
    }

    public function getOne(int $postId)
    {
        return parent::find($postId);
    }

    public function setDelete(Post $post)
    {
        $this->entityManager->remove($post);
        $this->entityManager->flush();
    }
}
