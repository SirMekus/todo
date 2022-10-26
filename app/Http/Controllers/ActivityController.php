<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Edit;
use App\MyClass\UploadFiles;
use App\MyClass\Calendar;
use Illuminate\Validation\Rule;

class ActivityController extends Controller
{
    public function activities(Calendar $calendar)
    {
        request()->validate([
            'date' => ['bail', 'nullable', 'date'],
            'from' => ['bail', 'nullable', 'date'],
            'to' => ['bail', 'nullable', 'date'],
            ]);

        $activityForThisDay = carbon(request()->date)->toDateString();

        $activities = Activity::with(['user', 'edits.user', 'edits' => function ($query) {
            $query->when(request()->user('admin') and request()->user_id, function($query){
                $query->where("user_id", request()->user_id);
            })
            ->when(!request()->user('admin'), function($query){
                $query->where("user_id", request()->user()->id);
            });
        }])
        ->when(request()->from and request()->to, function($query){
            $query->whereDateBetween('due_date', request()->from, request()->to);
        },function($query) use ($activityForThisDay){
            $query->whereDate('due_date', $activityForThisDay);
        })
        //->whereDate('due_date', $activityForThisDay)
        ->when(!request()->user('admin'), function($query){
            $query->where(function ($query) {
                $query->whereNull('user_id')
                      ->orWhere("user_id", request()->user()->id);
            });
        })
        ->when(request()->user('admin') and request()->user_id, function($query){
            $query->where(function ($query) {
                $query->whereNull('user_id')
                      ->orWhere("user_id", request()->user_id);
            });
        })
        ->orderBy('created_at', 'desc')->paginate(10);

        if(request()->ajax());

        $data = [
            'activities'=>$activities,
            'date'=>$activityForThisDay,
            'calendar'=>$calendar
        ];

        return request()->wantsJson() ? response()->json($data) : view('activities', [
            'activities'=>$activities,
            'date'=>$activityForThisDay,
            'calendar'=>$calendar
        ]);
    }

    public function createActivityForm()
    {
        return view('admin.snippet.activity-form', [
            'activity'=>Activity::where('id', request()->id)->first(),
        ]);
    }

    public function createActivityFormSubmit(UploadFiles $upload)
    {
        $message = [
            'image.required_if'=>"Please upload an image"
        ];

        request()->validate([
            'image' => [Rule::requiredIf(!request()->filled('id')), 'image'],
            'title' => ['bail', 'required', 'string'],
            'date' => ['bail', 'required', 'date'],
            'description' => ['bail', 'required', 'string'],
            'id' => ['bail', 'nullable', 'string', 'exists:activities'],
            'user_id' => ['bail', 'nullable', 'string', 'exists:users,id'],
            ], $message);

        $image = $upload->upload(ignore:true);

        $data = ['title' => request()->title, 'description' => request()->description, 'user_id' => request()->user_id
            ];

        if(!empty($image))
        {
            $data['image'] = $image;
        }

        if(request()->filled('id') and request()->filled('user_id'))
        {
            Edit::updateOrCreate(
                ['activity_id' => request()->id, 'user_id' => request()->user_id],
                $data
            );
        }
        else
        {
            $data['due_date'] = request()->date;

            $data['user_id'] = request()->user_id;
            
            Activity::updateOrCreate(
                ['id' => request()->id],
                $data
            );
        }

        return response("Activity has been created successfully");
    }

    public function delete(UploadFiles $upload)
    {
        $activity = Activity::where('id', request()->id)->firstOrFail();

        Edit::where('activity_id', $activity->id)->delete();

        $upload->fileDelete($activity->image);

        $activity->delete();

        return back()->with('status', "Activity was successfully deleted");
    }
}
