<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tour;
use App\Models\Voucher;
use App\Models\Destination;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VoucherTest extends TestCase
{
    use DatabaseTransactions;
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_voucher_validation_for_active_and_valid_code()
    {
        $voucher = Voucher::create([
            'code' => 'TEST_SUMMER100_' . uniqid(),
            'name' => 'Giảm 100K',
            'type' => 'fixed',
            'value' => 100000,
            'min_order_value' => 500000,
            'status' => 'active',
        ]);

        $result = $voucher->validateForOrder(1000000);
        $this->assertTrue($result['valid']);

        $discount = $voucher->calculateDiscount(1000000);
        $this->assertEquals(100000, $discount);
    }

    public function test_voucher_percentage_discount_calculation()
    {
        $voucher = Voucher::create([
            'code' => 'TEST_SALE20_' . uniqid(),
            'name' => 'Giảm 20% tối đa 200K',
            'type' => 'percent',
            'value' => 20,
            'max_discount_amount' => 200000,
            'min_order_value' => 500000,
            'status' => 'active',
        ]);

        // 20% of 2,000,000 is 400,000 -> max_discount_amount capped at 200,000
        $discount = $voucher->calculateDiscount(2000000);
        $this->assertEquals(200000, $discount);
    }

    public function test_voucher_fails_if_inactive()
    {
        $voucher = Voucher::create([
            'code' => 'TEST_OFF50_' . uniqid(),
            'name' => 'Tạm ngưng',
            'type' => 'fixed',
            'value' => 50000,
            'min_order_value' => 100000,
            'status' => 'inactive',
        ]);

        $result = $voucher->validateForOrder(500000);
        $this->assertFalse($result['valid']);
    }

    public function test_voucher_fails_if_below_min_order_value()
    {
        $voucher = Voucher::create([
            'code' => 'TEST_VIP500_' . uniqid(),
            'name' => 'Đơn từ 2 triệu',
            'type' => 'fixed',
            'value' => 500000,
            'min_order_value' => 2000000,
            'status' => 'active',
        ]);

        $result = $voucher->validateForOrder(1000000);
        $this->assertFalse($result['valid']);
    }

    public function test_voucher_fails_if_usage_limit_reached()
    {
        $voucher = Voucher::create([
            'code' => 'TEST_LIMITED1_' . uniqid(),
            'name' => 'Giới hạn 1 lần',
            'type' => 'fixed',
            'value' => 50000,
            'usage_limit' => 1,
            'used_count' => 1,
            'status' => 'active',
        ]);

        $result = $voucher->validateForOrder(500000);
        $this->assertFalse($result['valid']);
    }
}
