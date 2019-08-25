<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request)
    {
        $user = $this->getUser();
        $reservation = new Reservation();
        $reservation->setUser($user);
        $reservation->setcreatedAt(new \DateTime('now'));
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
        dump($user);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('reservation_show', [
                'id' => $reservation->getId(),
            ]);
        }

        return $this->render('home/index.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }
}
