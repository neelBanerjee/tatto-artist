@extends('admin.layout.main')
@section('title', env('APP_NAME') . ' | Artist-create')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card">
                <div class="card-title">
                    <h4>Create Artist</h4>
                    @if (Session::has('msg'))
                        <p class="alert alert-info">{{ Session::get('msg') }}</p>
                    @endif
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('artists.store') }}" method="POST" enctype="multipart/form-data" id="artistProfileUpdate">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Artist Name</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" placeholder="full name" name="name"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Username</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" placeholder="username" name="username"
                                            value="{{ old('username') }}">
                                        @error('username')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" placeholder="email address"
                                            name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" id="phone" placeholder="phone number" name="phone"
                                            value="{{ old('phone') }}">
                                        @error('name')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Main Address</label>
                                <input type="text" class="form-control" placeholder="address" name="address" id="autocomplete"> 
                                <input type="hidden" name="latitude" id="latitude">    
                                <input type="hidden" name="longitude" id="longitude">    
                                @error('address')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Address Line 2</label>
                                <input type="text" class="form-control" placeholder="Enter additional address details like premises, apartment no etc." name="address2"> 
                                @error('address2')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Country</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" id="country" placeholder="Country" name="country">
                                        @error('country')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>    
    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" id="state" placeholder="state" name="state">
                                        @error('state')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
    
                            </div>
    
                            <div class="row">
    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" id="city" placeholder="city" name="city">
                                        @error('city')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>    
    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Zip Code</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" id="zipcode" placeholder="zipcode" name="zipcode">
                                        @error('zipcode')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
    
                            </div>    

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Password</label><span class="text-danger">*</span>
                                        <input type="password" class="form-control" placeholder="password" name="password"
                                            value="{{ old('password') }}">
                                        @error('password')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>    
                                
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Profile Image</label>
                                        <input type="file" class="form-control" name="profile_image"
                                            value="{{ old('profile_image') }}">
                                        @error('profile_image')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Banner Image</label>
                                        <input type="file" class="form-control" name="banner_image"
                                            value="{{ old('banner_image') }}">
                                        @error('banner_image')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>    

                            <div class="row">

                                <div class="col-md-2">
                                    <label>Sunday Time</label>
                                </div>

                                <div class="col-md-2">
                                    <input type="time" name="sunday_from" class="form-control">
                                </div>

                                <div class="col-md-2">
                                    <input type="time" name="sunday_to" class="form-control">

                                </div>



                                <div class="col-md-2">
                                    <label>Monday Time</label>
                                </div>

                                <div class="col-md-2">
                                    <input type="time" name="monday_from" class="form-control">
                                </div>

                                <div class="col-md-2">
                                    <input type="time" name="monday_to" class="form-control">

                                </div>

                                <div class="col-md-2">
                                    <label>Tuesday Time</label>
                                </div>

                                <div class="col-md-2">
                                    <input type="time" name="tuesday_from" class="form-control">
                                </div>

                                <div class="col-md-2">
                                    <input type="time" name="tuesday_to" class="form-control">

                                </div>

                                <div class="col-md-2">
                                    <label>Wednesday Time</label>
                                </div>

                                <div class="col-md-2">
                                    <input type="time" name="wednesday_from" class="form-control">
                                </div>

                                <div class="col-md-2">
                                    <input type="time" name="wednesday_to" class="form-control">

                                </div>

                                <div class="col-md-2">
                                    <label>Thursday Time</label>
                                </div>

                                <div class="col-md-2">
                                    <input type="time" name="thrusday_from" class="form-control">
                                </div>

                                <div class="col-md-2">
                                    <input type="time" name="thrusday_to" class="form-control">

                                </div>

                                <div class="col-md-2">
                                    <label>Friday Time</label>
                                </div>

                                <div class="col-md-2">
                                    <input type="time" name="friday_from" class="form-control">
                                </div>

                                <div class="col-md-2">
                                    <input type="time" name="friday_to" class="form-control">

                                </div>

                                <div class="col-md-2">
                                    <label>Saturday Time</label>
                                </div>

                                <div class="col-md-2">
                                    <input type="time" name="saterday_from" class="form-control">
                                </div>

                                <div class="col-md-2">
                                    <input type="time" name="saterday_to" class="form-control">

                                </div>

                            </div>

                            <button type="submit" id="submitProfileUpdate" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <!-- Include Inputmask from CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
        <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAE6dk-Oc544R2gZpwVqPQDhN0VGAjkxhw&loading=async&libraries=places&callback=initAutocomplete"></script>


        <script>
             // Function to initialize the autocomplete
             function initAutocomplete() {
                // Create the autocomplete object, restricting the search to the US
                var input = $('#autocomplete')[0];
                var options = {
                    types: ['address'],
                    componentRestrictions: { country: 'us' }
                };
                var autocomplete = new google.maps.places.Autocomplete(input, options);

                // Event listener for when a place is selected
                autocomplete.addListener('place_changed', function() {
                    var place = autocomplete.getPlace();
                    if (!place.geometry) {
                        console.log("No details available for input: '" + place.name + "'");
                        return;
                    }

                    // Extracting address components
                    var addressComponents = place.address_components;
                    var country = '';
                    var state = '';
                    var city = '';
                    var zipCode = '';

                    // Loop through each component to find country, state, city, and zip code
                    $.each(addressComponents, function(index, component) {
                        var componentType = component.types[0];
                        if (componentType === 'country') {
                            country = component.long_name;
                        } else if (componentType === 'administrative_area_level_1') {
                            state = component.long_name;
                        } else if (componentType === 'locality') {
                            city = component.long_name;
                        } else if (componentType === 'postal_code') {
                            zipCode = component.long_name;
                        }
                    });

                    // Extract latitude and longitude
                    var latitude = place.geometry.location.lat();
                    var longitude = place.geometry.location.lng();

                    if(country.length > 0){
                        $("#country").val(country);
                    }

                    if(state.length > 0){
                        $("#state").val(state);
                    }

                    if(city.length > 0){
                        $("#city").val(city);
                    }

                    if(zipCode.length > 0){
                        $("#zipcode").val(zipCode);
                    }

                    $("#latitude").val(latitude);
                    $("#longitude").val(longitude);

                    // Display the extracted address components
                    console.log('Country:', country);
                    console.log('State:', state);
                    console.log('City:', city);
                    console.log('Zip Code:', zipCode);
                    console.log('Latitude:', latitude);
                    console.log('Longitude:', longitude);
                });
            }

            $(document).ready(function() {
                $('#phone').inputmask('(999) 999-9999');

                $("#submitProfileUpdate").on("click",function(){
                    $("#phone").inputmask({removeMaskOnSubmit: true});
                    $("#artistProfileUpdate").submit();
                });
            });
        </script>
    @endsection
