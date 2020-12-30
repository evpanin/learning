<?php


namespace App\Service\Category;


use App\Entity\Category;
use App\Repository\CategoryRepositoryInterface;

class CategoryService
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Category $category
     * @return CategoryService
     */
    public function handleCreate(Category $category)
    {
        $category->setCreateAtValue();
        $category->setUpdateAtValue();
        $category->setIsPublished();

        $this->categoryRepository->setCreate($category);

        return $this;
    }

    /**
     * @param Category $category
     * @return CategoryService
     */
    public function handleUpdate(Category $category)
    {
        $category->setUpdateAtValue();

        $this->categoryRepository->setSave($category);

        return $this;
    }

    /**
     * @param Category $category
     */
    public function handleDelete(Category $category)
    {
        $this->categoryRepository->setDelete($category);
    }
}