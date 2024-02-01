<?php

namespace App\Service;

use App\Entity\Tfa;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\Serializer\SerializerInterface;

class TfaService
{


    public function __construct(private  EntityManagerInterface $entityManager, private  SerializerInterface $serializer) {

    }

    public function saveStoryFromJson($jsonFilePath)
    {

        // Vérifier si le fichier existe
        if (!file_exists($jsonFilePath)) {
            throw new FileNotFoundException("Le fichier JSON n'a pas été trouvé.");
        }
        // Lire le contenu du fichier JSON
        $jsonContent = file_get_contents($jsonFilePath);
        $data = json_decode($jsonContent, true, 512, JSON_THROW_ON_ERROR);

        // Créer une nouvelle instance de Storyue et la remplir avec les données
        $dialog = new Tfa();
        $dialog->setS($data['situation']);
        $dialog->setP($data['personen']);
        $dialog->setO($data['ort']);
        $dialog->setA($data['A']);
        $dialog->setB($data['B']);

        // Sauvegarder l'entité dans la base de données
        $this->entityManager->persist($dialog);
        $this->entityManager->flush();


    }
    public function saveAllStoryToJsonFile($db): void {
        // Récupérer toutes les entités Storyue
        $dialogs = $this->entityManager->getRepository(Tfa::class)->findAll();

        // Sérialiser les entités en JSON
        $jsonData = $this->serializer->serialize($dialogs, 'json');

        // Chemin du fichier où sauvegarder les données
        $jsonFilePath = 'public/db/'.$db.'.json';

        // Écrire les données dans le fichier, en écrasant les données existantes
        file_put_contents($jsonFilePath, $jsonData);
    }

}
