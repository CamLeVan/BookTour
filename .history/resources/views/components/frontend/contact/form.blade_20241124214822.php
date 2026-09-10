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
    /* Điều chỉnh layout tổng thể */
.col-md-5.mb-30.offset-md-1 {
    width: 100%;
    max-width: 100%;
    margin-left: 0;
    padding: 0 15px;
}

.sidebar {
    width: 100%;
    max-width: 1200px; /* hoặc width phù hợp với design của bạn */
    margin: 0 auto;
}

.right-sidebar {
    background: #fff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 5px 30px rgba(0, 0, 0, 0.05);
    width: 100%;
}

/* Điều chỉnh grid layout */
.contact__form .row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -15px;
}

.contact__form .col-md-6 {
    flex: 0 0 50%;
    max-width: 50%;
    padding: 0 15px;
}

.contact__form .col-md-12 {
    flex: 0 0 100%;
    max-width: 100%;
    padding: 0 15px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .right-sidebar {
        padding: 25px;
    }
    
    .contact__form .col-md-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }
    
    .contact__form input,
    .contact__form textarea {
        margin-bottom: 15px;
    }
}

/* Điều chỉnh khoảng cách các phần tử */
.right-sidebar h2 {
    width: 100%;
    text-align: center;
    margin-bottom: 40px;
}

.right-sidebar h2:after {
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
}

.contact__form .form-group {
    margin-bottom: 25px;
}

/* Tăng kích thước input và textarea */
.contact__form input,
.contact__form textarea {
    width: 100%;
    padding: 18px 25px;
    font-size: 16px;
}

.contact__form textarea {
    min-height: 150px;
}

/* Điều chỉnh nút submit */
.contact__form .butn-dark {
    width: auto;
    min-width: 200px;
    margin: 20px auto 0;
    display: block;
    padding: 18px 35px;
}

/* Thêm spacing cho error messages */
.contact__form .text-danger {
    margin-top: 8px;
    margin-bottom: 5px;
}

/* Container cho form */
.contact__form {
    max-width: 100%;
    margin: 0 auto;
}

/* Thêm hiệu ứng hover cho form */
.right-sidebar:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease;
    box-shadow: 0 8px 35px rgba(0, 0, 0, 0.1);
}
</style>