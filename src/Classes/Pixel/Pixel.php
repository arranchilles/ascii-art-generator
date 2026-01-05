<?php
namespace App\Classes\Pixel;
use App\Classes\Coordinate;

class Pixel{

    public Coordinate $pos;

    public int $r;

    public int $g;

    public int $b;


    public function __construct(int $x, int $y, int $r, int $g, int $b)
    {
        $this->pos = new Coordinate($x, $y);
        $this->r = $r;
        $this->g = $g;
        $this->b = $b;
    }

    public function get_rgb(): array{
        return array($this->r, $this->g, $this->b);
    }
    
    public function get_coordinates(): Coordinate{
        return $this->pos;
    }
}