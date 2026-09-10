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
    /* Contact Form Styling */
.right-sidebar {
    background: #fff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 5px 30px rgba(0, 0, 0, 0.05);
}

.right-sidebar h2 {
    font-size: 28px;
    margin-bottom: 30px;
    position: relative;
    padding-bottom: 15px;
}

.right-sidebar h2:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 50px;
    height: 2px;
    background: #2095AE;
}

.contact__form .form-group {
    margin-bottom: 20px;
    position: relative;
}

.contact__form input,
.contact__form textarea {
    width: 100%;
    padding: 15px 20px;
    border: 1px solid #eee;
    border-radius: 5px;
    font-size: 14px;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.contact__form input:focus,
.contact__form textarea:focus {
    border-color: #2095AE;
    box-shadow: 0 0 0 3px rgba(32, 149, 174, 0.1);
    outline: none;
}

.contact__form input::placeholder,
.contact__form textarea::placeholder {
    color: #999;
    font-size: 14px;
}

.contact__form textarea {
    min-height: 120px;
    resize: vertical;
}

/* Error message styling */
.contact__form .text-danger {
    font-size: 12px;
    margin-top: 5px;
    display: block;
    color: #dc3545;
}

/* Submit button styling */
.contact__form .butn-dark {
    width: 100%;
    padding: 15px 25px;
    background: #2095AE;
    border: none;
    border-radius: 5px;
    color: #fff;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
}

.contact__form .butn-dark:hover {
    background: #1a7a8e;
    transform: translateY(-2px);
}

.contact__form .butn-dark:active {
    transform: translateY(0);
}

/* Loading state for button */
.contact__form button[type="submit"]:disabled {
    background: #ccc;
    cursor: not-allowed;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .right-sidebar {
        padding: 25px;
    }
    
    .right-sidebar h2 {
        font-size: 24px;
    }
    
    .contact__form input,
    .contact__form textarea {
        padding: 12px 15px;
    }
}

/* Input focus animation */
.contact__form .form-group input:focus + label,
.contact__form .form-group textarea:focus + label {
    transform: translateY(-20px);
    font-size: 12px;
    color: #2095AE;
}

/* Success message animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.contact__form .success-message {
    animation: fadeIn 0.5s ease forwards;
    color: #28a745;
    padding: 10px;
    border-radius: 5px;
    margin-top: 15px;
    text-align: center;
}

/* Hover effect for inputs */
.contact__form input:hover,
.contact__form textarea:hover {
    background: #fff;
    border-color: #2095AE;
}
</style>