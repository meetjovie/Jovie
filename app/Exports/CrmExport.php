<?php

namespace App\Exports;

use App\Models\Creator;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CrmExport implements FromCollection, WithMapping, WithHeadings
{
    protected $creators;

    public function __construct($creators)
    {
        $this->creators = $creators;
    }

    public function headings(): array
    {
        return [
            'id',
            'First Name',
            'Last Name',
            'Full Name',
            'City',
            'Country',
            'Primary Email',
            'Instagram Username',
            'Instagram Followers',
            'Instagram Engagement Rate',
            'Instagram Engaged Followers',
            'Instagram Category',
            'Instagram Biography',
        ];
    }

    /**
     * @var Creator $creator
     */
    public function map($creator): array
    {
        return [
            $creator->id,
            $creator->first_name,
            $creator->last_name,
            $creator->full_name,
            $creator->city,
            $creator->country,
            $creator->emails[0] ?? null,
            $creator->instagram_handler,
            $creator->instagram_followers,
            $creator->instagram_engagement_rate,
            $creator->instagram_meta->engagement_follows ?? null,
            $creator->instagram_category,
            $creator->instagram_biography,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->creators;
    }
}
