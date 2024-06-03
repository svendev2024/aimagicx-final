<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Styles -->
        <style>
            body{
                margin-top: 200px;
                background-color: #f5f9fc;
            }
            .container {
                padding-top: 5rem;
                padding-bottom: 5rem;
                background-image: url(/img/files/world.png);
                background-position: center center;
                background-repeat: no-repeat;
                background-size: contain;
            }
            .error-main{
                background-color: #fff;
                box-shadow: 0 20px 40px -12px rgb(0 0 0 / 10%);
                border-radius: 1rem;
            }
            .error-main h1{
                font-weight: bold;
                color: #1e1e2d;
                font-size: 150px;
                text-shadow: 2px 2px 5px #1e1e2d;
            }
            .error-main h6{
                font-family: 'Poppins', sans-serif;
                color: #42494F;
                font-size: 20px;
                margin-top: 1rem;
            }
            .error-main p{
                color: #9897A0;
                font-size: 15px; 
            }
            .special-action-button {
                font-family: "Poppins", sans-serif;
                font-size: 12px;
                background-color: #007BFF;
                padding-left: 2rem;
                padding-right: 2rem;
                text-transform: none;
                font-weight: 700;
                box-shadow: 0 5px 10px rgb(60 66 150 / 38%) !important;
                border-radius: 35px !important;
                transition: all 0.3s ease !important;
            }
            .special-action-button:hover {
                border-color: #1e1e2d;
                background-color: #1e1e2d;
                box-shadow: 0 1px 3px 0 rgb(50 50 50 / 20%), 0 2px 1px -1px rgb(50 50 50 / 12%), 0 1px 1px 0 rgb(50 50 50 / 14%)!important;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-6 offset-lg-3 col-sm-6 offset-sm-3 col-12 p-3 pb-5 error-main">
                    <div class="row">
                      <div class="col-lg-8 col-12 col-sm-10 offset-lg-2 offset-sm-1">
                        <h1 class="m-0">
                            @yield('code')
                        </h1>
                        <h6>
                            @yield('message')
                        </h6>
                        <p>{{ __('Keep searching and you will find it one day, we all do!') }}</p>
                        <a href="{{ url('/') }}" class="btn btn-primary special-action-button mt-3">{{ __('Back to Main Page') }}</a>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </body>
</html>
