<div class="col-md-5 mb-30 offset-md-1">
    <div class="sidebar">
        <div class="right-sidebar">
            <div class="right-sidebar item">
                <h2>Gửi tin nhắn cho chúng tôi</h2>
                
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="" method="POST" class="right-sidebar item-form contact__form" id="contactForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="name" placeholder="Họ tên *" required>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="email" name="email" placeholder="Email *" required>
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="text" name="phone" placeholder="Số điện thoại *" required>
                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="text" name="subject" placeholder="Tiêu đề *" required>
                            @error('subject') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <textarea name="message" rows="4" placeholder="Nội dung *" required></textarea>
                            @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="butn-dark" id="submitBtn">
                                <span class="btn-text">Gửi tin nhắn</span>
                                <span class="btn-loading" style="display: none;">Đang gửi...</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    /* Input và Textarea styling */
.contact__form .form-group {
    margin-bottom: 20px;
    position: relative;
}

.contact__form input,
.contact__form textarea {
    width: 100%;
    padding: 14px 20px;
    background: #fff;
    border: 1px solid #e0e4e8;
    border-radius: 5px;
    font-size: 14px;
    color: #0f2454;
    transition: all 0.3s ease;
    font-family: 'Barlow', sans-serif;
}

/* Placeholder styling */
.contact__form input::placeholder,
.contact__form textarea::placeholder {
    color: #9ba3af;
    font-size: 14px;
    font-weight: 400;
    transition: all 0.3s ease;
}

/* Focus state */
.contact__form input:focus,
.contact__form textarea:focus {
    border-color: #2095AE;
    box-shadow: 0 0 0 3px rgba(32, 149, 174, 0.08);
    outline: none;
}

/* Hover state */
.contact__form input:hover,
.contact__form textarea:hover {
    border-color: #2095AE;
    background-color: #f8f9fa;
}

/* Textarea specific */
.contact__form textarea {
    min-height: 120px;
    resize: vertical;
    line-height: 1.6;
}

/* Error message */
.contact__form .text-danger {
    color: #dc3545;
    font-size: 12px;
    margin-top: 5px;
    padding-left: 3px;
    display: block;
    font-weight: 500;
}

/* Button container */
.contact__form .col-md-12 {
    text-align: center;
    margin-top: 10px;
}

/* Button styling */
.contact__form .butn-dark {
    position: relative;
    padding: 14px 35px;
    background: #2095AE;
    color: #fff;
    font-size: 15px;
    font-weight: 500;
    letter-spacing: 0.5px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    overflow: hidden;
    transition: all 0.3s ease;
    display: inline-block;
    min-width: 180px;
}

/* Button hover effect */
.contact__form .butn-dark:hover {
    background: #1a7a8e;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(32, 149, 174, 0.2);
}

/* Button active state */
.contact__form .butn-dark:active {
    transform: translateY(0);
    box-shadow: 0 2px 10px rgba(32, 149, 174, 0.1);
}

/* Responsive */
@media (max-width: 767px) {
    .contact__form input,
    .contact__form textarea {
        padding: 12px 15px;
        font-size: 14px;
    }
    
    .contact__form .form-group {
        margin-bottom: 15px;
    }
    
    .contact__form .butn-dark {
        padding: 12px 25px;
        font-size: 14px;
        min-width: 160px;
    }
}

/* Thêm style mới cho Alert */
.right-sidebar.item .alert {
    padding: 15px;
    border-radius: 5px;
    margin: 15px 0;
    font-size: 14px;
    position: relative;
    animation: fadeIn 0.5s ease;
}

.right-sidebar.item .alert-success {
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}

.right-sidebar.item .alert-danger {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Button States */
.contact__form .butn-dark:disabled {
    background: #94c4cd;
    cursor: not-allowed;
    transform: none !important;
    box-shadow: none;
}

/* Loading Text */
.contact__form .butn-dark span[wire\:loading] {
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

/* Error Message Animation */
.contact__form .text-danger {
    animation: fadeIn 0.3s ease;
}

/* Responsive */
@media (max-width: 767px) {
    .contact__form input,
    .contact__form textarea {
        padding: 12px 15px;
        font-size: 14px;
    }
    
    .contact__form .form-group {
        margin-bottom: 15px;
    }
    
    .contact__form .butn-dark {
        padding: 12px 25px;
        font-size: 14px;
        min-width: 160px;
    }

    .right-sidebar.item .alert {
        padding: 12px;
        font-size: 13px;
        margin: 10px 0;
    }
}
</style>