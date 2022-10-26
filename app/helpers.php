<?php
use Carbon\Carbon;

function carbon($date_time=null)
{
	return new Carbon($date_time);
}

function activityToDisplay($activity)
{
	if(empty($activity))
	{
		return null;
	}
	
    if(!request()->user('admin') or request()->user_id)
    {
		$user_id = request()->user_id ?? request()->user()->id;

        if(count($activity->edits->toArray()) > 0)
        {
            foreach($activity->edits as $edits)
            {
                if($edits->user_id == $user_id)
                {
                    return $edits;
                }
            }
        }
    }

    return $activity;
}
?>