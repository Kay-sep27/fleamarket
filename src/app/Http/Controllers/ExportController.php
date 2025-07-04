<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Facades\Response;

class ExportController extends Controller
{
    public function export()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');
            // ヘッダー行
            fputcsv($file, ['ID', '姓', '名', 'メール', '性別', '電話番号', '住所', '建物名', '種類', '内容', '登録日']);

            // データ行
            $contacts = Contact::with('category')->get();
            foreach ($contacts as $contact) {
                fputcsv($file, [
                    $contact->id,
                    $contact->last_name,
                    $contact->first_name,
                    $contact->email,
                    $contact->gender,
                    $contact->tel,
                    $contact->address,
                    $contact->building_name,
                    $contact->category->name ?? '',
                    $contact->content,
                    $contact->created_at->format('Y-m-d'),
                ]);
            }

            fclose($file);
        };

        return Response::streamDownload($callback, 'contacts.csv', $headers);
    }
}