<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:vtt',
    description: 'Vtt to Text',
)]
class ExtractVttTextCommand extends Command
{
    private $baseDirectory;
    private $baseDirectoryz;
    public function __construct()
    {
        parent::__construct();
        // Définir le chemin de base ici, par exemple "public/text/"
        $this->baseDirectory = 'public/dialog/vtt/';
        $this->baseDirectoryz = 'public/dialog/txt/';
    }

    protected function configure(): void
    {
        $this
            ->addArgument('vttFile', InputArgument::REQUIRED, 'The VTT file to process');

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {


        $filename = $input->getArgument('vttFile');
        $vttFile = $this->baseDirectory . $filename;
        $file= $this->baseDirectoryz . $filename;
        $txtFile = str_replace('.vtt', '.txt', $file);

        $vttContent = file_get_contents($vttFile);

        // Supprimez l'en-tête "WEBVTT"
        $vttContent = preg_replace('/^WEBVTT\s*$/m', '', $vttContent);

        // Supprimer les timestamps
        $vttContent = preg_replace('/\d+:\d+\.\d+ --> \d+:\d+\.\d+\n/', '', $vttContent);

        // Supprimer les lignes vides et les espaces en excès
        $vttContent = trim($vttContent);

        // Enregistrez le texte dans le fichier .txt
        file_put_contents($txtFile, $vttContent);

       unlink($vttFile);

        $output->writeln("Text extracted from $vttFile and saved to $txtFile.");

        return Command::SUCCESS;


    }
}
