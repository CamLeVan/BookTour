<style>
    .password-form {
        padding: 30px;
    }
    .password-form header {
        margin-bottom: 30px;
    }
    .password-form h2 {
        font-size: 20px;
        font-weight: 600;
        color: #2095AE;
        margin-bottom: 10px;
    }
    .password-form p {
        color: #6B7280;
        font-size: 14px;
        line-height: 1.6;
    }
    .form-group {
        margin-bottom: 25px;
    }
    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: #374151;
        margin-bottom: 8px;
    }
    .form-group input {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #E5E7EB;
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    .form-group input:focus {
        border-color: #2095AE;
        box-shadow: 0 0 0 3px rgba(32, 149, 174, 0.1);
        outline: none;
    }
    .form-group .text-danger {
        color: #DC2626;
        font-size: 13px;
        margin-top: 6px;
    }
    .update-button {
        background: #2095AE;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .update-button:hover {
        background: #1A7A8F;
        transform: translateY(-1px);
    }
    .success-message {
        color: #059669;
        font-size: 14px;
        margin-left: 12px;
    }
</style>

<section class="password-form">
    <header>
        <h2>{{ __('Update Password') }}</h2>
        <p>{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="current_password">{{ __('Current Password') }}</label>
            <input 
                type="password" 
                id="current_password" 
                name="current_password" 
                required 
                autocomplete="current-password"
            >
            @error('current_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">{{ __('New Password') }}</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                required 
                autocomplete="new-password"
            >
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            <input 
                type="password" 
                id="password_confirmation" 
                name="password_confirmation" 
                required 
                autocomplete="new-password"
            >
        </div>

        <div class="flex items-center">
            <button type="submit" class="update-button">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <span class="success-message">{{ __('Saved.') }}</span>
            @endif
        </div>
    </form>
</section>
