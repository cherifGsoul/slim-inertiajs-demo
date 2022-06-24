<?php declare(strict_types=1);
namespace App\Providers;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Container\ContainerInterface;

class LoggerInterfaceProvider implements \Rist\ServiceProvider\ServiceProviderInterface
{
    private string $channel;

    private AbstractProcessingHandler $handler;

    private Level $level;

    /**
     * Get Logger
     *
     * @return Logger
     */
    public function getLogger(): Logger
    {
        $Logger = new Logger($this->channel);
        $Logger->pushHandler($this->handler, $this->level);

        return $Logger;
    }

    /**
     * Set Channel
     *
     * @param string $channel
     * 
     * @return self
     */
    public function setChannel(string $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Set handler
     *
     * @param AbstractProcessingHandler $handler
     * 
     * @return self
     */
    public function setHandler(AbstractProcessingHandler $handler): self
    {
        $this->handler = $handler;

        return $this;
    }

    /**
     * Level
     *
     * @param Level $level
     *
     * @return self
     */
    public function setLevel(Level $level): self
    {
        $this->level = $level;

        return $this;
    }
    

    public function makePath(string $path, array $map = []): string
    {
        foreach ($map as $find => $replace) {
            $path = str_replace($find, $replace, $path);
        }
        
        return $path;
    }

    public function __invoke(ContainerInterface $container): object
    {
        var_dump('invoke'); exit;
        $config  = $container->get('config');
        $handler = $config->logs['handler'];
        $channel = $config->logs['channel'];
        $level   = $config->logs['level'];
        $path    = $this->makePath($config->logs['path'], [
            '{channel}' => $channel,
            '{date}'    => date('Ymd')
        ]);
        
        $this
            ->setChannel($channel)
            ->setHandler(new $handler($path))
            ->setLevel($level);
        
        return $this;
    }
}
