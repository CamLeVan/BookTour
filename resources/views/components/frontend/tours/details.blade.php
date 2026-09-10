@props(['tour'])


<section class="tour-page section-padding" data-scroll-index="1">
   <div class="container">
       <div class="row">
           {{-- Cột thông tin tour bên trái --}}
           <div class="col-md-8 mb-30">
               <div class="section-subtitle">{{ $tour->destination->name }}</div>
               <div class="section-title mb-0">{{ $tour->name }}</div>


               <div class="rating mb-30">
                   @for ($i = 1; $i <= 5; $i++)
                       <i class="star {{ $i <= $tour->rating ? 'active' : '' }}"></i>
                   @endfor
                   <div class="reviews-count color-2">({{ $tour->reviews_count ?? count($tour->reviews) }} Đánh giá)</div>
               </div>


               <div class="tour-page head-icon">
                   <p><i class="ti-time"></i> {{ $tour->duration }} Days</p>
                   <p><i class="ti-user"></i> Group: {{ $tour->max_people }} People</p>
                   <p><i class="ti-location-pin"></i> {{ $tour->destination->name }}</p>
                   <p><i class="ti-face-smile"></i> {{ number_format($tour->rating, 1) }} Rating</p>
               </div>


               <h6>Information</h6>
               <p class="mb-30">{{ $tour->description }}</p>


               {{-- Tour Schedule --}}
               <h6>Tour Plan</h6>
               @php
                   if (!$tour->relationLoaded('schedules')) {
                       $tour->load('schedules');
                   }
               @endphp
               <ul class="accordion-box clearfix">
                   @forelse ($tour->schedules as $schedule)
                       <li>
                           <details>
                               <summary>
                                   Day {{ $schedule->day }}: {{ $schedule->title }}
                               </summary>
                               <div class="content">
                                   <div class="timeline">
                                       @php
                                           $timelineItems = preg_split(
                                               '/(\d{1,2}:\d{2}:)/',
                                               $schedule->description,
                                               -1,
                                               PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY,
                                           );
                                           $items = [];


                                           for ($i = 0; $i < count($timelineItems) - 1; $i += 2) {
                                               $time = trim(rtrim($timelineItems[$i], ':'));
                                               $content = trim($timelineItems[$i + 1]);
                                               if ($time && $content) {
                                                   $items[] = [
                                                       'time' => $time,
                                                       'content' => $content,
                                                   ];
                                               }
                                           }
                                       @endphp
                                       @foreach ($items as $item)
                                           <div class="timeline-item">
                                               <span class="time">{{ $item['time'] }}</span>
                                               <div class="timeline-content">
                                                   {{ $item['content'] }}
                                               </div>
                                           </div>
                                       @endforeach
                                   </div>
                               </div>
                           </details>
                       </li>
                   @empty
                       <li class="p-3">Chưa có lịch trình cho tour này. Vui lòng liên hệ với chúng tôi để biết thêm
                           chi tiết.</li>
                   @endforelse
               </ul>
           </div>


           {{-- Cột đặt tour bên phải --}}
           <div class="col-md-4">
               <div class="sidebar">
                   <div class="booking-card">
                       <div class="price-header">
                           <span class="label">Giá từ</span>
                           @if ($tour->price < $tour->price * 1.2)
                               <span class="original-price">{{ number_format($tour->price * 1.2) }} VND</span>
                           @endif
                           <span class="current-price">{{ number_format($tour->price) }} VND</span>
                           <span class="per-person">/người</span>
                       </div>


                       <div class="tour-highlights">
                           <div class="highlight-item">
                               <i class="ti-calendar"></i>
                               <span>{{ $tour->duration }} ngày</span>
                           </div>
                           <div class="highlight-item">
                               <i class="ti-user"></i>
                               <span>Còn {{ $tour->available_slots }} chỗ</span>
                           </div>
                       </div>


                       @auth
                           <a href="{{ route('frontend.bookings.create', $tour) }}" class="butn-dark w-100">
                               <span>Đặt Tour Ngay</span>
                           </a>
                       @else
                       <a href="#loginModal" 
                       class="butn-dark w-100" 
                       data-bs-toggle="modal">
                        <span>Đăng nhập để đặt tour</span>
                    </a>
                    
                       @endauth
                   </div>
               </div>
           </div>
       </div>
   </div>
</section>


