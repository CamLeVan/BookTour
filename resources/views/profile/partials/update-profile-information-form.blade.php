<style>
    .profile-info-form {
        padding: 30px;
    }
    .profile-info-form header {
        margin-bottom: 30px;
    }
    .profile-info-form h2 {
        font-size: 20px;
        font-weight: 600;
        color: #2095AE;
        margin-bottom: 10px;
    }
    .profile-info-form p {
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
    .save-button {
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
    .save-button:hover {
        background: #1A7A8F;
        transform: translateY(-1px);
    }
    .success-message {
        color: #059669;
        font-size: 14px;
        margin-left: 12px;
    }
</style>

<section class="profile-info-form">
    <header>
        <h2 id="profile-info-heading">{{ __('Profile Information') }}</h2>
        <p>{{ __("Update your account's profile information and email address.") }}</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" aria-labelledby="profile-info-heading">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ old('name', $user->name) }}" 
                required 
                autocomplete="name"
                aria-required="true"
            >
            @error('name')
                <span class="text-danger" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                value="{{ old('email', $user->email) }}" 
                required 
                autocomplete="email"
                aria-required="true"
            >
            @error('email')
                <span class="text-danger" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center">
            <button type="submit" class="save-button">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <span class="success-message" role="status">{{ __('Saved.') }}</span>
            @endif
        </div>
    </form>
</section>
