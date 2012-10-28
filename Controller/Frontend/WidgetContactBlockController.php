<?php
namespace Neutron\Widget\ContactBlockBundle\Controller\Frontend;

use Neutron\Widget\ContactBlockBundle\Model\WidgetContactInfoInterface;

use Symfony\Component\DependencyInjection\ContainerAware;

use Symfony\Component\HttpFoundation\Response;


class WidgetContactBlockController extends ContainerAware
{   
    public function renderAction(WidgetContactBlockInterface $widget)
    {   
        $widgetContactBlockManager = $this->container
                ->get('neutron_contact_block.widget_contact_block_manager');
        //$entity = $widgetContactInfoManager->findOneBy(array('category' => $category));
        
        $template = $this->container->get('templating')
            ->render($widget->getTemplate(), array(
                'widget' => $widget,    
            )
        );
    
        return  new Response($template);
    }

}
