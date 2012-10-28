<?php
namespace Neutron\Widget\ContactBlockBundle\Model;

interface ContactBlockManagerInterface 
{
    public function getQueryBuilderForContactBlockManagementDataGrid();
    
    public function getQueryBuilderForContactBlockMultiSelectSortableDataGrid();
}

