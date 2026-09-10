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
    /* Container Form */
.right-sidebar.item {
    background: #fff;
    padding: 35px;
    border-radius: 8px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
}

/* Tiêu đề Form */
.right-sidebar.item h2 {
    font-size: 24px;
    color: #0f2454;
    margin-bottom: 30px;
    text-align: center;
    position: relative;
    padding-bottom: 15px;
}

.right-sidebar.item h2:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 50px;
    height: 2px;
    background: #2095AE;
}

/* Form Group Container */
.contact__form .form-group {
    margin-bottom: 20px;
    position: relative;
}

/* Input và Textarea */
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

/* Placeholder */
.contact__form input::placeholder,
.contact__form textarea::placeholder {
    color: #9ba3af;
    font-size: 14px;
    font-weight: 400;
    transition: all 0.3s ease;
}

/* Focus States */
.contact__form input:focus,
.contact__form textarea:focus {
    border-color: #2095AE;
    box-shadow: 0 0 0 3px rgba(32, 149, 174, 0.08);
    outline: none;
}

.contact__form input:focus::placeholder,
.contact__form textarea:focus::placeholder {
    opacity: 0.7;
    transform: translateX(5px);
}

/* Hover States */
.contact__form input:hover,
.contact__form textarea:hover {
    border-color: #2095AE;
    background-color: #f8f9fa;
}

/* Textarea */
.contact__form textarea {
    min-height: 120px;
    resize: vertical;
    line-height: 1.6;
}

/* Error Messages */
.contact__form .text-danger {
    color: #dc3545;
    font-size: 12px;
    margin-top: 5px;
    padding-left: 3px;
    display: block;
    font-weight: 500;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-5px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Button Container */
.contact__form .col-md-12 {
    text-align: center;
    margin-top: 10px;
}

/* Submit Button */
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

/* Button Hover Effect */
.contact__form .butn-dark:hover {
    background: #1a7a8e;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(32, 149, 174, 0.2);
}

/* Button Active State */
.contact__form .butn-dark:active {
    transform: translateY(0);
    box-shadow: 0 2px 10px rgba(32, 149, 174, 0.1);
}

/* Button Loading State */
.contact__form .butn-dark:disabled {
    background: #ccc;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

/* Responsive Design */
@media (max-width: 767px) {
    .right-sidebar.item {
        padding: 25px;
    }

    .right-sidebar.item h2 {
        font-size: 20px;
        margin-bottom: 25px;
    }

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

/* Row Spacing */
.contact__form .row {
    margin: 0 -10px;
}

.contact__form [class*="col-"] {
    padding: 0 10px;
}
</style>