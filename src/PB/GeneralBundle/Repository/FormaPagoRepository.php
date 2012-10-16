<?php
// src/Acme/StoreBundle/Repository/ProductRepository.php
namespace PB\GeneralBundle\Repository;

use Doctrine\ORM\EntityRepository;

class FormaPagoRepository extends EntityRepository
{
	public function findAllOrderedByName()
	{
		return $this->getEntityManager()
		->createQuery('SELECT p FROM AcmeStoreBundle:Product p ORDER BY p.name ASC')
		->getResult();
	}
}