<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Album;
use App\Entity\Music;
use App\Entity\Artist;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create(locale: 'fr_FR');
        $musicType = ['Rock', 'Jazz', 'Pop', 'Classic', 'Rap', 'pop-rock', 'métal', 'pop-punk'];
        $albumType = ['Rock', 'Jazz', 'Pop', 'Classic', 'Rap', 'pop-rock', 'métal', 'pop-punk'];
        // boucle de création des artistes 60
        for ($i = 0; $i < 60; $i++) {
            $artist = new Artist();
            $artist->setArtistName($faker->name);
            $manager->persist($artist);
        }

        // boucle de création des musiques 60
        // for ($i = 0; $i < 60; $i++) {
        //     $music = new Music();
        //     $music->setName($faker->name);
        //     $music->setType($musicType[array_rand($musicType)]);
        //     $manager->persist($music);
        // }

        //boucle de création des albums 60
        for ($i = 0; $i < 60; $i++) {
            $album = new Album();
            $album->setAlbumName($faker->name);
            $album->setAlbumType($albumType[array_rand($albumType)]);
            $album->setArtist($artist);
            $manager->persist($album);
        }
     

        $manager->flush();
    }
}
