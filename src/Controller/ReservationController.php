<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Room;
use App\Form\ReservationType;
use App\Repository\KindRepository;
use App\Repository\ReservationRepository;
use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reservation")
 */
class ReservationController extends AbstractController
{
    /**
     * @Route("/", name="reservation_index", methods={"GET"})
     */
    public function index(ReservationRepository $reservationRepository): Response
    {
        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservationRepository->findAll(),
            'user_reservations' => $reservationRepository->find($this->getUser())
        ]);
    }

    /**
     * @Route("/new", name="reservation_new", methods={"GET","POST"})
     */
    public function new(Request $request, RoomRepository $roomRepository): Response
    {
        $reservation = new Reservation();
        $roomId = $request->query->get('id');
        if (!empty($roomId) && is_numeric($roomId)) {
            $reservation->setRoomId($roomRepository->find($roomId));
        }
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservation->setUserId($this->getUser());

            $amount = $form['room_id']->getData();
            $begin = $form['checkin_date']->getData();
            $end = $form['checkout_date']->getData();


            $kind = $roomRepository->find($amount);


            $i = 0;

            foreach ($kind->getReservations() as $res) {
                if (($begin >= $res->getCheckinDate() && $begin <= $res->getCheckoutDate()) || ($end >= $res->getCheckinDate() && $end <= $res->getCheckoutDate()) || ($begin <= $res->getCheckinDate() && $end >= $res->getCheckoutDate())) {
                    $i++;
                    $this->addFlash('error',  'This date has already been reserved. This room will be available at'." ".$res->getCheckoutDate()->format('d-m-Y'));
                }

            }
            if ($i == 0) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($reservation);
                $entityManager->flush();

                return $this->redirectToRoute('reservation_index');
            }
        }


        return $this->render('reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="reservation_show", methods={"GET"})
     */
    public function show(Reservation $reservation): Response
    {
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reservation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reservation $reservation): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservation_index');
        }

        return $this->render('reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reservation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Reservation $reservation): Response
    {
        if ($this->isCsrfTokenValid('delete' . $reservation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservation_index');
    }
}
