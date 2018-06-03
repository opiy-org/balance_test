<?php

namespace App\Console\Commands;

use App\Models\Transer;
use App\References\TransferReference;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Helper\TableSeparator;

class TransfersList extends Command
{

    protected $signature = 'transfers';
    protected $description = 'Displays transfers log';

    public function handle()
    {

        $trnsfs = Transer::orderBy('id')->get();
        $cnt = count($trnsfs);

        if (!$cnt) {
            $this->info('No transfers yet...');
            exit;
        }

        $table = new Table($this->output);
        $table->setHeaders([
            'date', 'from', 'to', 'amount', 'status'
        ]);

        /** @var Transer $trnsf */
        foreach ($trnsfs as $trnsf) {
            $table->addRow([
                $trnsf->created_at,
                object_get($trnsf, 'from_user.name'),
                object_get($trnsf, 'to_user.name'),
                $trnsf->amount,
                array_get(TransferReference::STATUSES, $trnsf->status)
            ]);
        }
        $table->addRow(new TableSeparator());
        $table->addRow([new TableCell('Total transfers: ' . $cnt, ['colspan' => 5])]);
        $table->render();

    }
}
