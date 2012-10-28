<?php
namespace Neutron\Widget\ContactBlockBundle\Model;

interface WidgetContactBlockManagerInterface 
{
    public function getQueryBuilderForWidgetContactBlockManagementDataGrid();
    
    public function getQueryBuilderForFormChoices();
}

