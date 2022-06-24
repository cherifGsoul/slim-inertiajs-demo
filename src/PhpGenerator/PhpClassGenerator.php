<?php declare(strict_types=1);
namespace Noesis\PhpGenerator;

use Noesis\PhpGenerator\Object\Method;
use Noesis\PhpGenerator\Object\Parameter;

class PhpClassGenerator
{
    private const TYPE_CLASS = 'class';
    private const TYPE_INTERFACE = 'interface';
    private const TYPE_TRAIT = 'trait';

    private const RETURN_TYPE_VOID = 'void';
    private const RETURN_TYPE_OBJECT = 'object';

    private string $class_name;
    private string $type;
    private bool $strict_types = true;
    private string $namespace;
    private array $methods = [];
    private array $use_statements = [];
    private array $implements = [];
    private string $output;

    public function __construct(string $class_name, string $type = self::TYPE_CLASS, bool $declare_strict_types = true)
    {
        $this->class_name = $class_name;
        $this->type = $type;
        $this->strict_types = $declare_strict_types;
    }

    public function setNamespace(string $namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }

    public function addMethod(string $method_name, string $return_type = Method::RETURN_TYPE_VOID, string $body = '//', array $params = []): self
    {
        $Method = new Method($method_name, $return_type, $body, $params);
        $this->methods[] = $Method;

        return $this;
    }

    public function addUseStatement(string $fully_qualified_namespace): self
    {
        $this->use_statements[] = $fully_qualified_namespace;

        return $this;
    }

    public function addImplements(string $implements): self
    {
        $this->implements[] = $implements;

        return $this;
    }

    private function build()
    {
        $output = [];
        $output[] = ($this->strict_types) ? '<?php declare(strict_types=1);' : '<?php';
        if (isset($this->namespace)) {
            $output[] = "namespace {$this->namespace};";
        }

        $output[] = "";
        
        if (!empty($this->use_statements)) {
            foreach ($this->use_statements as $use_statement) {
                $output[] = "use $use_statement;";
            }
            $output[] = "";
        }

        $type = $this->type;
        $class_name = $this->class_name;
        $implements = implode(', ', $this->implements);
        $has_implements = strlen(trim($implements)) > 0;
        $output[] = ($has_implements) ? "$type $class_name implements $implements" : "$type $class_name";
        $output[] = "{";

        if (!empty($this->methods)) {
            foreach ($this->methods as $method) {
                /**
                 * @var Method $method
                 */
                $params = [];
                if (!empty($method->params)) {
                    foreach ($method->params as $Parameter) {
                        unset($default);
                        if ($Parameter->default !== Parameter::DEFAULT_UNDEFINED) {
                            $default = $Parameter->default;
                        }
                        $params[] = ($Parameter->default !== Parameter::DEFAULT_UNDEFINED) ? "{$Parameter->type} {$Parameter->name} = {$Parameter->default}" : "{$Parameter->type} {$Parameter->name}";
                    }
                }
                $parameters = implode(', ', $params);
                $output[] = "    $method->visibility function $method->name($parameters): $method->return_type";
                $output[] = "    {";
                $output[] = "        $method->body";
                $output[] = "    }";
                $output[] = "";
            }
        }

        $output[] = "}";
        $output[] = "";

        $this->output = implode(PHP_EOL, $output);
    }

    public function output(): string
    {
        $this->build();
        return $this->output;
    }
}