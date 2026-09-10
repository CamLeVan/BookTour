<div class="col-md-5 mb-30 offset-md-1">
    <div class="sidebar">
        <div class="right-sidebar">
            <div class="right-sidebar item">
                <h2>Gửi tin nhắn cho chúng tôi</h2>
                <form wire:submit.prevent="submitForm" class="right-sidebar item-form contact__form">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input wire:model="name" type="text" placeholder="Họ tên *" required>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <input wire:model="email" type="email" placeholder="Email *" required>
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <input wire:model="phone" type="text" placeholder="Số điện thoại *" required>
                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <input wire:model="subject" type="text" placeholder="Tiêu đề *" required>
                            @error('subject') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <textarea wire:model="message" rows="4" placeholder="Nội dung *" required></textarea>
                            @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="butn-dark">
                                <span>Gửi tin nhắn</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 
<style>
    /* Button container */
.contact__form .col-md-12 {
    text-align: center;  /* Căn giữa container */
}

/* Button styling */
.contact__form .butn-dark {
    position: relative;
    padding: 12px 35px;
    background: #2095AE;
    color: #fff;
    font-size: 15px;
    font-weight: 500;
    letter-spacing: 1px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(32, 149, 174, 0.2);
    display: inline-block; /* Cho phép margin auto hoạt động */
    margin: 0 auto;  /* Căn giữa button */
    min-width: 200px; /* Đặt chiều rộng tối thiểu */
}

/* Các hiệu ứng khác giữ nguyên */
.contact__form .butn-dark:hover {
    background: #1a7a8e;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(32, 149, 174, 0.3);
}

.contact__form .butn-dark:active {
    transform: translateY(0);
    box-shadow: 0 2px 10px rgba(32, 149, 174, 0.2);
}

/* Responsive */
@media (max-width: 767px) {
    .contact__form .butn-dark {
        min-width: 180px; /* Giảm chiều rộng tối thiểu trên mobile */
        padding: 10px 30px;
        font-size: 14px;
    }
}
/* Input và Textarea styling */
.contact__form .form-group {
    margin-bottom: 20px;
    position: relative;
}

.contact__form input,
.contact__form textarea {
    width: 100%;
    padding: 15px 20px;
    background: #fff;
    border: 1px solid #eef0f6;
    border-radius: 5px;
    font-size: 14px;
    color: #0f2454;
    transition: all 0.3s ease;
}

/* Placeholder styling */
.contact__form input::placeholder,
.contact__form textarea::placeholder {
    color: #8e9aab;
    font-size: 14px;
    font-weight: 400;
}

/* Focus state */
.contact__form input:focus,
.contact__form textarea:focus {
    border-color: #2095AE;
    box-shadow: 0 0 0 3px rgba(32, 149, 174, 0.1);
    outline: none;
}

/* Hover state */
.contact__form input:hover,
.contact__form textarea:hover {
    border-color: #2095AE;
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
    display: block;
}

/* Required field */
.contact__form input:required,
.contact__form textarea:required {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8' viewBox='0 0 8 8'%3E%3Cpath fill='%23dc3545' d='M0 0h8v8h-8z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 8px center;
    background-size: 8px 8px;
}

/* Responsive */
@media (max-width: 767px) {
    .contact__form input,
    .contact__form textarea {
        padding: 12px 15px;
        font-size: 13px;
    }
    
    .contact__form .form-group {
        margin-bottom: 15px;
    }
}

/* Success state */
.contact__form input.is-valid,
.contact__form textarea.is-valid {
    border-color: #28a745;
    background-color: #fff;
}

/* Error state */
.contact__form input.is-invalid,
.contact__form textarea.is-invalid {
    border-color: #dc3545;
    background-color: #fff;
}

/* Disabled state */
.contact__form input:disabled,
.contact__form textarea:disabled {
    background-color: #e9ecef;
    cursor: not-allowed;
}

/* Focus within animation */
.contact__form .form-group:focus-within {
    transform: translateY(-1px);
}
</style>