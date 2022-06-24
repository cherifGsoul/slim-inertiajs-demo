<?php declare(strict_types=1);
namespace Rist\Cli\Create;

use Rist\Cli\ResolverInterface;
use Rist\Console\Console;
use Rist\PhpGenerator\Object\Method;
use Rist\PhpGenerator\Object\Parameter;
use Rist\PhpGenerator\PhpClassGenerator;

class Provider implements ResolverInterface
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
            $this->Console->error('Command create:provider requires a --name (-n) parameter');
        }

        $name = $this->Console->arguments->get('name');

        $class_name = "{$name}Provider";
        $ClassGenerator = new PhpClassGenerator($class_name);
        $ClassGenerator->setNamespace('App\Providers');
        $ClassGenerator->addImplements('\Rist\ServiceProvider\ServiceProviderInterface');
        $ClassGenerator->addUseStatement('Psr\Container\ContainerInterface');
        $body = "return new \stdClass;";
        $ClassGenerator->addMethod(
            '__invoke',
            Method::RETURN_TYPE_OBJECT,
            $body,
            [
                new Parameter(name: 'Container', type: 'ContainerInterface')
            ]
        );

        $providers_directory = dirname(dirname(dirname(__DIR__))) . '/server/app/Providers';
        $file_name = "{$class_name}.php";
        $file_path = "{$providers_directory}/{$file_name}";
        if (file_exists($file_path)) {
            $this->Console->error("File $file_path already exists");
        } else {
            try {
                if (@file_put_contents($file_path, $ClassGenerator->output())) {
                    $this->Console->green("Successfully created provider at $file_path");
                } else {
                    $this->Console->error("Could not write contents of provider to $file_path. Filepath may be incorrect. Please log a bug with the developer");
                }
            } catch (\Exception $e) {
                $this->Console->error("Could not create provider at $file_path. ERROR: {$e->getMessage()}");
            }
        }
    }
}