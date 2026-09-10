@extends('layouts.frontend')

@section('styles')
<style>
    /* CSS dành riêng cho trang profile */
    .profile-edit-page {
        padding: 80px 0;
        background: #f4f5f8;
        min-height: 100vh;
    }
    
    .profile-edit-page .profile-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        padding: 40px;
        margin-bottom: 40px;
    }

    .profile-edit-page .card-header {
        background: none;
        padding: 0 0 20px 0;
        border-bottom: 1px solid rgba(15, 36, 84, 0.1);
        margin-bottom: 30px;
    }

    .profile-edit-page .card-header h2 {
        color: #0f2454;
        font-size: 24px;
        font-weight: 600;
        margin: 0;
        position: relative;
    }

    /* Form Elements */
    .profile-edit-page .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .profile-edit-page .form-label {
        color: #0f2454;
        font-weight: 500;
        margin-bottom: 12px;
        display: block;
        font-size: 15px;
    }

    .profile-edit-page .form-control {
        height: 50px;
        padding: 10px 20px;
        border: 1px solid #e9ecef;
        border-radius: 4px;
        transition: all 0.3s ease;
        font-size: 15px;
        width: 100%;
        color: #495057;
    }

    .profile-edit-page .form-control:focus {
        border-color: #2095AE;
        box-shadow: 0 0 0 3px rgba(32, 149, 174, 0.1);
        outline: none;
    }

    /* Buttons */
    .profile-edit-page .btn {
        height: 50px;
        line-height: 50px;
        padding: 0 35px;
        border: none;
        border-radius: 4px;
        font-weight: 500;
        font-size: 15px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .profile-edit-page .btn-primary {
        background: #2095AE;
        color: #fff;
    }

    .profile-edit-page .btn-primary:hover {
        background: #1a7a8f;
        transform: translateY(-1px);
    }

    .profile-edit-page .btn-danger {
        background: #dc3545;
        color: #fff;
    }

    .profile-edit-page .btn-danger:hover {
        background: #bb2d3b;
        transform: translateY(-1px);
    }

    /* Text & Alerts */
    .profile-edit-page .text-danger {
        color: #dc3545;
        font-size: 13px;
        margin-top: 8px;
        display: block;
    }

    .profile-edit-page p {
        color: #676977;
        font-size: 15px;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .profile-edit-page .alert {
        padding: 15px 20px;
        border-radius: 4px;
        margin-bottom: 25px;
        font-size: 14px;
        display: flex;
        align-items: center;
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

    /* Modal Styles */
    .profile-edit-page .modal-content {
        border-radius: 8px;
        border: none;
    }

    .profile-edit-page .modal-header {
        border-bottom: 1px solid rgba(15, 36, 84, 0.1);
        padding: 20px;
    }

    .profile-edit-page .modal-body {
        padding: 20px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-edit-page {
            padding: 40px 0;
        }
        
        .profile-edit-page .profile-card {
            padding: 25px;
            margin-bottom: 30px;
        }

        .profile-edit-page .card-header h2 {
            font-size: 20px;
        }

        .profile-edit-page .btn {
            width: 100%;
            margin-bottom: 10px;
        }
    }

    /* Additional Improvements */
    .profile-edit-page input:-webkit-autofill {
        -webkit-box-shadow: 0 0 0 30px white inset;
        -webkit-text-fill-color: #495057;
    }

    .profile-edit-page .form-control::placeholder {
        color: #adb5bd;
        opacity: 0.8;
    }

    .profile-edit-page .form-control:disabled {
        background-color: #f8f9fa;
        cursor: not-allowed;
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
