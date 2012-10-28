<?php
namespace Neutron\Widget\ContactBlockBundle\DataGrid;

use Neutron\Widget\ContactBlockBundle\Model\ContactBlockManagerInterface;

use Neutron\Widget\ContactBlockBundle\ContactInfoManagerInterface;

use Symfony\Bundle\FrameworkBundle\Routing\Router;

use Symfony\Bundle\FrameworkBundle\Translation\Translator;

use Neutron\Bundle\DataGridBundle\DataGrid\FactoryInterface;

class ContactBlockMultiSelectSortableDataGrid
{

    const IDENTIFIER = 'neutron_contact_block_multi_select_sortable';
    
    protected $factory;
    
    protected $translator;
    
    protected $router;
    
    protected $manager;
    
    protected $translationDomain;
   

    public function __construct (FactoryInterface $factory, Translator $translator, Router $router, 
             ContactBlockManagerInterface $manager, $translationDomain)
    {
        $this->factory = $factory;
        $this->translator = $translator;
        $this->router = $router;
        $this->manager = $manager;
        $this->translationDomain = $translationDomain;
    }

    public function build ()
    {
        
        $dataGrid = $this->factory->createDataGrid(self::IDENTIFIER);
        $dataGrid
            ->setCaption(
                $this->translator->trans('grid.contact_block_multi_select_sortable.title',  array(), $this->translationDomain)
            )
            ->setAutoWidth(true)
            ->setColNames(array(
                $this->translator->trans('grid.contact_block_management.title',  array(), $this->translationDomain),
            ))
            ->setColModel(array(
                array(
                    'name' => 'b.title', 'index' => 'b.title', 'width' => 400, 
                    'align' => 'left', 'sortable' => true, 'search' => true,
                ), 

            ))
            ->setQueryBuilder($this->manager->getQueryBuilderForContactBlockMultiSelectSortableDataGrid())
            ->setSortName('b.title')
            ->setSortOrder('asc')
            ->enablePager(true)
            ->enableViewRecords(true)
            ->enableSearchButton(true)
            ->enableMultiSelectSortable(true)
            ->setMultiSelectSortableColumn('b.title')
        ;

        return $dataGrid;
    }



}