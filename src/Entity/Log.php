<?php

namespace App\Entity;

use App\Enum\LogLevel;
use App\Repository\LogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LogRepository::class)]
#[ORM\Table(name: '`logs`')]
#[ORM\Index(columns: ['loglevel', 'timestamp'])]
class Log
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null {
        get {
            return $this->id;
        }
    }

    #[ORM\Column(type: 'string', length: 255)]
    private string $title {
        get {
            return $this->title;
        }
    }

    #[ORM\Column(type: Types::TEXT)]
    private string $text {
        get {
            return $this->text;
        }
    }

    #[ORM\Column(type: 'string', length: 20, enumType: LogLevel::class)]
    private LogLevel $loglevel {
        get {
            return $this->loglevel;
        }
    }

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $timestamp {
        get {
            return $this->timestamp;
        }
    }

    #[ORM\Column(type: Types::JSON, options: ['jsonb' => true])]
    private array $tags = [] {
        get {
            return $this->tags;
        }
    }

    public function __construct(string $title, string $text, LogLevel $loglevel, array $tags = [])
    {
        $this->title = $title;
        $this->text = $text;
        $this->loglevel = $loglevel;
        $this->timestamp = new \DateTimeImmutable();
        $this->tags = array_change_key_case($tags);
    }

}
