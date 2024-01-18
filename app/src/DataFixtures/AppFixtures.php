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
        $albumListTitres = ['Bohemian Rhapsody','Like a Rolling Stone','Hotel California','Stairway to Heaven','Imagine','Smells Like Teen Spirit','Billie Jean','Shape of You','Hey Jude','Purple Rain','Thriller',
'Sweet Child O Mine','Let It Be','Yesterday','Someone Like You','I Will Always Love You',
'Livin','Rolling in the Deep','Dont Stop Believin','Lose Yourself','Dancing Queen','Piano Man','Whats Going On','Hallelujah','My Heart Will Go On','A Day in the Life',
'Heroes','Kashmir','Uptown Funk','California Dreamin','Paint It Black','Comfortably Numb','I Want to Hold Your Hand','Hey Ya!','London Calling','Born to Run',
'Superstition','One','No Woman, No Cry','Respect','Born in the U.S.A.','Sweet Caroline','Enter Sandman','Dream On','Good Vibrations','Light My Fire','All Along the Watchtower','Shake It Off'];

        $albumTitle = ['Abbey Road', 'The Dark Side of the Moon', 'A Night at the Opera','Hotel California', 'Born to Run','Nevermind', 'Rumours', 'The Wall', 'The Joshua Tree', 'Wish You Were Here', 'Abbey Road', 'The Dark Side of the Moon', 'A Night at the Opera','Hotel California', 'Born to Run','Nevermind', 'Rumours', 'The Wall', 'The Joshua Tree', 'Wish You Were Here', 'back in black', 'screaming bloody murder', 'no one cares', 'paranoid', 'the wall', 'wish you were here', 'back in black', 'screaming bloody murder', 'no one cares', 'paranoid', 'the wall', 'wish you were here'];
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
            $album->setAlbumTitle($albumTitle[array_rand($albumTitle)]);
            $album->setAlbumType($albumType[array_rand($albumType)]);
            $album->setAlbumListTitres($albumListTitres[array_rand($albumListTitres)]);
            $album->setArtist($artist);
            $manager->persist($album);
        }
     
   
        $manager->flush();
    }
}
