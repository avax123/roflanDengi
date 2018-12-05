<?php
namespace App\Entity;use Doctrine\Common\Collections\ArrayCollection;use Doctrine\Common\Collections\Collection;use Doctrine\ORM\Mapping as ORM;use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;class Category
{private $id;private $name;private $payments;public function __construct()
{$this->payments=new ArrayCollection()}public function getId():?int
{return $this->id}public function getName():?string
{return $this->name}public function setName(string $name):self
{$this->name=$name;return $this}public function getPayments():Collection
{return $this->payments}public function addPayment(Payment $payment):self
{if(!$this->payments->contains($payment)){$this->payments[]=$payment;$payment->setCategory($this)}
return $this}public function removePayment(Payment $payment):self
{if($this->payments->contains($payment)){$this->payments->removeElement($payment);if($payment->getCategory()===$this){$payment->setCategory(null)}}
return $this}}
