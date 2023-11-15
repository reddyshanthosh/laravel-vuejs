<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodsResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return[
			'id' => ((isset($this->id)) ? $this->id : ''),
			'name' => ((isset($this->name)) ? $this->name : ''),
			'calories' => ((isset($this->calories)) ? $this->calories : ''),
			'fat' => ((isset($this->fat)) ? $this->fat : ''),
			'carbs' => ((isset($this->carbs)) ? $this->carbs : ''),
			'protein' => ((isset($this->protein)) ? $this->protein : ''),
			'iron' => ((isset($this->iron)) ? $this->iron : ''),
		];
	}
}
