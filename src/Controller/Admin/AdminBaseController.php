<?php


namespace App\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminBaseController extends AbstractController
{
    protected function renderDefault()
    {
        return [
            'title' => 'Значение по умолчанию для Админки',
        ];
    }
}