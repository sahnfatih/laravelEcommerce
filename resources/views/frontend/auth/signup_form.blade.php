@extends('frontend.shared.frontend_theme')
@section('title', 'Üye Ol')
@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h2><i class="fas fa-user-plus"></i> Üye Ol</h2>
            <p>HawkMarkt'a hoş geldiniz</p>
        </div>

        <form action="{{ route('signup') }}" method="POST" autocomplete="off" class="auth-form">
            @csrf
            <div class="form-group">
                <div class="input-group">
                    <span class="input-icon">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Ad Soyad"
                           required>
                </div>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-icon">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="E-posta Adresi"
                           required>
                </div>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-icon">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           id="password"
                           name="password"
                           placeholder="Şifre"
                           required>
                    <span class="password-toggle" onclick="togglePassword('password')">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-icon">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password"
                           class="form-control"
                           id="password_confirmation"
                           name="password_confirmation"
                           placeholder="Şifre Tekrar"
                           required>
                    <span class="password-toggle" onclick="togglePassword('password_confirmation')">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>

            <button type="submit" class="auth-button">
                <i class="fas fa-user-plus"></i> Üye Ol
            </button>
        </form>

        <div class="auth-footer">
            <p>Zaten üye misiniz? <a href="{{ route('signin.form') }}">Giriş Yap</a></p>
        </div>
    </div>
</div>

<style>
    .auth-container {
        min-height: calc(100vh - 150px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        background: linear-gradient(135deg, var(--hawk-bg) 0%, var(--hawk-hover) 100%);
    }

    .auth-card {
        width: 100%;
        max-width: 450px;
        background: var(--hawk-card-bg);
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .auth-card:hover {
        transform: translateY(-5px);
    }

    .auth-header {
        background: linear-gradient(135deg, #6200ea, #b388ff);
        padding: 2rem;
        text-align: center;
        color: white;
    }

    .auth-header h2 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 600;
    }

    .auth-header p {
        margin: 0.5rem 0 0;
        opacity: 0.9;
    }

    .auth-form {
        padding: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .input-group {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-icon {
        position: absolute;
        left: 15px;
        color: var(--hawk-text-secondary);
    }

    .form-control {
        width: 100%;
        padding: 12px 20px 12px 45px;
        border: 2px solid var(--hawk-border);
        border-radius: 10px;
        background: var(--hawk-bg);
        color: var(--hawk-text);
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #6200ea;
        box-shadow: 0 0 0 3px rgba(98, 0, 234, 0.1);
    }

    .password-toggle {
        position: absolute;
        right: 15px;
        cursor: pointer;
        color: var(--hawk-text-secondary);
    }

    .auth-button {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #6200ea, #b388ff);
        border: none;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .auth-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(98, 0, 234, 0.3);
    }

    .auth-footer {
        text-align: center;
        padding: 1rem 2rem 2rem;
        color: var(--hawk-text-secondary);
    }

    .auth-footer a {
        color: #6200ea;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .auth-footer a:hover {
        color: #b388ff;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: block;
    }

    @media (max-width: 576px) {
        .auth-container {
            padding: 1rem;
        }

        .auth-card {
            border-radius: 10px;
        }

        .auth-header {
            padding: 1.5rem;
        }

        .auth-form {
            padding: 1.5rem;
        }
    }
</style>

<script>
function togglePassword(inputId) {
    const passwordInput = document.getElementById(inputId);
    const toggleIcon = passwordInput.nextElementSibling.querySelector('i');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>
@endsection
