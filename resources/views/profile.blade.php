@extends('layouts.default')

@section('title', 'AlphaLanches - Perfil')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

@section('content')
    <div class="container">
        <h2 class="mb-4">Meu Perfil</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4 text-center">
                    <label for="profile_picture" class="d-inline-block position-relative profile-container" style="cursor: pointer;">
                        <img id="profilePreview"
                            src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/photo_user_generic.png') }}"
                            class="rounded-circle border profile-image" width="250" height="250" alt="Foto de Perfil">
                        <div class="profile-overlay">
                            <i class="fas fa-camera profile-icon"></i>
                        </div>
                        <input type="file" class="d-none" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewImage(event)">
                    </label>
                    @if($user->profile_picture)
                        <br>
                        <a href="{{ route('profile.remove_picture') }}" class="btn btn-danger btn-sm mt-2">Remover Foto</a>
                    @endif
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf', $user->cpf) }}">
                        @error('cpf') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                        @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Nova Senha (opcional)</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>
            </div>

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary me-2">Salvar Alterações</button>
                <button type="submit" class="btn btn-danger" formaction="{{ route('profile.delete') }}" formmethod="POST" onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.');">Excluir Conta</button>
            </div>
        </form>
    </div>

    <style>
        .profile-container {
            position: relative;
            display: inline-block;
        }

        .profile-image {
            transition: 0.3s;
        }

        .profile-container:hover .profile-image {
            filter: brightness(0.5);
        }

        .profile-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: 0.3s;
        }

        .profile-container:hover .profile-overlay {
            opacity: 1;
        }

        .profile-icon {
            color: white;
            font-size: 24px;
        }
    </style>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                const preview = document.getElementById('profilePreview');
                preview.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection