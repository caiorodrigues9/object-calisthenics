<?php

namespace Caio\Calisthenics\Domain\Video;

use Caio\Calisthenics\Domain\Student\Student;

interface VideoRepository
{
    public function add(Video $video): void;
    public function videosFor(Student $student): array;
}
