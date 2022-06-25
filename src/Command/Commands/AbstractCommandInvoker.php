<?php declare(strict_types=1);
namespace Noesis\Command\Commands;

use Symfony\Component\Console\Application;

abstract class AbstractCommandInvoker
{
    public function getClassNames($file): array
    {
        $current_filename = $file;
        $current_filename = preg_replace('~\\\\~', "/", $current_filename);
        $current_filename = preg_replace('/^(.+\/)(.*\.php)$/', '$2', $current_filename);
        
        $files_in_this_directory = scandir(dirname($file));
        $files = array_filter($files_in_this_directory, function($filename) use ($current_filename) {
            if ($filename === '.' || $filename === '..' || $filename === $current_filename) {
                return false;
            }

            return true;
        });

        return array_map(function($filename) {
            return str_replace('.php', '', $filename);
        }, $files);
    }

    public function autoload(string $file, string $namespace, Application $app): Application
    {
        $classes = $this->getClassNames($file);
        foreach ($classes as $class) {
            $classname = "$namespace\\$class";
            $app->add(new $classname);
        }

        return $app;
    }

    abstract public function __invoke(Application $application): Application;
}