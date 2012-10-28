<?php
namespace Neutron\Widget\ContactBlockBundle\Doctrine;

use Neutron\Widget\ContactBlockBundle\Model\WidgetContactBlockManagerInterface;

use Neutron\ComponentBundle\Doctrine\AbstractManager;

class WidgetContactBlockManager extends AbstractManager implements WidgetContactBlockManagerInterface
{
    public function getQueryBuilderForWidgetContactBlockDataGrid()
    {
        return $this->repository->getQueryBuilderForWidgetContactBlockDataGrid();
    }
}