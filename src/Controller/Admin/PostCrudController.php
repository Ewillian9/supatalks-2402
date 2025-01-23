<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', '🧾 All posts')
            ->setEntityLabelInSingular('Post')
            ->setEntityLabelInPlural('Posts')
            ->setSearchFields(['title'])
            ->setDefaultSort(['title' => 'ASC']);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('Post Information'),
            TextField::new('title')
                ->setLabel('Title')
                ->setHelp('Set the title of the post'),
            TextField::new('content')
                ->setLabel('Content')
                ->setHelp('Set the content of the post')
                    ->hideOnIndex(),
            BooleanField::new('isPublished')
                ->setLabel('Published?')
                ->setHelp('Is the post published?'),
            ImageField::new('image')
                ->setLabel('📷 Image')
                ->setHelp('Choose an image for the post')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setUploadDir('public/uploads/posts')
                ->setBasePath('uploads/posts'),
        ];
    }
}
