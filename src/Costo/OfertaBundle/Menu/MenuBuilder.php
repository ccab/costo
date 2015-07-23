<?php
namespace Costo\OfertaBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Knp\Menu\Util\MenuManipulator;
use \RecursiveIteratorIterator;
use Knp\Menu\Iterator\RecursiveItemIterator;
use Knp\Menu\Iterator\CurrentItemFilterIterator;
use \ArrayIterator;
use Knp\Menu\MenuItem;

class MenuBuilder extends ContainerAware
{
    public function navigation(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('home', array('route' => 'oferta', 'label' => "Oferta"));
        $menu['home']->setChildrenAttributes(array('class' => 'nav nav-pills nav-stacked'));
        
        $menu['home']->addChild('oferta', array('route' => 'oferta', 'label' => "Oferta"));
        $menu['home']->addChild('ficha', array('route' => 'ficha', 'label' => "Ficha Cliente"));
        $menu['home']->addChild('servicio', array('route' => 'servicio', 'label' => "Servicio"));
        $menu['home']->addChild('material', array('route' => 'material', 'label' => "Material"));
        $menu['home']->addChild('moneda', array('route' => 'moneda', 'label' => "Moneda"));
        $menu['home']->addChild('categoria', array('route' => 'categoria', 'label' => "Categoria"));
        $menu['home']->addChild('proceso', array('route' => 'proceso', 'label' => "Proceso"));
        $menu['home']->addChild('empresa', array('route' => 'empresa', 'label' => "Tipo de Empresa"));
        $menu['home']->addChild('ministerio', array('route' => 'ministerio', 'label' => "Ministerio"));
        //$menu['home']->addChild('directivo', array('route' => 'directivo', 'label' => "Directivo"));
        //$menu['home']->addChild('autorizado', array('route' => 'autorizado', 'label' => "Autorizado"));
        //$menu['home']->addChild('cuenta', array('route' => 'cuenta', 'label' => "Cuenta"));
        //$menu['home']->addChild('contacto', array('route' => 'contacto', 'label' => "Contacto"));
        
        return $menu;
    }
    
    public function breadcrumbs(FactoryInterface $factory, array $options)
    {
        $menu = $this->navigation($factory, $options);

        $matcher = $this->container->get('knp_menu.matcher');
        $voter = $this->container->get('knp_menu.voter.router');
        $matcher->addVoter($voter);

        $treeIterator = new RecursiveIteratorIterator(new RecursiveItemIterator(new ArrayIterator(array($menu))),
                                                      RecursiveIteratorIterator::SELF_FIRST);

        $iterator = new CurrentItemFilterIterator($treeIterator, $matcher);

        // Set Current as an empty Item in order to avoid exceptions on knp_menu_get
        $current = new MenuItem('', $factory);

        foreach ($iterator as $item) 
        {
            $item->setCurrent(true);
            $current = $item;
            break;
        }

        //send the breadcrumbs trail array inside the bc attribute
        $breadcrumbs = new MenuManipulator();
        $aux = $breadcrumbs->getBreadcrumbsArray($current);
        //deleting the root item
        unset($aux[0]);
        $current->setAttribute('bc', $aux);
        
        return $current;
    }
    
    
   
}