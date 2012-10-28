<?php
namespace Neutron\Widget\ContactBlockBundle\Controller\Frontend;

use Neutron\Widget\ContactBlockBundle\Model\WidgetContactBlockInterface;

use Symfony\Component\DependencyInjection\ContainerAware;

use Symfony\Component\HttpFoundation\Response;


class WidgetContactBlockController extends ContainerAware
{   
    public function renderAction(WidgetContactBlockInterface $widget = null)
    {   
        if ($this->container->getParameter('neutron_contact_block.enable') === false 
                || $widget === null || $widget->getEnabled() === false){
            return new Response();
        }
        
        $template = $this->container->get('templating')
            ->render($widget->getTemplate(), array(
                'widget' => $widget, 
                'translationDomain' => 
                    $this->container->getParameter('neutron_contact_block.translation_domain')
            )
        );
    
        return  new Response($template);
    }

}
