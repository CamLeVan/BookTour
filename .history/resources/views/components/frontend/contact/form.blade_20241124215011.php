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
