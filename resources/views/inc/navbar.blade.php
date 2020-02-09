<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/soen341/public/index/">{{config('app.name','dev')}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/soen341/public/posts/">Posts<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/soen341/public/profile/">Profile</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">    
            <li class="nav-item">
                <a class="nav-link" href="/soen341/public/login/">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/soen341/public/register/">Register</a>
            </li>
        </ul>
    </div>
</nav>