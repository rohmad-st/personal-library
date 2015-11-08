<!DOCTYPE html>
<html ng-app="app">
<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="initial-scale=1.0, width=device-width" name="viewport">
    <title>Personal Library</title>
    <!-- css -->
    <link href="{!! asset('/css/base.min.css') !!}" rel="stylesheet">
    <!-- css for this project -->
    <link href="{!! asset('/css/project.min.css') !!}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <!--[if lte IE 10]>
    <script type="text/javascript">document.location.href = '/unsupported-browser'</script>
    <![endif]-->
    <!-- favicon -->
    <!-- ... -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="avoid-fout page-brand">
<div class="avoid-fout-indicator avoid-fout-indicator-fixed">
    <div class="progress-circular progress-circular-center">
        <div class="progress-circular-wrapper">
            <div class="progress-circular-inner">
                <div class="progress-circular-left">
                    <div class="progress-circular-spinner"></div>
                </div>
                <div class="progress-circular-gap"></div>
                <div class="progress-circular-right">
                    <div class="progress-circular-spinner"></div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Top Header --}}
<header class="header header-transparent header-waterfall"
        ui-view="header_top" ng-controller="HeaderTopCtrl"></header>
{{-- Left Sidebar --}}
<nav aria-hidden="true" class="menu" id="menu" tabindex="-1"
     ui-view="sidebar_left" ng-controller="SidebarLeftCtrl"></nav>
{{-- Right Sidebar --}}
<nav aria-hidden="true" class="menu menu-right" id="profile" tabindex="-1"
     ui-view="sidebar_right" ng-controller="SidebarRightCtrl"></nav>
<div class="content">
    <div class="content-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-push-3 col-sm-10 col-sm-push-1">
                    <h1 class="heading">Material</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container" ui-view="main"></div>
</div>
<footer class="footer">
    <div class="container">
        <p>Material</p>
    </div>
</footer>
<div class="fbtn-container">
    <div class="fbtn-inner">
        <a class="fbtn fbtn-brand-accent fbtn-lg" data-toggle="dropdown"><span class="fbtn-text">Links</span><span
                    class="fbtn-ori icon">add</span><span class="fbtn-sub icon">close</span></a>

        <div class="fbtn-dropdown">
            <a class="fbtn" href="https://github.com/Daemonite/material" target="_blank"><span class="fbtn-text">Fork me on GitHub</span><span
                        class="fa fa-github"></span></a>
            <a class="fbtn fbtn-blue" href="https://twitter.com/daemonites" target="_blank"><span class="fbtn-text">Follow Daemon on Twitter</span><span
                        class="fa fa-twitter"></span></a>
            <a class="fbtn fbtn-alt" href="http://www.daemon.com.au/" target="_blank"><span class="fbtn-text">Visit Daemon Website</span><span
                        class="icon">link</span></a>
        </div>
    </div>
</div>
<!-- js -->
{{--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>--}}
{{--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular-route.js"></script>--}}
<script src="{!! asset('/js/jquery.min.js') !!}"></script>
<script src="{!! asset('/js/base.min.js') !!}"></script>
<script src="{!! asset('/js/project.min.js') !!}"></script>
<script src="{!! asset('/js/vendor.js') !!}"></script>
<script src="{!! asset('/js/prism.js') !!}"></script>
<script src="{!! asset('/js/app.js') !!}"></script>
<script src="{!! asset('/js/ngStorage.min.js') !!}"></script>
<!-- js for this project -->
{{--Live reload --}}
@if ( Config::get('app.debug') )
    <script type="text/javascript">
        document.write('<script src="//localhost:35729/livereload.js?snipver=1" type="text/javascript"><\/script>')
    </script>
@endif
</body>
</html>