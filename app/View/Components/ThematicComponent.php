<?php

namespace App\View\Components;

use App\Models\Thematic;
use Illuminate\View\Component;
use Illuminate\View\View;

class ThematicComponent extends Component
{

    public string $page;

    public string $position;

    public ?string $colSize;

    /**
     * @param string $page
     * @param string $position
     */
    public function __construct(string $page, string $position, ?string $colSize)
    {
        $this->page = $page;
        $this->position = $position;
        $this->colSize = $colSize;
    }

    /**
     * @inheritDoc
     */
    public function render(): View
    {
        $thematic = Thematic::where([['page', '=', $this->page], ['position', '=', $this->position]])->first();

        return view('components.thematic', ['thematic' => $thematic]);
    }
}
