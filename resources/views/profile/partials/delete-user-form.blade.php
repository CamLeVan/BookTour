<style>
    .delete-form {
        padding: 30px;
    }
    .delete-form header {
        margin-bottom: 30px;
    }
    .delete-form h2 {
        font-size: 20px;
        font-weight: 600;
        color: #DC2626;
        margin-bottom: 10px;
    }
    .delete-form p {
        color: #6B7280;
        font-size: 14px;
        line-height: 1.6;
    }
    .delete-button {
        background: #DC2626;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .delete-button:hover {
        background: #B91C1C;
        transform: translateY(-1px);
    }
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }
    .modal-content {
        background: white;
        border-radius: 8px;
        padding: 30px;
        max-width: 500px;
        width: 90%;
    }
    .modal-title {
        font-size: 18px;
        font-weight: 600;
        color: #DC2626;
        margin-bottom: 15px;
    }
    .modal-text {
        color: #6B7280;
        font-size: 14px;
        margin-bottom: 20px;
    }
    .form-group {
        margin-bottom: 25px;
    }
    .form-group input {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #E5E7EB;
        border-radius: 6px;
        font-size: 14px;
    }
    .modal-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }
    .cancel-button {
        background: #6B7280;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .cancel-button:hover {
        background: #4B5563;
    }
</style>

<section class="delete-form">
    <header>
        <h2>{{ __('Delete Account') }}</h2>
        <p>{{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}</p>
    </header>

    <button 
        type="button" 
        class="delete-button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="modal-title">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="modal-text">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="form-group">
                <input
                    type="password"
                    name="password"
                    placeholder="{{ __('Password') }}"
                    required
                />
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="modal-buttons">
                <button type="button" class="cancel-button" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </button>
                <button type="submit" class="delete-button">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
