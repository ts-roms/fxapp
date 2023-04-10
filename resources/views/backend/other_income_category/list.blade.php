@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card no-export">
                <div class="card-header d-flex align-items-center">
                    <span class="panel-title">{{ _lang('Other Income Categories') }}</span>
                    <a class="btn btn-primary btn-xs ml-auto ajax-modal" data-title="{{ _lang('Add New Category') }}"
                        href="{{ route('other_income_categories.create') }}"><i
                            class="ti-plus"></i>&nbsp;{{ _lang('Add New') }}</a>
                </div>
                <div class="card-body">
                    <table id="other_income_categories_table" class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>{{ _lang('Name') }}</th>
                                <th>{{ _lang('Color') }}</th>
                                <th>{{ _lang('Description') }}</th>
                                <th class="text-center">{{ _lang('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($other_income_categories as $other_income_category)
					    <tr data-id="row_{{ $other_income_category->id }}">
							<td class='name'>{{ $other_income_category->name }}</td>
							<td class='color'><div class="rounded-circle color-circle" style="background:{{ $other_income_category->color }}"></div></td>
							<td class='description'>{{ $other_income_category->description }}</td>
							
							<td class="text-center">
								<span class="dropdown">
								  <button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  {{ _lang('Action') }}
								  
								  </button>
								  <form action="{{ action('OtherIncomeCategoryController@destroy', $other_income_category->id) }}" method="post">
									{{ csrf_field() }}
									<input name="_method" type="hidden" value="DELETE">

									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a href="{{ action('OtherIncomeCategoryController@edit', $other_income_category->id) }}" data-title="{{ _lang('Update Other Income Category') }}" class="dropdown-item dropdown-edit ajax-modal"><i class="ti-pencil-alt"></i>&nbsp;{{ _lang('Edit') }}</a>
										<button class="btn-remove dropdown-item" type="submit"><i class="ti-trash"></i>&nbsp;{{ _lang('Delete') }}</button>
									</div>
								  </form>
								</span>
							</td>
					    </tr>
					    @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
