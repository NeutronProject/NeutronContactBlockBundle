<?php
namespace Neutron\Widget\ContactBlockBundle\Model;

interface WidgetContactBlockAwareInterface 
{
    public function setWidgetContactBlock(WidgetContactBlockInterface $widgetContactBlock);
    
    public function getWidgetContactBlock();
}

