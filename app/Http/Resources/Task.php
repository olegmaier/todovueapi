<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Task extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return[
            'id'=>$this->id,
            'title'=>$this->title,
            'description'=>$this->description,
            'user_id'=>$this->user_id,
            'task_done'=>$this->task_done
        ];
    }

    public function with($request)
    {
        # code...
        return [
            'version'=>'1.0'
        ];
    }
}
