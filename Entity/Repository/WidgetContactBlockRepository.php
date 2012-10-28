<?php
/*
 * This file is part of NeutronContactBlockBundle
 *
 * (c) Zender <azazen09@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Neutron\Widget\ContactBlockBundle\Entity\Repository;

use Neutron\Widget\ContactBlockBundle\Model\WidgetContactBlockInterface;

use Gedmo\Translatable\Entity\Repository\TranslationRepository;

class WidgetContactBlockRepository extends TranslationRepository
{
    public function getQueryBuilderForWidgetContactBlockManagementDataGrid()
    {
        $qb = $this->createQueryBuilder('w');
        $qb->select('w.id, w.title, w.enabled');
    
        return $qb;
    }
    
    public function getQueryBuilderForFormChoices()
    {
        $qb = $this->createQueryBuilder('w');
        $qb->where('w.enabled = ?1')->orderBy('w.title', 'ASC')->setParameters(array(1 => true));
    
        return $qb;
    }
    


}