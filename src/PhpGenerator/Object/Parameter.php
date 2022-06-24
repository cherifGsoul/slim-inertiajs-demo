<?php declare(strict_types=1);
namespace Rist\PhpGenerator\Object;

class Parameter
{
    public const DEFAULT_UNDEFINED = '__UNDEFINED__';
    public string $name;
    public string $type;
    public string $default;

    public function __construct(string $name, string $type = 'mixed', mixed $default = self::DEFAULT_UNDEFINED)
    {
        $this->name = (!str_starts_with($name, '$')) ? '$' . $name : $name;
        $this->type = $type;
        $this->default = $default;
    }
}