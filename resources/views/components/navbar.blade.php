<nav class="navbar navbar-expand-sm navbar-toggleable-sm  box-shadow mb-0" style="background-color:#000000c2">
            <div class="container ">
                <a class="navbar-brand text-white" style="font-size:90%" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 3.293l6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                    </svg>
                HOME</a>
                <button class="navbar-toggler" style="background-color:whitesmoke" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse d-sm-inline-flex flex-sm-row-reverse">
                    <ul class="navbar navbar-nav ">
            
                    {{-- <li><a class="text-white text-decoration-none mr-3" href="/">DASHBOARD</a></li> --}}

                    <li><a class="text-white text-decoration-none mr-3" href="/employees">EMPLOYEES</a></li>
                        

                    <li><a class="text-white text-decoration-none mr-3" href="/crops">CROPS</a></li>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Logout') }}
                        </x-dropdown-link>
                    </form>

                    </ul>
                </div>
            </div>
        </nav>