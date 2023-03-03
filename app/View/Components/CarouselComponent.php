<?php

namespace App\View\Components;

use App\Models\Carousel;
use Illuminate\View\Component;
use Illuminate\View\View;

class CarouselComponent extends Component
{

    public string $page;

    public string $position;

    /**
     * @param string $page
     * @param string $position
     */
    public function __construct(string $page, string $position)
    {
        $this->page = $page;
        $this->position = $position;
    }

    /**
     * @inheritDoc
     */
    public function render(): View
    {
        $carousel = Carousel::where([['page','=', $this->page],['position', '=', $this->position]])->first();

        return view('components.carousel', ['carousel' => $carousel]);
    }
}
