<?php


namespace App\Repository;


use App\Entity\Category;

interface CategoryRepositoryInterface
{
    /**
     * @param Category $category
     * @return $this
     */
    public function setCreate(Category $category): self;

    /**
     * @param Category $category
     * @return $this
     */
    public function setSave(Category $category): self;

    /**
     * @param Category $category
     * @return mixed
     */
    public function setDelete(Category $category);

    /**
     * @param int $categoryId
     * @return Category
     */
    public function getOne(int $categoryId): object;

    /**
     * @return Category[]
     */
    public function getAll(): array;
}