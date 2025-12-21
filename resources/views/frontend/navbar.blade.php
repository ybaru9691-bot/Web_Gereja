<nav class="navbar navbar-expand-lg navbar-light bg-light p-3 shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold">Logo Gereja</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
           <ul class="navbar-nav mx-auto">
                      <li class="nav-item">
                           <a class="nav-link" href="{{ route('home') }}">Home</a>
                          </li>
                        <li class="nav-item">
                             <a class="nav-link" href="{{ route('warta.index') }}">Warta Jemaat</a>
                                </li>
                              <li class="nav-item">
                                <a class="nav-link" href="{{ route('jadwal') }}">Jadwal Ibadah</a>
                                  </li>
                                 <li class="nav-item">
                           <a class="nav-link" href="{{ route('pengumuman') }}">Pengumuman</a>
                                    </li>
                                              <li class="nav-item">
                                      <a class="nav-link" href="{{ route('tentang') }}">Tentang Gereja</a>
                                           </li>
                              <li class="nav-item">
                                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                                    </li>
                                    

                                                </ul>


            <a href="{{ route('login') }}" class="btn btn-primary px-4">Login</a>
        </div>
    </div>
</nav>
