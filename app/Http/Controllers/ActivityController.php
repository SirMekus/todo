<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\MyClass\UploadFiles;

class ActivityController extends Controller
{
    public function activities()
    {
        $activityForThisDay = carbon(request()->date)->toDateString();

        $activities = Activity::when(request()->user(), function($query){
            $query->whereNull('user_id')->OrWhere("user_id", request()->user()->id);
        })
        ->whereDate('created_at', $activityForThisDay)->get();

        // dd(carbon()->format('jS'));
        //dd($activityForThisDay);

        return view('activities', [
            'activities'=>$activities,
            'date'=>$activityForThisDay
        ]);
    }

    public function createActivityForm()
    {
        return view('admin.snippet.activity-form', [
            'activity'=>Activity::whereDate('id', request()->id)->first(),
        ]);
    }

    public function createActivityFormSubmit(UploadFiles $upload)
    {
        request()->validate([
            'image' => 'nullable|sometimes|image',
            'title' => ['bail', 'required', 'string'],
            'description' => ['bail', 'required', 'string'],
            'id' => ['bail', 'nullable', 'string'],
            'user_id' => ['bail', 'nullable', 'string'],
            ]);

        $image = $upload->upload(ignore:true);
        //dd($image);

        $data = ['title' => request()->title, 'description' => request()->description, 'user_id' => request()->user_id
        ];

        if(!empty($image))
        {
            $data['image'] = $image;
        }
            
        Activity::updateOrCreate(
            ['id' => request()->id],
            $data
        );

        return response("Activity has been created successfully");
    }
}
