<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Faker\Factory;

class TestController extends AbstractController
{
    #[Route('/test/twig', name: 'app_test')]
    public function index(): Response
    {
        $faker = Factory::create('fr_FR');

        $users = [];
        for($i= 0; $i < 9; $i++){
            $user =[
                'name' => $faker->name(),
                'email' => $faker->email(),
                'age' => $faker->randomNumber(2, false),
                'address' => [
                    'street' => $faker->streetName(),
                    'code_postal' => $faker->postcode(),
                    'city' => $faker->city(),
                    'country' => $faker->country(),
                ],
                'picture' => $faker->imageUrl(50, 50, 'animals', true, 'dogs', true, 'jpg'),
                'cover' => $faker->imageUrl(360, 360, 'jpg'),
                'createdAt' => $faker->dateTimeBetween('-5 months'),
            ];
            $users[$i] = $user;
        }

        return $this->render('test/index.html.twig', [
            'title' => 'page accueil',
            'users' => $users,
        ]);
    }
}
