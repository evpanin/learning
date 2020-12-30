<?php


namespace App\Service\Post;


use App\Entity\Post;
use App\Repository\PostRepositoryInterface;
use App\Service\FileManagerService;
use Symfony\Component\Form\FormInterface;

class PostService
{

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;
    /**
     * @var FileManagerService
     */
    private $fileManagerService;

    public function __construct(PostRepositoryInterface $postRepository,
                                FileManagerService $fileManagerService)
    {
        $this->postRepository = $postRepository;
        $this->fileManagerService = $fileManagerService;
    }

    /**
     * @param FormInterface $form
     * @param Post $post
     * @return PostService
     */
    public function handleCreate(FormInterface $form, Post $post)
    {
        $image = $form->get('image')->getData();
        $post->setUpdateAtValue();
        $post->setCreateAtValue();
        $post->setIsPublished();

            if ($image){
                $fileName = $this->fileManagerService->imagePostUpload($image);
                $post->setImage($fileName);
            }
        $this->postRepository->setCreate($post);

        return $this;

    }

    /**
     * @param FormInterface $form
     * @param $post
     * @return PostService
     */
    public function handleUpdate(FormInterface $form,Post $post)
    {
        $image = $form->get('image')->getData();

            if ($image){
                $imageOld = $post->getImage();
                if ($imageOld) $this->fileManagerService->removePostImage($imageOld);

                $fileName = $this->fileManagerService->imagePostUpload($image);
                $post->setImage($fileName);
            }

        $post->setUpdateAtValue();

        $this->postRepository->setSave($post);

        return $this;
    }

    /**
     * @param $post
     */
    public function handleDelete(Post $post)
    {
        $image = $post->getImage();
        if($image){
            $this->fileManagerService->removePostImage($image);
        }

        $this->postRepository->setDelete($post);

    }
}