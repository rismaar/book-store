<?php

namespace App\Console\Commands;

use App\Models\Restock;
use Illuminate\Console\Command;

class autoReject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:reject-restock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto reject restock after 7 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Restock::where('status', 'confirmed')->where('created_at', '<=', now()->subDays(7))->update([
            'status' => 'rejected',
            'rejected_at' => now()      
        ]);
    }
}
