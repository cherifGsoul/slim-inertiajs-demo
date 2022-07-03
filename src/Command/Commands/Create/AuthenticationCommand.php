<?php declare(strict_types=1);
namespace Noesis\Command\Commands\Create;

use Noesis\Command\FormatterTrait;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AuthenticationCommand extends Command
{
    use FormatterTrait;
    protected static $defaultName = 'create:authn';
    protected static $defaultDescription = 'Generates preconfigured OAuth2 authentication routes for the speecified services (Github, Twitter etc)';

    protected function configure(): void
    {
        $this->setDefinition(
            new InputDefinition([
                new InputOption('github', 'g'),
                new InputOption('twitter', 't')
            ])
        );
    }

    private function createGithubOauth2Files()
    {
        //
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $options = collect($input->getOptions())->filter(function($value, $option) {
            return ($value === true);
        });

        $options->each(function($value, $option) {
            switch ($option) {
                case 'github' :
                    $this->createGithubOauth2Files();
                break;
            }
        });
        
        return Command::SUCCESS;
    }
}