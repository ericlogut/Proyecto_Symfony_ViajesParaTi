<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Proveedor;

// Seeder de proveedores
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Pongo la misma fecha de creación a todos
        $fechaActual = new \DateTime();

        // Proveedor 1
        $proveedor1 = new Proveedor();
        $proveedor1->setNombre('Proveedor 1');
        $proveedor1->setEmail('proveedor1@example.com');
        $proveedor1->setTelefono(987654321);
        $proveedor1->setTipoProveedor('Hotel');
        $proveedor1->setActivo(1);
        $proveedor1->setLastUpdate($fechaActual);

        $manager->persist($proveedor1);

        // Proveedor 2
        $proveedor2 = new Proveedor();
        $proveedor2->setNombre('Proveedor 2');
        $proveedor2->setEmail('proveedor2@example.com');
        $proveedor2->setTelefono('987654321');
        $proveedor2->setTipoProveedor('Pista');
        $proveedor2->setActivo(1);
        $proveedor2->setLastUpdate($fechaActual);

        $manager->persist($proveedor2);

        // Proveedor 3
        $proveedor3 = new Proveedor();
        $proveedor3->setNombre('Proveedor 3');
        $proveedor3->setEmail('proveedor3@example.com');
        $proveedor3->setTelefono('555555555');
        $proveedor3->setTipoProveedor('Complementario');
        $proveedor3->setActivo(0);
        $proveedor3->setLastUpdate($fechaActual);

        $manager->persist($proveedor3);

        // Proveedor 4
        $proveedor4 = new Proveedor();
        $proveedor4->setNombre('Proveedor 4');
        $proveedor4->setEmail('proveedor4@example.com');
        $proveedor4->setTelefono('999999999');
        $proveedor4->setTipoProveedor('Hotel');
        $proveedor4->setActivo(1);
        $proveedor4->setLastUpdate($fechaActual);

        $manager->persist($proveedor4);

        // Proveedor 5
        $proveedor5 = new Proveedor();
        $proveedor5->setNombre('Proveedor 5');
        $proveedor5->setEmail('proveedor5@example.com');
        $proveedor5->setTelefono('777777777');
        $proveedor5->setTipoProveedor('Pista');
        $proveedor5->setActivo(1);
        $proveedor5->setLastUpdate($fechaActual);

        $manager->persist($proveedor5);

        // Subo todos los proveedores a la base de datos
        $manager->flush();
    }
}
