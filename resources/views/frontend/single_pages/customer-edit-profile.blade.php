
@extends('frontend.layouts.master')
@section('content')

<style type="text/css">
    .prof li{
        background: #1781BF;
        padding: 7px;
        margin: 3px;
        border-radius: 15px;
    }
    .prof li a{
        color: #000;
        padding-left: 15px;
    }
</style>
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('frontend/images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Edit Profile
		</h2>
	</section>
		<div class="container">
			<div class="row" style="padding: 15px 0px 15px 0px;">
                    <div class="col-md-2">
                        <ul class="prof">
                            <li><a href="{{ route('dashboard') }}">Profile</a></li>
                            <li><a href="{{ route('customer.password.change') }}">Password Change</a></li>
                            <li><a href="{{ route('customer.order.list') }}">Orders</a></li>
                        </ul>
                    </div>
                	<div class="col-md-10">
                        <h3>Edit profile</h3>
                       <form action="{{ route('customer.update.profile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label>Full Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $editData->name }}">
                                <font color="red">{{ ($errors->has('name'))?($errors->first('name')):'' }}</font>
                            </div>
                            <div class="col-md-4">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $editData->email }}">
                                <font color="red">{{ ($errors->has('email'))?($errors->first('email')):'' }}</font>
                            </div>
                            <div class="col-md-4">
                                <label>Mobile No</label>
                                <input type="text" name="mobile" class="form-control" value="{{ $editData->mobile }}">
                                <font color="red">{{ ($errors->has('mobile'))?($errors->first('mobile')):'' }}</font>
                            </div>
                            <div class="col-md-4">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" value="{{ $editData->address }}">
                            </div>
                            <div class="col-md-4">
                                <label>Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ ($editData->gender == "male")?"selected":""  }}>Male</option>
                                    <option value="female" {{ ($editData->gender == "female")?"selected":""  }}>Female</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Image</label>
                                <input type="file" name="image" id="image" class="form-control" value="{{ $editData->image }}">
                            </div>
                             <div class="col-md-2">
                                    <img id="showImage" src="{{ (!empty($editData->image)) ? url('upload/user_images/'.$editData->image):url('upload/no_image.png')}}" style="width: 80px;height: 90px;border: 1px solid #000">
                            </div>
                             <div class="col-md-4" style="padding-top: 30px">
                                <button type="submit" class="btn btn-primary">Profile update</button>
                            </div>

                        </div>
                    </form>
                    </div>
			</div>
		</div>

@endsection
