<?php

namespace App\Http\Livewire;

use App\Models\Aircraft;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Views\GridView;

class AircraftGridView extends GridView
{
    /**
     * Sets a model class to get the initial data
     */
    protected $model = Aircraft::class;

    public function repository(): Builder
    {
        return Aircraft::query();
    }

    /**
     * Sets the data to every card on the view
     *
     * @param $model Current model for each card
     */
    public function card($item)
    {
        return [
            'image' => $item->img,
            'title' => '',
            'subtitle' => '',
            'description' => ''
        ];
    }
}
