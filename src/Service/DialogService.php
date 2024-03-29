<?php

namespace App\Service;

use App\Entity\Dialog;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\Serializer\SerializerInterface;

class DialogService
{


    public function __construct(private  EntityManagerInterface $entityManager, private  SerializerInterface $serializer) {

    }

    public function saveDialogueFromJson($jsonFilePath)
    {

        // Vérifier si le fichier existe
        if (!file_exists($jsonFilePath)) {
            throw new FileNotFoundException("Le fichier JSON n'a pas été trouvé.");
        }
        // Lire le contenu du fichier JSON
        $jsonContent = file_get_contents($jsonFilePath);
        $data = json_decode($jsonContent, true, 512, JSON_THROW_ON_ERROR);

        // Créer une nouvelle instance de Dialogue et la remplir avec les données
        $dialog = new Dialog();
        $dialog->setS($data['situation']);
        $dialog->setP($data['personen']);
        $dialog->setO($data['ort']);
        $dialog->setA($data['A']);
        $dialog->setB($data['B']);

        // Sauvegarder l'entité dans la base de données
        $this->entityManager->persist($dialog);
        $this->entityManager->flush();

    }
    public function saveAllDialoguesToJsonFile($db): void {
        // Récupérer toutes les entités Dialogue
        $dialogs = $this->entityManager->getRepository(Dialog::class)->findAll();

        // Sérialiser les entités en JSON
        $jsonData = $this->serializer->serialize($dialogs, 'json');

        // Chemin du fichier où sauvegarder les données
        $jsonFilePath = 'public/db/'.$db.'.json';

        // Écrire les données dans le fichier, en écrasant les données existantes
        file_put_contents($jsonFilePath, $jsonData);
    }

}
