<?php

namespace NewsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use NewsBundle\Entity\Article;
use NewsBundle\Form\ArticleType;
use NewsBundle\Entity\Category;
use NewsBundle\Form\CategoryType;

/**
 * Admin Controller
 *
 * @Route("/admin")
 */
class AdminController extends Controller
{   
    
    /**
     * @Route("/", name="admin_index")
     */
    public function IndexAction()
    {
        return $this->render(':admin:index.html.twig', array(
            // ...
        ));
    }
    
    /**
     * Lists all Article entities.
     *
     * @Route("/articleIndex", name="admin_articleIndex")
     * @Method("GET")
     */
	public function ArticleIndexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('NewsBundle:Article')->findAll();

        return $this->render(':admin:articleIndex.html.twig', array(
            'articles' => $articles,
        ));
    }
    
    /**
     * Displays a form to edit an existing Article entity.
     *
     * @Route("/{id}/edit", name="admin_articleEdit")
     * @Method({"GET", "POST"})
     */
    public function ArticleeditAction(Request $request, Article $article)
    {
        $deleteForm = $this->createArticleDeleteForm($article);
        $editForm = $this->createForm('NewsBundle\Form\ArticleType', $article);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('admin_articleEdit', array('id' => $article->getId()));
        }

        return $this->render('admin/articleEdit.html.twig', array(
            'article' => $article,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Creates a new Article entity.
     *
     * @Route("/newArticle", name="admin_articleNew")
     * @Method({"GET", "POST"})
     */
    public function ArticlenewAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm('NewsBundle\Form\ArticleType', $article);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            
            
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article_show', array('id' => $article->getId()));
        }

        return $this->render(':admin:articleNew.html.twig', array(
            'article' => $article,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * Deletes a Article entity.
     *
     * @Route("/articleDelete/{id}", name="admin_articleDelete")
     * @Method("DELETE")
     */
    public function ArticleDeleteAction(Request $request, Article $article)
    {
        $form = $this->createArticleDeleteForm($article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();
        }

        return $this->redirectToRoute('admin_articleIndex');
    }
    
    /**
     * Creates a form to delete a Article entity.
     *
     * @param Article $article The Article entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createArticleDeleteForm(Article $article)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_articleDelete', array('id' => $article->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    /**
     * Lists all Category entities.
     *
     * @Route("/categoryIndex", name="admin_categoryIndex")
     * @Method("GET")
     */
	public function CategoryIndexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('NewsBundle:Category')->findAll();

        return $this->render(':admin:categoryIndex.html.twig', array(
            'categories' => $categories,
        ));
    }
    
    /**
     * Creates a new Category entity.
     *
     * @Route("/categoryNew", name="admin_categoryNew")
     * @Method({"GET", "POST"})
     */
    public function CategoryNewAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm('NewsBundle\Form\CategoryType', $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('category_show', array('id' => $category->getId()));
        }

        return $this->render(':admin:categoryNew.html.twig', array(
            'category' => $category,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * Displays a form to edit an existing Category entity.
     *
     * @Route("categoryEdit/{id}/edit", name="admin_categoryEdit")
     * @Method({"GET", "POST"})
     */
    public function CategoryEditAction(Request $request, Category $category)
    {
        $deleteForm = $this->createCategoryDeleteForm($category);
        $editForm = $this->createForm('NewsBundle\Form\CategoryType', $category);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('admin_categoryIndex', array('id' => $category->getId()));
        }

        return $this->render(':admin:categoryEdit.html.twig', array(
            'category' => $category,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    
    /**
     * Deletes a Category entity.
     *
     * @Route("/CategoryDelete/{id}", name="admin_categoryDelete")
     * @Method("DELETE")
     */
    public function CategoryDeleteAction(Request $request, Category $category)
    {
        $form = $this->createCategoryDeleteForm($category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush();
        }

        return $this->redirectToRoute('admin_categoryIndex');
    }

    /**
     * Creates a form to delete a Category entity.
     *
     * @param Category $category The Category entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCategoryDeleteForm(Category $category)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_categoryDelete', array('id' => $category->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    
    
    
    
     
}