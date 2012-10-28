<?php
/*
 * This file is part of NeutronContactBlockBundle
 *
 * (c) Zender <azazen09@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Neutron\Widget\ContactBlockBundle\Form\Backend\Type\WidgetContactBlock;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Symfony\Component\Form\FormView;

use Symfony\Component\Form\FormInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\AbstractType;

/**
 * Short description
 *
 * @author Zender <azazen09@gmail.com>
 * @since 1.0
 */
class GeneralType extends AbstractType
{
    
    protected $dataGrid;
    
    protected $eventSubscriber;
    
    protected $widgetContactBlockClass;
    
    protected $contactBlockClass;
    
    protected $contactBlockReferenceClass;
    
    protected $templates;
    
    protected $translationDomain;
    
    public function setDataGrid($dataGrid)
    {
        $this->dataGrid = $dataGrid;
    }
    
    public function setEventSubscriber(EventSubscriberInterface $eventSubscriber)
    {
        $this->eventSubscriber = $eventSubscriber;
    }
    
    public function setWidgetContactBlockClass($widgetContactBlockClass)
    {
        $this->widgetContactBlockClass = $widgetContactBlockClass;
    }
    
    public function setContactBlockClass($contactBlockClass)
    {
        $this->contactBlockClass = $contactBlockClass;
    }
    
    public function setContactBlockReferenceClass($contactBlockReferenceClass)
    {
        $this->contactBlockReferenceClass = $contactBlockReferenceClass;
    }
    
    public function setTemplates(array $templates)
    {
        $this->templates = $templates;
    }


    public function setTranslationDomain($translationDomain)
    {
        $this->translationDomain = $translationDomain;
    }
    
    /**
     * (non-PHPdoc)
     * @see Symfony\Component\Form.AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('references', 'neutron_multi_select_sortable_collection', array(
                'grid' => $this->dataGrid,
                'options' => array(
                    'data_class' => $this->contactBlockReferenceClass,
                    'inversed_class' => $this->contactBlockClass
                )
            
            ))
            ->add('template', 'choice', array(
                'choices' => $this->templates,
                'multiple' => false,
                'expanded' => false,
                'attr' => array('class' => 'uniform'),
                'label' => 'form.template',
                'empty_value' => 'form.empty_value',
                'translation_domain' => $this->translationDomain
            ))
            ->add('enabled', 'checkbox', array(
                'label' => 'form.enabled', 
                'value' => true,
                'required' => false,
                'attr' => array('class' => 'uniform'),
                'translation_domain' => $this->translationDomain
            ))
        
        ;
        
        $builder->addEventSubscriber($this->eventSubscriber);
    }
    
    /**
     * (non-PHPdoc)
     * @see Symfony\Component\Form.AbstractType::setDefaultOptions()
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->widgetContactInfoClass,
            'validation_groups' => function(FormInterface $form){
                return 'default';
            },
        ));
    }
    
    /**
     * (non-PHPdoc)
     * @see Symfony\Component\Form.FormTypeInterface::getName()
     */
    public function getName()
    {
        return 'neutron_backend_widget_contact_block_general';
    }
}