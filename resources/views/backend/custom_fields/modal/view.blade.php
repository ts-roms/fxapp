    <div class="row px-2">
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{ _lang('Field Name') }}</label>
                <input type="text" class="form-control" name="field_name" placeholder="{{ _lang('Field Name') }}"
                    value="{{ $custom_field->field_name }}" readonly>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{ _lang('Field Label') }}</label>
                <input type="text" class="form-control" name="field_label" placeholder="{{ _lang('Field Label') }}"
                    value="{{ $custom_field->field_label }}" readonly>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{ _lang('Field Belongs To') }}</label>
                <select class="form-control auto-select select2" data-selected="{{ $custom_field->belongs_to }}"
                    name="belongs_to" disabled>
                    <option value="" disabled>{{ _lang('Select One') }}</option>
                    {{ custom_fields_option('belongs_to') }}
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{ _lang('Field Type') }}</label>
                <select class="form-control auto-select select2" data-selected="{{ $custom_field->field_type }}"
                    name="field_type" disabled>
                    <option value="" disabled>{{ _lang('Select One') }}</option>
                    {{ custom_fields_option('field_type') }}
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{ _lang('Required') }}</label>
                <select class="form-control auto-select select2"
                    data-selected="{{ $custom_field->required == 0 ? 'No' : 'Yes' }}" name="required" disabled>
                    <option value="" disabled>{{ _lang('Select One') }}</option>
                    {{ custom_fields_option('required') }}
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{ _lang('CSS Class') }}</label>
                <input type="text" class="form-control" name="field_class" placeholder="{{ _lang('CSS Class') }}"
                    value="{{ $custom_field->field_class }}" readonly>
            </div>
        </div>

    </div>
    </form>
