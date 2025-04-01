<div id="sidebar" class="collapse d-none d-md-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 240px;">
    <div id="image" style="margin-left: 15%">
        <img src="{{ asset('images/AlphaLanches-Logo.png') }}" height=78px" alt="Logo Alpha">
    </div>

    <hr>

    <ul class="nav nav-pills flex-column mb-auto">
        @php
            $userType = auth()->user()->type ?? 'guest'; // Pegando o tipo do usuário logado
            $buttons = [];

            switch ($userType) {
                case 'admin':
                    $buttons = [
                        ['route' => 'home.admin', 'icon' => 'house-door-fill', 'label' => 'Painel Inicial'],
                        ['route' => 'financeiro.index', 'icon' => 'cash-coin', 'label' => 'Financeiro'],
                        ['route' => 'estoque.index', 'icon' => 'box', 'label' => 'Estoque'],
                        ['route' => 'profile.index', 'icon' => 'person', 'label' => 'Perfil'],
                        ['route' => 'home.admin', 'icon' => 'people', 'label' => 'Usuários'],
                        ['route' => 'home.admin', 'icon' => 'basket3', 'label' => 'Histórico de Compras'],
                        ['route' => 'home.admin', 'icon' => 'shop', 'label' => 'PDV'],
                        ['route' => 'home.admin', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
                    ];
                    break;

                case 'func':
                    $buttons = [
                        ['route' => 'home.func', 'icon' => 'house-door-fill', 'label' => 'Painel Inicial'],
                        ['route' => 'estoque.index', 'icon' => 'box', 'label' => 'Estoque'],
                        ['route' => 'profile.index', 'icon' => 'person', 'label' => 'Perfil'],
                        ['route' => 'home.func', 'icon' => 'basket3', 'label' => 'Histórico de Compras'],
                        ['route' => 'home.func', 'icon' => 'shop', 'label' => 'PDV'],
                        ['route' => 'home.func', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
                    ];
                    break;

                case 'student':
                    $buttons = [
                        ['route' => 'home.student', 'icon' => 'house-door-fill', 'label' => 'Painel Inicial'],
                        ['route' => 'profile.index', 'icon' => 'person-circle', 'label' => 'Perfil'],
                    ];
                    break;

                case 'guard':
                    $buttons = [
                        ['route' => 'home.guard', 'icon' => 'house-door-fill', 'label' => 'Painel Inicial'],
                        ['route' => 'profile.index', 'icon' => 'person', 'label' => 'Perfil'],
                        ['route' => 'home.guard', 'icon' => 'shop', 'label' => 'Recarga'],
                        ['route' => 'home.guard', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
                    ];
                    break;

                default:
                    $buttons = [];
                    break;
            }
        @endphp

        <ul class="nav nav-pills flex-column mb-auto">
            @foreach ($buttons as $btn)
                <li class="nav-item">
                    <a href="{{ route($btn['route']) }}" class="nav-link text-white btn btn-primary text-start">
                        <i class="bi bi-{{ $btn['icon'] }} fs-5 me-2"></i> {{ $btn['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>

    </ul>

    <hr>

    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
            data-bs-toggle="dropdown" aria-expanded="false">
            <strong>{{ auth()->user()->name ?? 'Usuário' }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <form id="logout-form" action="{{ route('login.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a class="dropdown-item" href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Sair
                </a>
            </li>
        </ul>
    </div>
</div>