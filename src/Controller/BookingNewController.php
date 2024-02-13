<?php

namespace App\Controller;


use App\Entity\Booking;
use App\Form\NewBookingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class BookingNewController extends AbstractController
{
    #[Route('/new-confirmation', name: 'new_confirmation_page')]
    public function confirmationPage(): Response
    {
        return $this->render('booking_new/new_confirmation_page.html.twig');
    }

    #[Route('/booking_new', name: 'app_booking_new')]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        Security $security
    ): Response {
        $user = $security->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException("Vous devez être connecté pour accéder à cette page.");
        }

        $newBooking = new Booking();
        $newBookingForm = $this->createForm(NewBookingType::class, $newBooking);

        $newBookingForm->handleRequest($request);

        if ($newBookingForm->isSubmitted() && $newBookingForm->isValid()) {
            // Vérifiez si une réservation avec la même heure existe déjà
            $existingBooking = $entityManager->getRepository(Booking::class)->findOneBy([
                'beginAt' => $newBooking->getBeginAt(),
            ]);

            if ($existingBooking) {
                // Afficher un message d'erreur dans le template Twig
                $this->addFlash('error', 'Une date avec la même heure existe déjà. Veuillez modifier l\'heure et réessayer.');
            } else {
                // Enregistrez le nouveau booking en base de données
                $entityManager->persist($newBooking);
                $entityManager->flush();
                return $this->redirectToRoute('new_confirmation_page');
            }
        }

        return $this->render('booking_new/index.html.twig', [
            'newBookingForm' => $newBookingForm->createView(),
        ]);
    }
}
