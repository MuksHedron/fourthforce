@csrf

<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Cities <small>Create/Edit City</small></h2>
									
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">City <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name"
												 aria-describedby="name" required value="@isset($city) {{ old('name') === null ? $city->name : old('name')}}  @endisset ">
												@error('name')
												<span class="invalid-feedback" role="alert">
													{{$message}}
												</span>
												@enderror
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">State <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<select name="stateid" class="form-control" >
												<option value=""> -- Select One --</option>
												@foreach($states as $state)
												<div class="mb-3">
													<option value="{{ $state->id }}" @isset($city) {{  $state->id == $city->stateid ? 'selected' : '' }} @endisset> {{ $state->name }}</option>
												</div>
												@endforeach

											</select>
											</div>
										</div>
																				
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<a href="{{ url('cities') }}" ><button class="btn btn-primary" type="button">Cancel</button></a>
												<button type="submit" class="btn btn-success">Submit</button>
											</div>
										</div>

									
								</div>
							</div>
						</div>
					</div>
					
					
					
					
					
					
					
					
					
	
