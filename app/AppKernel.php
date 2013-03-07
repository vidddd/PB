<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
      		new PB\InicioBundle\PBInicioBundle(),
       		new PB\ComprasBundle\PBComprasBundle(),
       		new PB\VentasBundle\PBVentasBundle(),
           	new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
        	new Lexik\Bundle\FormFilterBundle\LexikFormFilterBundle(),
        	new JordiLlonch\Bundle\CrudGeneratorBundle\JordiLlonchCrudGeneratorBundle(),
            new PB\GeneralBundle\PBGeneralBundle(),
            new PB\ProduccionBundle\PBProduccionBundle(),
            new PB\ContabilidadBundle\PBContabilidadBundle(),
        	//	new Liuggio\ExcelBundle\LiuggioExcelBundle(),
            new PB\AlmacenBundle\PBAlmacenBundle(),
            new PB\CalidadBundle\PBCalidadBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
           // $bundles[] = new Acme\DemoBundle\AcmeDemoBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
