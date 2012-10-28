<?php 
namespace Neutron\Widget\ContactBlockBundle\Doctrine\EventSubscriber;

use Neutron\Widget\ContactBlockBundle\Model\WidgetContactBlockInterface;

use Doctrine\ORM\Event\LifecycleEventArgs;

use Neutron\MvcBundle\Widget\WidgetInterface;

use Doctrine\ORM\Events;

use Doctrine\Common\EventSubscriber;

class WidgetContactBlockEventSubscriber implements EventSubscriber
{
    protected $widget;
    
    public function __construct(WidgetInterface $widget)
    {
        $this->widget = $widget;
    }
    
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        
        if ($entity instanceof WidgetContactBlockInterface){
            $entity->setWidget($this->widget);
        }
    }
    
    public function getSubscribedEvents()
    {
        return array(Events::postLoad);
    }
    
}