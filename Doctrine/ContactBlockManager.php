<?php
namespace Neutron\Widget\ContactBlockBundle\Doctrine;

use Neutron\Widget\ContactBlockBundle\Model\ContactBlockManagerInterface;

use Neutron\ComponentBundle\Doctrine\AbstractManager;

class ContactBlockManager extends AbstractManager implements ContactBlockManagerInterface
{
    public function getQueryBuilderForContactBlockManagementDataGrid()
    {
        return $this->repository->getQueryBuilderForContactBlockManagementDataGrid();
    }
    
    public function getQueryBuilderForContactBlockMultiSelectSortableDataGrid()
    {
        return $this->repository->getQueryBuilderForContactBlockMultiSelectSortableDataGrid();
    }
}