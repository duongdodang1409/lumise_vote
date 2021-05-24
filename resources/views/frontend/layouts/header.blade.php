@extends('Frontend/layouts.head')

<header>
    <div class="container">
        <div class="top">
            <div class="logo">
                <a class="path_home" href="/">
                    <div class="image_logo">
                        <img src="{{asset('frontend/images/logo.png')}}"/>
                    </div>
                    <h3>Canny</h3>
                </a>
            </div>
            <div class="navba">
                {{--<div class="dropdown">--}}
                    {{--<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                        {{--{{strtoupper(app()->getLocale())}}--}}
                    {{--</button>--}}
                    {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
                        {{--@foreach (config('app.available_locales') as $locale)--}}

                                {{--<a class="nav-link"--}}
                                   {{--href="{{ Route::currentRouteName() }}"--}}
                                   {{--@if (app()->getLocale() == $locale) style="font-weight: bold; text-decoration: underline" @endif>{{ strtoupper($locale) }}</a>--}}

                        {{--@endforeach--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
            <div class="login">

                @if(Session::has('user_id'))
                    {{--<a href="/logout" class="logout">LOGOUT--}}
                    {{--</a>--}}
                    <div class="dropdown show">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if(session()->has('user_nickname'))
                                <?php
                                $name = session()->get('user_nickname');

                                ?>
                                <?php
                                echo substr($name,0,1);
                                ?>@endif
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{URL('dash')}}">Settings</a>
                            <a class="dropdown-item" href="{{ route('Auth.password_user') }}">chang password</a>
                            <a class="dropdown-item" href="{{URL('logout')}}">logout</a>

                        </div>
                    </div>


                @else

                <a href="login" class="register" data-toggle="modal" data-target="#sign_up">SIGN UP / </a>
                <a href="login" class="login" data-toggle="modal" data-target="#login">LOGIN</a>
                @endif


            </div>


        </div>
        <nav class="navbar navbar-expand-lg pl-0 pr-0">
            <div class="navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="frontpage"><span class="fas fa-align-left"></span>Roadmap</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-map-marker-alt"></span>
                            Feature Requests
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="featurerequests">Feature Requests<span class="count_item">700</span></a>
                            <a class="dropdown-item" href="integrations">Integrations<span class="count_item">30</span></a>
                            <a class="dropdown-item" href="languages">Languages<span class="count_item">35</span></a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>


