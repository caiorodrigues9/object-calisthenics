<?php

namespace Caio\Calisthenics\Domain\Student;

use Caio\Calisthenics\Domain\Email\Email;
use Caio\Calisthenics\Domain\Video\Video;
use DateTimeInterface;

class Student
{
    private WatchedVideos $watchedVideos;

    public function __construct(
        private Email $email,
        private DateTimeInterface $bd,
        private string $fName,
        private string $lName,
        public string $street,
        public string $number,
        public string $province,
        public string $city,
        public string $state,
        public string $country)
    {
        $this->watchedVideos = new WatchedVideos();
    }

    public function getFullName(): string
    {
        return "{$this->fName} {$this->lName}";
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBd(): DateTimeInterface
    {
        return $this->bd;
    }

    public function watch(Video $video, DateTimeInterface $date)
    {
        $this->watchedVideos->add($video, $date);
    }

    public function hasAccess(): bool
    {

        if ($this->watchedVideos->count() === 0) {
            return true;
        }

        $firstDate = $this->watchedVideos->dateOfFirstVideo();
        $today = new \DateTimeImmutable();

        return $firstDate->diff($today)->days < 90;

    }
}
