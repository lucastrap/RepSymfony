<?php

namespace App\DataFixtures;

use DateTimeImmutable;
use Faker\Factory;
use App\Entity\Artiste;
use App\Entity\Chanson;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DiscothequeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $genre = ['Rock', 'Pop', 'Jazz', 'Hip-Hop', 'Electronic', 'Classical', 'Country', 'Blues', 'Reggae', 'Folk'];
  
        $faker = Factory::create('fr_FR'); // plus d'information ici: https://fakerphp.github.io/
            $types = [];
            $typeNames = ['Auteur', 'Compositeur', 'Interprète', 'Arrangeur', 'Musicien'];
            
            for ($i = 0; $i < 5; $i++) {
                $type = (new Type())
                    ->setType($typeNames[$i])
                    ->setDescription($faker->sentence(2));
            
                $types[] = $type;
                $manager->persist($type);
            }
        $artistes = [];
        for ($i = 0; $i < 50; $i++) {
            $dateArt = DateTimeImmutable::createFromMutable($faker->dateTime());
            $artiste = (new Artiste())
                ->setNom($faker->name())
                ->setPrenom($faker->name())
                ->setPhoto("https://picsum.photos/360/360?image=". ($i+400))
                ->setDateNaissance($dateArt)
                ->setLieuNaissance($faker->sentence(2))
                ->setDescription($faker->sentence(4))
                ->setType($types[rand (0, count($types)-1)]);
            $artiste->updateSlug();
            $artistes[] = $artiste;
            $manager->persist($artiste);
        }
        $chansons = [];
        for ($i = 0; $i < 50; $i++) {
            $dateCh = DateTimeImmutable::createFromMutable($faker->dateTime());
            $chanson = (new Chanson())
                ->setTitre($faker->sentence (3))
                ->setPhotoCouverture("https://picsum.photos/360/360?image=". ($i+500))
                ->setDateSortie($dateCh)
                ->setGenre($faker->randomElement($genre))
                ->setLangue($faker->country())
                ->addArtiste($artiste);
            $chanson->updateSlug();
            $chansons[] = $chanson;
            $manager->persist($chanson);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
