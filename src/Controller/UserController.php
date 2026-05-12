<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class UserController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser() instanceof UserInterface) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('Çıkış Symfony güvenlik dinleyicisi tarafından işlenir.');
    }

    #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
    public function register(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher,
        UserRepository $userRepository,
    ): Response {
        if ($this->getUser() instanceof UserInterface) {
            return $this->redirectToRoute('app_home');
        }

        if ($request->isMethod('POST')) {
            $token = $request->request->getString('_csrf_token');
            if (!$this->isCsrfTokenValid('user_register', $token)) {
                $this->addFlash('error', 'Güvenlik doğrulaması başarısız. Formu yeniden gönderin.');

                return $this->redirectToRoute('app_register');
            }

            $username = trim($request->request->getString('username'));
            $email = trim($request->request->getString('email'));
            $plainPassword = $request->request->getString('password');
            $plainPasswordConfirm = $request->request->getString('password_confirm');

            if ('' === $username || '' === $email || '' === $plainPassword) {
                $this->addFlash('error', 'Kullanıcı adı, e-posta ve şifre zorunludur.');

                return $this->redirectToRoute('app_register');
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->addFlash('error', 'Geçerli bir e-posta girin.');

                return $this->redirectToRoute('app_register');
            }

            if ($plainPassword !== $plainPasswordConfirm) {
                $this->addFlash('error', 'Şifreler eşleşmiyor.');

                return $this->redirectToRoute('app_register');
            }

            if (strlen($plainPassword) < 6) {
                $this->addFlash('error', 'Şifre en az 6 karakter olmalıdır.');

                return $this->redirectToRoute('app_register');
            }

            if (null !== $userRepository->findOneBy(['username' => $username])) {
                $this->addFlash('error', 'Bu kullanıcı adı zaten kullanılıyor.');

                return $this->redirectToRoute('app_register');
            }

            if (null !== $userRepository->findOneBy(['email' => $email])) {
                $this->addFlash('error', 'Bu e-posta ile zaten kayıt var.');

                return $this->redirectToRoute('app_register');
            }

            $user = new User();
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setName($username);
            $user->setPassword($passwordHasher->hashPassword($user, $plainPassword));

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Kayıt tamamlandı. Giriş yapabilirsiniz.');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('home/register.html.twig');
    }
}
