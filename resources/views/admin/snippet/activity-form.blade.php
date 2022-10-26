@if(empty($activity))
<div class="d-flex justify-content-center mb-4 preview-upload">

</div>

<div class="d-flex justify-content-center">
    <a href="#" data-targetClass="image" class="btn btn-secondary btn-lg select-photo">
        <i class="fas fa-plus-circle fa-sm"></i>
    </a>
</div>
@endif

<form action="{{route('activity.form.post')}}" enctype="multipart/form-data" id="form" data-bc="activity_trigger" method="post" role="form">

    @if(empty($activity))
    <input style="display:none;" type="file" ref="file" class="form-control form-control-lg image" 
    data-preview="preview-upload" accept="image/*" name='image' />
    @endif

        @if(request()->filled('user_id') or !empty(activityToDisplay($activity)->user_id))
            <input type="hidden" value="{{request()->user_id ?? activityToDisplay($activity)->user_id}}" name="user_id" />
        @endif

        @if(request()->filled('id'))
            <input type="hidden" value="{{request()->id}}" name="id" />
        @endif

        <div class="form-group mt-3">
            <label>Title</label>
            <input type='text' value="{{optional(activityToDisplay($activity))->title}}" class="form-control-lg form-control" name="title"/>
        </div>

        <div class="form-group mt-3">
            <label>Date</label>
            <input type='date' value="{{optional($activity)->due_date ?? request()->date}}" class="form-control-lg form-control" name="date"/>
        </div>

        <div class="form-group mt-3">
            <label>Description</label>
            <textarea class="form-control-lg form-control" style="border-radius:10px;" col="2" rows="2" name="description">{{optional(activityToDisplay($activity))->description}}</textarea>
        </div>


        <div class="form-group mt-3">
            <input type="submit" value="Submit" class="btn btn-primary w-100 btn-lg" />
        </div>
    </form>