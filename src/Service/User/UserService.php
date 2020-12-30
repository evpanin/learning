<?php


namespace App\Service\User;


use App\Entity\User;
use App\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService
{

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserRepositoryInterface $userRepository,
                                UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function handleCreate(User $user)
    {
        $password = $this->passwordEncoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);
        $user->setRoles(["ROLE_ADMIN"]);
        $this->userRepository->setCreate($user);

        return $this;
    }

    /**
     * @param User $user
     * @return UserService
     */
    public function handleUpdate(User $user)
    {
        $password = $this->passwordEncoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);

        $this->userRepository->setSave($user);

        return $this;
    }

}