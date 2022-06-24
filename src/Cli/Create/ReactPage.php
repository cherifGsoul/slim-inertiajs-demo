<?php declare(strict_types=1);
namespace Noesis\Cli\Create;

use Noesis\Cli\ResolverInterface;
use Noesis\Console\Console;

class ReactPage implements ResolverInterface
{
    private Console $Console;

    public function __construct(Console $Console)
    {
        $this->Console = $Console;
    }

    public function __invoke(): void
    {
        if (!$this->Console->arguments->defined('name')) {
            $this->Console->error('Command create:presenter requires a --name (-n) parameter');
        }

        $name = $this->Console->arguments->get('name');

        $file = <<<File
import React from 'react';

export default function $name(props) {
    return (<div>$name Page</div>);
};

File;
        $file_path = dirname(dirname(dirname(__DIR__))) . "/client/js/Pages/{$name}.jsx"; 
        if (file_exists($file_path)) {
            $this->Console->error("File $file_path already exists");
        } else {
            file_put_contents($file_path, (string) $file);

            $this->Console->green("Successfully created a React page at $file_path");
        }
    }
}
