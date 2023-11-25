<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ABC Blogs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
          integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/js/all.min.js"
            integrity="sha512-cyAbuGborsD25bhT/uz++wPqrh5cqPh1ULJz4NSpN9ktWcA6Hnh9g+CWKeNx2R0fgQt+ybRXdabSBgYXkQTTmA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        /* Profile Picture */
        .profile-pic {
            display: inline-block;
            vertical-align: middle;
            width: 50px;
            height: 50px;
            overflow: hidden;
            border-radius: 50%;
        }

        .profile-pic img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .profile-menu .dropdown-menu {
            right: 0;
            left: unset;
        }

        .profile-menu .fa-fw {
            margin-right: 10px;
        }

        .toggle-change::after {
            border-top: 0;
            border-bottom: 0.3em solid;
        }
    </style>
    @yield('styles')
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-fix bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('posts.index')}}">My Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 profile-menu">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="profile-pic">
                            <img src="https://source.unsplash.com/250x250?man" alt="Profile Picture">
                        </div>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-sliders-h fa-fw"></i> Account</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog fa-fw"></i> Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a class="dropdown-item" href="{{route('logout')}}"
                                   onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt fa-fw"></i> Log Out
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container">
    @yield('content')
</div>
@yield('scripts')
</body>
</html>
