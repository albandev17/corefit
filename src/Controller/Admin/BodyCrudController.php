<?php

namespace App\Controller\Admin;

use App\Entity\Body;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BodyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Body::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
