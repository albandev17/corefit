<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Order;
use App\Entity\OrderDetails;
use App\Form\OrderType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/commande", name="order")
     */
    public function index(Cart $cart,Request $request): Response
    {

        if (!$this->getUser()->getAdresses()->getValues()){
            return $this->redirectToRoute('account_adress_add');

        }

        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()
        ]);


        return $this->render('order/index.html.twig',[
            'form' => $form->createView(),
            'cart' => $cart->getFull()
        ]);
    }

    /**
     * @Route("/commande/recapitulatif", name="order_recap")
     */
    public function add(Cart $cart,Request $request): Response
    {


        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()
        ]);

        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid() ){
                $date = new DateTime();


                $order = new Order();
                $order->setUser($this->getUser());
                $order->setCreatedAt($date);
                $order->setIsPaid(0);

                $this->entityManager->persist($order);


                foreach ($cart->getFull() as $program) {
                    $orderDetails = new OrderDetails();
                    $orderDetails->setMyOrder($order);
                    $orderDetails->setProgram($program['program']->getName());
                    $orderDetails->setQuantity($program['quantity']);
                    $orderDetails->setPrice($program['program']->getPrice());
                    $orderDetails->setTotal($program['program']->getPrice() * $program['quantity']);
                    $this->entityManager->persist($orderDetails);

                }
                
                $this->entityManager->flush();

                return $this->render('order/add.html.twig', [
                    'cart'      => $cart->getFull(),
                ]);
            
            }

            return $this->redirectToRoute('cart');

    }
}
