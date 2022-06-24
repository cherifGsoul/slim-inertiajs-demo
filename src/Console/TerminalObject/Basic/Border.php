<?php
namespace Noesis\Console\TerminalObject\Basic;

class Border extends BasicTerminalObject
{
    /**
     * The character to repeat for the border
     *
     * @var string $char
     */
    protected $char = '-';

    /**
     * The length of the border
     *
     * @var integer $length
     */
    protected $length;

    public function __construct(string $char = '', int $length = 0)
    {
        $this->char($char)->length($length);
    }

    /**
     * Set the character to repeat for the border
     *
     * @param string $char
     *
     * @return Border
     */
    public function char(string $char)
    {
        $this->set('char', $char);

        return $this;
    }

    /**
     * Set the length of the border
     *
     * @param integer $length
     *
     * @return Border
     */
    public function length(int $length)
    {
        $this->set('length', $length);

        return $this;
    }

    /**
     * Return the border
     *
     * @return string
     */
    public function result()
    {
        $length = $this->length ?: $this->util->width() ?: 100;
        $str    = str_repeat($this->char, $length);
        $str    = substr($str, 0, $length);

        return $str;
    }
}
