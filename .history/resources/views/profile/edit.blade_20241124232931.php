@extends('layouts.frontend')

@section('styles')
<style>
    /* Profile Page Styling */
    .profile-section {
        padding: 40px 0;
        background: #f8f9fa;
    }

    .profile-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
        padding: 30px;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    }

    /* Header Styling */
    .profile-header {
        margin-bottom: 25px;
        border-bottom: 2px solid #f1f1f1;
        padding-bottom: 15px;
    }

    .profile-header h2 {
        color: #2095AE;
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .profile-header p {
        color: #6c757d;
        font-size: 14px;
        line-height: 1.6;
    }

    /* Form Styling */
    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #344767;
        font-weight: 500;
        font-size: 15px;
    }

    .form-control {
        height: 45px;
        padding: 10px 15px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: #2095AE;
        box-shadow: 0 0 0 3px rgba(32, 149, 174, 0.1);
    }

    /* Button Styling */
    .btn {
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s;
        border: none;
    }

    .btn-primary {
        background: #2095AE;
        color: #fff;
    }

    .btn-primary:hover {
        background: #1a7a8f;
        transform: translateY(-2px);
    }

    .btn-danger {
        background: #dc3545;
        color: #fff;
    }

    .btn-danger:hover {
        background: #bb2d3b;
        transform: translateY(-2px);
    }

    .btn-secondary {
        background: #6c757d;
        color: #fff;
    }

    .btn-secondary:hover {
        background: #5a6268;
    }

    /* Alert Messages */
    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .alert-success {
        background: rgba(32, 149, 174, 0.1);
        color: #2095AE;
        border: 1px solid rgba(32, 149, 174, 0.2);
    }

    .alert-danger {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border: 1px solid rgba(220, 53, 69, 0.2);
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    }

    .modal-header {
        border-bottom: 2px solid #f1f1f1;
        padding: 20px 25px;
    }

    .modal-body {
        padding: 25px;
    }

    .modal-footer {
        border-top: 2px solid #f1f1f1;
        padding: 20px 25px;
    }

    /* Error Messages */
    .text-danger {
        color: #dc3545;
        font-size: 13px;
        margin-top: 5px;
        display: block;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .profile-section {
            padding: 20px 0;
        }

        .profile-card {
            padding: 20px;
            margin-bottom: 20px;
        }

        .profile-header h2 {
            font-size: 20px;
        }

        .btn {
            width: 100%;
            margin-bottom: 10px;
        }
    }

    /* Animation Effects */
    .fade-enter {
        opacity: 0;
        transform: translateY(10px);
    }

    .fade-enter-active {
        opacity: 1;
        transform: translateY(0);
        transition: opacity 300ms, transform 300ms;
    }

    /* Custom Scrollbar */
    .modal-body::-webkit-scrollbar {
        width: 8px;
    }

    .modal-body::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .modal-body::-webkit-scrollbar-thumb {
        background: #2095AE;
        border-radius: 4px;
    }

    .modal-body::-webkit-scrollbar-thumb:hover {
        background: #1a7a8f;
    }
</style>
@endsection

@section('content')
<div class="profile-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Profile Information -->
                <div class="profile-card">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- Update Password -->
                <div class="profile-card">
                    @include('profile.partials.update-password-form')
                </div>

                <!-- Delete Account -->
                <div class="profile-card">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