<!-- Login Modal -->
<div class="modal fade auth-modal" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Welcome Back! 👋</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <!-- Error Message -->
                    <div class="alert alert-danger error-message" style="display: none;"></div>
                    
                    <p class="text-muted mb-4">Vui lòng đăng nhập để tiếp tục</p>

                    <!-- Email Input -->
                    <div class="form-group custom-input-group mb-3">
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" 
                                   class="form-control" 
                                   id="email" 
                                   name="email" 
                                   placeholder="Email của bạn"
                                   required>
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="form-group custom-input-group mb-4">
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" 
                                   class="form-control" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Mật khẩu"
                                   required>
                        </div>
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                            <label class="form-check-label" for="remember_me">Ghi nhớ đăng nhập</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="#" 
                               class="forgot-link"
                               data-bs-toggle="modal" 
                               data-bs-target="#forgotPasswordModal" 
                               onclick="$('#loginModal').modal('hide')">
                                Quên mật khẩu?
                            </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="btn btn-primary w-100 login-btn">
                        <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                        <span class="btn-text">Đăng nhập</span>
                    </button>

                    <!-- Register Link -->
                    <div class="text-center mt-4">
                        <p class="mb-0">Chưa có tài khoản? 
                            <a href="#" 
                               class="register-link"
                               data-bs-toggle="modal" 
                               data-bs-target="#registerModal">
                                Đăng ký ngay
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
   details {
       border: 1px solid #ddd;
       border-radius: 8px;
       margin-bottom: 10px;
       background: #fff;
       padding: 0;
       transition: all 0.3s ease;
   }


   details summary {
       list-style: none;
       font-weight: 500;
       padding: 15px;
       background: #f8f9fa;
       border-radius: 8px;
       cursor: pointer;
       display: flex;
       justify-content: space-between;
       align-items: center;
       transition: all 0.3s ease;
   }


   details summary:hover {
       background: #aa8453;
       /* Thay đổi màu nền khi hover */
       color: white;
       /* Thay đổi màu chữ khi hover */
       border: 1px solid #aa8453;
       /* Thêm viền khi hover */
       border-radius: 8px;
       box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
       /* Tạo hiệu ứng bóng mờ */
   }


   details[open] summary {
       background: #aa8453;
       color: white;
       border: 1px solid #aa8453;
   }


   details .content {
       max-height: 0;
       /* Bắt đầu ở trạng thái ẩn */
       overflow: hidden;
       /* Ẩn nội dung khi chưa mở */
       transition: max-height 0.5s ease;
       /* Tạo hiệu ứng mượt */
       padding: 0 15px;
   }


   details[open] .content {
       max-height: 500px;
       /* Chiều cao tối đa khi mở (tùy chỉnh) */
       padding: 15px 20px;
       border-top: 1px solid #ddd;
       background: #f9f9f9;
       border-radius: 0 0 8px 8px;
   }


   /* Card Booking */
   .booking-card {
       background: white;
       border-radius: 20px;
       box-shadow: 0 10px 40px rgba(170, 132, 83, 0.1);
       padding: 35px;
       transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
       border: 1px solid rgba(170, 132, 83, 0.1);
   }


   .booking-card:hover {
       transform: translateY(-8px);
       box-shadow: 0 15px 50px rgba(170, 132, 83, 0.15);
   }


   /* Price Header */
   .price-header {
       text-align: center;
       margin-bottom: 30px;
       padding-bottom: 25px;
       border-bottom: 2px solid rgba(170, 132, 83, 0.1);
       position: relative;
   }


   .price-header:after {
       content: '';
       position: absolute;
       bottom: -2px;
       left: 50%;
       transform: translateX(-50%);
       width: 50px;
       height: 2px;
       background: #aa8453;
   }


   .price-header .label {
       display: inline-block;
       color: #666;
       font-size: 0.95em;
       margin-bottom: 10px;
       background: rgba(170, 132, 83, 0.1);
       padding: 5px 15px;
       border-radius: 20px;
   }


   .original-price {
       color: #999;
       text-decoration: line-through;
       font-size: 1.2em;
       margin-right: 12px;
       opacity: 0.7;
   }


   .current-price {
       color: #aa8453;
       font-size: 2.5em;
       font-weight: 700;
       letter-spacing: -1px;
       text-shadow: 2px 2px 0px rgba(170, 132, 83, 0.1);
   }


   .per-person {
       color: #666;
       font-size: 1em;
       font-weight: 500;
   }


   /* Tour Highlights */
   .tour-highlights {
       margin: 25px 0;
       padding: 25px 0;
       border-bottom: 2px solid rgba(170, 132, 83, 0.1);
   }


   .highlight-item {
       display: flex;
       align-items: center;
       margin-bottom: 18px;
       padding: 15px 20px;
       background: rgba(170, 132, 83, 0.03);
       border-radius: 12px;
       transition: all 0.3s ease;
       border: 1px solid rgba(170, 132, 83, 0.08);
   }


   .highlight-item:last-child {
       margin-bottom: 0;
   }


   .highlight-item:hover {
       background: rgba(170, 132, 83, 0.08);
       transform: translateX(8px);
       border-color: rgba(170, 132, 83, 0.15);
   }


   .highlight-item i {
       color: #aa8453;
       margin-right: 15px;
       font-size: 1.3em;
       transition: all 0.3s ease;
   }


   .highlight-item:hover i {
       transform: scale(1.2);
   }


   .highlight-item span {
       color: #444;
       font-weight: 500;
       font-size: 1.05em;
   }


   /* Button Styles */
   .butn-dark {
       display: inline-block;
       text-align: center;
       padding: 18px 30px;
       border-radius: 12px;
       background: linear-gradient(45deg, #aa8453, #c69c6d);
       color: white;
       font-weight: 600;
       text-transform: uppercase;
       letter-spacing: 1.5px;
       transition: all 0.4s ease;
       border: none;
       width: 100%;
       margin-top: 25px;
       position: relative;
       overflow: hidden;
       box-shadow: 0 5px 20px rgba(170, 132, 83, 0.3);
   }


   .butn-dark:hover {
       background: linear-gradient(45deg, #c69c6d, #aa8453);
       transform: translateY(-3px);
       box-shadow: 0 8px 25px rgba(170, 132, 83, 0.4);
       color: white;
   }


   .butn-dark span {
       position: relative;
       z-index: 2;
       display: inline-block;
       transition: all 0.3s ease;
   }


   .butn-dark:hover span {
       transform: scale(1.05);
   }


   .butn-dark:before {
       content: '';
       position: absolute;
       top: 0;
       left: -100%;
       width: 100%;
       height: 100%;
       background: linear-gradient(90deg, rgba(255, 255, 255, 0.2), transparent);
       transition: all 0.6s ease;
   }


   .butn-dark:hover:before {
       left: 100%;
   }


   /* Responsive Design */
   @media (max-width: 991px) {
       .booking-card {
           margin-top: 40px;
       }
   }


   @media (max-width: 768px) {
       .booking-card {
           padding: 25px;
           margin-top: 30px;
       }


       .current-price {
           font-size: 2em;
       }


       .highlight-item {
           padding: 12px 15px;
       }


       .butn-dark {
           padding: 15px 25px;
       }
   }


   @media (max-width: 480px) {
       .booking-card {
           padding: 20px;
       }


       .current-price {
           font-size: 1.8em;
       }


       .highlight-item {
           padding: 10px 12px;
       }


       .highlight-item i {
           font-size: 1.1em;
       }


       .highlight-item span {
           font-size: 0.95em;
       }
   }


   /* Tour Information */
   .tour-page .head-icon {
       display: grid;
       grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
       gap: 15px;
       margin: 25px 0;
   }


   .tour-page .head-icon p {
       display: flex;
       align-items: center;
       color: #666;
       font-size: 0.95em;
   }


   .tour-page .head-icon i {
       color: #aa8453;
       margin-right: 10px;
       font-size: 1.2em;
   }


   /* Rating Stars */
   .rating {
       display: flex;
       align-items: center;
       gap: 5px;
   }


   .star {
       color: #ddd;
       font-size: 1.2em;
   }


   .star.active {
       color: #ffc107;
   }


   .reviews-count {
       margin-left: 10px;
       color: #666;
       font-size: 0.9em;
   }


   .accordion-box {
       margin-top: 20px;
   }


   .accordion {
       margin-bottom: 10px;
       border: 1px solid #eee;
       border-radius: 8px;
       overflow: hidden;
       background: #fff;
   }


   .acc-btn {
       padding: 15px 20px;
       background: #f8f9fa;
       cursor: pointer;
       font-weight: 500;
       transition: all 0.3s ease;
       display: flex;
       justify-content: space-between;
       align-items: center;
       user-select: none;
   }


   .acc-btn .title {
       flex: 1;
       margin-right: 20px;
   }


   .acc-btn .toggle-icon {
       font-size: 24px;
       color: #aa8453;
       min-width: 24px;
       text-align: center;
       transition: transform 0.3s ease;
   }


   .accordion.active .toggle-icon {
       transform: rotate(45deg);
   }


   .acc-btn:hover {
       background: #f0f2f5;
   }


   .acc-content {
       max-height: 0;
       overflow: hidden;
       transition: max-height 0.3s ease-out;
       background: white;
   }


   .accordion.active .acc-content {
       max-height: 2000px;
       /* Đủ lớn để chứa nội dung */
       transition: max-height 0.5s ease-in;
   }


   .accordion.active .acc-btn {
       background: #aa8453;
       color: white;
   }


   .accordion.active .acc-btn .toggle-icon {
       color: white;
   }


   .content {
       padding: 20px;
   }


   /* Timeline styles */
   .timeline {
       padding: 20px 0;
   }


   .timeline-item {
       display: flex;
       margin-bottom: 20px;
       position: relative;
   }


   .timeline-item:last-child {
       margin-bottom: 0;
   }


   .time {
       font-weight: 700;
       min-width: 80px;
       color: #aa8453;
       font-size: 1.1em;
   }


   .timeline-content {
       flex: 1;
       padding-left: 20px;
       border-left: 2px solid #aa8453;
       padding-bottom: 20px;
       position: relative;
   }


   .timeline-content::before {
       content: '';
       position: absolute;
       left: -7px;
       top: 5px;
       width: 12px;
       height: 12px;
       background: #aa8453;
       border-radius: 50%;
   }


   .timeline-item:last-child .timeline-content {
       padding-bottom: 0;
   }
</style>
<script>
   document.querySelectorAll("details").forEach((detail) => {
       detail.addEventListener("toggle", (event) => {
           if (detail.open) {
               // Cuộn mượt xuống nội dung khi mở
               detail.scrollIntoView({
                   behavior: "smooth",
                   block: "start"
               });
           }
       });
   });
</script>





