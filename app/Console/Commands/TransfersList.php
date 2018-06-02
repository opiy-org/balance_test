<?php

namespace App\Console\Commands;

use App\Models\Transer;
use App\References\TransferReference;
use Illuminate\Console\Command;

class TransfersList extends Command
{

    protected $signature = 'transfers';
    protected $description = 'Displays transfers log';

    public function handle()
    {

        $trnsfs = Transer::orderBy('id')->get();
        $cnt = count($trnsfs);

        if (!$cnt) {
            echo 'No transfers yet...';
            exit;
        }

        echo '-------------------------------------------- transferslist' . "\n";
        echo 'date' . "\t" . 'from' . "\t" . 'to' . "\t" . 'amount' . "\t" . 'status' . "\n";
        /** @var Transer $trnsf */
        foreach ($trnsfs as $trnsf) {
            echo $trnsf->created_at . "\t"
                . object_get($trnsf, 'from_user.name') . "\t"
                . object_get($trnsf, 'from_user.name') . "\t"
                . $trnsf->amount . "\t"
                . TransferReference::STATUSES[$trnsf->status] . "\n";
        }
        echo '--------------------------------------------- (' . $cnt . ")\n";

    }
}
