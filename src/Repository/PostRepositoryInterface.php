<?php


namespace App\Repository;


use App\Entity\Post;

interface PostRepositoryInterface
{
    /**
     * @param Post $post
     * @return $this
     */
    public function setCreate(Post $post): self;

    /**
     * @param Post $post
     * @return $this
     */
    public function setSave(Post $post): self;

    /**
     * @param int $postId
     * @return mixed
     */
    public function getOne(int $postId);

    /**
     * @param Post $post
     * @return mixed
     */
    public function setDelete(Post $post);


}