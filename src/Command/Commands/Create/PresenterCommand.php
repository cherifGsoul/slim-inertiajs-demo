<?php declare(strict_types=1);
namespace Noesis\Command\Commands\Create;

use Noesis\Command\Formatable;
use Noesis\PhpGenerator\Object\Parameter;
use Noesis\PhpGenerator\PhpClassGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PresenterCommand extends Command
{
    use Formatable;
    protected static $defaultName = 'create:presenter';
    protected static $defaultDescription = 'Generates boilerplate Presenter class in server/app/Presenter';

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the Presenter class');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $class_name = "{$name}Presenter";
        $body = '$inertia = $request->getAttribute(InertiaMiddleware::INERTIA_ATTRIBUTE);

        return $inertia->render(\'Index\', [\'var\' => \'I can be used in JSX!\']);';

        $ClassGenerator = new PhpClassGenerator($class_name);
        $ClassGenerator->setNamespace('App\Presenter')
            ->addUseStatement('Noesis\Presenter\PresenterInterface')
            ->addUseStatement('Psr\Http\Message\ServerRequestInterface')
            ->addUseStatement('Psr\Http\Message\ResponseInterface')
            ->addUseStatement('Cherif\InertiaPsr15\Middleware\InertiaMiddleware')
            ->addImplements('PresenterInterface')
            ->addMethod(
                '__invoke',
                'ResponseInterface',
                $body,
                [
                    new Parameter(type: 'ServerRequestInterface', name: '$request'),
                    new Parameter(type: 'ResponseInterface', name: '$response')
                ]
            );
        
        $root = dirname(dirname(dirname(dirname(__DIR__))));
        $presenters_directory = "$root/server/app/Presenter";
        $file_name = "{$class_name}.php";
        $file_path = "${presenters_directory}/{$file_name}";
        if (file_exists($file_path)) {
            throw new LogicException("File $file_path already exists");
        } else {
            if (@file_put_contents($file_path, $ClassGenerator->output())) {
                $this->formatter($output)->info("Successfully created presenter at $file_path");
            } else {
                throw new LogicException("Could not write contents of presenter to $file_path");
            }
        }
        
        return Command::SUCCESS;
    }
}