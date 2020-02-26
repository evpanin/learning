<?php
namespace App\Controller\Main;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class BaseController extends AbstractController
{
    protected function renderDefault()
    {
        return [
          'title' => 'Значение по умолчанию',
        ];
    }
}