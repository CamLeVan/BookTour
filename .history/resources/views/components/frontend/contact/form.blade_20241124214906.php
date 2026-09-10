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
    /* Contact Form Styling - giữ nguyên layout gốc */
.right-sidebar.item {
    background: #fff;
    padding: 30px;
    border-radius: 5px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
}

.right-sidebar.item h2 {
    font-size: 24px;
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 10px;
    color: #0f2454;
}

.right-sidebar.item h2:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 40px;
    height: 2px;
    background: #2095AE;
}

.contact__form .form-group {
    margin-bottom: 20px;
}

.contact__form input,
.contact__form textarea {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #eee;
    border-radius: 4px;
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

.contact__form textarea {
    min-height: 120px;
    resize: vertical;
}

.contact__form .text-danger {
    font-size: 12px;
    margin-top: 5px;
    display: block;
}

/* Giữ nguyên style button từ CSS gốc của bạn */
.contact__form .butn-dark {
    margin-top: 10px;
}

/* Responsive - giữ nguyên breakpoints của bạn */
@media (max-width: 991.98px) {
    .right-sidebar.item {
        padding: 25px;
    }
}
</style>