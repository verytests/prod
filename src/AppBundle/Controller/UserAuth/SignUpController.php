<?php

namespace AppBundle\Controller\UserAuth;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\Log;
use AppBundle\Entity\User;
use AppBundle\Utils\JsonResponseUtil;
use AppBundle\Utils\LogUtil;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SignUpController extends BaseController
{
    /**
     * Method to render sign up page
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/signup", name="signup_page", methods={"GET"})
     */
    public function signUpRender()
    {
        return $this->render('user_auth/signup_page.html.twig');
    }

    /**
     * Method to handle the sign up process
     *
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return JsonResponse
     *
     * @Route("/signupAction", name="signup_action", methods={"POST"})
     */
    public function signUpAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $login = $request->request->get('login');
        $email = $request->request->get('email');
        $pass = $request->request->get('pass');

        $user = new User();
        $user
            ->setLogin($login)
            ->setEmail($email)
            ->setToken('')
            ->setRoles(['ROLE_USER'])
            ->setPassword($encoder->encodePassword($user, $pass));

        try {
            $this->get('app.user')->save($user);
        } catch (UniqueConstraintViolationException $e) {
            return $this->errorResponse(
               JsonResponseUtil::constructData(JsonResponseUtil::USER_ALREADY_REGISTERED)
            );
        }

        $this->get('app.log')->info(
            LogUtil::constructData(LogUtil::NEW_USER_LOG, [
                'email' => $email,
                'login' => $login,
                'pass' => $pass
            ]), Log::SOURCE_SIGNUP);

        return $this->successResponse();
    }
}
