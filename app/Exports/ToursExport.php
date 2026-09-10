<?php

namespace App\Exports;

use App\Models\Tour;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ToursExport implements FromCollection, WithHeadings, WithMapping
{
    protected $search;
    protected $status;
    protected $destination_id;
    protected $dateRange;

    public function __construct($search = null, $status = null, $destination_id = null, $dateRange = null)
    {
        $this->search = $search;
        $this->status = $status;
        $this->destination_id = $destination_id;
        $this->dateRange = $dateRange;
    }

    public function collection()
    {
        $query = Tour::query()
            ->with('destination');

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
        if ($this->status) {
            $query->where('status', $this->status);
        }
        if ($this->destination_id) {
            $query->where('destination_id', $this->destination_id);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tên Tour',
            'Điểm Đến',
            'Giá',
            'Thời Gian',
            'Số Người',
            'Trạng Thái',
        ];
    }

    public function map($tour): array
    {
        return [
            $tour->id,
            $tour->name,
            $tour->destination->name,
            number_format($tour->price, 0, ',', '.') . ' VND',
            $tour->duration . ' ngày',
            $tour->max_people . ' người',
            $tour->status === 'active' ? 'Hoạt động' : 'Tạm dừng',
        ];
    }
}
