<nav class="navbar navbar-dark navbar-expand-md py-3" style="background: var(--bs-black);">
    <div class="container"><a class="navbar-brand d-flex align-items-center"
            href="#"><span>Password_Generator</span></a><button data-bs-toggle="collapse" class="navbar-toggler"
            data-bs-target="#navcol-4"><span class="visually-hidden">Toggle
                navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse flex-grow-0 order-md-first" id="navcol-4">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
                @auth

                    <li class="nav-item"><a class="nav-link " href="/profile">profile</a></li>

                    <li class="nav-item"><a class="nav-link" href="saved">Saved Password</a></li>
                @endauth
            </ul>
            <div class="d-md-none my-2"><button class="btn btn-light me-2" type="button">Button</button><button
                    class="btn btn-primary" type="button">Button</button></div>
        </div>
        @auth
            <div class="d-none d-md-block">
                <span class="text-light lead m-2">{{ auth()->user()->username }}</span>
                <a href="/logout" class="btn btn-light me-2">log out</a>
            </div>
        @else
            <div class="d-none d-md-block"><a href="/login" class="btn btn-light me-2">login</a>
                <a class="btn btn-dark" role="button" href="/register">sign up</a>
            @endauth
        </div>
    </div>
</nav>
