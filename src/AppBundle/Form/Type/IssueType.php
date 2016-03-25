<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 22/03/16
 * Time: 20:39
 */

namespace AppBundle\Form\Type;

use Doctrine\Bundle\MongoDBBundle\Form\Type\DocumentType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ODM\MongoDB\DocumentManager;


class IssueType extends AbstractType
{
    protected $dm;

    public function __construct(DocumentManager $dm = null)
{
    $this->dm = $dm;

}

    public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        ->add('comment', TextareaType::class, array())
        ->add('category', DocumentType::class, array(

            'class' => 'AppBundle\Document\Category',
            'property' => 'name',
            'label' => 'Parent',
            'empty_value' => 'Root'
        ))
        ->add('image', FileType::class, array())
    ;
}

    public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults(array(

        'csrf_protection' => false,
        'allow_extra_fields' => true,

    ));
}

    /**
     * @return string
     */
    public function getName()
{
    return 'issue';
}


}