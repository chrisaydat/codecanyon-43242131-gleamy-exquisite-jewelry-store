<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title> {{ $general->siteName(__('404')) }}</title>

        <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/main.css')}}">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .error-pate-wrap {
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center center;
                position: relative;
                z-index: 2;
            }

            .error-pate-wrap:before {}

            .error-pate-wrap:before {
                position: absolute;
                content: "";
                width: 100%;
                height: 100%;
                background: #7042b9;
                opacity: .5;
                z-index: -2;
            }
            .error-pate-wrap .theme_btn {
                text-decoration: none;
            }
            .error-content h1 {
                font-size: 140px;
            }

            .error-content p {
                color: #fff;
            }
            a.btn.btn--base.errorbtn {
                background: #ffc679;
            }
        </style>
    </head>


    <body>
        <div class="error-pate-wrap d-flex align-items-center justify-content-center vh-100" style="background-image: url({{asset($activeTemplateTrue.'images/error.jpg')}})">
            <div class="error-content text-center">
                <h1 class="display-1 fw-bold text-white">@lang('404')</h1>
                <p class="fs-1">@lang('Page not found.')</p>
                <p class="lead mb-40">
                    @lang('The page you’re looking for doesn’t exist.')
                  </p>
                <a href="{{route('home')}}" class="btn btn--base errorbtn">@lang('Go Home')</a>
            </div>
        </div>
    </body>
</html>


