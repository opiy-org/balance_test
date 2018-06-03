<?php

namespace App\Console\Commands;

use App\Helpers\MathHelper;
use App\Models\Transer;
use App\Models\User;
use App\References\TransferReference;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Transfer extends Command
{
    protected $signature = 'transfer {from_user_id} {to_user_id} {amount}';
    protected $description = 'Transfer some money from user to user';


    protected $from_user_id;
    protected $to_user_id;

    protected $amount;


    public function handle()
    {
        //get args
        $this->from_user_id = (int)$this->argument('from_user_id');
        $this->to_user_id = (int)$this->argument('to_user_id');
        $this->amount = MathHelper::truncate((float)$this->argument('amount'), 2);

        //get users
        /** @var User $from_user */
        $from_user = User::find($this->from_user_id);
        /** @var User $to_user */
        $to_user = User::find($this->to_user_id);

        //validate input
        $rules = TransferReference::RULES;
        $rules['amount'] .= '|max:' . object_get($from_user, 'balance', 0);
        $validator = Validator::make($this->arguments(), $rules);
        if ($validator->fails()) {
            foreach ($validator->errors()->toArray() as $error) {
                $msg = array_get($error, 0);
                if ($msg) $this->error($msg);
            }
            exit(422);
        }

        //create log
        $transfer = Transer::create([
            'from_user_id' => $this->from_user_id,
            'to_user_id' => $this->to_user_id,
            'amount' => $this->amount,
            'status' => TransferReference::STATUS_NEW
        ]);

        //transfer (main routine)
        try {
            DB::beginTransaction();

            $from_user->update([
                'balance' => $from_user->balance - $this->amount
            ]);
            $to_user->update([
                'balance' => $to_user->balance + $this->amount
            ]);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();

            //update log (set ERR status)
            $transfer->update([
                'error_msg' => $exception->getMessage(),
                'status' => TransferReference::STATUS_ERROR
            ]);

            $this->error('Transfer failed');
            exit(500);
        }

        //update log (set OK status)
        $transfer->update([
            'status' => TransferReference::STATUS_OK
        ]);

        $this->info('Transferred successfully');
        $this->info($from_user->name . "\t ---- $this->amount ---> \t" . $to_user->name);
    }

}
