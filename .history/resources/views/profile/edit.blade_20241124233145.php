@extends('layouts.frontend')

@section('styles')
<style>
    .profile-section {
        padding: 60px 0;
        background: #f8f9fa;
        min-height: 100vh;
    }

    .profile-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        overflow: hidden;
    }

    @media (max-width: 768px) {
        .profile-section {
            padding: 30px 0;
        }
        
        .profile-card {
            margin-bottom: 20px;
        }
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
