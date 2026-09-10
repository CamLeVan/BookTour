<div class="col-md-6 mb-60">
    <h3>HC Travel</h3>
    <p>Chúng tôi luôn sẵn sàng hỗ trợ và giải đáp mọi thắc mắc của bạn 24/7</p>
    
    <div class="phone-call mb-30">
        <div class="icon"><span class="flaticon-phone-call"></span></div>
        <div class="text">
            <p>Điện thoại</p>
            <a href="tel:0123456789">0123 456 789</a>
        </div>
    </div>

    <div class="phone-call mb-30">
        <div class="icon"><span class="flaticon-message"></span></div>
        <div class="text">
            <p>Email</p>
            <a href="mailto:info@hctravel.com">info@hctravel.com</a>
        </div>
    </div>

    <div class="phone-call">
        <div class="icon"><span class="flaticon-placeholder"></span></div>
        <div class="text">
            <p>Địa chỉ</p>
            470 Trần Đại Nghĩa<br>
            Đà Nẵng, Việt Nam
        </div>
    </div>
</div> 
<style>
    /* Contact Info Styling */
.col-md-6.mb-60 {
    padding: 30px;
}

/* Heading styles */
.col-md-6.mb-60 h3 {
    font-size: 28px;
    color: #0f2454;
    margin-bottom: 15px;
    font-weight: 600;
}

/* Description text */
.col-md-6.mb-60 > p {
    font-size: 15px;
    color: #676977;
    margin-bottom: 30px;
    line-height: 1.7;
}

/* Contact item container */
.phone-call {
    display: flex;
    align-items: flex-start;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    transition: all 0.3s ease;
    border: 1px solid #eef0f6;
}

.phone-call:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    border-color: #2095AE;
}

/* Icon styling */
.phone-call .icon {
    margin-right: 20px;
    min-width: 45px;
    height: 45px;
    background: rgba(32, 149, 174, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #2095AE;
    font-size: 20px;
}

.phone-call .icon span {
    transition: all 0.3s ease;
}

.phone-call:hover .icon {
    background: #2095AE;
    color: #fff;
}

/* Text content */
.phone-call .text {
    flex: 1;
}

.phone-call .text p {
    font-size: 14px;
    color: #676977;
    margin-bottom: 5px;
}

.phone-call .text a {
    font-size: 16px;
    color: #0f2454;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
}

.phone-call .text a:hover {
    color: #2095AE;
}

/* Margin bottom for spacing */
.mb-30 {
    margin-bottom: 20px;
}

/* Responsive adjustments */
@media (max-width: 767px) {
    .col-md-6.mb-60 {
        padding: 20px;
    }

    .col-md-6.mb-60 h3 {
        font-size: 24px;
    }

    .phone-call {
        padding: 15px;
    }

    .phone-call .icon {
        min-width: 40px;
        height: 40px;
        font-size: 18px;
    }
}
</style>