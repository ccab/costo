<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Costo\OfertaBundle\Entity\Oferta;
use Costo\OfertaBundle\Entity\Sitio;
use Costo\OfertaBundle\Entity\OfertaProceso;
use Costo\OfertaBundle\Entity\SitioServicio;
use Costo\OfertaBundle\Entity\SitioMaterial;

/**
 * Oferta Wizard controller.
 *
 * @Route("/oferta/gestionar")
 */
class OfertaWizardController extends Controller {

    /**
     * @Route("/cliente/{id}", name="oferta_cliente", defaults = {"id" = 0})
     */
    public function clienteAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $id == 0 ? new Oferta() : $em->getRepository('CostoOfertaBundle:Oferta')->find($id);

        $form = $this->createForm('oferta_form', $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('oferta_procesos', array('id' => $entity->getId())));
        }

        return $this->render('OfertaWizard/cliente.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView())
        );
    }

    /**
     * @Route("/procesos/{id}",name="oferta_procesos", defaults = {"id" = 0})
     */
    public function procesosAction(Request $request, Oferta $entity) {
        $form = $this->createForm('oferta_form', $entity, array(
            'step' => 2,
            'validation_groups' => array('procesos')));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $ofertaProcesos = $em->getRepository('CostoOfertaBundle:OfertaProceso')->findOpDeOferta($entity->getId());

            foreach ($ofertaProcesos as $op) {
                if (false === $entity->getOfertaProcesos()->contains($op)) {
                    $em->remove($op);
                }
            }

            $this->setNumeroOferta($entity);

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('oferta_categorias', array('id' => $entity->getId())));
        }

        return $this->render('OfertaWizard/procesos.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView())
        );
    }

    /**
     * @Route("/categorias/{id}", name="oferta_categorias", defaults = {"id" = 0})
     */
    public function categoriasAction(Request $request, Oferta $entity) {
        $form = $this->createForm('oferta_form', $entity, array('step' => 3));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $ofCat = $em->getRepository('MaterialesBundle:subcategoria')->findCategDeOferta($entity->getId());

            // eliminando materiales y servicios relacionados con las categorias q se desean eliminar
            foreach ($ofCat as $categ) {
                if (false === $entity->getCategorias()->contains($categ)) {
                    //eliminando materiales
                    foreach ($categ->getMateriales() as $material) {
                        foreach ($entity->getSitios() as $sitio) {
                            $sitioMat = $em->getRepository('CostoOfertaBundle:SitioMaterial')->findOneBy(array(
                                'sitio' => $sitio,
                                'material' => $material
                            ));

                            if ($sitioMat) {
                                $em->remove($sitioMat);
                            }
                        }
                    }

                    //eliminando servicios
                    foreach ($categ->getServicios() as $servicio) {
                        foreach ($entity->getSitios() as $sitio) {
                            $sitioServ = $em->getRepository('CostoOfertaBundle:SitioServicio')->findOneBy(array(
                                'sitio' => $sitio,
                                'servicio' => $servicio
                            ));


                            if ($sitioServ) {
                                $em->remove($sitioServ);
                            }
                        }
                    }
                }
            }

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('oferta_sitios', array('id' => $entity->getId())));
        }

        return $this->render('OfertaWizard/categorias.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView())
        );
    }

    /**
     * @Route("/sitios/{id}",name="oferta_sitios", defaults = {"id" = 0})
     */
    public function sitiosAction(Request $request, Oferta $entity) {
        $form = $this->createForm('oferta_form', $entity, array('step' => 4));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $sitios = $em->getRepository('CostoOfertaBundle:Sitio')->findSitiosDeOferta($entity->getId());

            // remove the relationship between the Cuenta & Ficha
            foreach ($sitios as $sitio) {
                if (false === $entity->getSitios()->contains($sitio)) {
                    $em->remove($sitio);
                }
            }

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('oferta_materiales', array('id' => $entity->getId())));
        }

        return $this->render('OfertaWizard/sitios.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView())
        );
    }

    /**
     * @Route("/sitios2/{id}",name="oferta_sitios2", defaults = {"id" = 0})
     */
    public function sitios2Action(Request $request, Oferta $entity) {
        $form = $this->createForm('oferta_form', $entity, array('step' => 5));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $sitios = $em->getRepository('CostoOfertaBundle:Sitio')->findSitiosDeOferta($entity->getId());

            // remove the relationship between the Cuenta & Ficha
            foreach ($sitios as $sitio) {
                if (false === $entity->getSitios()->contains($sitio)) {
                    $em->remove($sitio);
                }
            }

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('oferta_materiales', array('id' => $entity->getId())));
        }

        return $this->render('CostoOfertaBundle:Wizard:sitios2.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView())
        );
    }

    /**
     * @Route("/materiales/{id}", name="oferta_materiales", defaults = {"id" = 0})
     */
    public function materialesAction(Request $request, Oferta $entity) {
        $em = $this->getDoctrine()->getManager();

        if ($request->request->get('add4_aceptar')) {
            foreach ($entity->getSitios() as $sitio) {
                foreach ($entity->getCategorias() as $categoria) {
                    foreach ($categoria->getMateriales() as $material) {
                        $valor = $request->request->get($sitio->getId() . '-' . $material->getId());

                        $sitioMat = $em->getRepository('CostoOfertaBundle:SitioMaterial')->findOneBy(array(
                            'sitio' => $sitio,
                            'material' => $material
                        ));

                        if ($sitioMat) {
                            if ($valor > 0) {
                                $sitioMat->setValor($valor);
                            } else {
                                $em->remove($sitioMat);
                            }
                        } else {
                            if ($valor > 0) {
                                $sm = new SitioMaterial();
                                $sm->setMaterial($material)
                                        ->setSitio($sitio)
                                        ->setValor($valor);
                                $em->persist($sm);
                            }
                        }
                    }
                }
            }

            $em->flush();

            return $this->redirect($this->generateUrl('oferta_servicios', array('id' => $entity->getId())));
        }

        $grid = array();

        foreach ($entity->getSitios() as $sitio) {
            foreach ($sitio->getSitioMateriales() as $sitioMat) {
                $grid[$sitioMat->getSitio()->getId()][$sitioMat->getMaterial()->getId()] = $sitioMat->getValor();
            }
        }

        $ofertaCategMat = $em->getRepository('MaterialesBundle:subcategoria')->findCategMatOferta($entity->getId());

        return $this->render('OfertaWizard/materiales.html.twig', array(
                    'entity' => $entity,
                    'grid' => $grid,
                    'ofertaCategMat' => $ofertaCategMat
        ));
    }

   /**
     * @Route("/materiales2/{id}", name="oferta_materiales2", defaults = {"id" = 0})
     */
    /*
    public function materiales2Action(Request $request, Oferta $entity) {
        $form = $this->createForm('oferta_form', $entity, array('step' => 6));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $sitios = $em->getRepository('CostoOfertaBundle:Sitio')->findSitiosDeOferta($entity->getId());

            // remove the relationship between the Cuenta & Ficha
            foreach ($sitios as $sitio) {
                if (false === $entity->getSitios()->contains($sitio)) {
                    $em->remove($sitio);
                }
            }

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('oferta_materiales', array('id' => $entity->getId())));
        }

        return $this->render('CostoOfertaBundle:Wizard:materiales2.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView())
        );
    }*/

    /**
     * @Route("/servicios/{id}", name="oferta_servicios", defaults = {"id" = 0})
     */
    public function serviciosAction(Request $request, Oferta $entity) {
        $em = $this->getDoctrine()->getManager();

        if ($request->request->get('add5_aceptar')) {
            foreach ($entity->getSitios() as $sitio) {
                foreach ($entity->getCategorias() as $categoria) {
                    foreach ($categoria->getServicios() as $servicio) {
                        $valor = $request->request->get($sitio->getId() . '-' . $servicio->getId());

                        $sitioServ = $em->getRepository('CostoOfertaBundle:SitioServicio')->findOneBy(array(
                            'sitio' => $sitio,
                            'servicio' => $servicio
                        ));


                        if ($sitioServ) {
                            if ($valor > 0) {
                                $sitioServ->setValor($valor);
                            } else {
                                $em->remove($sitioServ);
                            }
                        } else {
                            if ($valor > 0) {
                                $ss = new SitioServicio();
                                $ss->setServicio($servicio)
                                        ->setSitio($sitio)
                                        ->setValor($valor);
                                $em->persist($ss);
                            }
                        }
                    }
                }
            }

            $em->flush();

            return $this->redirect($this->generateUrl('oferta_resumen', array('id' => $entity->getId())));
        }

        $grid = array();

        foreach ($entity->getSitios() as $sitio) {
            foreach ($sitio->getSitioServicios() as $sitioServ) {
                $grid[$sitioServ->getSitio()->getId()][$sitioServ->getServicio()->getId()] = $sitioServ->getValor();
            }
        }

        $ofertaCategServ = $em->getRepository('MaterialesBundle:subcategoria')->findCategServOferta($entity->getId());

        return $this->render('OfertaWizard/servicios.html.twig', array(
            'entity' => $entity, 
            'grid' => $grid, 
            'ofertaCategServ' => $ofertaCategServ
            ));
    }

    /**
     * @Route("/resumen/{id}", name="oferta_resumen", defaults = {"id" = 0})
     */
    public function resumenAction(Request $request, Oferta $entity) {
        $resumen = array('servicios_cup' => 0, 'servicios_cuc' => 0, 'materiales_cup' => 0, 'materiales_cuc' => 0,);

        foreach ($entity->getSitios() as $sitio) {
            foreach ($sitio->getSitioServicios() as $sitio_servicio) {
                $resumen['servicios_cup'] += ($sitio_servicio->getServicio()->getPrecioUnitCup() * $sitio_servicio->getValor());
                $resumen['servicios_cuc'] += ($sitio_servicio->getServicio()->getPrecioUnitCuc() * $sitio_servicio->getValor());
            }

            foreach ($sitio->getSitioMateriales() as $sitio_material) {
                foreach ($sitio_material->getMaterial()->getPrecios() as $precio) {
                    if ($precio->getMoneda()->getAbreviatura() == "CUP") {
                        $resumen['materiales_cup'] += ($precio->getValor() * $sitio_material->getValor());
                    } elseif ($precio->getMoneda()->getAbreviatura() == "CUC") {
                        $resumen['materiales_cuc'] += ($precio->getValor() * $sitio_material->getValor());
                    }
                }
            }
        }

        return $this->render('OfertaWizard/resumen.html.twig', array('entity' => $entity, 'resumen' => $resumen));
    }

    //TODO: improve queries or UI using AJAX
    //esta funcion debe modificarse debido a que el usuario debe ser capaz 
    //de gestionar los sitios de una manera mas granular 
    //pudiendo seleccionar q sitio es el q desea gestionar en cada momento
    //aqui simplemente se crean sitios ascendentemente y se eliminan descendentemente
    private function manageSitios($em, Oferta $entity, $sitios_num) {
        $entity_sitios_num = $entity->getSitios()->count();

        //cuando se esta creando la entidad 
        if ($entity_sitios_num == 0) {
            for ($i = 1; $i <= $sitios_num; $i++) {
                $sitio = new Sitio();
                $sitio->setNombre("Sitio$i");
                $sitio->setOferta($entity);
                $em->persist($sitio);
            }
            //cuando el usuario desea reducir el numero de sitios
        } elseif ($entity_sitios_num > $sitios_num) {
            for ($i = $entity_sitios_num; $i > $sitios_num; $i--) {
                $sitio = $em->getRepository('CostoOfertaBundle:Sitio')->findOneBy(array('nombre' => "Sitio$i", 'oferta' => $entity->getId()));
                $em->remove($sitio);
            }
            //cuando el usuario desea aumentar el numero de sitios
        } else {
            for ($i = ++$entity_sitios_num; $i <= $sitios_num; $i++) {
                $sitio = new Sitio();
                $sitio->setNombre("Sitio$i");
                $sitio->setOferta($entity);
                $em->persist($sitio);
            }
        }
    }

    /**
     * Funcion auxiliar para gestionar los procesos relacionados con la Oferta
     * 
     * @param type   $em        Entity Manager
     * @param Oferta $entity    Objeto de la entidad Oferta con la que se desean asociar los procesos
     * @param array  $procesos  Listado de Ids de los procesos
     */
    private function manageProcesos($em, Oferta $entity, $procesos, $principal) {
        //adding the procesos activated by the user
        foreach ($procesos as $idProceso) {
            $existsOp = $em->getRepository('CostoOfertaBundle:OfertaProceso')->existsOp($entity->getId(), $idProceso);

            if (!$existsOp && $idProceso != $principal) {
                $this->createOfertaProceso($em, $entity, $idProceso, FALSE);
            }
        }

        //deleting the procesos deactivated by the user
        foreach ($entity->getOfertaProcesos() as $ofertaProceso) {
            if (!in_array($ofertaProceso->getProceso()->getId(), $procesos) && !$ofertaProceso->getPrincipal()) {
                $em->remove($ofertaProceso);
            }
        }
    }

    /**
     * Funcion auxiliar para gestionar el proceso principal relacionado con la Oferta
     * 
     * @param type   $em        Entity Manager
     * @param Oferta $entity    Objeto de la entidad Oferta con la que se desea asociar el proceso
     * @param int    $procesos  Ids del proceso principal
     */
    private function manageProcesoPrincipal($em, Oferta $entity, $idProceso) {
        $op = $em->getRepository('CostoOfertaBundle:OfertaProceso')->findOp($entity->getId(), $idProceso);

        //si el proceso fue asociado anteriormente solo debo ponerlo como principal
        if ($entity->getOfertaProcesos()->contains($op)) {
            $op->getPrincipal() ? : $op->setPrincipal(TRUE);
            //de lo contrario lo creo como principal
        } else {
            $this->createOfertaProceso($em, $entity, $idProceso, TRUE);
            $this->setNumeroOferta($em, $entity, $idProceso);
        }

        $opPrincAnt = $em->getRepository('CostoOfertaBundle:OfertaProceso')->findOpPrincipal($entity->getId());
        //si existe un proceso principal anterior setearlo a falso
        //debo asegurarme que el proceso principal  sea distinto del q tenia asociado anteriormente 
        //cambio tambien el num de la oferta debido a q se cambia el proceso principal asociado
        if ($opPrincAnt != NULL && $opPrincAnt != $op) {
            $opPrincAnt->setPrincipal(FALSE);
            $this->setNumeroOferta($em, $entity, $idProceso);
        }
    }

    /**
     * Funcion auxiliar para establecer el numero de la Oferta
     * 
     * @param Oferta $entity     Objeto de la entidad Oferta al cual se le establece el numero
     */
    private function setNumeroOferta(Oferta $entity) {
        $em = $this->getDoctrine()->getManager();
        $procPrincAnt = $em->getRepository('CostoServicioBundle:Proceso')->findProcesoPrincipalOferta($entity->getId());
        $principal = $entity->getProcesoPrincipal();

        // busco si tiene un proceso principal asignado anteriormente
        // si es el mismo proceso no deberia cambiar el numero
        if (empty($procPrincAnt) || (isset($procPrincAnt[0]) && $principal != $procPrincAnt[0])) {
            $lastNum = $em->getRepository('CostoOfertaBundle:Oferta')->findLastNumOfertaDelProc($principal->getNumero());
            $counter = $lastNum ? substr($lastNum[0]['numero'], -3) : 0;
            $entity->setNumero("CUB-OF-" . $principal->getNumero() . "-" . date("Y") . "-" . sprintf('%03d', ++$counter));
        }
    }

    /**
     * Funcion auxiliar para crear los objetos que establecen la relacion entre
     * la Oferta y cada uno de sus procesos asociados
     * 
     * @param type   $em         Entity Manager
     * @param Oferta $entity     Objeto de la entidad Oferta con la que se desea asociar el proceso
     * @param int    $procesos   Ids del proceso principal
     * @param bool   $principal  Establece si el proceso a asociar es el principal
     */
    private function createOfertaProceso($em, $oferta, $idProceso, $principal) {
        $proceso = $em->getRepository('CostoServicioBundle:Proceso')->find($idProceso);
        $ofertaProceso = new OfertaProceso();
        $ofertaProceso->setOferta($oferta)
                ->setProceso($proceso)
                ->setPrincipal($principal);
        $em->persist($ofertaProceso);
    }

    /**
     * Funcion auxiliar para gestionar las categorias relacionadas con la Oferta
     * 
     * @param type   $em        Entity Manager
     * @param Oferta $entity    Objeto de la entidad Oferta con la que se desea asociar las categorias
     * @param int    $ids       Ids de las categorias
     */
    private function manageCategorias($em, Oferta $entity, $ids) {

        //debido a q las categorias pueden relacionarse tanto con materiales y con servicios 
        //necesito evitar relacionar la oferta 2 veces con la misma categoria
        foreach ($ids as $idCateg) {
            $categ = $em->getRepository('MaterialesBundle:subcategoria')->find($idCateg);
            if (!$entity->getCategorias()->contains($categ)) {
                $entity->addCategoria($categ);
            }
        }

        /*
          foreach ($categMat as $idCateg) {
          $subcategoria = $em->getRepository('MaterialesBundle:subcategoria')->find($idCateg);
          $entity->addCategoria($subcategoria);
          } */

        /*
          $op = $em->getRepository('CostoOfertaBundle:OfertaProceso')->findOp($entity->getId(), $idProceso);

          //si el proceso fue asociado anteriormente solo debo ponerlo como principal
          if ($entity->getOfertaProcesos()->contains($op)) {
          $op->getPrincipal() ? : $op->setPrincipal(TRUE);
          //de lo contrario lo creo como principal
          } else {
          $this->createOfertaProceso($em, $entity, $idProceso, TRUE);
          $this->setNumeroOferta($em, $entity, $idProceso);
          }

          $opPrincAnt = $em->getRepository('CostoOfertaBundle:OfertaProceso')->findOpPrincipal($entity->getId());
          //si existe un proceso principal anterior setearlo a falso
          //debo asegurarme que el proceso principal  sea distinto del q tenia asociado anteriormente
          //cambio tambien el num de la oferta debido a q se cambia el proceso principal asociado
          if ($opPrincAnt != NULL && $opPrincAnt != $op) {
          $opPrincAnt->setPrincipal(FALSE);
          $this->setNumeroOferta($em, $entity, $idProceso);
          } */
    }

}
