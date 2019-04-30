<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\TapaType;
use AppBundle\Entity\Tapa;

/**
 * @Route("/gestionTapas")
 */
class GestionTapasController extends Controller
{
    /**
     * @Route("/nuevaTapa", name="nuevaTapa")
     */
    public function nuevaTapaAction(Request $request)
    {
        $tapa = new Tapa();
        $form = $this->createForm(TapaType::class, $tapa);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $tapa = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tapa);
            $entityManager->flush();

            return $this->redirectToRoute('task_success');
        }

        return $this->render('gestionTapas/nuevaTapa.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
