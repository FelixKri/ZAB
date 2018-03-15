<div class="container bg-dark">
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/">Zahlungssystem</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            @if(Auth::check())
                @if($user->isAdmin == true)
                <li class="nav-item">
                    <a class="nav-link" href="/admin/panel">Admin panel</a>
                </li>
                @endif
            @endif
        </ul>
        @if(Auth::check())
            <ul class="navbar-nav my-2 my-lg-0">
                    @if($user->canWrite == true)
                    <li class="nav-item">
                        <a class="btn btn-success" href="/bill/new">Rechnung erstellen</a>
                    </li>
                    @endif
                    @if($user->isAdmin == true)
                    <li class="nav-item" style="margin-left: 10px;">
                        <a class="btn btn-primary" href="/bill/edit">Rechnungen verwalten</a>
                    </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{$user->vorName}} {{$user->nachName}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/">Offene Rechnungen</a>
                            <a class="dropdown-item" href="/archive">Bezahlte Rechnungen</a>
                            <a class="dropdown-item" href="/logout">Auloggen</a>
                        </div>
                    </li>
            </ul>
        @endif


    </div>
</nav>
</div>