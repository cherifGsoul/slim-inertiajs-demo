<?php declare(strict_types=1);
namespace Noesis\Command\Commands\Create;

use Noesis\Command\FormatterTrait;
use Noesis\PhpGenerator\Object\Method;
use Noesis\PhpGenerator\Object\Parameter;
use Noesis\PhpGenerator\PhpClassGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProviderCommand extends Command
{
    use FormatterTrait;
    protected static $defaultName = 'create:provider';
    protected static $defaultDescription = 'Generates boilerplate Provider class in server/app/Providers';

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the Provider class');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');

        $class_name = "{$name}Provider";
        $ClassGenerator = new PhpClassGenerator($class_name);
        $ClassGenerator->setNamespace('App\Providers');
        $ClassGenerator->addUseStatement('Psr\Container\ContainerInterface');
        $ClassGenerator->addUseStatement('Noesis\ServiceProvider\ServiceProviderInterface');
        $ClassGenerator->addImplements('ServiceProviderInterface');
        $body = "return new \stdClass;";
        $ClassGenerator->addMethod(
            '__invoke',
            Method::RETURN_TYPE_OBJECT,
            $body,
            [
                new Parameter(name: 'Container', type: 'ContainerInterface')
            ]
        );
        
        $root = dirname(dirname(dirname(dirname(__DIR__))));
        $providers_directory = "$root/server/app/Providers";
        $file_name = "{$class_name}.php";
        $file_path = "{$providers_directory}/{$file_name}";
        if (file_exists($file_path)) {
            throw new LogicException("File $file_path already exists");
        } else {
            if (@file_put_contents($file_path, $ClassGenerator->output())) {
                $this->formatter($output)->info("Successfully created provider at $file_path");
            } else {
                throw new LogicException("Could not write contents of provider to $file_path");
            }
        }
        
        return Command::SUCCESS;
    }
}