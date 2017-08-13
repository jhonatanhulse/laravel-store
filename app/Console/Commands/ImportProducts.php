<?php

namespace App\Console\Commands;

use App\Category;
use App\Importation;
use App\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products in CSV file provided';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $importations = Importation::all();

        foreach ($importations as $importation) {
            $path = storage_path($importation->path);

            Excel::load($path, function($reader) {
                $rows = $reader->all();

                foreach ($rows as $row) {
                    $category = Category::firstOrCreate(['name' => $row->category]);

                    $product = new Product([
                        'name' => $row->name,
                        'price' => $row->price,
                        'description' => $row->description
                    ]);

                    $product->category()->associate($category);

                    $product->save();
                }
            });

            $user = $importation->user;

            Mail::raw('your import was completed', function ($message) use ($user) {
                $message->subject('Product importation');
                $message->to($user->email);
            });

            $importation->delete();
        }
    }
}
