<?php

declare(strict_types=1);

namespace App\Exports;

use App\Models\Form;
use App\Models\FormSubmission;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FormSubmissionsExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping, WithStyles
{
    use Exportable;

    public function __construct(
        protected Form $form
    ) {
    }

    public function collection(): Collection
    {
        return $this->form->submissions;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

    protected function getQuestions(): array
    {
        return $this->collection()->first()
            ?->data
            ->pluck('label')
            ->all() ?? [];
    }

    public function headings(): array
    {
        return [
            __('form_submission.id', ['id' => null]),
            __('field.created_at'),
            ...$this->getQuestions(),
        ];
    }

    /**
     * @param FormSubmission $formSubmission
     */
    public function map($formSubmission): array
    {
        $map = [
            $formSubmission->id,
            $formSubmission->created_at,
        ];

        foreach ($formSubmission->data as $response) {
            $map[] = $response['value'];
        }

        return $map;
    }
}
