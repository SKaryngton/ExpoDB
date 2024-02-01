<?php

namespace App\Command;

use App\Service\Service;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


#[AsCommand(
    name: 'app:replace',
    description: 'Add a short description for your command',
)]
class ReplaceTextCommand extends Command
{
    private $baseDirectory;
    public function __construct(private Service $service)
    {
        parent::__construct();
        // Définir le chemin de base ici, par exemple "public/text/"
        $this->baseDirectory = 'public/dialog/txt/';
    }

    protected function configure(): void
    {
        $this
            ->addArgument('fileName', InputArgument::REQUIRED, 'The path of the file')
            ->addArgument('databaseName', InputArgument::REQUIRED, 'The Name of the database')
            ->addArgument('searchString1', InputArgument::REQUIRED, 'The first string to search')
            ->addArgument('replaceString1', InputArgument::REQUIRED, 'The first replacement string')
            ->addArgument('searchString2', InputArgument::REQUIRED, 'The second string to search')
            ->addArgument('replaceString2', InputArgument::REQUIRED, 'The second replacement string');

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {


        // Récupérer les arguments
        $fileName = $input->getArgument('fileName');
        $filePath = $this->baseDirectory . $fileName;
        $database = $input->getArgument('databaseName');
        $searchString1 = $input->getArgument('searchString1');
        $replaceString1 = $input->getArgument('replaceString1');
        $searchString2 = $input->getArgument('searchString2');
        $replaceString2 = $input->getArgument('replaceString2');

        // Assurez-vous que le chemin du fichier est correct et que le fichier existe
        if (!file_exists($filePath)) {
            $output->writeln('Fichier non trouvé : ' . $filePath);
            return Command::FAILURE;
        }

        $result = $this->service->replaceTextInFile($filePath,$database, $searchString1, $replaceString1, $searchString2, $replaceString2);

        if ($result) {
            $output->writeln("Les remplacements ont été effectués avec succès.");
        } else {
            $output->writeln("Erreur lors de l'ouverture ou de la modification du fichier.");
        }
        return Command::SUCCESS;
    }
}
