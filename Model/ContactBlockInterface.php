<?php
namespace Neutron\Widget\ContactBlockBundle\Model;

interface ContactBlockInterface 
{
    public function getId ();
    
    public function setTitle($title);
    
    public function getTitle();
    
    public function getPhone ();
    
    public function setPhone ($phone);
    
    public function getFax ();
    
    public function setFax ($fax);
    
    public function getEmail ();
    
    public function setEmail ($email);
    
    public function getAddress ();
    
    public function setAddress ($address);
    
    public function getPostCode ();
    
    public function setPostCode ($postCode);
    
    public function getCity ();
    
    public function setCity ($city);
    
    public function getCountry ();
    
    public function setCountry ($country);
    
}

