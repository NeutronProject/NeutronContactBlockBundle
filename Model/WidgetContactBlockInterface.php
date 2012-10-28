<?php
namespace Neutron\Widget\ContactBlockBundle\Model;

use Neutron\MvcBundle\Widget\WidgetInterface;

use Neutron\Bundle\FormBundle\Model\MultiSelectSortableInterface;

interface WidgetContactBlockInterface extends MultiSelectSortableInterface
{
    public function setWidget(WidgetInterface $widget);
    
    public function getWidget();
}

