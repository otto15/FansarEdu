<?php
namespace App\Admin;

use App\Entity\Subject;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bundle\MakerBundle\Doctrine\RelationManyToOne;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class LessonAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('topic', TextType::class)
            ->add('lesson_description', TextType::class)
            ->add('videolink', TextType::class)
            #->add('subject', ::class, [
                #'class' => Subject::class,
                #'choice_label' => 'name',])
            ->add('created_date', TextType::class, ['data' => date('d-m-Y, H:i:s', time())])
            ->add('short_description', TextType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('topic');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('topic')
            ->addIdentifier('lesson_description')
            ->addIdentifier('videolink')
            ->addIdentifier('subject')
            ->addIdentifier('created_date')
            ->addIdentifier('short_description');
    }
}