<?php


namespace App\Service;


use Symfony\Component\Filesystem\Filesystem;


class UntertitelService
{


    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function convertXmlToTxt($xmlFilePath)
    {
        // Vérifiez si le fichier XML existe
        if (!$this->filesystem->exists($xmlFilePath)) {
            throw new \Exception("Le fichier XML n'existe pas.");
        }

        // Chargez le contenu du fichier XML
        $xmlContent = file_get_contents($xmlFilePath);

        // Utilisez un analyseur XML pour extraire le texte des balises <p>
        $xml = new \SimpleXMLElement($xmlContent);
        $text = '';

        foreach ($xml->body->div->p as $paragraph) {
            $text .= (string)$paragraph . "\n";
        }

        // Supprimez les balises HTML restantes
        $text = strip_tags($text);

        // Créez le fichier .txt avec le même nom
        $txtFilePath = str_replace('.xml', '.txt', $xmlFilePath);

        // Enregistrez le texte dans le fichier .txt
        file_put_contents($txtFilePath, $text);

       // $this->deleteDbTxtFile($xmlFilePath);
        return true;
    }

    function deleteDbTxtFile($filePath) {

        // Vérifier si le fichier existe
        if (file_exists($filePath)) {

            unlink($filePath);

        }
    }

}
