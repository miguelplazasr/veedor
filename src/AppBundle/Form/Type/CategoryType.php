<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 16/03/16
 * Time: 19:51
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ODM\MongoDB\DocumentManager;

class CategoryType extends AbstractType
{
    protected $dm;

    public function __construct(DocumentManager $dm = null)
    {
        $this->dm = $dm;

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array() )
            ->add('description', TextareaType::class, array())
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            //'data_class' => 'AppBundle\Document\Category',
            'csrf_protection' => false,
            'allow_extra_fields' => true,

        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'category';
    }


}