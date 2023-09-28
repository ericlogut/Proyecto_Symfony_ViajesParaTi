<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Proveedor;
use App\Form\ProveedorType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; 
use App\Repository\ProveedorRepository;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

class ProveedorController extends AbstractController
{
    // Controlador que reedirige a la lista de proveedores
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->redirectToRoute('list_proveedor');
    }
    
    // Controlador que lista proveedores
    #[Route('/proveedor', name: 'list_proveedor')]
    public function listaProveedores(EntityManagerInterface $entityManager, Request $request, PaginatorInterface $paginator): Response
    {
        $query = $entityManager->getRepository(Proveedor::class)->createQueryBuilder('p')
            ->getQuery();
    
        $pagination = $paginator->paginate(
            $query, // Los datos
            $request->query->getInt('page', 1), // Número de página por defecto
            5 // Número de elementos por página
        );
    
        // Renderiza la vista con los datos
        return $this->render('proveedor/list.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    // Controlador para crear proveedores
    #[Route('/proveedor/create', name: 'create_proveedor')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Creo proveedor
        $proveedor = new Proveedor();

        // Formulario a partir del ProveedorType
        $form = $this->createForm(ProveedorType::class, $proveedor);

        // Cogemos los datos del formulario
        $form->handleRequest($request);

        // Si recibe el formulario correcto con información válida realiza las gestiones necesarias con la información
        if ($form->isSubmitted() && $form->isValid()) {
            // Sacamos los datos
            $proveedor = $form->getData();

            // Indicamos las fechas
            $proveedor->setLastUpdate(new \DateTime());
            $proveedor->setCreateDateTime(new \DateTime());

            // Introducimos los datos
            $entityManager->persist($proveedor);
            $entityManager->flush();

            // Volvemos al listado
            return $this->redirectToRoute('list_proveedor');
        }

        // Si no nos han pasado información renderiza la vista para rellenar el formulario
        return $this->render('proveedor/new.html.twig', [
            'form' => $form,
        ]);
    }

    // Controlador para editar proveedores
    #[Route('/proveedor/edit/{id}', name: 'proveedor_edit')]
    public function editProveedor(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        // Encuentra proveedor
        $proveedor = $entityManager->getRepository(Proveedor::class)->find($id);
        
        // Error no encuentra proveedor
        if (!$proveedor) {
            throw $this->createNotFoundException(
                'No se encontró el proveedor con el ID '.$id
            );
        }
    
        $form = $this->createForm(ProveedorType::class, $proveedor, [
            'is_edit' => true, // Indica que es un formulario de edición
            // Como solo he usado una única vista para crear y editar he usado este método para poder diferenciarlas
        ]);
    
        // Cogemos la información del formulario
        $form->handleRequest($request);
    
        // Si recibe el formulario correcto con información válida realiza las gestiones necesarias con la información
        if ($form->isSubmitted() && $form->isValid()) {
            // Obtenemos la fecha de hoy para registrar su última actualización
            $proveedor->setLastUpdate(new \DateTime());
            
            // Modificamos la información
            $entityManager->flush();
            
            // Volvemos a la lista de proveedores
            return $this->redirectToRoute('list_proveedor', [
                'id' => $proveedor->getId(),
            ]);
        }
    
        // Renderizamos el formulario para realizar modificaciones en los datos 
        return $this->render('proveedor/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    // Controlador para eliminar proveedores
    #[Route('/proveedor/delete/{id}', name: 'proveedor_delete')]
    public function delete(EntityManagerInterface $entityManager, ProveedorRepository  $proveedorRepository, int $id): Response
    {
        // Busca el proveedor
        $proveedor = $proveedorRepository->find($id);

        // Borra el proveedor
        $entityManager->remove($proveedor);
        $entityManager->flush();

        // Carga la lista de proveedores
        return $this->redirectToRoute('list_proveedor');

    }
}
