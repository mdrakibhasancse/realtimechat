<!DOCTYPE html>
<html>
<head>
  <title>Real Time Chat</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-lg">
    <div class="container justify-content-between">
        <a class="navbar-brand" href="#">Dashboard</a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        {{auth()->user()->name}}
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
  </nav>

  <div class="container pt-5">
    <div class="row">
        <div class="col-8 offset-2">
            <div class="tabel-rsposive">
                <table class="table table-striped table-sm table-bordered">
                    <thead class="table-sm ">
                    <tr>
                        <th scope="col">
                            Name
                        </th>
                        <th scope="col">
                            Email
                        </th>
                        <th scope="col">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody class="table-sm">
                    @foreach($users as $user)
                        <tr class="">
                        <th>
                            {{$user->name}}
                        </th>
                        <th>
                            {{$user->email}}
                        </th>
                        <td class="">
                            <a href="{{ route('sendMessage', $user->id)}}"  class="text-primary"><u>Chat With!</u></a> 
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
   
  </div>
</body>
</html>