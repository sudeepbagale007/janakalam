@extends('admin/app')
@section('content-header', 'Theme Options')
@section('content')
<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Skins</h3>
    </div>
    <div class="box-body">
        <ul class="list-unstyled">
            <li class="listyle">
                <a href="{{ route('ui_skin.change', 'skin-blue-light')}}" class=" full-opacity-hover shadowl">
                    <div>
                        <span style="display:block; width: 20%; float: left; height: 21px; background: #367fa9"></span>
                        <span class="bg-light-blue spancolor2"></span>
                    </div>
                    <div>
                        <span class="spancolor3" style="background: #f9fafc"></span>
                        <span class="spancolor4"></span>
                    </div>
                </a>
                <p class="text-center no-margin">Blue Light</p>
            </li>
            <li class="listyle">
                <a href="{{ route('ui_skin.change', 'skin-black-light')}}" class="clearfix full-opacity-hover shadowl">
                    <div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix">
                        <span style="display:block; width: 20%; float: left; height: 21px; background: #fefefe"></span>
                        <span class="spancolor2" style="background: #fefefe"></span>
                    </div>
                    <div>
                        <span class="spancolor3" style="background: #f9fafc"></span>
                        <span class="spancolor4"></span>
                    </div>
                </a>
                <p class="text-center no-margin">Black Light</p>
            </li>
            <li class="listyle">
                <a href="{{ route('ui_skin.change', 'skin-purple-light')}}" class="clearfix full-opacity-hover shadowl">
                    <div>
                        <span style="display:block; width: 20%; float: left; height: 21px;" class="bg-purple-active"></span>
                        <span class="bg-purple spancolor2"></span>
                    </div>
                    <div>
                        <span class="spancolor3" style="background: #f9fafc"></span>
                        <span class="spancolor4"></span>
                    </div>
                </a>
                <p class="text-center no-margin">Purple Light</p>
            </li>
            <li class="listyle">
                <a href="{{ route('ui_skin.change', 'skin-green-light')}}" class="clearfix full-opacity-hover shadowl">
                    <div>
                        <span style="display:block; width: 20%; float: left; height: 21px;"
                        class="bg-green-active"></span>
                        <span class="bg-green spancolor2"></span>
                    </div>
                    <div>
                        <span class="spancolor3a" style=""></span>
                        <span class="spancolor4"></span>
                    </div>
                </a>
                <p class="text-center no-margin">Green Light</p>
            </li>
            <li class="listyle">
                <a href="{{ route('ui_skin.change', 'skin-red-light')}}" class="clearfix full-opacity-hover shadowl">
                    <div>
                        <span style="display:block; width: 20%; float: left; height: 21px;"
                        class="bg-red-active"></span>
                        <span class="bg-red spancolor2"></span>
                    </div>
                    <div>
                        <span class="spancolor3a" style=""></span>
                        <span class="spancolor4"></span>
                    </div>
                </a>
                <p class="text-center no-margin">Red Light</p>
            </li>
            <li class="listyle">
                <a href="{{ route('ui_skin.change', 'skin-yellow-light')}}" class="clearfix full-opacity-hover shadowl">
                    <div>
                        <span style="display:block; width: 20%; float: left; height: 21px;" class="bg-yellow-active"></span>
                        <span class="bg-yellow spancolor2"></span>
                    </div>
                    <div>
                        <span class="spancolor3a" style=""></span>
                        <span class="spancolor4"></span>
                    </div>
                </a>
                <p class="text-center no-margin">Yellow Light</p>
            </li>
            <li class="listyle">
                <a href="{{ route('ui_skin.change', 'skin-blue')}}" class="clearfix full-opacity-hover shadowl">
                    <div>
                        <span style="display:block; width: 20%; float: left; height: 21px; background: #367fa9"></span>
                        <span class="bg-light-blue spancolor2"></span>
                    </div>
                    <div>
                        <span class="spancolor3"></span>
                        <span class="spancolor4"></span>
                    </div>
                </a>
                <p class="text-center no-margin">Blue</p>
            </li>
            <li class="listyle">
                <a href="{{ route('ui_skin.change', 'skin-black')}}" class="clearfix full-opacity-hover shadowl">
                    <div class="clearfix">
                        <span style="display:block; width: 20%; float: left; height: 21px; background: #fefefe"></span>
                        <span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span>
                    </div>
                    <div>
                        <span class="spancolor3"></span>
                        <span class="spancolor4"></span>
                    </div>
                </a>
                <p class="text-center no-margin">Black</p>
            </li>
            <li class="listyle">
                <a href="{{ route('ui_skin.change', 'skin-purple')}}" class="clearfix full-opacity-hover shadowl">
                    <div>
                        <span style="display:block; width: 20%; float: left; height: 21px;" class="bg-purple-active"></span>
                        <span class="bg-purple spancolor2"></span>
                    </div>
                    <div>
                        <span class="spancolor3"></span>
                        <span class="spancolor4"></span>
                    </div>
                </a>
                <p class="text-center no-margin">Purple</p>
            </li>
            <li class="listyle">
                <a href="{{ route('ui_skin.change', 'skin-green')}}" class="clearfix full-opacity-hover shadowl">
                    <div>
                        <span style="display:block; width: 20%; float: left; height: 21px;" class="bg-green-active"></span>
                        <span class="bg-green spancolor2"></span>
                    </div>
                    <div>
                        <span class="spancolor3"></span>
                        <span class="spancolor4"></span>
                    </div>
                </a>
                <p class="text-center no-margin">Green</p>
            </li>
            <li class="listyle">
                <a href="{{ route('ui_skin.change', 'skin-red')}}" class="clearfix full-opacity-hover shadowl">
                    <div>
                        <span style="display:block; width: 20%; float: left; height: 21px;" class="bg-red-active"></span>
                        <span class="bg-red spancolor2"></span>
                    </div>
                    <div>
                        <span class="spancolor3"></span>
                        <span class="spancolor4"></span>
                    </div>
                </a>
                <p class="text-center no-margin">Red</p></li>
                <li class="listyle">
                    <a href="{{ route('ui_skin.change', 'skin-yellow')}}"
                        class="clearfix full-opacity-hover shadowl">
                        <div>
                            <span style="display:block; width: 20%; float: left; height: 21px;" class="bg-yellow-active"></span>
                            <span class="bg-yellow spancolor2"></span>
                        </div>
                        <div>
                            <span class="spancolor3"></span>
                            <span class="spancolor4"></span>
                        </div>
                    </a>
                    <p class="text-center no-margin">Yellow</p>
                </li>
            </ul>
        </div>
    </div>
    <style type="text/css">
    .listyle{
    float:left;
    width: 25%;
    padding: 5px;
    }
    .shadowl{
    display: block;
    box-shadow: 0 0 3px rgba(0,0,0,0.4)
    }
    .spancolor1 {
    }
    .spancolor2 {
    display:block; width: 80%; float: left; height: 21px;
    }
    .spancolor3 {
    display:block; width: 20%; float: left; height: 125px; background: #222d32;
    }
    .spancolor4 {
    display:block; width: 80%; float: left; height: 125px; background: #f4f5f7;
    }
    .spancolor3a {
    display:block; width: 20%; float: left; height: 125px; background: #f9fafc;
    }
    </style>
    @endsection