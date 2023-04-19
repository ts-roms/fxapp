<form method="post" class="ajax-screen-submit" autocomplete="off"
    action="{{ action('CustomFieldsController@update', $custom_field) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input name="_method" type="hidden" value="PATCH">
    <div class="row px-2">
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{ _lang('Field Name') }}</label>
                <input type="text" class="form-control" name="field_name" placeholder="{{ _lang('Field Name') }}"
                    value="{{ $custom_field->field_name }}" required>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{ _lang('Field Label') }}</label>
                <input type="text" class="form-control" name="field_label" placeholder="{{ _lang('Field Label') }}"
                    value="{{ $custom_field->field_label }}">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{ _lang('Field Belongs To') }}</label>
                <select class="form-control auto-select select2" data-selected="{{ $custom_field->belongs_to }}"
                    name="belongs_to" required>
                    <option value="" disabled>{{ _lang('Select One') }}</option>
                    {{ custom_fields_option('belongs_to') }}
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{ _lang('Field Type') }}</label>
                <select class="form-control auto-select select2" data-selected="{{ $custom_field->field_type }}"
                    name="field_type" required>
                    <option value="" disabled>{{ _lang('Select One') }}</option>
                    {{ custom_fields_option('field_type') }}
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{ _lang('Required') }}</label>
                <select class="form-control auto-select select2" data-selected="{{ $custom_field->required == 0 ? 'No' : 'Yes' }}"
                    name="required">
                    <option value="" disabled>{{ _lang('Select One') }}</option>
                    {{ custom_fields_option('required') }}
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{ _lang('CSS Class') }}</label>
                <input type="text" class="form-control" name="field_class" placeholder="{{ _lang('CSS Class') }}"
                    value="{{ $custom_field->field_class }}">
            </div>
        </div>


        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary float-right"><i
                        class="ti-check-box"></i>&nbsp;{{ _lang('Save') }}</button>
            </div>
        </div>
    </div>
</form>
