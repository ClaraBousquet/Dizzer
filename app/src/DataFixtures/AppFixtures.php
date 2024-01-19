<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Album;
use App\Entity\Artist;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create(locale: 'fr_FR');
        $albumListTitres = ['Bohemian Rhapsody', 'Like a Rolling Stone', 'Hotel California', 'Stairway to Heaven', 'Imagine', 'Smells Like Teen Spirit', 'Billie Jean', 'Shape of You', 'Hey Jude', 'Purple Rain', 'Thriller', 'Livin', 'Rolling in the Deep', 'Dont Stop Believin', 'Lose Yourself', 'Dancing Queen', 'Piano Man', 'Whats Going On', 'Hallelujah', 'My Heart Will Go On', 'A Day in the Life', 'Heroes', 'Kashmir', 'Uptown Funk', 'California Dreamin', 'Paint It Black', 'Comfortably Numb', 'I Want to Hold Your Hand', 'Light My Fire', 'All Along the Watchtower', 'Shake It Off'];
        $artistesList = ['Nirvana' => ['Nevermind']
        , 'Bruce Springsteen' => ['Born to Run']
        , 'The Eagles' => ['Hotel California'], 
        'The Beatles' => ['Abbey Road'], 
         ];
        $albumTitle = ['Abbey Road', 'Hotel California', 'Nevermind', 'Abbey Road', 'Hotel California'];
        $albumType = ['Rock', 'Pop', 'Rock', 'Rock', 'Rock', 'Rock'];
        // boucle de création des artistes (en utilisant les noms de la liste)
       // foreach ($artistesList as $artisteName) {
            //$artist = new Artist();
           // $artist->setArtistName($artisteName);
            //$manager->persist($artist);
       // }

        // boucle de création des albums
      for ($i = 0; $i < count($albumTitle); $i++) {
    $album = new Album();
   // $album->setAlbumName($faker->name);
    $album->setAlbumTitle($albumTitle[$i]);
    $album->setAlbumType($albumType[rand(0, count($albumType) - 1)]);
    $album->setAlbumListTitres($albumListTitres);

    // Parcours du tableau artistesList pour trouver l'artiste correspondant
    foreach ($artistesList as $artisteName => $albums) {
        if (in_array($albumTitle[$i], $albums)) {
            $artist = $manager->getRepository(Artist::class)->findOneBy(['artistName' => $artisteName]);

            if (!$artist) {
                $artist = new Artist();
                $artist->setArtistName($artisteName);
                $manager->persist($artist);
            }

            $album->setArtist($artist);
            break;
        }
    }

    $manager->persist($album);
}
    $manager->flush();
}
}