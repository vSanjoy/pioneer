@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ $pageTitle }}</h4>
					{{ Form::open([
						'method'=> 'POST',
						'class' => '',
						'route' => [$routePrefix.'.'.$editUrl.'-submit', $id],
						'name'  => 'updateRoleForm',
						'id'    => 'updateRoleForm',
						'files' => true,
						'novalidate' => true ]) }}
						<div class="form-body mt-4-5">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_title')<span class="red_star">*</span></label>
										{{ Form::text('name', $details->name, [
																		'id' => 'name',
																		'placeholder' => '',
																		'class' => 'form-control',
																		'required' => true,
																	]) }}
									</div>
								</div>
							</div>
							<div class="mt-1">
								<!-- Permission section start -->
								<div class="add-edit-permission-wrap">
									<div class="permission-title">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="checkAll mainSelectDeselectAll" id="customCheck2All">
											<label class="text-dark cursor-pointer va-top ml-1" for="customCheck2All">
												<strong>@lang('custom_admin.label_select_deselect_all')</strong>
											</label>
										</div>
									</div>
							@if (count($routeCollection) > 0)
								@php $h = 1; @endphp
								@foreach ($routeCollection as $group => $groupRow)
									@php
									$mainLabel = $group;
									@endphp
									<div class="col-md-12 individual_section">
										<div class="permission-title">
											<h2><strong>{{ ucwords($mainLabel) }}</strong></h2>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="checkAll select_deselect selectDeselectAll" id="customCheck{{$h}}" data-parentRoute="{{ $group }}" id="checkboxSuccess{{$h}}">
												<label class="text-dark cursor-pointer va-top ml-1" for="customCheck{{$h}}">
													@lang('custom_admin.label_select_deselect_all')
												</label>
											</div>
										</div>
										<div class="permission-content section_class">
											<ul>
											@php $listOrIndex = 1; $individualCheckedCount = 0; @endphp
											@foreach($groupRow as $row)
												@php
												$groupClass = str_replace(' ','_',$group);

												$labelName = str_replace(['admin.','.','-',$group], ['',' ',' ',''], $row['path']);
												if (strpos(trim($labelName), 'index') !== false) {
													$labelName = str_replace('index','List',$labelName);
												}
												
												$subClass = str_replace('.','_',$row['path']);

												$listIndexClass = '';
												if ($listOrIndex == 1) $listIndexClass = $group.'_list_index';

												if (in_array($row['role_page_id'], $existingPermission)) {
                                                    $individualCheckedCount++;
                                                }
												@endphp
												<li>
													<div class="custom-control custom-checkbox">
														<input type="checkbox" name="role_page_ids[]" value="{{$row['role_page_id']}}" @if(in_array($row['role_page_id'], $existingPermission))checked @endif data-page="{{ $group }}" data-path="{{ $row['path'] }}" data-class="{{ $groupClass }}" data-listIndex="{{$listIndexClass}}" class="checkAll setPermission {{ $groupClass }} {{ $subClass }} selectDeselectAll" id="customCheck_{{$h}}_{{$listOrIndex}}">
														<label class="text-dark cursor-pointer va-top ml-1" for="customCheck_{{$h}}_{{$listOrIndex}}">
															{{ ucwords($labelName) }}
														</label>
													</div>
												</li>
												@php
                                                if(count($groupRow) == $individualCheckedCount) {
                                                @endphp
                                                    <script>
                                                    $(document).ready(function(){
                                                        $('.{{$groupClass}}').parents('div.individual_section').find('input[type=checkbox]:eq(0)').prop('checked', true);
                                                    });
                                                    </script>
                                                @php
                                                }
                                                $listOrIndex++;
                                                @endphp
											@endforeach
											</ul>
										</div>
									</div>
									@php $h++; @endphp
								@endforeach
							@endif
								</div>
								<!-- Permission section end -->
							</div>
						</div>
						<div class="form-actions mt-4">
							<div class="float-left">
								<a class="btn btn-secondary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3" href="{{ route($routePrefix.'.'.$listUrl) }}">
									<i class="far fa-arrow-alt-circle-left"></i> @lang('custom_admin.btn_cancel')
								</a>
							</div>
							<div class="float-right">
								<button type="submit" id="btn-processing" class="btn btn-primary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3">
									<i class="far fa-save" aria-hidden="true"></i> @lang('custom_admin.btn_update')
								</button>
							</div>
						</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>

@endsection

@push('scripts')
@include($routePrefix.'.'.$pageRoute.'.scripts')
@endpush
