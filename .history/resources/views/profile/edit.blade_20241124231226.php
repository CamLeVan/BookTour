@extends('layouts.frontend')

@section('styles')
<style>
    /* CSS dành riêng cho trang profile */
    .profile-edit-page {
        padding: 120px 0;
        background: #f4f5f8;
    }
    
    .profile-edit-page .profile-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        padding: 30px;
        margin-bottom: 30px;
    }

    .profile-edit-page .card-header {
        background: none;
        padding: 0 0 20px 0;
        border-bottom: 1px solid rgba(15, 36, 84, 0.1);
    }

    .profile-edit-page .card-header h2 {
        color: #0f2454;
        font-size: 24px;
        font-weight: 600;
        margin: 0;
    }

    .profile-edit-page .form-group {
        margin-bottom: 25px;
    }

    .profile-edit-page .form-label {
        color: #0f2454;
        font-weight: 500;
        margin-bottom: 10px;
    }

    .profile-edit-page .form-control {
        height: auto;
        padding: 12px 20px;
        border: 1px solid rgba(15, 36, 84, 0.1);
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .profile-edit-page .form-control:focus {
        border-color: #2095AE;
        box-shadow: 0 0 0 2px rgba(32, 149, 174, 0.1);
    }

    .profile-edit-page .btn-primary {
        background: #2095AE;
        border: none;
        padding: 12px 30px;
        border-radius: 4px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .profile-edit-page .btn-primary:hover {
        background: #1a7a8f;
    }

    .profile-edit-page .btn-danger {
        background: #dc3545;
        border: none;
    }

    .profile-edit-page .btn-danger:hover {
        background: #bb2d3b;
    }

    .profile-edit-page .text-danger {
        color: #dc3545;
        font-size: 14px;
        margin-top: 5px;
    }

    .profile-edit-page .alert {
        padding: 15px 20px;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    .profile-edit-page .alert-success {
        background: rgba(32, 149, 174, 0.1);
        color: #2095AE;
        border: 1px solid rgba(32, 149, 174, 0.2);
    }

    .profile-edit-page .alert-danger {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border: 1px solid rgba(220, 53, 69, 0.2);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-edit-page {
            padding: 60px 0;
        }
        
        .profile-edit-page .profile-card {
            padding: 20px;
        }

        .profile-edit-page .card-header h2 {
            font-size: 20px;
        }
    }
</style>
@endsection

@section('content')
<div class="profile-edit-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Profile Information -->
                <div class="profile-card">
                    <div class="card-header">
                        <h2>{{ __('Profile Information') }}</h2>
                    </div>
                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- Update Password -->
                <div class="profile-card">
                    <div class="card-header">
                        <h2>{{ __('Update Password') }}</h2>
                    </div>
                    @include('profile.partials.update-password-form')
                </div>

                <!-- Delete Account -->
                <div class="profile-card">
                    <div class="card-header">
                        <h2>{{ __('Delete Account') }}</h2>
                    </div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
