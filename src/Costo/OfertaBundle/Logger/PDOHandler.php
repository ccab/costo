<?php
namespace Costo\OfertaBundle\Logger;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;

class PDOHandler extends AbstractProcessingHandler
{
    private $initialized = false;
    private $pdo;
    private $statement;

    public function __construct(\PDO $pdo, $level = Logger::INFO, $bubble = true)
    {
        //todo 
        //$conn = $this->get('doctrine')->getManager()->getConnection('logs')->getWrappedConnection();
        $this->pdo = $pdo;
        parent::__construct($level, $bubble);
    }

    protected function write(array $record)
    {
        if (!$this->initialized) {
            $this->initialize();
        }

        $this->statement->execute(array(

            'channel' => $record['channel'],
            'level'   => $record['level_name'],
            'message' => $record['message'],
            'time'    => $record['datetime']->format('U'),
        ));
    }

    private function initialize()
    {
        $this->pdo->exec(
            'CREATE TABLE IF NOT EXISTS monolog '
            .'('
            . 'channel VARCHAR(255), '
            . 'level VARCHAR(50), '
            . 'message LONGTEXT, '
            . 'time INTEGER UNSIGNED'
            . ')'

        );
        $this->statement = $this->pdo->prepare(
            'INSERT INTO monolog (channel, level, message, time) VALUES (, :channel, :level, :message, :time'
        );

        $this->initialized = true;
    }
}