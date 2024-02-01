<?php

namespace App\Service;

class Service
{

    public function __construct(private  DialogService $dialogService, private StoryService $storyService, private TfaService $tfaService, private StrombergService $strombergService)
    {
    }

    function replaceTextInFile($filePath,$db, $searchString1, $replaceString1, $searchString2, $replaceString2) {
        // Vérifier si le fichier existe
        if (!file_exists($filePath)) {
            return false;
        }

        // Lire le contenu du fichier
        $content = file_get_contents($filePath);

        // Remplacer les chaînes de caractères
        $content = str_replace(array($searchString1, $searchString2, 'Situation:', 'Personen:', 'Ort:'), array($replaceString1, $replaceString2, 'S:', 'P:', 'O:'), $content);


        // Réécrire le fichier avec le nouveau contenu
        file_put_contents($filePath, $content);


        $this->modifyDbTxt($filePath);

        $this->parseDbTxt($filePath,$db);


        return true;
    }

    function modifyDbTxt($filePath) {


        if (!file_exists($filePath)) {
            return false;
        }
        // Lire toutes les lignes du fichier
        $lines = file($filePath, FILE_IGNORE_NEW_LINES);
        // Un tableau pour stocker les nouvelles lignes
        $newLines = [];
        $previousLineIndex = -1;

        foreach ($lines as $index => $line) {
            // Vérifier si la ligne commence par l'un des préfixes spécifiés
            if (!preg_match('/^(S:|P:|O:|A:|B:)/', $line)) {
                // Ajouter le contenu de cette ligne à la ligne précédente
                if ($previousLineIndex != -1) {
                    $newLines[$previousLineIndex] .= ' ' . $line;
                }
            } else {
                // Ajouter la ligne actuelle au nouveau tableau et mettre à jour l'index de la ligne précédente
                $newLines[] = $line;
                $previousLineIndex = count($newLines) - 1;
            }
        }

        // Convertir le tableau des nouvelles lignes en une chaîne
        $newContent = implode("\n", $newLines);

        // Réécrire le fichier avec le nouveau contenu
        file_put_contents($filePath, $newContent);
        return true;
    }


    function parseDbTxt($filePath, $db) {
        // Lire le contenu du fichier
        $content = file_get_contents($filePath);
        // Diviser le contenu en lignes
        $lines = explode("\n", $content);

        // Initialiser le tableau résultat avec la structure demandée
        $result = [
            'situation' => '',
            'personen' => [],
            'ort' => '',
            'A' => [],
            'B' => []
        ];

        // Parcourir chaque ligne du fichier
        foreach ($lines as $line) {
            // Si la ligne commence par 'S:', extraire la situation
            if (str_starts_with($line, 'S:')) {
                $result['situation'] = substr($line, strpos($line, ':') + 2);
            }
            // Si la ligne commence par 'P:', extraire les personnes et les mettre dans un tableau
            elseif (str_starts_with($line, 'P:')) {
                $result['personen'] = array_map('trim', explode(',', substr($line, strpos($line, ':') + 2)));
            }
            // Si la ligne commence par 'O:', extraire le lieu
            elseif (str_starts_with($line, 'O:')) {
                $result['ort'] = substr($line, strpos($line, ':') + 2);
            }
            // Si la ligne commence par 'A:', ajouter le dialogue de A dans son tableau
            elseif (str_starts_with($line, 'A:')) {
                $result['A'][] = trim(substr($line, 2));
            }
            // Si la ligne commence par 'B:', ajouter le dialogue de B dans son tableau
            elseif (str_starts_with($line, 'B:')) {
                $result['B'][] = trim(substr($line, 2));
            }
        }

        // Convertir le tableau résultat en JSON
        $jsonResult = json_encode($result, JSON_THROW_ON_ERROR);

        // Chemin du dossier où le fichier JSON sera sauvegardé
        $jsonDir = 'public/dialog/json';

        // Vérifier si le dossier existe, sinon le créer
        if (!file_exists($jsonDir) && !mkdir($jsonDir, 0777, true) && !is_dir($jsonDir)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $jsonDir));
        }

        // Définir le chemin du fichier JSON à sauvegarder
        $jsonFilePath = $jsonDir . '/' . basename($filePath, '.txt') . '.json';

        // Écrire le JSON dans le fichier
        file_put_contents($jsonFilePath, $jsonResult);
       if($db==='dialogs'){
           $this->dialogService->saveDialogueFromJson($jsonFilePath);
           $this->dialogService->saveAllDialoguesToJsonFile($db);
       }
       elseif ($db==='stories'){
           $this->storyService->saveStoryFromJson($jsonFilePath);
           $this->storyService->saveAllStoryToJsonFile($db);
       }
       elseif ($db==='tfa'){
           $this->tfaService->saveStoryFromJson($jsonFilePath);
           $this->tfaService->saveAllStoryToJsonFile($db);
       }
       elseif ($db==='stromberg'){
           $this->strombergService->saveStoryFromJson($jsonFilePath);
           $this->strombergService->saveAllStoryToJsonFile($db);
       }

        $this->deleteDbTxtFile($filePath);
        $this->deleteDbTxtFile($jsonFilePath);
    }




    function deleteDbTxtFile($filePath) {

        // Vérifier si le fichier existe
        if (file_exists($filePath)) {

            unlink($filePath);

        }
    }






}
