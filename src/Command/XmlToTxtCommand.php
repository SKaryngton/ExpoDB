<?php

namespace App\Command;

use App\Service\DialogService;
use App\Service\UntertitelService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:xml',
    description: 'xml To txt',
)]
class XmlToTxtCommand extends Command
{
    private $baseDirectory;
    public function __construct(private UntertitelService $service)
    {
        parent::__construct();
        // Définir le chemin de base ici, par exemple "public/text/"
        $this->baseDirectory = 'public/dialog/xml/';
    }

    protected function configure(): void
    {
        $this
            ->addArgument('fileName', InputArgument::REQUIRED, 'filename')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $fileName = $input->getArgument('fileName');
        $filePath = $this->baseDirectory . $fileName;

        // Assurez-vous que le chemin du fichier est correct et que le fichier existe
        if (!file_exists($filePath)) {
            $output->writeln('Fichier non trouvé : ' . $filePath);
            return Command::FAILURE;
        }
        $result = $this->service->convertXmlToTxt($filePath);

        if ($result) {
            $output->writeln("conversion effectués avec succès.");
        } else {
            $output->writeln("Erreur lors de l'ouverture ou de la modification du fichier.");
        }
        return Command::SUCCESS;
    }
}
