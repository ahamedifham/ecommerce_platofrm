<?php
namespace AppBundle\Form\Type;

/**
 * Created by PhpStorm.
 * User: ifham
 * Date: 2/14/17
 * Time: 10:31 AM
 */
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class Base extends AbstractType
{
    protected $formOptions = array();
    /**
     * Basic form builder function
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        if(isset($options['mode']))
        {
            switch ($options['mode'])
            {
                case 'create':
                    $this->createForm($builder);
                    break;
                case 'edit':
                    $this->editForm($builder);
                    break;
                case 'search':
                    $this->searchForm($builder);
                    break;
            }
        }
    }

    /**
     * Create form builder function
     * @param FormBuilderInterface $builder
     */
    public function createForm(FormBuilderInterface $builder){
    }

    /**
     * Edit form builder function
     * @param FormBuilderInterface $builder
     */
    public function editForm(FormBuilderInterface $builder){
    }

    /**
     * Search form builder function
     * @param FormBuilderInterface $builder
     */
    public function searchForm(FormBuilderInterface $builder){
    }
}