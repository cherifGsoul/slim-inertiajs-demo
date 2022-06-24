<?php
namespace Noesis\Console\TerminalObject\Basic;

class Dump extends BasicTerminalObject
{
    /**
     * The data to convert to JSON
     *
     * @var array $data
     */
    protected $data;

    public function __construct(...$data)
    {
        $this->data = $data;
    }

    /**
     * Return the data as JSON
     *
     * @return string
     */
    public function result()
    {
        ob_start();

        var_dump($this->data);

        $result = ob_get_contents();

        ob_end_clean();

        return $result;
    }
}
