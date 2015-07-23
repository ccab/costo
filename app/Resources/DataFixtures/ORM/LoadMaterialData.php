<?php

namespace Costo\ServicioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Costo\MaterialesBundle\Entity\material;
use Costo\MaterialesBundle\Entity\precio;

class LoadMaterialData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        //Patch Panel
        $ppanel = new material();
        $ppanel->setCodigo('MCU1308_R&M')
                ->setFabricante('R&M')
                ->setSubcategoria($this->getReference("subcateg-utp"))
                ->setDescripcion('Patch Panel 19" 1 U de 24 puertos RJ-45 Cat 5E')
                ->setUnidadMedida('u');
        
        $precioPpanelCUP = new precio();
        $precioPpanelCUP->setMaterial($ppanel)
                ->setMoneda($this->getReference("moneda-cup"))
                ->setValor(29.72);
        
        $precioPpanelCUC = new precio();
        $precioPpanelCUC->setMaterial($ppanel)
                ->setMoneda($this->getReference("moneda-cuc"))
                ->setValor(128.22);
        
        //Patch Cord
        $pcord = new material();
        $pcord->setCodigo('MCU1310_R&M')
                ->setFabricante('R&M')
                ->setSubcategoria($this->getReference("subcateg-utp"))
                ->setDescripcion('Patch Cord UTP RJ-45 RJ-45 (0.5m)')
                ->setUnidadMedida('u');
        
        $precioPcordCUP = new precio();
        $precioPcordCUP->setMaterial($pcord)
                ->setMoneda($this->getReference("moneda-cup"))
                ->setValor(4.27);
        
        $precioPcordCUC = new precio();
        $precioPcordCUC->setMaterial($pcord)
                ->setMoneda($this->getReference("moneda-cuc"))
                ->setValor(0.89);
        
        //Canaleta
        $canaleta = new material();
        $canaleta->setCodigo('MCN1402_EMI')
                ->setFabricante('EMI')
                ->setSubcategoria($this->getReference("subcateg-canalizacion"))
                ->setDescripcion('Canaleta de PVC (8X16mm) (Tira de 2m)')
                ->setUnidadMedida('u');
        
        $precioCanaletaCUC = new precio();
        $precioCanaletaCUC->setMaterial($canaleta)
                ->setMoneda($this->getReference("moneda-cuc"))
                ->setValor(0.78);
        
        $precioCanaletaCUP = new precio();
        $precioCanaletaCUP->setMaterial($canaleta)
                ->setMoneda($this->getReference("moneda-cup"))
                ->setValor(0);
        
        //Tubo
        $tubo = new material();
        $tubo->setCodigo('MCN1308_BKT')
                ->setFabricante('BKT')
                ->setSubcategoria($this->getReference("subcateg-canalizacion"))
                ->setDescripcion('Tubo Flexible 25mm')
                ->setUnidadMedida('m');
        
        $precioTuboCUC = new precio();
        $precioTuboCUC->setMaterial($tubo)
                ->setMoneda($this->getReference("moneda-cuc"))
                ->setValor(1.06);
        
        $precioTuboCUP = new precio();
        $precioTuboCUP->setMaterial($tubo)
                ->setMoneda($this->getReference("moneda-cup"))
                ->setValor(0.22);
        
        //Conector
        $conector = new material();
        $conector->setCodigo('MCT1304_FUR')
                ->setFabricante('Furukawa')
                ->setSubcategoria($this->getReference("subcateg-telefonico"))
                ->setDescripcion('Conector hembra 110 IDC (B50) CAT. 5E 5 PARES')
                ->setUnidadMedida('u');
        
        $precioConectorCUC = new precio();
        $precioConectorCUC->setMaterial($conector)
                ->setMoneda($this->getReference("moneda-cuc"))
                ->setValor(0.61);
        
        $precioConectorCUP = new precio();
        $precioConectorCUP->setMaterial($conector)
                ->setMoneda($this->getReference("moneda-cup"))
                ->setValor(0.04);
        
        //Caja
        $caja = new material();
        $caja->setCodigo('MCT1401_KRN')
                ->setFabricante('Krone')
                ->setSubcategoria($this->getReference("subcateg-telefonico"))
                ->setDescripcion('Caja de distribución telefónica 30 pares')
                ->setUnidadMedida('u');
        
        $precioCajaCUC = new precio();
        $precioCajaCUC->setMaterial($caja)
                ->setMoneda($this->getReference("moneda-cuc"))
                ->setValor(104.26);
        
        $precioCajaCUP = new precio();
        $precioCajaCUP->setMaterial($caja)
                ->setMoneda($this->getReference("moneda-cup"))
                ->setValor(18.74);
        
        //Cable
        $cable = new material();
        $cable->setCodigo('MCE1301_KBX')
                ->setFabricante('KOBREX')
                ->setSubcategoria($this->getReference("subcateg-electrico"))
                ->setDescripcion('Cable eléctrico  Royal Cord AWG – 10 (3 vías) Flexible')
                ->setUnidadMedida('m');
        
        $precioCableCUC = new precio();
        $precioCableCUC->setMaterial($cable)
                ->setMoneda($this->getReference("moneda-cuc"))
                ->setValor(4.63);
        
        $precioCableCUP = new precio();
        $precioCableCUP->setMaterial($cable)
                ->setMoneda($this->getReference("moneda-cup"))
                ->setValor(0.62);
        
        //Barra
        $barra = new material();
        $barra->setCodigo('MCE1306_KBX')
                ->setFabricante('KOBREX')
                ->setSubcategoria($this->getReference("subcateg-electrico"))
                ->setDescripcion('Barra de Tierra y Accesorios de Fijación')
                ->setUnidadMedida('u');
        
        $precioBarraCUC = new precio();
        $precioBarraCUC->setMaterial($barra)
                ->setMoneda($this->getReference("moneda-cuc"))
                ->setValor(51.68);
        
        $precioBarraCUP = new precio();
        $precioBarraCUP->setMaterial($barra)
                ->setMoneda($this->getReference("moneda-cup"))
                ->setValor(12.92);
        
        //FO
        $fo = new material();
        $fo->setCodigo('MFO1302_VIN')
                ->setFabricante('VINA-OFC')
                ->setSubcategoria($this->getReference("subcateg-fo"))
                ->setDescripcion('Cable de Fibra Óptica ADSS 24 F.O. G652D')
                ->setUnidadMedida('m');
        
        $precioFoCUC = new precio();
        $precioFoCUC->setMaterial($fo)
                ->setMoneda($this->getReference("moneda-cuc"))
                ->setValor(1.10);
        
        $precioFoCUP = new precio();
        $precioFoCUP->setMaterial($fo)
                ->setMoneda($this->getReference("moneda-cup"))
                ->setValor(0.34);
        
        //ODF
        $odf = new material();
        $odf->setCodigo('MFO1309_BKT')
                ->setFabricante('BKT')
                ->setSubcategoria($this->getReference("subcateg-fo"))
                ->setDescripcion('ODF 12 FO de Gabinete 19", puertos SC')
                ->setUnidadMedida('u');
        
        $precioOdfCUC = new precio();
        $precioOdfCUC->setMaterial($odf)
                ->setMoneda($this->getReference("moneda-cuc"))
                ->setValor(39.07);
        
        $precioOdfCUP = new precio();
        $precioOdfCUP->setMaterial($odf)
                ->setMoneda($this->getReference("moneda-cup"))
                ->setValor(12.22);
        
        
        $manager->persist($ppanel);
        $manager->persist($precioPpanelCUP);
        $manager->persist($precioPpanelCUC);
        
        $manager->persist($pcord);
        $manager->persist($precioPcordCUP);
        $manager->persist($precioPcordCUC);
        
        $manager->persist($canaleta);
        $manager->persist($precioCanaletaCUP);
        $manager->persist($precioCanaletaCUC);
        
        $manager->persist($tubo);
        $manager->persist($precioTuboCUP);
        $manager->persist($precioTuboCUC);
        
        $manager->persist($conector);
        $manager->persist($precioConectorCUP);
        $manager->persist($precioConectorCUC);
        
        $manager->persist($caja);
        $manager->persist($precioCajaCUP);
        $manager->persist($precioCajaCUC);
        
        $manager->persist($cable);
        $manager->persist($precioCableCUP);
        $manager->persist($precioCableCUC);
        
        $manager->persist($barra);
        $manager->persist($precioBarraCUP);
        $manager->persist($precioBarraCUC);
        
        $manager->persist($fo);
        $manager->persist($precioFoCUP);
        $manager->persist($precioFoCUC);
        
        $manager->persist($odf);
        $manager->persist($precioOdfCUP);
        $manager->persist($precioOdfCUC);
        
        $manager->flush();
    }

    public function getOrder() {
        return 20;
    }

}
