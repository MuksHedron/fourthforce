@extends('layouts.auth')

@section('title')
Login
@endsection

@section('content')

 
<form  class="pt-5" method="POST" action="{{ route('login') }}">
@csrf
    <div class="col-md-12">
        <label>User Id</label>
        <input type="email" name="email" style="border:5px solid #254A9A; border-radius: 26px; height:50px; font-family: raleway-bold;color:#254A9A; " class="form-control" id="user" placeholder="Enter email"><br>
        <label>Password</label>
        <input type="password" name="password" style="border:5px solid #254A9A; border-radius: 26px; height:50px;color:#254A9A; font-family: raleway-bold;" id="pass" class="form-control" placeholder="Enter Password">

        <p class="text-right"><a href="#" style="font-family: raleway-mediumItalic;"><span style="color: red;">Forgot Password?</span></a></p><br>
       
        <div class="col-sm-12">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-10">
                <button type="submit" class="button" style="border-radius: 26px; height:50px; width:100%; font-family: raleway-bold;outline:none;background-color:#254A9A;"  onclick=""><span style="color: #fff;">LOGIN</span></button><br><br>
            </div>
            <div class="col-sm-1">
            </div>
        </div>
    </div>
</form>

@endsection