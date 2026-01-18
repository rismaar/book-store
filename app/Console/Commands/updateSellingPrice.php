<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class updateSellingPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:selling-price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $books = \App\Models\Buku::whereNull('selling_price')->get();
        foreach($books as $book){
            $book->selling_price = $book->price + 20000;
            $book->save();
        }
        $this->info('Selling prices updated successfully.');
    }
}
