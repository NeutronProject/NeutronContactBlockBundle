<?php
namespace Neutron\Widget\ContactBlockBundle\Form\Backend\Handler;

use Neutron\ComponentBundle\Form\Handler\AbstractFormHandler;

class ContactBlockHandler extends AbstractFormHandler
{    
    protected function onSuccess()
    {   
        $general = $this->form->get('general')->getData();
        $this->container->get('neutron_contact_block.contact_block_manager')->update($general, true);
    }
    
    protected function getRedirectUrl()
    {
        return $this->container->get('router')->generate('neutron_contact_block.backend.contact_block');
    }
}