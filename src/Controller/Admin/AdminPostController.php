<?php


namespace App\Controller\Admin;


use App\Entity\Category;
use App\Entity\Post;
use App\Form\PostType;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\PostRepositoryInterface;
use App\Service\FileManagerServiceInterface;
use App\Service\Post\PostService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPostController extends AdminBaseController
{

    /**
     * @var PostService
     */
    private $postService;
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    public function __construct(PostService $postService,
                                CategoryRepositoryInterface  $categoryRepository,
                                PostRepositoryInterface $postRepository)
    {
        $this->postService = $postService;
        $this->categoryRepository = $categoryRepository;
        $this->postRepository = $postRepository;
    }

    /**
     * @Route("/admin/post", name="admin_post")
     */
    public function index()
    {
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Посты';
        $forRender['category'] = $this->categoryRepository->getAll();
        return $this->render('admin/post/index.html.twig', $forRender);
    }

    /**
     * @Route("/admin/post/create", name="admin_post_create")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                $this->postService->handleCreate($form, $post);
                $this->addFlash('success', 'Пост добавлен');
                return $this->redirectToRoute('admin_post');
            }

        $forRender = parent::renderDefault();
        $forRender['title'] = 'Создание поста';
        $forRender['form'] = $form->createView();
        return $this->render('admin/post/form.html.twig', $forRender);
    }


    /**
     * @Route("/admin/post/update/{postId}", name="admin_post_update")
     * @param int $postId
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function update(int $postId, Request $request)
    {
        $post = $this->postRepository->getOne($postId);
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            if ($form->get('save')->isClicked()){
                $this->postService->handleUpdate($form, $post);
                $this->addFlash('success', 'Пост обновлен');
            }
            if ($form->get('delete')->isClicked()){
                $this->postService->handleDelete($post);
                $this->addFlash('success', 'Пост удален');
            }

            return $this->redirectToRoute('admin_post');
        }


        $forRender = parent::renderDefault();
        $forRender['title'] = 'Редактрование поста';
        $forRender['form'] = $form->createView();
        return $this->render('admin/post/form.html.twig', $forRender);

    }
}