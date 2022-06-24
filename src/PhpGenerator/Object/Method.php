<?php declare(strict_types=1);
namespace Rist\PhpGenerator\Object;

class Method
{
    public const RETURN_TYPE_VOID = 'void';
    public const RETURN_TYPE_OBJECT = 'object';
    public const VISIBILITY_PUBLIC = 'public';
    public const VISIBILITY_PROTECTED = 'protected';
    public const VISIBILITY_PRIVATE = 'private';
    public string $name;
    public string $return_type;
    public string $body;
    public array  $parameters;
    public string $visibility;

    public function __construct(string $name, string $return_type, string $body, array $params = [], string $visibility = self::VISIBILITY_PUBLIC)
    {
        $this->name = $name;
        $this->return_type = $return_type;
        $this->body = $body;
        $this->params = $params;
        $this->visibility = $visibility;
    }
}