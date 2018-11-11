<?php

namespace App\Controller;

use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/categories", name="categories")
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \App\Repository\CategoryRepository $categoryRepository
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, CategoryRepository $categoryRepository): Response
    {
        $form = $this->createForm(CategoryType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var \App\Entity\Category $category */
            $category = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('categories');
        }

        return $this->render('category/index.html.twig', [
            'form' => $form->createView(),
            'categories' => $categoryRepository->findAll()
        ]);
    }

    /**
     * @Route("/categories/{categoryId}/delete", name="categories.destroy", methods={"DELETE"})
     *
     * @param int $categoryId
     * @param \App\Repository\CategoryRepository $categoryRepository
     * @param \Symfony\Component\HttpFoundation\Session\SessionInterface $session
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy(int $categoryId, CategoryRepository $categoryRepository, SessionInterface $session): Response
    {
        $category = $categoryRepository->find($categoryId);

        $em = $this->getDoctrine()->getManager();

        $em->remove($category);

        $em->flush();

        $this->addFlash('category.deletion', sprintf('Category %s deleted', $category->getName()));

        return $this->redirectToRoute('categories');
    }
}
