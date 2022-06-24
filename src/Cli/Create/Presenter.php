<?php declare(strict_types=1);
namespace Rist\Cli\Create;

use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpNamespace;
use Rist\Cli\ResolverInterface;
use Rist\Console\Console;
use Rist\PhpGenerator\Object\Parameter;
use Rist\PhpGenerator\PhpClassGenerator;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Presenter
 */
class Presenter implements ResolverInterface
{
    /**
     * Console
     *
     * @var Console
     */
    private Console $Console;

    public function __construct(Console $Console)
    {
        $this->Console = $Console;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(): void
    {
        if (!$this->Console->arguments->defined('name')) {
            $this->Console->error('Command create:presenter requires a --name (-n) parameter');
        }

        $name = $this->Console->arguments->get('name');

        $class_name = "{$name}Presenter";
        $body = '$inertia = $request->getAttribute(InertiaMiddleware::INERTIA_ATTRIBUTE);

        return $inertia->render(\'Index\', [\'var\' => \'I can be used in JSX!\']);';

        $ClassGenerator = new PhpClassGenerator($class_name);
        $output = $ClassGenerator->setNamespace('App\Presenter')
            ->addUseStatement('Rist\Presenter\PresenterInterface')
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
            )
            ->output();

        $presenters_directory = dirname(dirname(dirname(__DIR__))) . '/server/app/Presenter';
        $file_name = "{$class_name}.php";
        $file_path = "${presenters_directory}/{$file_name}";
        if (file_exists($file_path)) {
            $this->Console->error("File $file_path already exists");
        } else {
            file_put_contents($file_path, $output);

            $this->Console->green("Successfully created presenter at $file_path");
        }
    }
}