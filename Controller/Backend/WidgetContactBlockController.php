<?php
namespace Neutron\Widget\ContactBlockBundle\Controller\Backend;

use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\DependencyInjection\ContainerAware;

class WidgetContactBlockController extends ContainerAware
{
    public function indexAction()
    {
        $datagrid = $this->container->get('neutron.datagrid')
            ->get($this->container->getParameter('neutron_contact_block.datagrid.widget_contact_block_management'));
    
        $template = $this->container->get('templating')->render(
            'NeutronContactBlockBundle:Backend\WidgetContactBlock:index.html.twig', array(
                'datagrid' => $datagrid,
                'translationDomain' => 
                    $this->container->getParameter('neutron_contact_block.translation_domain')
            )
        );
    
        return  new Response($template);
    }
    
    public function updateAction($id)
    {   
        $form = $this->container->get('neutron_contact_block.form.backend.widget_contact_block');
        $handler = $this->container->get('neutron_contact_block.form.backend.handler.widget_contact_block');
        $form->setData($this->getData($id));

        if (null !== $handler->process()){
            return new Response(json_encode($handler->getResult()));
        }

        $template = $this->container->get('templating')->render(
            'NeutronContactBlockBundle:Backend\WidgetContactBlock:update.html.twig', array(
                'form' => $form->createView(),
                'translationDomain' => 
                    $this->container->getParameter('neutron_contact_block.translation_domain')
            )
        );
    
        return  new Response($template);
    }
    
    public function deleteAction($id)
    {      
        $entity = $this->getEntity($id);
    
        if ($this->container->get('request')->getMethod() == 'POST'){
            $this->container->get('neutron_contact_block.widget_contact_block_manager')
                ->delete($entity, true);
            $redirectUrl = $this->container->get('router')
                ->generate('neutron_contact_block.backend.widget_contact_block.management');
            return new RedirectResponse($redirectUrl);
        }
    
        $template = $this->container->get('templating')
            ->render('NeutronContactBlockBundle:Backend\WidgetContactBlock:delete.html.twig', array(
                'entity' => $entity,
                'translationDomain' =>
                    $this->container->getParameter('neutron_contact_block.translation_domain')
            )
        );
    
        return  new Response($template); 
    }
    
    public function getData($id)
    {
        $entity = $this->getEntity($id);
        
        return array('general' => $entity);
    }
    
    protected function getEntity($id)
    {

        $manager = $this->container->get('neutron_contact_block.widget_contact_block_manager');
        
        if ($id){
            $entity = $manager->findOneBy(array('id' => $id));
        } else {
            $entity = $manager->create();
        }
        
        if (!$entity){
            throw new NotFoundHttpException();
        }
        
        return $entity;
    }
}
