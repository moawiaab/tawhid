<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        // dd(auth()->user()->account->users()->get());
        return auth()->user()->account->users()->get()->transform(fn ($e) => [
            'id' => $e->id,
            'name' => $e->name,
        ]);
    }
}
