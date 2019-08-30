<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\User;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_home")
     */
    public function index()
    {

        $reservationRepository = $this->getDoctrine()->getRepository(Reservation::class);
        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $reservations = $reservationRepository->findAll();
        $someUsers = count($userRepository->findAll()) - 1;
        $someReservations = count($reservationRepository->findAll());

        return $this->render('admin/index.html.twig', [
            'reservations' => $reservations,
            'someReservations' => $someReservations,
            'someUsers' => $someUsers,
            'controller_name' => 'AdminController',
        ]);
    }
}
