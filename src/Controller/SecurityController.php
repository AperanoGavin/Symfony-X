<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\LoginFormType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Repository\CustomerRepository;

//rajoute UserPasswordEncoderInterface



use App\Form\RegisterFormType;


class SecurityController extends AbstractController
{
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginFormType::class, [
            'username' => $lastUsername,
        ]);

        return $this->render('security/login.html.twig', [
            'form' => $form->createView(),
            'error' => $error,
        ]);
    }

    
    #[Route('/register', name: 'register')]
    public function register(Request $request
    , UserPasswordHasherInterface $passwordHasher
    , CustomerRepository $customerRepository 
    , AuthenticationUtils $authenticationUtils
    ): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $form = $this->createForm(RegisterFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $userEmail = $form->getData()['email'] ;
            //$existUser = $this->customerRepository->findCustomerByEmail($userEmail);
            $existUser = $this->customerRepository->findOneBy(['email' => $userEmail]);
            if($existUser){
                return $this->render('security/register.html.twig', [
                    'form' => $form->createView(),
                    'error' => 'Email already exist'

                ]);
            }
            //dump( $existUser); die;

            // Encodage du mot de passe avant de le stocker
            $userPassword = $form->getData()['password'] ;
            $encodedPassword = $passwordHasher->hashPassword($user, $userPassword);
            $user->setPassword($encodedPassword);

            // Enregistrez l'utilisateur dans la base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // Redirigez l'utilisateur vers une autre page après l'inscription
            return $this->redirectToRoute('home');
        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}
