<style>
    .account-delete {
        padding: 20px;
    }
    .account-delete h2 {
        font-size: 24px;
        color: #dc3545;
        margin-bottom: 10px;
    }
    .account-delete p {
        color: #666;
        font-size: 14px;
        margin-bottom: 20px;
    }
    .btn-delete {
        background: #dc3545;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .btn-delete:hover {
        background: #bb2d3b;
    }
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
    }
    .modal-content {
        background: white;
        padding: 20px;
        border-radius: 8px;
        max-width: 500px;
        margin: 50px auto;
    }
    .btn-cancel {
        background: #6c757d;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-right: 10px;
    }
    .btn-cancel:hover {
        background: #5a6268;
    }
</style>

<section class="account-delete">
    <header>
        <h2>{{ __('Delete Account') }}</h2>
        <p>{{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}</p>
    </header>

    <button type="button" class="btn-delete" onclick="document.getElementById('deleteModal').style.display='block'">
        {{ __('Delete Account') }}
    </button>

    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <h3>{{ __('Are you sure you want to delete your account?') }}</h3>
                <p>{{ __('Please enter your password to confirm.') }}</p>

                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input type="password" id="password" name="password" required>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <button type="button" class="btn-cancel" onclick="document.getElementById('deleteModal').style.display='none'">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" class="btn-delete">
                        {{ __('Delete Account') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
