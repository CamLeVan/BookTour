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
}

/* Hover effect */
.contact__form .butn-dark:hover {
    background: #1a7a8e;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(32, 149, 174, 0.3);
}

/* Active/Click effect */
.contact__form .butn-dark:active {
    transform: translateY(0);
    box-shadow: 0 2px 10px rgba(32, 149, 174, 0.2);
}

/* Button text */
.contact__form .butn-dark span {
    position: relative;
    z-index: 2;
    display: inline-block;
    transition: all 0.3s ease;
}

/* Loading state */
.contact__form .butn-dark:disabled {
    background: #cccccc;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

/* Ripple effect */
.contact__form .butn-dark::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: width 0.3s ease-out, height 0.3s ease-out;
}

.contact__form .butn-dark:hover::after {
    width: 110%;
    height: 110%;
}

/* Media query for mobile */
@media (max-width: 767px) {
    .contact__form .butn-dark {
        padding: 10px 30px;
        font-size: 14px;
    }
}
</style>