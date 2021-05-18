<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Product;
use App\Entity\Feedback;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        return $this->redirect($routeBuilder->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Labweb3');
    }

    public function configureMenuItems(): iterable
    {
        return[
        MenuItem::linkToCrud('Users', 'fa fa-user', User::class),
        MenuItem::linkToCrud('Product', 'fas fa-shopping-cart', Product::class),
        MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'product_index')
    ];
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }

}
