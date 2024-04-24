<div class="wrapper dark:bg-blue-900" >
    <div>
    <nav class="navbar navbar-expand-lg dark:bg-blue-900">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
            {{-- Master Admin  --}}
            @if (Auth::user()->role == 1)
            <a href="{{ route('user_create') }}">
                <button class="left-deshboard-btns btn btn-secondary bg-blue-400 hover:bg-blue-500" type="button">
                    Create User
                </button>
            </a>
            <a href="{{ route('listUser') }}">
                <button class="left-deshboard-btns btn btn-secondary bg-blue-400 hover:bg-blue-500" type="button">
                    List Users
                </button>
            </a>
            {{-- DC/SDO  --}}
            @elseif (Auth::user()->role == 2)
            <a href="{{  route('addUser') }}">
                <button class="left-deshboard-btns btn btn-secondary bg-blue-400 hover:bg-blue-500" type="button">
                    Create User
                </button>
            </a>
            <a href="{{route('addDepartment')}}">
                <button class="left-deshboard-btns btn btn-secondary bg-blue-400 hover:bg-blue-500" type="button">
                    Create Department
                </button>
            </a>
            <a href="{{ route('listUser') }}">
                <button class="left-deshboard-btns btn btn-secondary bg-blue-400 hover:bg-blue-500" type="button">
                    User List
                </button>
            </a>
            <a href="{{route('departmentList')}}">
                <button class="left-deshboard-btns btn btn-secondary bg-blue-400 hover:bg-blue-500" type="button">
                    Department List
                </button>
            </a>

            <a href="{{ route('listScheme') }}">
                <button class="left-deshboard-btns btn btn-secondary bg-blue-400 hover:bg-blue-500" type="button">
                    List of Schemes
                </button>
            </a>

            <a href="{{ route('messages') }}" class="mr-2">
                <button class="left-deshboard-btns btn btn-secondary bg-blue-400 hover:bg-blue-500" type="button">
                    Messages @include('messenger.unread-count')
                </button>
            </a>
            {{-- HOD Department --}}
            @else
            <a href="{{ route('schemeCreate') }}">
                <button class="left-deshboard-btns btn btn-secondary bg-blue-400 hover:bg-blue-500" type="button">
                    Create Scheme
                </button>
            </a>
            <a href="{{ route('listScheme') }}">
                <button class="left-deshboard-btns btn btn-secondary bg-blue-400 hover:bg-blue-500" type="button">
                    List Of Schemes
                </button>
            </a>

            <a href="{{ route('messages') }}" class="mr-2">
                <button class="left-deshboard-btns btn btn-secondary bg-blue-400 hover:bg-blue-500" type="button">
                    Messages @include('messenger.unread-count')
                </button>
            </a>
            @endif
        </nav>
    </div>
 </div>