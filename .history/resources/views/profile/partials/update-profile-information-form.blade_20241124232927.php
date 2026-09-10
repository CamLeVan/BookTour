<style>
    .profile-info {
        padding: 20px;
    }
    .profile-info h2 {
        font-size: 24px;
        color: #333;
        margin-bottom: 10px;
    }
    .profile-info p {
        color: #666;
        font-size: 14px;
        margin-bottom: 20px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        margin-bottom: 5px;
        color: #333;
        font-weight: 500;
    }
    .form-group input {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .form-group input:focus {
        border-color: #2095AE;
        outline: none;
    }
    .btn-save {
        background: #2095AE;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .btn-save:hover {
        background: #1b7d8f;
    }
    .text-danger {
        color: #dc3545;
        font-size: 13px;
        margin-top: 5px;
    }
</style>

<section class="profile-info">
    <header>
        <h2>{{ __('Profile Information') }}</h2>
        <p>{{ __("Update your account's profile information and email address.") }}</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn-save">{{ __('Save') }}</button>
    </form>
</section>
