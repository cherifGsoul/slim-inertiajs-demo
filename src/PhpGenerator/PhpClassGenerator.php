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

    private string $namespace;
    private array $methods = [];
    private array $use_statements = [];
    private string $extends = '';
    private array $implements = [];
    private string $output;

    public function __construct(
        private string $class_name, 
        private string $type = self::TYPE_CLASS, 
        private bool $strict_types = true
        )
    {
        // PHP8 :)
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

    public function setExtends(string $extends): self
    {
        $this->extends = $extends;

        return $this;
    }

    public function addImplements(string $implements): self
    {
        $this->implements[] = $implements;

        return $this;
    }

    private function appendOpeningScriptTag(array &$output): void
    {
        $output[] = ($this->strict_types) ? '<?php declare(strict_types=1);' : '<?php';
    }

    private function appendNamespaces(array &$output): void
    {
        if (isset($this->namespace)) {
            $output[] = "namespace {$this->namespace};";
        }
    }

    private function appendUseStatements(array &$output): void
    {
        if (!empty($this->use_statements)) {
            foreach ($this->use_statements as $use_statement) {
                $output[] = "use $use_statement;";
            }
            $output[] = "";
        }
    }

    private function appendClassDefinitionLine(array &$output): void
    {
        $type = $this->type;
        $class_name = $this->class_name;
        $has_extends = (!empty(trim($this->extends)));
        $implements = implode(', ', $this->implements);
        $has_implements = strlen(trim($implements)) > 0;
        $line = "$type $class_name";
        $line .= ($has_extends) ? " extends $this->extends" : '';
        $line .= ($has_implements) ? " implements $implements" : '';

        $output[] = $line;
    }

    private function appendMethods(array &$output): void
    {
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
    }

    private function build()
    {
        $output = [];
        $this->appendOpeningScriptTag($output);
        $this->appendNamespaces($output);

        $output[] = "";
        
        $this->appendUseStatements($output);
        
        $this->appendClassDefinitionLine($output);
        $output[] = "{";

        $this->appendMethods($output);

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