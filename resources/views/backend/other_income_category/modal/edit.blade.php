<link href="{{ asset('backend/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet">

<form method="post" class="ajax-screen-submit" autocomplete="off"
    action="{{ action('OtherIncomeCategoryController@update', $id) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input name="_method" type="hidden" value="PATCH">
    <div class="row px-2">
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{ _lang('Name') }}</label>
                <input type="text" class="form-control" name="name" value="{{ $other_income_category->name }}"
                    required>
            </div>

            <div class="form-group">
                <label class="control-label">{{ _lang('Color') }}</label>
                <input type="text" class="form-control colorpicker" name="color"
                    value="{{ $other_income_category->color }}" required>
            </div>

            <div class="form-group">
                <label class="control-label">{{ _lang('Description') }}</label>
                <textarea class="form-control" name="description">{{ $other_income_category->description }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary float-right"><i
                        class="ti-check-box"></i>&nbsp;{{ _lang('Update') }}</button>
            </div>
        </div>
    </div>
</form>

<script src="{{ asset('backend/plugins/bootstrap-colorpicker/bootstrap-colorpicker.js') }}"></script>
